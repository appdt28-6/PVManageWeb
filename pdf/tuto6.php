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
$pdf->Cell(40,10,'Reporte Socios inscritos.');
$pdf->Ln();
$pdf->cell(40,10,"DE: ".$f1);
$pdf->cell(40,10,"              Hasta: ".$f2);
$pdf->Ln();
$pdf->Cell(4,10,'----------------------------------------------------------------------');
$pdf->Ln();
$pdf->Cell(40,10,'ID                                Socios.                              Area.                           Fecha. ');
$pdf->Ln();


$query = "SELECT acceso.id_socio as id,socios.nombre as nombre ,socios.ap as ap, socios.membresia as area, acceso.ultimopago as fecha FROM acceso inner join socios on acceso.id_socio=socios.id_socio where acceso.ultimopago BETWEEN '$f1' AND '$f2' ";
$result = mysql_query($query);
while($row = mysql_fetch_array($result))
{
	if($row['area']==""){
		$no="NO ESPECIFICADA";
		}else
		$no=$row['area'];
		
$pdf->Cell(4,1,$row['id']."|               ".$row['nombre']." ".$row['ap']."|          ".$no."|       ".$row['fecha'])."\n";
$pdf->Ln();	
$pdf->Ln();	
$pdf->Ln();	
$pdf->Ln();	
$pdf->Ln();	
$pdf->Ln();	
}

$pdf->Output();
?>

