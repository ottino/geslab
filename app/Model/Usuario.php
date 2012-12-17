<?php

class Usuario extends AppModel{
    public $name = 'Usuario';    
    public $recursive = 2;
    
    
    public $validate = array(
        'nombre' => array(
            'rule'     => 'notEmpty',
            'required' => true,
            'message' => MSG_DATO_OBLIG
        ),
        'usuario' => array(
            'rule'     => 'notEmpty',
            'required' => true,
            'message' => MSG_DATO_OBLIG
        ),
        'dni' => array(
            'rule'     => 'notEmpty',
            'required' => true,
            'message' => MSG_DATO_OBLIG
        )
    );
    
    
    public $belongsTo = array(
        'Perfil' => array(
            'className' => 'Perfil',
            'foreignKey' => 'perfil_id',
        )
    );
    
    function beforeSave($options = array()) {
         if(isset($this->data[$this->alias]['clave']))
            $this->data[$this->alias]['clave'] = Security::hash($this->data[$this->alias]['clave'], null, true);
         return true;
    }
}

?>
