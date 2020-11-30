 
 // definimos la tabla para mostrar los cursos

 var Tabla = $('#table_cursos').DataTable( {

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
       "width": "60%",
 },{
      "targets": 1, // your case first column
      "className": "text-center",
       "width": "5%"
 },{
      "targets": 2, // your case first column
      "className": "text-center",
       "width": "10%"
 },{
      "targets": 3, // your case first column
      "className": "text-center",
       "width": "10%"
 },{
      "targets": 4, // your case first column
      "className": "text-center",
       "width": "15%"
 },
 ],
 });

$(document).ready(function(){
	
	verCursos();

     $("#costo__").on({
    "focus": function (event) {
        $(event.target).select();
    },
    "keyup": function (event) {
        $(event.target).val(function (index, value ) {
            return value.replace(/\D/g, "")
            // .replace(/([0-9])([0-9]{2})$/, '$1,$2')
            .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ".");
        });
    }
}); 

	  //validar que el campo sea solo letas
 jQuery.validator.addMethod("lettersonly", function(value, element) {
  return this.optional(element) || /^[ a-z]+$/i.test(value);
  }, "Ingresar solo letras"); 

 $('#formulario_cursos_mod').validate({
        submitHandler: function (form) {
        	// cuando va bien

            var nombrecurso = $('#nombrecurso_').val();
            var mesescurso = parseInt($('#mesescurso_').val());
            var idcurso = parseInt($('#modificarcurso').val());
            

            $('#modificarcurso').attr('disabled','disabled');

            $.ajax({
            	type: "POST",
            	url: "../../../app/routes.php",
            	dataType: 'text',
            	data: {

            		peticion : 'modificar_curso',
            		idc : idcurso,
            		nombrec : nombrecurso,
                    meses : mesescurso

            	},
            	success: function (resp) {

            		if(resp == 'ok'){
        
                        toastr.success('Se ha modificado el curso exitosamente.');

                         setTimeout(function() { 
                            $(location).attr('href', '../cursos/cursos_ver.php');
                        }, 1500);

                    }else{

                        toastr.error('Ha ocurrido un error!!!');

                        return false;
                    }

            	}
            });	
           
        },
        rules: {
            nombrecurso_: {required:true,
                          minlength: 2,
                          // lettersonly: true,
                        },
           
            mesescurso_: {
                         required: true,
                         number: true,},  
        },
        messages: {
            nombrecurso_: {
                required: 'Complete este campo',
                minlength: 'ingresar más de 2 caracteres',
            },
            mesescurso_: {
                required: 'Complete este campo',
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

    $('#modificar_costo_curso').validate({
        submitHandler: function (form) {
          // cuando va bien

            var idcurso = parseInt($('#modificarcosto').val());
            var costo = $('#costo__').val();
            var costo2 = $('#costo__2').val();
            var id_curso_importe = parseInt($('#id_ci__').val());
            
            costo = costo.replace('.','');
            costo2 = costo2.replace('.','');

            if(costo == costo2){
              toastr.error('El costo debe ser diferente al anterior!');
              return false;
            }

            $('#modificarcosto').attr('disabled','disabled');

            $.ajax({
              type: "POST",
              url: "../../../app/routes.php",
              dataType: 'text',
              data: {

                peticion : 'modificar_costos',
                idc : idcurso,
                costo : costo,
                idCI : id_curso_importe

              },
              success: function (resp) {

                console.log(resp)

                if(resp == 'ok'){
        
                        toastr.success('Se ha modificado el costo exitosamente.');

                         setTimeout(function() { 
                            $(location).attr('href', '../cursos/cursos_ver.php');
                        }, 1500);

                    }else{

                        toastr.error('Ha ocurrido un error!!!');

                        return false;
                    }

              }
            }); 
           
        },
        rules: {
            costo__: {
                         required: true,
                         number: true,
                    },  
        },
        messages: {
            costo__: {
                required: 'Complete este campo',
                number: 'Ingrese solo números',
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

	   $(document).on("click", ".botonesdetailcurso", function () {

          var idc = this.id;
          $.ajax({
            type: "POST",
            url: "../../../app/routes.php",
            dataType: 'json',
            data: {
              peticion : 'ver_curso',
               idcurso : idc
            },
            success: function (resp) {

              var cursos = resp;

              $.each( cursos, function( key, value ) {

                var boton = "<button class='btn btn-info btn-sm botonesdetailcurso' id='"+value.id+"' title='detalle del curso'><i class='fa fa-info-circle' aria-hidden='true'></i></button>"; 
                $('#nombrecurso_').val(value.descripcion);
                $('#mesescurso_').val(value.meses);
                $('#costo_').val(value.importe);

                $('#modificarcurso').val(value.id);
              });

              $('#modalDetalleCurso').modal('show');
            }
          }); 

        });

     $(document).on("click", ".botonesmodcosto", function () {

      		var idc = this.id;
      		$.ajax({
      			type: "POST",
      			url: "../../../app/routes.php",
      			dataType: 'json',
      			data: {
      				peticion : 'ver_curso',
      				 idcurso : idc
      			},
      			success: function (resp) {

      				var cursos = resp;

      				$.each( cursos, function( key, value ) {

      					var boton = "<button class='btn btn-info btn-sm botonesdetailcurso' id='"+value.id+"' title='detalle del curso'><i class='fa fa-info-circle' aria-hidden='true'></i></button>"; 
      					$('#nombrecurso__').val(value.descripcion);
                $('#mesescurso__').val(value.meses);
                $('#costo__').val(value.importe);
                $('#costo__2').val(value.importe);
                $('#id_ci__').val(value.id_ci);
      					$('#fecha__').val(value.fechai);

      					$('#modificarcosto').val(value.id);
      				});

      				$('#modalmodcosto').modal('show');
      			}
      		}); 

        });

	   $(document).on("click", ".botoneseliminarcurso", function () {

       $('#btneliminarCurso').val(this.id);
       
       $('#eliminarCurso').modal('show');
       
     });

     $(document).on("click", ".botonesrenovar", function () {

       $('#btnRenovarCurso').val(this.id);
       
       $('#renovarCurso').modal('show');
       
     });

  $(document).on("click", ".btnclose", function () {

	   	 location.reload();
	   	 
	   });


	   $(document).on("click", ".btneliminarCurso", function () {

       var idc = this.value;
       
       $.ajax({
            type: "POST",
            url: "../../../app/routes.php",
            dataType: 'text',
            data: {
              peticion : 'eliminar_curso',
               idcurso : idc
            },
            success: function (resp) {

              
                if(resp == 'ok'){

                  $('#eliminarCurso').modal('hide');
        
                        toastr.success('Se ha eliminado el curso exitosamente.');

                         setTimeout(function() { 
                            $(location).attr('href', '../cursos/cursos_ver.php');
                        }, 1500);

                    }else if(resp == 'no_eliminar'){

                      toastr.error('El curso no se puede eliminar porque hay alumnos asociados!!!');

                        return false;
                    }
                    else{

                        toastr.error('Ha ocurrido un error!!!');

                        return false;
                    }

            }
          }); 
       

     }); 

     $(document).on("click", "#btnRenovarCurso", function () {

	   	 var idc = this.value;

	   	 $.ajax({
      			type: "POST",
      			url: "../../../app/routes.php",
      			dataType: 'text',
      			data: {
      				peticion : 'renovar_curso',
      				 idcurso : idc
      			},
      			success: function (resp) {

      				
            		if(resp == 'ok'){

            			$('#renovarCurso').modal('hide');
        
                        toastr.success('Se ha renovado el curso exitosamente.');

                         setTimeout(function() { 
                            $(location).attr('href', '../cursos/cursos_ver.php');
                        }, 1500);

                    }else if(resp == 'no_renovar'){

                      toastr.error('El curso no se puede renovar ya que existe este año lectivo!!!');

                        return false;
                    }
                    else{

                        toastr.error('Ha ocurrido un error!!!');

                        return false;
                    }

      			}
      		}); 
	   	 

	   });


	    // $(document).on("click", ".modificarcurso", function () {

     //  		var idc = this.value;

     //  		$.ajax({
     //  			type: "POST",
     //  			url: "../../../app/routes.php",
     //  			dataType: 'json',
     //  			data: {
     //  				peticion : 'ver_curso',
     //  				 idcurso : idc
     //  			},
     //  			success: function (resp) {

     //  				var cursos = resp;

     //  				$.each( cursos, function( key, value ) {

     //  					var boton = "<button class='btn btn-info btn-sm botonesdetailcurso' id='"+value.id+"' title='detalle del curso'><i class='fa fa-info-circle' aria-hidden='true'></i></button>"; 
     //  					$('#nombrecurso_').val(value.descripcion);
     //  					$('#mesescurso_').val(value.meses);

     //  					$('#modificarcurso').val(value.id);
     //  				});

     //  				$('#modalDetalleCurso').modal('show');
     //  			}
     //  		}); 

     //    });


});

function verCursos(){

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
            
            var boton = "<button class='btn btn-info btn-sm botonesdetailcurso' id='"+value.id+"' title='detalle del curso'><i class='fa fa-info-circle' aria-hidden='true'></i></button>"; 
            var botonx = "<button class='btn btn-danger btn-sm botoneseliminarcurso' id='"+value.id+"' title='eliminar curso'><i class='fa fa-trash' aria-hidden='true'></i></button>"; 
            var botonmc = "<button class='btn btn-info btn-sm botonesmodcosto' id='"+value.id+"' title='modificar costo'><i class='fas fa-comment-dollar'></i></button>"; 

            Tabla.row.add( [
                value.descripcion,
                value.meses,
                value.importe,
                value.anio,
                boton+' '+botonmc+' '+botonx
                ]).draw();
      });

        }
      }); 
} 
