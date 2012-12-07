<?php

class Citologia extends AppModel {
    
    public $name = 'Citologia';
    public $primaryKey = 'id';

      public $belongsTo = array(
        'Paciente' => array(
            'className'  => 'Paciente',
            'foreignKey' => 'paciente_id',
        ),
        'Medico' => array(
            'className'  => 'Medico',
            'foreignKey' => 'medico_id',
        ),  
        'Sanatorio' => array(
            'className'  => 'Sanatorio',
            'foreignKey' => 'sanatorio_id',
        ),  
        'Organoscitologia' => array(
            'className'  => 'Organoscitologia',
            'foreignKey' => 'organoscitologia_id',
        )
    );      
}

?>
