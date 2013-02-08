<div id='search'>
    <?php echo $this->Form->create('Organo',array('action'=>'search_organo'));?>
    <fieldset>

        <div class="columns">
            <?php
            echo $this->Form->input('Organo.buscar_valor', array(
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
            echo $this->Form->input('Organo.buscar_por', array(
                            'options' => array(
                                1 => 'Tipo de Protocolo',
                                2 => 'Organo'
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
    <legend>Organos</legend>
    
    <table cellpadding="0" cellspacing="0">
    <tr>
            <th>Tipo de Protocolo</th>
            <th>Organo</th>
            <th>Macroscopia</th>
            <th>Microscopia</th>
            <th></th>          
    </tr>
    <?php        
    foreach ($data as $d):
         
           if (($d['Organo']['macroscopia'] <> null) or
              ($d['Organo']['macroscopia'] <> ''))
               $marca_macro = 'X';
               else $marca_macro = '-';

            if (($d['Organo']['microscopia'] <> null) or
              ($d['Organo']['microscopia'] <> ''))
               $marca_micro = 'X';
               else $marca_micro = '-';
           
            echo "<tr>";
                echo "<td>" . $d['Organo']['tipoprotocolo'] . "</td>";
                echo "<td>" . $d['Organo']['descripcion'] . "</td>";
                echo "<td>" . $marca_macro . "</td>";
                echo "<td>" . $marca_micro . "</td>";
                echo "<td class='actions'>";
                
                $id = $d['Organo']['id'];
                
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