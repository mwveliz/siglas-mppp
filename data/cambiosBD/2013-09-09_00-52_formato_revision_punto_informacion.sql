INSERT INTO tipo_formato (id, nombre, descripcion, privado, created_at, updated_at, id_update, status, classe, parametros, principal, tipo) VALUES (14, 'Revision Punto de Cuenta', 'x', 'N', '2012-12-12 00:00:00', '2013-09-23 10:39:34', 1, 'A', 'revisionPuntoCuenta', 'emisores:
  unidades: { especificas: [''1''], todas: ''false'', tipos: ''false'' }
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
  vistobueno: ''false''
  vistobueno_dinamico: ''false''
options_object:
  devolver: ''true''
  email_externo: ''false''
  responder: ''true''
  descargas: { pdf: ''true'', odt: ''false'', doc: ''false'' }
additional_actions:
  crear: ''false''
  enviar: ''false''
  anular: ''false''
  devolver: ''false''
hijos:
  - ''14''
formulario:
  - { nombre_campo: campo, tipo_campo: texto, requerido: ''true'' }
', false, 'C');
