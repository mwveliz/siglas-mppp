ALTER TABLE correspondencia.correspondencia ADD COLUMN id_create integer;
ALTER TABLE correspondencia.correspondencia ADD COLUMN id_delete integer;

UPDATE correspondencia.correspondencia SET id_create = id_update;
ALTER TABLE correspondencia.correspondencia ALTER COLUMN id_create SET NOT NULL;