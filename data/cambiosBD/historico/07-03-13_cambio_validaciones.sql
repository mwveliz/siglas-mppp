ALTER TABLE correspondencia.funcionario_unidad ALTER COLUMN permitido_funcionario_id TYPE character varying(50);

ALTER TABLE archivo.funcionario_unidad ALTER COLUMN permitido_funcionario_id TYPE character varying(50);

ALTER TABLE correspondencia.funcionario_unidad RENAME COLUMN permitido_funcionario_id TO permitido_funcionario;

ALTER TABLE archivo.funcionario_unidad RENAME COLUMN permitido_funcionario_id TO permitido_funcionario;