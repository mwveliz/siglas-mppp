ALTER TABLE seguridad.ingreso RENAME COLUMN n_pase TO llave_ingreso_id;
ALTER TABLE seguridad.persona RENAME COLUMN fecha_nac TO f_nacimiento;

create table seguridad.alerta_visitante (
   id          serial                      not null,
   ci          numeric (10,0)              NOT NULL,
   descripcion text                        NOT NULL,
   status      varchar(1)                  NOT NULL,
   created_at  timestamp without time zone NOT NULL,
   updated_at  timestamp without time zone NOT NULL,
   id_create   integer                     NOT NULL,
   id_update   integer                     NOT NULL,
   ip_update   character varying(50)       NOT NULL,
   constraint pk_seguridad_alerta_visitante primary key (id)
)   ;
create table seguridad.llave_ingreso (
   id         serial                      not null,
   n_pase     integer                     NOT NULL,
   rfid       text                                ,
   status     varchar(1)                  NOT NULL,
   created_at timestamp without time zone NOT NULL,
   updated_at timestamp without time zone NOT NULL,
   id_update  integer                     NOT NULL,
   ip_update  character varying(50)       NOT NULL,
   constraint pk_seguridad_llave_ingreso primary key (id)
)   ;

alter table seguridad.ingreso add constraint llave_ingreso_a_ingreso 
    foreign key (llave_ingreso_id)
    references seguridad.llave_ingreso (id) ;