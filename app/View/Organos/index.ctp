<div class="form">
<fieldset>
    <legend>Organos</legend>
    
    <table cellpadding="0" cellspacing="0">
    <tr>
            <th>Tipo de Protocolo</th>
            <th>Organo</th>
            <th>Macroscopia</th>
            <th>Microscopia</th>
            <th>Editar</th>
            <th>Eliminar</th>                
    </tr>
    <?php        
    foreach ($data as $d):
            echo "<tr>";
                echo "<td>" . $d['Organo']['tipoprotocolo'] . "</td>";
                echo "<td>" . $d['Organo']['descripcion'] . "</td>";
                echo "<td>" . $d['Organo']['macroscopia'] . "</td>";
                echo "<td>" . $d['Organo']['microscopia'] . "</td>";
                echo "<td>";
                
                $id = $d['Organo']['id'];
                
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