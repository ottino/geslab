<?php

class PerfilesController extends AppController {
    public $name = 'Perfiles';
    public $uses = array('Perfil');

    public $paginate = array(
        'limit' => 15,
        'order' => array(
            'Perfil.perfiles' => 'asc'
        )
    );
    
    public function index(){
        $data = $this->paginate('Perfil');
        $this->set(compact('data'));
    }

    public function add(){
        $this->set('modulos', $this->Perfil->Modulo->find('all', array(
            'order' => array('grupo','nivel')))
        );
        
        if(!empty($this->data)){

            if ($this->Perfil->save($this->data)) {

                $this->Session->setFlash( MSG_ADD, 'success' );

                $this->redirect($this->referer());
            } else {
                $this->Session->setFlash( MSG_ERR );
            }

        }
    }

    public function edit($id = null){
        $this->set('modulos', $this->Perfil->Modulo->find('all', array(
            'order' => array('grupo','nivel')))
        );
              
        if ($this->request->is('get')) {

            $this->Perfil->id = $id;

            $this->request->data = $this->Perfil->read();
        } else {            
            if ($this->Perfil->save($this->request->data)) {
                $this->Session->setFlash( MSG_EDT , 'success');
                $this->redirect(array('action' => 'index'));
            }
        }

   }

   public function delete($id = null ){
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }

        if ($this->Perfil->delete($id, true)) {
            $this->Session->setFlash( MSG_DEL, 'success' );
            $this->redirect(array('action' => 'index'));
        }
    }
}

?>