<?php

class ProtocolosController extends AppController {
     
    public $helpers = array('Html', 'Form');     
    public $uses = array('Citologia','Medico','Organoscitologia','Paciente');
    var $components = array('RequestHandler');
//$this->Html->url(array('controller'=>'algo'));

    public function  __construct($request = null, $response = null) {
        parent::__construct($request, $response);
        
        # Obtengo los datos de todos los modelos para dar de alta protocolos
        $this->citologias        = $this->Citologia->find('list');     
        $this->medicos           = $this->Medico->find('list',array('fields' => 'Medico.razon_social'));     
        $this->organoscitologias = $this->Organoscitologia->find('list');     
        $this->pacientes         = $this->Paciente->find('list',array('fields' => 'Paciente.dni'));       

    }  
    
    public function index() {

        $this->set('data',$this->Citologia->find('all'));
        
    }
    public function add() {

        //$this->set('data',$this->Organoscitologia->find('all'));
        $this->set('pacientes',$this->pacientes);
        $this->set('medicos',$this->medicos);
    }
    
    public function search(){
         $respuesta = array ();
         $this->autoRender=false;
         $pacientes=$this->Paciente->find('all',array('conditions'=>array('Paciente.razon_social LIKE'=>'%'.$_GET['term'].'%')));
                $i=0;
                foreach($pacientes as $p){
                    $respuesta[$i]['value']=$p['Paciente']['dni'] . ' - ' . $p['Paciente']['razon_social'];
                $i++;
                }
            echo json_encode($respuesta);
    }	    
    
}
?>
