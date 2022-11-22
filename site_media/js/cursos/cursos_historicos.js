 var TablaH = $('#table_historico').DataTable( {
  dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ],
    
        "aaSorting": [],

 "language": {
        "url": "../../../public/libs/DataTables-1.10.12/extensions/table-spanish.json"
    },

      'columnDefs': [
  {
      "targets": 0, // your case first column
      "className": "text-center",
       "width": "70%",
 },{
      "targets": 1, // your case first column
      "className": "text-center",
       "width": "20%"
 },{
      "targets": 2, // your case first column
      "className": "text-center",
       "width": "10%"
 },
 ],
 });


$(document).ready(function(){

	getCursos();

	$(document).on("change", "#cursos", function () {

		if(this.value != 0){
		 	$('#buscar_hist').attr('disabled',false);
      		// getAlumnosCurso(this.value);
  			}else{
  	      	$('#buscar_hist').attr('disabled','disabled');
         }

      });
    //////////////////////////////////////////////////
    //////////////////////////////////////////////////
    //////////////////////////////////////////////////
	$(document).on("click", "#buscar_hist", function () {

		var id_curso = $('#cursos').val();

		getCursoHistorico(id_curso);
		

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

function getCursoHistorico(id_curso){

	TablaH.clear().draw();

	$.ajax({
        type: "POST",
        url: "../../../app/routes.php",
        dataType: 'json',
        data: {
          peticion : 'ver_historico',
          curso : id_curso
        },
        success: function (resp) {

          var cursoshist = resp;
         
          

          $.each( cursoshist, function( key, value ) {

          	var v = '';
   
          	if(value.vigente == 'S'){
          		v = '<span class="badge badge-success">Si</span>';
          	}else{
          		v = '<span class="badge badge-danger">No</span>';
          	}

           TablaH.row.add( [
                value.importe,
                value.fechaimp,
                v,
                ]).draw();

           
      });

        }
      }); 
};
