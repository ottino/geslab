<div class="form">

    <?php echo $this->Form->create(); ?>

    <div class="form-content">        
            <fieldset>
            <legend>Reporte de Facturacion</legend>            
            <div class="col w40">
           
            <?php
                 echo $this->Form->input('fecha',array(                    
                    'options' => $data,
                    'label' => 'Fecha de Protocolo',
                    'empty' => 'Todos'
                     ));
               
            ?>
                
            </div>            
            </fieldset>        
     </div>
      
    <?php echo $this->Form->end('Descargar'); ?>
</div>    

<div>
    <?php
        if(isset($data) && empty($data)){
            echo "<br>";
            echo "<h2>".MSG_SIN_RES."</h2>";
        }
    ?>
    
</div>
