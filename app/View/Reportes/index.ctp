<div id='search'>
    <?php echo $this->Form->create('Reportes',array('action'=>'search'));?>
    <fieldset>

        <div class="columns">
            <?php
            echo $this->Form->input('Reportes.buscar_valor', array(
                'label'=>'Buscar',
                'placeholder'=> 'Escriba aquí'));
            ?>
                        <?php
            echo $this->Form->submit('Buscar', array(
                'div' => 'actions'
            ));
            ?>
        </div>
        <div class="columns_search">
            <?php
            echo $this->Form->input('Reportes.buscar_por', array(
                            'options' => array(
                                1 => 'Fecha (AAAAMMDD)',
                                ),
                            'label' => 'Por',
                            'default' => 3));
            ?>
        </div>

    </fieldset>
    <?php echo $this->Form->end();?>

</div>