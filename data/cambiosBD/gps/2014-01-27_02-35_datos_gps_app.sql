INSERT INTO vehiculos.gps (id, marca, modelo, descripcion, mic, cam, sd, status, created_at, updated_at, id_update, id_create, ip_update, ip_create) VALUES (1, 'Xexun', 'TK-103', 'Dispositivo GPS para vehiculos', true, true, true, 'A', now(), now(), 1, 1, '127.1.1.1', '127.1.1.1');

SELECT pg_catalog.setval('vehiculos.gps_id_seq', 1, false);



INSERT INTO vehiculos.condicion (id, nombre, status, created_at, updated_at, id_update, id_create, ip_update, ip_create) VALUES (1, 'Titular', 'A', now(), now(), 1, 1, '127.1.1.1', '127.1.1.1');
INSERT INTO vehiculos.condicion (id, nombre, status, created_at, updated_at, id_update, id_create, ip_update, ip_create) VALUES (2, 'Suplente', 'A', now(), now(), 1, 1, '127.1.1.1', '127.1.1.1');

SELECT pg_catalog.setval('vehiculos.condicion_id_seq', 2, false);



INSERT INTO vehiculos.comando (id, comando, descripcion, gps_id, status, created_at, updated_at, id_update, id_create, ip_update, ip_create) VALUES (1, 'begin<password>', 'Inicializar GPS', 1, 'A', '2013-12-06 21:55:50', '2013-12-06 21:55:50', 491, 491, '127.0.0.1', '127.0.0.1');
INSERT INTO vehiculos.comando (id, comando, descripcion, gps_id, status, created_at, updated_at, id_update, id_create, ip_update, ip_create) VALUES (2, 'password<password> <new_password>', 'Cambio de contraseña', 1, 'A', '2013-12-06 22:03:29', '2013-12-06 22:03:29', 491, 491, '127.0.0.1', '127.0.0.1');
INSERT INTO vehiculos.comando (id, comando, descripcion, gps_id, status, created_at, updated_at, id_update, id_create, ip_update, ip_create) VALUES (3, 'admin<password> <number_authorized>', 'Número autorizado', 1, 'A', '2013-12-06 22:39:19', '2013-12-06 22:39:19', 491, 491, '127.0.0.1', '127.0.0.1');
INSERT INTO vehiculos.comando (id, comando, descripcion, gps_id, status, created_at, updated_at, id_update, id_create, ip_update, ip_create) VALUES (4, 'noadmin<password>', 'Eliminar número autorizado', 1, 'A', '2013-12-06 22:40:10', '2013-12-06 22:40:10', 491, 491, '127.0.0.1', '127.0.0.1');
INSERT INTO vehiculos.comando (id, comando, descripcion, gps_id, status, created_at, updated_at, id_update, id_create, ip_update, ip_create) VALUES (6, 'distance<password> <0050>', 'Track automático por intervalos de distancia (es necesario activar primero fix). Ej.: distance123456 0050', 1, 'A', '2013-12-06 23:01:34', '2013-12-06 23:01:34', 491, 491, '127.0.0.1', '127.0.0.1');
INSERT INTO vehiculos.comando (id, comando, descripcion, gps_id, status, created_at, updated_at, id_update, id_create, ip_update, ip_create) VALUES (7, 'nofix<password>', 'Desactivar Track automatico (por intervalo de tiempo y distancia)', 1, 'A', '2013-12-06 23:02:29', '2013-12-06 23:02:29', 491, 491, '127.0.0.1', '127.0.0.1');
INSERT INTO vehiculos.comando (id, comando, descripcion, gps_id, status, created_at, updated_at, id_update, id_create, ip_update, ip_create) VALUES (8, 'suppress<password>', 'Detiene actualizacion de posicion mienstras ACC sea OFF o posicion sea la misma (Desactivada por defecto)', 1, 'A', '2013-12-06 23:10:10', '2013-12-06 23:10:10', 491, 491, '127.0.0.1', '127.0.0.1');
INSERT INTO vehiculos.comando (id, comando, descripcion, gps_id, status, created_at, updated_at, id_update, id_create, ip_update, ip_create) VALUES (9, 'clear<password>', 'Limpiar SD', 1, 'A', '2013-12-06 23:17:43', '2013-12-06 23:17:43', 491, 491, '127.0.0.1', '127.0.0.1');
INSERT INTO vehiculos.comando (id, comando, descripcion, gps_id, status, created_at, updated_at, id_update, id_create, ip_update, ip_create) VALUES (10, 'lowbattery<password> on', 'Activa alerta de bateria baja (3.55V) 2 veces en intervalos de 15 minutos', 1, 'A', '2013-12-06 23:29:41', '2013-12-06 23:29:41', 491, 491, '127.0.0.1', '127.0.0.1');
INSERT INTO vehiculos.comando (id, comando, descripcion, gps_id, status, created_at, updated_at, id_update, id_create, ip_update, ip_create) VALUES (11, 'lowbattery<password> off', 'Desactiva alarma de bateria baja', 1, 'A', '2013-12-06 23:30:05', '2013-12-06 23:30:05', 491, 491, '127.0.0.1', '127.0.0.1');
INSERT INTO vehiculos.comando (id, comando, descripcion, gps_id, status, created_at, updated_at, id_update, id_create, ip_update, ip_create) VALUES (12, 'extpower<password> on', 'Alarma de fuente de energia cortada (cada 3 minutos) activada por defecto', 1, 'A', '2013-12-06 23:31:54', '2013-12-06 23:31:54', 491, 491, '127.0.0.1', '127.0.0.1');
INSERT INTO vehiculos.comando (id, comando, descripcion, gps_id, status, created_at, updated_at, id_update, id_create, ip_update, ip_create) VALUES (13, 'extpower<password> off', 'Desactiva la alerta por desconeccion de fuente de energia', 1, 'A', '2013-12-06 23:32:32', '2013-12-06 23:32:32', 491, 491, '127.0.0.1', '127.0.0.1');
INSERT INTO vehiculos.comando (id, comando, descripcion, gps_id, status, created_at, updated_at, id_update, id_create, ip_update, ip_create) VALUES (14, 'gpssignal<password> on', 'Alerta cuando el dispositivo pierde conexion gps, envia ultima posicion valida (desactivada por defecto)', 1, 'A', '2013-12-06 23:34:07', '2013-12-06 23:35:01', 491, 491, '127.0.0.1', '127.0.0.1');
INSERT INTO vehiculos.comando (id, comando, descripcion, gps_id, status, created_at, updated_at, id_update, id_create, ip_update, ip_create) VALUES (15, 'gpssignal<password> off', 'Desactiva la alarte de perdida de conexion gps', 1, 'A', '2013-12-06 23:34:38', '2013-12-06 23:34:38', 491, 491, '127.0.0.1', '127.0.0.1');
INSERT INTO vehiculos.comando (id, comando, descripcion, gps_id, status, created_at, updated_at, id_update, id_create, ip_update, ip_create) VALUES (16, 'help me!', 'Detiene la alerta de boton de panico (SOS)', 1, 'A', '2013-12-06 23:36:55', '2013-12-06 23:36:55', 491, 491, '127.0.0.1', '127.0.0.1');
INSERT INTO vehiculos.comando (id, comando, descripcion, gps_id, status, created_at, updated_at, id_update, id_create, ip_update, ip_create) VALUES (17, 'stockade<password> latitud_1,longitud_1;latitud_2,longitud_2;latitud_3,longitud_3;latitud_4,longitud_4', 'Activa geocerca, se enviara una alerta cuando la unidad se encuentre fuera de este distrito', 1, 'A', '2013-12-06 00:00:00', '2013-12-06 00:00:00', 491, 491, '127.0.0.0', '127.0.0.0');
INSERT INTO vehiculos.comando (id, comando, descripcion, gps_id, status, created_at, updated_at, id_update, id_create, ip_update, ip_create) VALUES (18, 'nostockade<password>', 'Desactivar geocerca', 1, 'A', '2014-01-19 10:28:14', '2014-01-19 10:28:14', 491, 491, '127.0.0.1', '127.0.0.1');
INSERT INTO vehiculos.comando (id, comando, descripcion, gps_id, status, created_at, updated_at, id_update, id_create, ip_update, ip_create) VALUES (19, 'move<password> 0200', 'Activa alerta de moviento (por defecto 200 metros)', 1, 'A', '2014-01-19 10:39:45', '2014-01-19 10:39:45', 491, 491, '127.0.0.1', '127.0.0.1');
INSERT INTO vehiculos.comando (id, comando, descripcion, gps_id, status, created_at, updated_at, id_update, id_create, ip_update, ip_create) VALUES (20, 'nomove<password>', 'Desactiva alerta de movimiento', 1, 'A', '2014-01-19 10:40:15', '2014-01-19 10:40:15', 491, 491, '127.0.0.1', '127.0.0.1');
INSERT INTO vehiculos.comando (id, comando, descripcion, gps_id, status, created_at, updated_at, id_update, id_create, ip_update, ip_create) VALUES (21, 'speed<password> <velocity>', 'Alerta cuando sobrepasa la velocidad (variable "velocity"). Ejm.: speed123456 080 (OJO: min-vel: 30 Km/h)', 1, 'A', '2014-01-21 20:27:34', '2014-01-21 20:27:34', 491, 491, '127.0.0.1', '127.0.0.1');
INSERT INTO vehiculos.comando (id, comando, descripcion, gps_id, status, created_at, updated_at, id_update, id_create, ip_update, ip_create) VALUES (22, 'nospeed<password>', 'Desactiva alertas de velocidad', 1, 'A', '2014-01-21 20:27:56', '2014-01-21 20:27:56', 491, 491, '127.0.0.1', '127.0.0.1');
INSERT INTO vehiculos.comando (id, comando, descripcion, gps_id, status, created_at, updated_at, id_update, id_create, ip_update, ip_create) VALUES (23, 'ACC<password>', 'Alerta cuando el vehiculo es encendido, tambien cuando es apagado', 1, 'A', '2014-01-21 20:29:41', '2014-01-21 20:31:13', 491, 491, '127.0.0.1', '127.0.0.1');
INSERT INTO vehiculos.comando (id, comando, descripcion, gps_id, status, created_at, updated_at, id_update, id_create, ip_update, ip_create) VALUES (24, 'noACC<password>', 'Desactiva alertas de encendido y apago del vehiculo', 1, 'A', '2014-01-21 20:30:01', '2014-01-21 20:31:31', 491, 491, '127.0.0.1', '127.0.0.1');
INSERT INTO vehiculos.comando (id, comando, descripcion, gps_id, status, created_at, updated_at, id_update, id_create, ip_update, ip_create) VALUES (25, 'stop<password>', 'Cortara el suministro de corriente al vehiculo, si este se encuentra a mas de 20 Km/h, el vehiculos.comando se ejecutara cuando este por debajo de esta velocidad', 1, 'A', '2014-01-21 23:11:07', '2014-01-21 23:11:07', 491, 491, '127.0.0.1', '127.0.0.1');
INSERT INTO vehiculos.comando (id, comando, descripcion, gps_id, status, created_at, updated_at, id_update, id_create, ip_update, ip_create) VALUES (26, 'resume<password>', 'Reactiva el suministro de electricidad al vechiculo para poder ser encendido.', 1, 'A', '2014-01-21 23:12:00', '2014-01-21 23:12:00', 491, 491, '127.0.0.1', '127.0.0.1');
INSERT INTO vehiculos.comando (id, comando, descripcion, gps_id, status, created_at, updated_at, id_update, id_create, ip_update, ip_create) VALUES (27, 'arm<password>', 'Armado de Tracker. Activa el trastreo', 1, 'A', '2014-01-21 23:15:42', '2014-01-21 23:15:42', 491, 491, '127.0.0.1', '127.0.0.1');
INSERT INTO vehiculos.comando (id, comando, descripcion, gps_id, status, created_at, updated_at, id_update, id_create, ip_update, ip_create) VALUES (28, 'disarm<password>', 'Desarma Tracker. Desactiva seguimiento.', 1, 'A', '2014-01-21 23:16:16', '2014-01-21 23:16:16', 491, 491, '127.0.0.1', '127.0.0.1');
INSERT INTO vehiculos.comando (id, comando, descripcion, gps_id, status, created_at, updated_at, id_update, id_create, ip_update, ip_create) VALUES (29, 'sleep<password> on', 'Activa modo suspension, antenas GPS y GSM desactivadas (se reactivan cuando otro vehiculos.comando es enviado)', 1, 'A', '2014-01-21 23:23:00', '2014-01-21 23:23:00', 491, 491, '127.0.0.1', '127.0.0.1');
INSERT INTO vehiculos.comando (id, comando, descripcion, gps_id, status, created_at, updated_at, id_update, id_create, ip_update, ip_create) VALUES (30, 'sleep<password> off', 'Desactiva modo suspencion', 1, 'A', '2014-01-21 23:23:25', '2014-01-21 23:23:25', 491, 491, '127.0.0.1', '127.0.0.1');
INSERT INTO vehiculos.comando (id, comando, descripcion, gps_id, status, created_at, updated_at, id_update, id_create, ip_update, ip_create) VALUES (31, 'reset<password>', 'Reicio del hardware modulos GPS y GSM', 1, 'A', '2014-01-21 23:25:17', '2014-01-21 23:25:17', 491, 491, '127.0.0.1', '127.0.0.1');
INSERT INTO vehiculos.comando (id, comando, descripcion, gps_id, status, created_at, updated_at, id_update, id_create, ip_update, ip_create) VALUES (32, 'imei<password>', 'Solicita codigo IMEI (15 digitos)', 1, 'A', '2014-01-21 23:26:12', '2014-01-21 23:26:12', 491, 491, '127.0.0.1', '127.0.0.1');
INSERT INTO vehiculos.comando (id, comando, descripcion, gps_id, status, created_at, updated_at, id_update, id_create, ip_update, ip_create) VALUES (33, 'check<password>', 'Solicita al dispositivo informacion de estatus actual del vehiculo', 1, 'A', '2014-01-21 23:27:13', '2014-01-21 23:27:13', 491, 491, '127.0.0.1', '127.0.0.1');
INSERT INTO vehiculos.comando (id, comando, descripcion, gps_id, status, created_at, updated_at, id_update, id_create, ip_update, ip_create) VALUES (5, 'fiix<interval>s***n<password>', 'Track automático por intervalos de tiempo (minimo 20 seg). Ej.: fix030s***n123456', 1, 'A', '2013-12-06 22:46:44', '2013-12-06 22:52:01', 491, 491, '127.0.0.1', '127.0.0.1');
INSERT INTO vehiculos.comando (id, comando, descripcion, gps_id, status, created_at, updated_at, id_update, id_create, ip_update, ip_create) VALUES (34, 'nosuppress<password>', 'Reactiva el seguimiento constante', 1, 'A', '2014-01-24 08:22:16', '2014-01-24 08:22:16', 491, 491, '127.0.0.1', '127.0.0.1');

