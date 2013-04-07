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

 $('#ProtocoloTipoProtocolo').val(
  <?php
         if ($this->data['Protocolo']['tipoprotocolo'] == 'citologia')
              echo "0";
         else echo "1";
  ?>
 );

$('#ProtocoloOrganoCitologiaId').change(function(){

   $('#multiselect').html(function(){
                   $.ajax({
                   url:'http://maxi-pc/geslab/protocolos/search_organo_estudio/' 
                          + $("#ProtocoloOrganoCitologiaId").val(),                                                                 
                   success: function(data) {
                       $('#multiselect').html(data);

                   }
                   });
               }); 
});

function updateTextArea() {     
   var allVals = [];
   $('.taglist :checked').each(function(i) {

           allVals.push((i!=0?"\r\n":"")+ $(this).val());
   });

   $('#ProtocoloDiagnosticoCitologia').val(allVals).attr('rows',allVals.length) ;

 }

   $(".taglist input").live('click',(function(event){
       //updateTextArea();
       //alert ( $("label[for='"+$(this).attr("id")+"']").selector.push);
       //alert ( $(this).val());

                $('#ProtocoloDiagnosticoCitologia').val
                 (
                  $('#ProtocoloDiagnosticoCitologia').val().replace(/^\s*|\s*$/g,"") +  "\r\n" + $(this).val()
                 );
   }));

 
    
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

<?php
         if ($this->data['Protocolo']['tipoprotocolo'] == 'citologia')
              echo "$('#muestra_citologia').css(\"display\",\"block\");";
         else if ($this->data['Protocolo']['tipoprotocolo'] == 'biopsia')
              echo "$('#muestra_biopsia').css(\"display\",\"block\");";
?>


 $('#LimpiarMicro').click(function(){

    $("#ProtocoloMicroscopia").val("");

  });
 
 $('#LimpiarMacro').click(function(){

    $("#ProtocoloMacroscopia").val("");

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
     
   var checkMacro = $('#ProtocoloCheckBorrarMacro:checked').val();                 
   var checkMicro = $('#ProtocoloCheckBorrarMicro:checked').val();
   
   //alert (checkMacro);
   
   if (checkMacro != "1")
   {
    $("#ProtocoloMacroscopia").val(function(){
                     $.ajax({
                     url:'http://maxi-pc/geslab/protocolos/search_organo/' + 
                                        $("#ProtocoloOrganoBiopsiaId").val() + '/macroscopia',                                                                 
                     success: function(data) {
                         $('#ProtocoloMacroscopia').val(data);

                     }
                     });
                 }); 
   }
   
   if (checkMicro != "1")
   {
    $("#ProtocoloMicroscopia").val(function(){
                     $.ajax({
                     url:'http://maxi-pc/geslab/protocolos/search_organo/'  + 
                                         $("#ProtocoloOrganoBiopsiaId").val() + '/microscopia',                                                                 
                     success: function(data) {
                         $('#ProtocoloMicroscopia').val(data);

                     }
                     });
                 }); 
   }
   
 });
 
/* 
$("#asmSelect0").change(function() {

    var multipleValues = $("#EstudioEstudio").val() || [];
    multipleValues = multipleValues.join("-");
    multipleValues = multipleValues.split("-");
    multipleValues = multipleValues[multipleValues.length-1]; 
    datos_cargados = $('#ProtocoloDiagnosticocitologia').val();
    $("#ProtocoloDiagnosticocitologia").val(
    function(){
            $.ajax({
            url:'http://localhost/geslab/protocolos/search_estudio/'  + multipleValues      ,                                                                 
            success: function(data) {
                $('#ProtocoloDiagnosticocitologia').val( datos_cargados + '\n' + data);                        
            }
            })
           }  
      );


});
*/
 $('#ProtocoloCheckaddVistaLogo').change(function(){
   var valorSeleccionado = $(this).val();
   
   if(valorSeleccionado == "1")
   {
     $("#ProtocoloCheckadd").removeAttr("checked");
     $("#ProtocoloCheckaddVista").removeAttr("checked");
     $("#ProtocoloCheckaddPrint").removeAttr("checked");
   } 
 });
 
 $('#ProtocoloCheckaddVista').change(function(){
   var valorSeleccionado = $(this).val();
   
   if(valorSeleccionado == "1")
   {
     $("#ProtocoloCheckadd").removeAttr("checked");
     $("#ProtocoloCheckaddVistaLogo").removeAttr("checked");
     $("#ProtocoloCheckaddPrint").removeAttr("checked");
   } 
 });
 
  $('#ProtocoloCheckadd').change(function(){
   var valorSeleccionado = $(this).val();
   
   if(valorSeleccionado == "1")
   {
     $("#ProtocoloCheckaddVista").removeAttr("checked");
     $("#ProtocoloCheckaddVistaLogo").removeAttr("checked");
     $("#ProtocoloCheckaddPrint").removeAttr("checked");
   } 
 });
 
   $('#ProtocoloCheckaddPrint').change(function(){
   var valorSeleccionado = $(this).val();
   
   if(valorSeleccionado == "1")
   {
     $("#ProtocoloCheckaddVista").removeAttr("checked");
     $("#ProtocoloCheckaddVistaLogo").removeAttr("checked");
     $("#ProtocoloCheckadd").removeAttr("checked");
   } 
 });
 
 
});
 
