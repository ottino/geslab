<div class="form">
<fieldset>
    <legend>Perfiles</legend>
        
    <table cellpadding="0" cellspacing="0">
    <tr>            
            <th><?php echo $this->Paginator->sort('nombre');?></th>
            <th><?php echo 'Opciones';?></th>
    </tr>
    <?php      
    $i = 0;
    foreach ($data as $d):
            echo "<tr>";
                echo "<td>" . h($d['Perfil']['nombre']) . "</td>";
        
                echo '<td class="actions">';

                $id = $d['Perfil']['id'];

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
