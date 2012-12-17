<script type="text/javascript">
 $(function() {
   $('#ProtocoloPacienteId').autocomplete({
         source   : '<?php echo $this->Html->url(array('controller'=>'Pacientes', 'action'=>'search'));?>',
         minLength: 2
       });
   $('#ProtocoloMedicoId').autocomplete({
         source   : '<?php echo $this->Html->url(array('controller'=>'Medicos', 'action'=>'search'));?>',
         minLength: 2
       }); 
       
    $("#EstudioEstudio").asmSelect({
            addItemTarget: 'bottom',
            animate: true,
            highlight: false,
            sortable: true
    });     

  /*     
   if ($("#CitologiaTipoProtocolo").attr("select")){
    $("#muestra_citologia").css("display", "block");
     }else{
        $("#muestra_citologia").css("display", "none");
     }; 
 */
 $('#ProtocoloTipoProtocolo').change(function(){

    //Almaceno el valor seleccionado en una variable
    var valorSeleccionado = $(this).val();
    
    if(valorSeleccionado == 1)
    {    
        $('#muestra_citologia').css("display", "none"); 
        $('#muestra_biopsia').css("display", "block"); 
       //    $("input").prop('disabled', true);
    }
    else
    {
      $('#muestra_citologia').css("display", "block"); 
      $('#muestra_biopsia').css("display", "none"); 
    }
    return false;
   }); 
 
 });
</script>
 
<div class="form">
    <?php 
          echo $this->Form->create('Protocolo',array('action' => 'edit')); 
          echo $this->Form->input('id', array('type' => 'hidden'));
    ?> 
    
    <div class="form-content">
        <fieldset>
                <legend>Nuevo Protocolo</legend> 
                 <div class="col w40">
                        <?php                          
                        
                           echo $this->Form->input(
                                  'paciente_id',
                                   array(
                                      'label' => 'Paciente',
                                      'empty' => 'Eliga una opción',
                                      'type'  => 'text',                                      
                                       )
                                  );      

                            echo $this->Form->input(
                                  'medico_id',
                                   array(
                                      'label' => 'Medico',
                                      'empty' => 'Eliga una opción',
                                      'type'  => 'text' 
                                       )
                                  );               
     
                             echo $this->Form->input(
                                    'obrasocial_id',
                                     array(
                                        'options' => $obrasociales,
                                        'label' => 'Obra Social',
                                        'empty' => 'Eliga una opción',
                                         
                                         )
                                    );               
 
                             
                            echo $this->Form->input(
                                    'sanatorio_id',
                                     array(
                                        'options' => $sanatorios,
                                        'label' => 'Sanatorio',
                                        'empty' => 'Eliga una opción')
                                    );
 
                             echo $this->Form->input(
                                    'orden',
                                     array(
                                           'type'  => 'checkbox',
                                           'label' => 'Presenta Orden'
                                          )
                                    );
                             
                             echo $this->Form->input(
                                'tipo_protocolo',
                                 array(
                                    'options' => array ('Citologia' , 'Biopsia'),
                                    'label' => 'Protocolo',
                                    'empty' => 'Eliga una opción')
                                );   
                             
                          ?>
              </div> 
              <div class="col w40" style="display:none" id="muestra_citologia" >
                          <?php
                            echo $this->Form->input(
                                 'organo_citologia_id',
                                  array(
                                     'options' => $organoscitologia,
                                     'label' => 'Organo',
                                     'empty' => 'Eliga una opción',
                                     'name'  => 'data[Protocolo][organo_citologia_id]',
                                     'id'    => 'ProtocoloOrganoCitologiaId',                                
                                      )
                                 );    

                         echo $this->Form->input(
                                     'material',
                                      array( 'type' => 'textarea' )                                   
                                   );
 
                          echo $this->Form->input(
                                     'diagnostico',
                                      array( 'type' => 'textarea' )                                   
                                   );

                          
                          echo $this->Form->input('Estudio', 
                                array( 
                                       'label'    => 'Estudios',
                                       'multiple' => 'multiple',
                                       'options'  => $estudios,
                                       'empty' => 'Seleccione los estudios' 
                                ));

                          
                          ?> 
               </div>  
               <div class="col w40" style="display:none" id="muestra_biopsia">
                          <?php
                            echo $this->Form->input(
                                 'organo_biopsia_id',
                                  array(
                                     'options' => $organosbiopsia,
                                     'label' => 'Organo',
                                     'empty' => 'Eliga una opción',
                                     'name'  => 'data[Protocolo][organo_biopsia_id]',
                                     'id'    => 'ProtocoloOrganoBiopsiaId',
                                      )
                                 );    

                          echo $this->Form->input(
                                     'macroscopia',
                                      array( 'type' => 'textarea' )                                   
                                   );

                          echo $this->Form->input(
                                     'microscopia',
                                      array( 'type' => 'textarea' )                                   
                                   );

                          
                          echo $this->Form->input(
                                     'diagnostico',
                                      array( 'type' => 'textarea' )                                   
                                   );                          
                                                   
                          ?> 
                         
              </div>    
                <?php
                  echo $this->Form->end('Guardar');
                ?> 
            </fieldset>  
     </div>
    
 