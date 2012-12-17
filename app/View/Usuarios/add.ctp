<div class="form">
    <?php  echo $this->Form->create(); ?>
    <div class="form-content">    
    <fieldset>    
        <legend>Nuevo Usuario</legend>
        <div class="col w40">
        <?php
        
            echo $this->Form->input('nombre', array('label'=>'Apellido y Nombre'));

            echo $this->Form->input('usuario');

            echo $this->Form->input('clave', array('type'=>'password'));

            echo $this->Form->input('dni');

            echo $this->Form->input('matricula');
            
            echo $this->Form->input('created', array(
                'label'=>'Fecha Alta',
                'dateFormat' => 'DMY',
                'separator' => '/',
                'minYear' => 2000
            ));

            echo $this->Form->input('perfil_id', array(
                                'options' => $perfiles,
                                'label' => 'Perfil'));
        ?>
            </div>
    </fieldset>
    </div>    
    <?php   echo $this->Form->end('Guardar'); ?>

</div>
