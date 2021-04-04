$(document).ready(function(){
    load(1);
    
});

function load(page){
    var q= $("#q").val();
    $("#loader").fadeIn('slow');
    $.ajax({
        url:'./ajax/buscar_seguimientos.php?action=ajax&page='+page+'&q='+q,
         beforeSend: function(objeto){
         $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
      },
        success:function(data){
         
            $(".outer_div").html(data).fadeIn('slow');
            $('#loader').html('');      
        }
    })
}


    function eliminar (id)
{
var q= $("#q").val();
if (confirm("Realmente deseas eliminar este seguimiento")){	
$.ajax({
type: "GET",
url: "./ajax/buscar_seguimientos.php",
data: "id="+id,"q":q,
 beforeSend: function(objeto){
    $("#resultados").html("Mensaje: Cargando...");
   
  },
success: function(datos){
window.location.reload();
$("#resultados").html(datos);
load(1);

}
    });
}



}





$( "#guardar_seguimiento" ).submit(function( event ) {
$('#guardar_datos').attr("disabled", true);

var parametros = $(this).serialize();
$.ajax({
    type: "POST",
    url: "ajax/nuevo_seguimiento.php",
    data: parametros,
     beforeSend: function(objeto){
        $("#resultados_ajax_seguimiento").html("Mensaje: Cargando...");
      },
    success: function(datos){
    
    $("#resultados_ajax_seguimiento").html(datos);
    $('#guardar_datos').attr("disabled", false);
    load(1);
    
  }
});
event.preventDefault();
})

$( "#editar_seguimiento" ).submit(function( event ) {
$('#actualizar_datos').attr("disabled", true);

var parametros = $(this).serialize();
$.ajax({
    type: "POST",
    url: "ajax/editar_seguimiento.php",
    data: parametros,
     beforeSend: function(objeto){
        $("#resultados_ajax2").html("Mensaje: Cargando...");
      },
    success: function(datos){
    $("#resultados_ajax2").html(datos);
    $('#actualizar_datos').attr("disabled", false);
    load(1);
  }
});
event.preventDefault();
})

//  function obtener_datos(id){
//    var Nombre_seguimiento = $("#Nombre_seguimiento"+id).val();
//     var Envio_proto_pre = $("#Envio_proto_pre"+id).val();
    // var descripcion_servicio = $("#descripcion_servicio"+id).val();
    // var descuento_servicio = $("#descuento_servicio"+id).val();
    // var precio_producto = $("#precio_producto"+id).val();


//     $("#mod_id").val(id);
//     $("#mod_codigo").val(codigo_producto);
//     $("#mod_codigo_unidad").val(codigo_unidad_servicio);
//     $("#mod_descripcion").val(descripcion_servicio);
//     $("#mod_descuento").val(descuento_servicio);
//     $("#mod_precio").val(precio_producto);
// }


