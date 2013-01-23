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
	
    public function __construct($request = null, $response = null) {
        parent::__construct($request, $response);
        
    }
    
    public function index(){
        
    }
    
    public function reporteFacturacion(){
                                         
            $data = $this->Reporte->query_practicas_x_totales();
            $this->set('data' ,$data);
        //    pr($data);
         //   die();
        }
}
?>
