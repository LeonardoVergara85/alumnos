var f = new Date(); // fecha para mostrar en los archivos de export 
var cursoo = $('#text-curso').val();
var Tabla = $('#table_alumnos').DataTable( {
  dom: 'Bfrtip',

    buttons: [
        {
            extend:    'pdfHtml5',
            text:      '<i class="fa fa-file-pdf"></i>',
            titleAttr: 'PDF',
            message: 'Listado de Alumnos. Fecha de impresión ('+f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear()+')',
            download: 'open',
            title: 'Alumnos',
            
        },
        {
            extend: 'print',
            text:      '<i class="fa fa-print" ></i>',
            titleAttr: 'Imprimir',
            message: 'Listado de productos. Fecha de impresión ('+f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear()+')',
            messageBottom: null,
            title: 'Alumnos',
        }
    ],

 "language": {
        "url": "../../../public/libs/DataTables-1.10.12/extensions/table-spanish.json"
    },

        'columnDefs': [
          {
            "targets": 0, // your case first column
            "visible": false,
        },
        {
            "targets": 1, // your case first column
            "className": "text-center",
              "width": "20%",
        },{
            "targets": 2, // your case first column
            "className": "text-center",
              "width": "60%"
        },{
            "targets": 3, // your case first column
            "className": "text-center",
              "width": "10%"
        },{
            "targets": 4, // your case first column
            "className": "text-center",
              "width": "10%"
        },
    ],
 });


$(document).ready(function(){

	getCursos();

	$(document).on("change", "#cursos", function () {

		if(this.value != 0){

      $('#anio_lectivo').empty();

          $.ajax({
            type: "POST",
            url: "../../../app/routes.php",
            dataType: 'json',
            data: {
              idcurso: $('#cursos').val(),
              peticion : 'ver_anios',
            },
            success: function (resp) {

              var anios = resp;

              $('#anio_lectivo').append("<option value='0'>Seleccionar..</option>");
                $.each( anios, function( key, value ) {

                  $('#anio_lectivo').append("<option value='"+value.anio+"'>"+value.anio+"</option>");

                });

            }
          }); 
      		// getAlumnosCurso(this.value);
  			}else{

  	      	$('#buscar_alumnos').attr('disabled','disabled');
         }

      });

      $(document).on("change", "#anio_lectivo", function () {

        if(this.value != 0){
    
           $('#buscar_alumnos').attr('disabled',false);
  
              // getAlumnosCurso(this.value);
            }else{
    
                $('#buscar_alumnos').attr('disabled','disabled');
             }
    
          });
    //////////////////////////////////////////////////
    //////////////////////////////////////////////////
    //////////////////////////////////////////////////
	$(document).on("click", "#buscar_alumnos", function () {

    var id_curso = $('#cursos').val();
    var text_curso = $('#cursos option:selected').text();
		var anio_lectivo = $('#anio_lectivo').val();

		getCursoAlumnos(id_curso,anio_lectivo,text_curso);
		

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

            $('#cursos').append("<option value='"+value.id+"'>"+value.descripcion+"</option>");

           
      });

        }
      }); 
};

function getCursoAlumnos(id_curso,anio_lectivo,text_curso){

	Tabla.clear().draw();
 
  $('#text-curso').val(text_curso);

	$.ajax({
        type: "POST",
        url: "../../../app/routes.php",
        dataType: 'json',
        data: {
          peticion : 'ver_alumnos_curso',
          idcurso : id_curso,
          anio : anio_lectivo
        },
        success: function (resp) {

          var alumnos = resp;
         
          

           $.each( alumnos, function( key, value ) {
             if(value.alu_activo == 'S'){

              Tabla.row.add( [
                value.descripcion,
                value.dni,
                value.apellido+' '+value.nombre,
                value.fecha,
                value.anio
                ]).draw();

             }
            
          });

        }
      }); 
};
