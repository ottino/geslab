<div id='search'>
    <?php echo $this->Form->create('Obrasocial',array('action'=>'search_obrasocial'));?>
    <fieldset>

        <div class="columns">
            <?php
            echo $this->Form->input('Obrasocial.buscar_valor', array(
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
            echo $this->Form->input('Obrasocial.buscar_por', array(
                            'options' => array(
                                1 => 'Nombre'
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
    <legend>Obras Sociales</legend>
    
    <table cellpadding="0" cellspacing="0">
    <tr>
            <th>Identificación</th>
            <th>CUIT</th>
            <th>Descripcion</th>            
            <th>Localidad</th>            
            <th>Direccion</th>
            <th>Telefono</th>
            <th>Fax</th>
            <th>eMail</th>   
            <th></th>
    </tr>
    <?php        
    foreach ($data as $d):
            echo "<tr>";
                echo "<td>" . $d['Obrasocial']['id'] . "</td>";
                echo "<td>" . $d['Obrasocial']['cuit'] . "</td>";
                echo "<td>" . $d['Obrasocial']['descripcion'] . "</td>";
                echo "<td>" . $d['Localidad']['descripcion'] . "</td>";
                echo "<td>" . $d['Obrasocial']['direccion']. "</td>";
                echo "<td>" . $d['Obrasocial']['telefono']. "</td>";
                echo "<td>" . $d['Obrasocial']['fax']. "</td>";
                echo "<td>" . $d['Obrasocial']['email']. "</td>";

                echo "<td class='actions'>";
                
                $id = $d['Obrasocial']['id'];
                
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




