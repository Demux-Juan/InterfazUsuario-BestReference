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
	
	/* Connect To Database*/
	require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
	
	$active_facturas="";
	$active_productos="";
	$active_clientes="";
	$active_usuarios="";	
	$active_catalogo="active";
	$title="Agenda";

	$id_user=$_SESSION['id_user'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("head.php");?>

	



<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<link href="css/custom.css" type="text/css" rel="stylesheet" media="screen,projection"/>
<!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js'></script> -->


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"> </script>

<meta charset='utf-8' />
<link href='fullcalendar/core/main.css' rel='stylesheet' />
<link href='fullcalendar/daygrid/main.css' rel='stylesheet' />
<script src='fullcalendar/core/main.js'></script>
<script src='fullcalendar/daygrid/main.js'></script>
<script src='fullcalendar/interaction/main.js'></script>
<script src='fullcalendar/core/locales/es.js'></script>


<style>

.fc-today {
    background: #DFF0D8 !important;
    font-weight: bold;
} 
.fc-center {
       
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
		text-transform: uppercase;
        font-size: 14px;
    }

.fc th {
    color: white; 
	background:rgba(59, 66, 83, 0.9);
  }




</style> 







  </head>


  <body>
	<?php
	include("navbar.php");
	?>
	
    
    <div class="container">
	<div class="panel panel-default">
		<div class="panel-heading">
		    <div class="btn-group pull-right">
				<button type='button' class="btn btn-danger rojo" data-toggle="modal" data-target="#nuevoSeguimiento"><span class="glyphicon glyphicon-plus" ></span> Nuevo seguimiento</button>
			</div>
			<h4><i class='glyphicon glyphicon-search'></i> Buscar Seguimiento</h4>
		</div>
		<div class="panel-body">
		
			
			
			<?php
			include("modal/registro_seguimiento.php");
		
			?>
			<form class="form-horizontal" role="form" id="seguimientos">
				
						<div class="form-group row">
							<label for="q" class="col-md-2 control-label"> Nombre de ensayo:</label>
							<div class="col-md-5">
								<input type="text" class="form-control" id="q" placeholder="Código de ensayo" onkeyup='load(1);'>
							</div>
							<div class="col-md-3">
								<button type="button" class="btn btn-danger rojo" onclick='load(1);'>
									<span class="glyphicon glyphicon-search" ></span> Buscar</button>
								<span id="loader"></span>
							</div>
							
						</div>
				
				
				
			</form>

				<div id="resultados"></div> <!-- Aviso de exito o fallo-->
				<div class='outer_div'></div> <!-- Tabla de seguimientos -->
			
				<label  class="col-md-5 control-label"></label>
			

		

				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
			

				<div id='calendario'></div><!-- Calendario -->
			
			


<div id="calendarModal" class="modal fade">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
            <h4 id="modalTitle" type="text"class="modalTitle"></h4>
        </div>
        <div id="modalBody" class="modal-body"> 
		
		<p></p>
		</div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
</div>


    



	<?php
	include("footer.php");
	?>
	<script type="text/javascript" src="js/agenda.js"></script>

	<script src='//cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js'></script>

<script>


document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendario');

  var calendario = new FullCalendar.Calendar(calendarEl, {

	header: {
    left: 'prev,next today ',
    center: 'title',
    right: 'dayGridMonth'
  },
    plugins: [ 'dayGrid' ],
	height: 700,
	displayEventTime : false, 
	locale:'es',
	eventLimit: true,
	navLinks: true,
  	eventClick: function(info){

		swal( info.event.title, info.event.extendedProps.description);
    

	  },
	events: [
		 <?php
		 if($id_user==1)
			 $sql="SELECT * FROM  agenda ";
		 else
			 $sql="SELECT * FROM  agenda where coordinador='$id_user' AND info_final=0 ";
			 
		 	$query = mysqli_query($con, $sql);
		 	while ($row=mysqli_fetch_array($query)){
  		?>

 			{ 
				title: 'Participante: <?php echo utf8_encode($row["codigo_participante"]); ?>', 
				start: '<?php echo $row["fecha_proto_pre"]; ?> 00:00:00', 
				description:'Envio del protocolo preliminar al participante.',
				color: '<?php echo $row["color"]; ?>'

			},
			{ 
				title: 'Participante: <?php echo utf8_encode($row["codigo_participante"]); ?>', 
				start: '<?php echo $row["fecha_reunion"]; ?> 00:00:00', 
				description:'Reunion con el participante para la revisión del protocolo por vía telefónica.',
				color: '<?php echo $row["color"]; ?>'

			},
			{ 
				title: 'Participante: <?php echo utf8_encode($row["codigo_participante"]); ?>', 
				start: '<?php echo $row["fecha_proto_final"]; ?> 00:00:00', 
				description:'Envio del protocolo final, acuerdo de confidencialidad, aceptación del protocolo, recepción de equipo y  formato para la calibración.',
				color: '<?php echo $row["color"]; ?>'

			},
			{ 
				title: 'Participante: <?php echo utf8_encode($row["codigo_participante"]); ?>', 
				start: '<?php echo $row["fecha_aceptacion"]; ?> 00:00:00', 
				description:'Recepción de los formatos de aceptación del protocolo y acuerdo de confidencialidad firmados.',
				color: '<?php echo $row["color"]; ?>'

			},
			{ 
				title: 'Participante: <?php echo utf8_encode($row["codigo_participante"]); ?>', 
				start: '<?php echo $row["fecha_envio_ibc"]; ?> 00:00:00', 
				description:'Envio del elemento de ensayo.',
				color: '<?php echo $row["color"]; ?>'

			},
			{ 
				title: 'Participante: <?php echo utf8_encode($row["codigo_participante"]); ?>', 
				start: '<?php echo $row["fecha_inicial"]; ?> 00:00:00', 
				end: '<?php echo $row["fecha_final"]; ?> 24:00:00', 
				description:'Periodo de calibración del participante.',
				color: '<?php echo $row["color"]; ?>'

			},
			{ 
				title: 'Participante: <?php echo utf8_encode($row["codigo_participante"]); ?>', 
				start: '<?php echo $row["fecha_resultados"]; ?> 00:00:00', 
				description:'Recepción de resultados.',
				color: '<?php echo $row["color"]; ?>'

			},
			{ 
				title: 'Participante: <?php echo utf8_encode($row["codigo_participante"]); ?>', 
				start: '<?php echo $row["fecha_inicio_analisis"]; ?> 00:00:00', 
				end:'<?php echo $row["fecha_final_analisis"]; ?> 24:00:00', 
				description:'Periodo de análisis de los resultados del participante.',
				color: '<?php echo $row["color"]; ?>'

			},
			{ 
				title: 'Participante: <?php echo utf8_encode($row["codigo_participante"]); ?>', 
				start: '<?php echo $row["fecha_info_pre"]; ?> 00:00:00', 
				description:'Elaboración y envío del informe preliminar',
				color: '<?php echo $row["color"]; ?>'

			},
			{ 
				title: 'Participante: <?php echo utf8_encode($row["codigo_participante"]); ?>', 
				start: '<?php echo $row["fecha_info_final"]; ?> 00:00:00', 
				description:'Entrega de informe final al participante',
				color: '<?php echo $row["color"]; ?>'

			},
			

  		<?php
  			}
  		?>
			] 


				
				});
calendario.render();
	

});



</script>





  </body>



</html>
