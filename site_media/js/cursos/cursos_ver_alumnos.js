var Tabla = $('#table_alumnos').DataTable( {
  dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ],
  
  "order": [[ 1, "desc" ]],

 "language": {
        "url": "../../../public/libs/DataTables-1.10.12/extensions/table-spanish.json"
    },

      'columnDefs': [
  {
      "targets": 0, // your case first column
      "className": "text-center",
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
		var anio_lectivo = $('#anio_lectivo').val();
    // alert(anio_lectivo);
    // return;
    if((anio_lectivo == '') || (anio_lectivo.length < 4) || (anio_lectivo < '1900') || (anio_lectivo > '2030')){
      alert('debe ingresar el año lectivo correcto!');
      return false;
    }


		getCursoAlumnos(id_curso,anio_lectivo);
		

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

function getCursoAlumnos(id_curso,anio_lectivo){

	Tabla.clear().draw();

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
                value.dni,
                value.nombre,
                value.apellido,
                value.fecha,
                value.anio
                ]).draw();

             }
            
          });

        }
      }); 
};
