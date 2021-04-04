<style type="text/css">
<!--
table { vertical-align: top; }
tr    { vertical-align: top; }
td    { vertical-align: top; }
.midnight-blue{
	background:#2c3e50;
	padding: 4px 4px 4px;
	color:white;
	font-weight:bold;
	font-size:12px;
}
.silver{
	background:white;
	padding: 3px 4px 3px;
}
.clouds{
	background:#ecf0f1;
	padding: 3px 4px 3px;
}
.border-top{
	border-top: solid 1px #bdc3c7;
	
}
.border-left{
	border-left: solid 1px #bdc3c7;
}
.border-right{
	border-right: solid 1px #bdc3c7;
}
.border-bottom{
	border-bottom: solid 1px #bdc3c7;
}
table.page_footer {width: 100%; border: none; background-color: white; padding: 2mm;border-collapse:collapse; border: none;}
}
-->
</style>
<page backtop="15mm" backbottom="15mm" backleft="15mm" backright="15mm" style="font-size: 12pt; font-family: arial" >
        <page_footer>
        <table class="page_footer">
            <tr>

                <td style="width: 50%; text-align: left">
                    P&aacute;gina [[page_cu]]/[[page_nb]]
                </td>
                <td style="width: 50%; text-align: right">
                    &copy; <?php echo "Best Reference SA de CV "; echo  $anio=date('Y'); ?>
                </td>
            </tr>
        </table>
    </page_footer>
    <table cellspacing="0" style="width: 100%;">
        <tr>

            <td style="width: 25%; color: #444444;">
                <img style="width: 100%;" src="../../img/a.png" alt="Logo"><br>
                
            </td>
			<td style="width: 50%; color: #34495e;font-size:12px;text-align:center">
                <span style="color: #34495e;font-size:14px;font-weight:bold"><?php echo NOMBRE_EMPRESA;?></span>
				<br><?php echo DIRECCION_EMPRESA;?><br> 
				Teléfono: <?php echo TELEFONO_EMPRESA;?><br>
				Email: <?php echo EMAIL_EMPRESA;?>
                
            </td>
			<td style="width: 25%;text-align:right">

			<?php 
				$sql=mysqli_query($con,"select * from emisor ");
				$rw_cliente=mysqli_fetch_array($sql);
				$Numero_factura = $rw_cliente['Numero_factura'];
				$Numero_factura_nuevo = $Numero_factura + 1;
				$sql=mysqli_query($con,"UPDATE emisor SET Numero_factura='".$Numero_factura_nuevo."'");

			?>


			FACTURA Nº <?php echo $Numero_factura_nuevo ;?>
			
			


			</td>
			











        </tr>
    </table>

    <br>
    
    
	<table cellspacing="0" style="width: 100%; text-align: left; font-size: 9pt; line-height: 150% ">
        <tr>
           <td style="width:40%; text-align: center; " class='midnight-blue' >FACTURAR A</td>
		   <td style="width:20%;"></td>
		   <td style="width:40%; text-align: center;" class='midnight-blue'>EMISOR DE LA FACTURA</td>

        </tr>
		<tr>
           <td style="width:40%;" >
			<?php 
				$sql_cliente=mysqli_query($con,"select * from inf_cliente where id_cliente='$id_cliente'");
				$rw_cliente=mysqli_fetch_array($sql_cliente);

				/* $domicilio =  "Calle: ".$rw_cliente['Calle_cliente']." No.Ext: ".$rw_cliente['Exter_cliente'].
										" No.Int: ".$rw_cliente['Inter_cliente'].", Col: ".$rw_cliente['Colonia_cliente'].
										", CP: ".$rw_cliente['Postal_cliente'].", ".$rw_cliente['Localidad_cliente'].
										", ".iconv('iso-8859-1','utf-8',$rw_cliente['estado']).", ".iconv('iso-8859-1','utf-8',$rw_cliente['pais']); */
		

				$domicilio =  "Calle: ".$rw_cliente['Calle_cliente']." No. ".$rw_cliente['Exter_cliente'];

				if(!empty($rw_cliente['Inter_cliente']))
				$domicilio .= " Int. ".$rw_cliente['Inter_cliente'];
				
				$domicilio .= ", Col: ".$rw_cliente['Colonia_cliente'].
										", CP: ".$rw_cliente['Postal_cliente'].", ".$rw_cliente['Localidad_cliente'].
										", ".iconv('iso-8859-1','utf-8',$rw_cliente['estado']).", ".iconv('iso-8859-1','utf-8',$rw_cliente['pais'].".");
				
				echo "<br> <b>Empresa: </b>";
				echo $rw_cliente['Razon_cliente'];
				echo "<br> <b>RFC: </b>";
				echo  $rw_cliente['RFC_cliente'];
				/* echo $rw_cliente['Nombre_cliente']." ".$rw_cliente['Apellido_cliente']; */
				echo "<br> <b>Domicilio fiscal: </b>";
				echo $domicilio;
				echo "<br> <b>Teléfono: </b>";
				echo $rw_cliente['Telefono_cliente'];
				echo "<br> <b>Email: </b>";
				echo $rw_cliente['Email_cliente'];
			?>
			
		   </td>

		   <td style="width:20%;" ></td>

           <td style="width:40%;" >
			
				<?php
				echo "<br> <b>Vendedor: </b>";
				echo NOMBRE_EMPRESA;
				echo "<br> <b>RFC: </b>";
				echo  RFC_EMPRESA;
				echo "<br> <b>Folio: </b>102    <b>Serie: </b>A" ;
				echo "<br> <b>No. de serie del CSD: </b>" ;
				echo  SERIE_CSD;
				
				echo "<br> <b>Fecha: </b>";
				echo date("d/m/Y");
				echo "<br> <b>Regimen fiscal: </b>";
				echo  REGIMEN_FISCAL;
				echo "<br> <b>Forma de pago: </b>";
				
				if ($condiciones==1){echo "Efectivo";}
				elseif ($condiciones==2){echo "Cheque";}
				elseif ($condiciones==3){echo "Transferencia bancaria";}
				elseif ($condiciones==4){echo "Crédito";}
				
			?>
			
		   </td>




        </tr>
        
   
    </table>





	<br>
    <br>
	<div style="font-size:11pt;text-align:center;font-weight:bold">Conceptos</div>
	<br>
	<br>




  
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 9pt;">
        <tr>

            <th style="width: 7%;text-align:center" class='midnight-blue'>CANT.</th>
			<th style="width: 12%;text-align:center" class='midnight-blue'>CLAVE DEL SERVICIO</th>
			<th style="width: 12%;text-align:center" class='midnight-blue'>CLAVE DE UNIDAD</th>
			<th style="width: 10%;text-align:center" class='midnight-blue'>%DESC</th>
            <th style="width: 30%" class='midnight-blue'>DESCRIPCION</th>
            <th style="width: 15%;text-align: right" class='midnight-blue'>PRECIO UNIT.</th>
            <th style="width: 15%;text-align: right" class='midnight-blue'>PRECIO TOTAL</th>
            
        </tr>

