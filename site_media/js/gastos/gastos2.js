$(document).ready(function(){

  buscarTipoGastos();
  buscarTipoPagos();

   //validar que el campo sea solo letas
 jQuery.validator.addMethod("lettersonly", function(value, element) {
  return this.optional(element) || /^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/i.test(value);
  }, "Ingresar solo letras"); 

 $('#formulario_gastos').validate({
        submitHandler: function (form) {
          // cuando va bien

            var tipo_gasto = $('#tipo_gasto').val();
            var importe = $('#importe').val();
            var observaciones = $('#observaciones').val();
            var pagadopor = $('#pagadopor').val();
            var formap = $('#formapago').val();
            var usuario = $('#usuario_id').val();
            var aux = importe.split('$');
            importe = aux[1];

            
            var importe = importe.replace('.','');
            var importe = importe.replace(',','.');
          

            $('#guardargasto').attr('disabled','disabled');

            $.ajax({
              type: "POST",
              url: "../../../app/routes.php",
              dataType: 'text',
              data: {

                peticion : 'guardar_gasto',
                 tipog : tipo_gasto,
                   importe : importe,
                     obs : observaciones,
                     pagado : pagadopor,
                     formapago : formap,
                     usu : usuario

              },
              success: function (resp) {

                if(resp == 'ok'){
        
                        toastr.success('Se ha guardado el gasto exitosamente.');

                         setTimeout(function() { 
                            $(location).attr('href', '../gastos/index.php');
                        }, 1500);

                    }else{

                        toastr.error('Ha ocurrido un error!!!');

                        return false;
                    }

              }
            }); 
           
        },
        rules: {
            tipo_gasto: {required:true,
                        },
           
               importe: {
                         required: true,
                         // number: true,
                       },
         observaciones: {
                         required: true,
                         minlength: 2,
                        },  
        },
        messages: {
            tipo_gasto: {
                        required: 'Complete este campo',
            },
            importe: {
                        required: 'Complete este campo',
                        // number: 'Ingrese solo números',
            },
            observaciones: {
                        required: 'Complete este campo',
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

  // $('#importe').inputmask("99-9999999");
  // $("#importe").inputmask({ alias: "datetime"});
$("#importe").inputmask("numeric", {
           radixPoint: ",",
           groupSeparator: ".",
           digits: 2,
           autoGroup: true,
           prefix: '$',
           rightAlign: false,
           oncleared: function () { self.Value(''); }
       });
  
});

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

           $('#tipo_gasto').append("<option value='"+value.id+"'>"+value.descripcion+"</option>"); 
           
      });

        }
      }); 
}

function buscarTipoPagos(){
  $.ajax({
      type: "POST",
      url: "../../../app/routes.php",
      dataType: 'json',
      data: {
        peticion : 'ver_tipo_pagos',
      },
      success: function (resp) {

        var tipop = resp;

        $.each( tipop, function( key, value ) {

         $('#formapago').append("<option value='"+value.id+"'>"+value.descripcion+"</option>"); 
         
    });

      }
    }); 
}