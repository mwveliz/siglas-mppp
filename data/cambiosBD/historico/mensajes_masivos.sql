ALTER TABLE public.mensajes_masivos DROP COLUMN telf_movil;
ALTER TABLE public.mensajes_masivos DROP COLUMN email;
ALTER TABLE public.mensajes_masivos DROP COLUMN nombre;

ALTER TABLE public.mensajes_masivos ADD COLUMN variables text NOT NULL;
ALTER TABLE public.mensajes ADD COLUMN nombre_externo character varying(255);

