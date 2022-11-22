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
            <div class="card-header">Cursos - Ver alumnos</div>
            <div class="card-body">
              <form action="">
                <div class="form-row">
                 <div class="col-md-7 mb-3">
                  <label>Cursos</label>
                    <select class="form-control" name="cursos" id="cursos">
                      <option value="0">Seleccionar..</option>
                      option
                    </select>
                </div>
                <input type="hidden" name="text-curso" id="text-curso"/>
                <div class="col-md-2 mb-3">
                  <label>Año</label>
                  <select class="form-control" name="anio_lectivo" id="anio_lectivo">
                      <option value="0">Seleccionar..</option>
                      option
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                  <button class="btn btn-primary asociarmodal" type="button" style="margin-top: 30px;" name="buscar_alumnos" id="buscar_alumnos" disabled=""><i class="fa fa-search" aria-hidden="true"></i> Buscar</button>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-12 mb-2">
                  <table id="table_alumnos" class="table table-striped table-bordered table-hover compact" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>Curso</th>
                        <th>Documento</th>
                        <th>Nombre</th>
                        <th>Insc.</th>
                        <th>Año lectivo</th>
                      </tr>
                    </thead>
                    <tbody id="cuerpoTablaHistorico">
                    </tbody>
                  </table>
               </div>
               <!--  <button class="btn btn-primary" type="submit" name="asociar" id="asociar">Guardar</button> -->
              </div>
      
              </form>
          </div> 
          <!-- <div class="card-footer">Footer</div> -->
        </div>
      </div>
  


   </div> 

             <!-- The Modal -->
  <div class="modal fade" id="modalAsociar" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Cursos - Precio Histórico</h4>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
           <form id="formulario_asociar">
              <div class="form-row">
                <div class="col-md-12 mb-2">
                  <table id="table_cursos_asociar" class="table table-striped table-hover compact" cellspacing="0" width="100%">
                    <thead>
                        <th style="width: 20%;">seleccionar</th>
                        <th style="width: 30%;">Documento</th>
                        <th style="width: 50%;">Nombre</th>
                    </thead>
                    <tbody id="cuerpoTablaAsociar">
                    </tbody>
                  </table>
               </div>
            </div>
            <button class="btn btn-primary" type="button" name="buscar_historico" id="buscar_historico">Guardar</button>
          </form>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btnclose" data-dismiss="modal">Cerrar</button>
        </div>
        
      </div>
    </div>
  </div>     

  </body>

  <?php include_once '../../../public/libs/include_libs_js.html'; ?>

  <script src="../../js/cursos/cursos_ver_alumnos.js" type="text/javascript"></script>

</html>