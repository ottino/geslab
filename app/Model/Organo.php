<?php

class Organo extends AppModel {
    
    public $name = 'Organo';
    public $primaryKey = 'id';
    public $useTable = 'Organos';
    public $displayField = 'descripcion';

    public $validate = array(
        'descripcion' => array(
            'rule'     => 'notEmpty',
            'required' => true,
            'message' => MSG_DATO_OBLIG
        ),
        'tipoprotocolo' => array(
            'rule'     => 'notEmpty',
            'required' => true,
            'message' => MSG_DATO_OBLIG
        )
    );      
}

?>
