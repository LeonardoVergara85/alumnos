<?php  
// include_once $_SERVER['DOCUMENT_ROOT'].'/skills/app/controller/ProductosController.php';
// $authC = new AuthController();
// $authC->ChequearAuth(); 
//session_start();
//var_dump($_SESSION['user_id']);
//$usuario=$_SESSION['user_id'];
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
          <div class="card-header">Nuevo Activo</div>
          <div class="card-body">
          <?php
               if($_SESSION['usuario_tipo_id'] === "1"){
               ?><div class="form-row">
                <button class="btn btn-primary" type="button" id="btn-nuevoactivo">
                  <i class="fa fa-plus" aria-hidden="true"></i> Nuevo
                </button>
              </div>
             <?php 
            } ?>    
          
          <br>
          <div class="">
          <table id="table_activos" class="table table-bordered table-hover compact"  style="width: 100%">
                <thead>
                  <tr>
                    <th>Activo</th>
                    <th>Importe</th>
                    <th>Fecha</th>
                    <th>Tipo pago</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody id="cuerpoTablaActivos">
                </tbody>
              </table>
          </div>
           

        </div> 
      </div>
    </div>


   </div>  


<!-- Modal -->
<div class="modal fade" id="MyModalActivos" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog bd-example-modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLongTitle">Nuevo Activo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="formulario_activos">
            <div class="form-row">
              <div class="col-md-12 mb-2">
                <!-- <label for="validationGradoanio">Descripción</label>
                <input class="form-control" type="text" name="activo_desc" id="activo_desc" maxlength="150"> -->
                <div class="form-group green-border-focus">
                  <label for="exampleFormControlTextarea5">Descripción</label>
                  <textarea class="form-control imp" id="activo_desc" name="activo_desc" rows="2" maxlength='100'></textarea>
                </div>
              </div>
            </div>
            <div class="form-row">
            <div class="col-md-5 mb-2">
                <label>Importe</label>
                <input class="form-control imp" type="text" name="importe" id="importe" maxlength="10">
              </div>
         
              <div class="col-md-7 mb-2">
                <label>Forma de pago</label>
                <select class="form-control imp" name="formapago_activo" id="formapago_activo">
                </select>
              </div>
            </div>
            <br>
            <input type="hidden" name="tipo_accion" id="tipo_accion" value="">
            <input type="hidden" name="id_activo" id="id_activo" value="">
            <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <?php
           if($_SESSION['usuario_tipo_id'] === "1"){
           ?><button type="submit" id = "guardarActivo" class="btn btn-primary">Guardar</button><?php 
        } ?>
        
      </div>
          </form>
      </div>
      
    </div>
  </div>
</div>

  </body>

  <?php include_once '../../../public/libs/include_libs_js.html'; ?>

  <script src="../../js/activos/activos.js" type="text/javascript"></script>


</html>

