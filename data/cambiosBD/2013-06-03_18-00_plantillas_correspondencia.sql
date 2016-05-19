create table correspondencia.plantilla (
   id              serial       not null,
   tipo_formato_id integer      not null,
   nombre          varchar(255) not null,
   campo_uno       text                 ,
   campo_dos       text                 ,
   campo_tres      text                 ,
   campo_cuatro    text                 ,
   campo_cinco     text                 ,
   campo_seis      text                 ,
   campo_siete     text                 ,
   campo_ocho      text                 ,
   campo_nueve     text                 ,
   campo_diez      text                 ,
   campo_once      text                 ,
   campo_doce      text                 ,
   campo_trece     text                 ,
   campo_catorce   text                 ,
   campo_quince    text                 ,
   created_at      timestamp    not null,
   updated_at      timestamp    not null,
   id_update       integer      not null,
   ip_update       varchar(50)  not null,
   constraint pk_correspondencia_plantilla primary key (id)
)   ;
create table correspondencia.plantilla_funcionario (
   id             serial      not null,
   plantilla_id   integer     NOT NULL,
   funcionario_id integer     not null,
   created_at     timestamp   not null,
   updated_at     timestamp   not null,
   id_update      integer     not null,
   ip_update      varchar(50) not null,
   constraint pk_correspondencia_plantilla_funcionario primary key (id)
)   ;

alter table correspondencia.plantilla_funcionario add constraint pantilla_a_plantilla_funcionario 
    foreign key (plantilla_id)
    references correspondencia.plantilla (id) ;
alter table correspondencia.plantilla_funcionario add constraint funcionario_a_plantilla_funcionario 
    foreign key (funcionario_id)
    references funcionarios.funcionario (id) ;