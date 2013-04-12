<?php

class Reporte extends AppModel{
    
    public $name = 'Reportes';
    public $useTable = false;
    public $primaryKey = 'Protocolo_id';
    
    public function query_reporte($filtro){
       
         return $this->query(
                             "
                              select * 
                              from vw_practicas_x_totales
                              ".$filtro
                            );       
         
        }
}
?>

