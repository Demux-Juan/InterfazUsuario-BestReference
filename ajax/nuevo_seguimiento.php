<?php
	/*-------------------------
	Autor: Juan José Mendoza Medina
	Mail: juan_mendoza_medina@hotmail.com
	---------------------------*/
include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/


		 
		 
 if (empty($_POST['Codigo_ensayo'])) {
			$errors[] = "Código del ensayo vacío";
		 }elseif (empty($_POST['Codigo_participante'])) {
			$errors[] = "Código del participante vacío";
		 }else{
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos

		// if (empty($_POST['Referencia'])) {
		// 	$referencia=0;
		//  }else{ $referencia=1;}

		$codigo_ensayo=mysqli_real_escape_string($con,(strip_tags($_POST["Codigo_ensayo"],ENT_QUOTES)));
		$codigo_participante=mysqli_real_escape_string($con,(strip_tags($_POST["Codigo_participante"],ENT_QUOTES)));

		$fecha_proto_pre=mysqli_real_escape_string($con,(strip_tags($_POST["fecha_proto_pre"],ENT_QUOTES)));
		$fecha_reunion=mysqli_real_escape_string($con,(strip_tags($_POST["fecha_reunion"],ENT_QUOTES)));
		$fecha_proto_final=mysqli_real_escape_string($con,(strip_tags($_POST["fecha_proto_final"],ENT_QUOTES)));
		$fecha_aceptacion=mysqli_real_escape_string($con,(strip_tags($_POST["fecha_aceptacion"],ENT_QUOTES)));
		$fecha_envio_ibc=mysqli_real_escape_string($con,(strip_tags($_POST["fecha_envio_ibc"],ENT_QUOTES)));
		$fecha_inicial=mysqli_real_escape_string($con,(strip_tags($_POST["fecha_inicial"],ENT_QUOTES)));
		$fecha_final=mysqli_real_escape_string($con,(strip_tags($_POST["fecha_final"],ENT_QUOTES)));
		$fecha_resultados=mysqli_real_escape_string($con,(strip_tags($_POST["fecha_resultados"],ENT_QUOTES)));
		$fecha_inicio_analisis=mysqli_real_escape_string($con,(strip_tags($_POST["fecha_inicio_analisis"],ENT_QUOTES)));
		$fecha_final_analisis=mysqli_real_escape_string($con,(strip_tags($_POST["fecha_final_analisis"],ENT_QUOTES)));
		$fecha_info_pre=mysqli_real_escape_string($con,(strip_tags($_POST["fecha_info_pre"],ENT_QUOTES)));
		$fecha_info_final=mysqli_real_escape_string($con,(strip_tags($_POST["fecha_info_final"],ENT_QUOTES)));
		$color=mysqli_real_escape_string($con,(strip_tags($_POST["color"],ENT_QUOTES)));

		$proto_pre=0;
		$reunion_tel=0;
		$proto_final=0;
		$aceptacion=0;
        $e_elemento_ensayo=0;
		$r_elemento_ensayo=0;
		$resultados=0;
        $analisis=0;
        $info_pre=0;
        $info_final=0;

		$id_user=$_SESSION['id_user'];

			// write new user's data into database
			$sql="INSERT INTO agenda (codigo_ensayo, codigo_participante, proto_pre, reunion_tel, proto_final, aceptacion, e_elemento_ensayo,
			 r_elemento_ensayo, resultados, analisis, info_pre, info_final, fecha_proto_pre, fecha_reunion, fecha_proto_final, fecha_aceptacion, 
			 fecha_envio_ibc, fecha_inicial, fecha_final, fecha_resultados, fecha_inicio_analisis, fecha_final_analisis, fecha_info_pre,
			 fecha_info_final, color, coordinador)
			VALUES ('$codigo_ensayo', '$codigo_participante', '$proto_pre', '$reunion_tel', '$proto_final', '$aceptacion', '$e_elemento_ensayo',
			 '$r_elemento_ensayo', '$resultados', '$analisis', '$info_pre', '$info_final', '$fecha_proto_pre', '$fecha_reunion', '$fecha_proto_final', '$fecha_aceptacion',
			 '$fecha_envio_ibc','$fecha_inicial', '$fecha_final', '$fecha_resultados', '$fecha_inicio_analisis', '$fecha_final_analisis', '$fecha_info_pre',
			 '$fecha_info_final', '$color', ' $id_user')";


			$query_new_insert = mysqli_query($con,$sql);
			// if user has been added successfully
			if ($query_new_insert) {
				$messages[] = "El seguimiento se ha agendado con éxito.";
			} else {
				$errors[] = "Lo sentimos , el registro falló. Por favor, regrese y vuelva a intentarlo.";
			}
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