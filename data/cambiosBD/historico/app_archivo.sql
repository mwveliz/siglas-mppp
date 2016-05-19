create schema archivo;

create table archivo.documento (
   id                      serial              not null,
   unidad_id               integer                     ,
   expediente_id           integer                     ,
   correspondencia_id      integer                     ,
   correlativo             varchar(255) UNIQUE not null,
   unidad_correlativos_id  integer                     ,
   tipologia_documental_id integer             not null,
   copia_fisica            boolean             not null,
   copia_digital           boolean             not null,
   contenido_automatico    text                        ,
   ruta                    text                        ,
   nombre_original         text                        ,
   tipo_archivo            varchar(50)                 ,
   usuario_validador_id    integer             not null,
   status                  varchar(1)          not null,
   created_at              timestamp           not null,
   updated_at              timestamp           not null,
   id_update               integer             not null,
   ip_update               text                not null,
   constraint pk_archivo_documento primary key (id)
)   ;
create table archivo.expediente (
   id                     serial              not null,
   padre_id               integer                     ,
   correlativo            varchar(255) UNIQUE not null,
   unidad_id              integer             not null,
   expediente_modelo_id   integer             not null,
   unidad_correlativos_id integer                     ,
   estante_id             integer                     ,
   tramo                  integer                     ,
   caja_id                integer                     ,
   serie_documental_id    integer             not null,
   porcentaje_ocupado     integer             not null,
   status                 varchar(1)          not null,
   created_at             timestamp           not null,
   updated_at             timestamp           not null,
   id_update              integer             not null,
   ip_update              text                not null,
   constraint pk_archivo_expediente primary key (id)
)   ;
create table archivo.estante (
   id                 serial       not null,
   estante_modelo_id  integer      not null,
   unidad_duena_id    integer      not null,
   unidad_fisica_id   integer      not null,
   identificador      varchar(255) not null,
   tramos             integer      not null,
   alto_tramos        integer      not null,
   ancho_tramos       integer      not null,
   largo_tramos       integer      not null,
   porcentaje_ocupado integer      not null,
   detalles_ubicacion_fisica text          ,
   created_at         timestamp    not null,
   updated_at         timestamp    not null,
   id_update          integer      not null,
   constraint pk_archivo_estante primary key (id)
)   ;
create table archivo.estante_modelo (
   id         serial       not null,
   nombre     varchar(255) not null,
   created_at timestamp    not null,
   updated_at timestamp    not null,
   id_update  integer      not null,
   constraint pk_archivo_estante_modelo primary key (id)
)   ;
create table archivo.tipologia_documental (
   id                   serial       not null,
   serie_documental_id  integer              ,
   cuerpo_documental_id integer              ,
   nombre               varchar(255) not null,
   created_at           timestamp    not null,
   updated_at           timestamp    not null,
   id_update            integer      not null,
   constraint pk_archivo_tipologia_documental primary key (id)
)   ;
create table archivo.serie_documental (
   id         serial       not null,
   unidad_id  integer      not null,
   nombre     varchar(255) not null,
   created_at timestamp    not null,
   updated_at timestamp    not null,
   id_update  integer      not null,
   constraint pk_archivo_serie_documental primary key (id)
)   ;
create table archivo.caja (
   id                     serial              not null,
   estante_id             integer             not null,
   caja_modelo_id         integer             not null,
   correlativo            varchar(255) UNIQUE not null,
   unidad_correlativos_id integer                     ,
   tramo                  integer                     ,
   porcentaje_ocupado     integer             not null,
   created_at             timestamp           not null,
   updated_at             timestamp           not null,
   id_update              integer             not null,
   constraint pk_archivo_caja primary key (id)
)   ;

