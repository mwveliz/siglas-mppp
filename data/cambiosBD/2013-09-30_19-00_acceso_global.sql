ALTER TABLE acceso.usuario ADD COLUMN acceso_global boolean;
update acceso.usuario set acceso_global = false;
ALTER TABLE acceso.usuario ALTER COLUMN acceso_global SET NOT NULL;