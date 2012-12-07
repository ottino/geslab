<div class="form">
    <?php echo $this->Form->create('Sanatorio',array('action' => 'edit')); ?>
    <div class="form-content">
        <div class="columns">
            <fieldset>
            <legend>Editar Sanatorio</legend>
            <?php
                
                echo $this->Form->input('id', array('type' => 'hidden'));
                
                echo $this->Form->input('descripcion');
                echo $this->Form->input('telefono1',
                        array(
                               'label' => 'Telefono Principal'
                             )
                        );
                
                echo $this->Form->input('telefono2',
                        array (
                                'label' => 'Telefono Secundario'
                              )
                        );
                
                echo $this->Form->input(
                        'localidad_id',
                         array(
                            'options' => $localidades,
                            'label' => 'Localidad',
                            'empty' => 'Eliga una opción')
                        );
            ?>
            <?php echo $this->Form->end('Guardar'); ?>
            </fieldset>
        </div>  
    </div>

</div>
