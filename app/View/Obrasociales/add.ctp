<div class="form">
    <?php echo $this->Form->create(); ?>
    <div class="form-content">
        <div class="columns">
            <fieldset>
            <legend>Nueva Obra Social</legend>
            <?php
               
                echo $this->Form->input('cuit',
                        array(
                               'label' => 'C.U.I.T'
                             )                        
                        );
                echo $this->Form->input('descripcion',
                        array(
                               'label' => 'Denominacíon'
                             )
                        );
                
                echo $this->Form->input('direccion',
                        array (
                                'label' => 'Dirección principal'
                              )
                        );

                echo $this->Form->input('fax',
                        array (
                                'label' => 'Fax'
                              )
                        );

                echo $this->Form->input('email',
                        array (
                                'label' => 'eMail - Correo electronico'
                              )
                        );

                echo $this->Form->input('telefono',
                        array (
                                'label' => 'Telefono principal'
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

