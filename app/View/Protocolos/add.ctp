<script type="text/javascript">
 $(function() {
   $('#CitologiaPacienteId').autocomplete({
         source   : "http://localhost/geslab/pacientes/search/",
         minLength: 2
       });
   $('#CitologiaMedicoId').autocomplete({
         source   : "http://localhost/geslab/medicos/search/",
         minLength: 2
       }); 
       
    $("#EstudioscitologiaDescripcion").asmSelect({
            addItemTarget: 'bottom',
            animate: true,
            highlight: false,
            sortable: true
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
                                      'type'  => 'text'
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
                                    'organocitologia_id',
                                     array(
                                        'options' => $organoscitologias,
                                        'label' => 'Organo Citologia',
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
                             
                            echo $this->Form->input('Estudioscitologia.descripcion', 
                                                    array( 
                                                           'label'    => 'Estudios',
                                                           'multiple' => 'multiple',
                                                           'options'  => $estudios,
                                                           'empty' => 'Seleccione los estudios' 
                                                    ));
                          ?>
              </div> 
              <div class="col w40">
                          <?php
                          echo $this->Form->input(
                                     'material',
                                      array( 'type' => 'textarea' )                                   
                                   );
 
                          echo $this->Form->input(
                                     'diagnostico',
                                      array( 'type' => 'textarea' )                                   
                                   );
                          echo "<br>";
                          echo $this->Form->end('Agregar protocolo'); 
                          ?> 
                          
              </div>    
            </fieldset>  
     </div> 