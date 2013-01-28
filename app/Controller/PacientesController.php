<?php
class PacientesController extends AppController {
     
    public $helpers = array('Html', 'Form');    
 
    public $uses = array('Paciente','Localidad');
    public $localidades = array();

    public $paginate = array(
        'limit' => 10,
        'order' => array(
            'Paciente.id' => 'desc'
        )
    );
    
    public function  __construct($request = null, $response = null) {
        parent::__construct($request, $response);
        
        # Obtengo todas las localidades para mostrarlas en el alta
        $this->localidades = $this->Localidad->find('list');     

    }    
 
    public function index() {
        $data = $this->paginate('Paciente');
        $this->set(compact('data'));
        //$this->set('data',$this->Paciente->find('all'));

    }
     
    public function add() {
        
        $this->set('localidades', $this->localidades);
        
        if(!empty($this->data)){            
            if ($this->Paciente->save($this->data)) {
                   
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
                 $this->Paciente->id = $id;           
                 $this->request->data = $this->Paciente->read();
             } else {
                     $this->Session->setFlash( MSJ_REG_EDT_ERR );
                     $this->redirect(array('action' => 'index'));
             } 
         } else {
             
         if(!empty($this->data)){            
            if ($this->Paciente->save($this->data)) {
                   
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
        if ($this->Paciente->delete($id, true)) {
            $this->Session->setFlash( MSJ_REG_DEL_OK );
            $this->redirect(array('action' => 'index'));
        }
    }     

    public function search(){
        $respuesta = array ();
        $this->autoRender=false;
        
        $pacientes=$this->Paciente->find('all',
                                         array(
                                              'conditions'=>array(
                                                                   'Paciente.dni LIKE' => '%'.$_GET['term'].'%'
                                                                 )
                                             )
                                        );
        
        if (empty($pacientes)) 
        {
            $pacientes=$this->Paciente->find('all',
                                             array(
                                                  'conditions'=>array(
                                                                       'Paciente.razon_social LIKE' => '%'.$_GET['term'].'%'
                                                                     )
                                                 )
                                            );
        }
        
        $i=0;
        foreach($pacientes as $p){
            $respuesta[$i]['value']=$p['Paciente']['id'] . ' - ' . $p['Paciente']['razon_social'] . ' (' . $p['Paciente']['dni'] . ')';
        $i++;
        }
       return json_encode($respuesta);
   }	    
 
    public function search_paciente() {

          if(!empty($this->data)) {

              $buscar_valor = $this->Session->read('Paciente.buscar_valor');
              $buscar_por = $this->Session->read('Paciente.buscar_por');

              if(empty($buscar_valor) || empty($buscar_por)) {
                      $this->Session->write('Paciente.buscar_valor', $this->data['Paciente']['buscar_valor']);
                      $this->Session->write('Paciente.buscar_por', $this->data['Paciente']['buscar_por']);
              }

              if($this->data['Paciente']['buscar_valor'] != $this->Session->read('Paciente.buscar_valor')){
                  $this->Session->delete('Paciente.buscar_valor');
                  $this->Session->write('Paciente.buscar_valor', $this->data['Paciente']['buscar_valor']);
              }
              if( $this->data['Paciente']['buscar_por'] != $this->Session->read('Paciente.buscar_por')){
                  $this->Session->delete('Paciente.buscar_por');
                  $this->Session->write('Paciente.buscar_por', $this->data['Paciente']['buscar_por']);
              }
          }

          $options = array();

          switch ($this->Session->read('Paciente.buscar_por')) {
              case 1:
                  $options = array("Paciente.dni = '{$this->Session->read('Paciente.buscar_valor')}'");
              break;
              case 2:
                  $options = array("Paciente.razon_social LIKE '%{$this->Session->read('Paciente.buscar_valor')}%'");
              break;
          }

          $this->set('data',$this->paginate('Paciente', $options));

          return $this->render('index');


      }   
     
}
?>
