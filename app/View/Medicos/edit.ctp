<div class="form">
    <?php echo $this->Form->create('Medico',array('action' => 'edit')); ?>
    <div class="form-content">
        <div class="columns">
            <fieldset>
            <legend>Editar Medico</legend>
            <?php
                
                echo $this->Form->input('id', array('type' => 'hidden'));

                echo $this->Form->input('razon_social',
                        array(
                               'label' => 'Apellido y Nombre'
                             )
                        );
                
                echo $this->Form->input('direccion',
                        array (
                                'label' => 'Dirección principal'
                              )
                        );
                
                echo $this->Form->input(
                        'localidad_id',
                         array(
                            'options' => $localidades,
                            'label' => 'Localidad',
                            'empty' => 'Eliga una opción')
                        );
  
                 echo $this->Form->input('telefono',
                        array (
                                'label' => 'Telefono principal'
                              )
                        );
                 
                echo $this->Form->input('celular',
                        array (
                                'label' => 'Celular'
                              )
                        );

                echo $this->Form->input('email',
                        array (
                                'label' => 'eMail - Correo electronico'
                              )
                        );

                echo $this->Form->input('matricula',
                        array (
                                'label' => 'Matricula'
                              )
                        );
                
            ?>
            <?php echo $this->Form->end('Guardar'); ?>
            </fieldset>
        </div>  
    </div>

</div>
