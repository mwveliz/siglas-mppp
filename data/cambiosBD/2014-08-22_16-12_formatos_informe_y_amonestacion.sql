INSERT INTO correspondencia.tipo_formato VALUES (16, 'Informe', 'Formato de usu interno entre unidades', 'N', '2014-08-22 10:21:07', '2014-08-22 10:21:07', 2845, 'A', 'informe', 'emisores:
  unidades: { todas: ''true'', especificas: ''false'', tipos: ''false'' }
  funcionarios: { firma_uno: { nombre_firma: Firmante, tipo_cargos: [solicitante] } }
receptores:
  externos: ''false''
  unidades: { seteada: todas, especificas: ''false'', tipos: ''false'' }
  funcionarios: [todos]
options_create:
  privacidad: ''true''
  prioridad: ''true''
  adjunto_archivo: ''true''
  adjunto_fisico: ''true''
  vistobueno: N
  vistobueno_dinamico: ''true''
options_object:
  devolver: ''true''
  email_externo: ''true''
  responder: ''true''
  descargas: { pdf: ''true'', odt: ''true'', doc: ''false'' }
additional_actions:
  crear: ''false''
  enviar: ''false''
  anular: ''false''
  devolver: ''false''
hijos:
  - ''1''
  - ''2''
  - ''3''
formulario:
  - { nombre_campo: Asunto, tipo_campo: texto, requerido: ''true'' }
', true, 'C');

INSERT INTO correspondencia.tipo_formato VALUES (17, 'Amonestacion', 'Formato de usu interno y externo entre unidades', 'N', '2014-08-22 10:21:07', '2014-08-22 12:47:59', 2845, 'A', 'amonestacion', 'emisores:
  unidades: { todas: ''true'', especificas: ''false'', tipos: ''false'' }
  funcionarios: { firma_uno: { nombre_firma: Firmante, tipo_cargos: [autorizados] } }
receptores:
  externos: ''false''
  unidades: { seteada: todas, especificas: ''false'', tipos: ''false'' }
  funcionarios: [todos]
options_create:
  privacidad: ''true''
  prioridad: ''true''
  adjunto_archivo: ''true''
  adjunto_fisico: ''false''
  vistobueno: N
  vistobueno_dinamico: ''false''
options_object:
  devolver: ''false''
  email_externo: ''false''
  responder: ''true''
  descargas: { pdf: ''true'', odt: ''true'', doc: ''false'' }
additional_actions:
  crear: ''false''
  enviar: ''false''
  anular: ''false''
  devolver: ''false''
hijos:
  - ''1''
  - ''3''
formulario:
  - { nombre_campo: Asunto, tipo_campo: texto, requerido: ''true'' }
', true, 'C');
