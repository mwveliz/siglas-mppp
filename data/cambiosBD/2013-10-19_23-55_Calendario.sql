ALTER TABLE acceso.usuario ADD COLUMN variables_entorno text;
INSERT INTO seguridad.motivo(id, descripcion, created_at, updated_at, id_update, ip_update) VALUES (100000, 'Calendario', now(), now(), 0, '0.0.0.0');

CREATE TABLE public.eventos
(
  id serial NOT NULL,
  unidad_id integer NOT NULL,
  funcionario_id integer NOT NULL,
  titulo character varying(200) NOT NULL,
  dia boolean NOT NULL,
  f_inicio timestamp without time zone NOT NULL,
  f_final timestamp without time zone NOT NULL,
  motivo_id integer,
  funcionario_delegado_id integer,
  created_at timestamp without time zone NOT NULL,
  updated_at timestamp without time zone NOT NULL,
  id_update integer NOT NULL,
  ip_update character varying(50) NOT NULL,
  ip_create character varying(50) NOT NULL,
  CONSTRAINT pk_public_eventos PRIMARY KEY (id),
  CONSTRAINT funcionario_a_eventos FOREIGN KEY (funcionario_id)
      REFERENCES funcionarios.funcionario (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT funcionario_a_eventos_delegado FOREIGN KEY (funcionario_delegado_id)
      REFERENCES funcionarios.funcionario (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT motivo_a_eventos FOREIGN KEY (motivo_id)
      REFERENCES seguridad.motivo (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT unidad_a_eventos FOREIGN KEY (unidad_id)
      REFERENCES organigrama.unidad (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

create table public.eventos_invitados
(
  id serial NOT NULL,
  funcionario_invitado_id integer,
  evento_id integer NOT NULL,
  aprobado integer NOT NULL,
  created_at timestamp without time zone NOT NULL,
  updated_at timestamp without time zone NOT NULL,
  id_create integer NOT NULL,
  id_update integer NOT NULL,
  ip_update character varying(50) NOT NULL,
  ip_create character varying(50) NOT NULL,
  CONSTRAINT pk_public_eventos_invitados PRIMARY KEY (id),
  CONSTRAINT eventos_a_eventos_invitados FOREIGN KEY (evento_id)
      REFERENCES eventos (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT funcionario_a_eventos_invitados FOREIGN KEY (funcionario_invitado_id)
      REFERENCES funcionarios.funcionario (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);
