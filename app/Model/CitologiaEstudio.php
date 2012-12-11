<?php

class CitologiaEstudio extends AppModel{
    public $name = 'CitologiaEstudio';
    public $useTable = 'citologias_estudios';


    public $belongsTo = array(
        'Citologia' => array(
            'className' => 'Citologia',
            'foreignKey' => 'citologia_id',
        )
    );
    
}
?>
