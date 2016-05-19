create schema comunicaciones;

create table comunicaciones.notificacion (
   id                      serial      not null,
   funcionario_id integer     not null,
   aplicacion_id           integer     not null,
   forma_entrega           varchar(15) not null,
   metodo_id               integer     not null,
   f_entrega               timestamp   not null,
   parametros              text                ,
   mensaje                 text        not null,
   status                  varchar(1)  not null,
   created_at              timestamp   not null,
   updated_at              timestamp   not null,
   id_update               integer     not null,
   ip_update               varchar(30) not null,
   constraint pk_comunicaciones_notificacion primary key (id)
)   ;
create table comunicaciones.metodo (
   id          serial       not null,
   nombre      varchar(150) not null,
   descripcion text                 ,
   status      varchar(1)   not null,
   created_at  timestamp    not null,
   updated_at  timestamp    not null,
   id_update   integer      not null,
   ip_update   varchar(30)  not null,
   constraint pk_comunicaciones_metodo primary key (id)
)   ;
create table acceso.aplicacion (
   id          serial       not null,
   nombre      varchar(150) not null,
   descripcion text                 ,
   status      varchar(1)   not null,
   created_at  timestamp    not null,
   updated_at  timestamp    not null,
   id_update   integer      not null,
   ip_update   varchar(30)  not null,
   constraint pk_acceso_aplicacion primary key (id)
)   ;


alter table comunicaciones.notificacion add constraint aplicacion_a_notificacion 
    foreign key (aplicacion_id)
    references acceso.aplicacion (id) ;
alter table comunicaciones.notificacion add constraint metodo_a_notificacion 
    foreign key (metodo_id)
    references comunicaciones.metodo (id) ;


SELECT pg_catalog.setval('comunicaciones.metodo_id_seq', 9, true);

INSERT INTO comunicaciones.metodo (id, nombre, descripcion, status, created_at, updated_at, id_update, ip_update) VALUES (1, 'Cambio de grupo correspondencia', NULL, 'A', now(), now(), 0, '0.0.0.0');
INSERT INTO comunicaciones.metodo (id, nombre, descripcion, status, created_at, updated_at, id_update, ip_update) VALUES (2, 'Cambio de grupo archivo', NULL, 'A', now(), now(), 0, '0.0.0.0');
INSERT INTO comunicaciones.metodo (id, nombre, descripcion, status, created_at, updated_at, id_update, ip_update) VALUES (3, 'Cambio de unidad', NULL, 'A', now(), now(), 0, '0.0.0.0');
INSERT INTO comunicaciones.metodo (id, nombre, descripcion, status, created_at, updated_at, id_update, ip_update) VALUES (4, 'Miniforo correspondencia', NULL, 'A', now(), now(), 0, '0.0.0.0');
INSERT INTO comunicaciones.metodo (id, nombre, descripcion, status, created_at, updated_at, id_update, ip_update) VALUES (5, 'Cumpleaño', NULL, 'A', now(), now(), 0, '0.0.0.0');
INSERT INTO comunicaciones.metodo (id, nombre, descripcion, status, created_at, updated_at, id_update, ip_update) VALUES (6, 'Resumen diario', NULL, 'A', now(), now(), 0, '0.0.0.0');
INSERT INTO comunicaciones.metodo (id, nombre, descripcion, status, created_at, updated_at, id_update, ip_update) VALUES (7, 'Edicion correspondencia', NULL, 'A', now(), now(), 0, '0.0.0.0');
INSERT INTO comunicaciones.metodo (id, nombre, descripcion, status, created_at, updated_at, id_update, ip_update) VALUES (8, 'mensaje interno', NULL, 'A', now(), now(), 0, '0.0.0.0');
INSERT INTO comunicaciones.metodo (id, nombre, descripcion, status, created_at, updated_at, id_update, ip_update) VALUES (9, 'mensaje externo', NULL, 'A', now(), now(), 0, '0.0.0.0');


SELECT pg_catalog.setval('acceso.aplicacion_id_seq', 7, true);

INSERT INTO acceso.aplicacion (id, nombre, descripcion, status, created_at, updated_at, id_update, ip_update) VALUES (1, 'Correspondencia', NULL, 'A', now(), now(), 0, '0.0.0.0');
INSERT INTO acceso.aplicacion (id, nombre, descripcion, status, created_at, updated_at, id_update, ip_update) VALUES (2, 'Archivo', NULL, 'A', now(), now(), 0, '0.0.0.0');
INSERT INTO acceso.aplicacion (id, nombre, descripcion, status, created_at, updated_at, id_update, ip_update) VALUES (3, 'RRHH', NULL, 'A', now(), now(), 0, '0.0.0.0');
INSERT INTO acceso.aplicacion (id, nombre, descripcion, status, created_at, updated_at, id_update, ip_update) VALUES (4, 'Proveeduria', NULL, 'A', now(), now(), 0, '0.0.0.0');
INSERT INTO acceso.aplicacion (id, nombre, descripcion, status, created_at, updated_at, id_update, ip_update) VALUES (5, 'Caja de ahorro', NULL, 'A', now(), now(), 0, '0.0.0.0');
INSERT INTO acceso.aplicacion (id, nombre, descripcion, status, created_at, updated_at, id_update, ip_update) VALUES (6, 'Funcionarios', NULL, 'A', now(), now(), 0, '0.0.0.0');
INSERT INTO acceso.aplicacion (id, nombre, descripcion, status, created_at, updated_at, id_update, ip_update) VALUES (7, 'Organigrama', NULL, 'A', now(), now(), 0, '0.0.0.0');

