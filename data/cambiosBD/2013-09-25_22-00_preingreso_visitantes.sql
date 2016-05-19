ALTER TABLE seguridad.ingreso ADD COLUMN status character varying(1) NOT NULL;
ALTER TABLE seguridad.ingreso ADD COLUMN preingreso_id integer;
ALTER TABLE seguridad.ingreso ADD COLUMN registrador_id integer;
ALTER TABLE seguridad.ingreso ADD COLUMN despachador_id integer;
ALTER TABLE seguridad.ingreso DROP COLUMN persona_visita;
ALTER TABLE seguridad.ingreso_equipo ADD COLUMN id_create integer NOT NULL;

create table seguridad.preingreso (
   id                serial                      not null          ,
   unidad_id         integer                     NOT NULL          ,
   funcionario_id    integer                                       ,
   f_ingreso_posible_inicio timestamp without time zone NOT NULL          ,
   f_ingreso_posible_final  timestamp without time zone NOT NULL          ,
   motivo_id         integer                     NOT NULL          ,
   motivo_visita     text                        NOT NULL          ,
   status            varchar(1)                  NOT NULL          ,
   created_at        timestamp without time zone NOT NULL          ,
   updated_at        timestamp without time zone NOT NULL          ,
   id_create         integer                     NOT NULL,
   id_update         integer                     NOT NULL          ,
   ip_update         character varying(50)       NOT NULL          ,
   constraint pk_seguridad_preingreso primary key (id)
)   ;

alter table seguridad.ingreso add constraint preingreso_a_ingreso 
    foreign key (preingreso_id)
    references seguridad.preingreso (id) ;
alter table seguridad.preingreso add constraint unidad_a_preingreso 
    foreign key (unidad_id)
    references organigrama.unidad (id) ;
alter table seguridad.preingreso add constraint funcionario_a_preingreso 
    foreign key (funcionario_id)
    references funcionarios.funcionario (id) ;
alter table seguridad.preingreso add constraint motivo_a_preingreso 
    foreign key (motivo_id)
    references seguridad.motivo (id) ;