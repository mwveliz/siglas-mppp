create schema vehiculos;


create table vehiculos.vehiculo (
   id                  serial                      not null,
   tipo_uso_id         integer                     NOT NULL,
   tipo_id             integer                     NOT NULL,
   placa               character varying(50)               ,
   ano                 integer                             ,
   marca               character varying(50)       NOT NULL,
   modelo              character varying(50)       NOT NULL,
   serial_carroceria   character varying(50)               ,
   serial_motor        character varying(50)               ,
   color               character varying(50)               ,
   kilometraje_inicial integer                             ,
   kilometraje_actual  integer                             ,
   vel_max             integer                             ,
   status              varchar(1)                  NOT NULL,
   created_at          timestamp without time zone NOT NULL,
   updated_at          timestamp without time zone NOT NULL,
   id_update           integer                     NOT NULL,
   id_create           integer                     NOT NULL,
   ip_update           character varying(50)       NOT NULL,
   ip_create           character varying(50)       NOT NULL,
   constraint pk_vehiculos_vehiculo primary key (id)
)   ;
create table vehiculos.tipo_uso (
   id          serial                      not null,
   nombre      character varying(50)       NOT NULL,
   descripcion text                                ,
   status      varchar(1)                  NOT NULL,
   created_at  timestamp without time zone NOT NULL,
   updated_at  timestamp without time zone NOT NULL,
   id_update   integer                     NOT NULL,
   id_create   integer                     NOT NULL,
   ip_update   character varying(50)       NOT NULL,
   ip_create   character varying(50)       NOT NULL,
   constraint pk_vehiculos_tipo_uso primary key (id)
)   ;
create table vehiculos.tipo (
   id          serial                      not null,
   nombre      character varying(50)       NOT NULL,
   descripcion text                                ,
   status      varchar(1)                  NOT NULL,
   created_at  timestamp without time zone NOT NULL,
   updated_at  timestamp without time zone NOT NULL,
   id_update   integer                     NOT NULL,
   ip_update   character varying(50)       NOT NULL,
   ip_create   character varying(50)       NOT NULL,
   id_create   integer                     NOT NULL,
   constraint pk_vehiculos_tipo primary key (id)
)   ;
create table vehiculos.conductor_vehiculo (
   id               serial                      not null,
   vehiculo_id      integer                     NOT NULL,
   funcionario_id   integer                     NOT NULL,
   condicion_id     integer                     NOT NULL,
   f_asignacion     timestamp without time zone NOT NULL,
   f_desincorporado timestamp without time zone         ,
   status           varchar(1)                  NOT NULL,
   created_at       timestamp without time zone NOT NULL,
   updated_at       timestamp without time zone NOT NULL,
   id_update        integer                     NOT NULL,
   id_create        integer                     NOT NULL,
   ip_update        character varying(50)       NOT NULL,
   ip_create        character varying(50)       NOT NULL,
   constraint pk_vehiculos_conductor_vehiculo primary key (id)
)   ;
create table vehiculos.condicion (
   id         serial                      not null,
   nombre     character varying(50)       NOT NULL,
   status     varchar(1)                  NOT NULL,
   created_at timestamp without time zone NOT NULL,
   updated_at timestamp without time zone NOT NULL,
   id_update  integer                     NOT NULL,
   id_create  integer                     NOT NULL,
   ip_update  character varying(50)       NOT NULL,
   ip_create  character varying(50)       NOT NULL,
   constraint pk_vehiculos_condicion primary key (id)
)   ;
create table vehiculos.gps (
   id          serial                      not null,
   marca       character varying(50)       NOT NULL,
   modelo      character varying(50)       NOT NULL,
   descripcion text                                ,
   mic         boolean                     NOT NULL,
   cam         boolean                     NOT NULL,
   sd          boolean                     NOT NULL,
   status      varchar(1)                  NOT NULL,
   created_at  timestamp without time zone NOT NULL,
   updated_at  timestamp without time zone NOT NULL,
   id_update   integer                     NOT NULL,
   id_create   integer                     NOT NULL,
   ip_update   character varying(50)       NOT NULL,
   ip_create   character varying(50)       NOT NULL,
   constraint pk_vehiculos_gps primary key (id)
)   ;
create table vehiculos.comando (
   id          serial                      not null,
   comando     character varying(200)      NOT NULL,
   descripcion text                                ,
   gps_id      integer                     NOT NULL,
   status      varchar(1)                  NOT NULL,
   created_at  timestamp without time zone NOT NULL,
   updated_at  timestamp without time zone NOT NULL,
   id_update   integer                     NOT NULL,
   id_create   integer                     NOT NULL,
   ip_update   character varying(50)       NOT NULL,
   ip_create   character varying(50)       NOT NULL,
   constraint pk_vehiculos_comando primary key (id)
)   ;
create table vehiculos.gps_vehiculo (
   id               serial                      not null            ,
   vehiculo_id      integer                     NOT NULL            ,
   gps_id           integer                     NOT NULL            ,
   operador_id      integer                     NOT NULL            ,
   icono            character varying(50)        default 'default.png',
   color_icon       character varying(50)                                     ,
   status           varchar(1)                  NOT NULL            ,
   clave            numeric                     NOT NULL            ,
   imei             numeric                                         ,
   sim              numeric                     NOT NULL            ,
   numero_uno       numeric                                         ,
   numero_dos       numeric                                         ,
   numero_tres      numeric                                         ,
   numero_cuatro    numeric                                         ,
   numero_cinco     numeric                                         ,
   alerta_parametro text                                            ,
   created_at       timestamp without time zone NOT NULL            ,
   updated_at       timestamp without time zone NOT NULL            ,
   id_update        integer                     NOT NULL            ,
   id_create        integer                     NOT NULL            ,
   ip_update        character varying(50)       NOT NULL            ,
   ip_create        character varying(50)       NOT NULL            ,
   constraint pk_vehiculos_gps_vehiculo primary key (id)
)   ;
create table vehiculos.mantenimiento (
   id                    serial                      not null,
   vehiculo_id           integer                     NOT NULL,
   mantenimiento_tipo_id integer                     NOT NULL,
   observacion           text                                ,
   kilometraje           integer                             ,
   fecha                 timestamp without time zone         ,
   status                varchar(1)                  NOT NULL,
   created_at            timestamp without time zone NOT NULL,
   updated_at            timestamp without time zone NOT NULL,
   id_update             integer                     NOT NULL,
   id_create             integer                     NOT NULL,
   ip_update             character varying(50)       NOT NULL,
   ip_create             character varying(50)       NOT NULL,
   constraint pk_vehiculos_mantenimiento primary key (id)
)   ;
create table vehiculos.mantenimiento_tipo (
   id          serial                      not null,
   nombre      character varying(50)       NOT NULL,
   descripcion text                                ,
   icono       character varying(50)               ,
   status      varchar(1)                  NOT NULL,
   created_at  timestamp without time zone NOT NULL,
   updated_at  timestamp without time zone NOT NULL,
   id_update   integer                     NOT NULL,
   id_create   integer                     NOT NULL,
   ip_update   character varying(50)       NOT NULL,
   ip_create   character varying(50)       NOT NULL,
   constraint pk_vehiculos_mantenimiento_tipo primary key (id)
)   ;
create table vehiculos.tracker (
   id              serial                      not null,
   gps_vehiculo_id integer                     NOT NULL,
   f_recibido      timestamp without time zone NOT NULL,
   latitud         character varying(50)       NOT NULL,
   longitud        character varying(50)       NOT NULL,
   velocidad       character varying(50)               ,
   enlace          text                                ,
   fuente          boolean                             ,
   puerta          boolean                             ,
   acc             boolean                             ,
   created_at      timestamp without time zone NOT NULL,
   updated_at      timestamp without time zone NOT NULL,
   id_update       integer                     NOT NULL,
   id_create       integer                     NOT NULL,
   ip_update       character varying(50)       NOT NULL,
   ip_create       character varying(50)       NOT NULL,
   constraint pk_vehiculos_tracker primary key (id)
)   ;

