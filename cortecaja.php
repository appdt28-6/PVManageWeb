<?php 
	
	require 'database.php';

	if ( !empty($_POST)) {
		// keep track validation errors
			
		// keep track post values
		 $venta=$_POST['venta'];
		$salida=$_POST['salida'];
				
		// validate input
		$valid = true;
		
		// insert data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO corte (venta,salida) values(?,?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($venta,$salida));
			Database::disconnect();
			header("Location: reg_corte.php");
		}
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ES-Manager</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Restaurant Espiritu Santo</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
               
               
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Admin <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-power-off"></i> Salir</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                   <li>
                        <a href="index.php"><i class="fa fa-fw fa-dashboard"></i>Panel</a>
                    </li>
                    <li>
                        <a href="ventas.php"><i class="fa fa-fw fa-usd"></i>Ventas</a>
                    </li>
                    <li>
                        <a href="pagos.php"><i class="fa fa-fw fa-arrow-circle-o-down"></i>Pagos</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i>Menu Restaurant <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="productos.php">Productos</a>
                            </li>
                            <li>
                                <a href="lineas.php">Lineas</a>
                            </li>
                            <li>
                                <a href="sublineas.php">Sub lineas</a>
                            </li>
                        </ul>
                    </li>
                   
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           Ventas
                            <small>Detallado de ventas <?php date_default_timezone_set('mexico/general'); echo date("d-m-y"); ?></small>
                        </h1>
                        
                         <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-usd fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                          <?php 
                                 include('connect.php');
									
                                    date_default_timezone_set('mexico/general');
                                    $fch1=date("Y-m-d")." 00:00:00";
                                    $fch2=date("Y-m-d")." 23:59:59";
                                  $query = "SELECT SUM(subtotal) as total FROM tickets where fecha BETWEEN '$fch1' AND '$fch2' ";
                                  $result = mysql_query($query);
                                  while($row = mysql_fetch_array($result))
                                  {
                                    echo "<div class=\"huge\">$",$row['total'],"</div>"; 
                                    }
                                     mysql_free_result($result);
                                    mysql_close($link);
									
                                    ?>
                                        <div>Total de ventas</div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    
     
                        
                        <div class="row">
						
                   <form role="form" action="cortecaja.php" method="post">                     
                                        <div class="form-group">
                                        <label>Total de Ventas efectivo</label>
                                        <?php
                                        include ('connect.php');
date_default_timezone_set('mexico/general');
$fch1=date("Y-m-d")." 00:00:00";
$fch2=date("Y-m-d")." 23:59:59";
                                    $query = "SELECT SUM(subtotal) as total FROM tickets where fecha BETWEEN '$fch1' AND '$fch2'";
                                  $result = mysql_query($query);
                                  while($row = mysql_fetch_array($result))
                                  {
									  ?>
            <input class="form-control" type="text" name="venta" value="<?php echo $row['total'];?>" readonly>
                                
                                 <?php }
                                        mysql_free_result($result);
                                    mysql_close($link);

                                        ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Total de Salidas en efectivo</label>
                                             <?php
                                        include ('connect.php');
                                         date_default_timezone_set('mexico/general');
                                    $fch1=date("Y-m-d")." 00:00:00";
                                    $fch2=date("Y-m-d")." 23:59:59";
                                    $query2 = "SELECT SUM(importe) as total FROM pagos where fecha BETWEEN '$fch1' AND '$fch2'";
                                  $result2 = mysql_query($query2);
                                  while($row2 = mysql_fetch_array($result2))
                                  {
	  ?>
            <input class="form-control" type="text" name="salida" value="<?php echo $row2['total'];?>" readonly>
                                
                                 <?php 
                                
                                  }
                                        mysql_free_result($result2);
                                    mysql_close($link);

                                        ?>
                                          
                                        </div>
                                       
                                        <button type="submit" class="btn btn-default">Realizar corte</button>
                                        <!--<button type="reset" class="btn btn-default">Reset Button</button>-->
                                    </form>
			
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
