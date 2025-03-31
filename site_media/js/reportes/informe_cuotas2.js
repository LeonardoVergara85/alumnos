 
 var TablaCuotas = $('#table_cuotas_informe').DataTable( {

  dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ],

 "language": {
        "url": "../../../public/libs/DataTables-1.10.12/extensions/table-spanish.json"
    },

      'columnDefs': [
  {
      "targets": 0, // your case first column
      "className": "text-left",
       "width": "30%",
 },{
      "targets": 1, // your case first column
      "className": "text-center",
       "width": "30%"
 },{
      "targets": 2, // your case first column
      "className": "text-center",
       "width": "20%"
 },{
      "targets": 3, // your case first column
      "className": "text-center",
       "width": "20%"
 },{
      "targets": 4, // your case first column
      "className": "text-center",
       "width": "20%"
 }
 ],
 });

$(document).ready(function(){

    const hoy = new Date(); // crea un objeto Date con la fecha actual
    const dia = hoy.getDate().toString().padStart(2, '0'); // obtiene el día del mes con dos cifras (del 01 al 31)
    const mes = (hoy.getMonth() + 1).toString().padStart(2, '0'); // obtiene el mes con dos cifras (del 01 al 12)
    const anio = hoy.getFullYear(); // obtiene el año con 4 dígitos
    
    const fechaHoy = `${anio}-${mes}-${dia}`; // crea una cadena con la fecha de hoy en formato aaaa-mm-dd

    $('#div-spinner').hide();
    $('#fechahasta_cuota').val(fechaHoy);

		$.validator.addMethod("valueNotEquals", function(value, element, arg){
			return arg !== value;
		}, "Value must not equal arg.");

	 $('#form-bucar_cuotas').validate({
        submitHandler: function (form) {
          // cuando va bien
            $('#div-spinner').show();

            var desde = $('#fechadesde_cuota').val();
            var hasta = $('#fechahasta_cuota').val();
            var tipo = $('#tipob').val();

            TablaCuotas.clear().draw();
            
            $.ajax({
              type: "POST",
              url: "../../../app/routes.php",
              dataType: 'json',
              data: {
                peticion : 'buscar_cuotas',
                    fdesde : desde,
                   fhasta : hasta,
                   tipo : tipo
              },
              success: function (resp) {

              	var cuotas = resp;

              	$.each(cuotas, function( key, value ) {

              		var estado = "";
              		
              		if(value.fecha_pago == '0000-00-00'){

              			estado = "<font color='red'>Impaga</font>";

              		}else{

              			estado = "<font color='green'>Pagada</font>";	

              		}

	                TablaCuotas.row.add( [
	            	value.apellido+', '+value.nombre,
	            	value.curso,
	            	'Cuota: '+value.nro_cuota,
                value.fecha_vencimiento,
	            	value.fechapago,
	            	value.importe,
	            	estado
	            	]).draw();

        		});

                $('#div-spinner').hide();


              }

            }); 
           
        },

        rules: {
            fechadesde_cuota: {required:true,date:true,},
            fechahasta_cuota: {required:true,date:true,},
            tipob: {required:true,valueNotEquals: "default",},
            
        },
        messages: {
            fechadesde_cuota: {
                        required: 'Complete este campo',
                        date: 'Complete dd/mm/aaaa',
            },
            fechahasta_cuota: {
                        required: 'Complete este campo',
                        date: 'Complete dd/mm/aaaa',
            },
            tipob: {
                        required: 'Complete este campo',
                        valueNotEquals: 'Seleccione un opción de búsqueda',
            },
           
        },
        errorElement: 'span',
        errorClass: 'help-block',
        highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        invalidHandler: function (event, validator) {
            toastr.error('Compruebe los campos');
        },
    });

});