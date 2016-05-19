alter table correspondencia.vistobueno_config add column funcionario_cargo_id integer NOT NULL;

alter table correspondencia.vistobueno_config add column status character varying(1) NOT NULL;

alter table correspondencia.correspondencia_vistobueno add column funcionario_cargo_id integer NOT NULL;