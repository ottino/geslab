<div class="form">
    <?php echo $this->Form->create(); ?>
    <div class="form-content">

          <fieldset>
           <legend>Nueva Obra Social</legend>
            <div class="col w40">
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
            </div>  
            <div class="col w40">
              <table>
                <tr>
                 <th>Codigo</th>
                 <th>Precio</th> 
                </tr>
                <tr>
                  <td> . </td>  
                  <td> . </td>  
                </tr>    
              </table>    
            </div>
            <?php echo $this->Form->end('Guardar'); ?>
            </fieldset>

    </div>

</div>

