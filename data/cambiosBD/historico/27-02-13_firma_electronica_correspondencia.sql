CREATE TABLE funcionarios.funcionario_cargo_certificado
(
  id serial NOT NULL,
  funcionario_cargo_id integer NOT NULL,
  certificado text NOT NULL,
  configuraciones text NOT NULL,
  f_valido_desde date NOT NULL,
  f_valido_hasta date NOT NULL,
  status character varying(1) NOT NULL,
  created_at timestamp without time zone NOT NULL,
  updated_at timestamp without time zone,
  id_update integer NOT NULL,
  ip_update character varying(50),
  CONSTRAINT funcionario_cargo_certificado_pkey PRIMARY KEY (id),
  CONSTRAINT funcionario_cargo_a_funcionario_cargo_certificado FOREIGN KEY (funcionario_cargo_id)
      REFERENCES funcionarios.funcionario_cargo (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);


alter table correspondencia.funcionario_emisor add column proteccion text;