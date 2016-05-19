ALTER TABLE organigrama.unidad RENAME COLUMN orden TO orden_automatico;
ALTER TABLE organigrama.unidad ADD COLUMN orden_preferencial integer;
