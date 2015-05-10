<?php
App::uses('CakeTime', 'Utility');

App::import('Vendor', 'EnviaMail', array('file'=>'EnviaMail'.DS.'class.phpmailer.php')  );
App::import('Vendor', 'fpdf', array('file'=>'fpdf'.DS.'fpdf.php')  );
App::import('Vendor', 'PDF_AutoPrint', array('file'=>'fpdf'.DS.'PDF_AutoPrint.php')  );
App::import('Vendor', 'pdf_header', array('file'=>'fpdf'.DS.'pdf_header.php')  );

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
    public function reporteRendicion(){     
        
        $this->set('sanatorios'        , $this->sanatorios);
        $this->set('obrasociales'      , $this->obrasociales);
        
        }
 
    public function search_facturacion() {
        
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
        return $this->render('facturacion','ajax');

      }   
      
    public function search_rendicion() {
        
        //$filtro = " WHERE ";
        $filtro = null;
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
        
            return $this->render('reporte_rendicion');
        }
        
        $data = $this->Reporte->query_reporte_2($filtro);
        $this->set('data' ,$data);
        return $this->render('rendicion','ajax');

      }   
      
    public function reporteFacturacioniosper ($id = null , $modo = 0 , $logo = 2) {
                
                 $id=  990050382;

                 ob_end_clean(); # Importante para limpiar el buffer
                                 # Para error: "FPDF error: Some data has already been output, can't send PDF file"
                 $this->Protocolo->id = $id;           
                 $protocolo = $this->Protocolo->read();
                
                 /* Datos para el comprobante */
                 $Comp_ProtocoloNro = $protocolo['Protocolo']['id'];
                 $Comp_Paciente     = $protocolo['Paciente']['razon_social'];
                 $Comp_Medico       = $protocolo['Medico']['razon_social'];
                 $Comp_Organo       = $protocolo['Organo']['descripcion'];
                 $Comp_Macroscopia  = $protocolo['Protocolo']['macroscopia'];
                 $Comp_Microscopia  = $protocolo['Protocolo']['microscopia'];
                 $Comp_Diagnostico  = $protocolo['Protocolo']['diagnostico'];
                 $Comp_Material     = $protocolo['Protocolo']['material'];
                 $Comp_Edad         = $protocolo['Paciente']['edad'];
                 $Comp_Fecha        = $protocolo['Protocolo']['fecha'];
                 
                 if ((trim ($protocolo['Paciente']['apellido']) <> null) ||
                     (trim ($protocolo['Paciente']['apellido']) <> '') )
                 { 
                     $Comp_Apellido     = trim ($protocolo['Paciente']['apellido']);
                 }else 
                 {
                     $Comp_Apellido     = 'SinApellido'; 
                 }
                 
                 if ($modo == 0)
                 {     
                     $pdf = new pdf_header();
                     $pdf->put_header(
                                        $logo,$Comp_ProtocoloNro,$Comp_Fecha,
                                        $Comp_Paciente,$Comp_Edad,$Comp_Medico,
                                        $Comp_Organo
                                     );
                     
                 } else if ($modo == 1)
                 {
                     $pdf = new PDF_AutoPrint();
                     $pdf->put_header(
                                        $logo,$Comp_ProtocoloNro,$Comp_Fecha,
                                        $Comp_Paciente,$Comp_Edad,$Comp_Medico,
                                        $Comp_Organo
                                     );
                 }
                 
                 $pdf->FPDF('P','cm','A4');


                 $pdf->AddPage();
                 $pdf->AliasNbPages();
                 $pdf->SetAutoPageBreak(true,0.2);
                 $pdf->SetMargins(0,0,0);
                 $pdf->SetTopMargin(11);
                             
                 /* Datos de Macroscopia */
                 if (($Comp_Macroscopia != null) or (trim($Comp_Macroscopia) != ''))
                 {
                    $pdf->SetFont('Arial','B',8);
                    $pdf->SetXY(0.20,$pdf->GetY()+0.3);
                    $pdf->Cell(3.5,0.22,'Macroscopia:');   

                    $pdf->SetFont('Arial','',7);
                    $pdf->SetXY(0.90,$pdf->GetY()+0.3);
                    $pdf->MultiCell(0,0.4,utf8_decode($Comp_Macroscopia));
                 }
                 
                 /* Datos de Microscopia */
                 if (($Comp_Microscopia != null) or (trim($Comp_Microscopia) != ''))
                 {
                    $pdf->SetFont('Arial','B',8);
                    $pdf->SetXY(0.20,$pdf->GetY()+1);
                    $pdf->Cell(3.5,0.22,'Microscopia:');   

                    $pdf->SetFont('Arial','',7);
                    $pdf->SetXY(0.90,$pdf->GetY()+0.6);
                    $pdf->MultiCell(0,0.4,utf8_decode($Comp_Microscopia));
                 }

                 if (($Comp_Material != null) or (trim($Comp_Material) != ''))
                 {
                    $pdf->SetFont('Arial','B',8);
                    $pdf->SetXY(0.20,$pdf->GetY()+1);
                    $pdf->Cell(3.5,0.22,'Meterial Remitido:');   

                    $pdf->SetFont('Arial','',7);
                    $pdf->SetXY(0.90,$pdf->GetY()+0.6);
                    $pdf->MultiCell(0,0.4,utf8_decode($Comp_Material));
                 }
                 
                 /* Datos de Diagnostico */               
                 $pdf->SetFont('Arial','B',8);
                 $pdf->SetXY(0.20,$pdf->GetY()+0.4);
                 $pdf->Cell(3.5,0.22,'Diagnostico:');   

                 $pdf->SetFont('Arial','',7);
                 $pdf->SetXY(0.90,$pdf->GetY()+0.3);
                 $pdf->MultiCell(0,0.4,utf8_decode($Comp_Diagnostico));
                
                 
                 /* Firma */
                 //$ordenada_x = $pdf->GetY();
                 //$pdf->Image(IMAGES . 'firma_pdf.png',15.94,$ordenada_x+3);

                 $pdf->SetFont('Arial','B',9);
                 $pdf->SetXY(16,$pdf->GetY()+2.5);
                 $pdf->Cell(3.5,0.22,'Dra. Silvia I. Viale'); 
                 
                 $pdf->SetFont('Arial','B',6);
                 $pdf->SetXY(16.35,$pdf->GetY()+0.30);
                 $pdf->Cell(3.5,0.22,'Medica Patologa');                   
                 
                 $pdf->SetFont('Arial','B',6);
                 $pdf->SetXY(16.80,$pdf->GetY()+0.30);
                 $pdf->Cell(3.5,0.22,'M.P 6939');    

                 $pdf->Output();

                 
                 /*
                 if ($modo == 0)
                 {   
                    $data = $pdf->Output(null , 'S');
                    $this->set('id', $Comp_ProtocoloNro);
                    $this->set('pdf_comprobantes', $data);
                    $this->render('reporte_facturacioniosper', 'ajax');
                    
                 }
                 */

    }          
        
}
?>
