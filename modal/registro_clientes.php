	<?php
		if (isset($con))
		{
	?>

	<html lang="en">
	<head>
	<meta charset="utf-8">
	<script
		src="https://code.jquery.com/jquery-3.3.1.min.js"
		integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
		crossorigin="anonymous"></script>

</head>



<script type="text/javascript">
	$(document).ready(function(){
		$('#Pais').val(); //donde empieza la lista dentro de val()
		recargarLista();

		$('#Pais').change(function(){
			recargarLista();
		});
	})
</script>
<script type="text/javascript">
	function recargarLista(){
		$.ajax({
			type:"POST",
			url:"modal/lista_idpais.php",
			data:"idpais=" + $('#Pais').val(),
			success:function(r){
				$('#Estado').html(r);
			}
		});
	}
</script>



	<body>
		

	<!-- Modal -->
	<div class="modal fade" id="nuevoCliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Agregar nuevo cliente</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="guardar_cliente" name="guardar_cliente">

			<!-- <div id="resultados_ajax"></div> -->

			  <div class="form-group">
				<label for="nombre" class="col-sm-3 control-label">Nombre</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="Nombre" name="nombre" placeholder="Nombre" required>
				</div>
				</div>
				
			  <div class="form-group">
				<label for="nombre" class="col-sm-3 control-label">Apellido</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="Apellido" name="Apellido" placeholder="Apellido" required>
				</div>
				</div>
				
				<div class="form-group">
				<label for="nombre" class="col-sm-3 control-label">Razón Social</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="Razon" name="Razon" placeholder="Razón social"required>
				</div>
				</div>
				

				<div class="form-group">
				<label for="nombre" class="col-sm-3 control-label">RFC</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="RFC" name="RFC" placeholder="RFC" required>
				</div>
			  </div>

			  <div class="form-group">
				<label for="telefono" class="col-sm-3 control-label">Teléfono</label>
				<div class="col-sm-8">
				  <input type="tel" class="form-control" id="Telefono" name="Telefono" placeholder="Teléfono" required >
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="email" class="col-sm-3 control-label">Email</label>
				<div class="col-sm-8">
					<input type="email" class="form-control" id="email" name="email" placeholder="Correo electrónico" required>
				  
				</div>
			  </div>
<!-- ************************************************** -->			  
			  <!-- <div class="form-group">
				<label for="direccion" class="col-sm-3 control-label">Dirección</label>
				<div class="col-sm-8">
					<textarea class="form-control" id="direccion" name="direccion"   maxlength="255" ></textarea>
				  
				</div>
				</div> -->
				
			  <!-- <div class="form-group">
				<label for="email" class="col-sm-3 control-label">País</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="Pais" name="Pais" required>
				  
				</div>
				</div> -->
<!-- ************************************************** -->

<div class="form-group ">
				<label for="estado" class="col-sm-3 control-label">País</label>
							<div class="col-md-8">
								<select class="form-control " id="Pais" name="Pais"  required>
								<option value="">-- Seleciona un país --</option>
									<?php
										
										$sql_pais=mysqli_query($con,"select * from pais order by paisnombre");
										while ($rw=mysqli_fetch_array($sql_pais)){
											$pais_id=$rw["id"];
											$pais_cliente=$rw["paisnombre"];


											?>
											<option value="<?php echo $pais_id?>" ><?php echo utf8_encode($pais_cliente)?></option>
										
											<?php
										}
									?>
								</select>
							</div>
							</div>
										



								<!-- Aqui se guarda el select del Estado -->
				<div id ="Estado" ></div>
	
		



				<div class="form-group">
				<label for="email" class="col-sm-3 control-label">Municipio/Localidad</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="Localidad" name="Localidad" placeholder="Municipio/Localidad"required >
				  
				</div>
			  </div>


				<div class="form-group">
				<label for="email" class="col-sm-3 control-label">Colonia</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="Colonia" name="Colonia" placeholder="Colonia" required >
				  
				</div>
				</div>
				
				<div class="form-group">
				<label for="email" class="col-sm-3 control-label">Calle</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="Calle" name="Calle" placeholder="Calle"required >
				  
				</div>
				</div>
				
				<div class="form-group">
				<label for="email" class="col-sm-3 control-label">Número interior</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="Inter" name="Inter" placeholder="Número interior">
				  
				</div>
				</div>
				<div class="form-group">
				<label for="email" class="col-sm-3 control-label">Número exterior</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="Exter" name="Exter" placeholder="Número exterior" required >
				  
				</div>
				</div>
				

				<div class="form-group">
				<label for="email" class="col-sm-3 control-label" >C.P</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="Postal" name="Postal" placeholder="Código postal" required>
				  
				</div>
			  </div>

			  
			  <div class="form-group">
				<label for="estado" class="col-sm-3 control-label">Tipo</label>
				<div class="col-sm-8">
				 <select class="form-control" id="Tipo" name="Tipo" required>
					<option value=""selected>-- Selecciona estado --</option>
					<option value="1" >Activo</option>
					<option value="0">Inactivo</option>
				  </select>
				</div>
			  </div>
			 
			 
				<div id="resultados_ajax"></div>
			
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-danger rojo" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-danger rojo" id="guardar_datos" >Guardar datos</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>



	</body>
	</html>

	

	<?php
		}
	?>