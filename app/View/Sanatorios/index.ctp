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
            <th>Editar</th>
            <th>Eliminar</th>            
    </tr>
    <?php        
    foreach ($data as $d):
            echo "<tr>";
                echo "<td>" . $d['Sanatorio']['id'] . "</td>";
                echo "<td>" . $d['Sanatorio']['descripcion'] . "</td>";
                echo "<td>" . $d['Sanatorio']['telefono1'] . "</td>";
                echo "<td>" . $d['Sanatorio']['telefono2'] . "</td>";
                echo "<td>" . $d['Localidad']['descripcion']. "</td>";

                echo "<td>";
                
                $id = $d['Sanatorio']['id'];
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

