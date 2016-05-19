ALTER TABLE funcionarios.funcionario_cargo_condicion ADD COLUMN tipo varchar(10);
UPDATE funcionarios.funcionario_cargo_condicion SET tipo = 'ingreso' where id in (1,2,3);
UPDATE funcionarios.funcionario_cargo_condicion SET tipo = 'egreso' where id in (4,5,6,7);
ALTER TABLE funcionarios.funcionario_cargo_condicion ALTER COLUMN tipo SET NOT NULL;
