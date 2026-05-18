var Tabla = $('#table_activos').DataTable( {
  dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ],
  "ordering": false,      

 "language": {
        "url": "../../../public/libs/DataTables-1.10.12/extensions/table-spanish.json"
    },

      'columnDefs': [
  {
      "targets": 0, // your case first column
      "className": "text-left",
       "width": "50%",
 },{
      "targets": 1, // your case first column
      "className": "text-center",
       "width": "10%"
 },{
      "targets": 2, // your case first column
      "className": "text-center",
       "width": "10%"
 },{
      "targets": 3, // your case first column
      "className": "text-center",
       "width": "20%"
 },{
      "targets": 4, // your case first column
      "className": "text-center",
       "width": "10%"
 }
 ],
 });

 
//  var TablaAlu = $('#table_cursos_asociar').DataTable( {
//   "ordering": false,
//   "scrollY" : "200px",
//   "scrollCollapse" : true,
//   "paging": false,

//     "columnDefs": [
//   {
//       "targets": 0, // your case first column
//       "className": "text-center",
//  },{
//       "targets": 1, // your case first column
//       "className": "text-center",
//  },{
//       "targets": 2, // your case first column
//       "className": "text-center",
//  }
//  ],

//    "language": {
//         "url": "../../../public/libs/DataTables-1.10.12/extensions/table-spanish.json"
//     },

//  });
var TablaAlu = $('#table_cursos_asociar').DataTable({
    "ordering": false,
    "scrollY": "200px",
    "scrollCollapse": true,
    "paging": false,
    "scrollX": false,  // ← Agregá esto
    "autoWidth": false, // ← Y esto
    "columnDefs": [
        { "targets": 0, "className": "text-center", "width": "20%" },
        { "targets": 1, "className": "text-center", "width": "30%" },
        { "targets": 2, "className": "text-center", "width": "50%" }
    ],
    "language": {
        "url": "../../../public/libs/DataTables-1.10.12/extensions/table-spanish.json"
    },
});

