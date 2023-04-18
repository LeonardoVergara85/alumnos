// definimos la tabla para mostrar los alumnos

 var Tabla = $('#table_alumnos').DataTable( {
  'rowCallback': function(row, data, index){
    if(data[6] == 'Inactivo'){
        $(row).find('td:eq(0)').css('background', '#ee9d9d');
        $(row).find('td:eq(1)').css('background', '#ee9d9d');
        $(row).find('td:eq(2)').css('background', '#ee9d9d');
        $(row).find('td:eq(3)').css('background', '#ee9d9d');
        $(row).find('td:eq(4)').css('background', '#ee9d9d');
        $(row).find('td:eq(5)').css('background', '#ee9d9d');
        $(row).find('td:eq(6)').css('background', '#ee9d9d');
    }
    // if(data[2].toUpperCase() == 'EE'){
    //     $(row).find('td:eq(2)').css('color', 'blue');
    // }
   // $(row).addClass('redClass');
  },
  "order": [[ 2, "asc" ]],
   dom: 'Bfrtip',
          buttons: [
            {
              extend: 'excel',
              titleAttr: 'Excel',
              message: 'Listado de Alumnos',
              title: 'Alumnos - Skills',
              exportOptions: {
                columns: [ 1, 2, 3, 4, 5, 6 ]
            }
          },
          {
            extend: 'pdfHtml5',
            title: 'Alumnos - Skills',
            text: "PDF",
            pageSize: 'A4',
            exportOptions: {
              columns: [ 1, 2, 3, 4, 5, 6 ]
          }
            
          }
        
        
    ],

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
       "width": "10%"
 },{
      "targets": 2, // your case first column
      "className": "text-left",
       "width": "20%"
 },{
      "targets": 3, // your case first column
      "className": "text-left",
       "width": "20%"
 },{
      "targets": 4, // your case first column
      "className": "text-center",
       "width": "13%"
 },{
      "targets": 5, // your case first column
      "className": "text-center",
       "width": "13%"
 },{
  "targets": 6, // your case first column
  "className": "text-center",
   "width": "10%"
},{
  "targets": 7, // your case first column
  "className": "text-center",
   "width": "14%"
}
 ],
 
 });

  var TablaCursos = $('#table_cursos_asociados').DataTable( {

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
       "width": "20%"
 },{
      "targets": 2, // your case first column
      "className": "text-center",
       "width": "20%"
 }
 ],
 });

 

 
