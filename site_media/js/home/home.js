$(document).ready(function(){

  anioLectivo();
  verSetCuotas();
//	$('#msj_respaldo').modal('show');

$(document).on("click", "#btn-alu-in", function () {

  window.location.href = '../cursos/asociar_alumnos.php';
});


$(document).on("click", "#btn-alu", function () {

    window.location.href = '../alumnos/alumnos_ver.php';
  });
  
  $(document).on("click", "#btn-cur", function () {

    window.location.href = '../cursos/cursos_ver.php';
  });

  $(document).on("click", "#btn-gas", function () {

    window.location.href = '../gastos/gastos_ver.php';
  });

  $(document).on("click", "#btn-cuo", function () {

    window.location.href = '../reportes/informe_cuotas.php';
  });

});

function anioLectivo(){

  $.ajax({
      type: "POST",
      url: "../../../app/routes.php",
      dataType: 'text',
      data: {
          peticion : 'anio_lectivo_',
      },
      success: function (resp) {


       if(resp == 'actualizado'){

          $('#div-msj-error').html('<div class="alert alert-success" role="alert"><i class="far fa-check-circle"></i> El sistema ha detectado que su año lectivo está <b>Actualizado</b></div>');
          $('#div-msj-error').show();

       }else if(resp == 'noactualizado'){

        $('#msj_anio').modal('show');
        $('#div-msj-error').html('<div class="alert alert-warning" role="alert"><i class="fas fa-exclamation-triangle"></i> El sistema ha detectado que se debe renovar el año lectivo <b>Configuraciones / Año lectivo</b></div>');
         $('#div-msj-error').show();
       }

      }
  });
}

function verSetCuotas(){

	$.ajax({
        type: "POST",
        url: "../../../app/routes.php",
        dataType: 'json',
        data: {
          peticion : 'ver_set_cuotas',
        },
        success: function (resp) {

          var setcuotas = resp;
          if(setcuotas.length == 0){

            $('#div-msj-error-cuotaset').show();

          }else{

            $('#div-msj-error-cuotaset').hide();

          }

        }

      }); 
} 