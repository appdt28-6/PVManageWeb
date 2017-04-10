<?php
include ('../connect.php');
date_default_timezone_set('mexico/general');
$f1=$_GET['f1'];
$f2=$_GET['f2'];
require('../fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();  
$pdf->SetFont('Arial','',12);
$pdf->Cell(4,1,'BIOGYM');
$pdf->Ln();
$pdf->Cell(40,10,'Reporte de asistencias.');
$pdf->Ln();
$pdf->cell(40,10,"DE: ".$f1);
$pdf->cell(40,10,"                  Hasta: ".$f2);
$pdf->Ln();
$pdf->Cell(4,10,'----------------------------------------------------------------------');
$pdf->Ln();
$pdf->Cell(40,10,'Numero.                Area.');
$pdf->Ln();


$query = "SELECT area as area,Count(area) as num from asistencias where fecha BETWEEN '$f1' AND '$f2' group by area";
$result = mysql_query($query);
while($row = mysql_fetch_array($result))
{
$pdf->Cell(4,1,$row['num']."      ".$row['area']);
$pdf->Ln();	
$pdf->Ln();	
$pdf->Ln();	
$pdf->Ln();	
}

$pdf->Output();
?>
