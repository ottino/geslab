<?php
class EstudiosController extends AppController {
     
    public $helpers = array('Html', 'Form');    
 
    public $uses = array('Estudio' , 'Organo');
    public $name='Estudios';      
    public function  __construct($request = null, $response = null) {
        parent::__construct($request, $response);
        
        $this->estudios = $this->Estudio->find('list');     
        $this->organos  = $this->Organo->find('list',
                                             array(
                                                  'conditions'=>array(
                                                                       'Organo.tipoprotocolo'=>'CITOLOGIA'
                                                                     )  ,
                                                   'order'    => array(
                                                                        'Organo.descripcion' => 'asc'                                                                
                                                                        )
                                                   )                                                 
                                            );                
                
                //array('Organo.tipoprotocolo'=>'CITOLOGIA'));     

    }    
 
    public $paginate = array(
        'limit' => 10,
        'order' => array(
            'Estudio.id' => 'asc'
        )
    );
        
    public function index() {
        $data = $this->paginate('Estudio',array('Organo.tipoprotocolo'=>'CITOLOGIA')); 
       //$data = $this->paginate('Estudio');
        $this->set(compact('data'));
    }
     
    public function add() {
        
        $this->set('organos', $this->organos);
        
        if(!empty($this->data)){ 

            $this->request->data['Estudio']['descripcion'] = 
                    strtoupper($this->request->data['Estudio']['descripcion']);
             
            if ($this->Estudio->save($this->data)) {
                
                // Con esto vuelve al Index, 
                // pasando por la funcion index del controlador
                $this->Session->setFlash( MSJ_REG_AG_OK ); 
                $this->redirect(array('action' => 'index'));                           
                     
            } else {
                     $this->Session->setFlash( MSJ_REG_AG_ERR );
                   }
            
           }

     }
 
    public function edit ($id = null){
        
         $this->set('organos', $this->organos);
         
         if ($this->request->is('get')) {
             if ($id <> null )
             {
                 $this->Estudio->id = $id;           
                 $this->request->data = $this->Estudio->read();
             } else {
                     $this->Session->setFlash( MSJ_REG_EDT_ERR );
                     $this->redirect(array('action' => 'index'));
             } 
         } else {
             
            if(!empty($this->data)){            
               if ($this->Estudio->save($this->data)) {

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
        if ($this->Estudio->delete($id, true)) {
            $this->Session->setFlash( MSJ_REG_DEL_OK );
            $this->redirect(array('action' => 'index'));
        }
    }

    public function search_estudio() {

          if(!empty($this->data)) {

              $buscar_valor = $this->Session->read('Estudio.buscar_valor');
              $buscar_por = $this->Session->read('Estudio.buscar_por');

              if(empty($buscar_valor) || empty($buscar_por)) {
                      $this->Session->write('Estudio.buscar_valor', $this->data['Estudio']['buscar_valor']);
                      $this->Session->write('Estudio.buscar_por', $this->data['Estudio']['buscar_por']);
              }

              if($this->data['Estudio']['buscar_valor'] != $this->Session->read('Estudio.buscar_valor')){
                  $this->Session->delete('Estudio.buscar_valor');
                  $this->Session->write('Estudio.buscar_valor', $this->data['Estudio']['buscar_valor']);
              }
              if( $this->data['Estudio']['buscar_por'] != $this->Session->read('Estudio.buscar_por')){
                  $this->Session->delete('Estudio.buscar_por');
                  $this->Session->write('Estudio.buscar_por', $this->data['Estudio']['buscar_por']);
              }
          }

          $options = array();

          switch ($this->Session->read('Estudio.buscar_por')) {
              case 1:
                  $options = array("Estudio.descripcion LIKE '%{$this->Session->read('Estudio.buscar_valor')}%'");
              break;
              case 2:
                  $options = array("Organo.descripcion LIKE '%{$this->Session->read('Estudio.buscar_valor')}%'");
              break;
          }

          $this->set('data',$this->paginate('Estudio', $options));

          return $this->render('index');


      }      
}
?>
