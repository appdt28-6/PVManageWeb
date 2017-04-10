<?php
include ('../connect.php');
$id=$_GET['id'];
date_default_timezone_set('mexico/general');
$fch1=date("Y-m-d")." 00:00:00";
$fch2=date("Y-m-d")." 23:59:59";
require('../fpdf.php');

$pdf =& new FPDF('P', 'mm', array(80, 297));
$pdf->AddPage();  
$pdf->SetFont('Arial','',8);
$pdf->Ln();
$pdf->Cell(4,1,'              BIOGYM GEOVILLAS');
$pdf->Ln();
$pdf->Cell(4,10,'   BLVD NUEVO HIDALGO 100 LOCAL3');
$pdf->Cell(4,20,'    FRACC. GEOVILLAS C.P. 42083');
$pdf->Cell(4,30,'       RFC: MOIS8601296W1');
$pdf->Ln();
$pdf->Cell(4,1,'                CORTE DE TURNO       ');
$pdf->cell(40,10, date("Y-m-d"));
$pdf->cell(40,10,date("H:i:s"));
$pdf->Ln();
$pdf->Cell(40,10,'Comprobante de corte de caja por:');
$pdf->Ln();
$query = "SELECT username FROM usuarios where idUsuario='$id' ";
$result = mysql_query($query);
while($row = mysql_fetch_array($result))
{
	$user=$row['username'];
//$pdf->Cell(4,1,'Vendedor: '.$row['username']);
}
mysql_free_result($result);
$pdf->Cell(4,1,'Vendedor: '.$user);
$pdf->Cell(4,10,'---------------------------------------------------------');
$pdf->Ln();
$pdf->Cell(40,10,'Fondo de caja');
$pdf->Ln();
$query2 = "SELECT inicaja FROM turno where fecha BETWEEN '$fch1' AND '$fch2' and id_usuario='$id' ";
										$result2 = mysql_query($query2);
										while($row = mysql_fetch_array($result2))
                                  		{
										$c=$row['inicaja'];
										}
mysql_free_result($result2);
$pdf->Cell(4,1,	$c);
$pdf->Cell(4,10,'---------------------------------------------------------');
$pdf->Ln();
$pdf->Cell(40,10,'           VENTAS POR DEPARTAMENTO');
$pdf->Ln();
$pdf->Cell(40,10,'  ID.  Producro  Cantidad.  Importe.');
$pdf->Ln();
$query3 = "select ventasticket.idProducto as id,productos.descripcion as nombre, SUM(ventasticket.cantidad) as cantidad,productos.precio as precio,SUM(ventasticket.importe) as importe from tickets inner join ventasticket on tickets.idTicket=ventasticket.idTicket inner join productos on ventasticket.idProducto=productos.idProducto where tickets.id_usuario='$id' and tickets.fecha BETWEEN '$fch1' AND '$fch2' group by ventasticket.idProducto
";
$result3 = mysql_query($query3);
while($row = mysql_fetch_array($result3))
{
$pdf->Cell(4,1,$row['id']."       ".$row['nombre']."| ".$row['cantidad']." | ".$row['importe'])."\n";
$pdf->Ln();	
$pdf->Ln();	
$pdf->Ln();	
$pdf->Ln();	
}
mysql_free_result($result3); 
$pdf->Cell(4,10,'----------------------------------------------------------------------');
$pdf->Ln();
///////
$pdf->Cell(40,10,'           TOTAL DE SALIDAS');
$pdf->Ln();
$pdf->Cell(40,10,'id_pago      Concepto            cantidad');
$pdf->Ln();
$query4 = "SELECT * FROM pagos where id_usuario='$id' and  fecha BETWEEN '$fch1' AND '$fch2' ";
$result4 = mysql_query($query4);
while($row = mysql_fetch_array($result4))
{
$pdf->Cell(4,1,$row['id_pago']."   |   ".$row['concepto']."        | ".$row['cantidad']). "    \n";
$pdf->Ln();	
$pdf->Ln();	
$pdf->Ln();	
$pdf->Ln();	
}
mysql_free_result($result4);

$query6 = "SELECT SUM(subtotal) as total FROM tickets where id_usuario='$id' and tpago=1 and fecha BETWEEN '$fch1' AND '$fch2'";
                                  $result6 = mysql_query($query6);
                                  while($row = mysql_fetch_array($result6)) 
                                  {
                                 $soldt=$row['total']; 
                                    }
mysql_free_result($result6);
$pdf->Cell(4,10,"Pagos con tarjeta: ".$soldt);
$pdf->Ln();
$pdf->Cell(4,10,'----------------------------------------------------------------------');
$pdf->Ln();
///////
$pdf->Cell(40,10,'           RESUMEN DE VENTAS');
$pdf->Ln();
//$pdf->Cell(40,10,'Total Vendido.  Total Pagado');
//$pdf->Ln();

$query5 = "SELECT SUM(subtotal) as total FROM tickets where id_usuario='$id' and tpago=0 and fecha BETWEEN '$fch1' AND '$fch2'";
                                  $result5 = mysql_query($query5);
                                  while($row = mysql_fetch_array($result5)) 
                                  {
                                 $sold=$row['total']; 
                                    }
mysql_free_result($result5);

$query7 = "SELECT SUM(cantidad) as total FROM pagos where id_usuario='$id' and fecha BETWEEN '$fch1' AND '$fch2'";
                                  $result7 = mysql_query($query7);
                                  while($row = mysql_fetch_array($result7))
                                  {
                                 $pay= $row['total']; 
                                    }
mysql_free_result($result7);
									
                                   
  
$pdf->Cell(4,10,'----------------------------------------------------------------------');
$pdf->Ln();
$pdf->Cell(40,10,'Total Efectivo.      Total Pagado.    Diferencia');
$pdf->Ln();
$pdf->Cell(4,10,'----------------------------------------------------------------------');
//mysql_free_result($result6);
mysql_close($link);
$resta=$sold-$pay;
$pdf->Cell(4,1,       $sold."      ||      ".$pay."      ||      ".$resta); 
$pdf->Cell(40,10,'    ----------------------------');
$pdf->Ln();
$pdf->Cell(40,10,'         Firma de enterado');
$pdf->Ln();
$pdf->Cell(40,10,'       ----------------------------');
                                   
$pdf->Output();
?>
