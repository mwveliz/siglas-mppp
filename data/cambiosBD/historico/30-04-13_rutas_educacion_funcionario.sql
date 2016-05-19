--ALTER TABLE funcionarios.educacion_adicional RENAME COLUMN ruta TO certificado_digitalizado;
--ALTER TABLE funcionarios.educacion_media RENAME COLUMN ruta TO certificado_digitalizado;
--ALTER TABLE funcionarios.educacion_universitaria RENAME COLUMN ruta TO certificado_digitalizado;

ALTER TABLE funcionarios.educacion_adicional ADD COLUMN certificado_digitalizado text;
ALTER TABLE funcionarios.educacion_media ADD COLUMN certificado_digitalizado text;
ALTER TABLE funcionarios.educacion_universitaria ADD COLUMN certificado_digitalizado text;