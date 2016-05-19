create table public.sitio (
   id            serial                      not null     ,
   sitio_tipo_id integer                     NOT NULL     ,
   latitud       character varying(50)                     ,
   longitud      character varying(50)                    ,
   nombre        character varying(50)                    ,
   status        varchar(1)                  NOT NULL     ,
   direccion     text                                     ,
   mostrar       boolean                      default TRUE,
   color         character varying(50)                    ,
   created_at    timestamp without time zone      NOT NULL,
   updated_at    timestamp without time zone      NOT NULL,
   id_update     integer                          NOT NULL,
   id_create     integer                          NOT NULL,
   ip_update     character varying(50)            NOT NULL,
   ip_create     character varying(50)            NOT NULL,
   constraint pk_public_sitio primary key (id)
)   ;
create table public.sitio_tipo (
   id         serial                      not null,
   nombre     character varying(50)       NOT NULL,
   icono      character varying(50)               ,
   status     varchar(1)                  NOT NULL,
   created_at timestamp without time zone NOT NULL,
   updated_at timestamp without time zone NOT NULL,
   id_update  integer                     NOT NULL,
   id_create  integer                     NOT NULL,
   ip_update  character varying(50)       NOT NULL,
   ip_create  character varying(50)       NOT NULL,
   constraint pk_public_sitio_tipo primary key (id)
)   ;

alter table public.sitio add constraint sitio_tipo_a_sitio 
    foreign key (sitio_tipo_id)
    references public.sitio_tipo (id) ;

INSERT INTO sitio_tipo (id, nombre, icono, status, created_at, updated_at, id_update, id_create, ip_update, ip_create) VALUES (1, 'Sitio', 'red/site.png', 'A', now(), now(), 1, 1, '127.1.1.1', '127.1.1.1');
INSERT INTO sitio_tipo (id, nombre, icono, status, created_at, updated_at, id_update, id_create, ip_update, ip_create) VALUES (2, 'Aeropuerto', 'red/airport.png', 'A', now(), now(), 1, 1, '127.1.1.1', '127.1.1.1');
INSERT INTO sitio_tipo (id, nombre, icono, status, created_at, updated_at, id_update, id_create, ip_update, ip_create) VALUES (3, 'Parada de Bus', 'red/busstop.png', 'A', now(), now(), 1, 1, '127.1.1.1', '127.1.1.1');
INSERT INTO sitio_tipo (id, nombre, icono, status, created_at, updated_at, id_update, id_create, ip_update, ip_create) VALUES (4, 'Cable tren', 'red/cablecar.png', 'A', now(), now(), 1, 1, '127.1.1.1', '127.1.1.1');
INSERT INTO sitio_tipo (id, nombre, icono, status, created_at, updated_at, id_update, id_create, ip_update, ip_create) VALUES (5, 'Auto lavado', 'red/carwash.png', 'A', now(), now(), 1, 1, '127.1.1.1', '127.1.1.1');
INSERT INTO sitio_tipo (id, nombre, icono, status, created_at, updated_at, id_update, id_create, ip_update, ip_create) VALUES (6, 'Peligro', 'red/caution.png', 'A', now(), now(), 1, 1, '127.1.1.1', '127.1.1.1');
INSERT INTO sitio_tipo (id, nombre, icono, status, created_at, updated_at, id_update, id_create, ip_update, ip_create) VALUES (7, 'Circuito cerrado', 'red/cctv.png', 'A', now(), now(), 1, 1, '127.1.1.1', '127.1.1.1');
INSERT INTO sitio_tipo (id, nombre, icono, status, created_at, updated_at, id_update, id_create, ip_update, ip_create) VALUES (8, 'Construccion', 'red/construction.png', 'A', now(), now(), 1, 1, '127.1.1.1', '127.1.1.1');
INSERT INTO sitio_tipo (id, nombre, icono, status, created_at, updated_at, id_update, id_create, ip_update, ip_create) VALUES (9, 'Gasolinera', 'red/fillingstation.png', 'A', now(), now(), 1, 1, '127.1.1.1', '127.1.1.1');
INSERT INTO sitio_tipo (id, nombre, icono, status, created_at, updated_at, id_update, id_create, ip_update, ip_create) VALUES (10, 'Puerto', 'red/harbor.png', 'A', now(), now(), 1, 1, '127.1.1.1', '127.1.1.1');
INSERT INTO sitio_tipo (id, nombre, icono, status, created_at, updated_at, id_update, id_create, ip_update, ip_create) VALUES (12, 'Autopista', 'red/highway.png', 'A', now(), now(), 1, 1, '127.1.1.1', '127.1.1.1');
INSERT INTO sitio_tipo (id, nombre, icono, status, created_at, updated_at, id_update, id_create, ip_update, ip_create) VALUES (13, 'Parking', 'red/parkinggarage.png', 'A', now(), now(), 1, 1, '127.1.1.1', '127.1.1.1');
INSERT INTO sitio_tipo (id, nombre, icono, status, created_at, updated_at, id_update, id_create, ip_update, ip_create) VALUES (14, 'Taller', 'red/repair.png', 'A', now(), now(), 1, 1, '127.1.1.1', '127.1.1.1');
INSERT INTO sitio_tipo (id, nombre, icono, status, created_at, updated_at, id_update, id_create, ip_update, ip_create) VALUES (15, 'Cauchera', 'red/tires.png', 'A', now(), now(), 1, 1, '127.1.1.1', '127.1.1.1');
INSERT INTO sitio_tipo (id, nombre, icono, status, created_at, updated_at, id_update, id_create, ip_update, ip_create) VALUES (16, 'Tunel', 'red/tunnel.png', 'A', now(), now(), 1, 1, '127.1.1.1', '127.1.1.1');

SELECT pg_catalog.setval('sitio_tipo_id_seq', 17, false);

