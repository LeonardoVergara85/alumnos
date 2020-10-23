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

  <div class="row container_row">

      <div class="container_menu col-sm-2">
        <?php include_once '../menu/menu_izquierdo.php'; ?>
      </div> 

      <div class="container_contenido col-sm-10">

          <div class="card">
            <div class="card-header">Cursos</div>
            <div class="card-body">
            <table id="table_cursos" class="table table-striped table-bordered table-hover compact" cellspacing="0" width="100%">
              <thead>
                  <tr>
                      <th>Nombre del Curso</th>
                      <th>Meses</th>
                      <th>Costo</th>
                      <th>Año</th>
                      <th></th>
                  </tr>
              </thead>
              <tbody id="cuerpoTablaCursos">
              </tbody>
            </table>
          </div> 
          <!-- <div class="card-footer">Footer</div> -->
        </div>
      </div>
  
          <!-- The Modal -->
  <div class="modal fade" id="modalDetalleCurso" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Detalle del Curso</h4>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
           <form id="formulario_cursos_mod">
              <div class="form-row">
                <div class="col-md-10 mb-2">
                <label>Nombre curso</label>
                <input type="text" class="form-control" name="nombrecurso_" id="nombrecurso_" placeholder="Ingresar nombre del curso" maxlength="40">
              </div>
              <div class="col-md-2 mb-2">
                <label for="validationGradoanio">Meses</label>
                <select  class="form-control" id="mesescurso_" name="mesescurso_">
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
            </div>
            <div class="form-row">
              <div class="col-md-2 mb-2">
                <label>Costo</label>
                <input type="text" class="form-control" name="costo_" id="costo_" disabled="">
              </div>
            </div>
            <button class="btn btn-primary" type="submit" name="modificarcurso" id="modificarcurso">Modificar</button>
          </form>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btnclose" data-dismiss="modal">Cerrar</button>
        </div>
        
      </div>
    </div>
  </div>  

            <!-- The Modal -->
  <div class="modal fade" id="modalmodcosto" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Detalle del Curso - Modificar Costo</h4>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
           <form id="modificar_costo_curso">
              <div class="form-row">
                <div class="col-md-10 mb-2">
                <label>Nombre curso</label>
                <input type="text" class="form-control" name="nombrecurso__" id="nombrecurso__" placeholder="Ingresar nombre del curso" maxlength="40" disabled="">
              </div>
              <div class="col-md-2 mb-2">
                <label for="validationGradoanio">Meses</label>
                <select  class="form-control" id="mesescurso__" name="mesescurso__" disabled="">
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
            </div>
            <div class="form-row">
              <div class="col-md-2 mb-2">
                <label>Costo</label>
                <input type="text" class="form-control" name="costo__" id="costo__">
                <input type="hidden" class="form-control" name="costo__2" id="costo__2">
                <input type="hidden" class="form-control" name="id_ci__" id="id_ci__">
              </div>
              <div class="col-md-4 mb-2">
                <label>fecha</label>
                <input type="text" class="form-control" name="fecha__" id="fecha__" disabled="">
              </div>
            </div>
            <button class="btn btn-primary" type="submit" name="modificarcosto" id="modificarcosto">Modificar Costo</button>
          </form>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btnclose" data-dismiss="modal">Cerrar</button>
        </div>
        
      </div>
    </div>
  </div>  

           <!-- The Modal -->
  <div class="modal fade" id="eliminarCurso">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title danger">Eliminar Curso</h4>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          Realmente desea eliminar este curso?
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-danger btneliminarCurso" name="btneliminarCurso" id="btneliminarCurso">Aceptar</button>
          <button type="button" class="btn btn-secondary btnclose" data-dismiss="modal">Cancelar</button>
        </div>
        
      </div>
    </div>
  </div> 

  <!-- The Modal Renovar año lectivo-->
  <div class="modal fade" id="renovarCurso">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title danger">Renovar curso</h4>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          Realmente desea <strong>renovar</strong> este curso?
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-danger" name="btnRenovarCurso" id="btnRenovarCurso">Aceptar</button>
          <button type="button" class="btn btn-secondary btnclose" data-dismiss="modal">Cancelar</button>
        </div>
        
      </div>
    </div>
  </div> 

   </div>     

  </body>

  <?php include_once '../../../public/libs/include_libs_js.html'; ?>

  <script src="../../js/cursos/cursos_ver.js" type="text/javascript"></script>

</html>