<?php
$nums=1;
$sumador_total=0;
$descuento_total = 0;
$sql=mysqli_query($con, "select * from servicios, tmp where servicios.id_producto=tmp.id_producto and tmp.session_id='".$session_id."'");
while ($row=mysqli_fetch_array($sql))
	{
	$id_tmp=$row["id_tmp"];
	$codigo_producto_unidad=$row["codigo_unidad_servicio"];
	$id_producto=$row["id_producto"];
	$codigo_producto=$row['codigo_producto'];
	$cantidad=$row['cantidad_tmp'];
	$nombre_producto=$row['nombre_producto'];
	$desc=$row['descuento_tmp'];
	
	$precio_venta=$row['precio_tmp'];
	$precio_venta_f=number_format($precio_venta,2);//Formateo variables
	$precio_venta_r=str_replace(",","",$precio_venta_f);//Reemplazo las comas
	$precio_total=$precio_venta_r*$cantidad;
	$precio_total_f=number_format($precio_total,2);//Precio total formateado
	$precio_total_r=str_replace(",","",$precio_total_f);//Reemplazo las comas
	$sumador_total+=$precio_total_r;//Sumador

	$descuento=intval($desc);
	$descuento_subtotal = $precio_total * $descuento/100 ;
	$descuento_total += $descuento_subtotal;


	if ($nums%2==0){
		$clase="clouds";
	} else {
		$clase="silver";
	}
	?>

        <tr>
			<td class='<?php echo $clase;?>' style="width: 7%; text-align: center"><?php echo $cantidad; ?></td>
			<td class='<?php echo $clase;?>' style="width: 12%; text-align: center"><?php echo $codigo_producto; ?></td>
			<td class='<?php echo $clase;?>' style="width: 12%; text-align: center"><?php echo $codigo_producto_unidad;?></td>
            <td class='<?php echo $clase;?>' style="width: 10%; text-align: center"><?php echo $desc; ?>%</td>
            <td class='<?php echo $clase;?>' style="width: 30%; text-align: left"><?php echo $nombre_producto;?></td>
            <td class='<?php echo $clase;?>' style="width: 15%; text-align: right"><?php echo $precio_venta_f;?></td>
            <td class='<?php echo $clase;?>' style="width: 15%; text-align: right"><?php echo $precio_total_f;?></td>
            
        </tr>

	<?php 
	//Insert en la tabla detalle_cotizacion
	$insert_detail=mysqli_query($con, "INSERT INTO detalle_factura VALUES ('','$Numero_factura_nuevo','$id_producto','$cantidad','$precio_venta_r','$desc')");
	
	$nums++;
	}

	
	$subtotal=number_format($sumador_total,2,'.','');
	$total_iva= $subtotal * TAX /100;
	$total_iva=number_format($total_iva,2,'.','');
	$total_factura=$subtotal+$total_iva-$descuento_total;


?>


	  
        <tr>
            <td colspan="6" style="widtd: 85%; text-align: right;">SUBTOTAL &#36; </td>
            <td style="widtd: 15%; text-align: right;"> <?php echo number_format($subtotal,2);?></td>
        </tr>

		<tr>
		<td colspan="6" style="widtd: 85%; text-align: right;">DESCUENTO  &#36; </td>
		<td style="widtd: 15%; text-align: right;">- <?php echo number_format($descuento_total,2);?></td>
		</tr>

		<tr>
            <td colspan="6" style="widtd: 85%; text-align: right;">IVA (<?php echo TAX; ?>)% &#36; </td>
            <td style="widtd: 15%; text-align: right;"> <?php echo number_format($total_iva,2);?></td>
        </tr><tr>
            <td colspan="6" style="widtd: 85%; text-align: right;">TOTAL &#36; </td>
            <td style="widtd: 15%; text-align: right;"> <?php echo number_format($total_factura,2);?></td>
        </tr>
    </table>
	
	
	
	<br>
	<div style="font-size:11pt;text-align:center;font-weight:bold">Gracias por su preferencia!</div>
	
	
	  

</page>

<?php
$date=date("Y-m-d H:i:s");
$insert=mysqli_query($con,"INSERT INTO facturas VALUES ('','$Numero_factura_nuevo','$date','$id_cliente','$id_vendedor','$condiciones','$total_factura','1')");
$delete=mysqli_query($con,"DELETE FROM tmp WHERE session_id='".$session_id."'");
?>