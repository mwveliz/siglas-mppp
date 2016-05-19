ALTER TABLE correspondencia.tipo_formato DROP COLUMN funcionarios_emisores;
ALTER TABLE correspondencia.tipo_formato DROP COLUMN funcionarios_receptores;
ALTER TABLE correspondencia.tipo_formato DROP COLUMN unidades_emisoras;
ALTER TABLE correspondencia.tipo_formato DROP COLUMN unidades_receptoras;
ALTER TABLE correspondencia.tipo_formato DROP COLUMN formatos_padres;
ALTER TABLE correspondencia.tipo_formato DROP COLUMN formatos_hijos;
ALTER TABLE correspondencia.tipo_formato DROP COLUMN organismos_receptores;
ALTER TABLE correspondencia.tipo_formato DROP COLUMN adjunto;

ALTER TABLE correspondencia.tipo_formato ADD COLUMN parametros text;
ALTER TABLE correspondencia.tipo_formato ADD COLUMN principal boolean;

ALTER TABLE correspondencia.formato ADD COLUMN contenido text;