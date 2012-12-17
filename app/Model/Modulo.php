<?php

class Modulo extends AppModel{
    public $name = 'Modulo';
    public $displayField = 'v_nombre';
    public $order = array('Modulo.grupo ASC', 'Modulo.nombre ASC');

    public $virtualFields = array(
        'v_nombre' => "CONCAT(UCASE(Modulo.grupo),' - ',Modulo.nombre)"
    );
    
    
    
}

?>
