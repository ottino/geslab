<?php
App::import('Vendor', 'EnviaMail', array('file'=>'EnviaMail'.DS.'class.phpmailer.php')  );
App::import('Vendor', 'fpdf', array('file'=>'fpdf'.DS.'fpdf.php')  );

class ProtocolosController extends AppController {
     
    public $helpers = array('Html', 'Form');     
    
    public $uses = array( 
                         'Protocolo',
                         'Medico',
                         'Organo',
                         'Paciente',
                         'Sanatorio',
                         'Obrasocial',
                         'Estudio'
                        );
    
    public $tipo_protocolo = array(
        'Citologia' => 'Citologia',
        'Biopsia'   => 'Biopsia'
    );  
    
    public $paginate = array(
        'limit' => 6,
        'order' => array('Protocolo.fecha' => 'desc')//,
       // 'conditions'=>array('Protocolo.fecha'=>'20130216')
    );
    
    var $components = array('RequestHandler');

    public function  __construct($request = null, $response = null) {
        parent::__construct($request, $response);
        
        # Obtengo los datos de todos los modelos para dar de alta protocolos
       // $this->protocolos        = $this->Protocolo->find('list');
                                        // array('conditions'=>array('Protocolo.fecha'=>'20130216'),
                                         //       'order'    => array('Protocolo.id' => 'asc'))
                                        //);     
        $this->sanatorios        = $this->Sanatorio->find('list',array('fields' => 'Sanatorio.descripcion',
                                        'order' => array('Sanatorio.descripcion' => 'asc'))                                             
                     );     
        $this->obrasociales      = $this->Obrasocial->find('list',array('fields' => 'Obrasocial.descripcion',
                                                        'order' => array('Obrasocial.descripcion' => 'asc')));
                                                                    
        $this->medicos           = $this->Medico->find('list',array('fields' => 'Medico.razon_social'));     
        $this->organoscitologia  = $this->Organo->find('list',
                                         array('conditions'=>array('Organo.tipoprotocolo ='=>'citologia'),
                                                'order'    => array('Organo.descripcion' => 'asc'))
                                        );
        $this->organosbiopsia    = $this->Organo->find('list',
                                         array('conditions'=>array('Organo.tipoprotocolo ='=>'biopsia'),
                                                'order'    => array('Organo.descripcion' => 'asc'))
                                        );
        
        $this->organos           = $this->Organo->find('list');       
        $this->pacientes         = $this->Paciente->find('list',array('fields' => 'Paciente.razon_social'));       
        $this->estudios          = $this->Estudio->find('list',array('fields' => 'Estudio.descripcion'));       

    }  
    
    public function index($vista_rapida = 0) {
        
        
        //$this->Protocolo->find('all', array('conditions'=>array('Protocolo.Fecha =' => '20130131' )) ); 
        //$data = $this->paginate('Protocolo');
        //$options = array("Protocolo.fecha = '20130131'");
        //$data = $this->paginate($this->set('data',$this->paginate('Protocolo', $options)));

        if ($vista_rapida == 1)
        {
            
            $data = $this->paginate('Protocolo',array('Protocolo.fecha'=>date("Y-m-d")));    
   
            $this->set(compact('data'));

        } else
        {
            $data = $this->paginate('Protocolo');
            $this->set(compact('data'));
        }
        //$this->set('data',$this->Protocolo->find('all'));
        
    }

    public function vista_rapida() {
       
       $this->redirect(array('action' => 'index' ,1)); 
       
    }

    public function puente_paciente() {
       
       //$this->redirect(array('action' => 'index' ,1)); 
       pr($this->request->data);
       die();
    }
    
