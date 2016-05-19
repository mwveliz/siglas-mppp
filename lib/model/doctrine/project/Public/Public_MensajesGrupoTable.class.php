<?php


class Public_MensajesGrupoTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Public_MensajesGrupo');
    }
    
    public function innerList()
    {
            $q = Doctrine_Query::create()
                ->select('mg.*')
                ->from('Public_MensajesGrupo mg')
                ->where('mg.funcionario_id = ?', sfContext::getInstance()->getUser()->getAttribute('funcionario_id'));

            return $q;
    }
}