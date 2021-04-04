


$("#datos_seguimiento").submit(function(event){
  var id_cliente = $("#id_cliente").val();

  if (id_cliente==""){
      alert("Debes seleccionar un cliente");
      $("#nombre_cliente").focus();
      return false;
  }
    var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "ajax/editar_seguimiento.php",
            data: parametros,
             beforeSend: function(objeto){
                $(".editar_seguimiento").html("Mensaje: Cargando...");
              },
            success: function(datos){
                $(".editar_seguimiento").html(datos);
            }
    });
    
     event.preventDefault();
 });


