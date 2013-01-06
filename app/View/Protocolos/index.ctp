
<div class="form">
<fieldset>
    <legend>Protocolos</legend>
    
    <table cellpadding="0" cellspacing="0">
    <tr>
            <th>Numero</th>            
            <th>Protocolo</th>            
            <th>Paciente</th>            
            <th>Medico</th>            
            <th>Sanatorio</th>
            <th>Obra Social</th>
            <th>Orden</th>
            <th>Internacion</th>
            <th>Ambulatorio</th>
            <th>Organo</th>
            <th>Editar</th>
            <th>Eliminar</th>  
            <th>eMail</th>  
            <th>PDF</th>  
    </tr>
    <?php        
    foreach ($data as $d):
    
           if($d['Protocolo']['orden']>0) 
                $orden = "si"; 
           else $orden= "no";
           
           if($d['Protocolo']['internacion']>0) 
                $internacion = "si"; 
           else $internacion= "no";
           
           if($d['Protocolo']['ambulatorio']>0) 
                $ambulatorio = "si"; 
           else $ambulatorio = "no";
           
               echo "<tr>";
                echo "<td>" . $d['Protocolo']['id'] . "</td>";
                echo "<td>" . $d['Protocolo']['tipoprotocolo'] . "</td>";
                echo "<td>" . $d['Paciente']['razon_social'] . "</td>";
                echo "<td>" . $d['Medico']['razon_social'] . "</td>";
                echo "<td>" . $d['Sanatorio']['descripcion']. "</td>";
                echo "<td>" . $d['Obrasocial']['descripcion']. "</td>";
                echo "<td>" . $orden . "</td>";
                echo "<td>" . $internacion . "</td>";
                echo "<td>" . $ambulatorio . "</td>";
                echo "<td>" . $d['Organo']['descripcion']. "</td>";
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
               
                echo $this->Html->image('gmail.png',
                         array(
                                "alt" => "Enviar",
                                'url' => array('action' => 'envia_mail', $id)
                              )
                        );
                echo "</td>";
                echo "<td>";
                
                echo $this->Html->image('pdf2.png',
                         array(
                                "alt" => "Generar",
                                'url' => array('action' => 'genera_comprobante', $id)
                              )
                        );             
                echo "</td>";
               echo '</tr>';        
    endforeach;

    ?>
    
    </table>
</fieldset>
</div>