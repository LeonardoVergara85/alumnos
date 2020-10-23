$(document).ready(function(){

   
//	$('#msj_respaldo').modal('show');
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