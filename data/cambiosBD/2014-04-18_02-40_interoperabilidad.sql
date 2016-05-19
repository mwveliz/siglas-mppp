create table siglas.servidor_confianza (
   id           serial      not null,
   id_yml       text UNIQUE not null,
   organismo_id integer     not null,
   dominio      text        not null,
   contacto     text        not null,
   io_basica    text        not null,
   proteccion   text                ,
   puerta       varchar     not null,
   so           varchar     not null,
   agente       varchar     not null,
   pc           varchar     not null,
   status       varchar(1)  not null,
   created_at   timestamp   not null,
   updated_at   timestamp   not null,
   id_create    integer     not null,
   id_update    integer     not null,
   ip_create    varchar(30) not null,
   ip_update    varchar(30) not null,
   constraint pk_siglas_servidor_confianza primary key (id)
)   ;
create table siglas.servidor_certificado (
   id                    serial      not null,
   servidor_confianza_id integer     not null,
   certificado           text        not null,
   detalles_tecnicos     text        not null,
   f_valido_desde        date        not null,
   f_valido_hasta        date        not null,
   puerta                varchar     not null,
   so                    varchar     not null,
   agente                varchar     not null,
   pc                    varchar     not null,
   status                varchar(1)  not null,
   created_at            timestamp   not null,
   updated_at            timestamp   not null,
   id_create             integer     not null,
   id_update             integer     not null,
   ip_create             varchar(30) not null,
   ip_update             varchar(30) not null,
   constraint pk_siglas_servidor_certificado primary key (id)
)   ;
create table siglas.interoperabilidad_enviada (
   id                            serial      not null,
   servidor_confianza_id         integer     not null,
   servidor_certificado_id       integer     not null,
   interoperabilidad_recibida_id integer             ,
   tipo                          text        not null,
   parametros                    text                ,
   firma                         text        not null,
   cadena                        text        not null,
   paquete                       integer     not null,
   partes                        integer     not null,
   parte                         integer     not null,
   status                        varchar(1)  not null,
   created_at                    timestamp   not null,
   updated_at                    timestamp   not null,
   id_create                     integer     not null,
   ip_create                     varchar(30) not null,
   constraint pk_siglas_interoperabilidad_enviada primary key (id)
)   ;
create table siglas.interoperabilidad_recibida (
   id                           serial      not null,
   servidor_confianza_id        integer     not null,
   servidor_certificado_id      integer     not null,
   interoperabilidad_enviada_id integer             ,
   tipo                         text        not null,
   parametros                   text                ,
   firma                        text        not null,
   cadena                       text        not null,
   paquete                      integer     not null,
   partes                       integer     not null,
   parte                        integer     not null,
   created_at                   timestamp   not null,
   updated_at                   timestamp   not null,
   id_create                    integer     not null,
   ip_create                    varchar(30) not null,
   constraint pk_siglas_interoperabilidad_recibida primary key (id)
)   ;
create table siglas.servicios_publicados (
   id                 serial              not null,
   funcion            varchar(255) UNIQUE not null,
   descripcion        text                not null,
   tipo               text                not null,
   crontab            text                not null,
   recursos           text                not null,
   url                varchar             not null,
   parametros_entrada text                not null,
   parametros_salida  text                not null,
   puerta             varchar             not null,
   so                 varchar             not null,
   agente             varchar             not null,
   pc                 varchar             not null,
   status             varchar(1)          not null,
   created_at         timestamp           not null,
   updated_at         timestamp           not null,
   id_create          integer             not null,
   id_update          integer             not null,
   ip_create          varchar(30)         not null,
   ip_update          varchar(30)         not null,
   constraint pk_siglas_servicios_publicados primary key (id)
)   ;
create table siglas.servicios_publicados_confianza (
   id                           serial      not null,
   servicios_publicados_id      integer     not null,
   servidor_confianza_id        integer     not null,
   notificacion                 boolean     not null,
   parametros_salida_permitidos text                ,
   puerta                       varchar     not null,
   so                           varchar     not null,
   agente                       varchar     not null,
   pc                           varchar     not null,
   status                       varchar(1)  not null,
   created_at                   timestamp   not null,
   updated_at                   timestamp   not null,
   id_create                    integer     not null,
   id_update                    integer     not null,
   ip_create                    varchar(30) not null,
   ip_update                    varchar(30) not null,
   constraint pk_siglas_servicios_publicados_confianza primary key (id)
)   ;
create table siglas.servicios_disponibles (
   id                    serial       not null,
   servidor_confianza_id integer      not null,
   funcion               varchar(255) not null,
   descripcion           text         not null,
   tipo                  text         not null,
   crontab               text         not null,
   recursos              text         not null,
   parametros_entrada    text         not null,
   parametros_salida     text         not null,
   puerta                varchar      not null,
   so                    varchar      not null,
   agente                varchar      not null,
   pc                    varchar      not null,
   status                varchar(1)   not null,
   created_at            timestamp    not null,
   updated_at            timestamp    not null,
   id_create             integer      not null,
   id_update             integer      not null,
   ip_create             varchar(30)  not null,
   ip_update             varchar(30)  not null,
   constraint pk_siglas_servicios_disponibles primary key (id)
)   ;
create table siglas.servicios_disponibles_confianza (
   id                       serial      not null,
   servicios_disponibles_id integer     not null,
   ip_permitida             varchar(60) not null,
   detalles_maquina         varchar     not null,
   puerta                   varchar     not null,
   so                       varchar     not null,
   agente                   varchar     not null,
   pc                       varchar     not null,
   status                   varchar(1)  not null,
   created_at               timestamp   not null,
   updated_at               timestamp   not null,
   id_create                integer     not null,
   id_update                integer     not null,
   ip_create                varchar(30) not null,
   ip_update                varchar(30) not null,
   constraint pk_siglas_servicios_disponibles_confianza primary key (id)
)   ;


