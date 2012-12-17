<div class="form">
    <?php  echo $this->Form->create('Modulo', array('action' => 'edit')); ?>
    
    <div class="form-content">
        <fieldset>
            <legend>Editar Módulo</legend>
            <div class="columns">
            <?php
                echo $this->Form->input('id', array('type' => 'hidden'));

                echo $this->Form->input('nombre');

                echo $this->Form->input('accion');

                echo $this->Form->input('grupo');

                echo $this->Form->input('nivel');
            ?>
            </div>
        </fieldset>
        
    </div>
    <?php echo $this->Form->end('Guardar'); ?>
</div>
