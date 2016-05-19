update correspondencia.tipo_formato set nombre = 'Redirección', status = 'A', funcionarios_emisores = 'Firmante|',
unidades_emisoras = ':', unidades_receptoras = ':', formatos_padres = '1', formatos_hijos = ':1:2:3:', classe = 'redireccion'
where id = 3;

update correspondencia.tipo_formato set formatos_hijos = ':1:2:3:' where id in (1,2);