create table archivo.unidad_correlativos (
   id                        serial    not null,
   unidad_id                 integer           ,
   secuencia_caja            integer   not null,
   secuencia_expediente      integer   not null,
   secuencia_anexo_documento integer   not null,
   created_at                timestamp not null,
   updated_at                timestamp not null,
   id_update                 integer   not null,
   constraint pk_archivo_unidad_correlativos primary key (id)
)   ;
create table archivo.clasificador (
   id                  serial       not null,
   serie_documental_id integer      not null,
   nombre              varchar(255) not null,
   tipo_dato           varchar(255) not null,
   parametros          text                 ,
   vacio               boolean      not null,
   orden               integer      not null,
   created_at          timestamp    not null,
   updated_at          timestamp    not null,
   id_update           integer      not null,
   constraint pk_archivo_clasificador primary key (id)
)   ;
create table archivo.expediente_clasificador (
   id              serial       not null,
   expediente_id   integer      not null,
   clasificador_id integer      not null,
   valor           varchar(255) not null,
   created_at      timestamp    not null,
   updated_at      timestamp    not null,
   id_update       integer      not null,
   constraint pk_archivo_expediente_clasificador primary key (id)
)   ;
create table archivo.documento_etiqueta (
   id           serial       not null,
   documento_id integer      not null,
   etiqueta_id  integer      not null,
   valor        varchar(255) not null,
   created_at   timestamp    not null,
   updated_at   timestamp    not null,
   id_update    integer      not null,
   constraint pk_archivo_documento_etiqueta primary key (id)
)   ;
create table archivo.etiqueta (
   id                      serial       not null,
   tipologia_documental_id integer      not null,
   nombre                  varchar(255) not null,
   tipo_dato               varchar(255)         ,
   parametros              text                 ,
   vacio                   boolean      not null,
   orden                   integer      not null,
   created_at              timestamp    not null,
   updated_at              timestamp    not null,
   id_update               integer      not null,
   constraint pk_archivo_etiqueta primary key (id)
)   ;
create table archivo.cuerpo_documental (
   id                  serial       not null,
   padre_id            integer              ,
   serie_documental_id integer      not null,
   nombre              varchar(255) not null,
   created_at          timestamp    not null,
   updated_at          timestamp    not null,
   id_update           integer      not null,
   constraint pk_archivo_cuerpo_documental primary key (id)
)   ;
create table archivo.expediente_modelo (
   id         serial       not null,
   nombre     varchar(255) not null,
   alto       integer      not null,
   ancho      integer      not null,
   largo      integer      not null,
   foto       text         not null,
   created_at timestamp    not null,
   updated_at timestamp    not null,
   id_update  integer      not null,
   constraint pk_archivo_expediente_modelo primary key (id)
)   ;
create table archivo.caja_modelo (
   id         serial       not null,
   nombre     varchar(255) not null,
   alto       integer      not null,
   ancho      integer      not null,
   largo      integer      not null,
   foto       text         not null,
   created_at timestamp    not null,
   updated_at timestamp    not null,
   id_update  integer      not null,
   constraint pk_archivo_caja_modelo primary key (id)
)   ;
create table archivo.prestamo_archivo (
   id                            serial       not null,
   correspondencia_solicitud_id  integer              ,
   unidad_id                     integer      not null,
   funcionario_id                integer      not null,
   expediente_id                 integer      not null,
   documentos_ids                text         not null,
   f_expiracion                  date         not null,
   f_entrega_fisico              timestamp            ,
   receptor_entrega_fisico_id    integer              ,
   codigo_prestamo_fisico        varchar(255)         ,--  	
   reentrega_fisico              boolean              ,
   f_devolucion_fisico           timestamp            ,
   receptor_devolucion_fisico_id integer              ,
   digital                       boolean      not null,
   fisico                        boolean      not null,
   status                        varchar(1)   not null,
   created_at                    timestamp    not null,
   updated_at                    timestamp    not null,
   id_update                     integer      not null,
   ip_update                     varchar(50)  not null,
   constraint pk_archivo_prestamo_archivo primary key (id)
)   ;

create table archivo.funcionario_unidad (
   id                    serial     not null,
   autorizada_unidad_id  integer    not null,
   funcionario_id        integer    not null,
   dependencia_unidad_id integer    not null,
   leer                  boolean            ,
   archivar              boolean            ,
   prestar               boolean            ,
   administrar           boolean            ,
   anular                boolean            ,
   status                varchar(1) not null,
   created_at            timestamp  not null,
   updated_at            timestamp  not null,
   deleted_at            timestamp          ,
   id_update             integer    not null,
   ip_update             text       not null,
   constraint pk_archivo_funcionario_unidad primary key (id)
)   ;
create table archivo.almacenamiento (
   id                  serial       not null,
   estante_id          integer      not null,
   serie_documental_id integer      not null,
   tramos              varchar(255) not null,
   created_at          timestamp    not null,
   updated_at          timestamp    not null,
   id_update           integer      not null,
   constraint pk_archivo_almacenamiento primary key (id)
)   ;


alter table archivo.documento add constraint expediente_a_documento 
    foreign key (expediente_id)
    references archivo.expediente (id) ;
alter table archivo.expediente add constraint estante_a_expediente 
    foreign key (estante_id)
    references archivo.estante (id) ;
alter table archivo.expediente add constraint caja_a_expediente 
    foreign key (caja_id)
    references archivo.caja (id) ;
alter table archivo.caja add constraint estante_a_tramo 
    foreign key (estante_id)
    references archivo.estante (id) ;
alter table archivo.documento add constraint unidad_a_anexo_documento 
    foreign key (unidad_id)
    references organigrama.unidad (id) ;
alter table archivo.estante add constraint unidad_duena_a_estante 
    foreign key (unidad_duena_id)
    references organigrama.unidad (id) ;
alter table archivo.estante add constraint unidad_fisica_a_estante 
    foreign key (unidad_duena_id)
    references organigrama.unidad (id) ;
alter table archivo.expediente add constraint expediente_padre_a_expediente_hijo 
    foreign key (padre_id)
    references archivo.expediente (id) ;
alter table archivo.caja add constraint unidad_correlativos_a_caja 
    foreign key (unidad_correlativos_id)
    references archivo.unidad_correlativos (id) ;
