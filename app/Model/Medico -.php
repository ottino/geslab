<?php
class Medico extends AppModel {
    public $name = 'Medico';
    
    public $validate = array(        
        'razon_social' => array(
                                'rule'     => 'notEmpty',
                                'required' => true,
                                'message' => 'Completar'
                               )
     );
}

?>
