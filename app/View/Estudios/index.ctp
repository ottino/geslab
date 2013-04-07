<div id='search'>
    <?php echo $this->Form->create('Estudio',array('action'=>'search_estudio'));?>
    <fieldset>

        <div class="columns">
            <?php
            echo $this->Form->input('Estudio.buscar_valor', array(
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
            echo $this->Form->input('Estudio.buscar_por', array(
                            'options' => array(
                                1 => 'Nombre del Estudio',
                                2 => 'Nombre del Organo'
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
    <legend>Estudios</legend>
    
    <table cellpadding="0" cellspacing="0">
    <tr>
            <th>Estudio</th>
            <th>Organo</th>            
            <th>Tipo de Protocolo</th>            
            <th></th>               
    </tr>
    <?php  

    foreach ($data as $d):
            echo "<tr>";
                echo "<td>" . $d['Estudio']['descripcion'] . "</td>";
                echo "<td>" . $d['Organo']['descripcion'] . "</td>";
                echo "<td>" . $d['Organo']['tipoprotocolo'] . "</td>";

                echo "<td class='actions'>";
                
                $id = $d['Estudio']['id'];
                
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




