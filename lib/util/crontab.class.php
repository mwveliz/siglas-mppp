<?php

class crontab {
    public function parametros($parametro) {
        $parametros['file_crontab_tmp'] = sfConfig::get("sf_root_dir")."/config/siglas/crontab_tmp.txt";
        $parametros['crontab'] = shell_exec('crontab -l');
        $parametros['pre_command'] = 'cd '.sfConfig::get("sf_root_dir").' && symfony ';
        
        return $parametros[$parametro];
    }

    static function add($frecuency, $task, $comment) {
        $cron = new crontab();
        
        if(!preg_match('/'.$comment.'/', $cron->parametros('crontab'))){
            $open_crontab_tmp = fopen($cron->parametros('file_crontab_tmp'),"x") or die ("Error al abrir el archivo");

            $command = $cron->parametros('crontab').PHP_EOL.PHP_EOL;
            $command .= "# INICIO SIGLAS TASK: ".$comment.PHP_EOL;
            $command .= $frecuency.' '.$cron->parametros('pre_command').$task.PHP_EOL;
            $command .= "# FIN SIGLAS TASK: ".$comment;

            fwrite($open_crontab_tmp, $command);
            fclose($open_crontab_tmp) or die ("Error al cerrar el archivo");

            echo exec('crontab '.$cron->parametros('file_crontab_tmp'));
            unlink($cron->parametros('file_crontab_tmp'));
        }

        return FALSE;
    }
    
    static function del($frecuency, $task, $comment) {
        $cron = new crontab();
        
        if(preg_match('/'.$comment.'/', $cron->parametros('crontab'))){
            $open_crontab_tmp = fopen($cron->parametros('file_crontab_tmp'),"x") or die ("Error al abrir el archivo");

            $command = PHP_EOL.PHP_EOL."# INICIO SIGLAS TASK: ".$comment.PHP_EOL;
            $command .= $frecuency.' '.$cron->parametros('pre_command').$task.PHP_EOL;
            $command .= "# FIN SIGLAS TASK: ".$comment;

            $command = str_replace($command, "", $cron->parametros('crontab'));

            fwrite($open_crontab_tmp, $command);
            fclose($open_crontab_tmp) or die ("Error al cerrar el archivo");

            echo exec('crontab '.$cron->parametros('file_crontab_tmp'));
            unlink($cron->parametros('file_crontab_tmp'));
        }
        
        return FALSE;
    }
    
    static function delAll() {
        $cron = new crontab();
        
        $open_crontab_tmp = fopen($cron->parametros('file_crontab_tmp'),"x") or die ("Error al abrir el archivo");
        fwrite($open_crontab_tmp, "");
        fclose($open_crontab_tmp) or die ("Error al cerrar el archivo");

        echo exec('crontab '.$cron->parametros('file_crontab_tmp'));
        unlink($cron->parametros('file_crontab_tmp'));
        
        return FALSE;
    }
}

?>
