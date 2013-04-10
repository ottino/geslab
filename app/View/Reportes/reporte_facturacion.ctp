<div id='search'>
    <?php echo $this->Form->create('Reporte',array('action'=>'search'));?>
    <fieldset>

        <div class="columns">
            <?php
            echo $this->Form->input('Reporte.buscar_valor', array(
                'label'=>'Buscar',
                'placeholder'=> 'Escriba ej. 201304'));
            
            echo $this->Form->submit('Buscar', array(
                'div' => 'actions'
            ));
            
            ?>
        </div>
        <div class="columns_search">
            <?php
            echo $this->Form->input('Reporte.buscar_por', array(
                            'options' => array(
                                1 => 'Fecha (AAAAMM)'//,
                               // 2 => 'Sanatorio',
                               // 3 => 'Obra Social',
                                ),
                            'label' => 'Por',
                            'default' => 1));
            ?>
        </div>

    </fieldset>
    <?php echo $this->Form->end();?>
</div>
