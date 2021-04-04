<?php
	/*-------------------------
	Autor: Obed Alvarado
	Web: obedalvarado.pw
	Mail: info@obedalvarado.pw
	---------------------------*/
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
		}
		
		
	$active_facturas="active";
	$active_productos="";
	$active_clientes="";
	$active_usuarios="";
	$active_catalogo="";	
	$title="Nueva Factura";
	
	/* Conexión con la base de datos*/
	require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
?>
<!DOCTYPE html>
<html lang="en">
  <head>
	<?php include("head.php");?>
	
	<script
		src="https://code.jquery.com/jquery-3.3.1.min.js"
		integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
		crossorigin="anonymous"></script>
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
			<h4><i class='glyphicon glyphicon-edit'></i> Nueva Factura</h4>
		</div>
		<div class="panel-body">
		<?php 
			include("modal/buscar_productos.php");
			include("modal/registro_clientes.php");
			include("modal/registro_productos.php");
			
		?>
			<form class="form-horizontal" role="form" id="datos_factura">

				
				<h4 align ="center" >Datos del Cliente</h4>
				 <!-- <br> -->
				 <hr>


				<div class="form-group row">
				  <label for="Razon_cliente" class="col-md-1 control-label">Razón Social </label>
				
				  <div class="col-md-3">
					  <input type="text" class="form-control input-sm" id="Razon_cliente" placeholder="Escriba la Razón Social" required>
					  <!-- <input id="id_cliente" type='hidden'>	 -->
				  </div>
		
				  <label for="tel1" class="col-md-1 control-label">Teléfono</label>
							<div class="col-md-2">
								<input type="text" class="form-control input-sm" id="tel1" placeholder="Teléfono" readonly>
							</div>
					<label for="mail" class="col-md-1 control-label">Email</label>
							<div class="col-md-3">
								<input type="text" class="form-control input-sm" id="mail" placeholder="Email" readonly>
							</div>

				 </div>

				 <div class="form-group row">
		
				  <label for="Nombre_cliente" class="col-md-1 control-label">Cliente</label>
				
				  <div class="col-md-3">
					  <input type="text" class="form-control input-sm" id="Nombre_cliente" placeholder="Cliente" readonly>
					  <input id="id_cliente" type='hidden'>	
				  </div>
	

				  <label for="empresa" class="col-md-1 control-label">RFC</label>
							<div class="col-md-2">

								<input type="text" class="form-control input-sm" id="RFC_cliente" placeholder="RFC" readonly>
							</div>
						

				 </div>


				 <div class="form-group row">
					 <label for="empresa" class="col-md-1 control-label">Domicilio Fiscal</label>
							<div class="col-md-10">

								<input type="text" class="form-control input-sm" id="Domicilio_cliente" placeholder="Domicilio Fiscal" readonly>
							</div>
				</div>




				<br>
				<br>
				 <h4 align ="center" >Detalles de la Factura</h4>
				 
				 <hr>


			<div class="form-group row">

							<label  class="col-md-1 control-label">Regimen Fiscal</label>
							<div class="col-md-3">
							<input type="text" class="form-control input-sm" id="Regimen" value="General de Ley Personas Morales" readonly>
							</div>

							<label  class="col-md-1 control-label">Fecha</label>
							<div class="col-md-2">
								<input type="text" class="form-control input-sm" id="Fecha" value="<?php echo date("d/m/Y");?>" readonly>
							</div>
							<label  class="col-md-1 control-label">Tipo de Pago</label>
							<div class="col-md-3">
								<select class='form-control input-sm' id="Tipo_pago">
									<option value="1">Efectivo</option>
									<option value="2">Cheque</option>
									<option value="3">Transferencia bancaria</option>
									<option value="4">Crédito</option>
								</select>
							</div>

							<!-- <label  class="col-md-1 control-label">IVA</label>
							<div class="col-md-1">
							<input type="checkbox" value="1" name="IVA" id="IVA" checked>
							</div>	 -->
						</div>




				<br>
				
				<div class="col-md-12">

					<div class="pull-left">
						<a  href="facturas.php" class="btn btn-danger rojo"><span class="glyphicon glyphicon-chevron-left" ></span> Atrás</a>
					</div>
					<div class="pull-right">
						<button type="button" class="btn btn-danger rojo" data-toggle="modal" data-target="#nuevoProducto">
						 <span class="glyphicon glyphicon-plus"></span> Nuevo producto
						</button>
						<button type="button" class="btn btn-danger rojo" data-toggle="modal" data-target="#nuevoCliente">
						 <span class="glyphicon glyphicon-user"></span> Nuevo cliente
						</button>
						<button id="button" type="button" class="btn btn-danger rojo" data-toggle="modal"  data-target="#myModal">
						 <span class="glyphicon glyphicon-plus"></span> Agregar Servicio
						</button>
						
						<button type="submit" class="btn btn-success verde">
						  <span class="glyphicon glyphicon-ok-sign"></span> Facturar
						</button>
					</div>	
				</div>
				
			</form>	
			



		<div id="resultados" class='col-md-12' style="margin-top:10px"></div><!-- Carga los datos ajax -->			
		</div>
	</div>		
		  <div class="row-fluid">
			<div class="col-md-12">
			
	

			
			</div>	
		 </div>
	</div>
	<!-- <hr> -->
	<br>
	<?php
	include("footer.php");
	?>
	<script type="text/javascript" src="js/VentanaCentrada.js"></script>
	<script type="text/javascript" src="js/nueva_factura.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script>
		$(function() {
						$("#Razon_cliente").autocomplete({
							source: "./ajax/autocomplete/clientes.php",
							minLength: 0,
							select: function(event, ui) {
								event.preventDefault();
								$('#id_cliente').val(ui.item.id_cliente);
								$('#Razon_cliente').val(ui.item.Razon_cliente);
								$('#Nombre_cliente').val(ui.item.Nombre_cliente);
								$('#tel1').val(ui.item.Telefono_cliente);
								$('#mail').val(ui.item.Email_cliente);
								$('#Domicilio_cliente').val(ui.item.Domicilio_cliente);								
								$('#RFC_cliente').val(ui.item.RFC_cliente);	
							 }
						});
						 
						
					});
					
	$("#Razon_cliente" ).on( "keydown", function( event ) {
						if ( event.keyCode!= $.ui.keyCode.UP && event.keyCode != $.ui.keyCode.DOWN && event.keyCode != $.ui.keyCode.LEFT && event.keyCode != $.ui.keyCode.RIGHT && event.keyCode != $.ui.keyCode.ENTER )
						{
							$("#id_cliente" ).val("");
							$("#tel1" ).val("");
							$("#mail" ).val("");
							$("#Domicilio_cliente" ).val("");
							$("#Nombre_cliente" ).val("");
							$('#RFC_cliente').val("");				
						}
						
			});	
	</script>







  </body>
</html>