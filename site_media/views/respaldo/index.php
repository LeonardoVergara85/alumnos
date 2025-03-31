<?php  
// include_once $_SERVER['DOCUMENT_ROOT'].'/skills/app/controller/ProductosController.php';
// $authC = new AuthController();
// $authC->ChequearAuth(); 
//session_start();
//var_dump($_SESSION['user_id']);
//$usuario=$_SESSION['user_id'];
//phpinfo();
?>

<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <?php include_once '../../../public/libs/include_libs_css.html'; ?>
  
  <title>Sistema de Gestión</title>

</head>
  
<body>

  <?php include_once '../navbar/navbar.php'; ?>

  <div class="row container_row">

      <input type="hidden" name="usuario_id" id="usuario_id" value="<?php echo $_SESSION['user_id'];?>">
      <div class="container_menu col-sm-2">
        <?php include_once '../menu/menu_izquierdo.php'; ?>
      </div> 

      <div class="container_contenido col-sm-10">
        <div class="card">
          <div class="card-header">Respaldos de seguridad</div>
          <div class="card-body">
         <div class="form-row">
                <button class="btn btn-primary" type="button" id="btn-nuevo-respaldo">
                  <i class="fa fa-plus" aria-hidden="true"></i> Nuevo respaldo
                </button>
              </div>
              <br>
              <br>
          <div class="form-row">
            Último respaldo el 30/03/2025
          </div>
          <br>
        </div> 
      </div>
    </div>


   </div>  

  </body>

  <?php include_once '../../../public/libs/include_libs_js.html'; ?>

  <script src="../../js/respaldo/respaldo.js" type="text/javascript"></script>


</html>

