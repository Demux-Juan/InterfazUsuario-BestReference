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

<!-- color picker -->
		<link rel="stylesheet" href="https://unpkg.com/huebee@1/dist/huebee.css">
		<script src="https://unpkg.com/huebee@1/dist/huebee.pkgd.js"></script>



<style>
.huebee__cursor {
  width: 20px;
  height: 20px;
}
</style>






</head>



<script type="text/javascript">
	$(document).ready(function(){
		$('#Magnitud').val(); //donde empieza la lista dentro de val()
		recargarLista();

		$('#Magnitud').change(function(){
			recargarLista();
		});




	})
</script>
<script type="text/javascript">
	function recargarLista(){
		$.ajax({
			type:"POST",
			url:"modal/codigo_participante.php",
			data:"idensayo=" + $('#Magnitud').val(),
			success:function(r){
				
				$('#Codigo_participante').html(r);
			}
		});

		$.ajax({
		 	type:"POST",
		 	url:"modal/codigo_ensayo.php",
		 	data:"idensayo=" + $('#Magnitud').val(),
		 	success:function(j){
				
				$('#Codigo_ensayo').html(j);
			}
		});



	}



</script>








	<body>
		



	<!-- Modal -->
	<div class="modal fade" id="nuevoSeguimiento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog " role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Agregar seguimiento por participante</h4>
		  </div>

		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="guardar_seguimiento" name="guardar_seguimiento">
			
			<div id="resultados_ajax_seguimiento"></div>



			 
			  
		 <div class="form-group ">
				<label for="estado" class="col-sm-5 control-label">Ensayo</label>
							<div class="col-md-5">
								<select class="form-control " id="Magnitud" name="Magnitud"  required>
								<option value="">-- Seleciona un ensayo --</option>
									<?php
										$id_user=$_SESSION['id_user'];
										$sql_mag=mysqli_query($con,"select * from ensayos where id_usuario= '$id_user'");
										while ($rw=mysqli_fetch_array($sql_mag)){
											$id_ensayo=$rw["id_ensayo"];
											$ensayo=$rw["ensayo"];
											
											?>
											<option value="<?php echo $id_ensayo?>" ><?php echo utf8_encode($ensayo)?></option>
										
											<?php
										}
									?>
								</select>
							</div>
							</div>
										







				<div id ="Codigo_ensayo" ></div>
								<!-- Aqui se guarda el select del autocompletado del nombre del ensayo -->
				<div id ="Codigo_participante" ></div>
	


				<!-- <div class="form-group">
					<label  class="col-md-3 control-label">Inicio de calibración</label>
				<div class="col-md-8">
					<input class="form-control" type="date" id="fecha_inicial" name="fecha_inicial" value="" required>
				</div>
				</div>

				<div class="form-group">
					<label  class="col-md-3 control-label">Final de calibración</label>
				<div class="col-md-8">
					<input class="form-control" type="date" id="fecha_final" name="fecha_final" value="" required>
				</div>
				</div> -->



				<div class="form-group">
					<label  class="col-md-5 control-label">Envio del protocolo preliminar</label>
				<div class="col-md-5">
					<input class="form-control" type="date" id="fecha_proto_pre" name="fecha_proto_pre" value="" required>
				</div>
				</div>

				<div class="form-group">
					<label  class="col-md-5 control-label">Reunión vía telefónica</label>
				<div class="col-md-5">
					<input class="form-control" type="date" id="fecha_reunion" name="fecha_reunion" value="" required>
				</div>
				</div> 


				<div class="form-group">
					<label  class="col-md-5 control-label">Envío del protocolo final</label>
				<div class="col-md-5">
					<input class="form-control" type="date" id="fecha_proto_final" name="fecha_proto_final" value="" required>
				</div>
				</div>

				<div class="form-group">
					<label  class="col-md-5 control-label">Recepción de aceptación</label>
				<div class="col-md-5">
					<input class="form-control" type="date" id="fecha_aceptacion" name="fecha_aceptacion" value="" required>
				</div>
				</div> 


				<div class="form-group">
					<label  class="col-md-5 control-label">Envio del IBC</label>
				<div class="col-md-5">
					<input class="form-control" type="date" id="fecha_envio_ibc" name="fecha_envio_ibc" value="" required>
				</div>
				</div> 


				<div class="form-group">
					<label  class="col-md-5 control-label">Inicio de calibración</label>
				<div class="col-sm-5">
					<input class="form-control" type="date" id="fecha_inicial" name="fecha_inicial" value="" required>
				</div>

				<!-- <div class="col-sm-4">
					<input class="form-control" type="date" id="fecha_final" name="fecha_final" value="" required>
				</div> -->

				</div> 


				<div class="form-group">
					<label  class="col-md-5 control-label">Final de calibración</label> 
				<div class="col-md-5">
					<input class="form-control" type="date" id="fecha_final" name="fecha_final" value="" required>
				</div>
				</div>

				<div class="form-group">
					<label  class="col-md-5 control-label">Recepción de resultados</label>
				<div class="col-md-5">
					<input class="form-control" type="date" id="fecha_resultados" name="fecha_resultados" value="" required>
				</div>
				</div>



				<div class="form-group">
					<label  class="col-md-5 control-label">Inicio de análisis</label>
				<div class="col-md-5">
					<input class="form-control" type="date" id="fecha_inicio_analisis" name="fecha_inicio_analisis" value="" required>
				</div>
				</div>

				<div class="form-group">
					<label  class="col-md-5 control-label">Final de análisis</label>
				<div class="col-md-5">
					<input class="form-control" type="date" id="fecha_final_analisis" name="fecha_final_analisis" value="" required>
				</div>
				</div>

				<div class="form-group">
					<label  class="col-md-5 control-label">Envio informe premiliminar</label>
				<div class="col-md-5">
					<input class="form-control" type="date" id="fecha_info_pre" name="fecha_info_pre" value="" required>
				</div>
				</div>


				<div class="form-group">
					<label  class="col-md-5 control-label">Envio informe final</label>
				<div class="col-md-5">
					<input class="form-control" type="date" id="fecha_info_final" name="fecha_info_final" value="" required>
				</div>
				</div>



				<div class="form-group">
					<label  class="col-md-5 control-label">color</label>
				<div class="col-md-3">
				<input class="color-input form-control" id="color" name="color" data-huebee='{ "saturations": 1, "notation": "hex" }' required />
				</div>
				</div>


				<!-- <div class="form-group">
		 			<label  class="col-md-3 control-label">Lab. Referencia</label>
					<input type="checkbox" id="Referencia" name="Referencia" value="1" >	
				</div> -->
			
			</div>


		  <div class="modal-footer">
			<button type="button" class="btn btn-danger rojo" data-dismiss="modal" onclick="location.reload()">Cerrar</button>
			<button type="submit" class="btn btn-danger rojo" id="guardar_datos" >Guardar datos</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>





	<!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script>
		$(function() {
						$("#Codigo_ensayo").autocomplete({
							source: "codigo_ensayo.php",
							minLength: 0,
							select: function(event, ui) {
								event.preventDefault();
								$('#Codigo_ensayo').val(ui.item.Codigo_ensayo);
							
							 }
						});
						 
						
					});
					


	</script> -->








	</body>
	</html>

	


	<?php
		}
	?>