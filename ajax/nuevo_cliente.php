<?php
	/*-------------------------
	Autor: Juan José Mendoza Medina
	Mail: juan_mendoza_medina@hotmail.com
	---------------------------*/
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['nombre'])) {
           $errors[] = "Nombre vacío";
		}	else if (!empty($_POST['nombre'])){
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		$nombre=mysqli_real_escape_string($con,(strip_tags($_POST["nombre"],ENT_QUOTES)));
		$apellido=mysqli_real_escape_string($con,(strip_tags($_POST["Apellido"],ENT_QUOTES)));
		$razon=mysqli_real_escape_string($con,(strip_tags($_POST["Razon"],ENT_QUOTES)));
		$rfc=mysqli_real_escape_string($con,(strip_tags($_POST["RFC"],ENT_QUOTES)));
		$telefono=mysqli_real_escape_string($con,(strip_tags($_POST["Telefono"],ENT_QUOTES)));
		$email=mysqli_real_escape_string($con,(strip_tags($_POST["email"],ENT_QUOTES)));
		$pais=mysqli_real_escape_string($con,(strip_tags($_POST["Pais"],ENT_QUOTES)));
		$estado=mysqli_real_escape_string($con,(strip_tags($_POST["Estado"],ENT_QUOTES)));
		$localidad=mysqli_real_escape_string($con,(strip_tags($_POST["Localidad"],ENT_QUOTES)));
		$colonia=mysqli_real_escape_string($con,(strip_tags($_POST["Colonia"],ENT_QUOTES)));
		$calle=mysqli_real_escape_string($con,(strip_tags($_POST["Calle"],ENT_QUOTES)));
		$inter=mysqli_real_escape_string($con,(strip_tags($_POST["Inter"],ENT_QUOTES)));;
		$exter=mysqli_real_escape_string($con,(strip_tags($_POST["Exter"],ENT_QUOTES)));
		$postal=mysqli_real_escape_string($con,(strip_tags($_POST["Postal"],ENT_QUOTES)));
		$tipo=intval($_POST['Tipo']);
		$date_added=date("Y-m-d H:i:s");
		
		



		$sql = "SELECT * FROM clientes WHERE  RFC_cliente = '" . $rfc . "';";
		$query_check = mysqli_query($con,$sql);
		$query_checker=mysqli_num_rows($query_check);
		if ($query_checker == 1) {
			$errors[] = "Ya existe un cliente con el mismo RFC registrado.";
		} else {  
			// write new user's data into database
			$sql="INSERT INTO clientes (Nombre_cliente, Apellido_cliente, Razon_cliente, RFC_cliente, Telefono_cliente, Email_cliente, Pais_cliente, Estado_cliente, Localidad_cliente, Colonia_cliente, Calle_cliente, Inter_cliente, Exter_cliente, Postal_cliente, Tipo_cliente, date_added) 
			 VALUES ('$nombre','$apellido','$razon','$rfc','$telefono', '$email','$pais', '$estado', '$localidad','$colonia','$calle','$inter','$exter','$postal','$tipo','$date_added')";
			
			$query_new_insert = mysqli_query($con,$sql);

			// if user has been added successfully
			if ($query_new_insert) {
				$messages[] = "Cliente ha sido registrado satisfactoriamente.";
			} else {
				$errors[] = "Lo sentimos , el registro falló. Por favor, regrese y vuelva a intentarlo.";
			}
		}
	
} else {
	$errors[] = "Un error desconocido ocurrió.";
}







		// $sql="INSERT INTO clientes (Nombre_cliente, Apellido_cliente, Razon_cliente, RFC_cliente, Telefono_cliente, Email_cliente, Pais_cliente, Estado_cliente, Localidad_cliente, Colonia_cliente, Calle_cliente, Inter_cliente, Exter_cliente, Postal_cliente, Tipo_cliente, date_added) 
		// VALUES ('$nombre','$apellido','$razon','$rfc','$telefono', '$email','$pais', '$estado', '$localidad','$colonia','$calle','$inter','$exter','$postal','$tipo','$date_added')";
		
		// $query_new_insert = mysqli_query($con,$sql);
		// 	if ($query_new_insert){
		// 		$messages[] = "Cliente ha sido ingresado satisfactoriamente.";
		// 	} else{
		// 		$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
		// 	}
		// } else {
		// 	$errors []= "Error desconocido.";
		// }
		
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