SELECT pg_catalog.setval('vehiculos.comando_id_seq', 34, true);




INSERT INTO vehiculos.mantenimiento_tipo (id, nombre, descripcion, icono, status, created_at, updated_at, id_update, id_create, ip_update, ip_create) VALUES (1, 'Servicio General', 'Servicio General', 'servicio_general.png', 'A', now(), now(), 491, 491, '127.0.0.1', '127.0.0.1');
INSERT INTO vehiculos.mantenimiento_tipo (id, nombre, descripcion, icono, status, created_at, updated_at, id_update, id_create, ip_update, ip_create) VALUES (2, 'Aceite', 'Cambio de aceites de motor y caja', 'aceite.png', 'A', now(), now(), 491, 491, '127.0.0.1', '127.0.0.1');
INSERT INTO vehiculos.mantenimiento_tipo (id, nombre, descripcion, icono, status, created_at, updated_at, id_update, id_create, ip_update, ip_create) VALUES (3, 'Motor', 'Revisiones de motor y componentes', 'motor.png', 'A', now(), now(), 491, 491, '127.0.0.1', '127.0.0.1');
INSERT INTO vehiculos.mantenimiento_tipo (id, nombre, descripcion, icono, status, created_at, updated_at, id_update, id_create, ip_update, ip_create) VALUES (4, 'Bateria', 'Checkeo de estado de la bateria o cambio', 'bateria.png', 'A', now(), now(), 491, 491, '127.0.0.1', '127.0.0.1');
INSERT INTO vehiculos.mantenimiento_tipo (id, nombre, descripcion, icono, status, created_at, updated_at, id_update, id_create, ip_update, ip_create) VALUES (5, 'Pintura', 'vehiculos.mantenimiento de pintura o latoneria', 'pintura.png', 'A', now(), now(), 491, 491, '127.0.0.1', '127.0.0.1');
INSERT INTO vehiculos.mantenimiento_tipo (id, nombre, descripcion, icono, status, created_at, updated_at, id_update, id_create, ip_update, ip_create) VALUES (6, 'Neumáticos', 'Revisión de presión de aire y cambio de cauchos', 'neumatico.png', 'A', now(), now(), 491, 491, '127.0.0.1', '127.0.0.1');
INSERT INTO vehiculos.mantenimiento_tipo (id, nombre, descripcion, icono, status, created_at, updated_at, id_update, id_create, ip_update, ip_create) VALUES (7, 'Lavado', 'Lavado. pulitura de carrecería o motor', 'lavado.png', 'A', now(), now(), 491, 491, '127.0.0.1', '127.0.0.1');

