<?php

header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=ReporteRendicion.xls");
header("Pragma: no-cache");
header("Expires: 0"); 

?> 

<div class="form">
<fieldset>
    <legend>Rendicion</legend>
    
    <table cellpadding="0" cellspacing="0">
    <tr>           
            <th>Protocolo</th>            
            <th>Paciente</th>            
            <th>NUC</th>
            <th>Codigo</th>
            <th>Precio</th>

    </tr>
    <?php   

    foreach ($data as $d):
             
               echo "<tr>";
                echo "<td>" . $d['0']['protocolos'] . "</td>";
                echo "<td>" . utf8_decode($d['0']['Paciente']) . "</td>";
                echo "<td>" . $d['0']['NUC'] . "</td>";
                echo "<td>" . $d['0']['codigo'] . "</td>";
                echo "<td>" . $d['0']['precio'] . "</td>";
               echo "</tr>";     
               
    endforeach;

    ?>
    
    </table>    
</fieldset>
</div>
