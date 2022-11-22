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
  
  <title>Sistema de Gestión</title>

</head>
  
<body>

  <?php include_once '../navbar/navbar.php'; ?>

  <div class="row">

      <div class="container_menu">
        <?php include_once '../menu/menu_izquierdo.php'; ?>
      </div> 

      <div class="container_contenido">

          <div class="card">
            <div class="card-header">Alumnos - Cursos</div>
            <div class="card-body">
              <form action="">
                <div class="form-row">
                 <div class="col-md-7 mb-3">
                  <label>Cursos</label>
                    <select class="form-control" name="cursos" id="cursos">
                      
                    </select>
                </div>
                <div class="col-md-5 mb-3">
                  
                  <!-- <label>Alumnos</label>
                  <select class="form-control" name="alumnos" id="alumnos">
                      
                  </select> -->
                </div>
              </div>
              <div class="form-row">
                <button class="btn btn-primary" type="submit" name="asociar" id="asociar">Guardar</button>
              </div>
              </form>
          </div> 
          <!-- <div class="card-footer">Footer</div> -->
        </div>
      </div>
  


   </div>     

  </body>

  <?php include_once '../../../public/libs/include_libs_js.html'; ?>

  <script src="../../js/alumnos/asociar_cursos.js" type="text/javascript"></script>

</html>