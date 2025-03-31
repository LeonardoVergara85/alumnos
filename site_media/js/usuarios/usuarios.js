 
 var Tabla = $('#table_usuarios').DataTable( {

 "language": {
	    "url": "../../../public/libs/DataTables-1.10.12/extensions/table-spanish.json"
	},

      'columnDefs': [
  {
      "targets": 0, // your case first column
      "className": "text-left",
       "width": "10%",
        "visible": false
 },{
      "targets": 1, // your case first column
      "className": "text-center",
       "width": "15%"
 },{
      "targets": 2, // your case first column
      "className": "text-center",
       "width": "25%"
 },{
      "targets": 3, // your case first column
      "className": "text-center",
       "width": "25%"
 },{
      "targets": 4, // your case first column
      "className": "text-center",
       "width": "20%"
 },{
      "targets": 5, // your case first column
      "className": "text-center",
       "width": "15%"
 },
 ],
 });

$(document).ready(function() {

 getUsuarios();

 getBackup();
});


   


function getUsuarios(){

	Tabla.clear().draw();

	$.ajax({

		type: "POST",
		url: "../../../app/routes.php",
		dataType: 'json',
		data: {
			peticion: 'ver_usuarios'	
		},
		success: function (resp) {

			// console.log(resp);

			var usus = resp;

			$.each( usus, function( key, value ) {

				Tabla.row.add( [
		            // secc.SEC_CODIGO + ' - ' + secc.SEC_DESCRIPCION,
		            '<td style="display: none;">'+value.id+'</td>',
		            value.dni,
		            value.nombre,
		            value.apellido,
		            value.tipo_usuario,
		            value.fecha_carga
	          	]).draw();
				// $('#cuerpoTablaUsu').append('<tr><td style="display: none;">'+value.id+'</td><td>'+value.dni+'</td><td>'+value.nombre+'</td><td>'+value.apellido+'</td><td>'+value.tipo_usuario+'</td></tr>');
			});

			

		}

  	});
}

function getBackup(){


	$.ajax({

		type: "POST",
		url: "../../../app/routes.php",
		dataType: 'json',
		data: {
			peticion: 'backup'	
		},
		success: function (resp) {

			// console.log(resp);

		//	var usus = resp;

		}

  	});
}