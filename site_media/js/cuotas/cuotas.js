// definimos la tabla para mostrar los cursos

var Tabla = $('#table_cuotas').DataTable( {
       
"language": {
       "url": "../../../public/libs/DataTables-1.10.12/extensions/table-spanish.json"
   },

     'columnDefs': [
 {
     "targets": 0, // your case first column
     "className": "text-left",
      "width": "5%",
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
}
],
});


$(document).ready(function() {

    verSetCuotas();

});

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

          

          $.each( setcuotas, function( key, value ) {

            var mes = '';

            switch (value.mes) {
                case '1':
                  mes = "Enero";
                  break;
                case '2':
                  mes = "Febrero";
                  break;
                case '3':
                    mes = "Marzo";
                  break;
                case '4':
                    mes = "Abril";
                  break;
                case '5':
                    mes = "Mayo";
                  break;
                case '6':
                    mes = "Junio";
                  break;
                case '7':
                    mes = "Julio";
                break;  
                case '8':
                    mes = "Agosto";
                break; 
                case '9':
                    mes = "Septiembre";
                break;  
                case '10':
                    mes = "Octubre";
                break;  
                case '11':
                    mes = "Noviembre";
                break;   
                case '12':
                    mes = "Diciembre";
                break;  
              }   

            Tabla.row.add( [
                value.id,
                mes,
                value.dia,
                value.fecha
                ]).draw();
      });

        }
      }); 
} 