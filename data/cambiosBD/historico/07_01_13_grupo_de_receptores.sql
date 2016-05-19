CREATE TABLE correspondencia.grupo_receptor
(
  id serial NOT NULL,
  nombre character varying(50) NOT NULL,
  unidad_duena_id integer NOT NULL,
  cargo_receptor_id integer NOT NULL,
  unidad_receptor_id integer NOT NULL,
  grupo_id integer NOT NULL,
  CONSTRAINT pk_grupo_receptor PRIMARY KEY (id ),
  CONSTRAINT cargo_a_cargo_receptor_id FOREIGN KEY (cargo_receptor_id)
      REFERENCES organigrama.cargo (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT unidad_a_unidad_duena_id FOREIGN KEY (unidad_duena_id)
      REFERENCES organigrama.unidad (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT unidad_a_unidad_receptor_id FOREIGN KEY (unidad_receptor_id)
      REFERENCES organigrama.unidad (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);
