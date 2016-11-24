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
                            Panel <small> de control <?php date_default_timezone_set('mexico/general'); echo date("d-m-y"); ?></small>
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
                    <div class="col-lg-12">
                        <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <!--<i class="fa fa-info-circle"></i>  <strong>Like SB Admin?</strong> Try out <a href="http://startbootstrap.com/template-overviews/sb-admin-2" class="alert-link">SB Admin 2</a> for additional features!-->
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
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
                                  $query = "SELECT SUM(ventasticket.cantidad) as total FROM tickets inner join ventasticket on tickets.idTicket=ventasticket.idTicket where tickets.fecha BETWEEN '$fch1' AND '$fch2' and ventasticket.idProducto=1 ";
                                  $result = mysql_query($query);
                                  while($row = mysql_fetch_array($result))
                                  {
                                    echo "<div class=\"huge\">",$row['total'],"</div>"; 
                                    }
                                     mysql_free_result($result);
                                    mysql_close($link);
									
                                    ?>
                                        <div>Comidas Vendidas</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left"><a href="ventas.php">Ver detalles</a></span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-tasks fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                          <?php 
                                 include('connect.php');
									
                                    date_default_timezone_set('mexico/general');
                                    $fch1=date("Y-m-d")." 00:00:00";
                                    $fch2=date("Y-m-d")." 23:59:59";
                                  $query = "SELECT SUM(ventasticket.cantidad) as total FROM tickets inner join ventasticket on tickets.idTicket=ventasticket.idTicket where tickets.fecha BETWEEN '$fch1' AND '$fch2' and ventasticket.idProducto=2 ";
                                  $result = mysql_query($query);
                                  while($row = mysql_fetch_array($result))
                                  {
                                    echo "<div class=\"huge\">",$row['total'],"</div>"; 
                                    }
                                     mysql_free_result($result);
                                    mysql_close($link);
									
                                    ?>
                                        <div>Bufets vendidos</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">Ver detalles</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-shopping-cart fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                         <?php 
                                 include('connect.php');
									
                                    date_default_timezone_set('mexico/general');
                                    $fch1=date("Y-m-d")." 00:00:00";
                                    $fch2=date("Y-m-d")." 23:59:59";
                                  $query = "SELECT SUM(ventasticket.cantidad) as total FROM tickets inner join ventasticket on tickets.idTicket=ventasticket.idTicket where tickets.fecha BETWEEN '$fch1' AND '$fch2' and ventasticket.idProducto=3 ";
                                  $result = mysql_query($query);
                                  while($row = mysql_fetch_array($result))
                                  {
                                    echo "<div class=\"huge\">",$row['total'],"</div>"; 
                                    }
                                     mysql_free_result($result);
                                    mysql_close($link);
									
                                    ?>
                                        <div>Quesadillas</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">Ver detalles</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-support fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                     <?php 
                                 include('connect.php');
									
                                    date_default_timezone_set('mexico/general');
                                    $fch1=date("Y-m-d")." 00:00:00";
                                    $fch2=date("Y-m-d")." 23:59:59";
                                  $query = "SELECT SUM(ventasticket.cantidad) as total FROM tickets inner join ventasticket on tickets.idTicket=ventasticket.idTicket where tickets.fecha BETWEEN '$fch1' AND '$fch2' and ventasticket.idProducto=4 ";
                                  $result = mysql_query($query);
                                  while($row = mysql_fetch_array($result))
                                  {
                                    echo "<div class=\"huge\">",$row['total'],"</div>"; 
                                    }
                                     mysql_free_result($result);
                                    mysql_close($link);
									
                                    ?>
                                        <div>Para Llevar</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
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
