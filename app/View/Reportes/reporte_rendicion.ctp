<div id='search'>
    <?php echo $this->Form->create('Reporte',array('action'=>'search_rendicion'));?>
    <fieldset>

        <div class="columns">
            <?php

            echo $this->Form->input('periodo', array(
                'label'=>'Periodo',
                'placeholder'=> 'AAAAMM'));  

            /*
            echo $this->Form->input(
                    'obrasocial_id',
                     array(
                        'options' => $obrasociales,
                        'label' => 'Obra Social',
                        'empty' => 'Eliga una opción',

                         )
                    );   
            
            echo $this->Form->input(
                    'sanatorio_id',
                     array(
                        'options' => $sanatorios,
                        'label' => 'Sanatorio',
                        'empty' => 'Eliga una opción')
                    );    
            
            echo $this->Form->input('fecha_inicio', array(
                'label'=>'Fecha Inicio',
                'placeholder'=> 'AAAAMMDD'));            

            echo $this->Form->input('fecha_fin', array(
                'label'=>'Fecha Fin',
                'placeholder'=> 'AAAAMMDD'));       
 
            echo $this->Form->input(
                  'internacion',
                   array(
                         'type'  => 'checkbox',
                         'label' => 'Internacion'
                        )
                  );

            echo $this->Form->input(
                  'ambulatorio',
                   array(
                         'type'  => 'checkbox',
                         'label' => 'Ambulatorio'
                        )
                  ); 
            */

             echo $this->Form->submit('Buscar', array(
                'div' => 'actions'
             ));
            

            ?>
        </div>
    </fieldset>
    <?php echo $this->Form->end();?>
</div>
