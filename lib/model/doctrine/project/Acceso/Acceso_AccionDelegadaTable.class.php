<?php


class Acceso_AccionDelegadaTable extends BaseDoctrineTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Acceso_AccionDelegada');
    }
    
    public function innerList() // InnerList para table_method no lleva el execute OJO solo retorna el query
    {
        $q = Doctrine_Query::create()
            ->select('ad.*')
            ->from('Acceso_AccionDelegada ad')
            ->where('ad.accion = ?', sfContext::getInstance()->getUser()->getAttribute('accion_delegada'))
            ->andWhere('ad.usuario_delega_id = ?', sfContext::getInstance()->getUser()->getAttribute('usuario_id'))
            ->orderBy('ad.accion, ad.status, ad.f_expiracion desc');

        return $q;
    }
    
    public function funcionarioDelegado($id_funcionario)
    {
        $q = Doctrine_Query::create()
                ->select('a.*')
                ->from('Acceso_AccionDelegada a')
                ->where('a.usuario_delegado_id = ?', $id_funcionario)
                ->andWhere('a.status = ?', 'A')
                ->andWhere('a.f_expiracion > ?', date('Y-m-d'));
        
        return $q->execute();
    }
}