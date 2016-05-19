ALTER TABLE public.eventos ADD COLUMN dia boolean;
update public.eventos set dia = false;
ALTER TABLE public.eventos ALTER COLUMN dia SET NOT NULL;
