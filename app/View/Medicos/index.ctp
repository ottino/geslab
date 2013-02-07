<div id='search'>
    <?php echo $this->Form->create('Medico',array('action'=>'search_medico'));?>
    <fieldset>

        <div class="columns">
            <?php
            echo $this->Form->input('Medico.buscar_valor', array(
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
            echo $this->Form->input('Medico.buscar_por', array(
                            'options' => array(
                                1 => 'Nombre Medico'
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
    <legend>Medicos</legend>
    
    <table cellpadding="0" cellspacing="0">
    <tr>
            <th>Razon Social</th>            
            <th>Apellido</th>            
            <th>Nombre</th>            
            <th>Dirección</th>            
            <th>Localidad</th>
            <th>Telefono</th>
            <th>Celular</th>
            <th>eMail</th>  
            <th>Matricula</th>
            <th></th>             
    </tr>
    <?php        
    foreach ($data as $d):
            echo "<tr>";
                echo "<td>" . $d['Medico']['razon_social'] . "</td>";
                echo "<td>" . $d['Medico']['apellido'] . "</td>";
                echo "<td>" . $d['Medico']['nombre'] . "</td>";
                echo "<td>" . $d['Medico']['direccion'] . "</td>";
                echo "<td>" . $d['Localidad']['descripcion'] . "</td>";
                echo "<td>" . $d['Medico']['telefono']. "</td>";
                echo "<td>" . $d['Medico']['celular']. "</td>";
                echo "<td>" . $d['Medico']['email']. "</td>";
                echo "<td>" . $d['Medico']['matricula']. "</td>";
                
                echo "<td class='actions'>";
                
                $id = $d['Medico']['id'];
                
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




