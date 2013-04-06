<?php
class Sanatorio extends AppModel {
    
    public $name = 'Sanatorio';
    public $primaryKey = 'id';

    public $virtualFields = array (
        'desc_corta' => 'substr(Sanatorio.descripcion , 1 , 50)'     
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
