<div class="form">
<fieldset>
    <legend>Medicos</legend>
    
    <table cellpadding="0" cellspacing="0">
    <tr>
            <th>Razon Social</th>            
            <th>Dirección</th>            
            <th>Localidad</th>
            <th>Telefono</th>
            <th>Celular</th>
            <th>eMail</th>  
            <th>Matricula</th>
            <th></th>             
    </tr>
    <?php        
    foreach ($data as $d):
            echo "<tr>";
                echo "<td>" . $d['Medico']['razon_social'] . "</td>";
                echo "<td>" . $d['Medico']['direccion'] . "</td>";
                echo "<td>" . $d['Localidad']['descripcion'] . "</td>";
                echo "<td>" . $d['Medico']['telefono']. "</td>";
                echo "<td>" . $d['Medico']['celular']. "</td>";
                echo "<td>" . $d['Medico']['email']. "</td>";
                echo "<td>" . $d['Medico']['matricula']. "</td>";
                
                echo "<td class='actions'>";
                
                $id = $d['Medico']['id'];
                
                echo $this->Html->link(
                        BTN_EDIT, 
                        array('action' => 'edit', $id), 
                        array('title'=>BTN_EDIT,'escape' => false )
                );
                
                echo $this->Form->postLink(
                        BTN_DEL, 
                        array('action' => 'delete', $id),
                        array('title'=>'Eliminar','escape' => false ),
                        MSG_PREG_ELIM_DATO
                );
                
                echo "</td>";
               echo '</tr>';        
    endforeach;

    ?>
    </table>
</fieldset>
</div>




