<?php

	/*-------------------------
	Autor: Juan José Mendoza Medina
	Mail: juan_mendoza_medina@hotmail.com
	---------------------------*/
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id'])){
		$id_producto=intval($_GET['id']);
		$query=mysqli_query($con, "select * from servicios where id_producto='".$id_producto."'");
		// $count=mysqli_num_rows($query);
		// if ($count==0){
			if ($delete1=mysqli_query($con,"DELETE FROM servicios WHERE id_producto='".$id_producto."'")){
			?>
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Aviso!</strong> Datos eliminados exitosamente.
			</div>
			<?php 
		}else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> Lo siento algo ha salido mal intenta nuevamente.
			</div>
			<?php
			
		}
			
		//} 
		// else {
			?>
			<!-- <div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> No se pudo eliminar éste  producto. Existen cotizaciones vinculadas a éste producto. 
			</div> -->
			<?php
		//}
		
		
		
	}
	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		 $aColumns = array('codigo_producto', 'nombre_producto');//Columnas de busqueda
		 $sTable = "servicios";
		 $sWhere = "";
		if ( $_GET['q'] != "" )
		{
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}
		$sWhere.=" order by codigo_producto ";
		include 'pagination.php'; //include pagination file
		//pagination variables
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 5; //how much records you want to show
		$adjacents  = 4; //gap between pages after number of adjacents
		$offset = ($page - 1) * $per_page;
		//Count the total number of row in your table*/
		$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './productos.php';
		//main query to fetch the data
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($con, $sql);
		//loop through fetched data
		if ($numrows>0){
			
			?>
			<div class="table-responsive">
			  <table class="table" >
				<tr  class="success">
					<th nowrap>Código</th>
					<th nowrap>Clave de unidad</th>
					<th width='500px' class='text-center' >Descripción</th>
					<th width='200px' class='text-center' >Precio</th>
					<th width='100px' class='text-center'>Opciones</th>
					
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
						$id_producto=$row['id_producto'];
						$codigo_servicio=$row['codigo_producto'];
						$codigo_unidad_servicio=$row['codigo_unidad_servicio'];
						$descripcion_servicio=$row['nombre_producto'];
						$descuento_servicio=$row['descuento_servicio'];
						$precio_producto=$row['precio_producto'];
				?>
					<!-- el valor id se ve reflejado en la funcion obtener datos buscar_productos.php-->
					<input type="hidden" value="<?php echo $codigo_servicio;?>" id="codigo_producto<?php echo $id_producto;?>">
					<input type="hidden" value="<?php echo $codigo_unidad_servicio;?>" id="codigo_unidad_servicio<?php echo $id_producto;?>">
					<input type="hidden" value="<?php echo $descripcion_servicio;?>" id="descripcion_servicio<?php echo $id_producto;?>">
					
					<input type="hidden" value="<?php echo number_format($descuento_servicio,1,'.','');?>" id="descuento_servicio<?php echo $id_producto;?>"> 
					<input type="hidden" value="<?php echo number_format($precio_producto,2,'.','');?>" id="precio_producto<?php echo $id_producto;?>">

					
					<tr>
						
						<td><?php echo $codigo_servicio; ?></td>
						<td><?php echo $codigo_unidad_servicio; ?></td>
						<td><?php echo $descripcion_servicio; ?></td>
						<td class='text-center' nowrap>$ <?php echo number_format($precio_producto,2);?></td>
					
					<td nowrap><span class="pull-right">
					<a href="#" class='btn btn-danger rojo' title='Editar producto' onclick="obtener_datos('<?php echo $id_producto;?>');" data-toggle="modal" data-target="#myModal2"><i class="glyphicon glyphicon-edit"></i></a> 
					<a href="#" class='btn btn-danger rojo' title='Borrar producto' onclick="eliminar('<?php echo $id_producto; ?>')"><i class="glyphicon glyphicon-trash"></i> </a></span></td>
						
					</tr>
				<?php
															}
				?>
				<tr>
					<td colspan=6><span class="pull-left">
					<?php
					 echo paginate($reload, $page, $total_pages, $adjacents);
					?>
					</span></td>
				</tr>
			  </table>
			</div>
			<?php
		}
	}
?>