    public function add() {

        $this->set('sanatorios'        , $this->sanatorios);
        $this->set('organos'           , $this->organos);
        $this->set('organoscitologia'  , $this->organoscitologia);
        $this->set('organosbiopsia'    , $this->organosbiopsia);
        $this->set('obrasociales'      , $this->obrasociales);
        $this->set('estudios'          , $this->estudios);
 
           if(!empty($this->data)){ 
             
           /* Formateo el array para guardar los datos */
               
           $paciente_id = explode("-",$this->data['Protocolo']['paciente_id']);
           $medico_id   = explode("-",$this->data['Protocolo']['medico_id']);
           
           $this->request->data['Protocolo']['paciente_id'] = $paciente_id[0];
           $this->request->data['Protocolo']['medico_id']   = $medico_id[0];
           $this->request->data['Protocolo']['fecha']   = date("Y-m-d");    
           
           $id_muestra = $this->request->data['Protocolo']['id'];
           
           //pr ($this->request->data);
           //die ();
            if  (!empty($this->data['Protocolo']['organo_citologia_id']))
            {
                    $this->request->data['Protocolo']['organo_id']      = $this->request->data['Protocolo']['organo_citologia_id'];
                    $this->request->data['Protocolo']['tipoprotocolo']  = 'citologia';
                    $this->request->data['Protocolo']['diagnostico']    = $this->request->data['Protocolo']['diagnosticocitologia'];
                    
            }
            else if  (!empty($this->data['Protocolo']['organo_biopsia_id'])) 
            {
                    $this->request->data['Protocolo']['organo_id'] = 
                    $this->request->data['Protocolo']['organo_biopsia_id'];
                    $this->request->data['Protocolo']['tipoprotocolo'] = 'biopsia';
                    $this->request->data['Protocolo']['diagnostico']    = $this->request->data['Protocolo']['diagnosticobiopsia'];

            }
            
           if ($this->Protocolo->save($this->data)) {
                
                  
                
                if($this->request->data['Protocolo']['checkadd_vista'] == 1)
                {
                   $this->redirect(array('action' => 'vista_preliminar' , 
                                         $this->request->data['Protocolo']['id'])
                                  ); 
                   
                } else 
                {
                    $this->Session->setFlash( MSJ_REG_AG_OK . ' Protocolo - ' . $id_muestra );  
                    //$this->redirect(array('action' => 'index'));                
                    //$this->redirect(array('action' => 'vista_rapida'));
                    $this->redirect(array('action' => 'edit' , 
                                    $this->request->data['Protocolo']['id'])
                                   );  
                }
                
                // Con esto vuelve al Index, 
                // pasando por la funcion index del controlador
                
                
                
            } else {
                     $this->Session->setFlash( MSJ_REG_AG_ERR );
                   }
            
           }
       
    }
  
    public function edit ($id = null){
   
        $this->set('sanatorios'        , $this->sanatorios);
        $this->set('organos'           , $this->organos);
        $this->set('organoscitologia'  , $this->organoscitologia);
        $this->set('organosbiopsia'    , $this->organosbiopsia);
        $this->set('obrasociales'      , $this->obrasociales);
        $this->set('estudios'          , $this->estudios);
        $this->set('pacientes'         , $this->pacientes);
        $this->set('medicos'           , $this->medicos);
        $this->set('tipo_protocolo'    , $this->tipo_protocolo);

        
         if ($this->request->is('get')) {
             if ($id <> null )
             {
                 $this->Protocolo->id = $id;           
                 $this->request->data = $this->Protocolo->read();
             } else {
                     $this->Session->setFlash( MSJ_REG_EDT_ERR );
                     $this->redirect(array('action' => 'index'));
             } 
         } else {
             
         if(!empty($this->data)){   

           $paciente_id = explode("-",$this->data['Protocolo']['paciente_id']);
           $medico_id   = explode("-",$this->data['Protocolo']['medico_id']);
           
           $this->request->data['Protocolo']['paciente_id'] = $paciente_id[0];
           $this->request->data['Protocolo']['diagnostico'] = '';
           $this->request->data['Protocolo']['medico_id']   = $medico_id[0];
           
           //$this->request->data['Protocolo']['fecha']   = date("Y-m-d");    
 
            if  (!empty($this->data['Protocolo']['organo_citologia_id']))
            {
                    $this->request->data['Protocolo']['organo_id'] = 
                    $this->request->data['Protocolo']['organo_citologia_id'];
                    $this->request->data['Protocolo']['tipoprotocolo'] = 'citologia';
                    $this->request->data['Protocolo']['diagnostico']    = $this->request->data['Protocolo']['diagnosticocitologia'];


            }
            else if  (!empty($this->data['Protocolo']['organo_biopsia_id'])) 
            {
                    $this->request->data['Protocolo']['organo_id'] = 
                    $this->request->data['Protocolo']['organo_biopsia_id'];
                    $this->request->data['Protocolo']['tipoprotocolo'] = 'biopsia';
                    $this->request->data['Protocolo']['diagnostico']    = $this->request->data['Protocolo']['diagnosticobiopsia'];
                    
            }

 
            if ($this->Protocolo->save($this->data)) {
                                  
               if($this->request->data['Protocolo']['checkadd_vista'] == 1)
                {
                   $this->redirect(array('action' => 'vista_preliminar' , 
                                         $this->request->data['Protocolo']['id'])
                                  );                   
                } else 
                {
                    $this->Session->setFlash( MSJ_REG_EDT_OK );  
                    //$this->redirect(array('action' => 'index'));
                    $this->redirect(array('action' => 'edit' , 
                                    $this->request->data['Protocolo']['id'])
                                   );  
                     //$this->redirect(array('action' => 'vista_rapida'));                
                }

                
                $this->redirect(array('action' => 'index'));
                
            } else {
                $this->Session->setFlash( MSJ_REG_EDT_ERR );
            }
           }
           
         }
           
     }
     
