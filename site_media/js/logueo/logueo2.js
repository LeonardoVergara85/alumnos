
////// CAPTCHA DE SEGURIDAD ////////////////
var res;
var myCaptcha = new jCaptcha({
	resetOnError: true,
	callback: function(response, $captchaInputElement) {
		if (response == 'success') { 
			$captchaInputElement[0].classList.remove('captcha-error'); 
			$captchaInputElement[0].classList.add('captcha-success'); 
			$captchaInputElement[0].placeholder = 'ok!'; 
			Login();
		} 

		if (response == 'error') { 
			$captchaInputElement[0].classList.remove('captcha-success'); 
			$captchaInputElement[0].classList.add('captcha-error'); 
      $captchaInputElement[0].placeholder = 'Incorrecto!'; 
    
		}
	}
});

$(document).ready(function() {
  
  //pruebaBackend();

  document.getElementById('formulario_acceso').setAttribute( 'autocomplete', 'off' );   

  $('#usuario').focus();
  $('canvas').css('background-color','56baed');	 
  $('canvas').css('width','50px');	 
  $('canvas').css('height','25px');	 
  

 $('#formulario_acceso').validate({
        submitHandler: function (form) {
          // cuando va bien
           ////// reCAPTCHA DE SEGURIDAD Google ////////////////
          // verificamos el reCaptcha de google
          let response = grecaptcha.getResponse();
          if(response.length == 0){
            toastr.error('Presione en "No soy un robot"');
            return;
  }
          myCaptcha.validate();    
              
        },
        rules: {
            usuario: {required:true,
                        },
            password: {required:true,
                        },
            // inp_captcha: {required:true,
            //             },            
           },
        messages: {
            usuario: {
                        required: 'Ingresar usuario',
            },
            password: {
                        required: 'Ingresar contraseña',
            },
            // inp_captcha: {
            //   required: '!',
            // },
 
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
// fin de ready()
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

function pruebaBackend(){

  $.ajax({

		type: "GET",
		url: "http://localhost/sistema/public/categorias",
		dataType: 'json',
		data: {	
		},
		success: function (resp) {
     
     // console.log(resp[0].nombre);
      alert(resp[0].nombre);

		}

  	});
}

function Login(){

  var user = $('#usuario').val();
  var pass = $('#password').val();
  var recaptcha = grecaptcha.getResponse();
  

  $('#ingresarLogueo').attr('disabled','disabled');

  $.ajax({
    type: "POST",
    url: "../../../app/routes.php",
    dataType: 'text',
    data: {

      peticion : 'AuthLogin',
       user : user,
       pass : pass,
       recaptcha: recaptcha

    },
    success: function (resp) {

      if(resp == 'ok'){

              $('#ingreso_captcha').html("Accediendo.. ");
             // $('#ingreso_captcha').css("color", "white");
              $('#ingreso_captcha').css("background-color", "#59dc5f");

               setTimeout(function() { 
                  $(location).attr('href', '../home/index.php');
              }, 1500);

          }else if(resp == 'usu'){

              toastr.error('El usuario es incorrecto');
              $('#ingresarLogueo').attr('disabled',false);
               myCaptcha.reset();

              $('#inp_captcha').removeClass('captcha-ok');
              $('#inp_captcha').removeClass('captcha-error');
              $('#inp_captcha').val('');
              $('#inp_captcha').attr('placeholder','Ingrese el captcha');

              
          }else if(resp == 'pass'){
              
               toastr.error('La contraseña es incorrecta');
               $('#ingresarLogueo').attr('disabled',false);
               myCaptcha.reset();
               $('#inp_captcha').removeClass('captcha-ok');
               $('#inp_captcha').removeClass('captcha-error');
               $('#inp_captcha').val('');
               $('#inp_captcha').attr('placeholder','Ingrese el captcha');
               
         }else if(resp == 'recaptcha'){
              
          toastr.error('No cumple con la seguridad de reCaptcha');
          $('#ingresarLogueo').attr('disabled',false);
          myCaptcha.reset();
          $('#inp_captcha').removeClass('captcha-ok');
          $('#inp_captcha').removeClass('captcha-error');
          $('#inp_captcha').val('');
          $('#inp_captcha').attr('placeholder','Ingrese el captcha');
          
    }

    }
  }); 

}