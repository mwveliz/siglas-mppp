ALTER TABLE funcionarios.educacion_adicional ALTER COLUMN nombre TYPE character varying(100);
ALTER TABLE funcionarios.educacion_adicional RENAME COLUMN tipo TO tipo_educacion_adicional_id;

create table public.tipo_educacion_adicional (
   id          serial       not null,
   nombre      varchar(255) not null,
   status      varchar(1)   not null,
   created_at  timestamp    not null,
   updated_at  timestamp    not null,
   id_update   integer      not null,
   constraint pk_public_tipo_educacion_adicional primary key (id)
)   ;

alter table funcionarios.educacion_adicional add constraint tipo_educacion_adicional_a_educacion_adicional 
    foreign key (tipo_educacion_adicional_id)
    references public.tipo_educacion_adicional (id) ;

ALTER TABLE funcionarios.educacion_media RENAME COLUMN especialidad TO especialidad_id;

create table public.especialidad (
   id          serial       not null,
   nombre      varchar(255) not null,
   status      varchar(1)   not null,
   created_at  timestamp    not null,
   updated_at  timestamp    not null,
   id_update   integer      not null,
   constraint pk_public_especialidad primary key (id)
)   ;

alter table funcionarios.educacion_media add constraint especialidad_a_educacion_media 
    foreign key (especialidad_id)
    references public.especialidad (id) ;
