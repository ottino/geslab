<div id='search'>
    <?php echo $this->Form->create('Paciente',array('action'=>'search_paciente'));?>
    <fieldset>

        <div class="columns">
            <?php
            echo $this->Form->input('Paciente.buscar_valor', array(
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
            echo $this->Form->input('Paciente.buscar_por', array(
                            'options' => array(
                                1 => 'DNI Paciente',
                                2 => 'Nombre Paciente'
                                ),
                            'label' => 'Por',
                            'default' => 1));
            ?>
        </div>

    </fieldset>
    <?php echo $this->Form->end();?>

</div>
<div class="form">
<fieldset>
    <legend>Pacientes</legend>
    
    <table cellpadding="0" cellspacing="0">
    <tr>
            <th>DNI</th>
            <th>Razon Social</th>
            <th>Apellido</th>            
            <th>Nombre</th>            
            <th>Dirección</th>            
            <th>Localidad</th>
            <th>Telefono</th>
            <th>Celular</th>
            <th>eMail</th>  
            <th></th>               
    </tr>
    <?php        
    foreach ($data as $d):
            echo "<tr>";
                echo "<td>" . $d['Paciente']['dni'] . "</td>";
                echo "<td>" . $d['Paciente']['razon_social'] . "</td>";
                echo "<td>" . $d['Paciente']['apellido'] . "</td>";
                echo "<td>" . $d['Paciente']['nombre'] . "</td>";
                echo "<td>" . $d['Paciente']['direccion'] . "</td>";
                echo "<td>" . $d['Localidad']['descripcion'] . "</td>";
                echo "<td>" . $d['Paciente']['telefono']. "</td>";
                echo "<td>" . $d['Paciente']['celular']. "</td>";
                echo "<td>" . $d['Paciente']['email']. "</td>";

                echo "<td class='actions'>";
                
                $id = $d['Paciente']['id'];
                
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




