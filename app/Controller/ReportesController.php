<?php
App::uses('CakeTime', 'Utility');

class ReportesController extends AppController{
    
    public $name = 'Reportes';

    public $uses = array(
                     'Reporte',  
                     'Protocolo',
                     'Medico',
                     'Organo',
                     'Paciente',
                     'Sanatorio',
                     'Obrasocial',
                     'Estudio'
                    );
    
    public $facturaciones;
    public $tipo_reporte = array('Excel');
    
    public $paginate = array(
        'limit' => 100,
        'order' => array(
            'Protocolo.id' => 'desc'
        )
    );	
    public function __construct($request = null, $response = null) {
        parent::__construct($request, $response);
        
    }
    
    public function index(){
        
    }
    
    public function reporteFacturacion(){

        
        
            $data = $this->paginate($this->Reporte->query_practicas_x_totales());
            //$this->set(compact('data'));
            $this->set('data' ,$data);
        //    pr($data);
         //   die();
        }
}
?>
