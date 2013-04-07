<?php

class Estudio extends AppModel {
    
    public $name = 'Estudio';
    public $primaryKey = 'id';

    public $belongsTo = array(
        'Organo' => array(
            'className' => 'Organo',
            'foreignKey' => 'organo_id',
        )
    );     
}

?>
