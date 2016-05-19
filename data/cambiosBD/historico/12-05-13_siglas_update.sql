create schema siglas;

create table siglas.actualizacion_svn (
   id              serial      not null,
   f_actualizacion timestamp   not null,
   version_siglas  varchar(30) not null,
   revision_svn    varchar(30) not null,
   log_cambios     text        not null,
   created_at      timestamp   not null,
   updated_at      timestamp   not null,
   id_update       integer     not null,
   ip_update       varchar(30) not null,
   constraint pk_siglas_actualizacion_svn primary key (id)
)   ;
create table siglas.actualizacion_sql (
   id              serial       not null,
   f_actualizacion timestamp    not null,
   archivo         varchar(500) not null,
   detalles_sql    text         not null,
   created_at      timestamp    not null,
   updated_at      timestamp    not null,
   id_update       integer      not null,
   ip_update       varchar(30)  not null,
   constraint pk_siglas_actualizacion_sql primary key (id)
)   ;
