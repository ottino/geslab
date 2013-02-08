<div class="form">
<fieldset>
    <legend>Sanatorios</legend>
    
    <table cellpadding="0" cellspacing="0">
    <tr>
            <th>Identificación</th>
            <th>Descripción</th>
            <th>Telefono Principal</th>            
            <th>Telefono Secundario</th>
            <th>Localidad</th>
            <th>eMail</th>
            <th>eMail Alternativo</th>
            <th></th>        
    </tr>
    <?php        
    foreach ($data as $d):
            echo "<tr>";
                echo "<td>" . $d['Sanatorio']['id'] . "</td>";
                echo "<td>" . $d['Sanatorio']['descripcion'] . "</td>";
                echo "<td>" . $d['Sanatorio']['telefono1'] . "</td>";
                echo "<td>" . $d['Sanatorio']['telefono2'] . "</td>";
                echo "<td>" . $d['Localidad']['descripcion']. "</td>";
                echo "<td>" . $d['Sanatorio']['email']. "</td>";
                echo "<td>" . $d['Sanatorio']['email2']. "</td>";

                echo "<td class='actions'>";
                
                $id = $d['Sanatorio']['id'];
                
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

