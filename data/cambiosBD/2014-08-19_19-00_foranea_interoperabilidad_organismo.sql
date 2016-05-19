alter table siglas.servidor_confianza add constraint organismo_a_servidor_confianza
    foreign key (organismo_id)
    references organismos.organismo (id) ;