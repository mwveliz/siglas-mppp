ALTER TABLE archivo.serie_documental ADD COLUMN status character varying(1);
UPDATE archivo.serie_documental set status = 'A';
ALTER TABLE archivo.serie_documental ALTER COLUMN status SET NOT NULL;

ALTER TABLE archivo.tipologia_documental ADD COLUMN status character varying(1);
UPDATE archivo.tipologia_documental set status = 'A';
ALTER TABLE archivo.tipologia_documental ALTER COLUMN status SET NOT NULL;