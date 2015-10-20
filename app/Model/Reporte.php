<?php

class Reporte extends AppModel{
    
    public $name = 'Reportes';
    public $useTable = false;
    public $primaryKey = 'Protocolo_id';
    
    public function query_reporte($filtro){
       
         return $this->query(
          "
            select date_format(a.fecha,'%Y%m') AS Periodo,
                   date_format(a.fecha,'%Y%m%d') AS fecha,
                 d.descripcion AS Sanatorio,
                 d.id AS sanatorio_id,
                 b.razon_social AS Paciente,
                 b.dni AS Paciente_dni,
                 a.id AS Protocolo_id,
                 a.internacion AS internacion,
                 a.ambulatorio AS ambulatorio,
                 a.NUC AS NUC,
                 (ifnull(a.practica150101,0) * ifnull(a.precio150101,0)) AS Total_x_practica150101,
                 (ifnull(a.practica150102,0) * ifnull(a.precio150102,0)) AS Total_x_practica150102,
                 (ifnull(a.practica150103,0) * ifnull(a.precio150103,0)) AS Total_x_practica150103,
                 (ifnull(a.practica150104,0) * ifnull(a.precio150104,0)) AS Total_x_practica150104,
                 (ifnull(a.practica150105,0) * ifnull(a.precio150105,0)) AS Total_x_practica150105,
                 (ifnull(a.practica150106,0) * ifnull(a.precio150106,0)) AS Total_x_practica150106,
                 (ifnull(a.practica150108,0) * ifnull(a.precio150108,0)) AS Total_x_practica150108,
                 (ifnull(a.practica150109,0) * ifnull(a.precio150109,0)) AS Total_x_practica150109,
                 (ifnull(a.practica150110,0) * ifnull(a.precio150110,0)) AS Total_x_practica150110,
                 (ifnull(a.practica150111,0) * ifnull(a.precio150111,0)) AS Total_x_practica150111,
                 (ifnull(a.practica150120,0) * ifnull(a.precio150120,0)) AS Total_x_practica150120,
                 (ifnull(a.practica150121,0) * ifnull(a.precio150121,0)) AS Total_x_practica150121,
                 (ifnull(a.practica144790,0) * ifnull(a.precio144790,0)) AS Total_x_practica144790 
            from 
               protocolos a inner join (pacientes b , sanatorios d)
                                on (a.paciente_id  = b.id and a.sanatorio_id = d.id)
            where a.obrasocial_id = 108
            and  a.internacion = 1  
            and  date_format(a.fecha,'%Y%m') = '".$filtro."'          
          ");  

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
                              from vw_base_cupones_iosper_3 as vw_base_cupones_iosper where  periodo = ".$fecha." AND Protocolo_id = ".$id."
                             "
                            );       
         
        }

    public function query_reporte_4($fecha_ini , $fecha_fin, $nro_protocolo = null) {

        if ($nro_protocolo <> '') # Ingresa si el usuario quiere imprimir un solo cupon buscando por nro.protocolo
        {
          return $this->query(
                              "
                               select id , date_format(`fecha`,'%Y%m') AS periodo
                               from protocolos 
                               where id = 
                               '".$nro_protocolo."' and obrasocial_id = 108 and internacion = 1;
                              "      
              );
        } else {
                    return $this->query(
                                        "
                                         select id , date_format(`fecha`,'%Y%m') AS periodo
                                         from protocolos 
                                         where date_format(`fecha`,'%Y%m%d') between 
                                         '".$fecha_ini."' and '".$fecha_fin."'  and obrasocial_id = 108 and internacion = 1;
                                        "      
                        );          
        }
    }  

    // Excel de rendicion
    public function query_reporte_5($filtro){ 

        return $this->query(
        "  
        select  
          a.id    AS protocolos,
          b.razon_social  AS Paciente,
          a.NUC     AS NUC,
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
        from 
           protocolos a inner join (pacientes b , sanatorios d)
                            on (a.paciente_id  = b.id and a.sanatorio_id = d.id)
        where a.obrasocial_id = 108
        and  a.internacion = 1  
        and  date_format(a.fecha,'%Y%m') = '".$filtro."'
        GROUP BY b.razon_social , a.NUC , a.id
        ORDER BY NUC asc;
       ");

    } 
        
}
?>

