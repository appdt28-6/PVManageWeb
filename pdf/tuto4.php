<?php
include ('../connect.php');
$id=$_GET['id'];
date_default_timezone_set('mexico/general');
$fch1=date("Y-m-d")." 00:00:00";
$fch2=date("Y-m-d")." 23:59:59";
require('../fpdf.php');

$pdf =& new FPDF('P', 'mm', array(80, 150));
$pdf->AddPage();  
$pdf->SetFont('Arial','B',8);
$pdf->Cell(4,1,'   BIOGYM GEOVILLAS');
$pdf->Cell(4,10,'BLVD NUEVO HIDALGO 100 LOCAL3');
$pdf->Cell(4,20,'  FRACC GEOVILLAS C.P. 42083'); 
$pdf->Cell(4,1,'       RFC: MOIS8601296W1');
$pdf->Ln();
$pdf->Cell(4,1,'                CORTE DE TURNO       ');
$pdf->cell(40,10, date("Y-m-d"));
$pdf->cell(40,10,date("H:i:s"));
$pdf->Ln();
$pdf->Cell(40,10,'Comprobante de corte de caja');
$pdf->Ln();
$pdf->Cell(4,10,'----------------------------------------------------------------------');
$pdf->Ln();
$pdf->Cell(40,10,'ticket           subtotal');
$pdf->Ln();


$query = "SELECT * FROM tickets where id_usuario='$id' and  fecha BETWEEN '$fch1' AND '$fch2' ";
$result = mysql_query($query);
while($row = mysql_fetch_array($result))
{
$pdf->Cell(4,1,$row['idTicket']."        | ".$row['subtotal'])."\n";
$pdf->Ln();	
$pdf->Ln();	
$pdf->Ln();	
$pdf->Ln();	
}
                        
$pdf->Cell(4,10,'----------------------------------------------------------------------');
$pdf->Ln();
///////
$pdf->Ln();
$pdf->Cell(40,10,'id_pago           cantidad');
$pdf->Ln();
$query = "SELECT * FROM pagos where id_usuario='$id' and  fecha BETWEEN '$fch1' AND '$fch2' ";
$result = mysql_query($query);
while($row = mysql_fetch_array($result))
{
$pdf->Cell(4,1,$row['id_pago']."        | ".$row['cantidad']). "    \n";
$pdf->Ln();	
$pdf->Ln();	
$pdf->Ln();	
$pdf->Ln();	
}


$pdf->Cell(4,10,'----------------------------------------------------------------------');
$pdf->Ln();
///////

$pdf->Cell(40,10,'Total Vendido.  Total Pagado');
$pdf->Ln();

$query2 = "SELECT SUM(subtotal) as total FROM tickets where id_usuario='$id' and fecha BETWEEN '$fch1' AND '$fch2'";
                                  $result2 = mysql_query($query2);
                                  while($row2 = mysql_fetch_array($result2)) 
                                  {
                                 $sold=$row2['total']; 
                                    }
$query3 = "SELECT SUM(cantidad) as total FROM pagos where id_usuario='$id' and fecha BETWEEN '$fch1' AND '$fch2'";
                                  $result3 = mysql_query($query3);
                                  while($row3 = mysql_fetch_array($result3))
                                  {
                                 $pay= $row3['total']; 
                                    }
                                     mysql_free_result($result3);
                                    mysql_close($link);

$pdf->Cell(4,1,$sold."                ||    ".$pay);    
$pdf->Cell(40,10,'----------------------------');
$pdf->Ln();
$pdf->Cell(40,10,'Firma de enterado');
$pdf->Ln();
$pdf->Cell(40,10,'----------------------------');
                                   
$pdf->Output();
?>
