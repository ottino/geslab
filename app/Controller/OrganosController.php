<?php
class OrganosController extends AppController {

    public $helpers = array('Html', 'Form');    
    public $name='Organos'; 
    public $uses = array('Organo');

    public $paginate = array(
        'limit' => 10,
        'order' => array(
            'Organo.descripcion' => 'asc',
        )
    );
    
    public function  __construct($request = null, $response = null) {
        parent::__construct($request, $response);
        
    }    
 
    public function index() {

        //$this->set('data',$this->Organo->find('all'));
        $data = $this->paginate('Organo');
        $this->set(compact('data'));
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
    
    public function search_organo() {

          if(!empty($this->data)) {

              $buscar_valor = $this->Session->read('Organo.buscar_valor');
              $buscar_por = $this->Session->read('Organo.buscar_por');

              if(empty($buscar_valor) || empty($buscar_por)) {
                      $this->Session->write('Organo.buscar_valor', $this->data['Organo']['buscar_valor']);
                      $this->Session->write('Organo.buscar_por', $this->data['Organo']['buscar_por']);
              }

              if($this->data['Organo']['buscar_valor'] != $this->Session->read('Organo.buscar_valor')){
                  $this->Session->delete('Organo.buscar_valor');
                  $this->Session->write('Organo.buscar_valor', $this->data['Organo']['buscar_valor']);
              }
              if( $this->data['Organo']['buscar_por'] != $this->Session->read('Organo.buscar_por')){
                  $this->Session->delete('Organo.buscar_por');
                  $this->Session->write('Organo.buscar_por', $this->data['Organo']['buscar_por']);
              }
          }

          $options = array();

          switch ($this->Session->read('Organo.buscar_por')) {
              
              case 1:
                  $options = array("Organo.tipoprotocolo LIKE '%{$this->Session->read('Organo.buscar_valor')}%'");
              break;
              case 2:
                  $options = array("Organo.descripcion LIKE '%{$this->Session->read('Organo.buscar_valor')}%'");
              break;
          
          }

          $this->set('data',$this->paginate('Organo', $options));

          return $this->render('index');


      }     
}
?>