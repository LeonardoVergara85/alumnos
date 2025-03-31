$(document).ready(function(){


    
    $(document).on("click", "#btn-nuevo-respaldo", function () {

        toastr.success('Se ha realizó el resplado exitosamente');

        $.ajax({
            type: "POST",
            url: "../../../app/routes.php",
            dataType: 'json',
            data: {
              peticion : 'backup_db'
            },
            success: function (resp) {
                if(resp){
                    toastr.success('Se ha realizó el resplado exitosamente');
                }else{
                    toastr.error('Se ha realizó el resplado exitosamente');
                }
            }
            
          }); 

      });
});