create table vehiculos.conductor (
   id             serial                      not null,
   funcionario_id integer                     NOT NULL,
   status         varchar(1)                  NOT NULL,
   created_at     timestamp without time zone NOT NULL,
   updated_at     timestamp without time zone NOT NULL,
   id_update      integer                     NOT NULL,
   id_create      integer                     NOT NULL,
   ip_update      character varying(50)       NOT NULL,
   ip_create      character varying(50)       NOT NULL,
   constraint pk_vehiculos_conductor primary key (id)
)   ;
create table vehiculos.gps_vehiculo_alerta (
   id              serial                      not null,
   gps_vehiculo_id integer                     NOT NULL,
   comando         character varying(50)                 NOT NULL,
   sim             numeric                     NOT NULL,
   latitud         character varying(50)                 NOT NULL,
   longitud        character varying(50)                 NOT NULL,
   velocidad       character varying(50)               ,
   enlace          text                                ,
   status          varchar(1)                  NOT NULL,
   fecha_gps       timestamp without time zone NOT NULL,
   fecha_gammu     timestamp without time zone NOT NULL,
   created_at      timestamp without time zone NOT NULL,
   updated_at      timestamp without time zone NOT NULL,
   id_update       integer                     NOT NULL,
   id_create       integer                     NOT NULL,
   ip_update       character varying(50)       NOT NULL,
   ip_create       character varying(50)       NOT NULL,
   constraint pk_vehiculos_gps_vehiculo_alerta primary key (id)
)   ;

