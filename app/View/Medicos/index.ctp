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
            <th>Editar</th>
            <th>Eliminar</th>              
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
                
                echo "<td>";
                
                $id = $d['Medico']['id'];
                
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




