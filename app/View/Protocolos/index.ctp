<div id='search'>
    <?php echo $this->Form->create('Protocolo',array('action'=>'search'));?>
    <fieldset>

        <div class="columns">
            <?php
            echo $this->Form->input('Protocolo.buscar_valor', array(
                'label'=>'Buscar',
                'placeholder'=> 'Escriba aquí'));
            ?>
                        <?php
            echo $this->Form->submit('Buscar', array(
                'div' => 'actions'
            ));
            ?>
        </div>
        <div class="columns_search">
            <?php
            echo $this->Form->input('Protocolo.buscar_por', array(
                            'options' => array(
                                1 => 'DNI Paciente',
                                2 => 'Nombre Paciente',
                                3 => 'Nro. Protocolo',
                                4 => 'Nombre Medico',
                                5 => 'Tipo de Protocolo',
                                6 => 'Fecha (AAAAMMDD)',
                                ),
                            'label' => 'Por',
                            'default' => 3));
            ?>
        </div>

    </fieldset>
    <?php echo $this->Form->end();?>

</div>

<div class="form">
<fieldset>
    <legend>Protocolos</legend>
    
    <table cellpadding="0" cellspacing="0">
    <tr>
            <th>Fecha Alta</th>            
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
            <th></th>
            <th>eMail</th>
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
                echo "<td>" . $d['Protocolo']['fecha'] . "</td>";
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
                echo "<td class='actions'>";
                
                $id = $d['Protocolo']['id'];
                
                echo $this->Html->link(
                        BTN_VIEW, 
                        array('action' => 'vista_preliminar', $id), 
                        array('title'=>BTN_EDIT,'escape' => false )
                );

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
                echo "<td>";
               
                echo $this->Html->image('gmail.png',
                         array(
                                "alt" => "Enviar",
                                'url' => array('action' => 'envia_mail', $id)
                              )
                        );
                echo "</td>";
                /*
                echo "<td>";
                
                echo $this->Html->image('pdf2.png',
                         array(
                                "alt" => "Generar",
                                'url' => array('action' => 'genera_comprobante', $id)
                              )
                        );             
                echo "</td>";
                 * 
                 */
               echo '</tr>';        
    endforeach;

    ?>
    
    </table>
    <p>
        <?php
        echo $this->Paginator->counter(array(
                'format' => __d('cake', 'Página {:page} de {:pages} - Registros {:count} - Actual [{:start} a {:end}]')
        ));
        ?>
    </p>
    <div class="paging">
        <?php
                echo $this->Paginator->prev('< ' . __d('cake', ''), array(), null, array('class' => 'prev disabled'));
                echo $this->Paginator->numbers(array('separator' => ''));
                echo $this->Paginator->next(__d('cake', '') .' >', array(), null, array('class' => 'next disabled'));
        ?>
    </div>
</fieldset>
</div>