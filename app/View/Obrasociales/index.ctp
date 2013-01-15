<div class="form">
<fieldset>
    <legend>Sanatorios</legend>
    
    <table cellpadding="0" cellspacing="0">
    <tr>
            <th>Identificación</th>
            <th>CUIT</th>
            <th>Descripcion</th>            
            <th>Localidad</th>            
            <th>Direccion</th>
            <th>Telefono</th>
            <th>Fax</th>
            <th>eMail</th>   
            <th></th>
    </tr>
    <?php        
    foreach ($data as $d):
            echo "<tr>";
                echo "<td>" . $d['Obrasocial']['id'] . "</td>";
                echo "<td>" . $d['Obrasocial']['cuit'] . "</td>";
                echo "<td>" . $d['Obrasocial']['descripcion'] . "</td>";
                echo "<td>" . $d['Localidad']['descripcion'] . "</td>";
                echo "<td>" . $d['Obrasocial']['direccion']. "</td>";
                echo "<td>" . $d['Obrasocial']['telefono']. "</td>";
                echo "<td>" . $d['Obrasocial']['fax']. "</td>";
                echo "<td>" . $d['Obrasocial']['email']. "</td>";

                echo "<td class='actions'>";
                
                $id = $d['Obrasocial']['id'];
                
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




