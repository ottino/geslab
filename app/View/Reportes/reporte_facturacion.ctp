<div id='search'>
    <?php echo $this->Form->create('Reporte',array('action'=>'search'));?>
    <fieldset>

        <div class="columns">
            <?php
            echo $this->Form->input('Reporte.buscar_valor', array(
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
            echo $this->Form->input('Reporte.buscar_por', array(
                            'options' => array(
                                1 => 'Fecha (AAAAMM)',
                                2 => 'Sanatorio',
                                3 => 'Obra Social',
                                ),
                            'label' => 'Por',
                            'default' => 1));
            ?>
        </div>

    </fieldset>
    <?php echo $this->Form->end();?>
</div>

<div class="form">
<fieldset>
    <legend>Reporte de Factracion</legend>
    
    <table cellpadding="0" cellspacing="0">
    <tr>
            <th>Fecha</th>            
            <th>Sanatorio</th>            
            <th>Obra Social</th>            
            <th>Paciente</th>            
            <th>Dni Paciente</th>
            <th>Nro. Protocolo</th>
            <th>Internacion</th>
            <th>Ambulatorio</th>
            <th>NUC</th>
            <th>150101</th>
            <th>150102</th>
            <th>150103</th>
            <th>150104</th>
            <th>150105</th>
            <th>150106</th>
            <th>150108</th>
            <th>150109</th>
            <th>150110</th>
            <th>150111</th>
            <th>150120</th>
            <th>150121</th>
            <th>144790</th>
    </tr>
    <?php        
    foreach ($data as $d):
             
           if($d['Reporte']['internacion']>0) 
                $internacion = "si"; 
           else $internacion= "no";
           
           if($d['Reporte']['ambulatorio']>0) 
                $ambulatorio = "si"; 
           else $ambulatorio = "no";
           
               echo "<tr>";
                echo "<td>" . $d['Reporte']['fecha'] . "</td>";
                echo "<td>" . $d['Reporte']['Sanatorio'] . "</td>";
                echo "<td>" . $d['Reporte']['Obra_Social'] . "</td>";
                echo "<td>" . $d['Reporte']['Paciente'] . "</td>";
                echo "<td>" . $d['Reporte']['Paciente_dni']. "</td>";
                echo "<td>" . $d['Reporte']['Protocolo_id']. "</td>";
                echo "<td>" . $internacion . "</td>";
                echo "<td>" . $ambulatorio . "</td>";
                echo "<td>" . $d['Reporte']['NUC'] . "</td>";
                echo "<td>" . $d['Reporte']['Total_x_practica150101']. "</td>";
                echo "<td>" . $d['Reporte']['Total_x_practica150102']. "</td>";
                echo "<td>" . $d['Reporte']['Total_x_practica150103']. "</td>";
                echo "<td>" . $d['Reporte']['Total_x_practica150104']. "</td>";
                echo "<td>" . $d['Reporte']['Total_x_practica150105']. "</td>";
                echo "<td>" . $d['Reporte']['Total_x_practica150106']. "</td>";
                echo "<td>" . $d['Reporte']['Total_x_practica150108']. "</td>";
                echo "<td>" . $d['Reporte']['Total_x_practica150109']. "</td>";
                echo "<td>" . $d['Reporte']['Total_x_practica150110']. "</td>";
                echo "<td>" . $d['Reporte']['Total_x_practica150111']. "</td>";
                echo "<td>" . $d['Reporte']['Total_x_practica150120']. "</td>";
                echo "<td>" . $d['Reporte']['Total_x_practica150121']. "</td>";
                echo "<td>" . $d['Reporte']['Total_x_practica144790']. "</td>";
                                    
    endforeach;

    ?>
    
    </table>
     <p>
        <?php
        echo $this->Paginator->counter(array(
                'format' => __d('cake', 'Página {:page} de {:pages} - Registros {:count} - Actual [{:start} a {:end}]')
        ));
        ?>
    </p>
    <div class="paging">
        <?php
                echo $this->Paginator->prev('< ' . __d('cake', ''), array(), null, array('class' => 'prev disabled'));
                echo $this->Paginator->numbers(array('separator' => ''));
                echo $this->Paginator->next(__d('cake', '') .' >', array(), null, array('class' => 'next disabled'));
        ?>
    </div>       
</fieldset>
</div>
