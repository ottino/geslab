<div class="form">
    <?php echo $this->Form->create('Estudio',array('action' => 'edit')); ?>
    <div class="form-content">
        <div class="columns">
            <fieldset>
            <legend>Editar Paciente</legend>
            <?php

                echo $this->Form->input('id', array('type' => 'hidden'));
                
                echo $this->Form->input('descripcion',
                        array(
                               'label' => 'descripcion'
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
