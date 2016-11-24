<?php 
	
	require 'database.php';

	if ( !empty($_POST)) {
		// keep track validation errors
		$codigoerror = null;
		$nombreError=null;
		
		// keep track post values
		$codigo = $_POST['codigo'];
		$nombre=$_POST['nombre'];
		
		// validate input
		$valid = true;
		if (empty($codigo)) {
			$codigoError = 'Please enter Codigo';
			$valid = false;
		}
		if (empty($nombre)) {
			$nombrError = 'Please enter Name';
			$valid = false;
		}
		
		// insert data
		if ($valid) {
			$sl=$_POST['tipo'];
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO pagos (concepto,importe) values(?,?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($codigo,$nombre));
			Database::disconnect();
			header("Location: pagos.php");
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
       <?php include 'menu.php'; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           Pagos
                            <small>Salida de efectivo </small>
                        </h1>

                           <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Pagos</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Generar Pago
                            </li>
                        </ol>
                        
                        
     <div class="row">
			<form class="form-horizontal" action="createpay.php" method="post">
					  <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
					    <label class="control-label">Concepto</label>
					    <div class="controls">
					      	<input name="codigo" type="text"  placeholder="Concepto" value="<?php echo !empty($codigo)?$codigo:'';?>">
					      	<?php if (!empty($codigoError)): ?>
					      		<span class="help-inline"><?php echo $codigoError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
                       <div class="control-group <?php echo !empty($nombreError)?'error':'';?>">
					    <label class="control-label">Importe</label>
					    <div class="controls">
					      	<input name="nombre" type="text" placeholder="Importe" value="<?php echo !empty($nombre)?$nombre:'';?>">
					      	<?php if (!empty($descError)): ?>
					      		<span class="help-inline"><?php echo $nombreError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  
					 
                      <p></p>
					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Crear</button>
						  <a class="btn" href="pagos.php">Regresar</a>
						</div>
					</form>			
                      
				
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