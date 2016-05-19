ALTER TABLE seguridad.ingreso ALTER COLUMN funcionario_id DROP NOT NULL;
ALTER TABLE seguridad.ingreso ALTER COLUMN unidad_id SET NOT NULL;
ALTER TABLE seguridad.ingreso ALTER COLUMN persona_id SET NOT NULL;
ALTER TABLE seguridad.ingreso ALTER COLUMN f_ingreso SET NOT NULL;