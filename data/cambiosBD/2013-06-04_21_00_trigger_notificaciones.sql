CREATE OR REPLACE FUNCTION duplicar_noti() RETURNS TRIGGER AS $duplicar_noti$
  DECLARE
  BEGIN

    INSERT INTO comunicaciones.notificacion_historico (
		funcionario_id,
		aplicacion_id,
		forma_entrega,
		metodo_id,
		f_entrega,
		parametros,
		mensaje,
		status,
		created_at,
		updated_at,
		id_update,
		ip_update) 
	VALUES (               
		NEW.funcionario_id,
		NEW.aplicacion_id,
		NEW.forma_entrega,
		NEW.metodo_id,
		NEW.f_entrega,
		NEW.parametros,
		NEW.mensaje,
		NEW.status,
		NEW.created_at,
		NEW.updated_at,
		NEW.id_update,
		NEW.ip_update
	       );
	RETURN NULL;
  END;
$duplicar_noti$ LANGUAGE plpgsql;

CREATE TRIGGER duplicar_noti AFTER INSERT
    ON comunicaciones.notificacion FOR EACH ROW
    EXECUTE PROCEDURE duplicar_noti();