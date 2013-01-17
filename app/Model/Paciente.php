<?php

class Paciente extends AppModel {
    
    public $name = 'Paciente';
    public $primaryKey = 'id';
    public $displayField = 'razon_social';

    
    public $belongsTo = array(
        'Localidad' => array(
            'className' => 'Localidad',
            'foreignKey' => 'localidad_id',
        )
    );  
    
    
    public $validate = array(
        'dni' => array(
            'rule'     => 'notEmpty',
            'required' => true,
            'message' => MSG_DATO_OBLIG
        ),
        'razon_social' => array(
            'rule'     => 'notEmpty',
            'required' => true,
            'message' => MSG_DATO_OBLIG
        )
    );
}
?>
