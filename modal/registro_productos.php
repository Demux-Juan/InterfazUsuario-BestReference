	<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="nuevoProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Agregar nuevo servicio</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="guardar_producto" name="guardar_producto">
			
			<div id="resultados_ajax_productos"></div>

			  <div class="form-group">
				<label for="codigo" class="col-sm-3 control-label">Código de servicio</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Código de servicio" required>
				</div>
			  </div>


			  <div class="form-group">
				<label for="codigo" class="col-sm-3 control-label">Clave de unidad</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="codigo_unidad" name="codigo_unidad" placeholder="Clave de unidad" required>
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="nombre" class="col-sm-3 control-label">Descripción</label>
				<div class="col-sm-8">
					<textarea class="form-control" id="descripcion" name="descripcion" placeholder="Descripción del servicio" required maxlength="255" ></textarea>
				  
				</div>
			  </div>
			  



			  <div class="form-group">
				<label for="precio" class="col-sm-3 control-label">Precio</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="precio" name="precio" placeholder="Precio de venta del servicio" required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8">
				</div>
			  </div>
			 
			 



			
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-danger rojo" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-danger rojo" id="guardar_datos">Guardar datos</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<?php
		}
	?>