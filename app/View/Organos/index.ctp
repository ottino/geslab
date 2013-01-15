<div class="form">
<fieldset>
    <legend>Organos</legend>
    
    <table cellpadding="0" cellspacing="0">
    <tr>
            <th>Tipo de Protocolo</th>
            <th>Organo</th>
            <th>Macroscopia</th>
            <th>Microscopia</th>
            <th></th>          
    </tr>
    <?php        
    foreach ($data as $d):
            echo "<tr>";
                echo "<td>" . $d['Organo']['tipoprotocolo'] . "</td>";
                echo "<td>" . $d['Organo']['descripcion'] . "</td>";
                echo "<td>" . $d['Organo']['macroscopia'] . "</td>";
                echo "<td>" . $d['Organo']['microscopia'] . "</td>";
                echo "<td class='actions'>";
                
                $id = $d['Organo']['id'];
                
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