<?php

class BaseDoctrineTable extends Doctrine_Table
{
    public function getAllOrderBy($order = array('id'))
    {
        $string_order = 'a.'.implode(', a.', $order);
        return $this->createQuery('a')->orderBy($string_order)->execute();
    }
    
    public function getWhereAndOrderBy($where, $order = array('id'))
    {
        $array_where = array();
        foreach ($where as $key => $value) {
            $array_where[] = 'a.'.$key.' = '.$value;
        }
        $string_where = implode(' AND ', $array_where);
        $string_order = 'a.'.implode(', a.', $order);
        
        return $this->createQuery('a')->where($string_where)->orderBy($string_order)->execute();
    }
    
    public function getWhereInAndOrderBy($whereIn, $order = array('id'))
    {
        $i=0;
        $q = $this->createQuery('a');
        foreach ($whereIn as $key => $array_values) {
            if($i==0){
                $q->whereIn('a.'.$key,$array_values);
            } else {
                $q->andWhereIn('a.'.$key,$array_values);
            }
            $i++;
        }
        $string_order = 'a.'.implode(', a.', $order);
        $q->orderBy($string_order);
        
        return $q->execute();
    }
}
