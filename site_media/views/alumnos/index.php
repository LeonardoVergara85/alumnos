<?php  
include_once $_SERVER['DOCUMENT_ROOT'].'/alumnos/app/controller/ProductosController.php';
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

  <div class="row container_row">

      <div class="container_menu col-sm-2">
        <?php include_once '../menu/menu_izquierdo.php'; ?>
      </div> 

      <div class="container_contenido col-sm-10">
          <div class="card">
            <div class="card-header">Nuevo Alumno</div>
            <div class="card-body">

              <form id="formulario_alumnos">
                <div class="form-row">
                 <div class="col-md-3 mb-3">
                  <label>Documento</label>
                    <input type="text" class="form-control" name="documento" id="documento" placeholder="dni" maxlength="8">
                </div>
                <div class="col-md-3 mb-3">
                  <label>Nombre</label>
                  <input type="text" class="form-control" name="nombre" id="nombre" maxlength="25">
                </div>
                <div class="col-md-3 mb-3">
                  <label>Apellido</label>
                  <input type="text" class="form-control" name="apellido" id="apellido" maxlength="25">
                </div>
                <div class="col-md-3 mb-3">
                  <label for="validationCustom05">Nacimiento</label>
                  <input type="date" class="form-control" name="nacimiento" id="nacimiento">
                </div>

              </div>
              <div class="form-row">
                <div class="col-md-6 mb-3">
                  <label for="validationCustom03">Domicilio</label>
                  <input type="text" class="form-control" name="domicilio" id="domicilio" maxlength="40">
                </div>
                <div class="col-md-3 mb-3">
                  <label for="validationCustom04">Teléfono</label>
                  <input type="text" class="form-control" name="telefono" id="telefono" maxlength="25" value="">
                </div>
                <div class="col-md-3 mb-3">
                  <label for="validationCustom05">Celular</label>
                  <input type="text" class="form-control" name="celular" id="celular">
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-6 mb-3">
                  <label for="validationEscuela">Escuela</label>
                  <input type="text" class="form-control" name="escuela" id="escuela" maxlength="40">
                </div>
                <div class="col-md-1 mb-3">
                  <label for="validationGradoanio">Grado</label>
                  <select  class="form-control" id="gradoanio" name="gradoanio">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                  </select>
                </div>
                <div class="col-md-5 mb-3">
                  <label for="validationEmail">E-mail</label>
                  <input type="email" class="form-control" name="email" id="email" maxlength="30">
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-5 mb-3">
                 <div class="form-group">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="hermanos" name="hermanos">
                  <label class="form-check-label" for="invalidCheck">
                    Tiene hermanos en el organismo?
                  </label>
                </div>
              </div>
            </div>
              </div>
              <button class="btn btn-primary" type="submit" name="guardaralu" id="guardaralu">Guardar</button>
            </form>

          </div> 
          <!-- <div class="card-footer">Footer</div> -->
          <div class="alert alert-danger" role="alert" style="display: none">
            <ul>ddddd</ul>
          </div>
        </div>
      </div>


   </div>       

  </body>

  <?php include_once '../../../public/libs/include_libs_js.html'; ?>

  <script src="../../js/alumnos/alumnos.js" type="text/javascript"></script>


</html>

