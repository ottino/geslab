<?php
// Crear el formulario en html
echo $this->Form->create('Medico',array('action' => 'editar'));
echo $this->Form->input('id',array('type' => 'hidden'));
//echo $this->Form->input('id',array('type' => 'text'));
echo $this->Form->input('razon_social');
echo $this->Form->end('Guardar');
?>


