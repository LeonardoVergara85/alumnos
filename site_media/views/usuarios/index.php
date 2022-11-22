<?php  
include_once $_SERVER['DOCUMENT_ROOT'].'/alumnos/app/controller/UsuariosController.php';
// $authC = new AuthController();
// $authC->ChequearAuth(); 

?>

<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <?php include_once '../../../public/libs/include_libs_css.html'; ?>
  
  <title>Sistema Gestión</title>

</head>
  
<body>

  <?php include_once '../navbar/navbar.php'; ?>

  <div class="row container_row">

      <div class="container_menu col-sm-2">
        <?php include_once '../menu/menu_izquierdo.php'; ?>
      </div> 

      <div class="container_contenido col-sm-10">

          <div class="card">
            <div class="card-header">Usuarios del sistema</div>
            <div class="card-body">
            <table id="table_usuarios" class="table table-striped table-bordered table-hover compact" cellspacing="0" width="100%">
              <thead>
                  <tr>
                      <th></th>
                      <th>Dni</th>
                      <th>Nombre</th>
                      <th>Apellido</th>
                      <th>Tipo</th>
                      <th>Alta</th>
                  </tr>
              </thead>
              <tbody id="cuerpoTablaUsu">
              </tbody>
              <tfoot>
                  <tr>
                      <th></th>
                      <th>Dni</th>
                      <th>Nombre</th>
                      <th>Apellido</th>
                      <th>Tipo</th>
                      <th>Alta</th>
                  </tr>
              </tfoot>
            </table>
              
                

          </div> 
          <!-- <div class="card-footer">Footer</div> -->
        </div>
      </div>


   </div>       

  </body>

  <?php include_once '../../../public/libs/include_libs_js.html'; ?>

  <script src="../../js/usuarios/usuarios.js" type="text/javascript"></script>

</html>