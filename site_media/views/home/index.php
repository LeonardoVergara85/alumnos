<?php  
// $authC->ChequearAuth(); 
 //session_start();
 //var_dump($_SESSION);
//$usuario = $_SESSION['usuario_tipo_id'];
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

      <div class="container_contenido col-sm-10" style="height: 500px;">
      <?php  
            //$pass = 'leo1234';    
            //$pass2 = 'leo1234';    
            //$passHash = password_hash($pass, PASSWORD_BCRYPT);
            //echo 'hash '.$passHash;
            //var_dump(password_verify($pass2, $passHash));
            //var_dump($_SESSION);

            // Maria Emma
            //  $pass = 'Maria3mm4';     
            //  $passHash = password_hash($pass, PASSWORD_BCRYPT);
            //  echo 'hash '.$passHash;

            // Graciela Marchetto
            //  $pass = 'GraM4rch3tt0';     
            //  $passHash = password_hash($pass, PASSWORD_BCRYPT);
            //  echo 'hash '.$passHash;

            // Zulema Alud
            //  $pass = 'Zul34lud';     
            //  $passHash = password_hash($pass, PASSWORD_BCRYPT);
            //  echo 'hash '.$passHash;
        ?>  
          <div class="row col-sm-12" style="margin-top:15px;">
          <div class="card-deck">
               <?php
                   if($usuario === "1"){
                   ?><div class="card">
                      <div class="card-body text-center">
                        <h5 class="card-title"><i class="fas fa-user-plus"></i> Inscribir Alumno</h5>
                        <p class="card-text">Inscribir un alumno a un nuevo curso.</p>
                        <button class="btn btn-primary" id="btn-alu-in">Ir a la pantalla</button>
                    </div>
                  </div><?php 
                } ?>
              
                    <div class="card">
                      <div class="card-body text-center">
                        <h5 class="card-title"><i class="fa fa-users"></i> Alumnos</h5>
                        <p class="card-text">Acceso rápido para ver todos los alumnos y sus características.</p>
                        <button class="btn btn-primary" id="btn-alu">Ir a la pantalla</button>
                      </div>
                    </div>
                    <div class="card">
                      <div class="card-body text-center">
                        <h5 class="card-title"><i class="fas fa-book-open"></i> Cursos</h5>
                        <p class="card-text">Acceso rápido para ver todos los cursos y sus características.</p>
                        <button class="btn btn-primary" id="btn-cur">Ir a la pantalla</button>
                      </div>
                    </div>
                    <div class="card">
                      <div class="card-body text-center">
                        <h5 class="card-title"><i class="fas fa-cash-register"></i> Gastos</h5>
                        <p class="card-text">Acceso rápido para ver todos los tipos de gastos y analizarlos.</p>
                        <button class="btn btn-primary" id="btn-gas">Ir a la pantalla</button>
                      </div>
                    </div>
                    <div class="card">
                      <div class="card-body text-center">
                        <h5 class="card-title"><i class="fas fa-info-circle"></i> Cuotas</h5>
                        <p class="card-text">Acceso rápido para ver las cuotas con sus características y personas asociadas.</p>
                        <button class="btn btn-primary" id="btn-cuo">Ir a la pantalla</button>
                    </div>
                  </div>
          </div>
       
      </div>
      <br>
      <div class="form-row" id="div-msj-error">
      </div>
      <div class="form-row" id="div-msj-error-cuotaset" style="display:none;">
              <div class="alert alert-warning" role="alert">
              <i class="fas fa-exclamation-triangle"></i> No se puede crear cuotas ya que no hay configuración de cuotas. Vaya a <b>Configuraciones / Configurar cuotas</b>
              </div>
            </div>
    
   </div> 
   
    <div class="modal fade" id="msj_anio" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog modal-xl">
      <div class="modal-content text-center">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4><font color="orange">IMPORTANTE!!!</font></h4>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
           <h4>El sistema ha detectado que su año lectivo no está actualizado.</h4>
           <br>
           <h6>Vaya a la pestaña <STRONG>Configiraciones / Año lectivo</STRONG> para actualizarlo.</h6>

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
  <script src="../../js/home/home.js" type="text/javascript"></script>
</html>

