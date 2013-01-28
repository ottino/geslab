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
        'limit' => 10,
        'order' => array(
            'Protocolo.id' => 'desc'
        )
    );
    
    var $components = array('RequestHandler');

    public function  __construct($request = null, $response = null) {
        parent::__construct($request, $response);
        
        # Obtengo los datos de todos los modelos para dar de alta protocolos
        $this->protocolos        = $this->Protocolo->find('list');     
        $this->sanatorios        = $this->Sanatorio->find('list',array('fields' => 'Sanatorio.descripcion'));     
        $this->obrasociales      = $this->Obrasocial->find('list',array('fields' => 'Obrasocial.descripcion'));     
        $this->medicos           = $this->Medico->find('list',array('fields' => 'Medico.razon_social'));     
        $this->organoscitologia  = $this->Organo->find('list',
                                         array('conditions'=>array('Organo.tipoprotocolo ='=>'citologia'))
                                        );
        $this->organosbiopsia    = $this->Organo->find('list',
                                         array('conditions'=>array('Organo.tipoprotocolo ='=>'biopsia'))
                                        );
        
        $this->organos           = $this->Organo->find('list');       
        $this->pacientes         = $this->Paciente->find('list',array('fields' => 'Paciente.razon_social'));       
        $this->estudios          = $this->Estudio->find('list',array('fields' => 'Estudio.descripcion'));       

    }  
    
    public function index() {
        $data = $this->paginate('Protocolo');
        $this->set(compact('data'));
        //$this->set('data',$this->Protocolo->find('all'));
        
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
                   
                $this->Session->setFlash( MSJ_REG_AG_OK );    
                
                // Con esto vuelve al Index, 
                // pasando por la funcion index del controlador
                $this->redirect(array('action' => 'index'));
                
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
           $this->request->data['Protocolo']['medico_id']   = $medico_id[0];
           
           $this->request->data['Protocolo']['fecha']   = date("Y-m-d");    
             
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
                   
                $this->Session->setFlash( MSJ_REG_EDT_OK );    
                // Con esto vuelve al Index, 
                // pasando por la funcion index del controlador
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
            $this->redirect(array('action' => 'index'));
        }
    }
    
    public function envia_mail ($id = null) {

        $this->set('sanatorios'        , $this->sanatorios);
        $this->set('organos'           , $this->organos);
        $this->set('organoscitologia'  , $this->organoscitologia);
        $this->set('organosbiopsia'    , $this->organosbiopsia);
        $this->set('obrasociales'      , $this->obrasociales);
        $this->set('estudios'          , $this->estudios);
       
       if ($this->request->is('get')) {
             if ($id <> null )
             {
                 // envio los datos a envia_mail.ctp
                 $this->Protocolo->id = $id;           
                 $this->request->data = $this->Protocolo->read();
                 $this->set('Protocolo',$this->request->data);

             } else {
                     // error cuando no se puede abrir envia_mail.ctp
                     $this->Session->setFlash( MSJ_REG_EDT_ERR );
                     $this->redirect(array('action' => 'index'));
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

                 $address = "silvia.viale.pna@gmail.com";
                 $mail->AddAttachment("../../../tmp/Comprobantes.".$id.".pdf"); // attachment
                 
                $mail->AddAddress($address, "Enviar correo a?");
       

                 if(!$mail->Send()) {
                      return "Error: " . $mail->ErrorInfo;
                 } else {
                      return "Mensaje Enviado";
                 }

         }
        
     }

    public function genera_comprobante ($id = null) {

       $this->Protocolo->id = $id;           
       $protocolo = $this->Protocolo->read();
       //pr($protocolo);
       //die();
  
        /* Datos para el comprobante */
       
        $Comp_ProtocoloNro = $protocolo['Protocolo']['id'];
        $Comp_Paciente     = $protocolo['Paciente']['razon_social'];
        $Comp_Medico       = $protocolo['Medico']['razon_social'];
        $Comp_Organo       = $protocolo['Organo']['descripcion'];
        $Comp_Macroscopia  = $protocolo['Protocolo']['macroscopia'];
        $Comp_Diagnostico  = $protocolo['Protocolo']['diagnostico'];
       
        $pdf = new FPDF();
        
        $pdf->FPDF('P','cm','A4');
        
        
        $pdf->AddPage();
        $pdf->AliasNbPages();
        $pdf->SetAutoPageBreak(true,0.2);
        $pdf->SetMargins(0,0,0);
        $pdf->SetTopMargin(11);
       
        /* Logo del comprobante */
        $pdf->SetFont('Arial','B',20);
        $pdf->SetY(1);
        $pdf->SetX(1);
        $pdf->Image(IMAGES . 'logo_geslab.jpg',0.1, 0.1 , 5 , 1);
        
        /* Primer linea */
        $pdf->Line(0, 3 , 21, 3);
        
        /* Datos generales sobre el protocolo */
 
        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.20,3.5);
        $pdf->Cell(3.5,0.22,'Protocolo Nro:    ' . $Comp_ProtocoloNro );

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(16,3.5);
        $pdf->Cell(3.5,0.22,'Fecha:    ' . '31/12/2012');

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.20,5.0);
        $pdf->Cell(3.5,0.22,'Paciente:    ' . $Comp_Paciente );

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(16,5.0);
        $pdf->Cell(3.5,0.22,'Edad:    ' . '27' );

        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.20,6.5);
        $pdf->Cell(3.5,0.22,'Medico:    ' . $Comp_Medico );
        
        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.20,8.0);
        $pdf->Cell(3.5,0.22,'Organo:    ' . $Comp_Organo );
        
        /* Segunda linea */
        $pdf->Line(0, 9 , 21, 9);
       
        /* Datos de Macroscopia */
        $pdf->SetFont('Arial','B',11);
        $pdf->SetXY(0.20,9.5);
        $pdf->Cell(3.5,0.22,'Macroscopia:');   
        
        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.90,10.25);
        $pdf->Cell(3.5,0.22,$Comp_Macroscopia );        

        /* Datos de Diagnostico */
        $pdf->SetFont('Arial','B',11);
        $pdf->SetXY(0.20,14);
        $pdf->Cell(3.5,0.22,'Diagnostico:');   
        
        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(0.90,14.75);
        $pdf->Cell(3.5,0.22,substr($Comp_Diagnostico,0,100) );        
        $pdf->SetXY(0.90,15.25);
        $pdf->Cell(3.5,0.22,substr($Comp_Diagnostico,100,100) );   
        
        //$pdf->Image(IMAGES . 'logo2_geslab.png',16, 18);
        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(16,18);
        $pdf->Cell(3.5,0.22,'Dra. Silvia I. Viale'); 
        
        $pdf->SetFont('Arial','B',8);
        $pdf->SetXY(16.35,18.30);
        $pdf->Cell(3.5,0.22,'Medica Patologa');         
        
        $pdf->SetFont('Arial','B',8);
        $pdf->SetXY(16.80,18.60);
        $pdf->Cell(3.5,0.22,'M.P 6939');         
        
        $data = $pdf->Output(null, 'S');
        $this->set('id', $Comp_ProtocoloNro);
        $this->set('pdf_comprobantes', $data);
        $this->render('genera_comprobante', 'ajax');
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
                  $options = array("Protocolo.id = '{$this->Session->read('Protocolo.buscar_valor')}'");
              break;
              case 4:
                  $options = array("Medico.razon_social LIKE '%{$this->Session->read('Protocolo.buscar_valor')}%'");
              break;
              case 5:
                  $options = array("Protocolo.tipoprotocolo LIKE '%{$this->Session->read('Protocolo.buscar_valor')}%'");
              break;
          }

          $this->set('data',$this->paginate('Protocolo', $options));

          return $this->render('index');


      }    
}
?>
