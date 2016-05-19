DROP TABLE funcionarios.funcionario_familiar CASCADE;
DROP TABLE funcionarios.funcionario_residencia CASCADE;
DROP TABLE funcionarios.residencia CASCADE;
DROP TABLE funcionarios.familiar CASCADE;


create table funcionarios.residencia (
   id                   serial       not null,
   funcionario_id       integer      not null,
   estado_id            varchar(2)   not null,
   municipio_id         varchar(4)   not null,
   parroquia_id         varchar(6)   not null,
   dir_av_calle_esq     varchar(255)         ,
   dir_edf_casa         varchar(255)         ,
   dir_piso             varchar(255)         ,
   dir_apt_nombre       varchar(255)         ,
   dir_urbanizacion     varchar(255)         ,
   dir_ciudad           varchar(255)         ,
   dir_punto_referencia varchar(255)         ,
   telf_uno             varchar(255)         ,
   telf_dos             varchar(255)         ,
   f_validado           timestamp            ,
   id_validado          integer              ,
   status               varchar(1)   not null,
   created_at           timestamp    not null,
   updated_at           timestamp            ,
   id_update            integer      not null,
   ip_update            varchar(40)  not null,
   proteccion           text                 ,
   constraint pk_funcionarios_residencia primary key (id)
)   ;

create table funcionarios.familiar (
   id                 serial       not null,
   funcionario_id     integer      not null,
   parentesco_id      integer      not null,
   ci                 varchar(255)         ,--  no es llave por si tienen familiares menores sin cedulas
   primer_nombre      varchar(255) not null,
   segundo_nombre     varchar(255)         ,
   primer_apellido    varchar(255) not null,
   segundo_apellido   varchar(255)         ,
   f_nacimiento       date         not null,
   nacionalidad       varchar(1)   not null,
   sexo               varchar(1)   not null,
   nivel_academico_id integer      not null,--  foranea a tabla:nivelinstruccion, campo:id
   estudia            boolean      not null,
   trabaja            boolean      not null,
   dependencia        boolean      not null,
   f_validado         timestamp            ,
   id_validado        integer              ,
   status             varchar(1)   not null,
   created_at         timestamp    not null,
   updated_at         timestamp    not null,
   id_update          integer      not null,
   ip_update          varchar(40)  not null,
   proteccion         text                 ,
   constraint pk_funcionarios_familiar primary key (id)
)   ;


alter table funcionarios.residencia add constraint funcionario_a_residencia 
    foreign key (funcionario_id)
    references funcionarios.funcionario (id) ;
alter table funcionarios.familiar add constraint funcionario_a_familiar 
    foreign key (funcionario_id)
    references funcionarios.funcionario (id) ;
alter table funcionarios.familiar add constraint parentesco_a_familiar 
    foreign key (parentesco_id)
    references public.parentesco (id) ;
alter table funcionarios.cuidado_familiar add constraint familiar_a_cuidado_familiar 
    foreign key (familiar_id)
    references funcionarios.familiar (id) ;
alter table funcionarios.familiar_enfermedad add constraint familiar_a_familiar_enfermedad 
    foreign key (familiar_id)
    references funcionarios.familiar (id) ;
alter table funcionarios.familiar_discapacidad add constraint familiar_a_familiar_discapacidad 
    foreign key (familiar_id)
    references funcionarios.familiar (id) ;
alter table funcionarios.informacion_corporal_familiar add constraint familiar_a_informacion_corporal_familiar 
    foreign key (familiar_id)
    references funcionarios.familiar (id) ;