    public function delete($id = null ){
        if ($this->Protocolo->delete($id, true)) {
            $this->Session->setFlash( MSJ_REG_DEL_OK );
            //$this->redirect(array('action' => 'index'));
            $this->redirect(array('action' => 'vista_rapida'));
        }
    }
    
    public function envia_mail ($id = null) {

        $this->set('sanatorios'        , $this->sanatorios);
        $this->set('organos'           , $this->organos);
        $this->set('organoscitologia'  , $this->organoscitologia);
        $this->set('organosbiopsia'    , $this->organosbiopsia);
        $this->set('obrasociales'      , $this->obrasociales);
        $this->set('estudios'          , $this->estudios);
        
        // Genero PDF
        $this->genera_comprobante($id);
        //$this->set('pacientes'         , $this->pacientes);
       
       if ($this->request->is('get')) {
             if ($id <> null )
             {
                 // envio los datos a envia_mail.ctp
                 $this->Protocolo->id = $id;           
                 $this->request->data = $this->Protocolo->read();
                 $this->set('Protocolo',$this->request->data);
                 $this->set('Comp_Apellido',trim ($this->request->data['Paciente']['apellido']));
                 

             } else {
                     // error cuando no se puede abrir envia_mail.ctp
                     $this->Session->setFlash( MSJ_REG_EDT_ERR );
                     $this->redirect(array('action' => 'vista_rapida'));
             } 
         } else {
                 // cuando toco enviar vuelvo acá
                 $this->Protocolo->id = $id;           
                 $this->request->data = $this->Protocolo->read();
                 
                 $this->set('Protocolo',$this->request->data);
                 

                 $mail = new PHPMailer();
                 $mail->IsSMTP(); // telling the class to use SMTP

                 $body   = "Adjuto diagnostico.
                            Cualquier consulta responder al correo.
                            
                            Atte.-
                            Silvia Viale";
                 $mail->SetFrom('silvia.viale.pna@gmail.com', 'Silvia Viale');

                 $mail->Subject    = "Diagnostico";
                 $mail->MsgHTML($body);
                 
                 $address =  $this->request->data['Sanatorio']['email'];
                                 

                 //"silvia.viale.pna@gmail.com";
                 //$mail->AddAttachment("../../../tmp/Comprobantes.".$id.".pdf"); // attachment
                 $mail->AddAttachment('../../../tmp/Comp.' . $id . '.pdf'); 
                                     //  $Comp_Apellido . '.' . $id . '.pdf'); // attachment
                 
                 $mail->AddAddress($address, "Enviar correo a?");
       

                 if(!$mail->Send()) {
                      return "Error: " . $mail->ErrorInfo;
                 } else {
                          $this->Session->setFlash( MSJ_MAIL_OK );
                         // $this->redirect(array('action' => 'index'));
                          $this->redirect(array('action' => 'vista_rapida'));
                 }

         }
        
     }

