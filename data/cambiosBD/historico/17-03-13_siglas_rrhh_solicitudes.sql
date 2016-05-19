
create table rrhh.vacaciones (
   id                            serial           not null,
   configuraciones_vacaciones_id integer          not null,
   funcionario_id                integer          not null,
   f_cumplimiento                date             not null,
   periodo_vacacional            varchar(9)       not null,
   anios_laborales               integer          not null,
   dias_disfrute_establecidos    integer          not null,
   dias_disfrute_adicionales     integer          not null,
   dias_disfrute_totales         integer          not null,
   dias_disfrute_pendientes      integer          not null,
   pagadas                       boolean          not null,
   f_abono                       date                     ,
   monto_abonado_concepto        double precision not null,
   status                        varchar(1)       not null,
   created_at                    timestamp        not null,
   updated_at                    timestamp        not null,
   id_update                     integer          not null,
   ip_update                     varchar(50)      not null,
   constraint pk_rrhh_vacaciones primary key (id)
)   ;
create table rrhh.vacaciones_disfrutadas (
   id                           serial      not null,
   vacaciones_id                integer     not null,
   correspondencia_solicitud_id integer             ,
   f_inicio_disfrute            date        not null,
   f_fin_disfrute               date        not null,
   f_retorno_disfrute           date        not null,
   dias_solicitados             integer     not null,
   dias_disfrute_habiles        integer     not null,
   dias_disfrute_fin_semana     integer     not null,
   dias_disfrute_no_laborales   integer     not null,
   dias_disfrute_continuo       integer     not null,
   observaciones_descritas      text                ,
   observaciones_automaticas    text        not null,
   dias_disfrute_ejecutados     integer     not null,
   dias_pendientes              integer     not null,
   status                       varchar(1)  not null,
   created_at                   timestamp   not null,
   updated_at                   timestamp   not null,
   id_update                    integer     not null,
   ip_update                    varchar(50) not null,
   constraint pk_rrhh_vacaciones_disfrutadas primary key (id)
)   ;
create table rrhh.configuraciones (
   id         serial       not null,
   modulo     varchar(255) not null,
   parametros text         not null,
   indexado   text                 ,
   status     varchar(1)   not null,
   created_at timestamp    not null,
   updated_at timestamp    not null,
   id_update  integer      not null,
   ip_update  varchar(50)  not null,
   constraint pk_rrhh_configuraciones primary key (id)
)   ;

create table rrhh.permisos (
   id                             serial           not null,
   configuraciones_permisos_id    integer          not null,
   funcionario_id                 integer          not null,
   correspondencia_solicitud_id   integer                  ,
   tipo_permiso                   text             not null,
   f_inicio_permiso               timestamp        not null,
   f_fin_permiso                  timestamp        not null,
   f_retorno_permiso              timestamp        not null,
   dias_solicitados               double precision not null,
   dias_permiso_habiles           double precision not null,
   dias_permiso_fin_semana        integer          not null,
   dias_permiso_no_laborales      integer          not null,
   dias_permiso_continuo          double precision not null,
   observaciones_descritas        text                     ,
   observaciones_automaticas      text             not null,
   correspondencia_cancelacion_id integer                  ,
   motivo_cancelacion             text                     ,
   dias_permiso_ejecutados        double precision not null,
   status                         varchar(1)       not null,
   created_at                     timestamp        not null,
   updated_at                     timestamp        not null,
   id_update                      integer          not null,
   ip_update                      varchar(50)      not null,
   constraint pk_rrhh_permisos primary key (id)
)   ;
create table rrhh.reposos (
   id                             serial           not null,
   configuraciones_reposos_id     integer          not null,
   funcionario_id                 integer          not null,
   correspondencia_solicitud_id   integer                  ,
   tipo_reposo                    text             not null,
   f_inicio_reposo                date             not null,
   f_fin_reposo                   date             not null,
   f_retorno_reposo               date             not null,
   dias_solicitados               integer          not null,
   dias_reposo_habiles            integer          not null,
   dias_reposo_fin_semana         integer          not null,
   dias_reposo_no_laborales       integer          not null,
   dias_reposo_continuo           integer          not null,
   observaciones_descritas        text                     ,
   observaciones_automaticas      text             not null,
   correspondencia_cancelacion_id integer                  ,
   motivo_cancelacion             text                     ,
   dias_reposo_ejecutados         integer          not null,
   status                         varchar(1)       not null,
   created_at                     timestamp        not null,
   updated_at                     timestamp        not null,
   id_update                      integer          not null,
   ip_update                      varchar(50)      not null,
   constraint pk_rrhh_reposos primary key (id)
)   ;
create table rrhh.vacaciones_bitacora (
   id                          serial       not null,
   vacaciones_disfrutadas_id   integer      not null,
   correspondencia_bitacora_id integer      not null,
   tipo                        varchar(255) not null,
   reposos_id                  integer              ,
   f_retorno_real              date         not null,
   dias_agregados_disfrute     integer      not null,
   status                      varchar(1)   not null,
   created_at                  timestamp    not null,
   updated_at                  timestamp    not null,
   id_update                   integer      not null,
   ip_update                   varchar(50)  not null,
   constraint pk_rrhh_vacaciones_bitacora primary key (id)
)   ;


alter table rrhh.vacaciones_disfrutadas add constraint vacaciones_a_vacaciones_disfrutadas 
    foreign key (vacaciones_id)
    references rrhh.vacaciones (id) ;
alter table rrhh.vacaciones add constraint configuraciones_vacaciones_a_vacaciones 
    foreign key (configuraciones_vacaciones_id)
    references rrhh.configuraciones (id) ;
alter table rrhh.vacaciones add constraint funcionario_a_vacaciones 
    foreign key (funcionario_id)
    references funcionarios.funcionario (id) ;
alter table rrhh.permisos add constraint configuraciones_permisos_a_permisos 
    foreign key (configuraciones_permisos_id)
    references rrhh.configuraciones (id) ;
alter table rrhh.permisos add constraint funcionario_a_permisos 
    foreign key (funcionario_id)
    references funcionarios.funcionario (id) ;
alter table rrhh.reposos add constraint configuraciones_reposos_a_reposos 
    foreign key (configuraciones_reposos_id)
    references rrhh.configuraciones (id) ;
alter table rrhh.reposos add constraint funcionario_a_reposos 
    foreign key (funcionario_id)
    references funcionarios.funcionario (id) ;
alter table rrhh.vacaciones_bitacora add constraint vacaciones_disfrutadas_a_vacaciones_bitacora 
    foreign key (vacaciones_disfrutadas_id)
    references rrhh.vacaciones_disfrutadas (id) ;
alter table rrhh.vacaciones_bitacora add constraint reposos_a_vacaciones_bitacora 
    foreign key (reposos_id)
    references rrhh.reposos (id) ;