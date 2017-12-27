<?php 
	
	require 'database.php';

	$codigo="Pago";
	$total=0;	
	$date1=date("Y-m-d")." 00:00:00";
	$date2=date("Y-m-d")." 23:59:59";
	
	//$date1="2017-12-09 00:00:00";
	//$date2="2017-12-09 23:59:59";
	
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$gettotal="Select SUM(subtotal) as Total from Tickets  where fecha BETWEEN '".$date1."' and '".$date2."' ";	
	 foreach ($pdo->query($gettotal) as $row)
	 {
		 if($row['Total']!=null)
		 {
			 $total=$row['Total']; 
		}
		else
		{
			$total=0;
		}
		
	}		
	$sql = "INSERT INTO pagos (concepto,importe) values(?,?)";
	$q = $pdo->prepare($sql);
	$q->execute(array($codigo, $total));
	Database::disconnect();
	require 'Mail.php';

$from = '<rabackuu@gmail.com>';
$to = '<oscargarcia18_2@hotmail.com>';
$subject = 'Total de ventas';
$body = "Total de cierre del dia ".date("Y-m-d").": $".$total;

$headers = array(
    'From' => $from,
    'To' => $to,
    'Subject' => $subject
);

$smtp = Mail::factory('smtp', array(
        'host' => 'ssl://smtp.gmail.com',
        'port' => '465',
        'auth' => true,
        'username' => 'rabackuu@gmail.com',
        'password' => 'mike007.'
    ));

$mail = $smtp->send($to, $headers, $body);

if (PEAR::isError($mail)) {
    echo('<p>' . $mail->getMessage() . '</p>');
} else {
    echo('<p>Message successfully sent!</p>');
}
	$total=0;	
?>