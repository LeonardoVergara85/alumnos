var f = new Date(); // fecha para mostrar en los archivos de export 
 var Tabla = $('#table_balance_diario').DataTable( {
  dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ],
        buttons: [
          {
              
              extend:    'pdfHtml5',
              text:      '<i class="fa fa-file-pdf"></i>',
              titleAttr: 'PDF',
              message: 'Fecha de impresión ('+f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear()+')',
              download: 'open',
              title: 'Balance Diario - Skills',
              footer: true
          },
          {
              extend: 'excel',
              text:'<i class="far fa-file-excel"></i>',
              titleAttr: 'Excel',
              message: 'Fecha de impresión ('+f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear()+')',
              messageBottom: null,
              title: 'Balance Diario - Skills',
              footer: true
          },
          {
            extend: 'print',
            text:      '<i class="fa fa-print" ></i>',
            titleAttr: 'Imprimir',
            message: 'Fecha de impresión ('+f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear()+')',
            messageBottom: null,
            title: 'Balance Diario - Skills',
            footer: true
        }
      ],

 "language": {
        "url": "../../../public/libs/DataTables-1.10.12/extensions/table-spanish.json"
    },

      'columnDefs': [
  {
      "targets": 0, // your case first column
      "className": "text-center",
       "width": "10%",
 },{
      "targets": 1, // your case first column
      "className": "text-left",
       "width": "20%"
 },{
      "targets": 2, // your case first column
      "className": "text-left",
       "width": "30%"
 },{
      "targets": 3, // your case first column
      "className": "text-center",
       "width": "10%"
 },{
      "targets": 4, // your case first column
      "className": "text-center",
       "width": "10%"
 },{
      "targets": 5, // your case first column
      "className": "text-center",
       "width": "10%"
 },{
      "targets": 6, // your case first column
      "className": "text-left",
       "width": "10%"
 },
 ],
 });


  var TablaFecha = $('#table_gastos_fecha').DataTable( {
  dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ],
        buttons: [
          {
              
              extend:    'pdfHtml5',
              text:      '<i class="fa fa-file-pdf"></i>',
              titleAttr: 'PDF',
              message: 'Fecha de impresión ('+f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear()+')',
              download: 'open',
              title: 'Balance por fecha - Skills',
              footer: true
          },
          {
              extend: 'excel',
              text:'<i class="far fa-file-excel"></i>',
              titleAttr: 'Excel',
              message: 'Fecha de generación ('+f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear()+')',
              messageBottom: null,
              title: 'Balance por fecha - Skills',
              footer: true
          },
          {
            extend: 'print',
            text:      '<i class="fa fa-print" ></i>',
            titleAttr: 'Imprimir',
            message: 'Fecha de impresión ('+f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear()+')',
            messageBottom: null,
            title: 'Balance por fecha - Skills',
            footer: true
        }
      ],

 "language": {
        "url": "../../../public/libs/DataTables-1.10.12/extensions/table-spanish.json"
    },

      'columnDefs': [
  {
      "targets": 0, // your case first column
      "className": "text-center",
       "width": "10%",
 },{
      "targets": 1, // your case first column
      "className": "text-left",
       "width": "20%"
 },{
      "targets": 2, // your case first column
      "className": "text-left",
       "width": "30%"
 },{
      "targets": 3, // your case first column
      "className": "text-center",
       "width": "10%"
 },{
      "targets": 4, // your case first column
      "className": "text-center",
       "width": "10%"
 },{
      "targets": 5, // your case first column
      "className": "text-center",
       "width": "10%"
 },{
      "targets": 6, // your case first column
      "className": "text-left",
       "width": "10%"
 },
 ],
 });

