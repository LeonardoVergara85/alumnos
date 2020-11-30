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
            <div class="card-header">Configuraciones del año lectivo</div>
            <div class="card-body">
            <div class="form-row">
                <div class="alert alert-info" role="alert" id="mensaje-anio">
                </div>
            </div>
            <div class="form-row">
            <div class="col-md-2 mb-2" style="margin-top:5px;">
                <button class="btn btn-primary" type="submit" name="renovar_anio_lectivo" id="renovar_anio_lectivo"><i class="fas fa-retweet"></i> Renovar</button>
              </div>  
            </div>
            
        
          </div> 
          <!-- <div class="card-footer">Footer</div> -->
        </div>
      </div>
  
  

           <!-- The Modal -->
  <div class="modal fade" id="modalRenovarAnio">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title danger"><i class="fas fa-retweet"></i> Renovar año lectivo</h4>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          ¿Realmente desea renovar el año lectivo para todos los cursos?
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-primary " name="btnrenovarAnio" id="btnrenovarAnio">Aceptar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        </div>
        
      </div>
    </div>
  </div> 

  

   </div>     

  </body>

  <?php include_once '../../../public/libs/include_libs_js.html'; ?>

  <script src="../../js/cursos/anio_lectivo.js" type="text/javascript"></script>

</html>