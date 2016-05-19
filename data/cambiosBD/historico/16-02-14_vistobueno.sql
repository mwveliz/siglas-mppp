CREATE TABLE correspondencia.correspondencia_vistobueno
(
  id serial NOT NULL,
  correspondencia_id integer NOT NULL,
  funcionario_id integer NOT NULL,
  orden integer NOT NULL,
  status character varying(1) NOT NULL,
  created_at timestamp without time zone NOT NULL,
  updated_at timestamp without time zone NOT NULL,
  id_update integer NOT NULL,
  CONSTRAINT pk_correspondencia_correspondencia_vistobueno PRIMARY KEY (id ),
  CONSTRAINT correspondencia_a_correspondencia_vistobueno FOREIGN KEY (correspondencia_id)
      REFERENCES correspondencia.correspondencia (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT funcionario_a_correspondencia_vistobueno FOREIGN KEY (funcionario_id)
      REFERENCES funcionarios.funcionario (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE correspondencia.vistobueno_config
(
  id serial NOT NULL,
  funcionario_unidad_id integer NOT NULL,
  funcionario_id integer NOT NULL,
  orden integer NOT NULL,
  created_at timestamp without time zone NOT NULL,
  updated_at timestamp without time zone NOT NULL,
  id_update integer NOT NULL,
  CONSTRAINT pk_correspondencia_vistobueno_config PRIMARY KEY (id ),
  CONSTRAINT funcionario_a_vistobueno_config FOREIGN KEY (funcionario_id)
      REFERENCES funcionarios.funcionario (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT funcionario_unidad_a_vistobueno_config FOREIGN KEY (funcionario_unidad_id)
      REFERENCES correspondencia.funcionario_unidad (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);