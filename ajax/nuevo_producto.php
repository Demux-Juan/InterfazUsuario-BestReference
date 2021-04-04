<?php
	/*-------------------------
	Autor: Juan José Mendoza Medina
	Mail: juan_mendoza_medina@hotmail.com
	---------------------------*/
include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['codigo'])) {
		   $errors[] = "Clave vacía";
		} else if (empty($_POST['codigo_unidad'])){
			$errors[] = "Clave vacía";
        } else if (empty($_POST['descripcion'])){
			$errors[] = "Descripción vacía";
		} else if (empty($_POST['precio'])){
			$errors[] = "Precio de venta vacío";
		} else if (
			!empty($_POST['codigo']) &&
			!empty($_POST['codigo_unidad']) &&
			!empty($_POST['precio']) &&
			!empty($_POST['descripcion']) 
		){
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		$codigo=mysqli_real_escape_string($con,(strip_tags($_POST["codigo"],ENT_QUOTES)));
		$codigo_unidad=mysqli_real_escape_string($con,(strip_tags($_POST["codigo_unidad"],ENT_QUOTES)));
		$descripcion=mysqli_real_escape_string($con,(strip_tags($_POST["descripcion"],ENT_QUOTES)));
		$descuento_venta=intval(0);
		$precio_venta=floatval($_POST['precio']);
		$date_added=date("Y-m-d H:i:s");



		$sql = "SELECT * FROM servicios WHERE codigo_producto = '" . $codigo . "' OR codigo_unidad_servicio = '" . $codigo_unidad . "';";
		$query_check = mysqli_query($con,$sql);
		$query_checker=mysqli_num_rows($query_check);
		if ($query_checker == 1) {
			$errors[] = "La clave de servicio o la clave de unidad ya están en uso.";
		} else {  
			// write new user's data into database
			$sql="INSERT INTO servicios (codigo_producto, codigo_unidad_servicio, nombre_producto, descuento_servicio, precio_producto, date_added )
			VALUES ('$codigo','$codigo_unidad','$descripcion','$descuento_venta','$precio_venta','$date_added')";
			$query_new_insert = mysqli_query($con,$sql);

			// if user has been added successfully
			if ($query_new_insert) {
				$messages[] = "El servicio se ha registrado con éxito.";
			} else {
				$errors[] = "Lo sentimos , el registro falló. Por favor, regrese y vuelva a intentarlo.";
			}
		}
	
} else {
	$errors[] = "Un error desconocido ocurrió.";
}





		
		if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){
				
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}

?>