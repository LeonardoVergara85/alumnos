<?php 

//var_dump($_SERVER['HTTP_HOST']);
//  $cont = 'contraseña plana';
//  $cont_ = 'contraseña para verificar';

//  $passHash = password_hash($cont, PASSWORD_BCRYPT);

//  echo $passHash;

//  var_dump(password_verify($cont_, $passHash));


?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Sistema de Gestión</title>
    <link rel="stylesheet" href="../../../public/css/estilo_login.css">
    <?php
     include_once '../../../public/libs/include_libs_css.html'; 
    ?>
        <!-- DataTable HeaderFixed CSS -->
</head>
  <body>
  <div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <br>  
    <div class="fadeIn first">
      <b>INGRESAR AL SISTEMA</b>
    </div>
    <br>
    <!-- Login Form -->
    <form id="formulario_acceso">
      <div class="col-md-12 mb-3">
          <input type="text" id="usuario" name="usuario" class="fadeIn second form-control" placeholder="usuario" maxlength="20" style="height: 60px;">
      </div>
      <div class="col-md-12 mb-3">
        <input type="password" id="password" name="password" class="fadeIn third form-control" placeholder="contraseña" maxlength="20" style="height: 60px;">
      </div>
      <div class="text-center" >
        <div class="col-md-12 mb-3" style="margin-left: 12%">
          <div
              class="g-recaptcha"
              data-sitekey="6LdPx9YmAAAAAGiCJT1vd7nP5QyXvqQFaIAIN-3f"
              >
          </div>
        </div>
      </div>
      <div class="" style="">
        <div class="">
          <div class="mb-3">
            <input class="jCaptcha fadeIn form-control input-text-captcha" id="inp_captcha" name="inp_captcha" type="text" placeholder="Ingrese el captcha" style="width: 300px;">
          </div>
        </div>
      </div>
          
      <div class="col-md-12 mb-3 text-center">
              <button type="submit" id="ingreso_captcha" class="btn btn-boton-ingreso">
                <b>Ingresar</b>
              </button>
          </div>
          </form>
    <!-- Remind Passowrd -->
    <div id="formFooter">
    Students Gestión
    </div>

  </div>
</div>


</body>
  <?php include_once '../../../public/libs/include_libs_js.html'; ?>
    <script src="../../../public/libs/DataTables-1.10.12/js/dataTables.min.js" type="text/javascript"></script>
<!--   <script src="../../../public/libs/DataTables-1.10.12/extensions/FixedColumns/js/dataTables.fixedColumns.min.js" type="text/javascript"></script> -->
  <script src="../../js/logueo/logueo2.js" type="text/javascript" charset="utf-8"></script>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</html>