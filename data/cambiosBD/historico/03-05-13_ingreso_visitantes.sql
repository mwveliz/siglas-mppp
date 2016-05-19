CREATE TABLE seguridad.persona
(
  id serial NOT NULL,
  nacionalidad character(1),
  ci numeric(10,0),
  primer_nombre character varying(255) NOT NULL,
  segundo_nombre character varying(255),
  primer_apellido character varying(255) NOT NULL,
  segundo_apellido character varying(255),
  sexo character(1),
  fecha_nac date,
  created_at timestamp without time zone NOT NULL,
  updated_at timestamp without time zone,
  id_update integer NOT NULL,
  ip_update character varying(50) NOT NULL,
  CONSTRAINT pk_persona PRIMARY KEY (id ),
  CONSTRAINT persona_unique_key UNIQUE (ci )
);


CREATE TABLE seguridad.ingreso
(
  id serial NOT NULL,
  persona_id integer,
  imagen text,
  unidad_id integer,
  n_pase integer,
  f_ingreso timestamp,
  f_egreso timestamp, 
  persona_visita text,
  motivo_visita text,
  created_at timestamp without time zone NOT NULL,
  updated_at timestamp without time zone,
  id_update integer NOT NULL,
  ip_update character varying(50) NOT NULL,
  CONSTRAINT pk_ingreso PRIMARY KEY (id ),
  CONSTRAINT unidad_a_ingreso FOREIGN KEY (unidad_id)
      REFERENCES organigrama.unidad (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT ingreso_a_persona FOREIGN KEY (persona_id)
      REFERENCES seguridad.persona (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);


create TABLE seguridad.tipo
(
  id serial not null,
  descripcion text not null,
  created_at timestamp without time zone NOT NULL,
  updated_at timestamp without time zone,
  id_update integer NOT NULL,
  ip_update character varying(50) NOT NULL,
  CONSTRAINT pk_tipo PRIMARY KEY (id ),
  CONSTRAINT tipo_unique_key UNIQUE (descripcion )
);

create TABLE seguridad.marca
(
  id serial not null,
  descripcion text not null,
  created_at timestamp without time zone NOT NULL,
  updated_at timestamp without time zone,
  id_update integer NOT NULL,
  ip_update character varying(50) NOT NULL,
  CONSTRAINT pk_marca PRIMARY KEY (id ),
  CONSTRAINT tipo_marca_unique_key UNIQUE (descripcion )
);


CREATE TABLE seguridad.equipo
(
  id serial not null,
  tipo_id integer not null,
  marca_id integer not null,
  serial text not null,
  created_at timestamp without time zone NOT NULL,
  updated_at timestamp without time zone,
  id_update integer NOT NULL,
  ip_update character varying(50) NOT NULL,
  CONSTRAINT pk_equipo PRIMARY KEY (id ),
  CONSTRAINT equipo_a_tipo FOREIGN KEY (tipo_id)
      REFERENCES seguridad.tipo (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT equipo_a_marca FOREIGN KEY (marca_id)
      REFERENCES seguridad.marca (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT equipo_unique_key UNIQUE (tipo_id,marca_id,serial)
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
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT ingreso_equipo_a_ingreso FOREIGN KEY (ingreso_id)
      REFERENCES seguridad.ingreso (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT ingreso_equipo_unique_key UNIQUE (equipo_id , ingreso_id )
);
