<?php
	/*-------------------------
	Autor: Juan José Mendoza Medina
	Mail: juan_mendoza_medina@hotmail.com
	---------------------------*/
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }
	$active_facturas="";
	$active_productos="";
	$active_clientes="";
	$active_usuarios="";	
	$active_catalogo="active";
	$title="Editar agenda";
	
	/* Connect To Database*/
	require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
	
	if (isset($_GET['id_seguimiento']))
	{
        $id_seguimiento=intval($_GET['id_seguimiento']);
       
		//$campos="clientes.id_cliente, clientes.Nombre_cliente, clientes.Razon_cliente, clientes.email_cliente, facturas.id_vendedor, facturas.fecha_factura, facturas.condiciones, facturas.estado_factura, facturas.numero_factura";
		//$sql_factura=mysqli_query($con,"select $campos from facturas, clientes where facturas.id_cliente=clientes.id_cliente and id_factura='".$id_factura."'");
        $sql_seguimiento=mysqli_query($con,"select * from agenda where agenda.id_seguimiento='".$id_seguimiento."'");
        $count=mysqli_num_rows($sql_seguimiento);
		if ($count==1)
		{
				$rw_seguimiento=mysqli_fetch_array($sql_seguimiento);
				$id_cliente=$rw_seguimiento['id_seguimiento'];
				$codigo_ensayo=$rw_seguimiento['codigo_ensayo'];
				$codigo_participante=$rw_seguimiento['codigo_participante'];
				
				$proto_pre=$rw_seguimiento['proto_pre'];
				$reunion_tel=$rw_seguimiento['reunion_tel'];
				$proto_final=$rw_seguimiento['proto_final'];
				$aceptacion=$rw_seguimiento['aceptacion'];
                $e_elemento_ensayo=$rw_seguimiento['e_elemento_ensayo'];
				$r_elemento_ensayo=$rw_seguimiento['r_elemento_ensayo'];
				$resultados=$rw_seguimiento['resultados'];
                $analisis=$rw_seguimiento['analisis'];
                $info_pre=$rw_seguimiento['info_pre'];
				$info_final=$rw_seguimiento['info_final'];
				
				$fecha_proto_pre=$rw_seguimiento['fecha_proto_pre'];
				$fecha_reunion=$rw_seguimiento['fecha_reunion'];
				$fecha_proto_final=$rw_seguimiento['fecha_proto_final'];
				$fecha_aceptacion=$rw_seguimiento['fecha_aceptacion'];
				$fecha_envio_ibc=$rw_seguimiento['fecha_envio_ibc'];
				$fecha_inicial=$rw_seguimiento['fecha_inicial'];
				$fecha_final=$rw_seguimiento['fecha_final'];
				$fecha_resultados=$rw_seguimiento['fecha_resultados'];
				$fecha_inicial_analisis=$rw_seguimiento['fecha_inicio_analisis'];
				$fecha_final_analisis=$rw_seguimiento['fecha_final_analisis'];
				$fecha_info_pre=$rw_seguimiento['fecha_info_pre'];
				$fecha_info_final=$rw_seguimiento['fecha_info_final'];

                $_SESSION['id_seguimiento']=$id_cliente;
				
		}	
		else
		{
			header("location: agenda.php");
			exit;	
		}
	} 
	else 
	{
		header("location: agenda.php");
		exit;
	}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include("head.php");?>
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
 <!-- CSS  -->
 <link href="css/custom.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  </head>
  <body>

	<?php
	include("navbar.php");
	?>  
    <div class="container">
	<div class="panel panel-default">
		
		<div class="panel-heading">
			<h4><i class='glyphicon glyphicon-edit'></i> Editar Seguimiento</h4>
		</div>

		
		<div class="panel-body">

		

			<form class="form-horizontal" role="form" id="datos_seguimiento">

			<div class="form-group row">

			<h3  align="center"><b>Información del participante</b></h3>
			<br>
			<br>


				  <label for="nombre_cliente" class="col-md-5 control-label">Código de ensayo</label>
				  <div class="col-md-2">
					  <input type="text" class="form-control input-sm" id="codigo_ensayo2" required value="<?php echo $codigo_ensayo;?>" readonly>
					  <input id="codigo_ensayo2" name="codigo_ensayo2" type='hidden' value="<?php echo $id_cliente;?>">	
				  </div>
                  </div>



				<div class="form-group row">
				  <label for="nombre_cliente" class="col-md-5 control-label">Código de participante</label>
				  <div class="col-md-2">
					  <input type="text" class="form-control input-sm" id="codigo_participante2"  required value="<?php echo $codigo_participante;?>" readonly>
					  <input id="codigo_participante2" name="codigo_participante2" type='hidden' value="<?php echo $id_cliente;?>">	
				  </div>
                  </div>
				 

				  <hr><h3 align="center"><b>Actividades</b></h3>
				  <br>
				  <br>

				  <div class="form-group row">
				  <label for="nombre_cliente" class="col-md-5 control-label">Envio protocolo preliminar</label>
				  <div class="col-md-2">
			
					  <select   class='form-control input-sm ' id="proto_pre2" name="proto_pre2">
						<option  value="0" <?php if ($proto_pre==0){echo "selected";}?>>Pendiente</option>
						<option  value="1" <?php if ($proto_pre==1){echo "selected";}?>>Realizado</option>
					</select>
				  </div>
				  </div>



				  <div class="form-group row">
				  <label for="nombre_cliente" class="col-md-5 control-label">Reunión vía telefónica</label>
				  <div class="col-md-2">
				  	<select class='form-control input-sm ' id="reunion_tel2" name="reunion_tel2">
						<option value="0" <?php if ($reunion_tel==0){echo "selected";}?>>Pendiente</option>
						<option value="1" <?php if ($reunion_tel==1){echo "selected";}?>>Realizado</option>
				 	</select>
				  </div>
				  </div>
				  

				  <div class="form-group row">
				  <label for="nombre_cliente" class="col-md-5 control-label">Envio protocolo final</label>
				  <div class="col-md-2">
				  	<select class='form-control input-sm ' id="proto_final2" name="proto_final2">
						<option value="0" <?php if ($proto_final==0){echo "selected";}?>>Pendiente</option>
						<option value="1" <?php if ($proto_final==1){echo "selected";}?>>Realizado</option>
				 	</select>
				  </div>
				  </div>
				  
				  <div class="form-group row">
				  <label for="nombre_cliente" class="col-md-5 control-label">Aceptación</label>
				  <div class="col-md-2">
				  	<select class='form-control input-sm ' id="aceptacion2" name="aceptacion2">
						<option value="0" <?php if ($aceptacion==0){echo "selected";}?>>Pendiente</option>
						<option value="1" <?php if ($aceptacion==1){echo "selected";}?>>Realizado</option>
				 	</select>
				  </div>
				  </div>



				  <div class="form-group row">
				  <label for="email" class="col-md-5 control-label">Envio del elemento de ensayo</label>
					<div class="col-md-2">
						<select class='form-control input-sm ' id="e_elemento_ensayo2" name="e_elemento_ensayo2">
							<option value="0" <?php if ($e_elemento_ensayo==0){echo "selected";}?>>Pendiente</option>
							<option value="1" <?php if ($e_elemento_ensayo==1){echo "selected";}?>>Realizado</option>
						</select>
					</div>
				  </div>



				  <div class="form-group row">
				  <label for="email" class="col-md-5 control-label">Recepción de elemento de ensayo</label>
					<div class="col-md-2">
						<select class='form-control input-sm ' id="r_elemento_ensayo2" name="r_elemento_ensayo2">
							<option value="0" <?php if ($r_elemento_ensayo==0){echo "selected";}?>>Pendiente</option>
							<option value="1" <?php if ($r_elemento_ensayo==1){echo "selected";}?>>Realizado</option>
						</select>
					</div>
				  </div>


				  <div class="form-group row">
				  <label for="nombre_cliente" class="col-md-5 control-label">Recepción de resultados</label>
				  <div class="col-md-2">
				  	<select class='form-control input-sm ' id="resultados2" name="resultados2">
						<option value="0" <?php if ($resultados==0){echo "selected";}?>>Pendiente</option>
						<option value="1" <?php if ($resultados==1){echo "selected";}?>>Realizado</option>
				 	</select>
				  </div>
				  </div>

				  <div class="form-group row">
				  <label for="nombre_cliente" class="col-md-5 control-label">Análisis</label>
				  <div class="col-md-2">
				  	<select class='form-control input-sm ' id="analisis2" name="analisis2">
						<option value="0" <?php if ($analisis==0){echo "selected";}?>>Pendiente</option>
						<option value="1" <?php if ($analisis==1){echo "selected";}?>>Realizado</option>
				 	</select>
				  </div>
				  </div>




				 <div class="form-group row">
                 <label for="email" class="col-md-5 control-label">Informe Preliminar</label>
                 <div class="col-md-2">
                     <select class='form-control input-sm ' id="info_pre2" name="info_pre2">
                         <option value="0" <?php if ($info_pre==0){echo "selected";}?>>Pendiente</option>
                         <option value="1" <?php if ($info_pre==1){echo "selected";}?>>Realizado</option>
                     </select>
				 </div>
				 </div>



				 <div class="form-group row">
				 <label for="email" class="col-md-5 control-label">Informe final</label>
                 <div class="col-md-2">
                     <select class='form-control input-sm ' id="info_final2" name="info_final2">
                         <option value="0" <?php if ($info_final==0){echo "selected";}?>>Pendiente</option>
                         <option value="1" <?php if ($info_final==1){echo "selected";}?>>Realizado</option>
                     </select>
				 </div>
				 </div>


			<hr>
				 <h3  align="center"><b>Fechas de las actividades</b></h3>
			<br>
			<br>

 			<div class="form-group row">

				<label for="email" class="col-md-5 control-label">Envio protocolo preliminar</label>
				<div class="col-md-2">
					<input type="date" class="form-control input-sm" id="fecha_proto_pre2" name="fecha_proto_pre2" value="<?php echo $fecha_proto_pre;?>" >
				</div>
			</div>

			<div class="form-group row">

				<label for="email" class="col-md-5 control-label">Reunión vía telefónica</label>
				<div class="col-md-2">
					<input type="date" class="form-control input-sm" id="fecha_reunion2" name="fecha_reunion2" value="<?php echo $fecha_reunion;?>" >
				</div>
			</div>
			
			<div class="form-group row">

				<label for="email" class="col-md-5 control-label">Envio protocolo final</label>
				<div class="col-md-2">
					<input type="date" class="form-control input-sm" id="fecha_proto_final2" name="fecha_proto_final2" value="<?php echo $fecha_proto_final;?>" >
				</div>
			</div>

			<div class="form-group row">

				<label for="email" class="col-md-5 control-label">Aceptación</label>
				<div class="col-md-2">
					<input type="date" class="form-control input-sm" id="fecha_aceptacion2" name="fecha_aceptacion2" value="<?php echo $fecha_aceptacion;?>" >
				</div>
			</div>

			<div class="form-group row">

				<label for="email" class="col-md-5 control-label">Envio del elemento de ensayo</label>
				<div class="col-md-2">
					<input type="date" class="form-control input-sm" id="fecha_envio_ibc2" name="fecha_envio_ibc2" value="<?php echo $fecha_envio_ibc;?>" >
				</div>
			</div>
			
			<div class="form-group row">

				<label for="email" class="col-md-5 control-label">Inicio de calibración</label>
				<div class="col-md-2">
					<input type="date" class="form-control input-sm" id="fecha_inicial2" name="fecha_inicial2" value="<?php echo $fecha_inicial;?>" >
				</div>
			</div>

					
			<div class="form-group row">

				<label for="email" class="col-md-5 control-label">Final de calibración</label>
				<div class="col-md-2">
					<input type="date" class="form-control input-sm" id="fecha_final2" name="fecha_final2" value="<?php echo $fecha_final;?>" >
				</div>
			</div>

			
					
			<div class="form-group row">

				<label for="email" class="col-md-5 control-label">Recepción de resultados</label>
				<div class="col-md-2">
					<input type="date" class="form-control input-sm" id="fecha_resultados2" name="fecha_resultados2" value="<?php echo $fecha_resultados;?>" >
				</div>
			</div>

						
					
			<div class="form-group row">

				<label for="email" class="col-md-5 control-label">Inicio de análisis</label>
				<div class="col-md-2">
					<input type="date" class="form-control input-sm" id="fecha_inicio_analisis2" name="fecha_inicio_analisis2" value="<?php echo $fecha_inicial_analisis;?>" >
				</div>
			</div>
									
					
			<div class="form-group row">

				<label for="email" class="col-md-5 control-label">Final de análisis</label>
				<div class="col-md-2">
					<input type="date" class="form-control input-sm" id="fecha_final_analisis2" name="fecha_final_analisis2" value="<?php echo $fecha_final_analisis;?>" >
				</div>
			</div>

							
			<div class="form-group row">

				<label for="email" class="col-md-5 control-label">Envio del informe preliminar</label>
				<div class="col-md-2">
					<input type="date" class="form-control input-sm" id="fecha_info_pre2" name="fecha_info_pre2" value="<?php echo $fecha_info_pre;?>" >
				</div>
			</div>

									
			<div class="form-group row">

				<label for="email" class="col-md-5 control-label">Envio del informe final</label>
				<div class="col-md-2">
					<input type="date" class="form-control input-sm" id="fecha_info_final2" name="fecha_info_final2" value="<?php echo $fecha_info_final;?>" >
				</div>
			</div>


			
			

				

				
				<br>
				<br>
				<div class="editar_seguimiento" class='col-md-12' style="margin-top:10px"></div> 
				<br>
				
				<div class="col-md-12">

					<div class="pull-left">
						<a  href="agenda.php" class="btn btn-danger rojo"><span class="glyphicon glyphicon-chevron-left" ></span> Atrás</a>
					</div>

					<div class="pull-right">
						<button type="submit" class="btn btn-danger rojo">
						  <span class="glyphicon glyphicon-refresh"></span> Actualizar datos
						</button>

					</div>	
				</div>
			</form>	

 				 <div class="clearfix"></div> 
				<!-- <div class="editar_seguimiento" class='col-md-12' style="margin-top:10px"></div>  -->
				
			
		</div>
	</div>		
		 
	</div>
	<hr>
	<?php
	include("footer.php");
	?>
	
	<script type="text/javascript" src="js/editar_seguimiento.js"></script>
  </body>
</html>