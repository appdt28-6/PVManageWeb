

<?php 
	
	require 'database.php';

	if ( !empty($_POST)) {
		// keep track validation errors
		$sublineaError = null;
				
		// keep track post values
		$linea = $_POST['linea'];
		$sublinea = $_POST['sublinea'];
				
		// validate input
		$valid = true;
		
		if (empty($sublinea)) {
			$sublineaError = 'Please enter Linea';
			$valid = false;
		}
				
		// insert data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO sublineas (idLinea,descripcion) values(?,?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($linea,$sublinea));
			Database::disconnect();
			header("Location: sublineas.php");
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
                           Sublineas
                            
                        </h1>

                           <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Restaurant
                            </li>
                        </ol>
                        
                        
     <div class="row">
	    			<form class="form-horizontal" action="createsubline.php" method="post">
					  <div class="control-group">
					    <label class="control-label">Linea</label>
					    <div class="controls">
					      	<select name="linea">
							<?php 
							 include('connect.php');
									
                                    date_default_timezone_set('mexico/general');
                                    $fch1=date("Y-m-d")." 00:00:00";
                                    $fch2=date("Y-m-d")." 23:59:59";
                                  $query = "SELECT * FROM lineas";
                                  $result = mysql_query($query);
                                  while($row = mysql_fetch_array($result))
                                  {
									  echo "<option value=".$row['idLinea'].">".$row['descripcion']."</option>";
								  }
								   mysql_free_result($result);
                                    mysql_close($link);
							
							?>
							  
							</select>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($sublinea)?'error':'';?>">
					    <label class="control-label">Sublinea</label>
					    <div class="controls">
					      	<input type="text" name="sublinea" placeholder="Nombre" value="<?php echo !empty($sublinea)?$sublinea:'';?>">
					      	<?php if (!empty($sublineaError)): ?>
					      		<span class="help-inline"><?php echo $sublineaError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
                      <p></p>
					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Crear</button>
						  <a class="btn" href="sublineas.php">Regresar</a>
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