<?php
class Sanatorio extends AppModel {
    
    public $name = 'Sanatorio';
    public $primaryKey = 'id';

    
    public $belongsTo = array(
        'Localidad' => array(
            'className' => 'Localidad',
            'foreignKey' => 'localidad_id',
        )
    );    
}
?>
