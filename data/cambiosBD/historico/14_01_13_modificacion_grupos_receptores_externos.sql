ALTER TABLE correspondencia.grupo_receptor ADD COLUMN tipo character varying(1) NOT NULL;
ALTER TABLE correspondencia.grupo_receptor DROP CONSTRAINT unidad_a_unidad_receptor_id;
ALTER TABLE correspondencia.grupo_receptor DROP CONSTRAINT unidad_a_unidad_duena_id;
ALTER TABLE correspondencia.grupo_receptor DROP CONSTRAINT cargo_a_cargo_receptor_id;

