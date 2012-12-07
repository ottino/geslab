<?php
  foreach ($Medico as $m) {
   $id = $m['Medico']['id'];
   echo $m['Medico']['razon_social'];
   echo " - ";
   echo $this->Form->postLink(
                        'Eliminar', 
                        array('action' => 'delete', $id),
                        array('title'=>'Eliminar','escape' => false ),
                        'Desea eliminar?'
                );
   echo " <br>";
  } 

?>

