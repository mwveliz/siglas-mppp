create table seguridad.carnet_diseno (
   id             serial      not null,
   carnet_tipo_id integer     NOT NULL,
   descripcion    text        NOT NULL,
   imagen_fondo   text        NOT NULL,
   parametros     text        NOT NULL,
   status         varchar(1)  NOT NULL,
   created_at     timestamp   NOT NULL,
   updated_at     timestamp   NOT NULL,
   id_create      integer     NOT NULL,
   id_update      integer             ,
   ip_update      varchar(50) NOT NULL,
   constraint pk_seguridad_carnet_diseno primary key (id)
)   ;
create table seguridad.carnet_tipo (
   id         serial       not null,
   nombre     varchar(255) NOT NULL,
   status     varchar(1)   NOT NULL,
   created_at timestamp    NOT NULL,
   updated_at timestamp    NOT NULL,
   id_create  integer      NOT NULL,
   id_update  integer              ,
   ip_update  varchar(50)  NOT NULL,
   constraint pk_seguridad_carnet_tipo primary key (id)
)   ;

alter table seguridad.carnet_diseno add constraint carnet_tipo_a_carnet_diseno 
    foreign key (carnet_tipo_id)
    references seguridad.carnet_tipo (id) ;



INSERT INTO seguridad.carnet_tipo(id, nombre, status, created_at, updated_at, id_create, id_update, ip_update)
VALUES (1000, 'Carnet de funcionarios', 'A', now(), now(), 0, 0, '0.0.0.0');

INSERT INTO seguridad.carnet_tipo(id, nombre, status, created_at, updated_at, id_create, id_update, ip_update)
VALUES (1001, 'Carnet de visitantes', 'A', now(), now(), 0, 0, '0.0.0.0');

INSERT INTO seguridad.carnet_tipo(id, nombre, status, created_at, updated_at, id_create, id_update, ip_update)
VALUES (1002, 'Carnet dinamico', 'A', now(), now(), 0, 0, '0.0.0.0');