$(document).ready(function(){
 
    
    buscarTipoPagos();
    buscarActivos();


$('#chk_asociar_alumno').on('change', function() {
    if ($(this).is(':checked')) {
        $('#div_tabla_alumnos').show();
        if (TablaAlu.data().count() === 0) {
            getAlumnosSA();
        }
        setTimeout(function() {
            TablaAlu.columns.adjust();
        }, 50);
    } else {
        $('#div_tabla_alumnos').hide();
        $('input[name="alumnosasoc"]').prop('checked', false);
        // ← Resetear scroll
        $('#div_tabla_alumnos .dataTables_scrollBody').scrollTop(0);
    }
});

$('#MyModalActivos').on('hidden.bs.modal', function() {
    $('#chk_asociar_alumno').prop('checked', false);
    $('#div_tabla_alumnos').hide();
    $('input[name="alumnosasoc"]').prop('checked', false);
    // ← Resetear scroll
    $('#div_tabla_alumnos .dataTables_scrollBody').scrollTop(0);
});

    $("#importe").inputmask("numeric", {
        radixPoint: ",",
        groupSeparator: ".",
        digits: 2,
        autoGroup: true,
        prefix: '$',
        rightAlign: false,
        oncleared: function () { self.Value(''); }
    });

    
    $(document).on("click", "#btn-nuevoactivo", function () {

      
        $('#ModalLongTitle').html('Nuevo Activo');
        $('#activo_desc').val('');
        $('#importe').val('');
        $('#formapago_activo').val(1);
        $('#tipo_accion').val(1);
        $('#id_activo').val('');
        $('.imp').removeClass('is-invalid');
       // $('.imp').addClass('is-invalid');
        $('#guardarActivo').attr('disabled',false);
        $('#guardarActivo').html('Guardar');

        //getAlumnosSA();

        $('#MyModalActivos').modal('show');

      });

      $(document).on("click", ".botonesdetailactivo", function () {

        var ida = this.id;

        $.ajax({
          type: "POST",
          url: "../../../app/routes.php",
          dataType: 'json',
          data: {
            peticion : 'ver_activo',
             idactivo : ida
          },
          success: function (resp) {

            var activo = resp;

            $.each( activo, function( key, value ) {
              
              $('#ModalLongTitle').html('Activo - '+value.fecha);
              $('#id_activo').val(value.id);
              $('#activo_desc').val(value.descripcion);
              $('#importe').val(value.importe);
              $('#formapago_activo').val(value.forma_pago);
              $('#tipo_accion').val(2);
              $('.imp').removeClass('is-invalid');
              $('#guardarActivo').html('Modificar');
              $('#guardarActivo').attr('disabled',false);

               // ← Agregá esto
                if (value.alumno_id != null) {
                    $('#chk_asociar_alumno').prop('checked', true);
                    $('#div_tabla_alumnos').show();

                    // Si la tabla está vacía, cargá los datos y luego seleccioná el radio
                    if (TablaAlu.data().count() === 0) {
                        getAlumnosSA(value.alumno_id); // ← pasamos el id a seleccionar
                    } else {
                        seleccionarAlumno(value.alumno_id);
                    }

                } else {
                    $('#chk_asociar_alumno').prop('checked', false);
                    $('#div_tabla_alumnos').hide();
                }

            });

            $('#MyModalActivos').modal('show');
          }
          
        }); 

      });


     // guardamos y editamos los activos // 
      $('#formulario_activos').validate({
        submitHandler: function (form) {
          // cuando va bien

            var desc = $('#activo_desc').val();
            var importe = $('#importe').val();
            var formap = $('#formapago_activo').val();
            var tipo = $('#tipo_accion').val();
            var usuario = $('#usuario_id').val();
            var id = '';
            var msj = 'guardado';
            var peticion = 'guardar_activo';

            if(tipo == 2){
                peticion = 'modificar_activo';
                id = $('#id_activo').val();
                msj = 'modificado';
            }
            
            var aux = importe.split('$');
            importe = aux[1];
            
            var importe = importe.replace('.','');
            var importe = importe.replace(',','.');

            // El value del radio seleccionado (id del alumno)
            var idAlumno = $('input[name="alumnosasoc"]:checked').val();
            var asociarAlumno = $('#chk_asociar_alumno').is(':checked');

            // Si marcó "asociar alumno" pero no eligió ninguno
            if (asociarAlumno && !idAlumno) {
                alert('Por favor seleccioná un alumno de la lista.');
                return;
            }
            // Validar que haya uno seleccionado
            if ($('#chk_asociar_alumno').is(':checked') && !idAlumno) {
                  alert('Por favor seleccioná un alumno.');
                  return;
              }

            $.ajax({
              type: "POST",
              url: "../../../app/routes.php",
              dataType: 'text',
              data: {

                peticion : peticion,
                ida : id,
                activo : desc,
                importe : importe,
                formapago : formap,
                usu : usuario,
                alumno: asociarAlumno ? idAlumno : null,

              },
              success: function (resp) {

                if(resp == 'ok'){
        
                        toastr.success('Se ha '+msj+' el activo exitosamente.');

                         setTimeout(function() { 
                            $(location).attr('href', '../activos/index.php');
                        }, 1500);

                    }else{


                        toastr.error('Ha ocurrido un error!!!');

                        return false;
                    }

              }
            }); 
           
        },
        rules: {
            activo_desc: {
                        required:true,
                        //min:3,
                        },
           
               importe: {
                         required: true,
                         // number: true,
                       }, 
        },
        messages: {
            activo_desc: {
                        required: 'Complete este campo',
                        //min: 'Complete este campo con al menos 3 caracteres',
            },
            importe: {
                        required: 'Complete este campo',
            }
           
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
  
           $('#formapago_activo').append("<option value='"+value.id+"'>"+value.descripcion+"</option>"); 
           
      });
  
        }
      }); 
  };

  function buscarActivos(){
    $.ajax({
        type: "POST",
        url: "../../../app/routes.php",
        dataType: 'json',
        data: {
          peticion : 'ver_activos',
        },
        success: function (resp) {
  
          var activos = resp;
  
         $.each( activos, function( key, value ) {
          var alumno = value.apellidoAlu !== null ? " ("+value.apellidoAlu+", "+value.nombreAlu+") " : "";
          var boton = "<button class='btn btn-info btn-sm botonesdetailactivo' id='"+value.id+"' title='detalle del Activo'><i class='fa fa-info-circle' aria-hidden='true'></i></button>";
          var print = "<button type='button' class='btn btn-warning btn-sm print_activos' id='"+value.id+"'><i class='fas fa-print'></i></button>";
          Tabla.row.add( [
            value.descripcion+alumno,
            '<b>'+value.importe+'</b>',
            value.fecha,
            value.formapago,
            boton+' '+print
            ]).draw();
           
       });
  
        }
      }); 

  
      $(document).on("click", ".print_activos", function () {
    
        var id = this.id;
        //window.open('activos_pdf.php?nrorecibo='+id+'','_blank','width=600,height=400');

        $.ajax({
          type: "POST",
          url: "../../../app/routes.php",
          dataType: 'json',
          data: {
            peticion : 'ver_activo',
             idactivo : id
          },
          success: function (resp) {

            var activo = resp;

            $.each( activo, function( key, value ) {

              window.open('activos_pdf.php?nroactivo='+value.id+'&descripcion='+value.descripcion+'&importe='+value.importe+'&formapago='+value.forma_pago+'&fecha='+value.fecha+'','_blank','width=600,height=400');

            });
          }
          
        }); 
    
    
      });   
      
  };

