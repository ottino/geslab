<?php
App::import('Vendor', 'EnviaMail', array('file'=>'EnviaMail'.DS.'class.phpmailer.php')  );
App::import('Vendor', 'fpdf', array('file'=>'fpdf'.DS.'fpdf.php')  );
App::import('Vendor', 'PDF_AutoPrint', array('file'=>'fpdf'.DS.'PDF_AutoPrint.php')  );
App::import('Vendor', 'pdf_header', array('file'=>'fpdf'.DS.'pdf_header.php')  );

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
        'limit' => 4,
        'order' => array('Protocolo.fecha' => 'desc')//,
       // 'conditions'=>array('Protocolo.fecha'=>'20130216')
    );
    
    var $components = array('RequestHandler');

    public function  __construct($request = null, $response = null) {
        parent::__construct($request, $response);
        
        # Obtengo los datos de todos los modelos para dar de alta protocolos
        $this->sanatorios        = $this->Sanatorio->find('list',array('fields' => 'Sanatorio.desc_corta',
                                        'order' => array('Sanatorio.descripcion' => 'asc'))                                             
                     );     
        $this->obrasociales      = $this->Obrasocial->find('list',array('fields' => 'Obrasocial.desc_corta',
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
        
        if ($vista_rapida == 1)
        {
            
            $data = $this->paginate('Protocolo',array('Protocolo.fecha'=>date("Y-m-d")));    
   
            $this->set(compact('data'));

        } else
        {
            $data = $this->paginate('Protocolo');
            $this->set(compact('data'));
        }

    }

    public function vista_rapida() {
       
       $this->redirect(array('action' => 'index' ,1)); 
       
    }

    public function puente_paciente() {
       
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
           
           if (
               ($this->data['Protocolo']['paciente_edad'] <> NULL) or 
               (!empty($this->data['Protocolo']['paciente_edad']))     
              )
             {
               $this->request->data['Paciente']['id']     = $paciente_id[0] ;
               $this->request->data['Paciente']['edad']   = $this->data['Protocolo']['paciente_edad'];
             }  
           
           $id_muestra = $this->request->data['Protocolo']['id'];
           
           /* 
            * Toma los precios de la obra social y los carga en protocolos para 
            * mantener un historico de precios
            * 
            */
           
           $this->Obrasocial->id =  $this->request->data['Protocolo']['obrasocial_id'];                     
           $obrasocial = $this->Obrasocial->read();
           
           $this->request->data['Protocolo']['precio150101']=$obrasocial['Obrasocial']['practica150101'];
           $this->request->data['Protocolo']['precio150102']=$obrasocial['Obrasocial']['practica150102'];
           $this->request->data['Protocolo']['precio150103']=$obrasocial['Obrasocial']['practica150103'];
           $this->request->data['Protocolo']['precio150104']=$obrasocial['Obrasocial']['practica150104'];
           $this->request->data['Protocolo']['precio150105']=$obrasocial['Obrasocial']['practica150105'];
           $this->request->data['Protocolo']['precio150106']=$obrasocial['Obrasocial']['practica150106'];
           $this->request->data['Protocolo']['precio150108']=$obrasocial['Obrasocial']['practica150108'];
           $this->request->data['Protocolo']['precio150109']=$obrasocial['Obrasocial']['practica150109'];
           $this->request->data['Protocolo']['precio150110']=$obrasocial['Obrasocial']['practica150110'];
           $this->request->data['Protocolo']['precio150111']=$obrasocial['Obrasocial']['practica150111'];
           $this->request->data['Protocolo']['precio150120']=$obrasocial['Obrasocial']['practica150120'];
           $this->request->data['Protocolo']['precio150121']=$obrasocial['Obrasocial']['practica150121'];
           $this->request->data['Protocolo']['precio144790']=$obrasocial['Obrasocial']['practica144790'];
                   
          // pr($this->request->data['Protocolo']);
          // die();

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
                
                // Grabo edad del paciente
                $this->Paciente->save($this->data['Paciente']);
                
                if($this->request->data['Protocolo']['checkadd_vista_logo'] == 1)
                {
                 $this->redirect(array('action' => 'vista_preliminar' , 
                                         $this->request->data['Protocolo']['id'],0,1)
                                  );    
                }
                else if($this->request->data['Protocolo']['checkadd_vista'] == 1)
                {
                   $this->redirect(array('action' => 'vista_preliminar' , 
                                         $this->request->data['Protocolo']['id'],0,0)
                                  ); 
                   
                } else if($this->request->data['Protocolo']['checkadd'] == 1)
                {
                    $this->Session->setFlash( MSJ_REG_AG_OK . ' Protocolo - ' . $id_muestra );  
                    $this->redirect(array('action' => 'edit' , 
                                    $this->request->data['Protocolo']['id'])
                                   );  
                } else 
                {
                    $this->redirect(array('action' => 'vista_preliminar' , 
                                          $this->request->data['Protocolo']['id'],1)
                                    );    
                }
               
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
           
           if (
               ($this->data['Protocolo']['paciente_edad'] <> NULL) or 
               (!empty($this->data['Protocolo']['paciente_edad']))     
              )
             {
               $this->request->data['Paciente']['id']     = $paciente_id[0] ;
               $this->request->data['Paciente']['edad']   = $this->data['Protocolo']['paciente_edad'];
             }

          // pr($this->request->data);
          // die();

           $this->request->data['Protocolo']['paciente_id'] = $paciente_id[0];
           $this->request->data['Protocolo']['diagnostico'] = '';
           $this->request->data['Protocolo']['medico_id']   = $medico_id[0];
           
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
                
                // Grabo edad del paciente
                $this->Paciente->save($this->data['Paciente']);
                
                if($this->request->data['Protocolo']['checkadd_vista_logo'] == 1)
                {
                 $this->redirect(array('action' => 'vista_preliminar' , 
                                         $this->request->data['Protocolo']['id'],0,1)
                                  );    
                } else if($this->request->data['Protocolo']['checkadd_vista'] == 1)
                {
                   $this->redirect(array('action' => 'vista_preliminar' , 
                                         $this->request->data['Protocolo']['id'],1,0)
                                  );         
                   
                } else if($this->request->data['Protocolo']['checkadd'] == 1)
                {
                    $this->Session->setFlash( MSJ_REG_EDT_OK );  
                    $this->redirect(array('action' => 'edit' , 
                                    $this->request->data['Protocolo']['id'])
                                   );  
                }else 
                {

                    $this->redirect(array('action' => 'vista_preliminar' , 
                                          $this->request->data['Protocolo']['id'],1)
                                    );
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
                 // Para que reciba en copia todos los envios
                 $encopia= "silviaviale@arnet.com.ar"; 
                 
                 if(trim($this->request->data['email_personalizado']) == '' || 
                    !isset($this->request->data['email_personalizado']))
                 { 
                   $email_personalizado =  '';  
                 }
                 else
                 { 
                    $email_personalizado = $this->request->data['email_personalizado'];
                 }
                 
                // pr($email_personalizado);
                // die();
                    
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

                 $mail->Subject    = "Paciente: " . $this->request->data['Paciente']['razon_social'];
                                                    
                 $mail->MsgHTML($body);
                 
                 // Correo Principal
                 if(trim($this->request->data['Sanatorio']['email']) == '' || 
                    !isset($this->request->data['Sanatorio']['email']))
                 { 
                    $address = ''; 
                 }
                 else
                 { 
                    $address  =  $this->request->data['Sanatorio']['email'];
                    $mail->AddAddress($address, "Enviar correo a?");
                 }
                 
                 // Correo Alternativo
                 if(trim($this->request->data['Sanatorio']['email2']) == '' || 
                    !isset($this->request->data['Sanatorio']['email2']))
                 { 
                    $address1 = ''; 
                 }
                 else
                 { 
                    $address1  =  $this->request->data['Sanatorio']['email2'];
                    $mail->AddAddress($address1, "Enviar correo a?");
                 }
                 
                 $mail->AddCC($encopia); // En copia el otro correo de silvia
                 
                 // Correo Personalizado
                 if(trim($email_personalizado) == '' || 
                    !isset($email_personalizado))
                 { 
                    $address2 = ''; 
                 }
                 else
                 { 
                    $address2  =  $email_personalizado;
                    $mail->AddAddress($address2, "Enviar correo a?");
                 }               

                 $mail->AddAttachment('../../../tmp/Comp.' . $id . '.pdf'); 

                 if(!$mail->Send()) {
                      return "Error: " . $mail->ErrorInfo;
                 } else {
                          $this->Session->setFlash( MSJ_MAIL_OK );
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
                     
                 $pdf = new pdf_header();
                 $pdf->put_header(
                                        1,$Comp_ProtocoloNro,$Comp_Fecha,
                                        $Comp_Paciente,$Comp_Edad,$Comp_Medico,
                                        $Comp_Organo
                                  );
                     
                 $pdf->FPDF('P','cm','A4');


                 $pdf->AddPage();
                 $pdf->AliasNbPages();
                 $pdf->SetAutoPageBreak(true,0.2);
                 $pdf->SetMargins(0,0,0);
                 $pdf->SetTopMargin(11);
                 
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
  
                 if (($Comp_Material != null) or (trim($Comp_Material) != ''))
                 {
                    $pdf->SetFont('Arial','B',11);
                    $pdf->SetXY(0.20,$pdf->GetY()+1);
                    $pdf->Cell(3.5,0.22,'Meterial Remitido:');   

                    $pdf->SetFont('Arial','',11);
                    $pdf->SetXY(0.90,$pdf->GetY()+0.6);
                    $pdf->MultiCell(0,0.6,utf8_decode($Comp_Material));
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

    public function vista_preliminar ($id = null , $modo = 0 , $logo = 1) {

                 set_time_limit();
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

                 if (($Comp_Material != null) or (trim($Comp_Material) != ''))
                 {
                    $pdf->SetFont('Arial','B',11);
                    $pdf->SetXY(0.20,$pdf->GetY()+1);
                    $pdf->Cell(3.5,0.22,'Meterial Remitido:');   

                    $pdf->SetFont('Arial','',11);
                    $pdf->SetXY(0.90,$pdf->GetY()+0.6);
                    $pdf->MultiCell(0,0.6,utf8_decode($Comp_Material));
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
                 
                 if ($modo == 0)
                 {   
                    $data = $pdf->Output(null , 'S');
                    $this->set('id', $Comp_ProtocoloNro);
                    $this->set('pdf_comprobantes', $data);
                    $this->render('vista_preliminar', 'ajax');
                    
                 } else if ($modo==1)
                 {
                    $pdf->AutoPrint(false);
                    $data=$pdf->Output();
                    $this->set('pdf_comprobantes', $data);
                    $this->render('imprimir_comprobante','ajax');    
                     
                 }
    }  
  
    public function search_organo($id,$tipo){
        
        $respuesta = array ();
        $this->autoRender=false;
        
        $microscopia=$this->Organo->find('all',
                                         array('conditions'=>array('Organo.id =' =>$id ))
                                        );      
       
        return $microscopia['0']['Organo'][$tipo];
    }    

    public function search_estudio($id){
        
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
         
         $select_dinamico='';
         foreach($estudio as $p){
            
             $select_dinamico.= '<label>
                                    <input name="data[Estudio][Estudio][]" id="EstudioEstudio" type="checkbox" value="'. $p['Estudio']['descripcion'] . '">'
                                     . $p['Estudio']['descripcion'] . 
                                 '</label><br>';
          
             $i++;
         }
         return $select_dinamico;

    }    

    public function verifica_id($id){
      
        $this->autoRender=false;
        
        $busca=$this->Protocolo->find('all',
                                         array('conditions'=>array('Protocolo.id =' => $id ))
                                        );      

        if (isset($busca[0]['Protocolo']['id'])){
             $mensaje= '1';
        } else
             $mensaje= '0';
         
         return $mensaje;
        
   }	    
      
}
?>