    public function genera_comprobante ($id = null) {

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
                     
                 $pdf = new FPDF();

                 $pdf->FPDF('P','cm','A4');


                 $pdf->AddPage();
                 $pdf->AliasNbPages();
                 $pdf->SetAutoPageBreak(true,0.2);
                 $pdf->SetMargins(0,0,0);
                 $pdf->SetTopMargin(11);

                 /* Logo del comprobante */
                 $pdf->SetFont('Arial','',22);
                 $pdf->SetY(0.55);
                 $pdf->SetX(0.5);
                 $pdf->Cell(3.5,0.22,'SILVIA VIALE' );

                 $pdf->SetFont('Arial','',35);
                 $pdf->SetY(0.6);
                 $pdf->SetX(5.5);
                 $pdf->Cell(3.5,0.22,'| LAP' );

                 $pdf->SetFont('Arial','',8);
                 $pdf->SetY(1.5);
                 $pdf->SetX(6);
                 $pdf->Cell(3.5,0.22,utf8_decode('Laboratorio de Anatomía Patológica y Citologia') );  
                 
                 /* Datos del encabezado */
                 $pdf->SetFont('Arial','',11);
                 $pdf->SetXY(15.5,0.5);
                 $pdf->Cell(3.5,0.22,'Dra. Silvia I. Viale .'); 

                 $pdf->SetFont('Arial','',11);
                 $pdf->SetXY(16.1,0.9);
                 $pdf->Cell(3.5,0.22,'Mat.: 6939 .'); 

                 $pdf->SetFont('Arial','',11);
                 $pdf->SetXY(15.3,1.3);
                 $pdf->Cell(3.5,0.22,utf8_decode('Anotomía patológica.')); 

                 $pdf->SetFont('Arial','',11);
                 $pdf->SetXY(15.1,1.7);
                 $pdf->Cell(3.5,0.22,utf8_decode('Santiago del estero 42.')); 

                 $pdf->SetFont('Arial','',11);
                 $pdf->SetXY(13.9,2.1);
                 $pdf->Cell(3.5,0.22,utf8_decode('tel.:(0343)4217060 Paraná - Entre Ríos')); 

                 /* Primer linea */
                 $pdf->Line(0, 2.700 , 21, 2.700);
                 $pdf->Line(0, 2.701 , 21, 2.701);
                 $pdf->Line(0, 2.702 , 21, 2.702);
                 $pdf->Line(0, 2.703 , 21, 2.703);
                 $pdf->Line(0, 2.704 , 21, 2.704);

                 /* Datos generales sobre el protocolo */

                 $pdf->SetFont('Arial','B',10);
                 $pdf->SetXY(0.20,4);
                 $pdf->Cell(3.5,0.22,'Protocolo Nro:    ' . $Comp_ProtocoloNro );

                 $pdf->SetFont('Arial','B',10);
                 $pdf->SetXY(16,4);
                 $pdf->Cell(3.5,0.22,'Fecha:    ' . $Comp_Fecha);

                 $pdf->SetFont('Arial','B',10);
                 $pdf->SetXY(0.20,5.0);
                 $pdf->Cell(3.5,0.22,'Paciente:    ' . utf8_decode($Comp_Paciente) );

                 $pdf->SetFont('Arial','B',10);
                 $pdf->SetXY(16,5.0);
                 $pdf->Cell(3.5,0.22,'Edad:    ' . $Comp_Edad );

                 $pdf->SetFont('Arial','B',10);
                 $pdf->SetXY(0.20,6);
                 $pdf->Cell(3.5,0.22,'Medico:    ' . utf8_decode($Comp_Medico) );

                 $pdf->SetFont('Arial','B',10);
                 $pdf->SetXY(0.20,7.0);
                 $pdf->Cell(3.5,0.22,'Material Remitido:    ' . utf8_decode($Comp_Organo) );

                 /* Segunda linea */
                 $pdf->Line(0, 8.01 , 21, 8.01);
                 $pdf->Line(0, 8.02 , 21, 8.02);
                 $pdf->Line(0, 8.03 , 21, 8.03);
                 $pdf->Line(0, 8.04 , 21, 8.04);
                 $pdf->Line(0, 8.05 , 21, 8.05);
                 $pdf->Line(0, 8.06 , 21, 8.06);
                 
                 $pdf->SetY(8.06);
                 
                 /* Datos de Macroscopia */
                 if (($Comp_Macroscopia != null) or (trim($Comp_Macroscopia) != ''))
                 {
                    $pdf->SetFont('Arial','B',11);
                    $pdf->SetXY(0.20,$pdf->GetY()+1);
                    $pdf->Cell(3.5,0.22,'Macroscopia:');   

                    $pdf->SetFont('Arial','',11);
                    $pdf->SetXY(0.90,$pdf->GetY()+0.6);
                    $pdf->MultiCell(0,0.6,utf8_decode($Comp_Macroscopia));
                 }
                 
                 /* Datos de Microscopia */
                 if (($Comp_Microscopia != null) or (trim($Comp_Microscopia) != ''))
                 {
                    $pdf->SetFont('Arial','B',11);
                    $pdf->SetXY(0.20,$pdf->GetY()+1);
                    $pdf->Cell(3.5,0.22,'Microscopia:');   

                    $pdf->SetFont('Arial','',11);
                    $pdf->SetXY(0.90,$pdf->GetY()+0.6);
                    $pdf->MultiCell(0,0.6,utf8_decode($Comp_Microscopia));
                 }
                 
                 /* Datos de Diagnostico */              
                 $pdf->SetFont('Arial','B',11);
                 $pdf->SetXY(0.20,$pdf->GetY()+1);
                 $pdf->Cell(3.5,0.22,'Diagnostico:');   

                 $pdf->SetFont('Arial','',11);
                 $pdf->SetXY(0.90,$pdf->GetY()+0.6);
                 $pdf->MultiCell(0,0.6,utf8_decode($Comp_Diagnostico));

      
                 $ordenada_x = $pdf->GetY();
                 $pdf->Image(IMAGES . 'firma_pdf.png',15.94,$ordenada_x+3);
                 
                 $pdf->SetFont('Arial','B',10);
                 $pdf->SetXY(16,$ordenada_x+7);
                 $pdf->Cell(3.5,0.22,'Dra. Silvia I. Viale'); 
                 
                 $pdf->SetFont('Arial','B',8);
                 $pdf->SetXY(16.35,$pdf->GetY()+0.30);
                 $pdf->Cell(3.5,0.22,'Medica Patologa');                   
                 
                 $pdf->SetFont('Arial','B',8);
                 $pdf->SetXY(16.80,$pdf->GetY()+0.30);
                 $pdf->Cell(3.5,0.22,'M.P 6939');       

                 $data = $pdf->Output('C:\\xampp\\htdocs\\tmp\\Comp.' . $id .
                                      '.pdf'    , 'F');
                
    }    

