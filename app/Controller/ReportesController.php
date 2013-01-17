<?php
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
        
        $this->facturaciones = $this->Protocolo->find('list');
    }
    
    public function index(){
        
    }
    
    public function reporte_facturacion(){

            $data = 'Maxi';
            $this->set('title', 'Reporte Cuotas Por Cobradores');
            $this->set('model', 'Protocolo');
            $this->set('data', $data);
            
            return $this->render('reporte', 'ajax');
      
        }
}
?>
