<div id='search'>
    <?php echo $this->Form->create('Reporte',array('action'=>'reporteFacturacionfemer'));?>
    <fieldset>

        <div class="columns">
            <?php

            echo $this->Form->input('periodo_ini', array(
                'label'=>'Fecha de Inicio',
                'placeholder'=> 'AAAAMMDD'));

            echo $this->Form->input('periodo_fin', array(
                'label'=>'Fecha de Fin',
                'placeholder'=> 'AAAAMMDD'));  

/*
            echo "<br>";
            echo "Unicamente para buscar un protocolo, sino dejar vacio.";

            echo $this->Form->input('protocolo_nro', array(
                'label'=>' ',
                'placeholder'=> 'Nro. de protocolo'));  
*/

            echo "<br>";
            echo "<br>";
            echo "<br>";
            // http://malebolgia.shadowsonawall.net/code-programming/cake-using-multiple-select-checkboxes.html

            echo "<label>Seleccionar las obras sociales</label>";
            echo "<br>";

            echo '<div style="overflow:scroll;height:400px;width:700px;">';

            echo $this->Form->input('lsitaOS', array(
                'label' => false,
                'div' => false,
                'type' => 'select',
                'multiple'=>'checkbox',
                'legend' => 'false',
                'options' => array($obrasociales)
                )
            );

            echo '</div>';

            echo $this->Form->submit('Generar', array(
                'div' => 'actions'
             ));
             
            ?>
        </div>
    </fieldset>
    <?php echo $this->Form->end();?>
</div>