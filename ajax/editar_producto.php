<?php

	/*-------------------------
	Autor: Juan José Mendoza Medina
	Mail: juan_mendoza_medina@hotmail.com
	---------------------------*/
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['mod_id'])) {
        //    $errors[] = "ID vacío";
        // }else if (empty($_POST['mod_codigo'])) {
        //    $errors[] = "Código vacío";
        // } else if (empty($_POST['mod_nombre'])){
		// 	$errors[] = "Nombre del producto vacío";
		// } else if ($_POST['mod_estado']==""){
		// 	$errors[] = "Selecciona el estado del producto";
		// } else if (empty($_POST['mod_precio'])){
		// 	$errors[] = "Precio de venta vacío";
		// } else if (
		// 	!empty($_POST['mod_id']) &&
		// 	!empty($_POST['mod_codigo']) &&
		// 	!empty($_POST['mod_nombre']) &&
		// 	$_POST['mod_estado']!="" &&
		// 	!empty($_POST['mod_precio'])
		$errors[] = "ID vacío";
	} else if (empty($_POST['mod_codigo_unidad'])){
		$errors[] = "Clave vacía";
	} else if (empty($_POST['mod_descripcion'])){
		$errors[] = "Descripción vacía";
	} 
	// else if (empty($_POST['mod_descuento'])){
	// 	$errors[] = "Descuento vacío";
	//  } 
	else if (empty($_POST['mod_precio'])){
		$errors[] = "Precio de venta vacío";
	}else if (empty($_POST['mod_codigo'])){
		$errors[] = "Clave vacía";
	} else if (
		!empty($_POST['mod_id']) &&
		!empty($_POST['mod_codigo']) &&
		!empty($_POST['mod_codigo_unidad']) &&
		// $_POST['mod_estado']!="" &&
		!empty($_POST['mod_precio']) &&
		// !empty($_POST['mod_descuento']) &&
		!empty($_POST['mod_descripcion']) 





		){
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	

		$codigo=mysqli_real_escape_string($con,(strip_tags($_POST["mod_codigo"],ENT_QUOTES)));
		$codigo_unidad=mysqli_real_escape_string($con,(strip_tags($_POST["mod_codigo_unidad"],ENT_QUOTES)));
		$descripcion=mysqli_real_escape_string($con,(strip_tags($_POST["mod_descripcion"],ENT_QUOTES)));
		$descuento_venta=intval(0);
		$precio_venta=floatval($_POST['mod_precio']);
		$id_producto=$_POST['mod_id'];

		$sql="UPDATE servicios SET codigo_producto='".$codigo."',codigo_unidad_servicio='".$codigo_unidad."', nombre_producto='".$descripcion."', descuento_servicio='".$descuento_venta."', precio_producto='".$precio_venta."' WHERE id_producto='".$id_producto."'";
		$query_update = mysqli_query($con,$sql);
			if ($query_update){
				$messages[] = "Producto ha sido actualizado satisfactoriamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
			}
		} else {
			$errors []= "Error desconocido.";
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