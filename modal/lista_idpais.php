<?php 
//$conexion=mysqli_connect('localhost','root','','logeo');
require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
$idpais=$_POST['idpais'];

	$sql="SELECT id, estadonombre from estado where ubicacionpaisid='$idpais'";

	$result=mysqli_query($con,$sql);

    $cadena="
    <div class='form-group'>
	<label for='estado' class='col-sm-3 control-label'>Estado</label>
	<div class='col-md-8'>
    <select class='form-control' id='Estado' name='Estado' required> 
    <option value=''>-- Seleciona un estado --</option>";

	while ($ver=mysqli_fetch_row($result)) {
		$cadena=$cadena.'<option value='.$ver[0].'>'.utf8_encode($ver[1]).'</option>';
	}

	echo  $cadena."</select></div></div>";
	

?>