SELECT pg_catalog.setval('vehiculos.mantenimiento_tipo_id_seq', 7, true);



INSERT INTO vehiculos.tipo (id, nombre, descripcion, status, created_at, updated_at, id_update, ip_update, ip_create, id_create) VALUES (1, 'Sedan', 'Vehículo turistico de cuatro puestas', 'A', now(), now(), 1, '127.1.1.1', '127.1.1.1', 1);
INSERT INTO vehiculos.tipo (id, nombre, descripcion, status, created_at, updated_at, id_update, ip_update, ip_create, id_create) VALUES (2, 'Camioneta', 'Vehículo menor que el camión, empleado generalmente para el transporte de mercancías', 'A', now(), now(), 1, '127.1.1.1', '127.1.1.1', 1);
INSERT INTO vehiculos.tipo (id, nombre, descripcion, status, created_at, updated_at, id_update, ip_update, ip_create, id_create) VALUES (3, 'Todo terreno', 'vehículo diseñado exclusivamente para ser conducido en todo vehiculos.tipo de terrenos hostiles', 'A', now(), now(), 1, '127.1.1.1', '127.1.1.1', 1);
INSERT INTO vehiculos.tipo (id, nombre, descripcion, status, created_at, updated_at, id_update, ip_update, ip_create, id_create) VALUES (4, 'Furgoneta', 'vehículo comercial ligero utilizado para transportar bienes o grupos de personas', 'A', now(), now(), 1, '127.1.1.1', '127.1.1.1', 1);
INSERT INTO vehiculos.tipo (id, nombre, descripcion, status, created_at, updated_at, id_update, ip_update, ip_create, id_create) VALUES (5, 'Hacthback', 'Vehículo con maletero integrado a la cabina de pasajeros vehiculos.tipo turismo', 'A', now(), now(), 1, '127.1.1.1', '127.1.1.1', 1);
INSERT INTO vehiculos.tipo (id, nombre, descripcion, status, created_at, updated_at, id_update, ip_update, ip_create, id_create) VALUES (6, 'Familiar', 'Vehículo de cinco puertas vehiculos.tipo turismo', 'A', now(), now(), 1, '127.1.1.1', '127.1.1.1', 1);
INSERT INTO vehiculos.tipo (id, nombre, descripcion, status, created_at, updated_at, id_update, ip_update, ip_create, id_create) VALUES (7, 'Camión', 'Vehículo de estructura de chasis para el transporte de bienes', 'A', now(), now(), 1, '127.1.1.1', '127.1.1.1', 1);
INSERT INTO vehiculos.tipo (id, nombre, descripcion, status, created_at, updated_at, id_update, ip_update, ip_create, id_create) VALUES (8, 'Semi-remorque', 'Acople de vehículos para transporte de vienes', 'A', now(), now(), 1, '127.1.1.1', '127.1.1.1', 1);
INSERT INTO vehiculos.tipo (id, nombre, descripcion, status, created_at, updated_at, id_update, ip_update, ip_create, id_create) VALUES (9, 'Remolque', 'Vehículo de carga no motorizado para el transporte de bienes', 'A', now(), now(), 1, '127.1.1.1', '127.1.1.1', 1);
INSERT INTO vehiculos.tipo (id, nombre, descripcion, status, created_at, updated_at, id_update, ip_update, ip_create, id_create) VALUES (10, 'Autobús', 'Vehículo diseñado para el transporte de personas', 'A', now(), now(), 1, '127.1.1.1', '127.1.1.1', 1);
INSERT INTO vehiculos.tipo (id, nombre, descripcion, status, created_at, updated_at, id_update, ip_update, ip_create, id_create) VALUES (11, 'Moto', 'Vehículo de dos ruedas', 'A', now(), now(), 1, '127.1.1.1', '127.1.1.1', 1);

SELECT pg_catalog.setval('vehiculos.tipo_id_seq', 11, true);



INSERT INTO vehiculos.tipo_uso (id, nombre, descripcion, status, created_at, updated_at, id_update, id_create, ip_update, ip_create) VALUES (1, 'Encomienda', NULL, 'A', now(), now(), 1, 1, '127.1.1.1', '127.1.1.1');
INSERT INTO vehiculos.tipo_uso (id, nombre, descripcion, status, created_at, updated_at, id_update, id_create, ip_update, ip_create) VALUES (2, 'VIP', NULL, 'A', now(), now(), 1, 1, '127.1.1.1', '127.1.1.1');
INSERT INTO vehiculos.tipo_uso (id, nombre, descripcion, status, created_at, updated_at, id_update, id_create, ip_update, ip_create) VALUES (3, 'Transporte de personal', NULL, 'A', now(), now(), 1, 1, '127.1.1.1', '127.1.1.1');

SELECT pg_catalog.setval('vehiculos.tipo_uso_id_seq', 1, false);




