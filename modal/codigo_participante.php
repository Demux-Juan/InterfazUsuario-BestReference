<?php 
//$conexion=mysqli_connect('localhost','root','','logeo');
require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
$idensayo=$_POST['idensayo'];
//puedes quitar esto
$vacio=0;

	$sql="SELECT codigo_participante from ensayos where id_ensayo='$idensayo'";

	$result=mysqli_query($con,$sql);

    $cadena="
    <div class='form-group'>
	<label  class='col-sm-5 control-label'>Código del participante</label>
	<div class='col-md-5'>";
    
    //puedes quitar esto
    if($vacio==0)
     $cadena=$cadena. '<input type="text" class="form-control" id="Codigo_participante" name="Codigo_participante" placeholder="Selecciona un ensayo" value="" readonly>' ;
 

	while ($ver=mysqli_fetch_row($result)) {

 	//puedes quitar esto
 		$vacio=1;
 	//esto no
		$cadena="
		<div class='form-group'>
		<label  class='col-sm-5 control-label'>Código del participante</label>
		<div class='col-md-5'>";




		$cadena=$cadena. '<input type="text" class="form-control" id="Codigo_participante" name="Codigo_participante" value='.$ver[0].' required>' ;
	}

	echo  $cadena."</div></div>";
	

?>
