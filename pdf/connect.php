<?php
$server="localhost";
$database="pvmanager";
$dbpass="@ppdt";
$dbuser="root";
$link=mysql_connect($server,$dbuser,$dbpass);
mysql_select_db($database,$link);
?>