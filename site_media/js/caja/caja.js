var Tabla = $('#table_caja').DataTable( {
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
       "width": "20%",
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
      "className": "text-center",
       "width": "10%"
 },{
      "targets": 4, // your case first column
      "className": "text-left",
       "width": "35%"
 },{
      "targets": 5, // your case first column
      "className": "text-center",
       "width": "5%"
 }
 ],
 });

//  var TablaDetalle = $('#table_caja_detalle').DataTable( {
//   dom: 'Bfrtip',
//         buttons: [
//             'excel', 'pdf', 'print'
//         ],
//   "ordering": false,      

//  "language": {
//         "url": "../../../public/libs/DataTables-1.10.12/extensions/table-spanish.json"
//     },

//       'columnDefs': [
//   {
//       "targets": 0, // your case first column
//       "className": "text-left",
//        "width": "80%",
//  },{
//       "targets": 1, // your case first column
//       "className": "text-center",
//        "width": "20%"
//  }
//  ],
//  });

  var TablaDetalle = $('#table_caja_detalle').DataTable( {
  "ordering": false,  // 👈 desactiva el ordenamiento
  "scrollY" : "280px",
  "scrollX": false,  
  "scrollCollapse" : true,
  "paging": false,

'columnDefs': [
    { "targets": 0, "className": "text-left" },
    { "targets": 1, "className": "text-center" }
],

   "language": {
    "url": "../../../public/libs/DataTables-1.10.12/extensions/table-spanish.json",
    "loadingRecords": '<div class="text-center"><i class="fas fa-spinner fa-spin fa-2x"></i></div>',  // 👈
    "processing": '<div class="text-center"><i class="fas fa-spinner fa-spin fa-2x"></i></div>'       // 👈
  },
  "processing": true,  // 👈 habilita el mensaje de procesamiento

 });

