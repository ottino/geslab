<?php

class Obrasocial extends AppModel {
    
    public $name = 'Obrasocial';
    public $primaryKey = 'id';

    public $virtualFields = array(
            'desc_corta' => 'substr(Obrasocial.descripcion , 1 , 45)' 
    );
    
    public $belongsTo = array(
        'Localidad' => array(
            'className' => 'Localidad',
            'foreignKey' => 'localidad_id',
        )
    ); 

    public $validate = array(
        'descripcion' => array(
            'rule'     => 'notEmpty',
            'required' => true,
            'message' => MSG_DATO_OBLIG
        )
    );       
}
?>
