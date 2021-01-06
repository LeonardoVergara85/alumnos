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
          <div class="card-header">Cuotas</div>
          <div class="card-body">

            <form id="formulario_cuotas">
              <div class="form-row">
              <div class="col-md-4 mb-2">
                <label for="validationGradoanio">Mes inicio</label>
                <select  class="form-control" id="mesescurso" name="mesescurso">
                  <option value="1">Enero</option>
                  <option value="2">febrero</option>
                  <option value="3">Marzo</option>
                  <option value="4">Abril</option>
                  <option value="5">Mayo</option>
                  <option value="6">Junio</option>
                  <option value="7">Julio</option>
                  <option value="8">Agosto</option>
                  <option value="9">Septiembre</option>
                  <option value="10">Octubre</option>
                  <option value="11">Noviembre</option>
                  <option value="12">Diciembre</option>
                </select>
              </div>
              <div class="col-md-2 mb-2">
                <label for="validationGradoanio">Dia de vecimiento</label>
                <select  class="form-control" id="dia_vencimiento" name="dia_vencimiento">
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
          <br>
          <table id="table_cuotas" class="table table-striped table-bordered table-hover compact" cellspacing="0" width="100%">
              <thead>
                  <tr>
                      <th>id</th>
                      <th>Mes inicio</th>
                      <th>Dia vencimiento</th>
                      <th>Fecha</th>
                  </tr>
              </thead>
              <tbody id="cuerpoTablaCursos">
              </tbody>
            </table>
        </div> 
      </div>
    </div>


   </div>       

  </body>

  <?php include_once '../../../public/libs/include_libs_js.html'; ?>

  <script src="../../js/cuotas/cuotas.js" type="text/javascript"></script>


</html>

