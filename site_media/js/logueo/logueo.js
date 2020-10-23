$(document).ready(function() {

  document.getElementById('formulario_acceso').setAttribute( 'autocomplete', 'off' );   

 $('#formulario_acceso').validate({
        submitHandler: function (form) {
          // cuando va bien
            var user = $('#usuario').val();
            var pass = $('#password').val();
            

            $('#ingresarLogueo').attr('disabled','disabled');

            $.ajax({
              type: "POST",
              url: "../../../app/routes.php",
              dataType: 'text',
              data: {

                peticion : 'AuthLogin',
                 user : user,
                 pass : pass

              },
              success: function (resp) {

                if(resp == 'ok'){
        
                        toastr.success('Accediendo..');

                         setTimeout(function() { 
                            $(location).attr('href', '../home/index.php');
                        }, 1500);

                    }else if(resp == 'usu'){

                        toastr.error('El usuario es incorrecto');

                        setTimeout(function() { 
                          window.location.reload();
                            // $(location).attr('href', '../logueo/index.php');
                        }, 2000);
                    }else if(resp == 'pass'){
                        
                         toastr.error('La contraseña es incorrecta');

                       setTimeout(function() { 
                          window.location.reload();
                          // $(location).attr('href', '../logueo/index.php');
                      }, 2000);
                   }

              }
            }); 
           
        },
        rules: {
            usuario: {required:true,
                        },
            password: {required:true,
                        },
           },
        messages: {
            usuario: {
                        required: 'Ingresar usuario',
            },
            password: {
                        required: 'Ingresar contraseña',
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


   


function logueo(){
	var usuario = $('#prueba').val();
	alert('se loguea '+usuario);


	$.ajax({

		type: "POST",
		url: "../../../app/routes.php",
		dataType: 'json',
		data: {
			peticion: 'productosview',
			user: $('#prueba').val()		
		},
		success: function (resp) {
			console.log(resp);
			var prods = resp;

			$.each( prods, function( key, value ) {
				$('#cuerpoTabla').append('<tr><td>'+value.cod+'</td><td>'+value.title+'</td></tr>');
			});

			

		}

  	});
}