alter table siglas.servidor_certificado add constraint servidor_confianza_a_servidor_certificado 
    foreign key (servidor_confianza_id)
    references siglas.servidor_confianza (id) ;
alter table siglas.interoperabilidad_enviada add constraint servidor_confianza_a_interoperabilidad_enviada 
    foreign key (servidor_confianza_id)
    references siglas.servidor_confianza (id) ;
alter table siglas.interoperabilidad_recibida add constraint servidor_certificado_a_interoperabilidad_recibida 
    foreign key (servidor_certificado_id)
    references siglas.servidor_certificado (id) ;
alter table siglas.interoperabilidad_recibida add constraint servidor_confianza_a_interoperabilidad_recibida 
    foreign key (servidor_confianza_id)
    references siglas.servidor_confianza (id) ;
alter table siglas.interoperabilidad_enviada add constraint servidor_certificado_a_interoperabilidad_enviada 
    foreign key (servidor_certificado_id)
    references siglas.servidor_certificado (id) ;
alter table siglas.servicios_publicados_confianza add constraint servidor_confianza_a_servicios_publicados_confianza 
    foreign key (servidor_confianza_id)
    references siglas.servidor_confianza (id) ;
alter table siglas.servicios_publicados_confianza add constraint servicios_publicados_a_servicios_publicados_confianza 
    foreign key (servicios_publicados_id)
    references siglas.servicios_publicados (id) ;
alter table siglas.servicios_disponibles add constraint servidor_confianza_a_servicios_disponibles 
    foreign key (servidor_confianza_id)
    references siglas.servidor_confianza (id) ;
alter table siglas.servicios_disponibles_confianza add constraint servicios_disponibles_a_servicios_disponibles_confianza 
    foreign key (servicios_disponibles_id)
    references siglas.servicios_disponibles (id) ;
alter table siglas.interoperabilidad_recibida add constraint interoperabilidad_enviada_a_interoperabilidad_recibida 
    foreign key (interoperabilidad_enviada_id)
    references siglas.interoperabilidad_enviada (id) ;
