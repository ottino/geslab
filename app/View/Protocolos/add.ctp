<script type="text/javascript">
 $(function() {
   $('#buscar_paciente').autocomplete({
         source : "http://localhost/geslab/pacientes/search/",
         minLength: 2
       });
   $('#buscar_medico').autocomplete({
         source : "http://localhost/geslab/medicos/search/",
         minLength: 2
       });    
 });
</script>
<?php echo $this->Form->create(); ?>  
<div class="form">
    <div class="form-content">
        <div class="columns">
        <fieldset>
                <legend>Nuevo Protocolo</legend>    
                    <div class="col w40">
                        
                        <label for="buscar_paciente">Paciente</label>
                        <input type="text" id="buscar_paciente" name="buscar_paciente"  />
                        <label for="buscar_paciente">Medico</label>
                        <input type="text" id="buscar_medico" name="buscar_medico"  />
    
 
 

	