ALTER TABLE correspondencia.correspondencia ADD COLUMN prioridad varchar(1);

UPDATE correspondencia.correspondencia SET prioridad='S'