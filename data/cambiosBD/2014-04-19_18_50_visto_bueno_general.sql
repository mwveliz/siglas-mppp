
CREATE TABLE correspondencia.vistobueno_general_config
(
  id serial NOT NULL,
  nombre character varying(255) NOT NULL,
  descripcion text,
  tipo_formato_id integer NOT NULL,
  status character varying(1) NOT NULL,
  created_at timestamp without time zone NOT NULL,
  updated_at timestamp without time zone NOT NULL,
  id_update integer NOT NULL,
  id_create integer NOT NULL,
  ip_update character varying(50) NOT NULL,
  ip_create character varying(50) NOT NULL,
  CONSTRAINT pk_correspondencia_vistobueno_general_config PRIMARY KEY (id ),
  CONSTRAINT funcionario_a_vistobueno_general_config FOREIGN KEY (tipo_formato_id)
      REFERENCES correspondencia.tipo_formato (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE correspondencia.vistobueno_general
(
  id serial NOT NULL,
  vistobueno_general_config_id integer NOT NULL,
  funcionario_id integer NOT NULL,
  funcionario_cargo_id integer NOT NULL,
  orden integer NOT NULL,
  status character varying(1) NOT NULL,
  created_at timestamp without time zone NOT NULL,
  updated_at timestamp without time zone NOT NULL,
  id_update integer NOT NULL,
  id_create integer NOT NULL,
  ip_update character varying(50) NOT NULL,
  ip_create character varying(50) NOT NULL,
  CONSTRAINT pk_correspondencia_vistobueno_general PRIMARY KEY (id ),
  CONSTRAINT funcionario_a_vistobueno_general FOREIGN KEY (funcionario_id)
      REFERENCES funcionarios.funcionario (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT organigrama_a_vistobueno_general FOREIGN KEY (funcionario_cargo_id)
      REFERENCES organigrama.cargo (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT funcionario_unidad_a_vistobueno_general FOREIGN KEY (vistobueno_general_config_id)
      REFERENCES correspondencia.vistobueno_general_config (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)