    public function vista_preliminar ($id = null) {

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
                     
                 $pdf = new FPDF();

                 $pdf->FPDF('P','cm','A4');


                 $pdf->AddPage();
                 $pdf->AliasNbPages();
                 $pdf->SetAutoPageBreak(true,0.2);
                 $pdf->SetMargins(0,0,0);
                 $pdf->SetTopMargin(11);

                 /* Logo del comprobante */
                 $pdf->SetFont('Arial','',22);
                 $pdf->SetY(0.55);
                 $pdf->SetX(0.5);
                 $pdf->Cell(3.5,0.22,'SILVIA VIALE' );

                 $pdf->SetFont('Arial','',35);
                 $pdf->SetY(0.6);
                 $pdf->SetX(5.5);
                 $pdf->Cell(3.5,0.22,'| LAP' );

                 $pdf->SetFont('Arial','',8);
                 $pdf->SetY(1.5);
                 $pdf->SetX(6);
                 $pdf->Cell(3.5,0.22,utf8_decode('Laboratorio de Anatomía Patológica y Citologia') );  
                 
                 /* Datos del encabezado */
                 $pdf->SetFont('Arial','',11);
                 $pdf->SetXY(15.5,0.5);
                 $pdf->Cell(3.5,0.22,'Dra. Silvia I. Viale .'); 

                 $pdf->SetFont('Arial','',11);
                 $pdf->SetXY(16.1,0.9);
                 $pdf->Cell(3.5,0.22,'Mat.: 6939 .'); 

                 $pdf->SetFont('Arial','',11);
                 $pdf->SetXY(15.3,1.3);
                 $pdf->Cell(3.5,0.22,utf8_decode('Anotomía patológica.')); 

                 $pdf->SetFont('Arial','',11);
                 $pdf->SetXY(15.1,1.7);
                 $pdf->Cell(3.5,0.22,utf8_decode('Santiago del estero 42.')); 

                 $pdf->SetFont('Arial','',11);
                 $pdf->SetXY(13.9,2.1);
                 $pdf->Cell(3.5,0.22,utf8_decode('tel.:(0343)4217060 Paraná - Entre Ríos')); 

                 /* Primer linea */
                 $pdf->Line(0, 2.700 , 21, 2.700);
                 $pdf->Line(0, 2.701 , 21, 2.701);
                 $pdf->Line(0, 2.702 , 21, 2.702);
                 $pdf->Line(0, 2.703 , 21, 2.703);
                 $pdf->Line(0, 2.704 , 21, 2.704);

                 /* Datos generales sobre el protocolo */

                 $pdf->SetFont('Arial','B',10);
                 $pdf->SetXY(0.20,4);
                 $pdf->Cell(3.5,0.22,'Protocolo Nro:    ' . $Comp_ProtocoloNro );

                 $pdf->SetFont('Arial','B',10);
                 $pdf->SetXY(16,4);
                 $pdf->Cell(3.5,0.22,'Fecha:    ' . $Comp_Fecha);

                 $pdf->SetFont('Arial','B',10);
                 $pdf->SetXY(0.20,5.0);
                 $pdf->Cell(3.5,0.22,'Paciente:    ' . utf8_decode($Comp_Paciente) );

                 $pdf->SetFont('Arial','B',10);
                 $pdf->SetXY(16,5.0);
                 $pdf->Cell(3.5,0.22,'Edad:    ' . $Comp_Edad );

                 $pdf->SetFont('Arial','B',10);
                 $pdf->SetXY(0.20,6);
                 $pdf->Cell(3.5,0.22,'Medico:    ' . utf8_decode($Comp_Medico) );

                 $pdf->SetFont('Arial','B',10);
                 $pdf->SetXY(0.20,7.0);
                 $pdf->Cell(3.5,0.22,'Material Remitido:    ' . utf8_decode($Comp_Organo) );

                 /* Segunda linea */
                 $pdf->Line(0, 8.01 , 21, 8.01);
                 $pdf->Line(0, 8.02 , 21, 8.02);
                 $pdf->Line(0, 8.03 , 21, 8.03);
                 $pdf->Line(0, 8.04 , 21, 8.04);
                 $pdf->Line(0, 8.05 , 21, 8.05);
                 $pdf->Line(0, 8.06 , 21, 8.06);
                 
                 $pdf->SetY(8.06);
                 
                 /* Datos de Macroscopia */
                 if (($Comp_Macroscopia != null) or (trim($Comp_Macroscopia) != ''))
                 {
                    $pdf->SetFont('Arial','B',11);
                    $pdf->SetXY(0.20,$pdf->GetY()+1);
                    $pdf->Cell(3.5,0.22,'Macroscopia:');   

                    $pdf->SetFont('Arial','',11);
                    $pdf->SetXY(0.90,$pdf->GetY()+0.6);
                    $pdf->MultiCell(0,0.6,utf8_decode($Comp_Macroscopia));
                 }
                 
                 /* Datos de Microscopia */
                 if (($Comp_Microscopia != null) or (trim($Comp_Microscopia) != ''))
                 {
                    $pdf->SetFont('Arial','B',11);
                    $pdf->SetXY(0.20,$pdf->GetY()+1);
                    $pdf->Cell(3.5,0.22,'Microscopia:');   

                    $pdf->SetFont('Arial','',11);
                    $pdf->SetXY(0.90,$pdf->GetY()+0.6);
                    $pdf->MultiCell(0,0.6,utf8_decode($Comp_Microscopia));
                 }
                 
                 /* Datos de Diagnostico */
                 
                 $pdf->SetFont('Arial','B',11);
                 $pdf->SetXY(0.20,$pdf->GetY()+1);
                 $pdf->Cell(3.5,0.22,'Diagnostico:');   

                 $pdf->SetFont('Arial','',11);
                 $pdf->SetXY(0.90,$pdf->GetY()+0.6);
                 $pdf->MultiCell(0,0.6,utf8_decode($Comp_Diagnostico));
                
                 
                 /* Firma */
                 $pdf->SetFont('Arial','B',10);
                 $pdf->SetXY(16,$pdf->GetY()+4.5);
                 $pdf->Cell(3.5,0.22,'Dra. Silvia I. Viale'); 
                 
                 $pdf->SetFont('Arial','B',8);
                 $pdf->SetXY(16.35,$pdf->GetY()+0.30);
                 $pdf->Cell(3.5,0.22,'Medica Patologa');                   
                 
                 $pdf->SetFont('Arial','B',8);
                 $pdf->SetXY(16.80,$pdf->GetY()+0.30);
                 $pdf->Cell(3.5,0.22,'M.P 6939');    
                 
                 
                 $data = $pdf->Output(null , 'S');

                 $this->set('id', $Comp_ProtocoloNro);
                 $this->set('pdf_comprobantes', $data);
                 $this->render('vista_preliminar', 'ajax');               
    }  
    
