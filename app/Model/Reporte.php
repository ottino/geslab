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
    
    public function query_reporte_2($filtro){
       
         return $this->query(
                             "                            
                                select 	
                                            a.id		AS protocolos,
                                            b.razon_social 	AS Paciente,
                                            a.NUC 		AS NUC,
                                            sum(
                                                (ifnull(a.practica150101,0) * ifnull(a.precio150101,0)) +
                                                (ifnull(a.practica150102,0) * ifnull(a.precio150102,0)) +
                                                (ifnull(a.practica150103,0) * ifnull(a.precio150103,0)) +
                                                (ifnull(a.practica150104,0) * ifnull(a.precio150104,0)) +
                                                (ifnull(a.practica150105,0) * ifnull(a.precio150105,0)) +
                                                (ifnull(a.practica150106,0) * ifnull(a.precio150106,0)) +
                                                (ifnull(a.practica150108,0) * ifnull(a.precio150108,0)) +
                                                (ifnull(a.practica150109,0) * ifnull(a.precio150109,0)) +
                                                (ifnull(a.practica150110,0) * ifnull(a.precio150110,0)) +
                                                (ifnull(a.practica150111,0) * ifnull(a.precio150111,0)) +
                                                (ifnull(a.practica150120,0) * ifnull(a.precio150120,0)) +
                                                (ifnull(a.practica150121,0) * ifnull(a.precio150121,0)) +
                                                (ifnull(a.practica144790,0) * ifnull(a.precio144790,0)) 
                                               ) AS precio
                                from (((protocolos a join pacientes b) join obrasociales c) 
                                                join sanatorios d) 
                                where  ((a.paciente_id = b.id)     and 
                                          (a.obrasocial_id = c.id) and 
                                          (a.sanatorio_id = d.id)) and 
                                          ".$filtro." 
                                GROUP BY b.razon_social , a.NUC , a.id
                                ORDER BY NUC asc"
                            );       
         
        }        
}
?>

