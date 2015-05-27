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
      
    public function reporteFacturacioniosper ($id = null , $modo = 0 , $logo = 2 , $fecha_periodo = '201504') {
                
                # Base inicial para armar los cupones
                # cursor que va protocolo por protocolo
                
                 $base_inicial  = $this->Reporte->query_reporte_4();

                 $pdf = new pdf_header();
                 $pdf->FPDF('P','cm','A4');
                 $pdf->AliasNbPages();
                 $pdf->SetAutoPageBreak(true,0.2);
                 $pdf->SetMargins(0,0,0);
                 $pdf->SetTopMargin(11);

                foreach ($base_inicial as $b)
                {    

                 $id=  $b['protocolos']['id'];

                 /* Matriz para armar el cupon */

                 $data = $this->Reporte->query_reporte_3($fecha_periodo , $id);

                 //ob_end_clean(); # Importante para limpiar el buffer
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
                 $Comp_nuc          = $protocolo['Protocolo']['NUC'];

                 # Datos para el cupon de IOSPER
                 $cup_iosper_sanatorio  = $protocolo['Sanatorio']['descripcion'];
                 $cup_iosper_paciente   = $protocolo['Paciente']['razon_social'];
                 
                 if ($protocolo['Paciente']['dni'] <> '0')
                    $cup_iosper_dni        = $protocolo['Paciente']['dni'];
                 else $cup_iosper_dni   = '-';

                 $cup_iosper_fingreso   = $protocolo['Protocolo']['fecha'];
                 $cup_iosper_codinter   = $protocolo['Protocolo']['NUC'];
                 $cup_iosper_fegreso    = date("Y-m-d");
                 
                 if ((trim ($protocolo['Paciente']['apellido']) <> null) ||
                     (trim ($protocolo['Paciente']['apellido']) <> '') )
                 { 
                     $Comp_Apellido     = trim ($protocolo['Paciente']['apellido']);
                 }else 
                 {
                     $Comp_Apellido     = 'SinApellido'; 
                 }
                
                 
                 $pdf->put_header(
                                    $logo,$Comp_ProtocoloNro,$Comp_Fecha,
                                    $Comp_Paciente,$Comp_Edad,$Comp_Medico,
                                    $Comp_Organo,$Comp_nuc
                                 );
                     
                 $pdf->AddPage();            
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
                 $ordenada_x = $pdf->GetY();
                 $pdf->Image(IMAGES . 'firma_pdf.png',15.98,$ordenada_x+1,2,1.5);

                 $pdf->SetFont('Arial','B',9);
                 $pdf->SetXY(16,$pdf->GetY()+2.5);
                 $pdf->Cell(3.5,0.22,'Dra. Silvia I. Viale'); 
                 
                 $pdf->SetFont('Arial','B',6);
                 $pdf->SetXY(16.35,$pdf->GetY()+0.30);
                 $pdf->Cell(3.5,0.22,'Medica Patologa');                   
                 
                 $pdf->SetFont('Arial','B',6);
                 $pdf->SetXY(16.80,$pdf->GetY()+0.30);
                 $pdf->Cell(3.5,0.22,'M.P 6939');    


                 // Cupon para IOSPER *****

                  /* Primer linea */
                  $pdf->Line(2, $pdf->GetY()+0.90 , 19, $pdf->GetY()+0.90);
                  $pdf->Line(2, $pdf->GetY()+0.91 , 19, $pdf->GetY()+0.91);
                  $pdf->Line(2, $pdf->GetY()+0.92 , 19, $pdf->GetY()+0.92);
                  $pdf->Line(2, $pdf->GetY()+0.93 , 19, $pdf->GetY()+0.93);
                  $pdf->Line(2, $pdf->GetY()+0.94 , 19, $pdf->GetY()+0.94);

                  $pdf->SetY($pdf->GetY()+0.94); # Seteo la coordenada Y

                  # Titulo del cupon
                  $pdf->SetFont('Arial','B',11);
                  $pdf->Line(2 , $pdf->GetY() , 2, $pdf->GetY()+8.9);       # Linea vertical larga renglon izquierdo
                 
                  $pdf->Line(19 , $pdf->GetY() , 19, $pdf->GetY()+8.9);     # Linea vertical larga renglon derecho
                  
                  $pdf->SetXY(8,$pdf->GetY()+0.2);
                  $pdf->Cell(3.5,0.22,'Planilla Honorarios Medicos'); 


                  $pdf->Line(2, $pdf->GetY()+0.40 , 19, $pdf->GetY()+0.40);
                  $pdf->Line(2, $pdf->GetY()+0.41 , 19, $pdf->GetY()+0.41);
                  $pdf->Line(2, $pdf->GetY()+0.42 , 19, $pdf->GetY()+0.42);
                  $pdf->Line(2, $pdf->GetY()+0.43 , 19, $pdf->GetY()+0.43);
                  $pdf->Line(2, $pdf->GetY()+0.44 , 19, $pdf->GetY()+0.44);

                  $pdf->SetY($pdf->GetY()+0.45); # Seteo la coordenada Y

                  /* Segundo titulo */
                  $pdf->SetFont('Arial','B',11);
                  $pdf->SetXY(7.8,$pdf->GetY()+0.2);
                  $pdf->Cell(3.5,0.22,'Exclusivo Anatomia Patologica'); 

                  $pdf->Line(2, $pdf->GetY()+0.40 , 19, $pdf->GetY()+0.40);
                  $pdf->Line(2, $pdf->GetY()+0.41 , 19, $pdf->GetY()+0.41);
                  $pdf->Line(2, $pdf->GetY()+0.42 , 19, $pdf->GetY()+0.42);
                  $pdf->Line(2, $pdf->GetY()+0.43 , 19, $pdf->GetY()+0.43);
                  $pdf->Line(2, $pdf->GetY()+0.44 , 19, $pdf->GetY()+0.44);

                  $pdf->Line(10.3, $pdf->GetY()+0.44 , 10.3, $pdf->GetY()+3.0); # Linea vertical de Sanatorio, paciente, etc...
                  $pdf->Line(10.3, $pdf->GetY()+1 , 19, $pdf->GetY()+1);        # Linea horizontal
                  $pdf->Line(10.3, $pdf->GetY()+1.6 , 19, $pdf->GetY()+1.6);    # Linea horizontal
                  $pdf->Line(10.3, $pdf->GetY()+2.2 , 14, $pdf->GetY()+2.2);    # Linea horizontal cortita
                  $pdf->Line(14  , $pdf->GetY()+1.6 , 14, $pdf->GetY()+3);      # Linea vertical cortita
                  $pdf->Line(7.8 , $pdf->GetY()+3.0 , 19, $pdf->GetY()+3.0);    # Linea horizontal
                  $pdf->Line(7.8 , $pdf->GetY()+3.0 , 7.8, $pdf->GetY()+3.6);   # Linea vertical cortita
                  $pdf->Line(2 , $pdf->GetY()+3.6 , 19, $pdf->GetY()+3.6);    # Linea horizontal  arriba de "codigo internacion"                
                  $pdf->Line(4 , $pdf->GetY()+4.2 , 19, $pdf->GetY()+4.2);    # Linea horizontal  debajo de "codigo internacion"

                  $pdf->Line(4 , $pdf->GetY()+3.6 , 4, $pdf->GetY()+6.9);      # Linea vertical cortita Donde dice Fecha
                                                                              # debajo del logo  continua hacia abajo

                  $pdf->Line(14  , $pdf->GetY()+3.6, 14, $pdf->GetY()+6.9);    # Linea vertical cortida que divide prestaciones 
                                                                              # y profesional. Continua hasta abajo  

                  $pdf->Line(2 , $pdf->GetY()+4.8 , 19, $pdf->GetY()+4.8);    # Linea horizontal  de los titulos: fecha codgo descripcion firma sello matricula
                  
                  $pdf->Line(17.3  , $pdf->GetY()+4.2, 17.3, $pdf->GetY()+6.9); # Linea vertical cortida que divide prestaciones 
                                                                               # y profesional. Continua hasta abajo

                  $pdf->Line(7.8  , $pdf->GetY()+4.2, 7.8, $pdf->GetY()+6.9);   # Linea vertical que divide codigo 
                                                                               # y descripcion. Continua hasta abajo  

                  $pdf->Line(2 , $pdf->GetY()+5.5 , 19, $pdf->GetY()+5.5);     # Linea horizontal renglon -1 
                  $pdf->Line(2 , $pdf->GetY()+6.2 , 19, $pdf->GetY()+6.2);     # Linea horizontal renglon -2 
                  $pdf->Line(2 , $pdf->GetY()+6.9 , 19, $pdf->GetY()+6.9);     # Linea horizontal renglon -3 

                  $pdf->Line(10.3, $pdf->GetY()+6.9, 10.3, $pdf->GetY()+8.1);   # Linea vertical del footer
                  $pdf->Line(2 , $pdf->GetY()+8.1 , 19, $pdf->GetY()+8.1);      # Linea horizontal final
                  


                  # Titulos de cada renglon
                  $pdf->SetFont('Arial','B',9);
                  $pdf->SetXY(7.8,$pdf->GetY()+0.65);
                  $pdf->Cell(3.5,0.22,'Sanatorio:           ' . $cup_iosper_sanatorio);
                  $pdf->SetXY(7.8,$pdf->GetY()+0.65);
                  $pdf->Cell(3.5,0.22,'Paciente:            ' . $cup_iosper_paciente); 
                  $pdf->SetX(3.5);
                  //$pdf->Cell(3.5,0.22,'I . O . S . P . E . R');    
                  $pdf->Image(IMAGES . 'logo_iosper.jpg',$pdf->GetX(),$pdf->GetY()-0.5,3,2.5);              
                  $pdf->SetXY(7.8,$pdf->GetY()+0.65);
                  $pdf->Cell(3.5,0.22,'Fecha Ingreso:  ' . $cup_iosper_fingreso);
                  $pdf->SetX(14);
                  $pdf->Cell(3.5,0.22,'DNI ' . $cup_iosper_dni);                                   
                  $pdf->SetXY(7.8,$pdf->GetY()+0.65);
                  $pdf->Cell(3.5,0.22,'Fecha Egreso:   ' . $cup_iosper_fegreso); 
                  $pdf->SetXY(7.8,$pdf->GetY()+0.65);
                  $pdf->Cell(3.5,0.22,'Codigo Internacion:  ' . $cup_iosper_codinter); 
                  $pdf->SetXY(7.8,$pdf->GetY()+0.65);
                  $pdf->Cell(3.5,0.22,'Prestaciones'); 
                  $pdf->SetX(16);
                  $pdf->Cell(3.5,0.22,'Profesional'); 
                  $pdf->SetXY(2.1,$pdf->GetY()+0.65);
                  $pdf->Cell(3.5,0.22,'Fecha');
                  $pdf->SetX(4);
                  $pdf->Cell(3.5,0.22,'Codigo'); 
                  $pdf->SetX(7.9);
                  $pdf->Cell(3.5,0.22,'Descripcion'); 
                  $pdf->SetX(14.5);
                  $pdf->Cell(3.5,0.22,'Firma - Sello'); 
                  $pdf->SetX(17.3);
                  $pdf->Cell(3.5,0.22,'Matricula');

                  /* Contenido de las practicas */
                   
                   foreach ($data as $d)
                     {   
                      $pdf->SetXY(2.1,$pdf->GetY()+0.65);
                      $pdf->Cell(3.5,0.22,date('Y-m-d'));
                      $pdf->SetX(4);
                      $pdf->Cell(3.5,0.22,$d['vw_base_cupones_iosper']['Practica'] . ' x' . $d['vw_base_cupones_iosper']['Cantidad_practica']);
                      $pdf->SetX(7.9);
                      $pdf->Cell(3.5,0.22,'');
                      $pdf->SetX(14.5);
                      $pdf->Cell(3.5,0.22,'Viale Silvia');
                      $pdf->SetX(17.3);
                      $pdf->Cell(3.5,0.22,'6939');
                     }       

                 switch (count($data)) {
                         case 3:
                                  $pdf->SetXY(14,$pdf->GetY()+0.55);
                                  $pdf->Cell(3.5,0.22,'Para Entidad Medica');                    
                                  $pdf->SetXY(2.1,$pdf->GetY()+0.8);
                                  $pdf->Cell(3.5,0.22,'Firma Administrador del Sanatorio');                                         

                             break;

                         case 2:
                                  $pdf->SetXY(14,$pdf->GetY()+1.2);
                                  $pdf->Cell(3.5,0.22,'Para Entidad Medica');                    
                                  $pdf->SetXY(2.1,$pdf->GetY()+0.8);
                                  $pdf->Cell(3.5,0.22,'Firma Administrador del Sanatorio'); 
                             break;

                          case 1:
                                  $pdf->SetXY(14,$pdf->GetY()+1.75);
                                  $pdf->Cell(3.5,0.22,'Para Entidad Medica');                    
                                  $pdf->SetXY(2.1,$pdf->GetY()+0.8);
                                  $pdf->Cell(3.5,0.22,'Firma Administrador del Sanatorio'); 
                             break;

                         default:
                                  $pdf->SetXY(14,$pdf->GetY()+2.45);
                                  $pdf->Cell(3.5,0.22,'Para Entidad Medica');                    
                                  $pdf->SetXY(2.1,$pdf->GetY()+0.8);
                                  $pdf->Cell(3.5,0.22,'Firma Administrador del Sanatorio'); 
                             break;
                     }  

                     
                 }
                 
                    $data_ = $pdf->Output(null , 'S');
                    $this->set('id', 'FacturacionIOSPER'.$fecha_periodo);
                    $this->set('pdf_comprobantes', $data_);
                    $this->render('reporte_facturacioniosper', 'ajax');
                 


    }          
        
}
?>
