<div class="form">
<fieldset>
    <legend>Modulos</legend>
                
    <table cellpadding="0" cellspacing="0">
    <tr>
            <th><?php echo $this->Paginator->sort('nombre');?></th>
            <th><?php echo $this->Paginator->sort('accion');?></th>
            <th><?php echo $this->Paginator->sort('grupo');?></th>
            <th><?php echo $this->Paginator->sort('nivel');?></th>
            
            <th><?php echo 'Opciones';?></th>
    </tr>
    <?php      
    $i = 0;
    foreach ($data as $d):
            echo "<tr>";
                echo "<td>" . h($d['Modulo']['nombre']) . "</td>";
                echo "<td>" . h($d['Modulo']['accion']) . "</td>";
                echo "<td>" . h($d['Modulo']['grupo']) . "</td>";
                echo "<td>" . h($d['Modulo']['nivel']) . "</td>";
                         
                echo '<td class="actions">';

                $id = $d['Modulo']['id'];

                echo $this->Html->link(
                        BTN_EDIT, 
                        array('action' => 'edit', $id), 
                        array('title'=>'Editar','escape' => false ));

                echo $this->Form->postLink(
                        BTN_DEL, 
                        array('action' => 'delete', $id),
                        array('title'=>'Eliminar','escape' => false ),
                        'Esta seguro que desea eliminar este dato?'
                );
                echo '</td>';
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
