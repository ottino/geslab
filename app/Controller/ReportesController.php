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
        'limit' => 10,
        'order' => array(
                         'Reporte.fecha' => 'asc'
                        )
    );	
    
    public function __construct($request = null, $response = null) {
        parent::__construct($request, $response);
        
                $this->reportes = $this->Reporte->find('list');    
                
    }
    
    public function index(){
        
           $data = $this->Reporte->find('list');
                        
            $this->set('data', $data);
            
            if(!empty($data)){
            
                $this->set('title', 'Reporte de Cobranza');
                $this->set('model', 'Reporte');
                $this->set('tipo_salida', 'XLS');
                $this->set('pref', '');
                $this->set('blacklist', null);
                $this->set('date', array('Fecha'));
                //$this->set('money', array('Comp__Importe'));
                
                return $this->render('index', 'ajax');
 

    }
    }
    
    public function reporteFacturacion(){     
            $data = $this->paginate('Reporte');
            $this->set(compact('data'));
            //$this->set('data' ,$data);
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

          $this->set('data',$this->paginate('Reporte', $options));

          return $this->render('reporteFacturacion');
          //return $this->render('index','ajax');


      }            
}
?>
