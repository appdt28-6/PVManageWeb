<?php 
	
	require 'database.php';

	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	
	if ( null==$id ) {
		header("Location: productos.php");
	}
	
	if ( !empty($_POST)) {
		// keep track validation errors
		$codigoerror = null;
		$nombreError=null;
		$precioError = null;
		$descError = null;
		
		// keep track post values
		$codigo = $_POST['codigo'];
		$nombre=$_POST['nombre'];
		$precio = $_POST['precio'];
		$desc = $_POST['desc'];
		
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
		
		if (empty($precio)) {
			$precioError = 'Please enter precio';
			$valid = false;
		}
		
		if (empty($desc)) {
			$descError = 'Please enter descripcion';
			$valid = false;
		}
		// update data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE productos  set codigoBarras = ?, nombre =?,precio =?,descripcion = ? WHERE idProducto = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($codigo,$nombre,$precio,$desc,$id));
			Database::disconnect();
			header("Location: productos.php");
		}
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM productos where idProducto = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$codigo = $data['codigoBarras'];
		$nombre=$data['nombre'];
		$precio = $data['precio'];
		$desc = $data['descripcion'];
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
		    			<h3>Update a Customer</h3>
		    		</div>
    		
	    			<form class="form-horizontal" action="update.php?id=<?php echo $id?>" method="post">
					  <div class="control-group <?php echo !empty($codigoerror)?'error':'';?>">
					    <label class="control-label">Codigo</label>
					    <div class="controls">
					      	<input name="codigo" type="text"  placeholder="Codigo" value="<?php echo !empty($codigo)?$codigo:'';?>">
					      	<?php if (!empty($codigoError)): ?>
					      		<span class="help-inline"><?php echo $codigoError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					 <div class="control-group <?php echo !empty($nombreError)?'error':'';?>">
					    <label class="control-label">Descripcion</label>
					    <div class="controls">
					      	<input name="nombre" type="text" placeholder="Nombre" value="<?php echo !empty($nombre)?$nombre:'';?>">
					      	<?php if (!empty($descError)): ?>
					      		<span class="help-inline"><?php echo $nombreError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($descError)?'error':'';?>">
					    <label class="control-label">Descripcion</label>
					    <div class="controls">
					      	<input name="desc" type="text" placeholder="Descripcion" value="<?php echo !empty($desc)?$desc:'';?>">
					      	<?php if (!empty($descError)): ?>
					      		<span class="help-inline"><?php echo $descError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($descError)?'error':'';?>">
					    <label class="control-label">Precio</label>
					    <div class="controls">
					      	<input name="precio" type="text"  placeholder="Precio" value="<?php echo !empty($precio)?$precio:'';?>">
					      	<?php if (!empty($descError)): ?>
					      		<span class="help-inline"><?php echo $descError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Update</button>
						  <a class="btn" href="productos.php">Back</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>