create table comunicaciones.operador (
   id         serial                      not null,
   nombre     character varying(50)       NOT NULL,
   apn        character varying(50)               ,
   status     varchar(1)                  NOT NULL,
   created_at timestamp without time zone NOT NULL,
   updated_at timestamp without time zone NOT NULL,
   id_update  integer                     NOT NULL,
   id_create  integer                     NOT NULL,
   ip_update  character varying(50)       NOT NULL,
   ip_create  character varying(50)       NOT NULL,
   constraint pk_comunicaciones_operador primary key (id)
)   ;



alter table vehiculos.conductor_vehiculo add constraint vehiculo_a_conductor_vehiculo 
    foreign key (vehiculo_id)
    references vehiculos.vehiculo (id) ;
alter table vehiculos.vehiculo add constraint tipo_uso_a_vehiculo 
    foreign key (tipo_uso_id)
    references vehiculos.tipo_uso (id) ;
alter table vehiculos.vehiculo add constraint tipo_a_vehiculo 
    foreign key (tipo_id)
    references vehiculos.tipo (id) ;
alter table vehiculos.conductor_vehiculo add constraint condicion_a_conductor_vehiculo 
    foreign key (condicion_id)
    references vehiculos.condicion (id) ;
alter table vehiculos.gps_vehiculo add constraint gps_a_gps_vehiculo 
    foreign key (gps_id)
    references vehiculos.gps (id) ;
alter table vehiculos.tracker add constraint gps_vehiculo_a_tracker 
    foreign key (gps_vehiculo_id)
    references vehiculos.gps_vehiculo (id) ;
alter table vehiculos.comando add constraint gps_a_comando 
    foreign key (gps_id)
    references vehiculos.gps (id) ;
alter table vehiculos.gps_vehiculo add constraint operador_a_gps_vehiculo 
    foreign key (operador_id)
    references comunicaciones.operador (id) ;
alter table vehiculos.gps_vehiculo add constraint vehiculo_a_gps_vehiculo 
    foreign key (vehiculo_id)
    references vehiculos.vehiculo (id) ;
alter table vehiculos.mantenimiento add constraint vehiculo_a_mantenimiento 
    foreign key (vehiculo_id)
    references vehiculos.vehiculo (id) ;
alter table vehiculos.mantenimiento add constraint mantenimiento_a_mantenimiento_tipo 
    foreign key (mantenimiento_tipo_id)
    references vehiculos.mantenimiento_tipo (id) ;
alter table vehiculos.conductor_vehiculo add constraint funcionario_a_conductor_vehiculo 
    foreign key (funcionario_id)
    references funcionarios.funcionario (id) ;
alter table vehiculos.conductor add constraint funcionario_a_conductor 
    foreign key (funcionario_id)
    references funcionarios.funcionario (id) ;
alter table vehiculos.gps_vehiculo_alerta add constraint gps_vehiculo_a_gps_vehiculo_alerta 
    foreign key (gps_vehiculo_id)
    references vehiculos.gps_vehiculo (id) ;
