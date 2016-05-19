create schema inventario;
create schema proveedores;


create table inventario.almacen (
   id         serial      not null,
   unidad_id  integer     not null,
   status     varchar(1)  not null,
   created_at timestamp   not null,
   updated_at timestamp   not null,
   id_update  integer     not null,
   ip_update  varchar(50) not null,
   constraint pk_inventario_almacen primary key (id)
)   ;
create table inventario.inventario (
   id                  serial           not null,
   almacen_id          integer          not null,
   articulo_id         integer          not null,
   articulo_ingreso_id integer          not null,
   cantidad_inicial    double precision not null,
   cantidad_actual     double precision not null,
   status              varchar(1)       not null,
   created_at          timestamp        not null,
   updated_at          timestamp        not null,
   id_update           integer          not null,
   ip_update           varchar(50)      not null,
   constraint pk_inventario_inventario primary key (id)
)   ;
create table inventario.articulo (
   id               serial           not null,
   unidad_medida_id integer          not null,
   codigo           varchar(50)      not null,
   nombre           varchar(255)     not null,
   stop             double precision not null,
   status           varchar(1)       not null,
   created_at       timestamp        not null,
   updated_at       timestamp        not null,
   id_update        integer          not null,
   ip_update        varchar(50)      not null,
   constraint pk_inventario_articulo primary key (id)
)   ;
create table proveedores.proveedor (
   id              serial       not null,
   tipo_empresa_id integer      not null,
   rif             varchar(50)  not null,
   razon_social    varchar(255) not null,
   status          varchar(1)   not null,
   created_at      timestamp    not null,
   updated_at      timestamp    not null,
   id_update       integer      not null,
   ip_update       varchar(50)  not null,
   constraint pk_proveedores_proveedor primary key (id)
)   ;
create table inventario.articulo_egreso (
   id                            serial           not null,
   correspondencia_solicitud_id  integer          not null,
   correspondencia_aprobacion_id integer          not null,
   unidad_id                     integer          not null,
   inventario_id                 integer          not null,
   articulo_id                   integer          not null,
   cantidad                      double precision not null,
   f_egreso                      date                     ,
   status                        varchar(1)       not null,
   created_at                    timestamp        not null,
   updated_at                    timestamp        not null,
   id_update                     integer          not null,
   ip_update                     varchar(50)      not null,
   constraint pk_inventario_articulo_egreso primary key (id)
)   ;
create table inventario.articulo_ingreso (
   id           serial      not null,
   proveedor_id integer     not null,
   f_ingreso    date        not null,
   status       varchar(1)  not null,
   created_at   timestamp   not null,
   updated_at   timestamp   not null,
   id_update    integer     not null,
   ip_update    varchar(50) not null,
   constraint pk_inventario_articulo_ingreso primary key (id)
)   ;
create table proveedores.tipo_empresa (
   id         serial       not null,
   nombre     varchar(255) not null,
   status     varchar(1)   not null,
   created_at timestamp    not null,
   updated_at timestamp    not null,
   id_update  integer      not null,
   ip_update  varchar(50)  not null,
   constraint pk_proveedores_tipo_empresa primary key (id)
)   ;
create table inventario.unidad_medida (
   id         serial       not null,
   nombre     varchar(255) not null,
   status     varchar(1)   not null,
   created_at timestamp    not null,
   updated_at timestamp    not null,
   id_update  integer      not null,
   constraint pk_inventario_unidad_medida primary key (id)
)   ;


alter table inventario.inventario add constraint alamacen_a_inventario 
    foreign key (almacen_id)
    references inventario.almacen (id) ;
alter table inventario.inventario add constraint articulo_a_inventario 
    foreign key (articulo_id)
    references inventario.articulo (id) ;
alter table inventario.inventario add constraint articulo_ingreso_a_inventario 
    foreign key (articulo_ingreso_id)
    references inventario.articulo_ingreso (id) ;
alter table inventario.articulo_ingreso add constraint proveedor_a_articulo_ingreso 
    foreign key (proveedor_id)
    references proveedores.proveedor (id) ;
alter table proveedores.proveedor add constraint tipo_empresa_a_proveedor 
    foreign key (tipo_empresa_id)
    references proveedores.tipo_empresa (id) ;
alter table inventario.articulo_egreso add constraint inventario_a_articulo_egreso 
    foreign key (inventario_id)
    references inventario.inventario (id) ;
alter table inventario.articulo add constraint unidad_medida_a_articulo 
    foreign key (unidad_medida_id)
    references inventario.unidad_medida (id) ;
alter table inventario.almacen add constraint unidad_a_almacen 
    foreign key (unidad_id)
    references organigrama.unidad (id) ;
alter table inventario.articulo_egreso add constraint correspondencia_a_articulo_egreso_solicitud
    foreign key (correspondencia_solicitud_id)
    references correspondencia.correspondencia (id) ;
alter table inventario.articulo_egreso add constraint correspondencia_a_articulo_egreso_aprobacion
    foreign key (correspondencia_aprobacion_id)
    references correspondencia.correspondencia (id) ;