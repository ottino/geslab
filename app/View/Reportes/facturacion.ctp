<?php

header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=ReporteFacturacion.xls");
header("Pragma: no-cache");
header("Expires: 0"); 

?> 

<div class="form">
<fieldset>
    <legend>Reporte de Factracion</legend>
    
    <table cellpadding="0" cellspacing="0">
    <tr>
            <th>Fecha</th>            
            <th>Sanatorio</th>                
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
             
           if($d['a']['internacion']>0) 
                $internacion = "si"; 
           else $internacion= "no";
           
           if($d['a']['ambulatorio']>0) 
                $ambulatorio = "si"; 
           else $ambulatorio = "no";
           
               echo "<tr>";
                echo "<td>" . $d['0']['fecha'] . "</td>";
                echo "<td>" . utf8_decode($d['d']['Sanatorio']) . "</td>";
                echo "<td>" . utf8_decode($d['b']['Paciente']) . "</td>";
                echo "<td>" . $d['b']['Paciente_dni']. "</td>";
                echo "<td>" . $d['a']['Protocolo_id']. "</td>";
                echo "<td>" . $internacion . "</td>";
                echo "<td>" . $ambulatorio . "</td>";
                echo "<td>" . $d['a']['NUC'] . "</td>";
                echo "<td>" . $d['0']['Total_x_practica150101']. "</td>";
                echo "<td>" . $d['0']['Total_x_practica150102']. "</td>";
                echo "<td>" . $d['0']['Total_x_practica150103']. "</td>";
                echo "<td>" . $d['0']['Total_x_practica150104']. "</td>";
                echo "<td>" . $d['0']['Total_x_practica150105']. "</td>";
                echo "<td>" . $d['0']['Total_x_practica150106']. "</td>";
                echo "<td>" . $d['0']['Total_x_practica150108']. "</td>";
                echo "<td>" . $d['0']['Total_x_practica150109']. "</td>";
                echo "<td>" . $d['0']['Total_x_practica150110']. "</td>";
                echo "<td>" . $d['0']['Total_x_practica150111']. "</td>";
                echo "<td>" . $d['0']['Total_x_practica150120']. "</td>";
                echo "<td>" . $d['0']['Total_x_practica150121']. "</td>";
                echo "<td>" . $d['0']['Total_x_practica144790']. "</td>";
                                    
    endforeach;

    ?>
    
    </table>    
</fieldset>
</div>
