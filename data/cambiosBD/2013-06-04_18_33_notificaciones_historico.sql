create table comunicaciones.notificacion_historico (
   id             serial      not null,
   funcionario_id integer     not null,
   aplicacion_id  integer     not null,
   forma_entrega  varchar(15) not null,
   metodo_id      integer     not null,
   f_entrega      timestamp   not null,
   parametros     text                ,
   mensaje        text        not null,
   status         varchar(1)  not null,
   created_at     timestamp   not null,
   updated_at     timestamp   not null,
   id_update      integer     not null,
   ip_update      varchar(30) not null,
   constraint pk_comunicaciones_notificacion_historico primary key (id)
) ;

alter table comunicaciones.notificacion_historico add constraint aplicacion_a_notificacion_historico 
    foreign key (aplicacion_id)
    references acceso.aplicacion (id) ;
alter table comunicaciones.notificacion_historico add constraint metodo_a_notificacion_historico 
    foreign key (metodo_id)
    references comunicaciones.metodo (id) ;