<?php

	/*-------------------------
	Autor: Juan José Mendoza Medina
	Mail: juan_mendoza_medina@hotmail.com
	---------------------------*/
if (isset($_GET['term'])){
include("../../config/db.php");
include("../../config/conexion.php");
$return_arr = array();
/* If connection to database, run sql statement. */
if ($con)
{

	  $fetch = mysqli_query($con,"SELECT * FROM inf_cliente where Razon_cliente  like '%" . mysqli_real_escape_string($con,($_GET['term'])) . "%' LIMIT 0 ,50"); 
	//$fetch = mysqli_query($con,"SELECT * FROM clientes where Razon_cliente like '%" . mysqli_real_escape_string($con,($_GET['term'])) . "%' LIMIT 0 ,50"); 
	/* Retrieve and store in array the results of the query.*/
	while ($row = mysqli_fetch_array($fetch)) {
		
		$id_cliente=$row['id_cliente'];
		$row_array['value'] = $row['Razon_cliente'];
		$row_array['Razon_cliente']=$row['Razon_cliente'];
		$row_array['RFC_cliente']=$row['RFC_cliente'];
		$row_array['id_cliente']=$id_cliente;
		$row_array['Nombre_cliente']= $row['Nombre_cliente']." ".$row['Apellido_cliente'];
		$row_array['Telefono_cliente']=$row['Telefono_cliente'];
		$row_array['Email_cliente']=$row['Email_cliente'];
		
		
		 


		$row_array['Domicilio_cliente'] =  "Calle: ".$row['Calle_cliente']." No. ".$row['Exter_cliente'];

		if(!empty($row['Inter_cliente']))
		$row_array['Domicilio_cliente'] .= " Int. ".$row['Inter_cliente'];

		$row_array['Domicilio_cliente'] .= ", Col: ".$row['Colonia_cliente'].
										", CP: ".$row['Postal_cliente'].", ".$row['Localidad_cliente'].
										", ".iconv('iso-8859-1','utf-8',$row['estado']).", ".iconv('iso-8859-1','utf-8',$row['pais']).".";
		 array_push($return_arr,$row_array);
		
    }
	
}

/* Free connection resources. */
mysqli_close($con);

/* Toss back results as json encoded array. */
echo json_encode($return_arr);

}
?>