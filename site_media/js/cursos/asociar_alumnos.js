  // definimos la tabla

 var TablaAsociados = $('#table_asociados').DataTable( {

 "language": {
        "url": "../../../public/libs/DataTables-1.10.12/extensions/table-spanish.json"
    },

      'columnDefs': [
  {
      "targets": 0, // your case first column
      "className": "text-left",
       "width": "20%",
 },{
      "targets": 1, // your case first column
      "className": "text-center",
       "width": "30%"
 },{
      "targets": 2, // your case first column
      "className": "text-center",
       "width": "30%"
 },{
      "targets": 3, // your case first column
      "className": "text-center",
       "width": "20%"
 },
 ],
 });

 // definimos la tabla para mostrar los alumnos a asociar

 var Tabla = $('#table_cursos_asociar').DataTable( {

  "scrollY" : "200px",
  "scrollCollapse" : true,
  "paging": false,

    "columnDefs": [
  {
      "targets": 0, // your case first column
      "className": "text-center",
       "width": "20%",
       "orderable": false,
 },{
      "targets": 1, // your case first column
      "className": "text-center",
       "width": "30%",
       "orderable": false,
 },{
      "targets": 2, // your case first column
      "className": "text-center",
       "width": "50%",
       "orderable": false,
 }
 ],

   "language": {
        "url": "../../../public/libs/DataTables-1.10.12/extensions/table-spanish.json"
    },

 });

$(document).ready(function(){

getCursos();


$(document).on("click", ".asociarmodal", function () {

    getAlumnosSA();

    $('#modalAsociar').modal('show');

});

$(document).on("change", "#cursos", function () {

    if(this.value != 0){
      $('#asociar').attr('disabled',false);
      getAlumnosCurso(this.value);
    }else{
      $('#asociar').attr('disabled','disabled');
      alert('debe seleccionar');
      return;
    }
    

});

 $(document).on("click", "#asociarAlumno", function () {
  
 	  var curso = $('#cursos').val();
    curso = curso.split('-');
    curso_id = curso[0];
    meses = curso[1];
    idimporte = curso[2];

    var arreglo = []; // declaramos el arreglo
     // pusheamos dentro del arreglo los alumnos seleccionados o checkeados
     $("input[name='alumnosasoc']:checked").each(function () // recorremos todos
    {
      arreglo.push(($(this).attr("value")));

     }); 

       $.ajax({
            type: "POST",
            url: "../../../app/routes.php",
            dataType: 'text',
            data: {
              peticion : 'asociar_alumnos',
               idcurso : curso_id,
                 meses : meses,
                id_imp : idimporte,
               alumnos : arreglo
            },
            success: function (resp) {

                if(resp == 'ok'){
        
                        toastr.success('Se han asociado los alumnos exitosamente.');

                         setTimeout(function() { 
                            $(location).attr('href', '../cursos/asociar_alumnos.php');
                        }, 1500);

                    }else{

                        toastr.error('Ha ocurrido un error!!!');

                        return false;
                    }

            }
          }); 
       

     });

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

            $('#cursos').append("<option value='"+value.id+"-"+value.meses+"-"+value.id_importe+"'>"+value.descripcion+"</option>");

           
      });

        }
      }); 
};

function getAlumnosSA(){

  Tabla.clear().draw();
  // Tabla.DataTable();

  var idcurso = $('#cursos').val();

	$.ajax({
        type: "POST",
        url: "../../../app/routes.php",
        dataType: 'json',
        data: {
          peticion : 'ver_alumnos_no_asociados',
          idcurso : idcurso
        },
        success: function (resp) {

          var alus = resp;

          

          $.each( alus, function( key, value ) {

            var check = "<input type='checkbox' class='alumnosasoc' value='"+value.id+"' id='alumnosasoc' name='alumnosasoc'>";
             if(value.alu_activo == 'S'){

              Tabla.row.add( [
                check,
                value.dni,
                value.apellido+', '+value.nombre,
                ]).draw();
                
             } 
             

          	// $('#alumnos').append("<option value='"+value.id+"'>"+value.apellido+', '+value.nombre+"</option>");
            
      });

        }
      }); 
}

function getAlumnosCurso(id){

  TablaAsociados.clear().draw();

  var idcurso = id;

  $.ajax({
        type: "POST",
        url: "../../../app/routes.php",
        dataType: 'json',
        data: {
          peticion : 'ver_alumnos_curso',
          idcurso : idcurso
        },
        success: function (resp) {

          var alucurso = resp;

          // console.log(alucurso);

          $.each( alucurso, function( key, value ) {
            TablaAsociados.row.add( [
                value.dni,
                value.nombre,
                value.apellido,
                value.fecha,
                value.anio
                ]).draw();
           
            
          });

        }
      }); 
}