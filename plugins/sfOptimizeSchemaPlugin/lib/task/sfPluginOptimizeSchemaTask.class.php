<?php

class optimizeSchemaTask extends sfPluginBaseTask {

    protected function configure() {
        $this->addOptions(array(
            new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
            new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
            new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
        ));

        $this->namespace = 'schemas';
        $this->name = 'optimizes';
        $this->briefDescription = '';
    }

    public function columnsLength($schema, $table, $column) {
        $q = "SELECT
              COLUMNS.character_maximum_length
            FROM
              information_schema.COLUMNS
              LEFT JOIN
                pg_class ON COLUMNS.table_name::name = pg_class.relname
              LEFT JOIN
                pg_description ON pg_class.oid = pg_description.objoid AND COLUMNS.ordinal_position::integer = pg_description.objsubid
            WHERE
              COLUMNS.table_schema::text = '" . $schema . "'::text
              AND
              COLUMNS.table_name = '" . $table . "'
              AND
              COLUMNS.column_name = '" . $column . "'";

        $rs = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAssoc($q);

        return $rs[0]['character_maximum_length'];
    }

    protected function execute($arguments = array(), $options = array()) {

        $databaseManager = new sfDatabaseManager($this->configuration);
        $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

        $archivo = file_get_contents(sfConfig::get('sf_root_dir') . DIRECTORY_SEPARATOR . "config/doctrine/schema.yml");

        $patron = "/  tableName:/";
        $encontrado = preg_match_all($patron, $archivo, $coincidencias, PREG_OFFSET_CAPTURE);

        $i = 0;
        $tableName = array();
        foreach ($coincidencias[0] as $coincide) {
            $tableName[$i] = $coincide[1];
            $i++;
        }
        $tableName[$i] = strlen($archivo);

        $patron = "/\n  /";
        $encontrado = preg_match_all($patron, $archivo, $coincidencias, PREG_OFFSET_CAPTURE);

        $i = 0;
        $salto2 = array();
        foreach ($coincidencias[0] as $coincide) {
            $salto2[$i] = $coincide[1];
            $i++;
        }

        $patron = "/\n    /";
        $encontrado = preg_match_all($patron, $archivo, $coincidencias, PREG_OFFSET_CAPTURE);

        $i = 0;
        $salto4 = array();
        foreach ($coincidencias[0] as $coincide) {
            $salto4[$i] = $coincide[1];
            $i++;
        }

        $patron = "/\n      /";
        $encontrado = preg_match_all($patron, $archivo, $coincidencias, PREG_OFFSET_CAPTURE);

        $i = 0;
        $salto6 = array();
        foreach ($coincidencias[0] as $coincide) {
            $salto6[$i] = $coincide[1];
            $i++;
        }

        $patron = "/    created_at:/";
        $encontrado = preg_match_all($patron, $archivo, $coincidencias, PREG_OFFSET_CAPTURE);

        $i = 0;
        $created_at = array();
        foreach ($coincidencias[0] as $coincide) {
            $created_at[$i] = $coincide[1];
            $i++;
        }

        $patron = "/    updated_at:/";
        $encontrado = preg_match_all($patron, $archivo, $coincidencias, PREG_OFFSET_CAPTURE);

        $i = 0;
        $updated_at = array();
        foreach ($coincidencias[0] as $coincide) {
            $updated_at[$i] = $coincide[1];
            $i++;
        }


        $timestampable = array();
        for ($i = 0; $i < strlen($archivo); $i++)
            $timestampable[$i] = 0;
        $borrar = array();
        for ($i = 0; $i < strlen($archivo); $i++)
            $borrar[$i] = 0;

        for ($i = 0; $i < count($tableName); $i++) {
            for ($j = 0; $j < count($created_at); $j++) {
                if ($created_at[$j] > $tableName[$i] && $created_at[$j] < $tableName[$i + 1]) {
                    $k = $ban = 0;
                    while ($k < count($salto2) && $ban == 0) {
                        if ($salto2[$k] > $tableName[$i]) {
                            echo "generating timestampable in character " . $salto2[$k] . "\n";
                            $timestampable[$salto2[$k] + 1] = 1;
                            $ban++;
                        }
                        $k++;
                    }

                    $k = $ban = 0;
                    while ($k < count($salto4) && $ban == 0) {
                        if ($salto4[$k] > $created_at[$j]) {
                            $ban++;
                        }
                        $k++;
                    }

                    $l = $ban = 0;
                    while ($l < count($salto6) && $ban == 0) {
                        if ($salto6[$l] > $created_at[$j]) {
                            $ban++;
                        }
                        $l++;
                    }

                    $ban = 0;
                    while ($ban == 0) {
                        if ($salto4[$k] == $salto6[$l]) {
                            $k++;
                            $l++;
                        }
                        else
                            $ban = 1;
                    }

                    echo "delete: column created_at from character " . $created_at[$j] . " to " . $salto4[$k] . "\n";
                    for ($m = $created_at[$j]; $m < $salto4[$k] + 1; $m++)
                        $borrar[$m] = 1;
                }
            }

            for ($j = 0; $j < count($updated_at); $j++) {
                if ($updated_at[$j] > $tableName[$i] && $updated_at[$j] < $tableName[$i + 1]) {
                    $k = $ban = 0;
                    while ($k < count($salto2) && $ban == 0) {
                        if ($salto2[$k] > $tableName[$i]) {
                            $timestampable[$salto2[$k] + 1] = 1;
                            $ban++;
                        }
                        $k++;
                    }

                    $k = $ban = 0;
                    while ($k < count($salto4) && $ban == 0) {
                        if ($salto4[$k] > $updated_at[$j]) {
                            $ban++;
                        }
                        $k++;
                    }

                    $l = $ban = 0;
                    while ($l < count($salto6) && $ban == 0) {
                        if ($salto6[$l] > $updated_at[$j]) {
                            $ban++;
                        }
                        $l++;
                    }

                    $ban = 0;
                    while ($ban == 0) {
                        if ($salto4[$k] == $salto6[$l]) {
                            $k++;
                            $l++;
                        }
                        else
                            $ban = 1;
                    }

                    echo "delete: column updated_at from character " . $updated_at[$j] . " to " . $salto4[$k] . "\n";

                    for ($m = $updated_at[$j]; $m < $salto4[$k] + 1; $m++)
                        $borrar[$m] = 1;
                }
            }
        }


        $depurado = null;
        for ($i = 0; $i < strlen($archivo); $i++) {
            if ($timestampable[$i] == 1)
                $depurado .= "  actAs:  { Timestampable: ~ }\n";

            if ($borrar[$i] == 0)
                $depurado .= substr($archivo, $i, 1);
        }



        $file = fopen(sfConfig::get('sf_root_dir') . DIRECTORY_SEPARATOR . "config/doctrine/schema2.yml", "w");
        $write = fputs($file, $depurado);
        fclose($file);
    }

}
