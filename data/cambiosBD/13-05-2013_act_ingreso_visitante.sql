drop table seguridad.ingreso_equipo;
drop table seguridad.ingreso;

CREATE TABLE seguridad.motivo
(
  id serial NOT NULL,
  descripcion text NOT NULL,
  created_at timestamp without time zone NOT NULL,
  updated_at timestamp without time zone,
  id_update integer NOT NULL,
  ip_update character varying(50) NOT NULL,
  CONSTRAINT pk_motivo PRIMARY KEY (id ),
  CONSTRAINT motivo_unique_key UNIQUE (descripcion )
);

CREATE TABLE seguridad.ingreso
(
  id serial NOT NULL,
  persona_id integer,
  imagen text,
  unidad_id integer,
  n_pase integer,
  f_ingreso timestamp without time zone,
  f_egreso timestamp without time zone,
  persona_visita text,
  funcionario_id integer NOT NULL,
  motivo_id integer NOT NULL,
  motivo_visita text,
  created_at timestamp without time zone NOT NULL,
  updated_at timestamp without time zone,
  id_update integer NOT NULL,
  ip_update character varying(50) NOT NULL,
  CONSTRAINT pk_ingreso PRIMARY KEY (id ),
  CONSTRAINT funcionario_a_ingreso FOREIGN KEY (funcionario_id)
      REFERENCES funcionarios.funcionario (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT ingreso_a_motivo FOREIGN KEY (motivo_id)
      REFERENCES seguridad.motivo (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT ingreso_a_persona FOREIGN KEY (persona_id)
      REFERENCES seguridad.persona (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT unidad_a_ingreso FOREIGN KEY (unidad_id)
      REFERENCES organigrama.unidad (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE seguridad.ingreso_equipo
(
  id serial NOT NULL,
  equipo_id integer NOT NULL,
  ingreso_id integer NOT NULL,
  f_egreso timestamp without time zone,
  created_at timestamp without time zone NOT NULL,
  updated_at timestamp without time zone,
  id_update integer NOT NULL,
  ip_update character varying(50) NOT NULL,
  CONSTRAINT pk_ingreso_equipo PRIMARY KEY (id ),
  CONSTRAINT ingreso_equipo_a_equipo FOREIGN KEY (equipo_id)
      REFERENCES seguridad.equipo (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT ingreso_equipo_a_ingreso FOREIGN KEY (ingreso_id)
      REFERENCES seguridad.ingreso (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT ingreso_equipo_unique_key UNIQUE (equipo_id , ingreso_id )
);


