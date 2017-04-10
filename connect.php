<?php
$server="localhost";
$database="pvmanager";
$dbpass="@ppdt";
$dbuser="root";
$link=mysql_connect($server,$dbuser,$dbpass);
mysql_select_db($database,$link);

/*$server="sql10.freemysqlhosting.net";
$database="sql10151059";
$dbpass="CZpI3qx4vN";
$dbuser="sql10151059";
$link=mysql_connect($server,$dbuser,$dbpass);
mysql_select_db($database,$link);*/

/*$server="mysql5006.smarterasp.net";
$database="db_a09b1f_pv";
$dbpass="@ppDT2016.";
$dbuser="a09b1f_pv";
$port = 3306;*/

$link=mysql_connect($server,$dbuser,$dbpass);
mysql_select_db($database,$link);


// we connect to example.com and port 3307
//$link = mysql_connect('mysql5006.smarterasp.net:3306', 'a09b1f_pv', '@ppDT2016.');
//mysql_select_db('db_a09b1f_pv',$link);
/*if (!$link) {
    die('Could not connect: ' . mysql_error());
}
echo 'Connected successfully';
mysql_close($link);*/

?>
