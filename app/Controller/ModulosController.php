<?php

class ModulosController extends AppController{ 
    public $name = 'Modulos';    
        
    public $paginate = array(
        'limit' => 15,
        'order' => array(            
            'Modulo.grupo' => 'asc',
            'Modulo.nivel' => 'asc',
            'Modulo.nombre' => 'asc'
        )
    );
    
    public function index(){
        $data = $this->paginate('Modulo');                
        $this->set(compact('data'));
    }
    
    public function add(){
          
        if(!empty($this->data)){
            
            if ($this->Modulo->save($this->data)) {
                   
                $this->Session->setFlash( MSG_ADD, 'success' );
                
                $this->redirect($this->referer());
            } else {
                $this->Session->setFlash( MSG_ERR );
            }
            
        }
    }    
    
    public function edit($id = null){
                        
        if ($this->request->is('get')) {
            
            $this->Modulo->id = $id;
            
            $this->request->data = $this->Modulo->read();
            
        } else {
            if ($this->Modulo->save($this->request->data)) {
                $this->Session->setFlash( MSG_EDT , 'success');
                $this->redirect(array('action' => 'index'));
            }
        }
        
   }
    
   public function view($id = null) {        
        if ($this->request->is('get')) {                    
            $this->Modulo->id = $id;
        
            $this->request->data = $this->Modulo->read();
        }        
   }
   
   public function delete($id = null ){
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
                
        if ($this->Modulo->delete($id, true)) {
            $this->Session->setFlash( MSG_DEL, 'success' );
            $this->redirect(array('action' => 'index'));
        }        
    }
    
}

?>
