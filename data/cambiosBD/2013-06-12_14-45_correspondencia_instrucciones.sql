create table correspondencia.instruccion (
   id          serial       not null,
   unidad_id   integer      NOT NULL,
   descripcion varchar(255) not null,
   created_at  timestamp    not null,
   updated_at  timestamp    not null,
   id_update   integer      not null,
   ip_update   varchar(50)  not null,
   constraint pk_correspondencia_instruccion primary key (id)
)   ;
create table correspondencia.servicio (
   id          serial       not null,
   unidad_id   integer      NOT NULL,
   descripcion varchar(255) not null,
   created_at  timestamp    not null,
   updated_at  timestamp    not null,
   id_update   integer      not null,
   ip_update   varchar(50)  not null,
   constraint pk_correspondencia_servicio primary key (id)
)   ;
create table correspondencia.redireccion_automatica (
   id             serial      not null,
   instruccion_id integer     NOT NULL,
   servicio_id    integer     not null,
   unidad_id      integer     not null,
   cargo_id       integer     not null,
   observacion    text        not null,
   created_at     timestamp   not null,
   updated_at     timestamp   not null,
   id_update      integer     not null,
   ip_update      varchar(50) not null,
   constraint pk_correspondencia_redireccion_automatica primary key (id)
)   ;


alter table correspondencia.redireccion_automatica add constraint instruccion_a_redireccion_automatica 
    foreign key (instruccion_id)
    references correspondencia.instruccion (id) ;
alter table correspondencia.redireccion_automatica add constraint servicio_a_redireccion_automatica 
    foreign key (servicio_id)
    references correspondencia.servicio (id) ;
alter table correspondencia.instruccion add constraint unidad_a_instruccion 
    foreign key (unidad_id)
    references organigrama.unidad (id) ;
alter table correspondencia.redireccion_automatica add constraint unidad_a_redireccion_automatica 
    foreign key (unidad_id)
    references organigrama.unidad (id) ;
alter table correspondencia.servicio add constraint unidad_a_servicio 
    foreign key (unidad_id)
    references organigrama.unidad (id) ;
alter table correspondencia.redireccion_automatica add constraint cargo_a_instruccion 
    foreign key (cargo_id)
    references organigrama.cargo (id) ;
