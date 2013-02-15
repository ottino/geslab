<?php

class Paciente extends AppModel {
    
    public $name = 'Paciente';
    public $primaryKey = 'id';
    public $displayField = 'razon_social';

    
    public $virtualFields = array(
        'apellido' => 'TRIM(if(substr(Paciente.razon_social , 1, locate (\',\', Paciente.razon_social)-1)  = \'\',\'S/D\',substr(Paciente.razon_social , 1, locate (\',\', Paciente.razon_social)-1)))',
        'nombre'   => 'TRIM(substr(Paciente.razon_social , locate (\',\', Paciente.razon_social)+1, length(Paciente.razon_social)))',

    );    
        
    public $belongsTo = array(
        'Localidad' => array(
            'className' => 'Localidad',
            'foreignKey' => 'localidad_id',
        )
    );  
    
    /*
    public $validate = array(
        /*
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
     * 
     */
}
?>
