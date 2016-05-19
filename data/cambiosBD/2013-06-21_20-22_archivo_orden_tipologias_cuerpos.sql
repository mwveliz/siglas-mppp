ALTER TABLE archivo.cuerpo_documental ADD COLUMN orden integer;
ALTER TABLE archivo.tipologia_documental ADD COLUMN orden integer;

create table archivo.expediente_cuerpo_documental (
   id                   serial    not null,
   expediente_id        integer   not null,
   cuerpo_documental_id integer   not null,
   created_at           timestamp not null,
   updated_at           timestamp not null,
   id_update            integer   not null,
   constraint pk_archivo_expediente_cuerpo_documental primary key (id)
)   ;

alter table archivo.expediente_cuerpo_documental add constraint expediente_a_expediente_cuerpo_documental 
    foreign key (expediente_id)
    references archivo.expediente (id) ;
alter table archivo.expediente_cuerpo_documental add constraint cuerpo_documental_a_expediente_cuerpo_documental 
    foreign key (cuerpo_documental_id)
    references archivo.cuerpo_documental (id) ;
