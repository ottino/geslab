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

/*
    $("#EstudioEstudio").asmSelect({
            addItemTarget: 'bottom',
            animate: true,
            highlight: false,
            sortable: true
    }); 
   */ 

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
        
            
      /* 
       $(function() {
              $('.taglist input').click(updateTextArea);
              updateTextArea();
       
        });
      */  
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
   
   $("#ProtocoloMacroscopia").val(function(){
                    $.ajax({
                    url:'http://maxi-pc/geslab/protocolos/search_organo/' + 
                                       $("#ProtocoloOrganoBiopsiaId").val() + '/macroscopia',                                                                 
                    success: function(data) {
                        $('#ProtocoloMacroscopia').val(data);
                        
                    }
                    });
                }); 
                
   $("#ProtocoloMicroscopia").val(function(){
                    $.ajax({
                    url:'http://maxi-pc/geslab/protocolos/search_organo/'  + 
                                        $("#ProtocoloOrganoBiopsiaId").val() + '/microscopia',                                                                 
                    success: function(data) {
                        $('#ProtocoloMicroscopia').val(data);
                        
                    }
                    });
                }); 
   
 });
  
/*
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
*/
  
    
 $('#ProtocoloCheckaddVista').change(function(){
   var valorSeleccionado = $(this).val();
   
   if(valorSeleccionado == "1")
   {
     $("#ProtocoloCheckadd").removeAttr("checked");
   }
   
 });
 
  $('#ProtocoloCheckadd').change(function(){
   var valorSeleccionado = $(this).val();
   
   if(valorSeleccionado == "1")
   {
     $("#ProtocoloCheckaddVista").removeAttr("checked");
   }
   
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
                                  'id',
                                   array(
                                      'label' => 'Numero de Protocolo',
                                      'empty' => 'Eliga una opción',
                                      'type'  => 'text',                                      
                                       )
                                  );    

                            
                            echo $this->Form->input(
                                  'paciente_id',
                                   array(
                                      'label' => 'Paciente',
                                      'empty' => 'Eliga una opción',
                                      'type'  => 'text',                                      
                                       )
                                  );     
                            
                            
                            echo '<a href='.$this->Html->url(array('controller'=>'Pacientes', 'action'=>'add')).
                                 ' target="_blank"> Nuevo Paciente </a>';
                            
                            /*
                            echo $this->Html->link(
                                    'Nuevo Paciente', 
                                    array('controller'=>'Pacientes', 'action'=>'add'), 
                                    array('title'=>'Nuevo Paciente','escape' => false)
                            );
                            */
                            
                            echo "<br><br>";
                            
                             
                            echo $this->Form->input(
                                  'medico_id',
                                   array(
                                      'label' => 'Medico',
                                      'empty' => 'Eliga una opción',
                                      'type'  => 'text' 
                                       )
                                  );               
                            
                            echo '<a href='.$this->Html->url(array('controller'=>'Medicos', 'action'=>'add')).
                            ' target="_blank"> Nuevo Medico </a>';
                            
                            /*
                            echo $this->Html->link(
                                    'Nuevo Medico', 
                                    array('controller'=>'Medicos', 'action'=>'add'), 
                                    array('title'=>'Nuevo Medico','escape' => false)
                            );
                            */
                            
                            echo "<br><br>";

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
                          <input type="text" size="2" name="data[Protocolo][practica150101]" id="ProtocoloPractica150101" value="0" class="input_practicas_cant" >   
                        </td>  
                        <td> 15.01.02 </td>  
                        <td>
                          <input type="text" size="2" name="data[Protocolo][practica150102]" id="ProtocoloPractica150102" value="0" class="input_practicas_cant" >   
                        </td>  
                      </tr>    
                      <tr>
                        <td> 15.01.03 </td>  
                        <td>
                          <input type="text" size="2" name="data[Protocolo][practica150103]" id="ProtocoloPractica150103" value="0" class="input_practicas_cant" >   
                        </td>  
                        <td> 15.01.04 </td>  
                        <td>
                          <input type="text" size="2" name="data[Protocolo][practica150104]" id="ProtocoloPractica150104" value="0" class="input_practicas_cant" >   
                        </td>  
                      </tr>    
                      <tr>
                        <td> 15.01.05 </td>  
                        <td>
                          <input type="text" size="2" name="data[Protocolo][practica150105]" id="ProtocoloPractica150105" value="0" class="input_practicas_cant" >   
                        </td>  
                        <td> 15.01.06 </td>  
                        <td>
                          <input type="text" size="2" name="data[Protocolo][practica150106]" id="ProtocoloPractica150106" value="0" class="input_practicas_cant" >   
                        </td>  
                      </tr>    
                      <tr>
                        <td> 15.01.08 </td>  
                        <td>
                          <input type="text" size="2" name="data[Protocolo][practica150108]" id="ProtocoloPractica150108" value="0" class="input_practicas_cant" >   
                        </td>  
                        <td> 15.01.09 </td>  
                        <td>
                          <input type="text" size="2" name="data[Protocolo][practica150109]" id="ProtocoloPractica150109" value="0" class="input_practicas_cant" >   
                        </td>  
                      </tr>    
                      <tr>
                        <td> 15.01.10 </td>  
                        <td>
                          <input type="text" size="2" name="data[Protocolo][practica150110]" id="ProtocoloPractica150110" value="0" class="input_practicas_cant" >   
                        </td>  
                        <td> 15.01.11 </td>  
                        <td>
                          <input type="text" size="2" name="data[Protocolo][practica150111]" id="ProtocoloPractica150111" value="0" class="input_practicas_cant" >   
                        </td>  
                      </tr>    
                      <tr>
                        <td> 15.01.20 </td>  
                        <td>
                          <input type="text" size="2" name="data[Protocolo][practica150120]" id="ProtocoloPractica150120" value="0" class="input_practicas_cant" >   
                        </td>  
                        <td> 15.01.21 </td>  
                        <td>
                          <input type="text" size="2" name="data[Protocolo][practica150121]" id="ProtocoloPractica150121" value="0" class="input_practicas_cant" >   
                        </td>  
                      </tr>    
                      <tr>
                        <td> 14.47.90 </td>  
                        <td>
                          <input type="text" size="2" name="data[Protocolo][practica144790]" id="ProtocoloPractica144790" value="0" class="input_practicas_cant" >   
                        </td>  
                      </tr>    
                    </table> 
                   <?php
                   
                      echo $this->Form->input(
                       'checkadd_vista',
                        array(
                              'type'  => 'checkbox',
                              'label' => 'Vista Preliminar'
                             )
                       );   

                      echo $this->Form->input(
                       'checkadd',
                        array(
                              'type'  => 'checkbox',
                              'label' => 'Agregar',
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

                         /* Se saco a pedido de Silvia
                          echo $this->Form->input(
                                     'diagnostico',
                                      array( 'type' => 'textarea' )                                   
                                   );
                         
                         */
                         /*
                          echo '<div id="multiselect" class="taglist multiselect">';
                          echo $this->Form->input('Estudio', 
                                array( 
                                       'label'    => 'Estudios',
                                       'multiple' => 'multiple',
                                       //'type'  => 'select',
                                       'options'  => $estudios,
                                       'empty' => 'Seleccione los estudios' 
                                ));
                           echo '</div>';
                        */
                       //<textarea class="textfield" id="video0_tags" name="video0_tags"></textarea>

                        //<label for="">Estudios (Depende del Organo seleccionado) </label>
                        //<div id="multiselect" class="taglist multiselect">
                        //</div>    
                            
                         ?> 
  
                        <label for="">Estudios (Depende del Organo seleccionado) </label>
                        <div id="multiselect" class="taglist multiselect">
                        </div>    
                                             
                        <label for="">Diagnostico</label>
                        <textarea class="textfield" id="ProtocoloDiagnosticoCitologia" 
                                  name="data[Protocolo][diagnosticocitologia]" cols="44" rows="10">
                            
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
                                      )
                                 );
                           ?> 
                          <br> 
                          
                          <input class="btn_limpiar" type="button" value="Limpiar Macroscopia" name="LimpiarMacro" id="LimpiarMacro" />                    
                          <br>  
                          <?php

                          echo $this->Form->input(
                                     'macroscopia',
                                      array( 'type' => 'textarea' )                                   
                                   );
                          ?>
                          
                          <input class="btn_limpiar" type="button" value="Limpiar Microscopia" name="LimpiarMicro" id="LimpiarMicro" />
                          <br>
                          <?php
                          
                          echo $this->Form->input(
                                     'microscopia',
                                      array( 'type' => 'textarea' )                                   
                                   );
                          
                          echo $this->Form->input(
                                     'diagnosticobiopsia',
                                      array( 'type' => 'textarea' )                                   
                                   );     
                          
                          ?>                         
          
              </div> 

                <?php
                      
                
                echo $this->Form->end('Ejecutar');                
                
                ?>
         </fieldset>  
     </div>
    
 