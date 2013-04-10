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
        'order' => array(
                         'Reporte.fecha' => 'asc'
                        )
    );	
    
    public function __construct($request = null, $response = null) {
        parent::__construct($request, $response);
        
                $this->reportes = $this->Reporte->find('list');    
                
    }
    
    public function index(){
        
                      
    }
    
    public function reporteFacturacion(){     

        }
 
    public function search() {

          if(!empty($this->data)) {

              $buscar_valor = $this->Session->read('Reporte.buscar_valor');
              $buscar_por = $this->Session->read('Reporte.buscar_por');

              if(empty($buscar_valor) || empty($buscar_por)) {
                      $this->Session->write('Reporte.buscar_valor', $this->data['Reporte']['buscar_valor']);
                      $this->Session->write('Reporte.buscar_por', $this->data['Reporte']['buscar_por']);
              }

              if($this->data['Reporte']['buscar_valor'] != $this->Session->read('Reporte.buscar_valor')){
                  $this->Session->delete('Reporte.buscar_valor');
                  $this->Session->write('Reporte.buscar_valor', $this->data['Reporte']['buscar_valor']);
              }
              if( $this->data['Reporte']['buscar_por'] != $this->Session->read('Reporte.buscar_por')){
                  $this->Session->delete('Reporte.buscar_por');
                  $this->Session->write('Reporte.buscar_por', $this->data['Reporte']['buscar_por']);
              }
          }

          $options = array();

          switch ($this->Session->read('Reporte.buscar_por')) {
              case 1:
                  $options = array("Reporte.Periodo LIKE '%{$this->Session->read('Reporte.buscar_valor')}%'");
              break;
              case 2:
                  $options = array("Reporte.Sanatorio LIKE '%{$this->Session->read('Reporte.buscar_valor')}%'");
              break;
              case 3:
                  $options = array("Reporte.Obra_Social LIKE '%{$this->Session->read('Reporte.buscar_valor')}%'");
              break;
          }

          $this->set('data',
                  $this->Reporte->find('all',
                                             array(
                                                  'conditions'=>$options['0']
                                                   )                                                 
                                            ));     
                  
          return $this->render('index','ajax');
      }            
}
?>
