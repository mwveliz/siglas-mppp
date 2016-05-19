TRUNCATE TABLE public.eventos CASCADE;
ALTER TABLE public.eventos_invitados ADD COLUMN unidad_invitado_id integer NOT NULL;
ALTER TABLE public.eventos_invitados ADD COLUMN cargo_invitado_id integer NOT NULL;
ALTER TABLE public.eventos ADD COLUMN cargo_id integer NOT NULL;
ALTER TABLE public.eventos ADD COLUMN institucional boolean NOT NULL;
