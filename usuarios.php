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

	/* Conexión con la base de datos*/
	require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos

	// Pestañas de la barra de menú
	$active_facturas="";
	$active_productos="";
	$active_clientes="";
	$active_usuarios="active";	
	$active_catalogo="";
	$title="Usuarios";
?>


<!DOCTYPE html>
<html lang="en">
  <head>
	<?php include("head.php");?>
  </head>
  <body>
 	<?php
	//Carga la barra de navegación
	include("navbar.php");
	?> 
    <div class="container">
		<div class="panel panel-default">
		<div class="panel-heading">
		    <div class="btn-group pull-right">
				<button type='button' class="btn btn-danger rojo" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus" ></span> Nuevo Usuario</button>
			</div>
			<h4><i class='glyphicon glyphicon-search'></i> Buscar Usuarios</h4>
		</div>			
			<div class="panel-body">
			<?php
			include("modal/registro_usuarios.php");
			include("modal/editar_usuarios.php");
			include("modal/cambiar_password.php");
			?>
			<form class="form-horizontal" role="form" id="datos_cotizacion">
				
						<div class="form-group row">
							<label for="q" class="col-md-2 control-label">Usuario:</label>
							<div class="col-md-5">
								<input type="text" class="form-control" id="q" placeholder="Nombre del usuario" onkeyup='load(1);'>
							</div>
							
							
							
							<div class="col-md-3">
								<button type="button" class="btn btn-danger rojo" onclick='load(1);'>
									<span class="glyphicon glyphicon-search" ></span> Buscar</button>
								<span id="loader"></span>
							</div>
							
						</div>
				
				
				
			</form>
				<div id="resultados"></div><!-- Carga la ventana de notificación o avisos -->
				<div class='outer_div'></div><!-- Carga los usuarios registrados por ajax -->
						
			</div>
		</div>

	</div>

	<?php
	include("footer.php");
	?>


	
	<script type="text/javascript" src="js/usuarios.js"></script>

	
	


  </body>
</html>
