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
          <div class="card-header">Caja chica</div>
          <div class="card-body">
              <?php
               if($_SESSION['usuario_tipo_id'] === "1"){
               ?><div class="form-row">
                <button class="btn btn-primary" type="button" id="btn-apertura-caja">
                  <i class="fa fa-plus" aria-hidden="true"></i> Apertura de caja
                </button>
              </div>
             <?php 
            } ?>  
          <br>
            <div class="">
                <table id="table_caja" class="table table-bordered table-hover compact"  style="width: 100%">
                    <thead>
                        <tr>
                        <th>Apertura</th>
                        <th>Monto inicial</th>
                        <th>Cierre</th>
                        <th>Monto final</th>
                        <th>Observaciones</th>
                        <th></th>
                        </tr>
                    </thead>
                    <tbody id="cuerpoTablaCaja">
                    </tbody>
                    </table>
                </div>
        </div> 
      </div>
    </div>



   </div>  


  <!-- Modal -->
<div class="modal fade" id="MyModalCaja" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog bd-example-modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLongTitle">Apertura de caja</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="formulario_cajas">
            
            <div class="form-row">
            <div class="col-md-5 mb-2">
                <label>Monto inicial</label>
                <input class="form-control imp" type="text" name="monto" id="monto" maxlength="12">
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-12 mb-2">
                <div class="form-group green-border-focus">
                  <label for="exampleFormControlTextarea5">Observaciones</label>
                  <textarea class="form-control imp" id="observacion" name="observacion" rows="2" maxlength='100'></textarea>
                </div>
              </div>
            </div>
            <br>
            <input type="hidden" name="tipo_accion" id="tipo_accion" value="">
            <input type="hidden" name="id_activo" id="id_activo" value="">
            <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <?php
           if($_SESSION['usuario_tipo_id'] === "1"){
           ?><button type="submit" id = "guardarCaja" class="btn btn-primary">Guardar</button><?php 
        } ?>
        
      </div>
      </form>
    </div>
      
    </div>
  </div>
</div>

  <!-- Modal -->
<!-- <div class="modal fade modal-xl" id="MyModalCajaCerrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog bd-example-modal-lg" role="document"> -->
<div class="modal fade" id="MyModalCajaCerrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-xl modal-dialog-centered" role="document" style="max-width: 70vw;">  
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLongTitleDetalle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="formulario_caja_cerrar">
        <input type="hidden" name="idCaja" id="idCaja" value="">
        <br>
        <div id="spinner_caja" class="text-center py-3">
              <i class="fas fa-spinner fa-spin fa-2x text-primary"></i>
            <p class="mt-2">Cargando...</p>
        </div>

            <div class="" id="table_caja_detalle_cont" style="display:none">
                <table id="table_caja_detalle" class="table table-bordered table-hover compact"  style="width: 100%">
                    <thead>
                        <tr>
                          <th>Concepto</th>
                          <th>Monto</th>
                        </tr>
                    </thead>
                    <tbody id="cuerpoTablaCaja">
                    </tbody>
                </table>
            
             <div class="form-row">
            <div class="col-md-5 mb-2">
                <label>Monto final</label>
                <input class="form-control imp" type="text" name="monto_final" id="monto_final" maxlength="14" disabled>
              </div>
            </div>
            </div>
            <input type="hidden" name="id_caja" id="id_caja" value="">
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <?php
           if($_SESSION['usuario_tipo_id'] === "1"){
           ?><button type="submit" id="cerrarCaja" class="btn btn-primary">Cerrar caja chica</button><?php 
        } ?>
        
      </div>
      </form>
    </div>
      
    </div>
  </div>
</div>

  </body>

  <?php include_once '../../../public/libs/include_libs_js.html'; ?>

  <script src="../../js/caja/caja.js" type="text/javascript"></script>


</html>
