<?php

App::uses('Controller', 'Controller');
App::uses('Security', 'Utility'); 

class AppController extends Controller {
        
    public $components = array(
        'Session',
        'Auth' => array(
            'loginAction' => array(
                'controller' => 'usuarios',
                'action' => 'entrar'                
            ),
            'loginRedirect' => array('controller' => 'inicio'),
            'logoutRedirect' => array('controller' => 'usuarios', 'action' => 'entrar'),
            'authenticate' => array(
                'Form' => array(
                    'userModel' => 'Usuario',
                    'fields' => array(                        
                        'username' => 'usuario',
                        'password' => 'clave'
                        )
                )
            )
        )
    );

    public $permitidos = array(
        'controllers'=> array('inicio','usuarios'),
        'actions' => array('search')
        );
    
    public function beforeFilter() {     
        parent::beforeFilter();
/*
        if($this->Session->check('legajo')){
            
            //Verifica que el controlador este en los modulos de grupo
            $permitir = false;
            $menu = $this->Session->read('menu');

            $controller = strtolower($this->name);
            $accion = strtolower($this->action);

            if(in_array($controller, $this->permitidos['controllers']) || 
                    in_array($accion, $this->permitidos['actions'])){
                        $permitir = true;
            }else{               
            
                if (array_key_exists($controller, $menu)){
                    $url = $controller . '/' . $accion;


                    foreach($menu[$controller] as $m){
                        $menu_accion = strtolower($m['accion']);

                        
                        if( $url == $menu_accion ){
                            $permitir = true;
                            continue;
                        }else{
                             if(isset($m['subgrupo'])){
                                 foreach ($m['subgrupo'] as $a) {    
                                   $menu_accion = strtolower($a['accion']);
                                   
                                   if($url == $menu_accion){                           
                                       $permitir = true;
                                       continue;
                                   }
                                 }
                             }
                        }
                    }

                }
            }
            
            if(!$permitir){                   
               $this->Session->setFlash( MSG_SEG_NO_ACCESS );                   
               $this->redirect('/', null, false);
            }
            
            //$this->guardarLog();
            
            parent::beforeFilter();
        }else{
            $this->redirect(array('controller'=>'usuarios', 'action'=>'entrar'));
        }
*/
    }
    /*
    public function guardarLog(){
        
        if($this->Session->check('usuario')){

            $usuario = $this->Session->read('usuario');
            
            $username = $usuario['Usuario']['nombre'];
            $controller = $this->request->controller;
            $action = $this->request->action;
            $named = $this->request->named; 
            $pass = $this->request->pass;
            $sdata = $this->request->data; 
            $query = $this->request->query;
            $url = $this->request->url;

            $this->Log->write( $username, $controller, $action, $named, $pass, $sdata, $query, $url ); 
        }
    }*/
}
