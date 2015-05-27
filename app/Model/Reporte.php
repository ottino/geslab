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
                                               ) AS precio,
                                                concat(
                                                IF (ifnull(a.practica150101,0) > 0 , concat('150101x',a.practica150101,' ') , ''),
                                                IF (ifnull(a.practica150102,0) > 0 , concat('150102x',a.practica150102,' ') , ''),
                                                IF (ifnull(a.practica150103,0) > 0 , concat('150103x',a.practica150103,' ') , ''),
                                                IF (ifnull(a.practica150104,0) > 0 , concat('150104x',a.practica150104,' ') , ''),
                                                IF (ifnull(a.practica150105,0) > 0 , concat('150105x',a.practica150105,' ') , ''),
                                                IF (ifnull(a.practica150106,0) > 0 , concat('150106x',a.practica150106,' ') , ''),
                                                IF (ifnull(a.practica150108,0) > 0 , concat('150108x',a.practica150108,' ') , ''),
                                                IF (ifnull(a.practica150109,0) > 0 , concat('150109x',a.practica150109,' ') , ''),
                                                IF (ifnull(a.practica150110,0) > 0 , concat('150110x',a.practica150110,' ') , ''),
                                                IF (ifnull(a.practica150111,0) > 0 , concat('150111x',a.practica150111,' ') , ''),
                                                IF (ifnull(a.practica150120,0) > 0 , concat('150120x',a.practica150120,' ') , ''),
                                                IF (ifnull(a.practica150121,0) > 0 , concat('150121x',a.practica150121,' ') , '')
                                                ) AS codigo                                               
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
    /*
        Base para armar cupon para presentar en IOSPER
    */

    public function query_reporte_3($fecha, $id){ 
       
         return $this->query(
                             "
                              select * 
                              from vw_base_cupones_iosper_2 as vw_base_cupones_iosper where  periodo = ".$fecha." AND Protocolo_id = ".$id."
                             "
                            );       
         
        }

    public function query_reporte_4() {

        return $this->query(
                            "
                             select id 
                             from protocolos 
                             where date_format(`fecha`,'%Y%m') = '201504' and obrasocial_id = 108 and internacion = 1;
                            "      
            );
    }   
        
}
?>

