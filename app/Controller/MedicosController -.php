<?php

class MedicosController extends AppController {
     
    public $helpers = array('Html', 'Form');
    public $name='Medicos'; 
      // Para utilizar otros modelos ->  public $uses = array('Movil', 'Color');
    public function index() {
         
         $this->set('Medico',$this->Medico->find('all'));
     }
     
    public function view ($id = null){
         $this->Medico->id = $id;
         $this->set('Medico',$this->Medico->read());
     }

    public function agregar (){
         
           if(!empty($this->data)){            
            if ($this->Medico->save($this->data)) {
                   
                $this->Session->setFlash( 'Agregado' );    
                // Con esto vuelve al Index, 
                // pasando por la funcion index del controlador
                $this->redirect(array('action' => 'index'));
                
            } else {
                $this->Session->setFlash( 'Error' );
            }
           }
     }
     
     public function editar ($id = null){
         if ($this->request->is('get')) {
             if ($id <> null )
             {
                 $this->Medico->id = $id;           
                 $this->request->data = $this->Medico->read();
             } else {
                     $this->Session->setFlash( 'Error' );
                     $this->redirect(array('action' => 'index'));
             } 
         } else {
             
         if(!empty($this->data)){            
            if ($this->Medico->save($this->data)) {
                   
                $this->Session->setFlash( 'Agregado' );    
                // Con esto vuelve al Index, 
                // pasando por la funcion index del controlador
                $this->redirect(array('action' => 'index'));
                
            } else {
                $this->Session->setFlash( 'Error' );
            }
           }
           
         }
           
     }
     
    public function delete($id = null ){
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
                
        if ($this->Medico->delete($id)) {
            $this->Session->setFlash( 'Eliminado' );
            $this->redirect(array('action' => 'index'));
        }        
    }    
     }

?>
