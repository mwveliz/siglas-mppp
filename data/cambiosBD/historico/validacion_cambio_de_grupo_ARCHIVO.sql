ALTER TABLE archivo.funcionario_unidad ADD COLUMN permitido boolean DEFAULT true;

UPDATE archivo.funcionario_unidad SET permitido='TRUE';

ALTER TABLE archivo.funcionario_unidad ADD COLUMN permitido_funcionario_id integer;