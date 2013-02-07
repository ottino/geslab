<?php

class Medico extends AppModel {
    
    public $name = 'Medico';
    public $primaryKey = 'id';
    public $displayField = 'razon_social';

    public $virtualFields = array(
        'apellido' => 'TRIM(if(substr(Medico.razon_social , 1, locate (\',\', Medico.razon_social)-1)  = \'\',\'S/D\',substr(Medico.razon_social , 1, locate (\',\', Medico.razon_social)-1)))',
        'nombre'   => 'TRIM(substr(Medico.razon_social , locate (\',\', Medico.razon_social)+1, length(Medico.razon_social)))',

    );        
    public $belongsTo = array(
        'Localidad' => array(
            'className' => 'Localidad',
            'foreignKey' => 'localidad_id',
        )
    );  

    public $validate = array(
        'razon_social' => array(
            'rule'     => 'notEmpty',
            'required' => true,
            'message' => MSG_DATO_OBLIG
        )
    );      
}
?>
