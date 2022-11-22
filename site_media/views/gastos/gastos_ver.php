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
            <div class="card-header">Gastos</div>
            <div id="div-spinner" style="display:none; position: absolute;margin-left: 450px;margin-top: 0px;background-color: darkseagreen;padding: 10px;/*! margin: 0; */margin-top: 150px;z-index: 100;">
              <p class="primary">Buscando <i class="fa fa-spinner fa-spin fa-2x fa-fw"></i></p>
            </div>
            <div class="card-body">
          <!-- Nav tabs -->
          <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#hoy">Guardados hoy</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#buscarfecha">Buscar por fecha</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#buscartipogasto">Buscar por Tipo</a>
            </li>
          </ul>

          <!-- Tab panes -->
          <div class="tab-content">
            <div id="hoy" class="container tab-pane active"><br>
              <table id="table_gastos" class="table table-striped table-bordered table-hover compact" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>Gasto</th>
                    <th>Importe</th>
                    <th>Fecha</th>
                    <th>Tipo pago</th>
                    <th>Pagado</th>
                    <th>Observaciones</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody id="cuerpoTablaGastos">
                </tbody>
              </table>
            </div>
            <div id="buscarfecha" class="container tab-pane fade"><br>
              <form action="" id="form-bucarfecha">
                <div class="form-row">
                  <div class="col-md-4 mb-2">
                    <label>Desde</label>
                    <input class="form-control" type="date" name="fechadesde" id="fechadesde">
                  </div>
                  <div class="col-md-4 mb-2">
                    <label>Hasta</label>
                    <input class="form-control" type="date" name="fechahasta" id="fechahasta">
                  </div>
                  <div class="col-md-4 mb-2">
                    <button class="btn btn-info btn-sm" type="submit" style="margin-top: 35px;"><i class="fas fa-search"></i> Buscar</button>
                  </div>
                </div>
              </form>
              <br>
              <table id="table_gastos_fecha" class="table table-striped table-bordered table-hover compact" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>Gasto</th>
                    <th>Importe</th>
                    <th>Fecha</th>
                    <th>Tipo pago</th>
                    <th>Pagado por</th>
                    <th>Observaciones</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody id="cuerpoTablaGastos">
                </tbody>
              </table>
            </div>
            <div id="buscartipogasto" class="container tab-pane fade"><br>
              <form action="" id="form-bucartipo">
                <div class="form-row">
                  <div class="col-md-2 mb-2">
                    <label>Desde</label>
                    <input class="form-control" type="date" name="fechadesde_tipo" id="fechadesde_tipo">
                  </div>
                  <div class="col-md-2 mb-2">
                    <label>Hasta</label>
                    <input class="form-control" type="date" name="fechahasta_tipo" id="fechahasta_tipo">
                  </div>
                  <div class="col-md-6 mb-2">
                    <label>Tipo de gastos</label>
                    <select class="form-control" name="tipo_gasto_tipo" id="tipo_gasto_tipo">
                      <option value="default">Seleccionar..</option>
                    </select>
                  </div>
                  <div class="col-md-2 mb-2">
                    <button class="btn btn-info btn-sm" type="submit" style="margin-top: 35px;"><i class="fas fa-search"></i> Buscar</button>
                  </div>
                </div>
              </form>
              <br>
              <table id="table_gastos_tipo" class="table table-striped table-bordered table-hover compact" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>Gasto</th>
                    <th>Importe</th>
                    <th>Fecha</th>
                    <th>Tipo pago</th>
                    <th>Pagado por</th>
                    <th>Observaciones</th>
                  </tr>
                </thead>
                <tbody id="cuerpoTablaGastos">
                </tbody>
              </table>
            </div>
          </div>
          
          </div> 
          <!-- <div class="card-footer">Footer</div> -->
        </div>
        <!-- TOTAL
        <input type="text" value="" id="tot"> -->
      </div>

   </div>   

          <!-- The Modal -->
  <div class="modal fade" id="modalDetalleGasto" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Detalle del Gasto</h4>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <form id="formulario_mod_gastos">
              <div class="form-row">
              <div class="col-md-8 mb-2">
                <label for="validationGradoanio">Denominaciones</label>
                <select  class="form-control" id="tipo_gasto_" name="tipo_gasto_">
                
                </select>
              </div>
              <div class="col-md-4 mb-2">
                <label>Importe</label>
                <input class="form-control" type="text" name="importe_" id="importe_">
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-12 mb-2">
                <label>Observaciones</label>
                <input class="form-control" type="text" name="observaciones_" id="observaciones_">
              </div>
            </div>
            <div class="form-row">
            <div class="col-md-6 mb-2">
                <label>Forma de pago</label>
                <select class="form-control" name="formapago_" id="formapago_">
                </select>
            </div>
            <div class="col-md-6 mb-2">
                <label>Pagado por</label>
                <select class="form-control" name="pagadopor_" id="pagadopor_">
                  <option value="1">Caja chica</option>
                  <option value="2">Graciela</option>
                  <option value="3">Maria Emma</option>
                </select>
            </div>
          </div>
            
            <button class="btn btn-primary" type="submit" name="modificargasto" id="modificargasto">
              Modificar
            </button>
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

  <script src="../../js/gastos/gastos_ver3.js" type="text/javascript"></script>

</html>