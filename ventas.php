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
       <?php include 'menu.php'; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           Ventas
                            <small>Detallado de ventas <?php date_default_timezone_set('mexico/general'); echo date("d-m-y"); ?></small>
                        </h1>

                           <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Ventas
                            </li>
                        </ol>
                        
                         <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-bar-chart-o fa-5x"></i>
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
                                    echo "<div class=\"huge\">",$row['total'],"</div>"; 
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
                    
       <a class="btn btn-danger" href="cortecaja.php">Realizar corte</a>	
       <p></p>	
                        
                        <div class="row">
						
                      
				<table class="table table-striped table-bordered">
		              <thead>
		                <tr>
                         <th>Ticket</th>
		                  <th>Importe</th>
                          <th>Solicito Factura</th>
		                  <th>Accion</th>
		                </tr>
		              </thead>
		              <tbody>
		              <?php 
					   include 'database.php';
					  date_default_timezone_set('mexico/general');
                     $fch1=date("Y-m-d")." 00:00:00";
                     $fch2=date("Y-m-d")." 23:59:59";
					   $pdo = Database::connect();
					   $sql = "SELECT * FROM tickets where fecha BETWEEN '$fch1' AND '$fch2' ";
	 				   foreach ($pdo->query($sql) as $row) {
						   		echo '<tr>';
							   	echo '<td>'. $row['idTicket'] . '</td>';
								echo '<td>$'. $row['subtotal'] . '</td>';
								echo '<td>'. $row['facturado'] . '</td>';
							   	echo '<td width=250>';
							   	
							   	echo '<a class="btn btn-success" href="detalleticket.php?ticket='.$row['idTicket'].'">Ver detalles</a>';						   
							   	if($row['facturado']=="Si"){echo '<a class="btn btn-warning" href="facturado.php?ticket='.$row['idTicket'].'">Datos a facturar</a>';}
								
								echo '</td>';
							   	echo '</tr>';
					   }
					   Database::disconnect();
					  ?>
				      </tbody>
	            </table>
    	</div>
                        
                     
                    </div>
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
