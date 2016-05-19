<?php

/**
 * Base doctrin record.
 *
 * @package    symfony
 * @subpackage model
 * @author     Livio López. liviolopez@gmail.com. (058)426-511.42.50. Venezuela-Caracas
 */

class BaseDoctrineRecord extends sfPostgresDoctrineRecord {

    public function save(Doctrine_Connection $conn = null) {
        try {
            if (!$this->getStatus())
                $this->setStatus('A');
        } catch (Exception $e) {}

        try {
            if($this->isNew()) {// este if se coloca al leer correspondencia no se actualice el id
                if(sfContext::getInstance()->getUser()->getAttribute('usuario_id')){
                    $this->setIdCreate(sfContext::getInstance()->getUser()->getAttribute('usuario_id'));
                } else {
                    $this->setIdCreate(0);
                }
            }
        } catch (Exception $e) {}
        
        try {
            if (!$this->getIdUpdate()) {// este if se coloca al leer correspondencia no se actualice el id
                if(sfContext::getInstance()->getUser()->getAttribute('usuario_id')){
                    $this->setIdUpdate(sfContext::getInstance()->getUser()->getAttribute('usuario_id'));
                } else {
                    $this->setIdUpdate(0);
                }
            }
        } catch (Exception $e) {}

        try {
            if($this->isNew()){
                if (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
                    $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
                else if (isset($_SERVER["REMOTE_ADDR"]))
                    $ip = $_SERVER['REMOTE_ADDR'];
                else
                    $ip = '127.0.0.1';

                $this->setIpCreate($ip);
            }
        } catch (Exception $e) {}
        
        try {
            if (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
                $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
            else if (isset($_SERVER["REMOTE_ADDR"]))
                $ip = $_SERVER['REMOTE_ADDR'];
            else
                $ip = '127.0.0.1';

            $this->setIpUpdate($ip);
        } catch (Exception $e) {}

        return parent::save($conn);
    }

    public function __toString() {
        $guesses = array(
            'nombre', 
            'titulo', 
            'descripcion', 
            'name',
            'title',
            'description',
            'subject',
            'keywords',
            'id');

        // we try to guess a column which would give a good description of the object
        foreach ($guesses as $descriptionColumn) {
            try {
                return (string) $this->get($descriptionColumn);
            } catch (Exception $e) {}
        }

        return sprintf('No description for object of class "%s"', $this->getTable()->getComponentName());
    }

}
