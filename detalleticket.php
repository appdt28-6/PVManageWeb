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

        <?php include 'menu.php'; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           Detalles del Ticket
                            <small>Info de la venta</small>
                        </h1>

                         <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="ventas.php">Regresar</a>
                            </li>
                        </ol>
                        
                        <div class="row">
				
				
				<table class="table table-striped table-bordered">
		              <thead>
		                <tr>
                         <th>Producto</th>
		                  <th>Cantidad</th>
                          <th>Precio</th>
		                  <th>Importe</th>
                          <th>Accion</th>
		                </tr>
		              </thead>
		              <tbody>
		              <?php 
					   include 'database.php';
					   $pdo = Database::connect();
					   $ticket=$_GET['ticket'];
					   $sql = "SELECT ventasticket.idVenta as id,productos.nombre as nombre, ventasticket.cantidad as cantidad, ventasticket.presioUnitario as precio,ventasticket.importe as importe FROM ventasticket inner join productos on ventasticket.idProducto=productos.idProducto where ventasticket.idTicket='$ticket' ";
	 				   foreach ($pdo->query($sql) as $row) {
						   		echo '<tr>';
							   	echo '<td>'. $row['nombre'] . '</td>';
								echo '<td>'. $row['cantidad'] . '</td>';
								echo '<td>'. $row['precio'] . '</td>';
							   	echo '<td>'. $row['importe'] . '</td>';
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
					<a class="btn btn-danger" href="deleteticket.php?id=<?php echo $ticket; ?>">Cancelar ticket</a>
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
