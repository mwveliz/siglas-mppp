<?php


class Comunicaciones_NotificacionTable extends BaseDoctrineTable
{

    public static function getInstance()
    {
        return Doctrine_Core::getTable('Comunicaciones_Notificacion');
    }

    public function groups($funcionario_id, $forma_entrega, $grupo)
    {
        $metodo= Array(0);
        switch ($grupo) {
            case 'evento' :
                $metodo= Array(1, 2, 3, 4, 5);
                break;
            case 'sms' :
                $metodo= Array(8, 9);
                break;
            case 'correspondencia' :
                $metodo= Array(6, 7, 10, 11);
                break;
        }

        $q = Doctrine_Core::getTable('Comunicaciones_Notificacion')
            ->createQuery('c')
            ->where('c.funcionario_id = ?', $funcionario_id)
            ->andWhere('c.forma_entrega = ?', $forma_entrega)
            ->andWhere('c.f_entrega <= ?', date("Y-m-d H:i:s", time())) //COMENTAR ESTA LINEA PARA PRUEBAS AL INSTANTE
            ->andWhereIn('c.metodo_id', $metodo)
            ->orderBy('c.created_at DESC');

        return $q->execute();
    }

    public function groupsCount($funcionario_id, $forma_entrega)
    {
        $q = Doctrine_Query::create()
                ->select('COUNT(c.id) as uno')
                ->addSelect('(SELECT COUNT(cn.id) AS dos FROM Comunicaciones_Notificacion cn
                    WHERE cn.funcionario_id = '.$funcionario_id.'
                    AND cn.metodo_id IN (1, 2, 3, 4, 5)
                    AND cn.forma_entrega = \''.$forma_entrega.'\'
                    AND cn.f_entrega <= \''. date("Y-m-d H:i:s", time()) .'\') AS dos') //COMENTAR ESTA LINEA PARA PRUEBAS AL INSTANTE
                ->addSelect('(SELECT COUNT(n.id) AS tres FROM Comunicaciones_Notificacion n
                    WHERE n.funcionario_id = '.$funcionario_id.'
                    AND n.metodo_id IN (8, 9)
                    AND n.forma_entrega = \''.$forma_entrega.'\'
                    AND n.f_entrega <= \''. date("Y-m-d H:i:s", time()) .'\') AS tres') //COMENTAR ESTA LINEA PARA PRUEBAS AL INSTANTE
                ->from('Comunicaciones_Notificacion c')
                ->where('c.funcionario_id = ?', $funcionario_id)
                ->andWhere('c.f_entrega <= ?', date("Y-m-d H:i:s", time())) //COMENTAR ESTA LINEA PARA PRUEBAS AL INSTANTE
                ->andWhere('c.forma_entrega = ?', $forma_entrega)
                ->andWhereIn('c.metodo_id', Array(6, 7, 10, 11))
                ->execute(array(), Doctrine::HYDRATE_NONE);

        return $q;
    }

    public function dailySummary($funcionario_id, $forma_entrega) {
        //trae la notificacion resumen diario solo si es antes de las 6 am del proximo dia
        //los resumen diario estan guardados con fecha de entrega al dia siguiente a las 6 am
        $q = Doctrine_Query::create()
                ->select('c.*')
                ->from('Comunicaciones_Notificacion c')
                ->where('c.funcionario_id = ?', $funcionario_id)
                ->andWhere('c.f_entrega >= ?', date("Y-m-d H:i:s", time()))
                ->andWhere('c.forma_entrega = ?', $forma_entrega)
                ->andWhere('c.metodo_id = ?', 6)
                ->limit(1);

        return $q->execute();
    }
}