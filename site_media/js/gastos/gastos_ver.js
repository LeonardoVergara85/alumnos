 var Tabla = $('#table_gastos').DataTable( {
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
      "className": "text-right",
       "width": "10%"
 },{
      "targets": 2, // your case first column
      "className": "text-center",
       "width": "10%"
 },{
      "targets": 3, // your case first column
      "className": "text-left",
       "width": "40%"
 },{
      "targets": 4, // your case first column
      "className": "text-center",
       "width": "10%"
 },
 ],
 });

 var Tabla2 = $('#table_gastos_fecha').DataTable( {

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
      "className": "text-right",
       "width": "10%"
 },{
      "targets": 2, // your case first column
      "className": "text-center",
       "width": "10%"
 },{
      "targets": 3, // your case first column
      "className": "text-left",
       "width": "40%"
 },{
      "targets": 4, // your case first column
      "className": "text-center",
       "width": "10%"
 },
 ],
 });

 var Tabla3 = $('#table_gastos_tipo').DataTable( {

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
      "className": "text-right",
       "width": "10%"
 },{
      "targets": 2, // your case first column
      "className": "text-center",
       "width": "10%"
 },{
      "targets": 3, // your case first column
      "className": "text-left",
       "width": "40%"
 },
 ],
 });

$(document).ready(function(){

 verGastosHoy();

 buscarTipoGastos();

  $('#form-bucarfecha').validate({
        submitHandler: function (form) {
          // cuando va bien

            var fechadesde = $('#fechadesde').val();
            var fechahasta = $('#fechahasta').val();
            

            // $('#guardargasto').attr('disabled','disabled');
            Tabla2.clear().draw();
            $.ajax({
              type: "POST",
              url: "../../../app/routes.php",
              dataType: 'json',
              data: {

                peticion : 'buscar_gasto_fecha',
                 fechad : fechadesde,
                 fechah : fechahasta
              },
              success: function (resp) {


              	var gastos = resp;

              	$.each( gastos, function( key, value ) {

              		var boton = "<button class='btn btn-info btn-sm botonesdetailgastofecha' id='"+value.ID+"' title='detalle del gasto'><i class='fa fa-info-circle' aria-hidden='true'></i></button>"; 
            // var botonx = "<button class='btn btn-danger btn-sm botoneseliminarcurso' id='"+value.id+"' title='eliminar curso'><i class='fa fa-trash' aria-hidden='true'></i></button>"; 

            Tabla2.row.add( [
            	value.DESCRIPCION,
            	value.IMPORTE,
            	value.FECHA,
            	value.OBS,
            	boton
            	]).draw();
        });



              }
            }); 
           
        },
        rules: {
            fechadesde: {required:true,date:true,},
            fechahasta: {required:true,date:true,},
        },
        messages: {
            fechadesde: {
                        required: 'Complete este campo',
                        date: 'Complete dd/mm/aaaa',
            },
            fechahasta: {
                        required: 'Complete este campo',
                        date: 'Complete dd/mm/aaaa',
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



 /// buscamos gastos por tipo de gastos y rango de fecha.///
$.validator.addMethod("valueNotEquals", function(value, element, arg){
  return arg !== value;
 }, "Value must not equal arg.");

  $('#form-bucartipo').validate({
        submitHandler: function (form) {
          // cuando va bien

            var fechadesde = $('#fechadesde_tipo').val();
            var fechahasta = $('#fechahasta_tipo').val();
            var tipo_gasto = parseInt($('#tipo_gasto_tipo').val());
            

            // $('#guardargasto').attr('disabled','disabled');
            Tabla3.clear().draw();
            $.ajax({
              type: "POST",
              url: "../../../app/routes.php",
              dataType: 'json',
              data: {

                peticion : 'buscar_gasto_tipo',
                 fechad : fechadesde,
                 fechah : fechahasta,
                 tipo : tipo_gasto
              },
              success: function (resp) {


              var gastos = resp;

              $.each( gastos, function( key, value ) {

              // var boton = "<button class='btn btn-info btn-sm botonesdetailgastofecha' id='"+value.ID+"' title='detalle del gasto'><i class='fa fa-info-circle' aria-hidden='true'></i></button>"; 
              // var botonx = "<button class='btn btn-danger btn-sm botoneseliminarcurso' id='"+value.id+"' title='eliminar curso'><i class='fa fa-trash' aria-hidden='true'></i></button>"; 

              Tabla3.row.add( [
              value.DESCRIPCION,
              value.IMPORTE,
              value.FECHA,
              value.OBS
              ]).draw();
        });



            }
          }); 
           
        },
        rules: {
            fechadesde_tipo: {required:true,date:true,},
            fechahasta_tipo: {required:true,date:true,},
            tipo_gasto_tipo: {required:true,valueNotEquals: "default"},
        },
        messages: {
            fechadesde_tipo: {
                        required: 'Complete este campo',
                        date: 'Complete dd/mm/aaaa',
            },
            fechahasta_tipo: {
                        required: 'Complete este campo',
                        date: 'Complete dd/mm/aaaa',
            },
            tipo_gasto_tipo: {
                        required: 'Complete este campo',
                         valueNotEquals: "Por favor seleccione un tipo de gasto",
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





    //validar que el campo sea solo letas
 jQuery.validator.addMethod("lettersonly", function(value, element) {
  return this.optional(element) || /^[ a-z]+$/i.test(value);
  }, "Ingresar solo letras"); 

 $('#formulario_mod_gastos').validate({
        submitHandler: function (form) {
          // cuando va bien

            var tipo_gasto = $('#tipo_gasto_').val();
            var importe = $('#importe_').val();
            var observaciones = $('#observaciones_').val();
            var pagadopor = $('#pagadopor_').val();
            var idg = $('#modificargasto').val();
            

            $('#modificargasto').attr('disabled','disabled');

            $.ajax({
              type: "POST",
              url: "../../../app/routes.php",
              dataType: 'text',
              data: {

                peticion : 'mod_gasto',
                 idg : idg,
                 tipog : tipo_gasto,
                   importe : importe,
                     obs : observaciones,
                     pagado : pagadopor

              },
              success: function (resp) {

                if(resp == 'ok'){
        
                        toastr.success('Se ha modificado el gasto exitosamente.');

                         setTimeout(function() { 
                            $(location).attr('href', '../gastos/gastos_ver.php');
                        }, 1500);

                    }else{

                        toastr.error('Ha ocurrido un error!!!');

                        return false;
                    }

              }
            }); 
           
        },
        rules: {
            tipo_gasto_: {required:true,
                        },
           
               importe_: {
                         required: true,
                         number: true,},
         observaciones_: {
                         required: true,
                         minlength: 2,
                        lettersonly: true,},  
        },
        messages: {
            tipo_gasto_: {
                        required: 'Complete este campo',
            },
            importe_: {
                        required: 'Complete este campo',
                        number: 'Ingrese solo números',
            },
            observaciones_: {
                        required: 'Complete este campo',
                        lettersonly: 'Ingrese solo letras',
                        minlength: 'ingrese más caracteres',
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


  $(document).on("click", ".botonesdetailgasto", function () {

          var idg = this.id;

          $.ajax({
            type: "POST",
            url: "../../../app/routes.php",
            dataType: 'json',
            data: {
              peticion : 'ver_gasto',
               idgasto : idg
            },
            success: function (resp) {

              var cursos = resp;

              $.each( cursos, function( key, value ) {

                $('#tipo_gasto_').val(value.ID_TIPO_GASTO);
                $('#importe_').val(value.IMPORTE);
                $('#observaciones_').val(value.OBS);
                $('#pagadopor_').val(value.PAGOPOR);

                $('#modificargasto').val(value.ID);
              });

              $('#modalDetalleGasto').modal('show');
            }
          }); 

        });  

  $(document).on("click", ".botonesdetailgastofecha", function () {

          var idg = this.id;

          $.ajax({
            type: "POST",
            url: "../../../app/routes.php",
            dataType: 'json',
            data: {
              peticion : 'ver_gasto',
               idgasto : idg
            },
            success: function (resp) {

              var cursos = resp;

              $.each( cursos, function( key, value ) {

                $('#tipo_gasto_').val(value.ID_TIPO_GASTO);
                $('#importe_').val(value.IMPORTE);
                $('#observaciones_').val(value.OBS);
                $('#pagadopor_').val(value.PAGOPOR);

                $('#modificargasto').val(value.ID);
              });

              $('#modalDetalleGasto').modal('show');
            }
          }); 

        });

});

function verGastosHoy(){
  var total = 0;
	$.ajax({
        type: "POST",
        url: "../../../app/routes.php",
        dataType: 'json',
        data: {
          peticion : 'ver_gastos_hoy',
        },
        success: function (resp) {

          var gastoshoy = resp;          

          $.each( gastoshoy, function( key, value ) {

            var imp = value.IMPORTE.replace('.','');
            var imp = imp.replace(',','.');

            var boton = "<button class='btn btn-info btn-sm botonesdetailgasto' id='"+value.ID+"' title='detalle del gasto'><i class='fa fa-info-circle' aria-hidden='true'></i></button>"; 
            // var botonx = "<button class='btn btn-danger btn-sm botoneseliminarcurso' id='"+value.id+"' title='eliminar curso'><i class='fa fa-trash' aria-hidden='true'></i></button>"; 

            Tabla.row.add( [
                value.DESCRIPCION,
                value.IMPORTE,
                value.FECHA,
                value.OBS,
                boton
                ]).draw();

            total = parseFloat(total)+parseFloat(imp);
       });

        
          
        $('#tot').val(total);
      }

      }); 

} 

function buscarTipoGastos(){
    $.ajax({
        type: "POST",
        url: "../../../app/routes.php",
        dataType: 'json',
        data: {
          peticion : 'ver_tipo_gastos',
        },
        success: function (resp) {

          var tipog = resp;

          $.each( tipog, function( key, value ) {

           $('#tipo_gasto_').append("<option value='"+value.id+"'>"+value.descripcion+"</option>"); 
           $('#tipo_gasto_tipo').append("<option value='"+value.id+"'>"+value.descripcion+"</option>"); 
           
      });

        }
      }); 
}

