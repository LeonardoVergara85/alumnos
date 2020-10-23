$(document).ready(function() {

//    $("#costo").on({
//     "focus": function (event) {
//         $(event.target).select();
//     },
//     "keyup": function (event) {
//         $(event.target).val(function (index, value ) {
//             return value.replace(/\D/g, "")
//             // .replace(/([0-9])([0-9]{2})$/, '$1,$2')
//             .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ".");
//         });
//     }
// }); 

$("#costo").inputmask("numeric", {
           radixPoint: ",",
           groupSeparator: ".",
           digits: 2,
           autoGroup: true,
           prefix: '$',
           rightAlign: false,
           oncleared: function () { self.Value(''); }
       });

  //validar que el campo sea solo letas
 jQuery.validator.addMethod("lettersonly", function(value, element) {
  return this.optional(element) || /^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/i.test(value);
  }, "Ingresar solo letras"); 

 $('#formulario_cursos').validate({
        submitHandler: function (form) {
        	// cuando va bien

            var nombrecurso = $('#nombrecurso').val();
            var mesescurso = parseInt($('#mesescurso').val());
            var costocurso = $('#costo').val();

            aux = costocurso.split('$');
            costocurso = aux[1];

            costocurso2 = costocurso.replace('.','');
            

            $('#guardarcurso').attr('disabled','disabled');

            $.ajax({
            	type: "POST",
            	url: "../../../app/routes.php",
            	dataType: 'text',
            	data: {

            		peticion : 'guardar_curso',
            		nombrec : nombrecurso,
                    meses : mesescurso,
                    costo : costocurso2

            	},
            	success: function (resp) {

            		if(resp == 'ok'){
        
                        toastr.success('Se ha guardado el curso exitosamente.');

                         setTimeout(function() { 
                            $(location).attr('href', '../cursos/index.php');
                        }, 1500);

                    }else{

                        toastr.error('Ha ocurrido un error!!!');

                        return false;
                    }

            	}
            });	
           
        },
        rules: {
            nombrecurso: {required:true,
                          minlength: 2,
                          // lettersonly: true,
                      },
           
            mesescurso: {
                         required: true,
                         number: true,},  
            // costo: {
            //      required: true,
            //      number: true,
            //     },            
        },
        
        messages: {
            nombrecurso: {
                required: 'Complete este campo',
                minlength: 'ingresar más de 2 caracteres',
            },
        mesescurso: {
                required: 'Complete este campo',
                number: 'Ingresar solo números',
            },
        costo: {
                required: 'Complete este campo',
                number: 'Ingresar solo números',
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