<?php


class Public_MensajesParticipantesTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Public_MensajesParticipantes');
    }
    
    public function grupoParticipantes($mensajes_grupo_id)
    {
            $q = Doctrine_Query::create()
                ->select('mp.*, concat(f.primer_nombre, \', \', f.primer_apellido) as participante')
                ->from('Public_MensajesParticipantes mp')
                ->innerjoin('mp.Funcionarios_Funcionario f')
                ->where('mp.mensajes_grupo_id = ?', $mensajes_grupo_id)
                ->orderBy('participante asc')
                ->execute();

            return $q;
    }
}