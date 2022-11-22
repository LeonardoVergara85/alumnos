<?php 
 include_once $_SERVER['DOCUMENT_ROOT'].'/alumnos/app/controller/AuthController.php';
 $authC = new AuthController();
 $authC->ChequearAuth();
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon">Sistema Dues</span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">

      <li class="nav-item active">
       <h4 style="font-family:forte;color:#5591f3">Students Skills v2.0</h4>
        <!-- <img src="../../../public/img/skills_logo2.png" width="200" height="60" alt=""></h4> -->
      </li>
    </ul>

  <!--   <ul class="nav navbar-nav navbar-right">
      <a class="navbar-brand" href="#">
        <img src="../../../public/img/ingles-logo.png" width="130" height="50" alt="">
      </a>
    </ul> -->
     <ul class="nav navbar-nav navbar-right">
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        <i class="fa fa-user"></i> <?php echo $_SESSION['user_name']; ?>
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="../../../app/routes.php?peticion=AuthLogout" onclick=""><i class="fas fa-sign-out-alt"></i> Salir</a>
      </div>
    </li>
    </ul>

  </div>

</nav>

<!-- <br> -->