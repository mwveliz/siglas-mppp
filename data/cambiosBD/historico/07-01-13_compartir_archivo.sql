CREATE TABLE archivo.compartir
(
  id serial NOT NULL,
  unidad_id integer NOT NULL,
  parametros text,
  created_at timestamp without time zone NOT NULL,
  updated_at timestamp without time zone NOT NULL,
  id_update integer NOT NULL,
  CONSTRAINT pk_archivo_compartir PRIMARY KEY (id ),
  CONSTRAINT unidad_a_compartir FOREIGN KEY (unidad_id)
      REFERENCES organigrama.unidad (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);


CREATE TABLE archivo.compartir_funcionario
(
  id serial NOT NULL,
  compartir_id integer NOT NULL,
  funcionario_id integer NOT NULL,
  created_at timestamp without time zone NOT NULL,
  updated_at timestamp without time zone NOT NULL,
  id_update integer NOT NULL,
  CONSTRAINT pk_archivo_compartir_funcionario PRIMARY KEY (id ),
  CONSTRAINT compartir_a_compartir_funcionario FOREIGN KEY (compartir_id)
      REFERENCES archivo.compartir (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT funcionario_a_compartir_funcionario FOREIGN KEY (funcionario_id)
      REFERENCES funcionarios.funcionario (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);