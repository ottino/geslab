<div class="form">
<fieldset>
    <legend>Pacientes</legend>
    
    <table cellpadding="0" cellspacing="0">
    <tr>
            <th>DNI</th>
            <th>Razon Social</th>            
            <th>Dirección</th>            
            <th>Localidad</th>
            <th>Telefono</th>
            <th>Celular</th>
            <th>eMail</th>  
            <th>Fecha de Nacimiento</th>
            <th>Editar</th>
            <th>Eliminar</th>                 
    </tr>
    <?php        
    foreach ($data as $d):
            echo "<tr>";
                echo "<td>" . $d['Paciente']['dni'] . "</td>";
                echo "<td>" . $d['Paciente']['razon_social'] . "</td>";
                echo "<td>" . $d['Paciente']['direccion'] . "</td>";
                echo "<td>" . $d['Localidad']['descripcion'] . "</td>";
                echo "<td>" . $d['Paciente']['telefono']. "</td>";
                echo "<td>" . $d['Paciente']['celular']. "</td>";
                echo "<td>" . $d['Paciente']['email']. "</td>";
                echo "<td>" . $d['Paciente']['fecha_nacimiento']. "</td>";

                echo "<td>";
                
                $id = $d['Paciente']['id'];
                
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




