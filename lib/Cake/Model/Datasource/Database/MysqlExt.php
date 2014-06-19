<?php
App::uses('Mysql', 'Model/Datasource/Database');

class MysqlExt extends Mysql {

    public function renderStatement($type, $data) {
        extract($data);
        $aliases = null;
        $TMP = AUDIT_LOG;


        switch (strtolower($type)) {
            case 'select':
                /*
                * Para guardar una bitacora de los usuarios
                */
                $fileLog = 'c:\temp\query.log';
                //$data = 'ID: ' . $_SESSION['Auth']['User']['id'] . '|' . 'USERNAME: ' . $_SESSION['Auth']['User']['username'] . '|SQL: ' . "INSERT INTO {$table} ({$fields}) VALUES ({$values})" . PHP_EOL;
                $data = '|SQL: ' . "SELECT {$fields} FROM {$table} {$alias} {$joins} {$conditions} {$group} {$order} {$limit}" . PHP_EOL;
                $fp = fopen($fileLog, 'a');
                fwrite($fp, $data);
                fclose($fp);                     
                return "SELECT {$fields} FROM {$table} {$alias} {$joins} {$conditions} {$group} {$order} {$limit}";
            case 'create':
                /*
                * Para guardar una bitacora de los usuarios
                */
                $fileLog = 'c:\temp\query.log';
                //$data = 'ID: ' . $_SESSION['Auth']['User']['id'] . '|' . 'USERNAME: ' . $_SESSION['Auth']['User']['username'] . '|SQL: ' . "INSERT INTO {$table} ({$fields}) VALUES ({$values})" . PHP_EOL;
                $data = '|SQL: ' . "INSERT INTO {$table} ({$fields}) VALUES ({$values})" . PHP_EOL;
                $fp = fopen($fileLog, 'a');
                fwrite($fp, $data);
                fclose($fp);            
                return "INSERT INTO {$table} ({$fields}) VALUES ({$values})";
            case 'update':
                if (!empty($alias)) {
                    $aliases = "{$this->alias}{$alias} {$joins} ";
                }
                /*
                * Para guardar una bitacora de los usuarios
                */
                $fileLog = 'c:\temp\query.log';
                //$data = 'ID: ' . $_SESSION['Auth']['User']['id'] . '|' . 'USERNAME: ' . $_SESSION['Auth']['User']['username'] . '|SQL: ' . "UPDATE {$table} {$aliases}SET {$fields} {$conditions}" . PHP_EOL;
                $data = '|SQL: ' . "UPDATE {$table} {$aliases}SET {$fields} {$conditions}" . PHP_EOL;
                $fp = fopen($fileLog, 'a');
                fwrite($fp, $data);
                fclose($fp);
                return "UPDATE {$table} {$aliases}SET {$fields} {$conditions}";
            case 'delete':
                if (!empty($alias)) {
                    $aliases = "{$this->alias}{$alias} {$joins} ";
                }
                /*
                * Para guardar una bitacora de los usuarios
                */
                $fileLog = 'c:\temp\query.log';
                //$data = 'ID: ' . $_SESSION['Auth']['User']['id'] . '|' . 'USERNAME: ' . $_SESSION['Auth']['User']['username'] . '|SQL: ' . "DELETE {$alias} FROM {$table} {$aliases}{$conditions}" . PHP_EOL;
                $data = '|SQL: ' . "DELETE {$alias} FROM {$table} {$aliases}{$conditions}" . PHP_EOL;
                $fp = fopen($fileLog, 'a');
                fwrite($fp, $data);
                fclose($fp);                
                return "DELETE {$alias} FROM {$table} {$aliases}{$conditions}";
            case 'schema':
                foreach (array('columns', 'indexes', 'tableParameters') as $var) {
                    if (is_array(${$var})) {
                        ${$var} = "\t" . implode(",\n\t", array_filter(${$var}));
                    } else {
                        ${$var} = '';
                    }
                }
                if (trim($indexes) !== '') {
                    $columns .= ',';
                }
                return "CREATE TABLE {$table} (\n{$columns}{$indexes}) {$tableParameters};";
            case 'alter':
                return;
        }
    }

}
?>
