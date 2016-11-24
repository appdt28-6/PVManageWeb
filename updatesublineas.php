<?php 
	
	require 'database.php';

	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	
	if ( null==$id ) {
		header("Location: lineas.php");
	}
	
	if ( !empty($_POST)) {
		// keep track validation errors
		$lineaError = null;
				
		// keep track post values
		$linea = $_POST['linea'];
		
		// validate input
		$valid = true;
		if (empty($linea)) {
			$lineaError = 'Please enter SubLinea';
			$valid = false;
		}
		
		// update data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE lineas  set descripcion = ? WHERE idLinea = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($linea,$id));
			Database::disconnect();
			header("Location: lineas.php");
		}
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM sublineas where idSublinea = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$linea = $data['descripcion'];
		Database::disconnect();
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
    
    			<div class="span10 offset1">
    				<div class="row">
		    			<h3>Update a Sublineas</h3>
		    		</div>
    		
	    			<form class="form-horizontal" action="updatesublinea.php?id=<?php echo $id?>" method="post">
					  <div class="control-group <?php echo !empty($lineaError)?'error':'';?>">
					    <label class="control-label">Nombre</label>
					    <div class="controls">
					      	<input name="linea" type="text"  placeholder="Nombre" value="<?php echo !empty($linea)?$linea:'';?>">
					      	<?php if (!empty($codigoError)): ?>
					      		<span class="help-inline"><?php echo $lineaError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Update</button>
						  <a class="btn" href="sublineas.php">Back</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>