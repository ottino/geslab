<div class="form">
    <?php echo $this->Form->create(); ?>
    <div class="form-content">
        <div class="columns">
            <fieldset>
            <legend>Nuevo Sanatorio</legend>
            <?php
               
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

                echo $this->Form->input('email',
                        array (
                                'label' => 'eMail'
                              )
                        ); 

                echo $this->Form->input('email2',
                        array (
                                'label' => 'eMail Alternativo'
                              )
                        ); 
  
                
            ?>
            <?php echo $this->Form->end('Guardar'); ?>
            </fieldset>
        </div>  
    </div>

</div>

