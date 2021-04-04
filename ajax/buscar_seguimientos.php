

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
		$id_seguimiento=intval($_GET['id']);
		$query=mysqli_query($con, "select * from agenda where id_seguimiento='".$id_seguimiento."'");
		
		
			if ($delete1=mysqli_query($con,"delete from agenda where id_seguimiento='".$id_seguimiento."'")){
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
			

		
		
		
	}


	$id_user=$_SESSION['id_user'];


	if($action == 'ajax'){



//VISUALIZA TODOS LOS ENSAYOS SOLO EL ADMINISTRADOR CON ID = 1
if($id_user == 1){

		
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		 $aColumns = array('codigo_ensayo');
		 $sTable = "agenda";
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
		$sWhere.=" order by id_seguimiento desc ";
		include 'pagination.php'; 
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 5; 
		$adjacents  = 4; 
		$offset = ($page - 1) * $per_page;
		$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './agenda.php';
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($con, $sql);

	}else{
//SOLO LO VISUALIZA EL COORDINADOR ASIGNADO A SU ID
		$q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		$aColumns = array('codigo_ensayo');
		$sTable = "agenda";
		$sWhere = " where coordinador='$id_user' AND info_final=0 ";//AND info_final=0 si finalizan
	   if ( $_GET['q'] != "" )
	   {
		   $sWhere = "WHERE (";
		   for ( $i=0 ; $i<count($aColumns) ; $i++ )
		   {
			   $sWhere .= "coordinador='$id_user'AND info_final=0  AND ".$aColumns[$i]." LIKE '%".$q."%' OR ";//AND info_final=0 si finalizan
		   }
		   $sWhere = substr_replace( $sWhere, "", -3 );
		   $sWhere .= ')';
	   }
	   $sWhere.=" order by id_seguimiento desc ";
	   include 'pagination.php'; 
	   $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
	   $per_page = 5; 
	   $adjacents  = 4; 
	   $offset = ($page - 1) * $per_page;
	   $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
	   $row= mysqli_fetch_array($count_query);
	   $numrows = $row['numrows'];
	   $total_pages = ceil($numrows/$per_page);
	   $reload = './agenda.php';
	   $sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
	   $query = mysqli_query($con, $sql);

	}

		if ($numrows>0){
			
			?>
			<div class="table-responsive">
			<!--  class="table table-bordered" para que se borde la tabla -->
			  <table class="table " style="font-size:13px" >
			 
				<tr class="success" >
					<th nowrap>Código de ensayo</th>
					<th nowrap class='text-center'>Código participante</th>
					<th nowrap>Envio protocolo preliminar</th>
					<th nowrap>Reunion vía telefónica</th>
					<th nowrap>Envio protocolo final</th>
					<th nowrap>Recepción de aceptación</th>
					<th nowrap>Envio elem. de ensayo</th>
					<th nowrap>Recep. elem. de ensayo</th>
					<th nowrap>Recepción de resultados</th>
					<th nowrap>Análisis</th>
					<th nowrap>Informe preliminar</th>
					<th nowrap>Informe final</th>
					<th width='100px' class='text-center'>Opciones</th>
					
				</tr>
				
					<?php
						while ($row=mysqli_fetch_array($query)){

						$id_seguimiento=$row['id_seguimiento'];
						$Codigo_ensayo=$row['codigo_ensayo'];
						$Codigo_participante=$row['codigo_participante'];
						// $Fecha_inicial=$row['fecha_inicial'];
						// $Fecha_final=$row['fecha_final'];


						
						$pp = $row['proto_pre'];
						 if ($pp==1){$p_p="Realizado";$label1='label-success';}
						 else {$p_p="Pendiente";$label1='label-warning';}

						 $rt = $row['reunion_tel'];
						 if ($rt==1){$r_t="Realizado";$label2='label-success';}
						 else {$r_t="Pendiente";$label2='label-warning';}

						 $pf = $row['proto_final'];
						 if ($pf==1){$p_f="Realizado";$label3='label-success';}
						 else {$p_f="Pendiente";$label3='label-warning';}

						 $ra = $row['aceptacion'];
						 if ($ra==1){$r_a="Realizado";$label4='label-success';}
						 else {$r_a="Pendiente";$label4='label-warning';}

						 $eee = $row['e_elemento_ensayo'];
						 if ($eee==1){$e_e_e="Realizado";$label5='label-success';}
						 else {$e_e_e="Pendiente";$label5='label-warning';}

						 $ree = $row['r_elemento_ensayo'];
						 if ($ree==1){$r_e_e="Realizado";$label6='label-success';}
						 else {$r_e_e="Pendiente";$label6='label-warning';}

						 $rr = $row['resultados'];
						 if ($rr==1){$r_r="Realizado";$label7='label-success';}
						 else {$r_r="Pendiente";$label7='label-warning';}

						 $ana = $row['analisis'];
						 if ($ana==1){$a="Realizado";$label8='label-success';}
						 else {$a="Pendiente";$label8='label-warning';}
						 
						 $ip = $row['info_pre'];
						 if ($ip==1){$i_p="Realizado";$label9='label-success';}
						 else {$i_p="Pendiente";$label9='label-warning';}
						 
						 $if = $row['info_final'];
						 if ($if==1){$i_f="Realizado";$label10='label-success';}
						 else {$i_f="Pendiente";$label10='label-warning';}

						 //$ref = $row['referencia'];
						 //if($ref==1){ $clase='style="background-color:#FFF5EE "';}
						 //else{ $clase='';}

						 
						  $clase='style="border-left: 10px solid '.$row['color'].';"';
						 

						
					?>

					<tr>
					  	<!-- col md ordena el tamaño de la etiqueta y col md push lo mueve entre el espacio -->
						<td <?php echo $clase;?> nowrap><?php echo utf8_encode($Codigo_ensayo); ?></td>
						<td <?php //echo $clase;?> nowrap><?php echo utf8_encode($Codigo_participante); ?></td>
						<td <?php //echo $clase;?> ><span class="label <?php echo $label1;?> col-md-5 col-md-push-3"><?php echo $p_p; ?></span></td>
						<td <?php //echo $clase;?> ><span class="label <?php echo $label2;?> col-md-5 col-md-push-3"><?php echo $r_t; ?></span></td>
						<td <?php //echo $clase;?> ><span class="label <?php echo $label3;?> col-md-6 col-md-push-3"><?php echo $p_f; ?></span></td>
						<td <?php //echo $clase;?> ><span class="label <?php echo $label4;?> col-md-5 col-md-push-3"><?php echo $r_a; ?></span></td>
						<td <?php //echo $clase;?> ><span class="label <?php echo $label5;?> col-md-5 col-md-push-3"><?php echo $e_e_e; ?></span></td>
						<td <?php //echo $clase;?> ><span class="label <?php echo $label6;?> col-md-5 col-md-push-3"><?php echo $r_e_e; ?></span></td>
						<td <?php //echo $clase;?> ><span class="label <?php echo $label7;?> col-md-5 col-md-push-3"><?php echo $r_r; ?></span></td>
						<td <?php //echo $clase;?> ><span class="label <?php echo $label8;?> pull-left"><?php echo $a; ?></span></td>
						<td <?php //echo $clase;?> ><span class="label <?php echo $label9;?> col-md-7 col-md-push-2"><?php echo $i_p; ?></span></td>
						<td <?php //echo $clase;?> ><span class="label <?php echo $label10;?> pull-left" ><?php echo $i_f; ?></span></td>
						
					
						<td <?php //echo $clase;?> nowrap><span class="pull-right">
					
							<a href="editar_seguimiento.php?id_seguimiento=<?php echo $id_seguimiento;?>" class='btn btn-danger rojo' title='Editar seguimiento' ><i class="glyphicon glyphicon-edit" ></i></a>
						
						<?php
					 	$id_user=$_SESSION['id_user'];
						if($id_user<2 ){
						?> 

							<a href="#" class='btn btn-danger rojo' title='Borrar seguimiento' onclick="eliminar('<?php echo $id_seguimiento; ?>')"><i class="glyphicon glyphicon-trash"></i> </a></span>
						
						<?php
							}
						?> 
						
						
						</td>	

					</tr>
					<?php
					}
					?>
				<tr>

					<td colspan=13 ><span class="pull-left"><?php
					 echo paginate($reload, $page, $total_pages, $adjacents);
					?></span></td>
				</tr>
			  </table>
			</div>
			<?php
		}
	}
?>