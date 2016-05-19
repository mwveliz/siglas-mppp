ALTER TABLE public.mensajes_masivos ADD COLUMN total integer NOT NULL;
ALTER TABLE public.mensajes_masivos ADD COLUMN procesados integer NOT NULL;
ALTER TABLE public.mensajes_masivos ADD COLUMN cola integer NOT NULL;
ALTER TABLE public.mensajes_masivos ADD COLUMN destinatarios integer NOT NULL;

ALTER TABLE public.mensajes_masivos ADD COLUMN status varchar(1) NOT NULL;
ALTER TABLE public.mensajes_masivos ADD COLUMN prioridad integer NOT NULL;

ALTER TABLE public.mensajes ADD COLUMN n_informe_progreso text;