<?php

class Perfil extends AppModel{
    public $name = 'Perfil';       
    public $displayField = 'nombre';
    public $order = 'nombre ASC';
    
    public $validate = array(
        'nombre' => array(
            'rule'     => 'alphaNumeric',
            'required' => true,
            'message' => MSG_DATO_ALPHA
        )
    );
    
    public $hasMany = array(
        'Usuario' => array(
            'className' => 'Usuario',
            'foreignKey' => 'perfil_id',
        )
    );
    
    public $hasAndBelongsToMany = array(
        'Modulo' => array(
            'className' => 'Modulo',
            'joinTable' => 'permisos',
            'foreignKey' => 'perfil_id',
            'associationForeignKey' => 'modulo_id',
            'order' => array('Modulo.nivel' => 'ASC','Modulo.nombre' => 'ASC')
        )
    );
    
    
}

?>
