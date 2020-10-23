$(document).ready(function(){

getCursos();
// getAlumnos();

});

function getCursos(){
	$.ajax({
        type: "POST",
        url: "../../../app/routes.php",
        dataType: 'json',
        data: {
          peticion : 'ver_cursos',
        },
        success: function (resp) {

          var cursos = resp;

          

          $.each( cursos, function( key, value ) {

            $('#cursos').append("<option value='"+value.id+"'>"+value.descripcion+"</option>");

           
      });

        }
      }); 
};

function getAlumnos(){
  $.ajax({
        type: "POST",
        url: "../../../app/routes.php",
        dataType: 'json',
        data: {
          peticion : 'ver_alumnos',
        },
        success: function (resp) {

          var alus = resp;

          

          $.each( alus, function( key, value ) {

            $('#alumnos').append("<option value='"+value.id+"'>"+value.apellido+', '+value.nombre+"</option>");
            
      });

        }
      }); 
}

