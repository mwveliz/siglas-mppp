create table funcionarios.contacto (
   id             serial       not null,
   funcionario_id integer      not null,
   tipo           varchar(255) not null,--  sirve para identificar el campo a mostrar dependiendo del tipo de persona
   valor          varchar(255) not null,
   f_validado     timestamp            ,
   id_validado    integer              ,
   status         varchar(1)   not null,
   created_at     timestamp    not null,
   updated_at     timestamp            ,
   id_update      integer      not null,
   ip_update      varchar(40)  not null,
   constraint pk_funcionarios_contacto primary key (id)
)   ;
create table funcionarios.idioma_manejado (
   id             serial      not null,
   funcionario_id integer     not null,--  foranea a tabla: funcionario, campo: id
   idioma_id      integer     not null,--  foranea a tabla: idioma, campo: id
   principal      boolean     not null,
   habla          boolean     not null,
   lee            boolean     not null,
   escribe        boolean     not null,
   f_validado     timestamp           ,
   id_validado    integer             ,
   status         varchar(1)  not null,
   created_at     timestamp   not null,
   updated_at     timestamp           ,
   id_update      integer     not null,
   ip_update      varchar(40) not null,
   constraint pk_funcionarios_idioma_manejado primary key (id)
)   ;
create table funcionarios.informacion_basica (
   id                          serial      not null,
   funcionario_id              integer     not null,
   f_nacimiento                date        not null,
   estado_nacimiento_id        varchar(2)          ,--  dato que sirve para ver las migraciones
   sexo                        varchar(1)  not null,
   edo_civil                   varchar(1)  not null,
   licencia_conducir_uno_grado varchar(3)          ,
   licencia_conducir_dos_grado varchar(3)          ,
   f_validado                  timestamp           ,
   id_validado                 integer             ,
   status                      varchar(1)  not null,
   created_at                  timestamp   not null,
   updated_at                  timestamp           ,
   id_update                   integer     not null,
   ip_update                   varchar(40) not null,
   proteccion                  text                ,
   constraint pk_funcionarios_informacion_basica primary key (id)
)   ;
create table funcionarios.residencia (
   id                   serial       not null,
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
   constraint pk_funcionarios_residencia primary key (id)
)   ;
create table funcionarios.nacionalidad (
   id             serial      not null,
   funcionario_id int4        not null,--  foranea a tabla: funcionario, campo: id
   pais_id        int4        not null,
   nacimiento     boolean     not null,
   f_validado     timestamp           ,
   id_validado    int4                ,
   status         varchar(1)  not null,
   created_at     timestamp   not null,
   updated_at     timestamp           ,
   id_update      int4        not null,
   ip_update      varchar(40) not null,
   constraint pk_funcionarios_nacionalidad primary key (id)
)   ;
create table funcionarios.funcionario_residencia (
   id                    serial      not null         ,
   funcionario_id        integer     not null         ,--  foranea a tabla: funcionario, campo: id
   residencia_id         integer     not null         ,
   ano_inicio_residencia integer     not null,
   f_validado            timestamp                    ,
   id_validado           integer                      ,
   status                varchar(1)  not null         ,
   created_at            timestamp   not null         ,
   updated_at            timestamp                    ,
   id_update             integer     not null         ,
   ip_update             varchar(40) not null         ,
   proteccion            text                         ,
   constraint pk_funcionarios_funcionario_residencia primary key (id)
)   ;
create table funcionarios.cuenta_bancaria (
   id             serial       not null,
   funcionario_id int4         not null,--  foranea a tabla: funcionario, campo: id
   banco_id       int4         not null,
   tipo           varchar(50)  not null,
   n_cuenta       varchar(255) not null,
   f_validado     timestamp            ,
   id_validado    integer              ,
   status         varchar(1)   not null,
   created_at     timestamp    not null,
   updated_at     timestamp            ,
   id_update      integer      not null,
   ip_update      varchar(40)  not null,
   proteccion     text                 ,
   constraint pk_funcionarios_cuenta_bancaria primary key (id)
)   ;
create table funcionarios.origen_indigena (
   id              serial      not null,
   funcionario_id  integer     not null,--  foranea a tabla: funcionario, campo: id
   etnia_id        integer     not null,--  foranea a tabla: etnia, campo: id
   estado_etnia_id varchar(2)  not null,
   nacimiento      varchar(1)  not null,
   f_validado      timestamp           ,
   id_validado     integer             ,
   status          varchar(1)  not null,
   created_at      timestamp   not null,
   updated_at      timestamp           ,
   id_update       integer     not null,
   ip_update       varchar(40) not null,
   constraint pk_funcionarios_origen_indigena primary key (id)
)   ;
create table funcionarios.informacion_corporal (
   id             serial       not null,
   funcionario_id integer      not null,
   peso           numeric      not null,--  dato que sirve para ver las migraciones
   altura         numeric      not null,
   talla_camisa   varchar(3)   not null,
   talla_pantalon varchar(3)   not null,
   talla_calzado  varchar(3)   not null,
   talla_gorra    varchar(3)   not null,
   tipo_sangre    varchar(50)          ,
   lentes_formula varchar(255)         ,
   f_validado     timestamp            ,
   id_validado    integer              ,
   status         varchar(1)   not null,
   created_at     timestamp    not null,
   updated_at     timestamp            ,
   id_update      integer      not null,
   ip_update      varchar(40)  not null,
   proteccion     text                 ,
   constraint pk_funcionarios_informacion_corporal primary key (id)
)   ;
create table funcionarios.grupo_social (
   id                   serial       not null,
   funcionario_id       integer      not null,--  foranea a tabla: funcionario, campo: id
   tipo_grupo_social_id integer      not null,--  foranea a tabla: etnia, campo: id
   nombre               varchar(255) not null,
   descripcion          text                 ,
   f_validado           timestamp            ,
   id_validado          integer              ,
   status               varchar(1)   not null,
   created_at           timestamp    not null,
   updated_at           timestamp            ,
   id_update            integer      not null,
   ip_update            varchar(40)  not null,
   constraint pk_funcionarios_grupo_social primary key (id)
)   ;
create table funcionarios.familiar (
   id                 serial       not null,
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
create table funcionarios.funcionario_familiar (
   id                  serial      not null         ,
   funcionario_id      integer     not null         ,--  foranea a tabla: funcionario, campo: id
   familiar_id         integer                      ,
   familiar_interno_id integer                      ,
   parentesco_id       integer     not null,
   f_validado          timestamp                    ,
   id_validado         integer                      ,
   status              varchar(1)  not null         ,
   created_at          timestamp   not null         ,
   updated_at          timestamp                    ,
   id_update           integer     not null         ,
   ip_update           varchar(40) not null         ,
   proteccion          text                         ,
   constraint pk_funcionarios_funcionario_familiar primary key (id)
)   ;
create table public.tipo_grupo_social (
   id                     serial not null,
   nombre                 varchar(255) not null,
   status                 varchar(1)   not null,
   created_at             timestamp    not null,
   updated_at             timestamp    not null,
   id_update              integer      not null,  
   constraint pk_public_tipo_grupo_social primary key (id)
)   ;
create table funcionarios.cuidado_familiar (
   id                    serial      not null,
   familiar_id           integer             ,
   organismo_cuidados_id integer             ,
   tipo                  varchar(50) not null,
   f_validado            timestamp           ,
   id_validado           integer             ,
   status                varchar(1)  not null,
   created_at            timestamp   not null,
   updated_at            timestamp           ,
   id_update             integer     not null,
   ip_update             varchar(40) not null,
   proteccion            text                ,
   constraint pk_funcionarios_cuidado_familiar primary key (id)
)   ;
create table funcionarios.educacion_universitaria (
   id                     serial      not null,
   funcionario_id         integer     not null,--  foranea a tabla:funcionario, campo: id
   pais_id                integer     not null,
   organismo_educativo_id integer             ,
   carrera_id             integer             ,
   nivel_academico_id     integer     not null,--  foranea a tabla:nivelinstruccion, campo: id
   f_ingreso              date        not null,
   f_graduado             date                ,
   estudiando_actualmente boolean     not null,
   segmento               integer     not null,--  Trimestre semestre o año
   ruta                   text                ,
   f_validado             timestamp           ,
   id_validado            integer             ,
   status                 varchar(1)  not null,
   created_at             timestamp   not null,
   updated_at             timestamp           ,
   id_update              integer     not null,
   ip_update              varchar(40) not null,
   proteccion             text                ,
   constraint pk_funcionarios_educacion_universitaria primary key (id)
)   ;
create table funcionarios.educacion_media (
   id                     serial      not null,
   funcionario_id         integer     not null,--  foranea a tabla:funcionario, campo: id
   pais_id                integer     not null,
   organismo_educativo_id integer             ,
   especialidad           integer             ,
   nivel_academico_id     integer     not null,--  foranea a tabla:nivelinstruccion, campo: id
   f_ingreso              date        not null,
   f_graduado             date                ,
   estudiando_actualmente boolean     not null,
   ruta                   text                ,
   f_validado             timestamp           ,
   id_validado            integer             ,
   status                 varchar(1)  not null,
   created_at             timestamp   not null,
   updated_at             timestamp           ,
   id_update              integer     not null,
   ip_update              varchar(40) not null,
   proteccion             text                ,
   constraint pk_funcionarios_educacion_media primary key (id)
)   ;
create table funcionarios.educacion_adicional (
   id                     serial      not null,
   funcionario_id         integer     not null,--  foranea a tabla:funcionario, campo: id
   pais_id                integer     not null,
   organismo_educativo_id integer             ,
   nombre                 integer             ,
   tipo                   integer     not null,--  foranea a tabla:nivelinstruccion, campo: id
   f_ingreso              date        not null,
   horas                  integer             ,
   ruta                   text                ,
   f_validado             timestamp           ,
   id_validado            integer             ,
   status                 varchar(1)  not null,
   created_at             timestamp   not null,
   updated_at             timestamp           ,
   id_update              integer     not null,
   ip_update              varchar(40) not null,
   proteccion             text                ,
   constraint pk_funcionarios_educacion_adicional primary key (id)
)   ;
create table public.carrera_universitaria (
   id                     serial       not null,
   organismo_educativo_id integer      not null,
   area_conocimiento_id   integer              ,
   nombre                 varchar(255) not null,
   status                 varchar(1)   not null,
   created_at             timestamp    not null,
   updated_at             timestamp    not null,
   id_update              integer      not null,
   constraint pk_public_carrera_universitaria primary key (id)
)   ;
create table funcionarios.funcionario_discapacidad (
   id              serial      not null,
   funcionario_id  integer     not null,--  foranea a tabla: funcionario, campo: id
   discapacidad_id integer     not null,--  foranea a tabla: discapacidad, campo: id
   f_validado      timestamp           ,
   id_validado     integer             ,
   status          varchar(1)  not null,
   created_at      timestamp   not null,
   updated_at      timestamp           ,
   id_update       integer     not null,
   ip_update       varchar(40) not null,
   proteccion      text                ,
   constraint pk_funcionarios_funcionario_discapacidad primary key (id)
)   ;
create table funcionarios.funcionario_enfermedad (
   id             serial      not null,
   funcionario_id integer     not null,--  foranea a tabla: funcionario, campo: id
   enfermedad_id  integer     not null,--  foranea a tabla: discapacidad, campo: id
   f_validado     timestamp           ,
   id_validado    integer             ,
   status         varchar(1)  not null,
   created_at     timestamp   not null,
   updated_at     timestamp           ,
   id_update      int4        not null,
   ip_update      varchar(40) not null,
   proteccion     text                ,
   constraint pk_funcionarios_funcionario_enfermedad primary key (id)
)   ;
create table funcionarios.familiar_discapacidad (
   id              serial      not null,
   familiar_id     integer     not null,--  foranea a tabla: funcionario, campo: id
   discapacidad_id integer     not null,--  foranea a tabla: discapacidad, campo: id
   f_validado      timestamp           ,
   id_validado     integer             ,
   status          varchar(1)  not null,
   created_at      timestamp   not null,
   updated_at      timestamp           ,
   id_update       int4        not null,
   ip_update       varchar(40) not null,
   proteccion      text                ,
   constraint pk_funcionarios_familiar_discapacidad primary key (id)
)   ;
create table funcionarios.familiar_enfermedad (
   id            serial      not null,
   familiar_id   integer     not null,--  foranea a tabla: funcionario, campo: id
   enfermedad_id integer     not null,--  foranea a tabla: discapacidad, campo: id
   f_validado    timestamp           ,
   id_validado   integer             ,
   status        varchar(1)  not null,
   created_at    timestamp   not null,
   updated_at    timestamp           ,
   id_update     integer     not null,
   ip_update     varchar(40) not null,
   proteccion    text                ,
   constraint pk_funcionarios_familiar_enfermedad primary key (id)
)   ;
create table public.nivel_academico (
   id             serial not null,
   nombre         varchar(255) not null,
   created_at     timestamp   not null,
   updated_at     timestamp           ,
   id_update      integer     not null,
   ip_update      varchar(40) not null,
   constraint pk_public_nivel_academico primary key (id)
)   ;
create table funcionarios.informacion_corporal_familiar (
   id             serial      not null,
   familiar_id    integer     not null,
   peso           numeric     not null,--  dato que sirve para ver las migraciones
   altura         numeric     not null,
   talla_camisa   varchar(3)  not null,
   talla_pantalon varchar(3)  not null,
   talla_calzado  varchar(3)  not null,
   talla_gorra    varchar(3)  not null,
   f_validado     timestamp           ,
   id_validado    integer             ,
   status         varchar(1)  not null,
   created_at     timestamp   not null,
   updated_at     timestamp           ,
   id_update      integer     not null,
   ip_update      varchar(40) not null,
   constraint pk_funcionarios_informacion_corporal_familiar primary key (id)
)   ;
create table public.area_conocimiento (
   id          serial       not null,
   nombre      varchar(255) not null,
   descripcion text                 ,
   status      varchar(1)   not null,
   created_at  timestamp    not null,
   updated_at  timestamp    not null,
   id_update   integer      not null,
   constraint pk_public_area_conocimiento primary key (id)
)   ;
create table funcionarios.foto (
   id             serial      not null,
   funcionario_id integer     not null,
   ruta           text        not null,--  sirve para identificar el campo a mostrar dependiendo del tipo de persona
   observacion    text        not null,
   f_validado     timestamp           ,
   id_validado    integer             ,
   status         varchar(1)  not null,
   created_at     timestamp   not null,
   updated_at     timestamp           ,
   id_update      integer     not null,
   ip_update      varchar(40) not null,
   constraint pk_funcionarios_foto primary key (id)
)   ;





alter table funcionarios.funcionario_residencia add constraint funcionario_a_funcionario_residencia 
    foreign key (funcionario_id)
    references funcionarios.funcionario (id) ;
alter table funcionarios.funcionario_residencia add constraint residencia_a_funcionario_residencia 
    foreign key (funcionario_id)
    references funcionarios.residencia (id) ;
alter table funcionarios.nacionalidad add constraint funcionario_a_nacionalidad 
    foreign key (funcionario_id)
    references funcionarios.funcionario (id) ;
alter table funcionarios.informacion_basica add constraint funcionario_a_informacion_basica 
    foreign key (funcionario_id)
    references funcionarios.funcionario (id) ;
alter table funcionarios.contacto add constraint funcionario_a_contacto 
    foreign key (funcionario_id)
    references funcionarios.funcionario (id) ;
alter table funcionarios.idioma_manejado add constraint funcionario_a_idioma_manejado 
    foreign key (funcionario_id)
    references funcionarios.funcionario (id) ;
alter table funcionarios.cuenta_bancaria add constraint funcionario_a_cuenta_bancaria 
    foreign key (funcionario_id)
    references funcionarios.funcionario (id) ;
alter table funcionarios.origen_indigena add constraint funcionario_a_origen_indigena 
    foreign key (funcionario_id)
    references funcionarios.funcionario (id) ;
alter table funcionarios.informacion_corporal add constraint funcionario_a_informacion_corporal 
    foreign key (funcionario_id)
    references funcionarios.funcionario (id) ;
alter table funcionarios.grupo_social add constraint funcionario_a_grupo_social 
    foreign key (funcionario_id)
    references funcionarios.funcionario (id) ;
alter table funcionarios.funcionario_familiar add constraint familiar_a_funcionario_familiar 
    foreign key (familiar_id)
    references funcionarios.familiar (id) ;
alter table funcionarios.funcionario_familiar add constraint funcionario_a_funcionario_familiar 
    foreign key (funcionario_id)
    references funcionarios.funcionario (id) ;
alter table funcionarios.funcionario_familiar add constraint parentesco_a_funcionario_familiar 
    foreign key (parentesco_id)
    references public.parentesco (id) ;
alter table funcionarios.grupo_social add constraint tipo_grupo_social 
    foreign key (tipo_grupo_social_id)
    references public.tipo_grupo_social (id) ;
alter table funcionarios.origen_indigena add constraint etnia_a_origen_indigena 
    foreign key (etnia_id)
    references public.etnia (id) ;
alter table funcionarios.cuenta_bancaria add constraint banco_a_cuenta_bancaria 
    foreign key (banco_id)
    references public.banco (id) ;
alter table funcionarios.idioma_manejado add constraint idioma_a_idioma_manejado 
    foreign key (idioma_id)
    references public.idioma (id) ;
alter table funcionarios.nacionalidad add constraint pais_a_nacionalidad 
    foreign key (pais_id)
    references public.pais (id) ;
alter table funcionarios.cuidado_familiar add constraint organismo_a_cuidado_familiar 
    foreign key (organismo_cuidados_id)
    references organismos.organismo (id) ;
alter table funcionarios.cuidado_familiar add constraint familiar_a_cuidado_familiar 
    foreign key (familiar_id)
    references funcionarios.familiar (id) ;
alter table funcionarios.educacion_universitaria add constraint funcionario_a_educacion_universitaria 
    foreign key (funcionario_id)
    references funcionarios.funcionario (id) ;
alter table funcionarios.educacion_media add constraint funcionario_a_educacion_media 
    foreign key (funcionario_id)
    references funcionarios.funcionario (id) ;
alter table funcionarios.educacion_adicional add constraint funcionario_a_educacion_adicional 
    foreign key (funcionario_id)
    references funcionarios.funcionario (id) ;
alter table funcionarios.educacion_adicional add constraint organismo_a_educacion_adicional 
    foreign key (organismo_educativo_id)
    references organismos.organismo (id) ;
alter table funcionarios.educacion_media add constraint organismo_a_educacion_media 
    foreign key (organismo_educativo_id)
    references organismos.organismo (id) ;
alter table funcionarios.educacion_universitaria add constraint organismo_a_educacion_universitaria 
    foreign key (organismo_educativo_id)
    references organismos.organismo (id) ;
alter table public.carrera_universitaria add constraint organismo_a_carrera_universitaria 
    foreign key (organismo_educativo_id)
    references organismos.organismo (id) ;
alter table funcionarios.funcionario_enfermedad add constraint funcionario_a_funcionario_enfermedad 
    foreign key (funcionario_id)
    references funcionarios.funcionario (id) ;
alter table funcionarios.funcionario_discapacidad add constraint funcionario_a_funcionario_discapacidad 
    foreign key (funcionario_id)
    references funcionarios.funcionario (id) ;
alter table funcionarios.familiar_enfermedad add constraint familiar_a_familiar_enfermedad 
    foreign key (familiar_id)
    references funcionarios.familiar (id) ;
alter table funcionarios.familiar_discapacidad add constraint familiar_a_familiar_discapacidad 
    foreign key (familiar_id)
    references funcionarios.familiar (id) ;
alter table funcionarios.funcionario_discapacidad add constraint discapacidad_a_funcionario_discapacidad 
    foreign key (discapacidad_id)
    references public.discapacidad (id) ;
alter table funcionarios.familiar_discapacidad add constraint discapacidad_a_familiar_discapacidad 
    foreign key (discapacidad_id)
    references public.discapacidad (id) ;
alter table funcionarios.funcionario_enfermedad add constraint enfermedad_a_enfermedad_id 
    foreign key (enfermedad_id)
    references public.enfermedad (id) ;
alter table funcionarios.familiar_enfermedad add constraint enfermedad_a_familiar_enfermedad 
    foreign key (enfermedad_id)
    references public.enfermedad (id) ;
alter table funcionarios.educacion_media add constraint nivel_academico_a_educacion_media 
    foreign key (nivel_academico_id)
    references public.nivel_academico (id) ;
alter table funcionarios.educacion_universitaria add constraint nivel_academico_a_educacion_universitaria 
    foreign key (nivel_academico_id)
    references public.nivel_academico (id) ;
alter table funcionarios.familiar add constraint nivel_academico_a_familiar 
    foreign key (nivel_academico_id)
    references public.nivel_academico (id) ;
alter table funcionarios.informacion_corporal_familiar add constraint familiar_a_informacion_corporal_familiar 
    foreign key (familiar_id)
    references funcionarios.familiar (id) ;
alter table funcionarios.funcionario_familiar add constraint funcionario_a_funcionario_familiar_interno 
    foreign key (familiar_interno_id)
    references funcionarios.funcionario (id) ;
alter table public.carrera_universitaria add constraint area_conocimiento_a_carrera_universitaria 
    foreign key (area_conocimiento_id)
    references public.area_conocimiento (id) ;
alter table funcionarios.foto add constraint funcionario_a_foto 
    foreign key (funcionario_id)
    references funcionarios.funcionario (id) ;
