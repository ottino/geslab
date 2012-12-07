<?php
class ObrasocialesController extends AppController {
     
    public $helpers = array('Html', 'Form');    
 
    public $uses = array('Obrasocial','Localidad');
    public $localidades = array();
  
    public function  __construct($request = null, $response = null) {
        parent::__construct($request, $response);
        
        # Obtengo todas las localidades para mostrarlas en el alta
        $this->localidades = $this->Localidad->find('list');     

    }    
 
    public function index() {

        $this->set('data',$this->Obrasocial->find('all'));

    }
     
    public function add() {
        
        $this->set('localidades', $this->localidades);
        
        if(!empty($this->data)){            
            if ($this->Obrasocial->save($this->data)) {
                   
                $this->Session->setFlash( MSJ_REG_AG_OK );    
                
                // Con esto vuelve al Index, 
                // pasando por la funcion index del controlador
                $this->redirect(array('action' => 'index'));
                
            } else {
                     $this->Session->setFlash( MSJ_REG_AG_ERR );
                   }
            
           }

     }
 
    public function edit ($id = null){
        
         $this->set('localidades', $this->localidades);
         
         if ($this->request->is('get')) {
             if ($id <> null )
             {
                 $this->Obrasocial->id = $id;           
                 $this->request->data = $this->Obrasocial->read();
             } else {
                     $this->Session->setFlash( MSJ_REG_EDT_ERR );
                     $this->redirect(array('action' => 'index'));
             } 
         } else {
             
         if(!empty($this->data)){            
            if ($this->Obrasocial->save($this->data)) {
                   
                $this->Session->setFlash( MSJ_REG_EDT_OK );    
                // Con esto vuelve al Index, 
                // pasando por la funcion index del controlador
                $this->redirect(array('action' => 'index'));
                
            } else {
                $this->Session->setFlash( MSJ_REG_EDT_ERR );
            }
           }
           
         }
           
     }
   
   public function delete($id = null ){
        if ($this->Obrasocial->delete($id, true)) {
            $this->Session->setFlash( MSJ_REG_DEL_OK );
            $this->redirect(array('action' => 'index'));
        }
    }     

     
}
?>
