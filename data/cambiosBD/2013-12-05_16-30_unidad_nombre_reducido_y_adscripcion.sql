ALTER TABLE organigrama.unidad ADD COLUMN nombre_reducido varchar(255);
update organigrama.unidad set nombre_reducido = nombre;
ALTER TABLE organigrama.unidad ALTER COLUMN nombre_reducido SET NOT NULL;

ALTER TABLE organigrama.unidad ADD COLUMN adscripcion boolean;
update organigrama.unidad set adscripcion = true;
ALTER TABLE organigrama.unidad ALTER COLUMN adscripcion SET NOT NULL;
