$(document).ready(function() {

    anioLectivo();

    $(document).on("click", "#renovar_anio_lectivo", function () {

        $('#modalRenovarAnio').modal('show');
    });


    $(document).on("click", "#btnrenovarAnio", function () {

       
        $.ajax({
            type: "POST",
            url: "../../../app/routes.php",
            dataType: 'text',
            data: {
                peticion : 'renovar_cursos',
            },
            success: function (resp) {

                
              if(resp == 'ok'){

                  $('#modalRenovarAnio').modal('hide');
  
                  toastr.success('Se ha renovado el año lectivo exitosamente.');

                   setTimeout(function() { 
                      $(location).attr('href', '../cursos/anio_lectivo.php');
                  }, 1500);

              }else if(resp == 'no_renovar'){

                toastr.error('!El año lectivo no se puede renovar hasta no terminar el actual!');

                  return false;
              }
              else{

                  toastr.error('Ha ocurrido un error!!!');

                  return false;
              }

            }
        }); 

    });


});


function anioLectivo(){

    $.ajax({
        type: "POST",
        url: "../../../app/routes.php",
        dataType: 'text',
        data: {
            peticion : 'anio_lectivo',
        },
        success: function (resp) {


         if(resp != null){

            $("#mensaje-anio").html("<b>¡Atención!</b> El año lectivo es <b>"+resp+"</b>");

         }else{

            $("#mensaje-anio").html("<b>¡Atención!</b> Se debe crear un curso");

         }

        }
    });
}