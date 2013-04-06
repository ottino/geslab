<?php
require('fpdf.php');

class PDF_header extends FPDF {
    
    var $logo;
    var $Comp_ProtocoloNro;
    var $Comp_Fecha;
    var $Comp_Paciente;
    var $Comp_Edad;
    var $Comp_Medico;
    var $Comp_Organo;
    
    function put_header($p_logo , $p_Comp_ProtocoloNro ,$p_Comp_Fecha ,$p_Comp_Paciente,
                        $p_Comp_Edad ,$p_Comp_Medico, $p_Comp_Organo)
    {
         $this->logo              = $p_logo;
         $this->Comp_ProtocoloNro = $p_Comp_ProtocoloNro;
         $this->Comp_Fecha        = $p_Comp_Fecha;
         $this->Comp_Paciente     = $p_Comp_Paciente ;
         $this->Comp_Edad         = $p_Comp_Edad;
         $this->Comp_Medico       = $p_Comp_Medico;
         $this->Comp_Organo       = $p_Comp_Organo;               
    }
    
    function Header()
    {

            if ($this->logo == 1)
            { 
                   /* Logo del comprobante */
                   $this->SetFont('Arial','',22);
                   $this->SetY(0.55);
                   $this->SetX(0.5);
                   $this->Cell(3.5,0.22,'SILVIA VIALE' );

                   $this->SetFont('Arial','',35);
                   $this->SetY(0.6);
                   $this->SetX(5.5);
                   $this->Cell(3.5,0.22,'| LAP' );

                   $this->SetFont('Arial','',8);
                   $this->SetY(1.5);
                   $this->SetX(6);
                   $this->Cell(3.5,0.22,utf8_decode('Laboratorio de Anatomía Patológica y Citologia') );  

                   /* Datos del encabezado */
                   $this->SetFont('Arial','',11);
                   $this->SetXY(15.5,0.5);
                   $this->Cell(3.5,0.22,'Dra. Silvia I. Viale .'); 

                   $this->SetFont('Arial','',11);
                   $this->SetXY(16.1,0.9);
                   $this->Cell(3.5,0.22,'Mat.: 6939 .'); 

                   $this->SetFont('Arial','',11);
                   $this->SetXY(15.3,1.3);
                   $this->Cell(3.5,0.22,utf8_decode('Anotomía patológica.')); 

                   $this->SetFont('Arial','',11);
                   $this->SetXY(15.1,1.7);
                   $this->Cell(3.5,0.22,utf8_decode('Santiago del estero 42.')); 

                   $this->SetFont('Arial','',11);
                   $this->SetXY(13.9,2.1);
                   $this->Cell(3.5,0.22,utf8_decode('tel.:(0343)4217060 Paraná - Entre Ríos')); 
            }
            
            /* Primer linea */
            $this->Line(0, 2.700 , 21, 2.700);
            $this->Line(0, 2.701 , 21, 2.701);
            $this->Line(0, 2.702 , 21, 2.702);
            $this->Line(0, 2.703 , 21, 2.703);
            $this->Line(0, 2.704 , 21, 2.704);
            
            /* Datos generales sobre el protocolo */
            $this->SetFont('Arial','B',10);
            $this->SetXY(0.20,4);
            $this->Cell(3.5,0.22,'Protocolo Nro:    ' . $this->Comp_ProtocoloNro );

            $this->SetFont('Arial','B',10);
            $this->SetXY(16,4);
            $this->Cell(3.5,0.22,'Fecha:    ' . $this->Comp_Fecha);

            $this->SetFont('Arial','B',10);
            $this->SetXY(0.20,5.0);
            $this->Cell(3.5,0.22,'Paciente:    ' . utf8_decode($this->Comp_Paciente) );

            $this->SetFont('Arial','B',10);
            $this->SetXY(16,5.0);
            $this->Cell(3.5,0.22,'Edad:    ' . $this->Comp_Edad );

            $this->SetFont('Arial','B',10);
            $this->SetXY(0.20,6);
            $this->Cell(3.5,0.22,'Medico:    ' . utf8_decode($this->Comp_Medico) );

            $this->SetFont('Arial','B',10);
            $this->SetXY(0.20,7.0);
            $this->Cell(3.5,0.22,'Material Remitido:    ' . utf8_decode($this->Comp_Organo) );

            /* Segunda linea */
            $this->Line(0, 8.01 , 21, 8.01);
            $this->Line(0, 8.02 , 21, 8.02);
            $this->Line(0, 8.03 , 21, 8.03);
            $this->Line(0, 8.04 , 21, 8.04);
            $this->Line(0, 8.05 , 21, 8.05);
            $this->Line(0, 8.06 , 21, 8.06);

            $this->SetY(8.06);

    }
}
?>

