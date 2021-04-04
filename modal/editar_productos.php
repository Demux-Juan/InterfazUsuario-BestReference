	<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Editar servicio</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="editar_producto" name="editar_producto">
			<div id="resultados_ajax2"></div>

			  <div class="form-group">
				<label for="codigo" class="col-sm-3 control-label">Clave del servicio</label>
				<div class="col-sm-8">
				<input type="text" class="form-control" id="mod_codigo" name="mod_codigo" placeholder="Clave del servicio" required>
					<input type="hidden" name="mod_id" id="mod_id">
				</div>
			  </div>
			  <div class="form-group">
				<label for="codigo" class="col-sm-3 control-label">Clave de unidad</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="mod_codigo_unidad" name="mod_codigo_unidad" placeholder="Clave de unidad" required>
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="nombre" class="col-sm-3 control-label">Descripción</label>
				<div class="col-sm-8">
					<textarea class="form-control" id="mod_descripcion" name="mod_descripcion" placeholder="Descripción del servicio" required maxlength="255" ></textarea>
				  
				</div>
			  </div>
			  


			  <!-- <div class="form-group">
				<label  class="col-sm-3 control-label">Descuento %</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="mod_descuento" name="mod_descuento" placeholder="Descuento del servicio" pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8" required>
				</div>
			  </div> -->

			  <div class="form-group">
				<label  class="col-sm-3 control-label">Precio</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="mod_precio" name="mod_precio" placeholder="Precio de venta del servicio" required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8">
				</div>
			  </div>
			 
			 
<!-- 
			  <div class="form-group">
				<label  class="col-sm-3 control-label">Estado</label>
				<div class="col-sm-8">
				 <select class="form-control" id="mod_estado" name="mod_estado" required>
					<option value="" selected>-- Selecciona estado --</option>
					<option value="1" >Activo</option>
					<option value="0">Inactivo</option>
				  </select>
				</div>
			  </div> -->
			 
			 
			
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-danger rojo" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-danger rojo" id="actualizar_datos">Actualizar datos</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<?php
		}
	?>