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
        
                //$this->reportes = $this->Reporte->find('list');   
        $this->obrasociales      = $this->Obrasocial->find('list',array('fields' => 'Obrasocial.desc_corta',
                                                'order' => array('Obrasocial.descripcion' => 'asc')));

        $this->sanatorios        = $this->Sanatorio->find('list',array('fields' => 'Sanatorio.desc_corta',
                                        'order' => array('Sanatorio.descripcion' => 'asc')));                  
    }
    
    public function index(){
        
                      
    }
    
    public function reporteFacturacion(){     
        
        $this->set('sanatorios'        , $this->sanatorios);
        $this->set('obrasociales'      , $this->obrasociales);
        
        }
 
    public function search() {
        
        //pr($this->request->data);
        
        $filtro = " WHERE ";
        $obrasocial_id  = $this->request->data['Reporte']['obrasocial_id'];
        $sanatorio_id   = $this->request->data['Reporte']['sanatorio_id'];
        $fecha_inicio   = $this->request->data['Reporte']['fecha_inicio'];
        $fecha_fin      = $this->request->data['Reporte']['fecha_fin'];
        $internacion    = $this->request->data['Reporte']['internacion'];
        $ambulatorio    = $this->request->data['Reporte']['ambulatorio'];
        
        if (!empty($obrasocial_id))
            $filtro1 = "obrasocial_id = ".$obrasocial_id. " AND ";
        else 
            $filtro1 = '';
        
        if (!empty($sanatorio_id))
            $filtro2 = "sanatorio_id = ".$sanatorio_id. " AND ";
        else 
            $filtro2 = '';
                
        if (!empty($fecha_inicio) && !empty($fecha_fin))
            $filtro3 = "fecha between ". $fecha_inicio . " AND ".$fecha_fin. " AND ";
        else 
            $filtro3 = '';
                
        if (!empty($internacion))
            $filtro4 = "internacion is true AND ";
        else 
            $filtro4 = "(internacion is false OR internacion is true) AND ";

        if (!empty($ambulatorio))
            $filtro5 = "ambulatorio is true" ;
        else 
            $filtro5 = "(ambulatorio is false OR ambulatorio is true)" ;
        
        
        $filtro = $filtro . $filtro1 . $filtro2 . $filtro3 . $filtro4 . $filtro5; 

       // var_dump($filtro1);
       // die();
        
        if( $filtro1 == '' && $filtro2 == '' && $filtro3 == '' )
        {
            $this->Session->setFlash( MSJ_REP_ERR. " Sanatorio - Obra Socia - Fechas de inicio y fin" );
            
            $this->set('sanatorios'        , $this->sanatorios);
            $this->set('obrasociales'      , $this->obrasociales);
        
            return $this->render('reporte_facturacion');
        }
        
        $data = $this->Reporte->query_reporte($filtro);
        $this->set('data' ,$data);
        return $this->render('index','ajax');

      }   
        
}
?>
