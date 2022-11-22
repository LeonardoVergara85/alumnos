<?php  
// include_once $_SERVER['DOCUMENT_ROOT'].'/skills/app/controller/ProductosController.php';
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
          <div class="card-header">Nuevo Curso</div>
          <div class="card-body">

            <form id="formulario_cursos">
              <div class="form-row">
                <div class="col-md-8 mb-2">
                <label>Nombre curso</label>
                <input type="text" class="form-control" name="nombrecurso" id="nombrecurso" placeholder="Ingresar nombre del curso" maxlength="45">
              </div>
              <div class="col-md-2 mb-2">
                <label for="validationGradoanio">Meses</label>
                <select  class="form-control" id="mesescurso" name="mesescurso">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                  <option value="9">9</option>
                  <option value="10">10</option>
                  <option value="11">11</option>
                  <option value="12">12</option>
                </select>
              </div>
              <div class="col-md-2 mb-2">
                <label for="validationGradoanio">Costo</label>
                  <input type="text" class="form-control" name="costo" id="costo" placeholder="$" maxlength="45">
              </div>
            </div>
            <button class="btn btn-primary" type="submit" name="guardarcurso" id="guardarcurso">Guardar</button>
          </form>

        </div> 
      </div>
    </div>


   </div>       

  </body>

  <?php include_once '../../../public/libs/include_libs_js.html'; ?>

  <script src="../../js/cursos/cursos.js" type="text/javascript"></script>


</html>