    public function search_organo($id,$tipo){
        
        //= 'macroscopia';
        $respuesta = array ();
        $this->autoRender=false;
        
        $microscopia=$this->Organo->find('all',
                                         array('conditions'=>array('Organo.id =' =>$id ))
                                        );      
       
        return $microscopia['0']['Organo'][$tipo];
    }    

    public function search_estudio($id){
        
        //= 'macroscopia';
        $respuesta = array ();
        $this->autoRender=false;
        
        $estudio=$this->Estudio->find('all',
                                         array('conditions'=>array('Estudio.id =' => $id ))
                                        );      
       
        return $estudio['0']['Estudio']['descripcion'];
    }    

    public function search() {

          if(!empty($this->data)) {

              $buscar_valor = $this->Session->read('Protocolo.buscar_valor');
              $buscar_por = $this->Session->read('Protocolo.buscar_por');

              if(empty($buscar_valor) || empty($buscar_por)) {
                      $this->Session->write('Protocolo.buscar_valor', $this->data['Protocolo']['buscar_valor']);
                      $this->Session->write('Protocolo.buscar_por', $this->data['Protocolo']['buscar_por']);
              }

              if($this->data['Protocolo']['buscar_valor'] != $this->Session->read('Protocolo.buscar_valor')){
                  $this->Session->delete('Protocolo.buscar_valor');
                  $this->Session->write('Protocolo.buscar_valor', $this->data['Protocolo']['buscar_valor']);
              }
              if( $this->data['Protocolo']['buscar_por'] != $this->Session->read('Protocolo.buscar_por')){
                  $this->Session->delete('Protocolo.buscar_por');
                  $this->Session->write('Protocolo.buscar_por', $this->data['Protocolo']['buscar_por']);
              }
          }

          $options = array();

          switch ($this->Session->read('Protocolo.buscar_por')) {
              case 1:
                  $options = array("Paciente.dni = '{$this->Session->read('Protocolo.buscar_valor')}'");
              break;
              case 2:
                  $options = array("Paciente.razon_social LIKE '%{$this->Session->read('Protocolo.buscar_valor')}%'");
              break;
              case 3:
                  $options = array("Protocolo.id LIKE '%{$this->Session->read('Protocolo.buscar_valor')}'");
              break;
              case 4:
                  $options = array("Medico.razon_social LIKE '%{$this->Session->read('Protocolo.buscar_valor')}%'");
              break;
              case 5:
                  $options = array("Protocolo.tipoprotocolo LIKE '%{$this->Session->read('Protocolo.buscar_valor')}%'");
              break;
              case 6:
                  $options = array("Protocolo.fecha = '{$this->Session->read('Protocolo.buscar_valor')}'");
              break;
          }

          $this->set('data',$this->paginate('Protocolo', $options));

          return $this->render('index');


      }    

    public function search_organo_estudio($id){
        
        $respuesta = array ();
        
        $this->autoRender=false;
        
        $estudio=$this->Estudio->find('all',
                                         array('conditions'=>array('Estudio.organo_id =' => $id ))
                                        );      

         $i=0;
         //$select_dinamico='<select name="data[Estudio][Estudio][]" multiple="multiple" id="EstudioEstudio">';
        // $select_dinamico = '<div class="multiselect" id="multiselect" >';.
         
         $select_dinamico='';
         foreach($estudio as $p){
            
             $select_dinamico.= '<label>
                                    <input name="data[Estudio][Estudio][]" id="EstudioEstudio" type="checkbox" value="'. $p['Estudio']['descripcion'] . '">'
                                     . $p['Estudio']['descripcion'] . 
                                 '</label><br>';
              
                      
            // $select_dinamico.= '<option value="'. $p['Estudio']['id'] . '">' . $p['Estudio']['descripcion'] .'</option>';
          
             $i++;
         }
        // $select_dinamico.='</div>'; 

         return $select_dinamico;

    }    
    
      
}
?>
