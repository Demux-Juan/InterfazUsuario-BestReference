<?php
	/*-------------------------
	Autor: Juan José Mendoza Medina
	Mail: juan_mendoza_medina@hotmail.com
	---------------------------*/
	


	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }
	
	/* Connect To Database*/
	require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
	
	$active_facturas="";
	$active_productos="";
	$active_clientes="active";
	$active_usuarios="";	
	$active_catalogo="";
	$title="Clientes";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include("head.php");?>
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
 <!-- CSS  -->
 <link href="css/custom.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  </head>


  <body>
	<?php
	include("navbar.php");
	?>
	
    <div class="container">
	<div class="panel panel-default">
		<div class="panel-heading">
		    <div class="btn-group pull-right">
				<button type='button' class="btn btn-danger rojo" data-toggle="modal" data-target="#nuevoCliente"><span class="glyphicon glyphicon-plus" ></span> Nuevo Cliente</button>
			</div>
			<h4><i class='glyphicon glyphicon-search'></i> Buscar Clientes</h4>
		</div>
		<div class="panel-body">
		
			
			
			<?php
				include("modal/registro_clientes.php");
				include("modal/editar_clientes.php");
			?>
			<form class="form-horizontal" role="form" id="datos_cotizacion">
				
						<div class="form-group row">
							<label for="q" class="col-md-2 control-label">Cliente:</label>
							<div class="col-md-5">
								<input type="text" class="form-control" id="q" placeholder="Nombre, Razón social o RFC del cliente" onkeyup='load(1);'>
							</div>
							<div class="col-md-3">
								<button type="button" class="btn btn-danger rojo" onclick='load(1);'>
									<span class="glyphicon glyphicon-search" ></span> Buscar</button>
								<span id="loader"></span>
							</div>
							
						</div>
				
				
				
		</form>

				<!-- saca los resultados de busqueda de ajax -->
				<div id="resultados"></div> 
				<!-- saca los resultados de salida del visualizador de la ventana -->
				<div class='outer_div'></div>  
			
		
	
			
			
			
  </div>
</div>
		 
	</div>





	<?php
	include("footer.php");
	?>
	<script type="text/javascript" src="js/clientes.js"></script>
  </body>
</html>
