<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PVManager-Panel de control</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

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

     <?php include 'menu.php'; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Corte de caja  <small>Detallado de caja <?php date_default_timezone_set('mexico/general'); echo date("d-m-y"); ?></small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i>Información
                            </li>
                        </ol>
						
                    </div>
                </div>
                <!-- /.row -->
				<div class="row">
						
                      
				<table class="table table-striped table-bordered">
		              <thead>
		                <tr>
                          <th>Ventas</th>
		                  <th>Salidas</th>
		                </tr>
		              </thead>
		              <tbody>
		              <?php 
					   include 'database.php';
					  date_default_timezone_set('mexico/general');
                     $fch1=date("Y-m-d")." 00:00:00";
                     $fch2=date("Y-m-d")." 23:59:59";
					   $pdo = Database::connect();
					   $sql = "SELECT SUM(venta) as venta,SUM(salida) as salida FROM corte where fecha BETWEEN '$fch1' AND '$fch2' ";
	 				   foreach ($pdo->query($sql) as $row) {
						   		echo '<tr>';
								echo '<td>$ '. $row['venta'] . '</td>';
								echo '<td>$ '. $row['salida'] . '</td>';
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
				
				<div class="row">
						Detallado de corte de caja del dia
                      
				<table class="table table-striped table-bordered">
		              <thead>
		                <tr>
						<th>Id Corte</th>
						<th>Fecha</th>
                          <th>Ventas</th>
		                  <th>Salidas</th>
		                </tr>
		              </thead>
		              <tbody>
		              <?php 
					  
					  date_default_timezone_set('mexico/general');
                     $fch1=date("Y-m-d")." 00:00:00";
                     $fch2=date("Y-m-d")." 23:59:59";
					   $pdo = Database::connect();
					   $sql = "SELECT * FROM corte where fecha BETWEEN '$fch1' AND '$fch2' ";
	 				   foreach ($pdo->query($sql) as $row) {
						   		echo '<tr>';
								echo '<td>'. $row['idCorte'] . '</td>';
								echo '<td>'. $row['fecha'] . '</td>';
								echo '<td>$ '. $row['venta'] . '</td>';
								echo '<td>$ '. $row['salida'] . '</td>';
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

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>

</body>

</html>
