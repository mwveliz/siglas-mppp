ALTER TABLE correspondencia.tipo_formato ADD COLUMN tipo character varying(1);

update correspondencia.tipo_formato set tipo = 'C';

ALTER TABLE correspondencia.tipo_formato ALTER COLUMN tipo SET NOT NULL;