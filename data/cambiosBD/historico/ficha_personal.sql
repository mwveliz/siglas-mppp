drop table funcionarios.familiar_funcionario_discapacidad;
drop table funcionarios.familiar_funcionario_enfermedad;
drop table funcionarios.funcionario_familiar_funcionario;
drop table funcionarios.familiar_funcionario;
drop table funcionarios.funcionario_banco;
drop table funcionarios.funcionario_curso;
drop table funcionarios.funcionario_discapacidad;
drop table funcionarios.funcionario_enfermedad;
drop table funcionarios.funcionario_etnia;
drop table funcionarios.funcionario_idioma;
drop table funcionarios.funcionario_iem;
drop table funcionarios.funcionario_ies;
drop table funcionarios.funcionario_organizacion_grupo;
drop table funcionarios.funcionario_pais;
drop table funcionarios.funcionario_vivienda;


create table funcionarios.contacto (
   id             serial       not null,
   funcionario_id integer      not null,
   tipo           varchar(255) not null,
   valor          varchar(255) not null,
   f_validado     timestamp            ,
   id_validado    integer              ,
   status         varchar(1)   not null,
   created_at     timestamp    not null,
   updated_at     timestamp            ,
   id_update      integer      not null,
   constraint pk_funcionarios_contacto primary key (id)
)   ;

alter table funcionarios.contacto add constraint funcionario_a_contacto 
    foreign key (funcionario_id)
    references funcionarios.funcionario (id) ;


create table funcionarios.corporal (
   id                serial       not null,
   funcionario_id    integer      not null,
   f_ultima_revision date         not null,
   peso              numeric      not null,
   altura            numeric      not null,
   talla_camisa      varchar(3)   not null,
   talla_pantalon    varchar(3)   not null,
   talla_calzado     varchar(3)   not null,
   talla_gorra       varchar(3)   not null,
   tipo_sangre       varchar(50)          ,
   lentes_formula    varchar(255)         ,
   f_validado        timestamp            ,
   id_validado       integer              ,
   status            varchar(1)   not null,
   created_at        timestamp    not null,
   updated_at        timestamp            ,
   id_update         integer      not null,
   constraint pk_funcionarios_corporal primary key (id)
)   ;

alter table funcionarios.corporal add constraint funcionario_a_corporal 
    foreign key (funcionario_id)
    references funcionarios.funcionario (id) ;