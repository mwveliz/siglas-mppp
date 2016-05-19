ALTER TABLE correspondencia.funcionario_unidad ADD COLUMN permitido boolean DEFAULT true;

UPDATE correspondencia.funcionario_unidad SET permitido='TRUE';

ALTER TABLE correspondencia.funcionario_unidad ADD COLUMN permitido_funcionario_id integer