<?php $usuario = $_SESSION['usuario_tipo_id'];?>

<div class="">
          <div id="jquery-accordion-menu" class="jquery-accordion-menu">
            <div class="jquery-accordion-menu-header">Panel de Acciones</div>
            <ul>
              <li class="active"><a href="../home"><i class="fa fa-home"></i>Inicio </a></li>
              <?php
                        if($usuario === "1"){
                        ?><li><a href="#"><i class="fas fa-cog"></i>Configuraciones </a>
                            <ul class="submenu">
                              <li><a href="../cuotas">Configurar Cuotas </a></li>
                              <li><a href="../cursos/anio_lectivo.php">Año lectivo </a></li>
                            </ul>
                          </li>
                         <?php 
                    } ?>
              
              <li><a href="#"><i class="fa fa-plus-circle" aria-hidden="true"></i>Activos </a>
                <ul class="submenu">
                  <li><a href="../activos">Registrar Activo </a></li>
                </ul>
              </li>
              <li><a href="#"><i class="fa fa-users"></i>Alumnos </a>
                <ul class="submenu">
                     <?php
                        if($usuario === "1"){
                        ?><li><a href="../alumnos">Registrar Alumno </a></li><?php 
                    } ?>
                  <li><a href="../alumnos/alumnos_ver.php">Ver alumnos </a></li>
                  <!-- <li><a href="../alumnos/asociar_cursos.php">Asociar Curso </a></li> -->
                    <!-- <ul class="submenu">
                      <li><a href="#">Graphics </a></li>
                      <li><a href="#">Vectors </a></li>
                      <li><a href="#">Photoshop </a></li>
                      <li><a href="#">Fonts </a></li>
                    </ul> -->
                  </li>
                  <!-- <li><a href="#">Consulting </a></li> -->
                </ul>
              </li>
              <!-- <li><a href="#"><i class="fa fa-newspaper-o"></i>News </a></li> -->
              <li><a href="#"><i class="fas fa-book-open"></i>Cursos </a>
                <ul class="submenu">
                    <?php
                        if($usuario === "1"){
                        ?><li><a href="../cursos">Registrar curso </a></li><?php 
                    } ?>
                  
                  <!-- <li><a href="../cursos/cursos_ver.php">Ver cursos </a><span class="jquery-accordion-menu-label">10 </span></li> -->
                  <li><a href="../cursos/cursos_ver.php">Ver cursos </a></li>
                  <li><a href="../cursos/cursos_ver_alumnos.php">Ver alumnos de cursos</a></li>
                  <li><a href="../cursos/cursos_historico.php">Precios históricos</a></li>
                  <?php
                        if($usuario === "1"){
                        ?><li><a href="../cursos/asociar_alumnos.php"><i class="fas fa-user-plus"></i>Inscribir alumnos</a></li><?php 
                    } ?>
                </ul>
              </li>
             
              <li><a href="#"><i class="fa fa-minus-circle" aria-hidden="true"></i>Gastos </a>
                <ul class="submenu">
                    <?php
                        if($usuario === "1"){
                        ?><li><a href="../gastos">Registrar gasto </a></li><?php 
                    } ?>
                  <li><a href="../gastos/gastos_ver.php">Ver gastos </a></li>
                </ul>
              </li>
              <li><a href="../respaldo/index.php"><i class="fa fa-database"></i>Repaldo </a></li>
              <li><a href="#"><i class="fas fa-info-circle"></i>Reportes </a>
                <ul class="submenu">
                  <li><a href="../reportes/balance_diario.php">Balance diario</a></li>
                  <li><a href="../reportes/informe_cuotas.php">Cuotas</a>
                </ul>
              </li>
              <?php
                if($usuario === "3"){
                    ?><li><a href="../usuarios"><i class="fa fa-user"></i>Usuarios </a></li><?php 
                } ?>
            </ul>
            <!-- <div class="jquery-accordion-menu-footer">versión 1.1</div> -->
          </div>
        </div>