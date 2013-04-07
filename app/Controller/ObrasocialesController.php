<?php
class ObrasocialesController extends AppController {
     
    public $helpers = array('Html', 'Form');    
 
    public $uses = array('Obrasocial','Localidad');
    public $localidades = array();
    
    public $paginate = array(
        'limit' => 10,
        'order' => array(
            'Obrasocial.descripcion' => 'asc'
        )
    );  
    
    public function  __construct($request = null, $response = null) {
        parent::__construct($request, $response);
        
        # Obtengo todas las localidades para mostrarlas en el alta
        $this->localidades = $this->Localidad->find('list');     

    }    
 
    public function index() {

        $data = $this->paginate('Obrasocial');
        $this->set(compact('data'));

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

    public function search_obrasocial() {

          if(!empty($this->data)) {

              $buscar_valor = $this->Session->read('Obrasocial.buscar_valor');
              $buscar_por = $this->Session->read('Obrasocial.buscar_por');

              if(empty($buscar_valor) || empty($buscar_por)) {
                      $this->Session->write('Obrasocial.buscar_valor', $this->data['Obrasocial']['buscar_valor']);
                      $this->Session->write('Obrasocial.buscar_por', $this->data['Obrasocial']['buscar_por']);
              }

              if($this->data['Obrasocial']['buscar_valor'] != $this->Session->read('Obrasocial.buscar_valor')){
                  $this->Session->delete('Obrasocial.buscar_valor');
                  $this->Session->write('Obrasocial.buscar_valor', $this->data['Obrasocial']['buscar_valor']);
              }
              if( $this->data['Obrasocial']['buscar_por'] != $this->Session->read('Obrasocial.buscar_por')){
                  $this->Session->delete('Obrasocial.buscar_por');
                  $this->Session->write('Obrasocial.buscar_por', $this->data['Obrasocial']['buscar_por']);
              }
          }

          $options = array();

          switch ($this->Session->read('Obrasocial.buscar_por')) {
              
              case 1:
                  $options = array("Obrasocial.descripcion LIKE '%{$this->Session->read('Obrasocial.buscar_valor')}%'");
              break;

          
          }

          $this->set('data',$this->paginate('Obrasocial', $options));

          return $this->render('index');


      }       
}
?>
