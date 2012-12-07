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
            <th>Editar</th>
            <th>Eliminar</th>                
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

                echo "<td>";
                
                $id = $d['Obrasocial']['id'];
                
                echo $this->Html->image('b_edit.png',
                         array(
                                "alt" => "Editar datos",
                                'url' => array('action' => 'edit', $id)
                              )
                        );
                
                echo "</td>";
                echo "<td>";
               
                echo $this->Html->image('b_drop.png',
                         array(
                                "alt" => "Eliminar datos",
                                'url' => array('action' => 'delete', $id)
                              )
                        );
                
                echo "</td>";
               echo '</tr>';        
    endforeach;

    ?>
    </table>
</fieldset>
</div>




