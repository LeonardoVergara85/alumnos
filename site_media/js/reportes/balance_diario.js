 var Tabla = $('#table_balance_diario').DataTable( {
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

  $('#buscando').hide();

	buscarBalanceDiario();

    $('#form-bucar_fecha_balance').validate({
        submitHandler: function (form) {
          // cuando va bien
          $('#buscando').show();
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
                if(value.debe == ''){
                  debe = '-'
                }else{
                  debe = value.debe;
                }

                var haber;
                if(value.haber == ''){
                  haber = '-'
                }else{
                  haber = value.haber;
                }

                var saldo;
                if(value.saldo == ''){
                  saldo = '-'
                }else{
                  saldo = value.saldo;
                }

                var pagadopor;
                if(value.pagadopor == ''){
                  pagadopor = '-'
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

              $('#buscando').hide();
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
            if(value.debe == ''){
              debe = '-'
            }else{
              debe = value.debe;
            }

            var haber;
            if(value.haber == ''){
              haber = '-'
            }else{
              haber = value.haber;
            }

            var saldo;
            if(value.saldo == ''){
              saldo = '-'
            }else{
              saldo = value.saldo;
            }

            var pagadopor;
            if(value.pagadopor == ''){
              pagadopor = '-'
            }else{
              pagadopor = value.pagadopor;
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