$(document).ready(function() {

//   $('#table_alumnos').bind('click', function(e) {
//     $(e.target).closest('tr').children('td,th').css('background-color','#000');
// });


  verAlumnos(); // listamos los alumnos cuando carga la pantalla.
  buscarTipoPagos(); // listamos los tipos de pagos

   $(document).on("click", "#modificaralu", function () {
      var ida = this.value;
      var idp = $('#id_persona_').val();
     //validar que el campo sea solo letas
      jQuery.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || /^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/i.test(value);
      }, "Ingresar solo letras"); 

     $('#formulario_alumnos_mod').validate({
        submitHandler: function (form) {
          // cuando va bien
            $('#modificaralu').attr('disabled','disabled');
            $('#modificaralu').html('<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i>'); 

            var documento_ = $('#documento_').val();
            var nombre_ = $('#nombre_').val();
            var apellido_ = $('#apellido_').val();
            var domicilio_ = $('#domicilio_').val();
            var telefono_ = $('#telefono_').val();
            var celular_ = $('#celular_').val();
            var nacimiento_ = $('#nacimiento_').val();
            var escuela_ = $('#escuela_').val();
            var grado_anio_ = $('#gradoanio_').val();
            var email_ = $('#email_').val();
            var hermanos_ = $('#hermanos_').is(':checked') ? 1 : 0;

            setTimeout(function() { 

              $.ajax({
                type: "POST",
                url: "../../../app/routes.php",
                dataType: 'text',
                data: {
                  peticion : 'modificar_alumno',
                      id : ida,
                      idp : idp,
                     docu : documento_,
                      nom : nombre_,
                      ape : apellido_,
                      dom : domicilio_,
                      tel : telefono_,
                      cel : celular_,
                      nac : nacimiento_,
                      esc : escuela_,
                      grado : grado_anio_,
                      email : email_,
                      hermanos : hermanos_ 
                },
                success: function (resp) {
  
                  if(resp == 'ok'){
          
                          toastr.success('Se ha modificado con éxito.');
                          
                          $('#modalDetalleAlumno').modal('hide');
                          $('#modificaralu').attr('disabled',false);
                          $('#modificaralu').html('Modificar'); 
                          $(".botonesdetailalu").attr('disabled',false);
                                       
                      }else{
  
                          toastr.error('Ha ocurrido un error!!!');
  
                          return false;
                      }
  
                }
  
              }); 
              
          }, 1000);

         // volvemos a cargar los alumnos //
          setTimeout(function() { 
            $(location).attr('href', '../alumnos/alumnos_ver.php');
          }, 3000);
            
            
           
        },

        rules: {
            documento_: {required:true,
                        minlength: 8,
                        number: true,},
            nombre_: {minlength: 2,
                     required: true,
                     lettersonly: true,},
            apellido_: {minlength: 2,
                       required: true,
                       lettersonly: true,},
            nacimiento_: 'required',
            telefono_: {
                        minlength: 7,
            },
            email_: {
              
                email: true,
            },
            
        },
        messages: {
            documento_: {
                    required: 'Complete este campo',
                    minlength: 'ingrese 8 caracteres',
                    number: 'ingrese solo números',
            },
            nombre_: {
                required: 'Complete este campo',
                lettersonly: 'Ingrese solo letras',
                minlength: 'ingrese más caracteres',
            },
            apellido_: {
                required: 'Complete este campo',
                lettersonly: 'Ingrese solo letras',
                minlength: 'ingrese más caracteres',
            },
            nacimiento_: 'Complete este campo',
            telefono_: {
                minlength: 'mínimo 7 números',
            },
            email_: {
                required: 'Complete este campo',
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

   $(document).on("click", "#btncancelarRenov", function () {

     $(".renovar").attr('disabled',false);
     $("#btnrenovarAlu").attr('disabled',false);

   });

   $(document).on("click", "#btnrenovarAlu", function () {

     ida = this.value;
     $("#"+this.id).attr('disabled',true);

     $.ajax({
      type: "POST",
      url: "../../../app/routes.php",
      dataType: 'text',
      data: {
        peticion : 'renovar_alumno',
        id : ida
      },
      success: function (resp) {

        if(resp == 'ok'){
          toastr.success('Se ha renovado con éxito.');

           setTimeout(function() { 
              $(location).attr('href', '../alumnos/alumnos_ver.php');
          }, 1500);

      }else{

          toastr.error('Ha ocurrido un error!!!');

          return false;
      }

      }
    }); 

   });

  $(document).on("click", ".renovar", function () {
  
    var idalumno = this.id;
    var nom = this.value;
    $(".renovar").attr('disabled','disabled');
    $('#msj-renovar').html('Realmente desea renovar al alumno <strong>'+nom+'</strong> ?');
    $('#btnrenovarAlu').val(idalumno);
    $('#renovarAlu').modal('show');
  });

  $(document).on("click", ".pagar", function () {
  
    var idcuota = this.id;
    $(".pagar").attr('disabled','disabled');
    $('#desc'+idcuota).attr('disabled', false);
    $('#int'+idcuota).attr('disabled', false);
    // $('#total'+idcuota).attr('disabled', false);
    $('#tipopago'+idcuota).attr('disabled', false);
    $('#'+this.id).hide();
    $('#confirmar'+idcuota).show();
    $('#cerrar-'+idcuota).show();
  

  });

  $(document).on("click", ".cerrar", function () {
  
    var idcuota = this.id;
    var x = idcuota.split('-');
    idcuota = x[1];

    $(".pagar").attr('disabled',false);
    $('#desc'+idcuota).attr('disabled', 'disabled');
    $('#int'+idcuota).attr('disabled', 'disabled');
    $('#total'+idcuota).attr('disabled', 'disabled');
    $('#tipopago'+idcuota).attr('disabled', 'disabled');
    
    $('#confirmar'+idcuota).hide();
    $('#cerrar-'+idcuota).hide();
    $('#'+idcuota).show();
  

  }); 


  $(document).on("click", ".confirmapago", function () {
  
    var idcuota = this.value;
    var desc = $('#desc'+idcuota).val();
    var int = $('#int'+idcuota).val();
    var tipop = $('#tipopago'+idcuota).val();

    if(tipop == 0){

      alert('Debe seleccionar el tipo de pago');
      return;
    }

    $('#confirmar'+idcuota).html('<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i>');

      $.ajax({
        type: "POST",
        url: "../../../app/routes.php",
        dataType: 'text',
        data: {
          peticion : 'pagar_cuota',
          idc : idcuota,
          desc : desc,
          int : int,
          tipopago:tipop
        },
        success: function (resp) {

          var respuesta = resp.split('-');

          if(respuesta[0] == 'ok'){
        
                        toastr.success('Se ha pagado con éxito.');

                         setTimeout(function() { 


                            $('#fp'+idcuota).html(respuesta[2]);
                            $(".btn-primary").attr('disabled',false);
                            $('#desc'+idcuota).attr('disabled', 'disabled');
                            $('#int'+idcuota).attr('disabled', 'disabled');
                            $('#total'+idcuota).attr('disabled','disabled');
                            $('#total'+idcuota).val(respuesta[1]);
                            $('#tipopago'+idcuota).attr('disabled', 'disabled');
                            $('#confirmar'+idcuota).hide();
                            $('#cerrar-'+idcuota).hide();
                            $('#print'+idcuota).show();

                        }, 1500);

                    }else{

                        toastr.error('Ha ocurrido un error!!!');

                        return false;
                    }

         

        }
      }); 


  });     

    $(document).on("click", "#desc", function () {
  
    var idcuota = this.id;
    $(".btn-primary").attr('disabled','disabled');
    $('#desc'+idcuota).attr('disabled', false);
    $('#int'+idcuota).attr('disabled', false);
    $('#total'+idcuota).attr('disabled', false);
    $('#confirmar'+idcuota).show();
    $('#'+idcuota).hide();

    return;
 
  }); 


  $(document).on("click", ".eliminar", function () {
  
    // extraemos los datos
    var idalumno = this.id;
    var nom = this.value;

    // seteamos los datos en el modal
    $(".eliminar").attr('disabled','disabled');
    $('#msj-eliminar').html('Realmente desea eliminar a <strong>'+nom+'</strong> ?');
    $('#btneliminarAlu').val(idalumno);
    $('#eliminarAlu').modal('show');
 
  });

  $(document).on("click", "#btneliminarAlu", function () {
  
    // extraemos los datos
    var idalumno = this.value;
    // var nom = this.value;
    $.ajax({
      type: "POST",
      url: "../../../app/routes.php",
      dataType: 'text',
      data: {
        peticion : 'eliminar_alumno',
        id_alumno : idalumno
      },
      success: function (resp) {

        if(resp == 'ok'){
        
          toastr.success('Se ha eliminado con éxito.');

           setTimeout(function() { 
              $(location).attr('href', '../alumnos/alumnos_ver.php');
          }, 1500);

      }else{

          toastr.error('Ha ocurrido un error!!!');

          return false;
      }
        

      }

    }); 

    // seteamos los datos en el modal
    // $(".eliminar").attr('disabled','disabled');
    // $('#msj-eliminar').html('Realmente desea eliminar a <strong>'+nom+'</strong> ?');
    // $('#btneliminarAlu').val(idalumno);
    // $('#eliminarAlu').modal('show');
 
  });

  $(document).on("click", ".btnclosealu", function () {

      $(".eliminar").attr('disabled',false);
      
  }); 


  // $(document).on("focusout", ".descuento", function () {
  
  //   var idd = this.id;
  //   idd = idd.split('c');

  //   var id = idd[1];

  //   var imp = $('#imp'+id).html();


  //   $('#total'+id).val((imp-(imp*this.value)/100))

  //   return;
 
  // }); 

  //   $(document).on("focusout", ".interes", function () {
  
  //   var idd = this.id;
  //   idd = idd.split('t');

  //   var id = idd[1];

  //   var imp = $('#imp'+id).html();


  //   $('#total'+id).val((parseFloat(imp)+parseFloat((imp*this.value)/100)));

  //   return;
 
  // }); 


  $(document).on("click", ".botonesdetailalu", function () {
    // $('#'+this.id).html("<span class='spinner-grow spinner-grow-sm' role='status' aria-hidden='true'></span> Loading...");
    $(".botonesdetailalu").attr('disabled','disabled');

    verAlumno(this.id);

  });   

  $(document).on("click", ".print_cuota", function () {
    
    var id = this.id;

    $.ajax({
        type: "POST",
        url: "../../../app/routes.php",
        dataType: 'json',
        data: {
          peticion : 'ver_cuota_print',
          idc : id
        },
        success: function (resp) {

          var cuota = resp;

          $.each( cuota, function( key, value ) {

            window.open('recibo_pdf.php?nrorecibo='+value.id+'&nom='+value.nombre+'&ape='+value.apellido+'&curso='+value.curso+'&cuota='+value.nro+'&meses='+value.meses+'&imp='+value.importe+'&fechap='+value.fecha_p+'&fechav='+value.fecha_v+'&tipop='+value.tipo_pago+'','_blank','width=600,height=400');
          
          });

        }
      });


    // window.open('recibo_pdf.php','_blank','width=600,height=400');


  });   


  $(document).on("click", ".print_cuota_", function () {
    
    var id = this.id;
    var aux = id.split('t'); 
    id = aux[1];

    $.ajax({
        type: "POST",
        url: "../../../app/routes.php",
        dataType: 'json',
        data: {
          peticion : 'ver_cuota_print',
          idc : id
        },
        success: function (resp) {

          var cuota = resp;

          $.each( cuota, function( key, value ) {

            window.open('recibo_pdf.php?nrorecibo='+value.id+'&nom='+value.nombre+'&ape='+value.apellido+'&curso='+value.curso+'&cuota='+value.nro+'&meses='+value.meses+'&imp='+value.importe+'&fechap='+value.fecha_p+'&fechav='+value.fecha_v+'&tipop='+value.tipo_pago+'','_blank','width=600,height=400');
          
          });

        }
      });

  });    

  $(document).on("click", ".nombre_curso", function () {

    // alert(this.id);

   // console.log($("#btn-cur").prop("aria-expanded",false));
   var id_alu_cur = this.id;

    $('#cuerpoTablaCuotas'+id_alu_cur).empty();

   var x = document.getElementById("btn-cur").getAttribute("aria-expanded"); 
  if (x == "true") 
  {
    $('#cuerpoTablaCuotas'+id_alu_cur).empty();
  } 
  else {

    $.ajax({
      type: "POST",
      url: "../../../app/routes.php",
      dataType: 'json',
      data: {
        peticion : 'ver_cuotas',
        idac : id_alu_cur
      },
      success: function (resp) {

        var cuotas = resp;

        $.each( cuotas, function( key, value ) {

          cerrar = "<a href='#' class='badge badge-danger cerrar' id='cerrar-"+value.id+"' style='display:none'>cancelar <i class='fas fa-window-close'></i></a>";
          // cerrar = "<span class='badge badge-pill badge-danger' id='cerrar"+value.id+"' style='display:none'><i class='fas fa-window-close'></i></span>";
          // cerrar = "<button type='button' class='btn btn-danger btn-sm' id='cerrar"+value.id+"' style='display:none'><i class='fas fa-window-close'></i></button>";
          boton_pint = "<button type='button' class='btn btn-warning btn-sm print_cuota' id='"+value.id+"'><i class='fas fa-print'></i></button>";
          boton_pint2 = "<button type='button' class='btn btn-warning btn-sm print_cuota_' id='print"+value.id+"' style='display:none'><i class='fas fa-print'></i></button>";
          boton_pagar_conf = "<button type='button' class='confirmapago btn btn-success btn-sm' id='confirmar"+value.id+"' value='"+value.id+"' style='display: none;'>Confirmar</button>";
          boton_pagar = "<button type='button' class='btn btn-primary btn-sm pagar' id='"+value.id+"'><i class='fas fa-dollar-sign'></i> Pagar</button>";
          if(value.fechap == '00/00/0000'){

            $('#cuerpoTablaCuotas'+id_alu_cur).append("<tr><td><font size='2'>"+value.nro+"<font></td><td><font size='2'>"+value.fecha_v+"</font></td><td ><font size='2' id='imp"+value.id+"'>"+value.importe+"</font></td><td><input type='text' class='form-control descuento' id='desc"+value.id+"' value='"+value.descuento+"' placeholder='%' style='width: 43px;font-size:13px;' disabled=''></td><td><input type='text' id='int"+value.id+"' class='form-control interes' value='"+value.interes+"' placeholder='%' style='width: 43px;font-size:13px;' disabled=''></td><td><input class='form-control' type='text' id='total"+value.id+"' value='"+value.total+"' style='width: 70px;font-size:13px;' disabled=''/></td><td><select id='tipopago"+value.id+"' class='form-control' style='width:70px;' disabled><option value='0'>*</option><option value='1'>Contado / Efectivo</option><option value='2'>Débito</option><option value='3'>Crédito</option><option value='4'>MercadoPago</option><option value='5'>Transferencia</option><option value='5'>Otro</option></select></td><td><font size='2' id='fp"+value.id+"'>"+value.fechap+"</font></td><td>"+boton_pagar+' '+boton_pagar_conf+''+boton_pint2+''+cerrar+"</td></tr>");
             

          }else{

            $('#cuerpoTablaCuotas'+id_alu_cur).append("<tr><td><font size='2'>"+value.nro+"<font></td><td><font size='2'>"+value.fecha_v+"</font></td><td ><font size='2' id='imp"+value.id+"'>"+value.importe+"</font></td><td><input type='text' class='form-control descuento' id='desc"+value.id+"' value='"+value.descuento+"' placeholder='%' style='width: 43px;font-size:13px;' disabled=''></td><td><input type='text' id='int"+value.id+"' class='form-control interes' value='"+value.interes+"' placeholder='%' style='width: 43px;font-size:13px;' disabled=''></td><td><input class='form-control' type='text' id='total"+value.id+"' value='"+value.total+"' style='width: 70px;font-size:13px;' disabled=''/></td><td><select id='tipopago"+value.id+"' class='form-control' style='width:70px;' disabled><option value='0'>*</option><option value='1'>Contado / Efectivo</option><option value='2'>Débito</option><option value='3'>Crédito</option><option value='4'>MercadoPago</option><option value='5'>Transferencia</option><option value='5'>Otro</option></select></td><td><font size='2' id='fp"+value.id+"'>"+value.fechap+"</font></td><td>"+boton_pint+"</td></tr>");

          }

     
          });

      }
    }); 
  }
    
    
    
    
    


  });  

  // buscamos los cursos que realiza el alumno
  $(document).on("click", ".botonesdetailcurso", function () {
    // $('#'+this.id).html("<span class='spinner-grow spinner-grow-sm' role='status' aria-hidden='true'></span> Loading...");
    $(".botonesdetailcurso").attr('disabled','disabled');

    verCursos(this.id);

  });

    // buscamos los cursos que realiza el alumno
  $(document).on("click", ".botonesdecuotas", function () {
  
    // $(".botonesdetailcurso").attr('disabled','disabled');

    // verCursos(this.id);
    // $('#modalCursosAlu').modal('hide');
    // $('#modalCuotas').modal('show');
    alert('aca estoy');

  });

 $(document).on("click", ".btnclose", function () {
  
    $(".botonesdetailalu").attr('disabled',false);

  });

 $(document).on("click", ".btnclose2", function () {
  
    $(".botonesdetailcurso").attr('disabled',false);

  });

})

function verAlumnos(){

  $('#div-spinner').show();
  
  Tabla.clear();

      $.ajax({
        type: "POST",
        url: "../../../app/routes.php",
        dataType: 'json',
        data: {
          peticion : 'ver_alumnos',
        },
        success: function (resp) {

          var alus = resp;
          $.each( alus, function( key, value ) {

            var boton = "<button class='btn btn-info btn-sm botonesdetailalu' id='"+value.id+"' title='detalle'><i class='fa fa-info-circle' aria-hidden='true'></i></button>"; 
            var boton2 = "<button class='btn btn-info btn-sm botonesdetailcurso' id='"+value.id+"' title='cursos'><i class='fa fa-users' aria-hidden='true'></i></button>"; 
            var boton3 = "<button class='btn btn-danger btn-sm eliminar' id='"+value.id+"' title='eliminar' value='"+value.apellido+', '+value.nombre+"'><i class='fa fa-minus' aria-hidden='true'></i></button>"; 
            var boton4 = "<button class='btn btn-warning btn-sm renovar' id='"+value.id+"' title='renovar' value='"+value.apellido+', '+value.nombre+"'><i class='fa fa-retweet' aria-hidden='true'></i></button>"; 
      
            var botonera = boton+' '+boton2+' '+boton3;
           

            var alumno_activo = '<span class="badge badge-success">Activos</span>';
            var tel = '';

            if(value.telefono != null && value.telefono != ''){
              tel = value.telefono;
            }else if(value.celular != null && value.celular != ''){
              tel = value.celular;
            }

            if(value.activo == 'N'){
              if(value.fecha_baja){ 
                alumno_activo = '<span class="badge badge-danger">Inactivo desde '+value.fecha_baja+'</span>';
              }else{
                alumno_activo = '<span class="badge badge-danger">Inactivo</span>';
              }
              botonera = boton4;
              //$('#table_alumnos').children('td,th').css('background-color','#000');
              //$('#table_alumnos').tr.addClass('danger');
            }
            
            Tabla.row.add( [
                '<td style="display: none;">'+value.id+'</td>',
                value.dni,
                value.apellido,
                value.nombre,
                value.fecha_nacimiento,
                tel,
                alumno_activo,
                botonera
                ]).draw();
      });

      $('#div-spinner').hide();

      }
    }); 
      
}

function verAlumno(idalu){

  $('#documento_').val('');
  $('#nombre_').val('');
  $('#apellido_').val('');
  $('#domicilio_').val('');
  $('#telefono_').val('');
  $('#celular_').val('');
  $('#nacimiento_').val('');
  $('#escuela_').val('');
  $('#gradoanio_').val('');
  $('#email_').val('');


      $.ajax({
        type: "POST",
        url: "../../../app/routes.php",
        dataType: 'json',
        data: {
          peticion : 'ver_alumno',
          idAlumno : idalu
        },
        success: function (resp) {

          //console.log(resp);

          $.each(resp, function(idx, val){

            $('#documento_').val(val.dni);
            $('#nombre_').val(val.nombre);
            $('#apellido_').val(val.apellido);
            $('#domicilio_').val(val.domicilio);
            $('#telefono_').val(val.telefono);
            $('#celular_').val(val.celular);
            $('#nacimiento_').val(val.fecha_nac);
            $('#escuela_').val(val.escuela);
            $('#gradoanio_').val(val.grado);
            $('#email_').val(val.email);

            if((val.celular != null)&&(val.celular != '')){
              $('#div-wts').html("<a href='https://web.whatsapp.com/send?phone=54"+val.celular+"&amp;text=El+instituto+de+inglés+Skills,+informa+que&amp;source&amp;data&amp;app_absent' target='_blank'><font color='green'><i class='fab fa-whatsapp'></i></font></a>");
            }else{
              $('#div-wts').html("<a target='_blank'><font color='gray'><i class='fab fa-whatsapp' disabled></i></font></a>");
            }
           
             if(val.hermanos == 1){
              $('#hermanos_').prop('checked', true);
             }else{
              $('#hermanos_').prop('checked', false);
             }

            //  $('#modificaralu').val(val.id_persona);
              $('#modificaralu').val('');
              $('#modificaralu').val(val.id);
              $('#id_persona_').val('');
              $('#id_persona_').val(val.id_persona);
          })

           $('#modalDetalleAlumno').modal('show');

        }

      }); 
}


function verCursos(idalu){

  // $('.card').remove();
  $('#card_body').empty();

      $.ajax({
        type: "POST",
        url: "../../../app/routes.php",
        dataType: 'json',
        data: {
          peticion : 'ver_cursos_alumno',
          idAlumno : idalu
        },
        success: function (resp) {

          var cont = 0;

          $.each(resp, function(idx, value){

            cont++;

            var boton_cuota = "<button class='btn btn-info btn-sm botonesdecuotas' id='"+value.id+"' title='cuotas'><i class='fas fa-search-dollar'></i></button>"; 
            $('#titulo-modal').html('');
            $('#titulo-modal').html(value.apellido+', '+value.nombre+' - Cursos');
            $('#her').html('');
            $('#her').html('hermanos: '+value.hermanos);
            if(cont == 1){
              $('#card_body').append('<div class="card-header" id="heading'+cont+'"><h5 class="mb-0"><button type="button" id="btn-cur" class="btn btn-link" data-toggle="collapse" data-target="#collapse'+cont+'"  ><b class="nombre_curso" id='+value.id+'>'+value.curso+' - Año lectivo ('+value.anio+')</b></button></h5></div>');
              $('#card_body').append('<div id="collapse'+cont+'" class="collapse" aria-labelledby="heading'+cont+'" data-parent="#accordion"><div class="card-body"><table id="tabla_cuotas'+value.id+'" class="table table-striped table-hover compact" cellspacing="0" width="100%"><thead><th class="text-center" style="width: 5%;">#</th><th class="text-center" style="width: 10%;">Vto.</th><th class="text-center" style="width: 15%;">Importe</th><th class="text-center" style="width: 10%;">% dto.</th><th class="text-center" style="width: 10%;">% Int.s</th><th class="text-center" style="width: 20%;">Total</th><th class="text-center" style="width: 35%;">tipo</th><th class="text-center" style="width: 10%;">Pago</th><th style="width: 10%;"></th></thead><tbody id="cuerpoTablaCuotas'+value.id+'"></tbody></table></div></div>');
            }else{
              $('#card_body').append('<div class="card-header" id="heading'+cont+'" style="background-color: darkgrey;"><h5 class="mb-0"><button type="button" id="btn-cur" class="btn btn-link" data-toggle="collapse" data-target="#collapse'+cont+'"  ><b class="nombre_curso" id='+value.id+'>'+value.curso+' - Año lectivo ('+value.anio+')</b></button></h5></div>');
              $('#card_body').append('<div id="collapse'+cont+'" class="collapse" aria-labelledby="heading'+cont+'" data-parent="#accordion"><div class="card-body"><table id="tabla_cuotas'+value.id+'" class="table table-striped table-hover compact" cellspacing="0" width="100%"><thead><th class="text-center" style="width: 5%;">#</th><th class="text-center" style="width: 10%;">Vto.</th><th class="text-center" style="width: 15%;">Importe</th><th class="text-center" style="width: 10%;">% dto.</th><th class="text-center" style="width: 10%;">% Int.s</th><th class="text-center" style="width: 20%;">Total</th><th class="text-center" style="width: 35%;">tipo</th><th class="text-center" style="width: 10%;">Pago</th><th style="width: 10%;"></th></thead><tbody id="cuerpoTablaCuotas'+value.id+'"></tbody></table></div></div>');
            }
         
          })

          setTimeout(function() { 
            $('#modalCursosAlu').modal('show');
        }, 1500);
           

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

         $('#pagadopor_').append("<option value='"+value.id+"'>"+value.descripcion+"</option>"); 
         
    });

      }
    }); 
}