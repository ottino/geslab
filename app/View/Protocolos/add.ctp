<script type="text/javascript">
 $(function() {
   $('#buscar_paciente').autocomplete({
         source : "http://localhost/geslab/protocolos/search/",
         minLength: 2
       });
 });
</script>
<?php echo $this->Form->create(); ?>  
<div class="form">
          <div id="busqueda">
		    <input type="text" id="buscar_paciente" name="buscar_paciente" />
          </div>

    <div class="form-content">
        <fieldset>
                <legend>Nuevo Protocolo</legend>    
                    <div class="col w40">
                      <?php 
                        echo $this->Form->input(
                        'paciente_id',
                         array(
                            'options' => $pacientes,
                            'label'   => 'Paciente',
                            'empty'   => 'Eliga una opción')
                        );

                        echo $this->Form->input(
                                'medico_id',
                                 array(
                                    'options' => $medicos,
                                    'label'   => 'Medico',
                                    'empty'   => 'Eliga una opción')
                                );
                       ?>


	