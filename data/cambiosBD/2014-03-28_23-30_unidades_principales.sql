ALTER TABLE organigrama.unidad_tipo ADD COLUMN principal boolean;
update organigrama.unidad_tipo set principal = false;
ALTER TABLE organigrama.unidad_tipo ALTER COLUMN principal SET NOT NULL;

ALTER TABLE organigrama.cargo_tipo ADD COLUMN principal boolean;
update organigrama.cargo_tipo set principal = false;
ALTER TABLE organigrama.cargo_tipo ALTER COLUMN principal SET NOT NULL;