alter table archivo.expediente add constraint unidad_correlativos_a_expediente 
    foreign key (unidad_correlativos_id)
    references archivo.unidad_correlativos (id) ;
alter table archivo.documento add constraint unidad_correlativos_a_documento 
    foreign key (unidad_correlativos_id)
    references archivo.unidad_correlativos (id) ;
alter table archivo.documento add constraint tipologia_documental_a_documento 
    foreign key (tipologia_documental_id)
    references archivo.tipologia_documental (id) ;
alter table archivo.tipologia_documental add constraint serie_documental_a_tipologia_documental 
    foreign key (serie_documental_id)
    references archivo.serie_documental (id) ;
alter table archivo.serie_documental add constraint unidad_a_serie_documental 
    foreign key (unidad_id)
    references organigrama.unidad (id) ;
alter table archivo.expediente add constraint serie_documental_a_expediente 
    foreign key (serie_documental_id)
    references archivo.serie_documental (id) ;
alter table archivo.clasificador add constraint serie_documental_a_etiqueta 
    foreign key (serie_documental_id)
    references archivo.serie_documental (id) ;
alter table archivo.expediente_clasificador add constraint etiqueta_a_expediente_clasificador 
    foreign key (clasificador_id)
    references archivo.clasificador (id) ;
alter table archivo.expediente_clasificador add constraint expediente_a_expediente_clasificador 
    foreign key (expediente_id)
    references archivo.expediente (id) ;
alter table archivo.documento_etiqueta add constraint documento_a_documento_etiqueta 
    foreign key (documento_id)
    references archivo.documento (id) ;
alter table archivo.documento_etiqueta add constraint etiqueta_a_documento_etiqueta 
    foreign key (etiqueta_id)
    references archivo.etiqueta (id) ;
alter table archivo.etiqueta add constraint tipologia_documental_a_etiqueta 
    foreign key (tipologia_documental_id)
    references archivo.tipologia_documental (id) ;
alter table archivo.tipologia_documental add constraint cuerpo_documental_a_tipologia_documental 
    foreign key (cuerpo_documental_id)
    references archivo.cuerpo_documental (id) ;
alter table archivo.cuerpo_documental add constraint serie_documental_a_cuerpo_documental 
    foreign key (serie_documental_id)
    references archivo.serie_documental (id) ;
alter table archivo.cuerpo_documental add constraint cuerpo_documental_a_cuerpo_documental 
    foreign key (padre_id)
    references archivo.cuerpo_documental (id) ;
alter table archivo.expediente add constraint unidad_a_expediente 
    foreign key (unidad_id)
    references organigrama.unidad (id) ;
alter table archivo.expediente add constraint expediente_modelo_a_expediente 
    foreign key (expediente_modelo_id)
    references archivo.expediente_modelo (id) ;
alter table archivo.caja add constraint caja_modelo_a_caja 
    foreign key (caja_modelo_id)
    references archivo.caja_modelo (id) ;
alter table archivo.prestamo_archivo add constraint expediente_a_prestamo_archivo 
    foreign key (expediente_id)
    references archivo.expediente (id) ;
alter table archivo.prestamo_archivo add constraint funcionario_a_prestamo_archivo 
    foreign key (funcionario_id)
    references funcionarios.funcionario (id) ;
alter table archivo.prestamo_archivo add constraint unidad_a_prestamo_archivo 
    foreign key (unidad_id)
    references organigrama.unidad (id) ;
alter table archivo.funcionario_unidad add constraint autorizada_unidad_a_archivo_funcionario_unidad 
    foreign key (autorizada_unidad_id)
    references organigrama.unidad (id) ;
alter table archivo.funcionario_unidad add constraint dependencia_unidad_a_archivo_funcionario_unidad 
    foreign key (dependencia_unidad_id)
    references organigrama.unidad (id) ;
alter table archivo.funcionario_unidad add constraint funcionario_a_archivo_funcionario_unidad 
    foreign key (funcionario_id)
    references funcionarios.funcionario (id) ;
alter table archivo.almacenamiento add constraint estante_a_almacenamiento 
    foreign key (estante_id)
    references archivo.estante (id) ;
alter table archivo.almacenamiento add constraint serie_documental_a_almacenamiento 
    foreign key (serie_documental_id)
    references archivo.serie_documental (id) ;
alter table archivo.documento add constraint correspondencia_a_documento 
    foreign key (correspondencia_id)
    references correspondencia.correspondencia (id) ;
alter table archivo.estante add constraint estante_modelo_a_estante 
    foreign key (estante_modelo_id)
    references archivo.estante_modelo (id) ;
alter table archivo.prestamo_archivo add constraint funcionario_a_archivo_receptor_entrega_fisico 
    foreign key (receptor_entrega_fisico_id)
    references funcionarios.funcionario (id) ;
alter table archivo.prestamo_archivo add constraint funcionario_a_archivo_receptor_devolucion_fisico 
    foreign key (receptor_devolucion_fisico_id)
    references funcionarios.funcionario (id) ;