$(document).ready(function(){


  buscarCajas();

  $("#monto").inputmask("numeric", {
        radixPoint: ",",
        groupSeparator: ".",
        digits: 2,
        autoGroup: true,
        prefix: '$',
        rightAlign: false,
        oncleared: function () { self.Value(''); }
    });

    $(document).on("click", ".botones-cerrar-caja", function () {
      
        var cajacerrada = this.attributes.cierre.nodeValue;
        console.log(cajacerrada);
        
        var aux_ = this.id.split('*');
        var aux = this.name.split('*');
  
        var fecha = aux_[1];
        var monto = aux[1];
        // var aux = monto.split('$');
        //     monto = aux[1];
            
        var monto = monto.replace('.','');
        var monto = monto.replace(',','.');
        var nombreCaja = aux[0];
        detalleCaja(fecha, monto);

        if(cajacerrada === 'true'){
          $('#cerrarCaja').hide();
        }else{
          $('#cerrarCaja').show();
        }

        $('#id_caja').val(aux_[0]);
       

        $('#ModalLongTitleDetalle').html('<b>Caja chica del día '+aux[0]+'</b>');
        $('#MyModalCajaCerrar').modal('show');
      
    });

    $(document).on("click", "#btn-apertura-caja", function () {

        $('#MyModalCaja').modal('show');

    });

    // guardamos apertura de la caja chica // 
      $('#formulario_cajas').validate({
        submitHandler: function (form) {
          // cuando va bien

            var montoInicial = $('#monto').val();
            var observaciones = $('#observacion').val();
            var usuario = $('#usuario_id').val();
            var peticion = 'apertura_caja';
            
            var aux = montoInicial.split('$');
            montoInicial = aux[1];
            
            var montoInicial = montoInicial.replace('.','');
            var montoInicial = montoInicial.replace(',','.');

            $.ajax({
              type: "POST",
              url: "../../../app/routes.php",
              dataType: 'text',
              data: {
                peticion: peticion,
                inicial: montoInicial,
                usuario: usuario,
                obs: observaciones
              },
              success: function (resp) {

                if(resp == 'ok'){
        
                        toastr.success('Se guardó la apertura de la caja chica');

                         setTimeout(function() { 
                            $(location).attr('href', '../caja/index.php');
                        }, 1500);

                    }else{


                        toastr.error('Ha ocurrido un error!!!');

                        return false;
                    }

              }
            }); 
           
        },
        rules: {
            monto: {
                        required:true,
                        //min:3,
                        },
        },
        messages: {
            monto: {
                        required: 'Complete este campo',
                        //min: 'Complete este campo con al menos 3 caracteres',
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

    // cerramos la caja chica // 
      $('#formulario_caja_cerrar').validate({
        submitHandler: function (form) {
          // cuando va bien

            var idC = $('#id_caja').val();
            var montoFinal = $('#monto_final').val();
            var usuario = $('#usuario_id').val();
            var peticion = 'cierre_caja';
            
            var aux = montoFinal.split('$');
            montoFinal = aux[1];
            
            var montoFinal = montoFinal.replace('.','');
            var montoFinal = montoFinal.replace(',','.');

            $.ajax({
              type: "POST",
              url: "../../../app/routes.php",
              dataType: 'text',
              data: {
                peticion: peticion,
                id: idC,
                final: montoFinal,
                usuario: usuario
              },
              success: function (resp) {

                if(resp == 'ok'){
        
                        toastr.success('Se guardó el cierre de la caja chica');

                         setTimeout(function() { 
                            $(location).attr('href', '../caja/index.php');
                        }, 1500);

                    }else{


                        toastr.error('Ha ocurrido un error!!!');

                        return false;
                    }

              }
            }); 
           
        },
        rules: {
            monto_final: {
                        required:true,
                        //min:3,
                        },
        },
        messages: {
            monto_final: {
                        required: 'Complete este campo',
                        //min: 'Complete este campo con al menos 3 caracteres',
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




function detalleCaja(fecha, monto){
    $('#spinner_caja').show();
    $('#table_caja_detalle_cont').hide();
    TablaDetalle.clear().draw();
    $("#monto_final").val('');
    $.ajax({
        type: "POST",
        url: "../../../app/routes.php",
        dataType: 'json',
        data: {
          peticion : 'ver_detalle_caja',
          fecha : fecha,
          montoinicial: monto
        },
        success: function (resp) {

        $('#spinner_caja').hide(); 
        $('#table_caja_detalle_cont').show();
        var movimientos = resp.lista;
        var saldo_final = resp.saldo;
        $("#monto_final").val('$ '+saldo_final);
         $.each( movimientos, function( key, value ) {
           var monto = value.haber !== '-' ? '<b style="color: red;"> - </b>'+value.haber : '<b style="color: green;"> + </b>' + value.debe
          TablaDetalle.row.add( [
            value.denominacion+' - '+value.detalle,
            monto,
            ]).draw();
       });
      }
  }); 
};

function buscarCajas(){
    $.ajax({
        type: "POST",
        url: "../../../app/routes.php",
        dataType: 'json',
        data: {
          peticion : 'ver_cajas',
        },
        success: function (resp) {
         var cajas = resp;
         $.each( cajas, function( key, value ) {
          console.log(value);
          console.log(key);
          
        if(key === 0 && value.monto_final !== null){
          $("#monto").val(value.monto_final);
        }
         if(value.hoy === "Si"){
          $("#btn-apertura-caja").hide();
         }
         var cerrado = value.cierre !== null ? true : false;
          var boton = "<button class='btn btn-info btn-sm botones-cerrar-caja' id='"+value.id+'*'+value.fecha_apertura+"' name='"+value.apertura+"*"+value.monto_inicial+"' cierre='"+cerrado+"' title='Ver detalle'><i class='fa fa-info-circle' aria-hidden='true'></i></button>";
          Tabla.row.add( [
            value.apertura+' ('+value.usuario_apertura+')',
            '<b>$ '+value.monto_inicial+'</b>',
            value.cierre !== null ? value.cierre+' ('+value.usuario_cierre+')' : '',
            '<b>$ '+value.monto_final+'</b>',
            value.observaciones,
            boton
            ]).draw();
       });
  
        }
      }); 
};