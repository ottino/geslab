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
                   <table class ="table_practicas">
                      <tr>
                       <th width ="15">Codigo</th>
                       <th width ="15">Precio</th> 
                      </tr>
                      <tr>
                        <td width ="15"> 15.01.01 </td>  
                        <td width ="15"> $ </td>  
                      </tr>    
                      <tr>
                        <td> 15.01.02 </td>  
                        <td> $ </td>  
                      </tr>    
                      <tr>
                        <td> 15.01.03 </td>  
                        <td> $ </td>  
                      </tr>    
                      <tr>
                        <td> 15.01.04 </td>  
                        <td> $ </td>  
                      </tr>    
                      <tr>
                        <td> 15.01.05 </td>  
                        <td> $ </td>  
                      </tr>    
                      <tr>
                        <td> 15.01.06 </td>  
                        <td> $ </td>  
                      </tr>    
                      <tr>
                        <td> 15.01.08 </td>  
                        <td> $ </td>  
                      </tr>    
                      <tr>
                        <td> 15.01.09 </td>  
                        <td> $ </td>  
                      </tr>    
                      <tr>
                        <td> 15.01.10 </td>  
                        <td> $ </td>  
                      </tr>    
                      <tr>
                        <td> 15.01.11 </td>  
                        <td> $ </td>  
                      </tr>                     
                      <tr>
                        <td> 15.01.20 </td>  
                        <td> $ </td>  
                      </tr>    
                      <tr>
                        <td> 15.01.21 </td>  
                        <td> $ </td>  
                      </tr>    
                      <tr>
                        <td> 14.47.90 </td>  
                        <td> $ </td>  
                      </tr>    
                    </table>                    
            </div>
            <?php echo $this->Form->end('Guardar'); ?>
            </fieldset>

    </div>

</div>

