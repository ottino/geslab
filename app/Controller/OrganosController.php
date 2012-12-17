<?php
class OrganosController extends AppController {

    public $helpers = array('Html', 'Form');    
    public $name='Organos'; 
    public $uses = array('Organo');
  
    public function  __construct($request = null, $response = null) {
        parent::__construct($request, $response);
        
    }    
 
    public function index() {

        $this->set('data',$this->Organo->find('all'));

    }
     
    public function add() {
        
        
        if(!empty($this->data)){            
            if ($this->Organo->save($this->data)) {
                   
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
        
         
         if ($this->request->is('get')) {
             if ($id <> null )
             {
                 $this->Organo->id = $id;           
                 $this->request->data = $this->Organo->read();
             } else {
                     $this->Session->setFlash( MSJ_REG_EDT_ERR );
                     $this->redirect(array('action' => 'index'));
             } 
         } else {
             
         if(!empty($this->data)){            
            if ($this->Organo->save($this->data)) {
                   
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
        if ($this->Organo->delete($id, true)) {
            $this->Session->setFlash( MSJ_REG_DEL_OK );
            $this->redirect(array('action' => 'index'));
        }
    }     
}
?>