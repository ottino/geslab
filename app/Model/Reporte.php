<?php

class Reporte extends AppModel{
    public $name = 'Reporte';
    public $useTable = false;

    public function query_practicas_x_totales(){
       
         return $this->query("
                                SELECT 
                                a.fecha,
                                d.descripcion  AS Sanatorio,
                                c.descripcion  AS Obra_Social,
                                b.razon_social AS Paciente,
                                b.dni          AS Paciente_dni,
                                a.id           AS Protocolo_id,
                                a.internacion,
                                a.ambulatorio,
                                a.NUC,
                                ifnull(a.practica150101,0) * ifnull(c.practica150101,0) AS Total_x_practica150101,
                                ifnull(a.practica150102,0) * ifnull(c.practica150102,0) AS Total_x_practica150102,
                                ifnull(a.practica150103,0) * ifnull(c.practica150103,0) AS Total_x_practica150103,
                                ifnull(a.practica150104,0) * ifnull(c.practica150104,0) AS Total_x_practica150104,
                                ifnull(a.practica150105,0) * ifnull(c.practica150105,0) AS Total_x_practica150105,
                                ifnull(a.practica150106,0) * ifnull(c.practica150106,0) AS Total_x_practica150106,
                                ifnull(a.practica150108,0) * ifnull(c.practica150108,0) AS Total_x_practica150108,
                                ifnull(a.practica150109,0) * ifnull(c.practica150109,0) AS Total_x_practica150109,
                                ifnull(a.practica150110,0) * ifnull(c.practica150110,0) AS Total_x_practica150110, 
                                ifnull(a.practica150111,0) * ifnull(c.practica150111,0) AS Total_x_practica150111,
                                ifnull(a.practica150120,0) * ifnull(c.practica150120,0) AS Total_x_practica150120, 
                                ifnull(a.practica150121,0) * ifnull(c.practica150121,0) AS Total_x_practica150121,
                                ifnull(a.practica144790,0) * ifnull(c.practica144790,0) AS Total_x_practica144790
                                FROM protocolos a   , pacientes b , 
                                     obrasociales c , sanatorios d
                                WHERE a.paciente_id   = b.id
                                AND   a.obrasocial_id = c.id
                                AND   a.sanatorio_id  = d.id 
                                and   a.id = 98765 
                                -- and   a.id LIMIT 1,10;
                                "
                            );       
   }     
}

?>

