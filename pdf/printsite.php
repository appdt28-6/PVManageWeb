<?php
include ('connect.php');
$site=$_GET['idsite'];
date_default_timezone_set('mexico/general');
$fch1=date("Y-m-d")." 00:00:00";
$fch2=date("Y-m-d")." 23:59:59";
require('../fpdf.php');

$pdf =& new FPDF('P', 'mm', array(80, 150));
$pdf->AddPage();  
$pdf->SetFont('Arial','B',8);
$pdf->Cell(4,1,'BIOGYM');
$pdf->Cell(4,10,'BLVD NUEVO HIDALGO 100 LOCAL3');
$pdf->Cell(4,20,'FRACC GEOVILLAS C.P. 42083'); 
$pdf->Ln();
$pdf->cell(40,10,date("Y-m-d"));
$pdf->cell(40,10,date("H:i:s"));
$pdf->Ln();
$pdf->Cell(40,10,'Clase Zumba');
$pdf->Ln();
$pdf->Cell(40,10,'Comprobante de lugar');
$pdf->Ln();
$pdf->Cell(40,10,'Nombre de Socio:');
$pdf->Ln();
$pdf->Cell(40,10,'Lugar:'.$site);
$pdf->Ln();
$pdf->Cell(40,10,'Gracias por tu preferencia');
$pdf->Output();
?>
