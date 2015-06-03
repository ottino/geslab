<div id='search'>
    <?php echo $this->Form->create('Reporte',array('action'=>'reporteFacturacioniosper'));?>
    <fieldset>

        <div class="columns">
            <?php

            echo $this->Form->input('periodo', array(
                'label'=>'Periodo',
                'placeholder'=> 'AAAAMM'));  

             echo $this->Form->submit('Generar', array(
                'div' => 'actions'
             ));
             
            ?>
        </div>
    </fieldset>
    <?php echo $this->Form->end();?>
</div>