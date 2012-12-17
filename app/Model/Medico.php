<?php

class Medico extends AppModel {
    
    public $name = 'Medico';
    public $primaryKey = 'id';
    public $displayField = 'razon_social';

    
    public $belongsTo = array(
        'Localidad' => array(
            'className' => 'Localidad',
            'foreignKey' => 'localidad_id',
        )
    );   
}
?>
