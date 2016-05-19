<?php

require_once dirname(__FILE__).'/../lib/io_disponibleGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/io_disponibleGeneratorHelper.class.php';

/**
 * io_disponible actions.
 *
 * @package    siglas
 * @subpackage io_disponible
 * @author     Livio Lopez
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class io_disponibleActions extends autoIo_disponibleActions
{
  public function executeRegresarConfiguraciones(sfWebRequest $request)
  {
    $this->redirect('configuracion/index?opcion=interoperabilidad');
  }
  
  public function executeGuardarIpPermitida(sfWebRequest $request)
  {
      $servicios_disponibles_confianza = new Siglas_ServiciosDisponiblesConfianza();
      $servicios_disponibles_confianza->setServiciosDisponiblesId($request->getParameter('servicio_id'));
      $servicios_disponibles_confianza->setIpPermitida($request->getParameter('ip'));
      $servicios_disponibles_confianza->setDetallesMaquina($request->getParameter('detalles'));
      $servicios_disponibles_confianza->save();

      $this->servicio_disponible_id = $request->getParameter('servicio_id');
      $this->setTemplate('ipsPermitidas');
  }
  
  public function executeInactivarIpPermitida(sfWebRequest $request)
  {
      $ip_permitida= Doctrine::getTable('Siglas_ServiciosDisponiblesConfianza')->find($request->getParameter('ip_id'));
      $ip_permitida->setStatus('I');
      $ip_permitida->save();

      $this->servicio_disponible_id = $request->getParameter('servicio_id');
      $this->setTemplate('ipsPermitidas');
  }
}