$(document).ready(function(){

  const hoy = new Date(); // crea un objeto Date con la fecha actual
  const dia = hoy.getDate().toString().padStart(2, '0'); // obtiene el día del mes con dos cifras (del 01 al 31)
  const mes = (hoy.getMonth() + 1).toString().padStart(2, '0'); // obtiene el mes con dos cifras (del 01 al 12)
  const anio = hoy.getFullYear(); // obtiene el año con 4 dígitos
  
  const fechaHoy = `${anio}-${mes}-${dia}`; // crea una cadena con la fecha de hoy en formato aaaa-mm-dd
 
  $('#div-spinner').hide();
  $('#fechahasta_').val(fechaHoy);

	buscarBalanceDiario();

    $('#form-bucar_fecha_balance').validate({
        submitHandler: function (form) {
          // cuando va bien
          $('#div-spinner').show();
            var fechadesde = $('#fechadesde_').val();
            var fechahasta = $('#fechahasta_').val();
            var efectivo = $('#solo_efectivo').is(':checked') ? 1 : 0;
            
            // $('#guardargasto').attr('disabled','disabled');
            TablaFecha.clear().draw();

            $.ajax({
              type: "POST",
              url: "../../../app/routes.php",
              dataType: 'json',
              data: {

                peticion : 'buscar_balance_fecha',
                 fechad : fechadesde,
                 fechah : fechahasta,
                efectivo : efectivo
              },
              success: function (resp) {

               var balance = resp;

               $.each( balance, function( key, value ) {

                var debe;
                if((value.debe == '') || (value.debe == '-')){
                  debe = '0'
                }else{
                  debe = value.debe;
                }

                var haber;
                if((value.haber == '') || (value.haber == '-')){
                  haber = '0'
                }else{
                  haber = value.haber;
                }

                var saldo;
                if(value.saldo == ''){
                  saldo = '0'
                }else{
                  saldo = value.saldo;
                }

                var pagadopor;
                if(value.pagadopor == ''){
                  pagadopor = '-'
                }else if((value.forma_pago != '')&&(value.forma_pago != null)){
                  pagadopor = value.pagadopor+' | '+value.forma_pago;
                }else{
                  pagadopor = value.pagadopor;
                }

                TablaFecha.row.add( [
                  value.fecha,
                  value.denominacion,
                  value.detalle,
                  debe,
                  haber,
                  saldo,
                  pagadopor
                  ]).draw();
              });

              $('#div-spinner').hide();
              
              var total = 0;
              $('#table_gastos_fecha').DataTable().rows().data().each(function(el, index){
                //Asumiendo que es la columna 5 de cada fila la que quieres agregar a la sumatoria
                total += el[3];
              });
              console.log(total);
             }
            }); 
           
        },
        rules: {
            fechadesde_: {required:true,date:true,},
            fechahasta_: {required:true,date:true,},
        },
        messages: {
            fechadesde_: {
                        required: 'Complete este campo',
                        date: 'Complete dd/mm/aaaa',
            },
            fechahasta_: {
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

   
});

function buscarBalanceDiario(){

	$.ajax({
        type: "POST",
        url: "../../../app/routes.php",
        dataType: 'json',
        data: {
          peticion : 'ver_balance_diario'
        },
        success: function (resp) {

          var balance = resp;

          $.each( balance, function( key, value ) {

            var debe;
            if((value.debe == '') || (value.debe == '-')){
              debe = '0';
            }else{
              debe = value.debe;
            }

            var haber;
            if((value.haber == '') || (value.haber == '-')){
              haber = '0';
            }else{
              haber = value.haber;
            }

            var saldo;
            if(value.saldo == ''){
              saldo = '0';
            }else{
              saldo = value.saldo;
            }

            var pagadopor;

            if((value.pagadopor != '') && (value.forma_pago != '')){
              pagadopor = value.pagadopor+'|'+value.forma_pago;
            }else if((value.pagadopor != '') && (value.forma_pago == '')){
              pagadopor = value.pagadopor;
            }else{
              pagadopor = '-'
            }

            Tabla.row.add( [
                value.fecha,
                value.denominacion,
                value.detalle,
                debe,
                haber,
                saldo,
                pagadopor
                ]).draw();
      });

        }

      });
}

