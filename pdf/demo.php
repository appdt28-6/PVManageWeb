<?php

require('../fpdf.php');

$pdf->AddPage();

//$tplIdx = $pdf->importPage(1);
//$pdf->useTemplate($tplIdx);
$pdf->SetFont('Arial','',10);
$pdf->Write (7,"Comprobante de Registro de Garantia Kredell");
$pdf->Ln();
		$pdf->Write (7,"Garantia registrado a Nombre:");
		$pdf->Write (7,$_GET['nom']);
		$pdf->Ln(); //salto de linea
		$pdf->Write (7,"Con direccion:");
		$pdf->Cell(60,7,$_GET['dir']);
		$pdf->Ln(); //salto de linea
		$pdf->Write (7,"Telefono:");
		$pdf->Cell(60,7,$_GET['tel']);
		$pdf->Ln(); //salto de linea
		$pdf->Write (7,"Email:");
		$pdf->Cell(60,7,$_GET['email']);
		$pdf->Ln(); //salto de linea
		$pdf->Write (7,"Modelo de Calentador:");
		$pdf->Cell(60,7,$_GET['modelo']);
		$pdf->Ln(); //salto de linea
		$pdf->Write (7,"Serie de Calentador:");
		$pdf->Cell(60,7,$_GET['serie']);
		$pdf->Ln(); //salto de linea
		$pdf->SetTextColor('255','0','0');//para imprimir en rojo 
		$pdf->Multicell(60,7,$_GET['fcha']."\n Fecha de Registro",1,'R');
		$pdf->Ln(); //salto de linea
		$pdf->Cell(60,7,"Para que su garantia sea efectiva.Debe de solicitar un MANTENIMINETO PREVENTIVO anual.");
		$pdf->Ln(); //salto de linea
		$pdf->Write (7,"Mas informacion en http://kredell.com.mx/kredel/servtec.php");
$pdf->Output();

?>