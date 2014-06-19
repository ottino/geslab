<?php

class UsuariosController extends AppController {
    //public $layout = 'login';
    public $uses = array('Usuario', 'Perfil');
    
    //public $scaffold;
    public $paginate = array(
        'limit' => 15,
        'order' => array(
            'Usuario.nombre' => 'asc'
        )
    );
    
    public function beforeFilter() {
        
    }
    
    public function entrar(){
        $this->layout = 'login';
        
        if ($this->request->is('post')) {
            
            if ($this->Auth->login()) {

                $usuario = $this->Usuario->findByUsuario( $this->Auth->user('usuario') );

                $modulos = $usuario['Perfil']['Modulo'];

                $menu = array();
                foreach ($modulos as $m) {
                    if( isset($m['grupo']) && (isset($m['nivel'])) ){
                        if($m['nivel'] == CONST_NIVEL_PRIMERO){
                            $menu[$m['grupo']][CONST_NIVEL_PRIMERO] = $m;
                        }else{
                            $menu[$m['grupo']][CONST_NIVEL_PRIMERO]['subgrupo'][] = $m;
                        }
                    }
                }

                $this->Session->write('usuario', $usuario);
                $this->Session->write('menu', $menu);

                return $this->redirect($this->Auth->redirect());
            } else {
                $this->Session->setFlash( MSG_AUTH_USR_PASS, 'default');
             echo MSG_AUTH_USR_PASS;
            }
        }
    }

    public function salir(){
        $this->layout = 'login';
        
        if ( $this->Session->check('usuario') ){
            $this->Session->destroy();
        }

        $this->redirect($this->Auth->logout());
    }
    
    public function index(){
        $data = $this->paginate('Usuario');
        $this->set(compact('data'));        
    }

    public function add(){

        $perfiles = $this->Perfil->find('list');
        $this->set('perfiles', $perfiles);

        if(!empty($this->data)){
            if ($this->Usuario->save($this->data)) {

                $this->Session->setFlash( MSG_ADD, 'success' );

                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash( MSG_ERR );
            }
        }

    }

    public function edit($id = null){
        $perfiles = $this->Perfil->find('list');
        $this->set('perfiles', $perfiles);

        if ($this->request->is('get')) {

            $this->Usuario->id = $id;

            $this->request->data = $this->Usuario->read();

        } else {
            if ($this->Usuario->save($this->request->data)) {
                $this->Session->setFlash( MSG_EDT , 'success');
                $this->redirect(array('action' => 'index'));
            }
        }

   }

   public function delete($id = null ){
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }

        if ($this->Usuario->delete($id, true)) {
            $this->Session->setFlash( MSG_DEL, 'success' );
            $this->redirect(array('action' => 'index'));
        }
    }
    
}

?>