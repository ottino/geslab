<div class="form">
    <?php echo $this->Form->create(); ?>
    <div class="form-content">
        <div class="columns">
            <fieldset>
            <legend>Nuevo Estudio</legend>
            <?php

                echo $this->Form->input('descripcion',
                        array(
                               'label' => 'Descripcion'
                             )                        
                        );
                
                echo $this->Form->input(
                        'organo_id',
                         array(
                            'options' => $organos,
                            'label' => 'Organos',
                            'empty' => 'Eliga una opción')
                        );

                
            ?>
            <?php echo $this->Form->end('Guardar'); ?>
            </fieldset>
        </div>  
    </div>

</div>

