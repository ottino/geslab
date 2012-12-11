<?php

class ProtocolosController extends AppController {
     
    public $helpers = array('Html', 'Form');     
    
    public $uses = array( 
                         'Citologia',
                         'Medico',
                         'Organoscitologia',
                         'Paciente',
                         'Sanatorio',
                         'Obrasocial',
                         'Estudioscitologia'
                        );
    
    var $components = array('RequestHandler');

    public function  __construct($request = null, $response = null) {
        parent::__construct($request, $response);
        
        # Obtengo los datos de todos los modelos para dar de alta protocolos
        $this->citologias        = $this->Citologia->find('list');     
        $this->sanatorios        = $this->Sanatorio->find('list',array('fields' => 'Sanatorio.descripcion'));     
        $this->obrasociales      = $this->Obrasocial->find('list',array('fields' => 'Obrasocial.descripcion'));     
        $this->medicos           = $this->Medico->find('list',array('fields' => 'Medico.razon_social'));     
        $this->organoscitologias = $this->Organoscitologia->find('list', array('fields' => 'Organoscitologia.descripcion'));     
        $this->pacientes         = $this->Paciente->find('list',array('fields' => 'Paciente.dni'));       
        $this->estudios          = $this->Estudioscitologia->find('list',array('fields' => 'Estudioscitologia.descripcion'));       

    }  
    
    public function index() {

        $this->set('data',$this->Citologia->find('all'));
        
    }
    public function add() {

        $this->set('sanatorios'        , $this->sanatorios);
        $this->set('organoscitologias' , $this->organoscitologias);
        $this->set('obrasociales'      , $this->obrasociales);
        $this->set('estudios'          , $this->estudios);
        
         if(!empty($this->data)){            
            if ($this->Citologia->save($this->data)) {
                   
                $this->Session->setFlash( MSJ_REG_AG_OK );    
                
                // Con esto vuelve al Index, 
                // pasando por la funcion index del controlador
                $this->redirect(array('action' => 'index'));
                
            } else {
                     $this->Session->setFlash( MSJ_REG_AG_ERR );
                   }
            
           }
       
    }
 

}
?>
