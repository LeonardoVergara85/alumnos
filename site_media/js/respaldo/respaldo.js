$(document).ready(function(){

    buscarUltimoRespaldo();

    
 
      
      $(document).on("click", "#btn-nuevo-respaldo", function () {
          
        toastr.info('Generando respaldo, por favor espera...');

        // Crear un enlace oculto para la descarga del archivo .sql
        let backupUrl = "../../../app/routes.php?peticion=backup_db";

        
        // Redirigir a la URL para iniciar la descarga del respaldo
        window.location.href = backupUrl;
        buscarUltimoRespaldo();
       // toastr.success('Se ha realizado el respaldo exitosamente');
    });  
});

function buscarUltimoRespaldo(){
    
    $.ajax({
        type: "POST",
        url: "../../../app/routes.php",
        dataType: 'json',
        data: {
          peticion : 'ultimo_respaldo',
        },
        success: function (resp) {
  
          var aux = resp;
  
          $.each( aux, function( key, value ) {
  
             // Formatear la fecha como "d/m/Y H:i"
            //let dia = value.fecha.getDate().toString().padStart(2, "0");
           // let mes = (value.fecha.getMonth() + 1).toString().padStart(2, "0");
            //let año = value.fecha.getFullYear();
            //let horas = value.fecha.getHours().toString().padStart(2, "0");
           // let minutos = value.fecha.getMinutes().toString().padStart(2, "0");
            
           $('#texto').html('Último respaldo '+value.fecha); 
           
      });
  
        }
      }); 
  };
