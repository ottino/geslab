<?php
class MedicosController extends AppController {
     
    public $helpers = array('Html', 'Form');    
 
    public $uses = array('Medico','Localidad');
    public $localidades = array();

    public $paginate = array(
        'limit' => 10,
        'order' => array(
            'Medico.id' => 'desc'
        )
    );
    
    public function  __construct($request = null, $response = null) {
        parent::__construct($request, $response);
        
        # Obtengo todas las localidades para mostrarlas en el alta
        $this->localidades = $this->Localidad->find('list');     

    }    
 
    public function index() {

        //$this->set('data',$this->Medico->find('all'));
        $data = $this->paginate('Medico');
        $this->set(compact('data'));
    }
     
    public function add() {
        
        $this->set('localidades', $this->localidades);
        
        if(!empty($this->data)){            
            if ($this->Medico->save($this->data)) {
                   
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
                 $this->Medico->id = $id;           
                 $this->request->data = $this->Medico->read();
             } else {
                     $this->Session->setFlash( MSJ_REG_EDT_ERR );
                     $this->redirect(array('action' => 'index'));
             } 
         } else {
             
         if(!empty($this->data)){            
            if ($this->Medico->save($this->data)) {
                   
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
        if ($this->Medico->delete($id, true)) {
            $this->Session->setFlash( MSJ_REG_DEL_OK );
            $this->redirect(array('action' => 'index'));
        }
    }     

    public function search(){
        $respuesta = array ();
        $this->autoRender=false;
        $pacientes=$this->Medico->find('all',
                                         array('conditions'=>array('Medico.razon_social LIKE'=>'%'.$_GET['term'].'%'))
                                        );
        $i=0;
        foreach($pacientes as $p){
            $respuesta[$i]['value']=$p['Medico']['id'] . ' - ' . $p['Medico']['razon_social'] . ' (' . $p['Medico']['matricula'] . ')';
        $i++;
        }
       return json_encode($respuesta);
    }    

    public function search_medico() {

          if(!empty($this->data)) {

              $buscar_valor = $this->Session->read('Medico.buscar_valor');
              $buscar_por = $this->Session->read('Medico.buscar_por');

              if(empty($buscar_valor) || empty($buscar_por)) {
                      $this->Session->write('Medico.buscar_valor', $this->data['Medico']['buscar_valor']);
                      $this->Session->write('Medico.buscar_por', $this->data['Medico']['buscar_por']);
              }

              if($this->data['Medico']['buscar_valor'] != $this->Session->read('Medico.buscar_valor')){
                  $this->Session->delete('Medico.buscar_valor');
                  $this->Session->write('Medico.buscar_valor', $this->data['Medico']['buscar_valor']);
              }
              if( $this->data['Medico']['buscar_por'] != $this->Session->read('Medico.buscar_por')){
                  $this->Session->delete('Medico.buscar_por');
                  $this->Session->write('Medico.buscar_por', $this->data['Medico']['buscar_por']);
              }
          }

          $options = array();

          switch ($this->Session->read('Medico.buscar_por')) {
              
              case 1:
                  $options = array("Medico.razon_social LIKE '%{$this->Session->read('Medico.buscar_valor')}%'");
              break;
          
          }

          $this->set('data',$this->paginate('Medico', $options));

          return $this->render('index');


      }       
}
?>
