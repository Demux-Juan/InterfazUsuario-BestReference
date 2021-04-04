<?php
	/*-------------------------
	Autor: Juan José Mendoza Medina
	Mail: juan_mendoza_medina@hotmail.com
	---------------------------*/
include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
    /*Inicia validacion del lado del servidor*/
    
    $id_cliente= $_SESSION['id_seguimiento'];
//	if (empty($_POST['Nombre_seguimiento2'])) {
//		   $errors[] = "Nombre vacío";
//		} 
        // else if ($_POST['Envio_proto_pre2'] == ""){
		// 	$errors[] = "Dato de envio de protocolo preliminar vacío";
        // } else if ($_POST['Envio_proto_final2'] == ""){
		// 	$errors[] = "Dato de envio de protocolo final vacío";
		// } else if ($_POST['Envio_elem_ensayo2'] == ""){
		// 	$errors[] = "Dato de envio de elemento de ensayo vacío";
		// } else if ($_POST['Recep_elem_ensayo2'] == ""){
        //     $errors[] = "Dato de recepción de elemento de ensayo vacío";
        // } else if ($_POST['Analisis2'] == ""){
        //     $errors[] = "Dato de analisis vacío";    
        // } else if ($_POST['Info_pre2'] == ""){
        //     $errors[] = "Dato de informe preliminar vacío";
        // } else if ($_POST['Info_final2'] == ""){
        //     $errors[] = "Dato de informe final vacío";      
        // } else if ($_POST['Fecha_inicial2'] == ""){
        //     $errors[] = "Dato de fecha inicial vacío";      
        // } else if ($_POST['Fecha_final2'] == ""){
        //     $errors[] = "Dato de fecha final vacío";      
		// } else if (
			
			
        //     !empty($_POST['Nombre_seguimiento2']) &&
        //     !empty($_POST['Fecha_inicial2'])      &&
        //     !empty($_POST['Fecha_final2'])        &&
        //     $_POST['Envio_proto_pre2']!=""        &&
        //     $_POST['Envio_proto_final2']!=""      &&
        //     $_POST['Envio_elem_ensayo2']!=""      &&
        //     $_POST['Recep_elem_ensayo2']!=""      &&
        //     $_POST['Analisis2']!=""               &&
        //     $_POST['Info_pre2']!=""               &&
        //     $_POST['Info_final2']!=""

        // ){

		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
        //$nombre=mysqli_real_escape_string($con,(strip_tags($_POST["Nombre_seguimiento2"],ENT_QUOTES)));

        $proto_pre=intval($_POST['proto_pre2']);
		$reunion_tel=intval($_POST['reunion_tel2']);
		$proto_final=intval($_POST['proto_final2']);
		$aceptacion=intval($_POST['aceptacion2']);
        $e_elemento_ensayo=intval($_POST['e_elemento_ensayo2']);
		$r_elemento_ensayo=intval($_POST['r_elemento_ensayo2']);
        $resultados=intval($_POST['resultados2']);
        $analisis=intval($_POST['analisis2']);
        $info_pre=intval($_POST['info_pre2']);
        $info_final=intval($_POST['info_final2']);
       
        $fecha_proto_pre=mysqli_real_escape_string($con,(strip_tags($_POST["fecha_proto_pre2"],ENT_QUOTES)));
		$fecha_reunion=mysqli_real_escape_string($con,(strip_tags($_POST["fecha_reunion2"],ENT_QUOTES)));
		$fecha_proto_final=mysqli_real_escape_string($con,(strip_tags($_POST["fecha_proto_final2"],ENT_QUOTES)));
		$fecha_aceptacion=mysqli_real_escape_string($con,(strip_tags($_POST["fecha_aceptacion2"],ENT_QUOTES)));
		$fecha_envio_ibc=mysqli_real_escape_string($con,(strip_tags($_POST["fecha_envio_ibc2"],ENT_QUOTES)));
		$fecha_inicial=mysqli_real_escape_string($con,(strip_tags($_POST["fecha_inicial2"],ENT_QUOTES)));
		$fecha_final=mysqli_real_escape_string($con,(strip_tags($_POST["fecha_final2"],ENT_QUOTES)));
		$fecha_resultados=mysqli_real_escape_string($con,(strip_tags($_POST["fecha_resultados2"],ENT_QUOTES)));
		$fecha_inicio_analisis=mysqli_real_escape_string($con,(strip_tags($_POST["fecha_inicio_analisis2"],ENT_QUOTES)));
		$fecha_final_analisis=mysqli_real_escape_string($con,(strip_tags($_POST["fecha_final_analisis2"],ENT_QUOTES)));
		$fecha_info_pre=mysqli_real_escape_string($con,(strip_tags($_POST["fecha_info_pre2"],ENT_QUOTES)));
		$fecha_info_final=mysqli_real_escape_string($con,(strip_tags($_POST["fecha_info_final2"],ENT_QUOTES)));




        $sql = "UPDATE agenda SET proto_pre='".$proto_pre."', reunion_tel='".$reunion_tel."', proto_final='".$proto_final."', e_elemento_ensayo='".$e_elemento_ensayo."'
        , r_elemento_ensayo='".$r_elemento_ensayo."', resultados='".$resultados."', analisis='".$analisis."', info_pre='".$info_pre."', info_final='".$info_final."'
        , fecha_proto_pre='".$fecha_proto_pre."', fecha_reunion='".$fecha_reunion."', fecha_proto_final='".$fecha_proto_final."', fecha_aceptacion='".$fecha_aceptacion."'
        , fecha_envio_ibc='".$fecha_envio_ibc."', fecha_inicial='".$fecha_inicial."', fecha_final='".$fecha_final."', fecha_resultados='".$fecha_resultados."'
        , fecha_inicio_analisis='".$fecha_inicio_analisis."', fecha_final_analisis='".$fecha_final_analisis."', fecha_info_pre='".$fecha_info_pre."', fecha_info_final='".$fecha_info_final."'
         WHERE id_seguimiento='".$id_cliente."';";
        
        
        $query_update = mysqli_query($con,$sql);

// if user has been added successfully
if ($query_update) {
    $messages[] = "El seguimiento ha sido modificada con éxito.";
} else {
    $errors[] = "Lo sentimos , el registro falló. Por favor, regrese y vuelva a intentarlo.";
}


// } else {
// $errors[] = "Un error desconocido ocurrió.";
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