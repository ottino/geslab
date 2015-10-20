<div id='search'>
    <?php echo $this->Form->create('Reporte',array('action'=>'reporteFacturacioniosper'));?>
    <fieldset>

        <div class="columns">
            <?php

            echo $this->Form->input('periodo_ini', array(
                'label'=>'Fecha de Inicio',
                'placeholder'=> 'AAAAMMDD'));

            echo $this->Form->input('periodo_fin', array(
                'label'=>'Fecha de Fin',
                'placeholder'=> 'AAAAMMDD'));  

            echo "<br>";
            echo "Unicamente para buscar un protocolo, sino dejar vacio.";

            echo $this->Form->input('protocolo_nro', array(
                'label'=>' ',
                'placeholder'=> 'Nro. de protocolo'));  

             echo $this->Form->submit('Generar', array(
                'div' => 'actions'
             ));
             
            ?>
        </div>
    </fieldset>
    <?php echo $this->Form->end();?>
</div>