alter table funcionarios.funcionario_cargo add constraint funcionario_a_funcionario_cargo 
    foreign key (funcionario_id)
    references funcionarios.funcionario (id) ;
