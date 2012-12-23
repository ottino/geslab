
<div class="form">
<fieldset>
    <legend>Protocolos</legend>
    
    <table cellpadding="0" cellspacing="0">
    <tr>
            <th>Protocolo</th>            
            <th>Paciente</th>            
            <th>Medico</th>            
            <th>Sanatorio</th>
            <th>Obra Social</th>
            <th>Orden</th>
            <th>Organo</th>
            <th>Diagnostico</th> 
            <th>Editar</th>
            <th>Eliminar</th>  
            <th>eMail</th>  
            <th>Comprobante</th>  
    </tr>
    <?php        
    foreach ($data as $d):
    
           if($d['Protocolo']['orden']>0) 
                $orden = "si"; 
           else $orden= "no";
           
               echo "<tr>";
                echo "<td>" . $d['Protocolo']['tipoprotocolo'] . "</td>";
                echo "<td>" . $d['Paciente']['razon_social'] . "</td>";
                echo "<td>" . $d['Medico']['razon_social'] . "</td>";
                echo "<td>" . $d['Sanatorio']['descripcion']. "</td>";
                echo "<td>" . $d['Obrasocial']['descripcion']. "</td>";
                echo "<td>" . $orden . "</td>";
                echo "<td>" . $d['Organo']['descripcion']. "</td>";
                echo "<td>" . $d['Protocolo']['diagnostico']. "</td>";
                echo "<td>";
                
                $id = $d['Protocolo']['id'];
                
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
                echo "<td>";
               
                echo $this->Html->image('s_success.png',
                         array(
                                "alt" => "Enviar",
                                'url' => array('action' => 'envia_mail', $id)
                              )
                        );
                echo "</td>";
                echo "<td>";
                   echo $this->Html->image('b_tblimport.png',
                         array(
                                "alt" => "Generar",
                                'url' => array('action' => '', $id)
                              )
                        );             
                echo "</td>";
               echo '</tr>';        
    endforeach;

    ?>
    
    </table>
</fieldset>
</div>