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
		$id_cliente=intval($_GET['id']);
		$query=mysqli_query($con, "select * from facturas where id_cliente='".$id_cliente."'");
		$count=mysqli_num_rows($query);

		

		if ($count==0){
			if ($delete1=mysqli_query($con,"DELETE FROM clientes WHERE id_cliente='".$id_cliente."'")){
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
			
		} else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> No se pudo eliminar éste  cliente. Existen facturas vinculadas a éste producto. 
			</div>
			<?php
		}
		
		
		
	}
	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		 $aColumns = array('Nombre_cliente', 'Razon_cliente', 'RFC_cliente');//Columnas de busqueda
		 $sTable = "clientes";
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
		$sWhere.=" order by Nombre_cliente";
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
		$reload = './clientes.php';
		//main query to fetch the data
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($con, $sql);
		//loop through fetched data
		if ($numrows>0){

			?>
			<div class="table-responsive">
			  <table class="table">
				  	<!-- aqui puedes cambiar el color -->
				<tr  class="success"> 
				
					<th>Nombre contacto</th>
					<th>Razón Social</th>
					<th>RFC</th>
					<th>Teléfono</th>
					<th>Correo electrónico</th>
					<th width='100px' class='text-center'>Opciones</th>
					
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){

					//ASIGNACIÓN DE VARIABLES
						$id_cliente=$row['id_cliente'];
						$nombre_cliente=$row['Nombre_cliente'];
						$nombrecompleto_cliente=$row['Nombre_cliente']." ".$row["Apellido_cliente"];
						$apellido_cliente=$row['Apellido_cliente'];
						$razon_cliente=$row['Razon_cliente'];
						$rfc_cliente=$row['RFC_cliente'];
						$telefono_cliente=$row['Telefono_cliente'];
						$email_cliente=$row['Email_cliente'];
						$status_cliente=$row['Tipo_cliente'];
						$rfc_cliente=$row['RFC_cliente'];
						if ($status_cliente==1){$estado="Activo";}
						else {$estado="Inactivo";}
						$date_added= date('d/m/Y', strtotime($row['date_added']));
						
					?>
					<!-- LO QUE APARECE DENTRO DE MODAL EDITAR CLIENTE, TAMBIEN TIENE LOS LLAMADOS DE CLIENTES.JS -->
					<input type="hidden" value="<?php echo $nombre_cliente;?>" id="Nombre_cliente<?php echo $id_cliente;?>">
					<input type="hidden" value="<?php echo $apellido_cliente;?>" id="Apellido_cliente<?php echo $id_cliente;?>">
					<input type="hidden" value="<?php echo $razon_cliente;?>" id="Razon_cliente<?php echo $id_cliente;?>">
					<input type="hidden" value="<?php echo $rfc_cliente;?>" id="RFC_cliente<?php echo $id_cliente;?>">
					<input type="hidden" value="<?php echo $telefono_cliente;?>" id="Telefono_cliente<?php echo $id_cliente;?>">
					<input type="hidden" value="<?php echo $status_cliente;?>" id="Tipo_cliente<?php echo $id_cliente;?>">
					<input type="hidden" value="<?php echo $email_cliente;?>" id="Email_cliente<?php echo $id_cliente;?>">
					
					<tr>
						<!-- LO QUE APARECE DEBAJO DEL BUSCADOR, Esto se visualiza -->
						<td><?php echo $nombrecompleto_cliente; ?></td>
						<td nowrap><?php echo $razon_cliente;?></td>
						<td ><?php echo $rfc_cliente; ?></td>
						<td><?php echo $telefono_cliente;?></td>
						<td><?php echo $email_cliente;?></td>
						
					<td nowrap><span class="pull-right">
					<a href="#" class='btn btn-danger rojo' title='Editar cliente' onclick="obtener_datos('<?php echo $id_cliente;?>');" data-toggle="modal" data-target="#myModal2"><i class="glyphicon glyphicon-edit"></i></a> 
					

						<!-- CONDICION PARA BORRAR CLIENTES LIMITADA A LOS ADMINISTRADORES -->
					 <?php
					 $id_user=$_SESSION['id_user'];
						if($id_user<2 ){
					?> 
					<a href="#" class='btn btn-danger rojo' title='Borrar cliente' onclick="eliminar('<?php echo $id_cliente; ?>')"><i class="glyphicon glyphicon-trash"></i> </a></span></td>
						
					<?php
						}
					?> 


					</tr>
					<?php
				}
				?>


				
				<tr>
					<td colspan=7><span class="pull-left"><?php
					 echo paginate($reload, $page, $total_pages, $adjacents);
					?></span></td>
				</tr>
			  </table>
			</div>





			<?php
		}


	}
?>

