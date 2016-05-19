ALTER TABLE correspondencia.funcionario_emisor ADD COLUMN funcionario_cargo_id integer;

ALTER TABLE correspondencia.funcionario_emisor
ADD CONSTRAINT funcionario_cargo_a_funcionario_emisor FOREIGN KEY (funcionario_cargo_id)
REFERENCES funcionarios.funcionario_cargo (id) MATCH SIMPLE
ON UPDATE NO ACTION ON DELETE NO ACTION;

ALTER TABLE correspondencia.funcionario_emisor ADD COLUMN funcionario_delegado_cargo_id integer;

ALTER TABLE correspondencia.funcionario_emisor
ADD CONSTRAINT funcionario_delegado_cargo_a_funcionario_emisor FOREIGN KEY (funcionario_delegado_cargo_id)
REFERENCES funcionarios.funcionario_cargo (id) MATCH SIMPLE
ON UPDATE NO ACTION ON DELETE NO ACTION;

--REPARACION DE CORRESPONDENCIAS ANTIGUAS
update correspondencia.funcionario_emisor fe
set funcionario_cargo_id = fc.id
from funcionarios.funcionario_cargo fc
where fc.funcionario_id = fe.funcionario_id
and status = 'A';

update correspondencia.funcionario_emisor fe
set funcionario_cargo_id = fc.id
from funcionarios.funcionario_cargo fc
where fc.funcionario_id = fe.funcionario_id
and fe.funcionario_cargo_id is null
and status <> 'A';

update correspondencia.funcionario_emisor fe
set funcionario_cargo_id = funcionario_id
where fe.funcionario_cargo_id is null;

--SETEO DE NOT NULL AL CAMPO NUEVO
ALTER TABLE correspondencia.funcionario_emisor ALTER COLUMN funcionario_cargo_id SET NOT NULL;