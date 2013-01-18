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
    
    public function reporteFacturacion(){

            $data = $this->Protocolo->find('all');

            $this->set('data', $data);
            
            if(!empty($data)){
            
                $this->set('title', 'Reporte Altas/Bajas Socios');
                $this->set('model', array('Protocolo'));
                $this->set('tipo_salida', 'XLS');
                $this->set('pref', '');
                $this->set('blacklist', array('id'));
                $this->set('date', array('fecha'));
                $this->set('money', null);
                return $this->render('reporte', 'ajax');
            }
      
        }
}
?>
