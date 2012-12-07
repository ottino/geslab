<?php

class Paciente extends AppModel {
    
    public $name = 'Paciente';
    public $primaryKey = 'id';

    
    public $belongsTo = array(
        'Localidad' => array(
            'className' => 'Localidad',
            'foreignKey' => 'localidad_id',
        )
    );   
}
?>
