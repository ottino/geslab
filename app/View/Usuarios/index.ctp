<div class="form">
<fieldset>
    <legend>Usuarios</legend>
    
    <table cellpadding="0" cellspacing="0">
    <tr>    
            <th><?php echo $this->Paginator->sort('nombre');?></th>
            <th><?php echo $this->Paginator->sort('usuario');?></th>            
            <th><?php echo $this->Paginator->sort('dni');?></th>            
            <th><?php echo $this->Paginator->sort('created','Fecha Alta');?></th>            
            <th><?php echo $this->Paginator->sort('matricula','Matrícula');?></th>
            <th><?php echo $this->Paginator->sort('perfil');?></th>
                        
            <th><?php echo 'Opciones';?></th>
    </tr>
    <?php      
    $i = 0;    
    foreach ($data as $d):        
            echo "<tr>";
                echo "<td>" . h($d['Usuario']['nombre']) . "</td>";
                echo "<td>" . h($d['Usuario']['usuario']) . "</td>";
                echo "<td>" . h($d['Usuario']['dni']) . "</td>";                
                echo "<td>" . h( $this->Time->format(CONST_FORMAT_FECHA_VISTA, $d['Usuario']['created']) ) . "</td>";                
                echo "<td>" . h($d['Usuario']['matricula']) . "</td>";
                echo "<td>" . h($d['Perfil']['nombre']) . "</td>";
                echo '<td class="actions">';

                $id = $d['Usuario']['id'];

                echo $this->Html->link(
                        BTN_EDIT, 
                        array('action' => 'edit', $id), 
                        array('title'=>BTN_EDIT,'escape' => false ));

                echo $this->Form->postLink(
                        BTN_DEL, 
                        array('action' => 'delete', $id),
                        array('title'=>'Eliminar','escape' => false ),
                        MSG_PREG_ELIM_DATO
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
                echo $this->Paginator->prev('< ' , array(), null, array('class' => 'prev disabled'));
                echo $this->Paginator->numbers(array('separator' => ''));
                echo $this->Paginator->next(' >', array(), null, array('class' => 'next disabled'));
        ?>
    </div>
    
</fieldset>
</div>

