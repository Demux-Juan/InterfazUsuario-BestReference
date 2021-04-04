	<?php
		if (isset($title))
		{
	?>
<nav class="navbar navbar-default ">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <!-- <a class="navbar-brand" href="#">Best Reference</a> -->
      <img src="img/avatar_2x.png" width="100px" alt="" class="logo"> 
      
      <br/>



    </div>

    <?php
    $user_name=$_SESSION['user_name'];
    $id_user=$_SESSION['id_user'];
      ?>
      
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
      
        <li class="<?php echo $active_facturas;?>"><a href="facturas.php"><i class='glyphicon glyphicon-list-alt'></i> Facturas <span class="sr-only">(current)</span></a></li>
        <li class="<?php echo $active_catalogo;?>"><a href="agenda.php"><i class='glyphicon glyphicon-list'></i> Agenda </a></li> 
        <li class="<?php echo $active_productos;?>"><a href="productos.php"><i class='glyphicon glyphicon-tag'></i> Servicios</a></li>
        <li class="<?php echo $active_clientes;?>"><a href="clientes.php"><i class='glyphicon glyphicon-user'></i> Clientes</a></li>
        <?php if($id_user==1){?>
        <li class="<?php echo $active_usuarios;?>"><a href="usuarios.php"><i  class='glyphicon glyphicon-briefcase'></i> Usuarios</a></li>
        <?php }?>

       </ul>
      <ul class="nav navbar-nav navbar-right">
        <!-- <li><a href="#" target='_blank'><i class='glyphicon glyphicon-envelope'></i> Soporte</a></li> -->
        <li><a target='_blank' class="text-uppercase" ><b><?php echo $user_name; ?></b></a></li>
        <li><a target='_blank'></i>   </a></li>
	    	<li><a href="login.php?logout" class="text-uppercase"><i class='glyphicon glyphicon-off'></i> Salir</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
	<?php
		}
	?>