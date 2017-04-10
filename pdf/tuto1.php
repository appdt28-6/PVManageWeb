<?php
include ('connect.php');
date_default_timezone_set('mexico/general');
$fch1=date("Y-m-d")." 00:00:00";
$fch2=date("Y-m-d")." 23:59:59";
require('fpdf.php');

$pdf =& new FPDF('P', 'mm', array(80, 297));
$pdf->AddPage();  
$pdf->SetFont('Arial','',8);
$pdf->Cell(4,1,'              Buffet Espiritu Santo');
$pdf->Ln();
//$pdf->Cell(4,10,'BLVD NUEVO HIDALGO 100 LOCAL3');
//$pdf->Cell(4,20,'FRACC GEOVILLAS C.P. 42083'); 
$pdf->Ln();
$pdf->cell(40,10,date("Y-m-d"));
$pdf->cell(40,10,date("H:i:s"));
$pdf->Ln();
$pdf->Cell(40,10,'Comprobante de corte de caja');
$pdf->Ln();
$pdf->Cell(4,10,'----------------------------------------------------------------------');
$pdf->Ln();
$pdf->Cell(40,10,'Resp.  Ventas.  Salidas.      Fecha.');
$pdf->Ln();


$query = "SELECT * FROM corte where fecha BETWEEN '$fch1' AND '$fch2' ";
$result = mysql_query($query);
while($row = mysql_fetch_array($result))
{
$pdf->Cell(4,1,$row['idCorte']."        | ".$row['venta']."     | ".$row['salida']."  |".$row['fecha'])."\n";
$pdf->Ln();	
$pdf->Ln();	
$pdf->Ln();	
$pdf->Ln();	
}

$pdf->Cell(40,10,'           VENTAS POR CONCEPTO');
$pdf->Ln();
$pdf->Cell(40,10,'  tckt.  Venta  Prod.  Desc.  Cant.  Imp.');
$pdf->Ln();
$query6 = "SELECT tickets.idTicket as ticket,ventasticket.idVenta as venta,ventasticket.idProducto as producto,productos.descripcion as descripcion,ventasticket.cantidad as cantidad,ventasticket.importe as importe FROM `tickets` inner join `ventasticket` on tickets.idTicket=ventasticket.idTicket inner join productos on ventasticket.idProducto=productos.idProducto where tickets.fecha BETWEEN '$fch1' AND '$fch2' ";
$result6 = mysql_query($query6);
while($row6 = mysql_fetch_array($result6))
{
$pdf->Cell(4,1,$row6['ticket']."       ".$row6['venta']."    | ".$row6['producto']."    | ".$row6['descripcion']."   | ".$row6['cantidad']."      |".$row6['importe'])."\n";
$pdf->Ln();	
$pdf->Ln();	
$pdf->Ln();	
$pdf->Ln();	
} 
$pdf->Cell(40,10,'           TOTAL DE SALIDAS');
$pdf->Ln();
$pdf->Cell(40,10,'id_pago        concepto           cantidad');
$pdf->Ln();
$query7 = "SELECT * FROM pagos where fecha BETWEEN '$fch1' AND '$fch2' ";
$result7 = mysql_query($query7);
while($row = mysql_fetch_array($result7))
{
$pdf->Cell(4,1,$row['idPago']."     |".$row['concepto']."         | ".$row['importe']). "    \n";
$pdf->Ln();	
$pdf->Ln();	
$pdf->Ln();	
$pdf->Ln();	
}

                        
$pdf->Cell(4,10,'----------------------------------------------------------------------');
$pdf->Ln();
$pdf->Cell(40,10,'Total Vendido.  Total Pagado       Diferencia');
$pdf->Ln();

$query2 = "SELECT SUM(subtotal) as total FROM tickets where fecha BETWEEN '$fch1' AND '$fch2'";
                                  $result2 = mysql_query($query2);
                                  while($row2 = mysql_fetch_array($result2))
                                  {
                                 $sold=$row2['total']; 
                                    }
$query3 = "SELECT SUM(importe) as total FROM pagos where fecha BETWEEN '$fch1' AND '$fch2'";
                                  $result3 = mysql_query($query3);
                                  while($row3 = mysql_fetch_array($result3))
                                  {
                                 $pay= $row3['total']; 
                                    }
                                     mysql_free_result($result3);
                                    mysql_close($link);
									$resta=$sold-$pay;

$pdf->Cell(4,1,$sold."                ||    ".$pay."                ||   ".$resta);    
$pdf->Cell(40,10,'----------------------------');

$pdf->Ln();
$pdf->Cell(40,10,'Firma de enterado');
$pdf->Ln();
$pdf->Cell(40,10,'----------------------------');


                                   
$pdf->Output();
?>
