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

 $('#ProtocoloTipoProtocolo').change(function(){

    //Almaceno el valor seleccionado en una variable
    var valorSeleccionado = $(this).val();
    
    if(valorSeleccionado == 1)
    {    
        $('#muestra_citologia').css("display", "none"); 
        $('#muestra_biopsia').css("display", "block"); 
    }
    else if(valorSeleccionado == 0)
    {
      $('#muestra_citologia').css("display", "block"); 
      $('#muestra_biopsia').css("display", "none"); 
    } 
    return false;
}); 

 $('#LimpiarMicroscopia').change(function(){
   var valorSeleccionado = $(this).val();
   
   if(valorSeleccionado == "1")
   {
     $("#ProtocoloMicroscopia").val("");
     $("#LimpiarMicroscopia").removeAttr("checked");
   }
   
 });
 
 $('#LimpiarMacroscopia').change(function(){
   var valorSeleccionado = $(this).val();
   
   if(valorSeleccionado == "1")
   {
     $("#ProtocoloMacroscopia").val("");
     $("#LimpiarMacroscopia").removeAttr("checked");
   }
   
 });
 
 $('#ProtocoloOrganoBiopsiaId').change(function(){
   
   $("#ProtocoloMacroscopia").val(function(){
                    $.ajax({
                    url:'http://localhost/geslab/protocolos/search_organo/' + 
                                       $("#ProtocoloOrganoBiopsiaId").val() + '/macroscopia',                                                                 
                    success: function(data) {
                        $('#ProtocoloMacroscopia').val(data);
                        
                    }
                    });
                }); 
                
   $("#ProtocoloMicroscopia").val(function(){
                    $.ajax({
                    url:'http://localhost/geslab/protocolos/search_organo/'  + 
                                        $("#ProtocoloOrganoBiopsiaId").val() + '/microscopia',                                                                 
                    success: function(data) {
                        $('#ProtocoloMicroscopia').val(data);
                        
                    }
                    });
                }); 
   
 });
 
        $("#asmSelect0").change(function() {
           
            var multipleValues = $("#EstudioEstudio").val() || [];
            multipleValues = multipleValues.join("-");
            multipleValues = multipleValues.split("-");
            multipleValues = multipleValues[multipleValues.length-1]; 
            datos_cargados = $('#ProtocoloDiagnostico').val();
            $("#ProtocoloDiagnostico").val(
            function(){
                    $.ajax({
                    url:'http://localhost/geslab/protocolos/search_estudio/'  + multipleValues      ,                                                                 
                    success: function(data) {
                        $('#ProtocoloDiagnostico').val( datos_cargados + '\n' + data);                        
                    }
                    })
                   }  
              );
                  
    
        });

                            
 });
 
</script>
 
<div class="form">
    <?php echo $this->Form->create(); ?> 
    
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
                                    'NUC',
                                     array(
                                           'type'  => 'text', 
                                           'label' => 'Codigo NUC'
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
                                    'internacion',
                                     array(
                                           'type'  => 'checkbox',
                                           'label' => 'Internacion'
                                          )
                                    );

                             echo $this->Form->input(
                                    'ambulatorio',
                                     array(
                                           'type'  => 'checkbox',
                                           'label' => 'Ambulatorio'
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
                           ?> 
                          <br>  

                          <input type="checkbox" value="1" name="LimpiarMicroscopia" id="LimpiarMicroscopia"/>
                          <label>Limpiar Microscopia</label>
                          <br>
                          <input type="checkbox" value="1" name="LimpiarMacroscopia" id="LimpiarMacroscopia"/>
                          <label>Limpiar Macroscopia</label>
                          
                          <?php
                          echo "<table>";
                          echo "<tr>";
                          echo "<td>";
                          echo $this->Form->input(
                                     'macroscopia',
                                      array( 'type' => 'textarea' )                                   
                                   );
                          echo "</td>"; 
                          echo "<td algin='richt'>"; 
                          echo $this->Form->input(
                                     'microscopia',
                                      array( 'type' => 'textarea' )                                   
                                   );
                          echo "</td>"; 
                          echo "</tr>"; 
                          echo "</table>";
                          
                          echo $this->Form->input(
                                     'diagnostico',
                                      array( 'type' => 'textarea' )                                   
                                   );                          
                          
                         
                          
                          ?> 
                         
              </div>    
                <?php
                echo $this->Form->end('Agregar protocolo');
                ?>
            </fieldset>  
     </div>
    
 