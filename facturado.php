<?php 
$ticket=$_GET['ticket'];
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
       <?php include 'menu.php'; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           Facturas
                            <small>Detallado de facturas solicitadas <?php date_default_timezone_set('mexico/general'); echo date("d-m-y"); ?></small>
                        </h1>

                           <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
							 <li class="active">
                                <i class="fa fa-file"></i><a href="ventas.php"> Ventas</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Facturas por enviar
                            </li>
                        </ol>
                        
                         <div class="col-lg-3 col-md-6">
                        
                    </div>
                    
      
                        
                        <div class="row">
						
                      
				<table class="table table-striped table-bordered">
		              <thead>
		                <tr>
                         <th>Id Factura</th>
		                  <th>Subtotal</th>
                          <th>IVA</th>
		                  <th>Total</th>
						  <th>Folio</th>
						  <th>Cliente</th>
						  <th>RFC</th>
						  <th>Calle</th>
						  <th>Colonia</th>
						  <th>Municipio</th>
						  <th>Estado</th>
						  <th>CP</th>
						  <th>Email</th>
		                </tr>
		              </thead>
		              <tbody>
		              <?php 
					   include 'database.php';
					  date_default_timezone_set('mexico/general');
                     $fch1=date("Y-m-d")." 00:00:00";
                     $fch2=date("Y-m-d")." 23:59:59";
					   $pdo = Database::connect();
					   $sql = "SELECT * FROM facturas inner join clientes on facturas.idCliente=clientes.idCliente where facturas.idTicket = '$ticket' ";
	 				   foreach ($pdo->query($sql) as $row) {
						   		echo '<tr>';
							   	echo '<td>'. $row['idFactura'] . '</td>';
								echo '<td>$'. $row['subtotal'] . '</td>';
								echo '<td>'. $row['iva'] . '</td>';
								echo '<td>'. $row['total'] . '</td>';
								echo '<td>'. $row['folio'] . '</td>';
								echo '<td>'. $row['razonSocial'] . '</td>';
								echo '<td>'. $row['rfc'] . '</td>';
								echo '<td>'. $row['calleYnumero'] . '</td>';
								echo '<td>'. $row['colonia'] . '</td>';
								echo '<td>'. $row['idMunicipio'] . '</td>';
								echo '<td>'. $row['idEstado'] . '</td>';
								echo '<td>'. $row['cp'] . '</td>';
								echo '<td>'. $row['correo'] . '</td>';
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