</script>
 
<div class="form">
    <?php 
          echo $this->Form->create('Protocolo',array('action' => 'edit')); 
          echo $this->Form->input('id', array('type' => 'hidden'));
          
          if ($this->data['Protocolo']['tipoprotocolo'] == 'citologia')
          {   
            $diagnostico_citologia = $this->data['Protocolo']['diagnostico'];
            $diagnostico_biopsia   = '';
          } else 
                 {
                   $diagnostico_biopsia   = $this->data['Protocolo']['diagnostico'];
                   $diagnostico_citologia = '';  
                 }
    ?> 
    
    <div class="form-content">
        <fieldset>
          <legend>Editar Protocolo : <?php  echo $this->data['Protocolo']['id']; ?> </legend> 
          
              <div class="col w40">
                        <?php   
                            //pr($this->data);
                           
                            
                            echo $this->Form->input(
                                  'paciente_id',
                                   array(
                                      'type'  => 'text', 
                                      'value' => $this->data['Paciente']['id'] . ' - ' .$this->data['Paciente']['razon_social'], 
                                      'label' => 'Paciente'                                  
                                       )
                                  );      

                            echo $this->Form->input(
                                  'medico_id',
                                   array(
                                      'label' => 'Medico',
                                      'value' => $this->data['Medico']['id'] . ' - ' .$this->data['Medico']['razon_social'],
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
                                        'options' => array ('Citologia','Biopsia'),
                                        'label' => 'Protocolo',
                                        'empty' => 'Eliga una opción'
                                      )
                                );   
                             
                          ?>
                   <br>
                
                   <legend>Practicas</legend>  
                   <table class ="table_practicas">
                      <tr>
                       <th>Codigo</th>
                       <th>Cantidad</th> 
                       <th>Codigo</th>
                       <th>Cantidad</th> 
                      </tr>
                      <tr>
                        <td> 15.01.01 </td>  
                        <td>
                          <input type="text" size="2" value="<?php echo $this->data['Protocolo']['practica150101']; ?>" name="data[Protocolo][practica150101]" id="ProtocoloPractica150101" class="input_practicas_cant" >   
                        </td>  
                        <td> 15.01.02 </td>  
                        <td>
                          <input type="text" size="2" value="<?php echo $this->data['Protocolo']['practica150102']; ?>" name="data[Protocolo][practica150102]" id="ProtocoloPractica150102" class="input_practicas_cant" >   
                        </td>  
                      </tr>    
                      <tr>
                        <td> 15.01.03 </td>  
                        <td>
                          <input type="text" size="2" value="<?php echo $this->data['Protocolo']['practica150103']; ?>" name="data[Protocolo][practica150103]" id="ProtocoloPractica150103" class="input_practicas_cant" >   
                        </td>  
                        <td> 15.01.04 </td>  
                        <td>
                          <input type="text" size="2" value="<?php echo $this->data['Protocolo']['practica150104']; ?>" name="data[Protocolo][practica150104]" id="ProtocoloPractica150104" class="input_practicas_cant" >   
                        </td>  
                      </tr>    
                      <tr>
                        <td> 15.01.05 </td>  
                        <td>
                          <input type="text" size="2" value="<?php echo $this->data['Protocolo']['practica150105']; ?>" name="data[Protocolo][practica150105]" id="ProtocoloPractica150105" class="input_practicas_cant" >   
                        </td>  
                        <td> 15.01.06 </td>  
                        <td>
                          <input type="text" size="2" value="<?php echo $this->data['Protocolo']['practica150106']; ?>" name="data[Protocolo][practica150106]" id="ProtocoloPractica150106" class="input_practicas_cant" >   
                        </td>  
                      </tr>    
                      <tr>
                        <td> 15.01.08 </td>  
                        <td>
                          <input type="text" size="2" value="<?php echo $this->data['Protocolo']['practica150108']; ?>" name="data[Protocolo][practica150108]" id="ProtocoloPractica150108" class="input_practicas_cant" >   
                        </td>  
                        <td> 15.01.09 </td>  
                        <td>
                          <input type="text" size="2" value="<?php echo $this->data['Protocolo']['practica150109']; ?>" name="data[Protocolo][practica150109]" id="ProtocoloPractica150109" class="input_practicas_cant" >   
                        </td>  
                      </tr>    
                      <tr>
                        <td> 15.01.10 </td>  
                        <td>
                          <input type="text" size="2" value="<?php echo $this->data['Protocolo']['practica150110']; ?>" name="data[Protocolo][practica150110]" id="ProtocoloPractica150110" class="input_practicas_cant" >   
                        </td>  
                        <td> 15.01.11 </td>  
                        <td>
                          <input type="text" size="2" value="<?php echo $this->data['Protocolo']['practica150111']; ?>" name="data[Protocolo][practica150111]" id="ProtocoloPractica150111" class="input_practicas_cant" >   
                        </td>  
                      </tr>    
                      <tr>
                        <td> 15.01.20 </td>  
                        <td>
                          <input type="text" size="2" value="<?php echo $this->data['Protocolo']['practica150120']; ?>" name="data[Protocolo][practica150120]" id="ProtocoloPractica150120" class="input_practicas_cant" >   
                        </td>  
                        <td> 15.01.21 </td>  
                        <td>
                          <input type="text" size="2" value="<?php echo $this->data['Protocolo']['practica150121']; ?>" name="data[Protocolo][practica150121]" id="ProtocoloPractica150121" class="input_practicas_cant" >   
                        </td>  
                      </tr>    
                      <tr>
                        <td> 14.47.90 </td>  
                        <td>
                          <input type="text" size="2" value="<?php echo $this->data['Protocolo']['practica144790']; ?>" name="data[Protocolo][practica144790]" id="ProtocoloPractica144790" class="input_practicas_cant" >   
                        </td>  
                      </tr>    
                    </table> 
                   <?php
                   
                      echo $this->Form->input(
                       'checkadd_vista_logo',
                        array(
                              'type'  => 'checkbox',
                              'label' => 'Vista Preliminar Con Logo'
                             )
                       );   
                                         
                      echo $this->Form->input(
                       'checkadd_vista',
                        array(
                              'type'  => 'checkbox',
                              'label' => 'Imprimir Sin Logo'
                             )
                       );   

                      echo $this->Form->input(
                       'checkadd_print',
                        array(
                              'type'  => 'checkbox',
                              'label' => 'Imprimir Con Logo'
                             )
                       );     
                      
                      echo $this->Form->input(
                       'checkadd',
                        array(
                              'type'  => 'checkbox',
                              'label' => 'Guardar',
                              'Checked' => 'true'
                             )
                       );  
 
                     ?>                   
              </div>  
              <div class="col w40" style="display:none" id="muestra_citologia" >
                          <?php
                            echo $this->Form->input(
                                 'organo_citologia_id',
                                  array(
                                     'options' => $organoscitologia,
                                     'label'   => 'Organo',
                                     'empty'   => 'Eliga una opción',
                                     'name'    => 'data[Protocolo][organo_citologia_id]',
                                     'id'      => 'ProtocoloOrganoCitologiaId',   
                                     'selected' => $this->data['Protocolo']['organo_id']
                                      )
                                 );    

                         echo $this->Form->input(
                                     'material',
                                      array( 'type' => 'textarea' )                                   
                                   );
                         /*
                          echo $this->Form->input(
                                     'diagnosticocitologia',
                                      array( 'type' => 'textarea' ,
                                             'value'=> $diagnostico_citologia 
                                           )                                   
                                   );

                          echo $this->Form->input('Estudio', 
                                array( 
                                       'label'    => 'Estudios',
                                       'multiple' => 'multiple',
                                       'options'  => $estudios,
                                       'empty' => 'Seleccione los estudios' 
                                ));
                          */
                          ?>
                  
                        <label for="">Estudios (Depende del Organo seleccionado) </label>
                        <div id="multiselect" class="taglist multiselect">
                        </div>    
                  
                        <label for="">Diagnostico</label>
                        <textarea class="textfield" id="ProtocoloDiagnosticoCitologia" 
                                  name="data[Protocolo][diagnosticocitologia]" cols="44" rows="10">
                        <?php echo $diagnostico_citologia; ?> 
                            
                        </textarea>
                  
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
                                     'selected' => $this->data['Protocolo']['organo_id']
                                      )
                                 );

                          echo $this->Form->input(
                                'checkBorrarMacro',
                                 array(
                                       'type'  => 'checkbox',
                                       'label' => 'No borrar macroscopia',
                                       'Checked' => 'true'
                                      )
                                );  
                          
                          echo $this->Form->input(
                                     'macroscopia',
                                      array( 'type' => 'textarea' )                                   
                                   );
 
                          echo $this->Form->input(
                                'checkBorrarMicro',
                                 array(
                                       'type'  => 'checkbox',
                                       'label' => 'No borrar microscopia',
                                       'Checked' => 'true'
                                      )
                                );  
                                                  
                          echo $this->Form->input(
                                     'microscopia',
                                      array( 'type' => 'textarea' )                                   
                                   );
                          
                          echo $this->Form->input(
                                     'diagnosticobiopsia',
                                      array( 'type'  => 'textarea' ,
                                             'value' => $diagnostico_biopsia
                                           )                                   
                                   );                                                    
                          ?> 
          
              </div> 

                <?php
                  echo $this->Form->end('Ejecutar');
                ?> 
         </fieldset>  
     </div>
    
<script type="text/javascript">

                   $.ajax({
                   url:'http://maxi-pc/geslab/protocolos/search_organo_estudio/' 
                          + $("#ProtocoloOrganoCitologiaId").val(),                                                                 
                   success: function(data) {
                       $('#multiselect').html(data);

                   }
                   });


</script>