ALTER TABLE correspondencia.correspondencia ADD COLUMN interoperabilidad_enviada_id integer;
ALTER TABLE correspondencia.correspondencia ADD COLUMN interoperabilidad_recibida_id integer;

alter table correspondencia.correspondencia add constraint interoperabilidad_enviada_a_correspondencia
    foreign key (interoperabilidad_enviada_id)
    references siglas.interoperabilidad_enviada (id) ;

alter table correspondencia.correspondencia add constraint interoperabilidad_recibida_a_correspondencia
    foreign key (interoperabilidad_recibida_id)
    references siglas.interoperabilidad_recibida (id) ;
