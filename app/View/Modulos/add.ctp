
<div class="form">
    <?php  echo $this->Form->create(); ?>

    <div class="form-content">
        <fieldset>
                <legend>Nuevo Módulo</legend>
                <div class="columns">
                <?php

                echo $this->Form->input('nombre');

                echo $this->Form->input('accion');

                echo $this->Form->input('grupo');

                echo $this->Form->input('nivel');
                
                echo $this->Form->input('en_menu', array(
                    'label' => 'Mostrar en menú'
                ));

                ?>
                </div>
        </fieldset>

    </div>
    <?php echo $this->Form->end('Guardar'); ?>
</div>