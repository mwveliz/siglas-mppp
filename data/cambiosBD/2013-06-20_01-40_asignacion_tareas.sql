create table comunicaciones.tarea (
   id                  serial      not null,
   funcionario_id      integer     not null,
   descripcion         text        not null,
   f_tentativa_inicial date                ,
   f_tentativa_final   date                ,
   prioridad           integer     not null,
   parametros          text        not null,
   status              varchar(1)  not null,
   created_at          timestamp   not null,
   updated_at          timestamp   not null,
   id_update           integer     not null,
   ip_update           varchar(30) not null,
   constraint pk_comunicaciones_tarea primary key (id)
)   ;
create table comunicaciones.funcionario_tarea (
   id                    serial      not null,
   padre_id              integer             ,
   funcionario_id        integer     not null,
   tarea_id              integer     not null,
   resultado             varchar(25)         ,
   resultado_descripcion text                ,
   status                varchar(1)  not null,
   created_at            timestamp   not null,
   updated_at            timestamp   not null,
   id_update             integer     not null,
   ip_update             varchar(30) not null,
   constraint pk_comunicaciones_funcionario_tarea primary key (id)
)   ;



alter table comunicaciones.funcionario_tarea add constraint tarea_a_usuario_tarea 
    foreign key (tarea_id)
    references comunicaciones.tarea (id) ;
alter table comunicaciones.funcionario_tarea add constraint funcionario_a_funcionario_tarea 
    foreign key (funcionario_id)
    references funcionarios.funcionario (id) ;
alter table comunicaciones.tarea add constraint funcionario_a_tarea 
    foreign key (funcionario_id)
    references funcionarios.funcionario (id) ;
alter table comunicaciones.funcionario_tarea add constraint funcionario_tarea_a_funcionario_tarea 
    foreign key (padre_id)
    references comunicaciones.funcionario_tarea (id) ;