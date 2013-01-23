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
                       <th>Codigo</th>
                       <th>Precio</th> 
                       <th>Codigo</th>
                       <th>Precio</th> 
                      </tr>
                      <tr>
                        <td> 15.01.01 </td>  
                        <td>
                          <input type="text" size="2" name="data[Obrasocial][practica150101]" id="ObrasocialPractica150101" value="0" class="input_practicas_cant" >   
                        </td>  
                        <td> 15.01.02 </td>  
                        <td>
                          <input type="text" size="2" name="data[Obrasocial][practica150102]" id="ObrasocialPractica150102" value="0" class="input_practicas_cant" >   
                        </td>  
                      </tr>    
                      <tr>
                        <td> 15.01.03 </td>  
                        <td>
                          <input type="text" size="2" name="data[Obrasocial][practica150103]" id="ObrasocialPractica150103" value="0" class="input_practicas_cant" >   
                        </td>  
                        <td> 15.01.04 </td>  
                        <td>
                          <input type="text" size="2" name="data[Obrasocial][practica150104]" id="ObrasocialPractica150104" value="0" class="input_practicas_cant" >   
                        </td>  
                      </tr>    
                      <tr>
                        <td> 15.01.05 </td>  
                        <td>
                          <input type="text" size="2" name="data[Obrasocial][practica150105]" id="ObrasocialPractica150105" value="0" class="input_practicas_cant" >   
                        </td>  
                        <td> 15.01.06 </td>  
                        <td>
                          <input type="text" size="2" name="data[Obrasocial][practica150106]" id="ObrasocialPractica150106" value="0" class="input_practicas_cant" >   
                        </td>  
                      </tr>    
                      <tr>
                        <td> 15.01.08 </td>  
                        <td>
                          <input type="text" size="2" name="data[Obrasocial][practica150108]" id="ObrasocialPractica150108" value="0" class="input_practicas_cant" >   
                        </td>  
                        <td> 15.01.09 </td>  
                        <td>
                          <input type="text" size="2" name="data[Obrasocial][practica150109]" id="ObrasocialPractica150109" value="0" class="input_practicas_cant" >   
                        </td>  
                      </tr>    
                      <tr>
                        <td> 15.01.10 </td>  
                        <td>
                          <input type="text" size="2" name="data[Obrasocial][practica150110]" id="ObrasocialPractica150110" value="0" class="input_practicas_cant" >   
                        </td>  
                        <td> 15.01.11 </td>  
                        <td>
                          <input type="text" size="2" name="data[Obrasocial][practica150111]" id="ObrasocialPractica150111" value="0" class="input_practicas_cant" >   
                        </td>  
                      </tr>    
                      <tr>
                        <td> 15.01.20 </td>  
                        <td>
                          <input type="text" size="2" name="data[Obrasocial][practica150120]" id="ObrasocialPractica150120" value="0" class="input_practicas_cant" >   
                        </td>  
                        <td> 15.01.21 </td>  
                        <td>
                          <input type="text" size="2" name="data[Obrasocial][practica150121]" id="ObrasocialPractica150121" value="0" class="input_practicas_cant" >   
                        </td>  
                      </tr>    
                      <tr>
                        <td> 14.47.90 </td>  
                        <td>
                          <input type="text" size="2" name="data[Obrasocial][practica144790]" id="ObrasocialPractica144790" value="0" class="input_practicas_cant" >   
                        </td>  
                      </tr>    
                    </table>                   
            </div>
            <?php echo $this->Form->end('Guardar'); ?>
            </fieldset>

    </div>

</div>

