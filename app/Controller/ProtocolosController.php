<?php
App::import('Vendor', 'EnviaMail', array('file'=>'EnviaMail'.DS.'class.phpmailer.php')  );

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
        $this->pacientes         = $this->Paciente->find('list');       
        $this->estudios          = $this->Estudio->find('list',array('fields' => 'Estudio.descripcion'));       

    }  
    
    public function index() {

        $this->set('data',$this->Protocolo->find('all'));
        
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
                    
            if  (!empty($this->data['Protocolo']['organo_citologia_id']))
            {
                    $this->request->data['Protocolo']['organo_id'] = 
                                          $this->request->data['Protocolo']['organo_citologia_id'];
                    $this->request->data['Protocolo']['tipoprotocolo'] = 'citologia';
            }
            else if  (!empty($this->data['Protocolo']['organo_biopsia_id'])) 
            {
                    $this->request->data['Protocolo']['organo_id'] = 
                                          $this->request->data['Protocolo']['organo_biopsia_id'];
                    $this->request->data['Protocolo']['tipoprotocolo'] = 'biopsia';
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
                 //pr($this->data);  
                 $mail = new PHPMailer();
                 $mail->IsSMTP(); // telling the class to use SMTP

                 $body   = "Cuerpo del correo";
                 $mail->SetFrom('maxi.ottino@gmail.com', 'de?');

                 $mail->Subject    = "Asunto";
                 $mail->MsgHTML($body);

                 $address = "maxi.ottino@gmail.com";
     /*           $mail->AddAddress($address, "Enviar correo a?");
      * 

                 if(!$mail->Send()) {
                      return "Mailer Error: " . $mail->ErrorInfo;
                 } else {
                      return "Message sent!";
                 }
      * 
      */

         }
                
           
           
         
         
     }
}
?>
