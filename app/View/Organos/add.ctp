<div class="form">
    <?php echo $this->Form->create(); ?>
    <div class="form-content">
        <div class="columns">
            <fieldset>
            <legend>Nueva Organo</legend>
            <?php
               
                echo $this->Form->input('tipoprotocolo',
                        array(
                               'label'   => 'Tipo de Protocolo',
                               'options' => array ('citologia' => 'citologia', 
                                                   'biopsia'   => 'biopsia'),
                               'empty'   => 'Eliga una opción'
                             )                        
                        );
                echo $this->Form->input('descripcion',
                        array(
                               'label' => 'Descripcion'
                             )
                        );
                echo $this->Form->input('macroscopia',
                        array(
                               'label' => 'Macroscopia'
                             )
                        );
                echo $this->Form->input('microscopia',
                        array(
                               'label' => 'Microscopia'
                             )
                        );
            ?>
            <?php echo $this->Form->end('Guardar'); ?>
            </fieldset>
        </div>  
    </div>

</div>