 
 // definimos la tabla para mostrar los alumnos

 var Tabla = $('#table_alumnos').DataTable( {

 "language": {
        "url": "../../../public/libs/DataTables-1.10.12/extensions/table-spanish.json"
    },

      'columnDefs': [
  {
      "targets": 0, // your case first column
      "className": "text-left",
       "width": "20%",
        "visible": false
 },{
      "targets": 1, // your case first column
      "className": "text-center",
       "width": "20%"
 },{
      "targets": 2, // your case first column
      "className": "text-center",
       "width": "20%"
 },{
      "targets": 3, // your case first column
      "className": "text-center",
       "width": "20%"
 },
 ],
 });


$(document).ready(function() {

 document.getElementById('formulario_alumnos').setAttribute( 'autocomplete', 'off' );   

 //validar que el campo sea solo letas
 jQuery.validator.addMethod("lettersonly", function(value, element) {
  return this.optional(element) || /^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/i.test(value);
  }, "Ingresar solo letras"); 

 $('#formulario_alumnos').validate({
        submitHandler: function (form) {
        	// cuando va bien

              
            var documento = $('#documento').val();
            var nombre = $('#nombre').val();
            var apellido = $('#apellido').val();
            var domicilio = $('#domicilio').val();
            var telefono = $('#telefono').val();
            var celular = $('#celular').val();
            var nacimiento = $('#nacimiento').val();
            var escuela = $('#escuela').val();
            var grado_anio = $('#gradoanio').val();
            var email = $('#email').val();
        	var hermanos = $('#hermanos').is(':checked') ? 1 : 0;
            var validar;

            $.ajax({
                type: "POST",
                url: "../../../app/routes.php",
                dataType: 'text',
                data: {
                    peticion : 'buscar_alumno_docu',
                    documento : documento
            
                },
                success: function (resp) {

                    console.log(resp);

                    if(resp == 'existe'){

                        toastr.error('El documento <strong>'+documento+'</strong> ya existe!');
                        return false;
                        

                   }else if(resp == 'no_existe'){

                       
                $('#guardaralu').attr('disabled','disabled');
                $('#guardaralu').html('guardando <i class="fa fa-spinner fa-spin fa-2x fa-fw"></i>');      

                $.ajax({
                    type: "POST",
                    url: "../../../app/routes.php",
                    dataType: 'text',
                    data: {
                        peticion : 'guardar_alumno',
                        docu : documento,
                        nom : nombre,
                        ape : apellido,
                        dom : domicilio,
                        tel : telefono,
                        cel : celular,
                        nac : nacimiento,
                        esc : escuela,
                        grado : grado_anio,
                        email : email,
                        hermanos : hermanos 
                    },
                    success: function (resp) {

                        if(resp == 'ok'){
                            
                            toastr.success('Se ha guardado con éxito.');

                            setTimeout(function() { 
                                $(location).attr('href', '../alumnos/index.php');
                            }, 1500);

                        }else{

                            toastr.error('Ha ocurrido un error!!!');

                            $('#guardaralu').attr('disabled',false);
                            $('#guardaralu').html('Guardar');  

                            return false;
                        }

                    }
                }); 

                   }
               }

            });

         
        },
        rules: {
            documento: {required:true,
                        minlength: 8,
                        number: true,},
            nombre: {minlength: 2,
                     required: true,
                     lettersonly: true,},
            apellido: {minlength: 2,
                       required: true,
                       lettersonly: true,},
            nacimiento: 'required',
            telefono: {
                        minlength: 7,
            },
            celular: {
                minlength: 7,
                },
            email: {
                // required: true,
                email: true,
            },
            
        },
        messages: {
            documento: {
                    required: 'Complete este campo',
                    minlength: 'ingrese 8 caracteres',
                    number: 'ingrese solo números',
            },
            nombre: {
                required: 'Complete este campo',
                lettersonly: 'Ingrese solo letras',
                minlength: 'ingrese más caracteres',
            },
            apellido: {
                required: 'Complete este campo',
                lettersonly: 'Ingrese solo letras',
                minlength: 'ingrese más caracteres',
            },
            nacimiento: 'Complete este campo',
            telefono: {
                minlength: 'mínimo 7 números',
            },
            email: {
                // required: 'Complete este campo',
                email: 'E-mail inválido',
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