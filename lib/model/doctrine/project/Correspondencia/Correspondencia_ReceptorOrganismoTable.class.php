<?php


class Correspondencia_ReceptorOrganismoTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Correspondencia_ReceptorOrganismo');
    }
    
    public function filtrarPorCorrespondencia($correspondencia_id)
    {
            $q = Doctrine_Query::create()
                ->select('cro.*, o.nombre as receptor_organismo, o.siglas as receptor_organismo_siglas, 
                          p.ci as receptor_persona_cedula, p.nombre_simple as receptor_persona, pc.nombre as receptor_persona_cargo')
                ->from('Correspondencia_ReceptorOrganismo cro')
                ->innerjoin('cro.Organismos_Organismo o')
                ->innerjoin('cro.Organismos_Persona p')
                ->innerjoin('cro.Organismos_PersonaCargo pc')
                ->where('cro.correspondencia_id = ?', $correspondencia_id)
                ->orderBy('o.nombre');
                //->useResultCache(true, 3600, 'correspondencia_enviada_list_receptor_'.$correspondencia_id);

            return $q->execute();
    }
}