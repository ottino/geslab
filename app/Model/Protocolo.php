<?php

class Protocolo extends AppModel {
    
    public $name = 'Protocolo';
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
        'Organo' => array(
            'className'  => 'Organo',
            'foreignKey' => 'organo_id',
        ),
        'Obrasocial' => array(
            'className'  => 'Obrasocial',
            'foreignKey' => 'obrasocial_id',
        )
    );

    public $hasAndBelongsToMany = array(
        'Estudio' => array(
            'className' => 'Estudio',
            'joinTable' => 'citologias_estudios',
            'foreignKey' => 'citologia_id',
            'associationForeignKey' => 'estudio_id',
            'order' => array('Estudio.descripcion' => 'ASC')
        )
    );
    
    public $validate = array(
        'paciente_id' => array(
            'rule'     => 'notEmpty',
            'required' => true,
            'message' => MSG_DATO_OBLIG
        ),
        'medico_id' => array(
            'rule'     => 'notEmpty',
            'required' => true,
            'message' => MSG_DATO_OBLIG
        ),
        'obrasocial_id' => array(
            'rule'     => 'notEmpty',
            'required' => true,
            'message' => MSG_DATO_OBLIG
        ),
        'sanatorio_id' => array(
            'rule'     => 'notEmpty',
            'required' => true,
            'message' => MSG_DATO_OBLIG
        )
    );
}

?>
