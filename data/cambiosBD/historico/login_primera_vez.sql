ALTER TABLE funcionarios.funcionario ADD COLUMN email_validado boolean;

UPDATE funcionarios.funcionario SET email_validado=false