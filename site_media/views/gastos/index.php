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
          <div class="card-header">Nuevo Gasto</div>
          <div class="card-body">

            <form id="formulario_gastos">
              <div class="form-row">
              <div class="col-md-8 mb-2">
                <label for="validationGradoanio">Denominaciones</label>
                <select  class="form-control" id="tipo_gasto" name="tipo_gasto">
                
                </select>
              </div>
              <div class="col-md-4 mb-2">
                <label>Importe</label>
                <input class="form-control" type="text" name="importe" id="importe" maxlength="10">
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-8 mb-2">
                <label>Observaciones</label>
                <input class="form-control" type="text" name="observaciones" id="observaciones">
              </div>
              <div class="col-md-2 mb-2">
                <label>Forma de pago</label>
                <select class="form-control" name="formapago" id="formapago">
                </select>
              </div>
              <div class="col-md-2 mb-2">
                <label>Pagado por</label>
                <select class="form-control" name="pagadopor" id="pagadopor">
                  <option value="1">Caja chica</option>
                  <option value="2">Graciela</option>
                  <option value="3">Maria Emma</option>
                </select>
              </div>
            </div>
            <button class="btn btn-primary" type="submit" name="guardargasto" id="guardargasto">
              Guarda
            </button>
          </form>

        </div> 
      </div>
    </div>


   </div>       

  </body>

  <?php include_once '../../../public/libs/include_libs_js.html'; ?>

  <script src="../../js/gastos/gastos2.js" type="text/javascript"></script>


</html>