function getAlumnosSA(alumnoSeleccionado = null) {
    $('#div-spinner').show();
    TablaAlu.clear();

    $.ajax({
        type: "POST",
        url: "../../../app/routes.php",
        dataType: 'json',
        data: {
            peticion: 'ver_alumnos',
            tipo: 'S'
        },
        success: function(resp) {
            $.each(resp, function(key, value) {
                var check = "<input type='radio' class='alumnosasoc' value='" + value.id + "' name='alumnosasoc'>";
                TablaAlu.row.add([
                    check,
                    value.dni,
                    value.apellido + ', ' + value.nombre,
                ]);
            });

            TablaAlu.draw();
            setTimeout(function() {
                TablaAlu.columns.adjust();
                // ← Al terminar de dibujar, seleccioná el radio si viene uno
                if (alumnoSeleccionado != null) {
                    seleccionarAlumno(alumnoSeleccionado);
                }
            }, 50);
        },
        error: function(xhr, status, error) {
            console.error('Error al obtener alumnos:', error);
            alert('Error al cargar los alumnos. Intente nuevamente.');
        },
        complete: function() {
            $('#div-spinner').hide();
        }
    });
}

// function seleccionarAlumno(alumnoId) {
//     var radio = $('input[name="alumnosasoc"][value="' + alumnoId + '"]');
//     if (radio.length) {
//         radio.prop('checked', true);
//         // Scroll hasta el radio seleccionado dentro de la tabla
//         var contenedor = $('#div_tabla_alumnos .dataTables_scrollBody');
//         contenedor.scrollTop(radio.closest('tr').position().top);
//     }
// }
function seleccionarAlumno(alumnoId) {
    var radio = $('input[name="alumnosasoc"][value="' + alumnoId + '"]');
    if (radio.length) {
        radio.prop('checked', true);

        // El contenedor de scroll de DataTables
        var contenedor = $('#div_tabla_alumnos .dataTables_scrollBody');
        var fila = radio.closest('tr');
        
        // Posición de la fila relativa al contenedor
        var posicion = fila.position().top + contenedor.scrollTop() - (contenedor.height() / 2);
        
        contenedor.scrollTop(posicion);
    }
}