update acceso.perfil set nombre = 'Administrador', descripcion = 'Administrador con permisos restringidos del SIGLAS' where nombre = 'Admin Temporal';
update acceso.perfil set nombre = 'Root', descripcion = 'Permisos completos mas permisos de configuracion global desde el SIGLAS', status = 'A' where nombre = 'Autoridad';
delete from acceso.modulo_perfil where perfil_id = 3;
delete from acceso.modulo_perfil where modulo_id = 3;

SELECT setval('acceso.modulo_perfil_id_seq', (SELECT MAX(id)+1 FROM acceso.modulo_perfil));

-- EJECUTAR LOS SIGUIENTES QUERYS DE FORMA INDIVIDUAL, SI DAN ERROR SEGUIR CON EL SIGUIENTE
-- EJECUTAR LOS SIGUIENTES QUERYS DE FORMA INDIVIDUAL, SI DAN ERROR SEGUIR CON EL SIGUIENTE
-- EJECUTAR LOS SIGUIENTES QUERYS DE FORMA INDIVIDUAL, SI DAN ERROR SEGUIR CON EL SIGUIENTE
-- EJECUTAR LOS SIGUIENTES QUERYS DE FORMA INDIVIDUAL, SI DAN ERROR SEGUIR CON EL SIGUIENTE
insert into acceso.modulo_perfil (perfil_id, modulo_id, status, created_at, updated_at, id_update) values (3, 1, 'A', now(), now(), 0);
insert into acceso.modulo_perfil (perfil_id, modulo_id, status, created_at, updated_at, id_update) values (3, 2, 'A', now(), now(), 0);
insert into acceso.modulo_perfil (perfil_id, modulo_id, status, created_at, updated_at, id_update) values (3, 3, 'A', now(), now(), 0);
insert into acceso.modulo_perfil (perfil_id, modulo_id, status, created_at, updated_at, id_update) values (3, 5, 'A', now(), now(), 0);
insert into acceso.modulo_perfil (perfil_id, modulo_id, status, created_at, updated_at, id_update) values (3, 7, 'A', now(), now(), 0);
insert into acceso.modulo_perfil (perfil_id, modulo_id, status, created_at, updated_at, id_update) values (3, 8, 'A', now(), now(), 0);
insert into acceso.modulo_perfil (perfil_id, modulo_id, status, created_at, updated_at, id_update) values (3, 9, 'A', now(), now(), 0);
insert into acceso.modulo_perfil (perfil_id, modulo_id, status, created_at, updated_at, id_update) values (3, 10, 'A', now(), now(), 0);
insert into acceso.modulo_perfil (perfil_id, modulo_id, status, created_at, updated_at, id_update) values (3, 11, 'A', now(), now(), 0);
insert into acceso.modulo_perfil (perfil_id, modulo_id, status, created_at, updated_at, id_update) values (3, 12, 'A', now(), now(), 0);
insert into acceso.modulo_perfil (perfil_id, modulo_id, status, created_at, updated_at, id_update) values (3, 15, 'A', now(), now(), 0);
insert into acceso.modulo_perfil (perfil_id, modulo_id, status, created_at, updated_at, id_update) values (3, 16, 'A', now(), now(), 0);