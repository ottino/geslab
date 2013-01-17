<?php
$nom_archivo = 'Comprobantes.' . $id . '.pdf';

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=\"$nom_archivo\"\n");

print  $pdf_comprobantes;         
?>
