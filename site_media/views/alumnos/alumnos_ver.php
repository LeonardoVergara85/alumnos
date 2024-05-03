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
            <div class="card-header">
              Alumnos
            </div>

            <div id="div-spinner" style="display:none; position: absolute;margin-left: 450px;margin-top: 0px;background-color: darkseagreen;padding: 10px;/*! margin: 0; */margin-top: 150px;z-index: 100;">
              <p class="primary">Cargando <i class="fa fa-spinner fa-spin fa-2x fa-fw"></i></p>
            </div>
            
            <div class="card-body">


            <!-- Nav tabs -->
          <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#activos" id="ver_activos">Alumnos activos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#inactivos" id="ver_inactivos">Alumnos Inactivos</a>
            </li>
          </ul>
          <div class="spinner-border text-primary"></div>
          <!-- Tab panes -->
          <div class="tab-content">
            <div id="activos" class="container tab-pane active">
			      <br>
              <!-- Tabla -->
              <table id="table_alumnos" class="table dtr-inline table-hover compact" cellspacing="0" width="100%">
              <thead>
                  <tr>
                      <th></th>
                      <th class="text-center">Dni</th>
                      <th class="text-center">Apellido</th>
                      <th class="text-center">Nombre</th>
                      <th class="text-center">Nacimiento</th>
                      <th class="text-center">Telefono</th>
                      <th class="text-center">Estado</th>
                      <th></th>
                  </tr>
              </thead>
              <tbody id="cuerpoTablaAlu">
              </tbody>
            </table>
            </div>
            <div id="inactivos" class="container tab-pane fade"><br>
              <!-- La tabla de Inactivos -->
              <table id="table_alumnos_inactivos" class="table dtr-inline table-hover compact" cellspacing="0" width="100%">
              <thead>
                  <tr>
                      <th></th>
                      <th class="text-center">Dni</th>
                      <th class="text-center">Apellido</th>
                      <th class="text-center">Nombre</th>
                      <th class="text-center">Nacimiento</th>
                      <th class="text-center">Telefono</th>
                      <th class="text-center">Estado</th>
                      <th></th>
                  </tr>
              </thead>
              <tbody id="cuerpoTablaAluInactivos">
              </tbody>
            </table>
            </div>
		  </div>	    
            
      </div> 
            
          </div> 
          <!-- <div class="card-footer">Footer</div> -->
        </div>
      </div>
  
          <!-- The Modal -->
  <div class="modal fade" id="modalDetalleAlumno" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Datos del alumno</h4>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <form id="formulario_alumnos_mod">
                <div class="form-row">
                 <div class="col-md-7 mb-3">
                  <label>Documento</label>
                    <input type="text" class="form-control" name="documento_" id="documento_" placeholder="dni">
                </div>
                <div class="col-md-5 mb-4">
                  <label for="validationCustom05">Nacimiento</label>
                  <input type="date" class="form-control" name="nacimiento_" id="nacimiento_">
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-6 mb-3">
                  <label>Nombre</label>
                  <input type="text" class="form-control" name="nombre_" id="nombre_">
                </div>
                <div class="col-md-6 mb-3">
                  <label>Apellido</label>
                  <input type="text" class="form-control" name="apellido_" id="apellido_">
                </div>

              </div>
              <div class="form-row">
                <div class="col-md-6 mb-3">
                  <label for="validationCustom04">Teléfono</label>
                  <input type="text" class="form-control" name="telefono_" id="telefono_">
                </div>
                <div class="col-md-5 mb-3">
                  <label for="validationCustom04">Celular</label>
                  <input type="text" class="form-control" name="celular_" id="celular_">
                </div>
                <div class="col-md-1 mb-3" id='div-wts' style="margin-top: 35px;">
                
                </div>
              </div>
              <div class="form-row">
              <div class="col-md-12 mb-3">
                  <label for="validationCustom03">Domicilio</label>
                  <input type="text" class="form-control" name="domicilio_" id="domicilio_">
                </div>
                
              </div>
              <div class="form-row">
                <div class="col-md-10 mb-3">
                  <label for="validationEscuela">Escuela</label>
                  <input type="text" class="form-control" name="escuela_" id="escuela_">
                </div>
                <div class="col-md-2 mb-3">
                  <label for="validationGradoanio">G/A</label>
                  <select  class="form-control" id="gradoanio_" name="gradoanio_">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                  </select>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-12 mb-3">
                  <label for="validationEmail">E-mail</label>
                  <input type="email" class="form-control" name="email_" id="email_">
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-5 mb-3">
                 <div class="form-group">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="hermanos_" name="hermanos_">
                  <label class="form-check-label" for="invalidCheck">
                    Tiene hermanos
                  </label>
                </div> 
              </div>
            </div>
              </div>
              <input type="hidden" id="id_persona_" value="">
              <button class="btn btn-primary botonmodificaralumno" type="submit" name="modificaralu" id="modificaralu">Modificar</button>
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
  <div class="modal fade" id="modalCursosAlu" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title" id="titulo-modal"></h4>
          <br>
          <h5 class="modal-title" id="her"></h5>
          
        </div>
        <!-- Modal body -->
        <div class="modal-body">
           <form id="">
              <div class="form-row">
                <div class="col-md-12 mb-2">
                  <div id="accordion">
                    <div class="card" id="card_body">
                    </div>
                  </div>
                 <!--  <table id="table_cursos_asociados" class="table table-striped table-hover compact" cellspacing="0" width="100%">
                    <thead>
                      <th style="width: 60%;">Curso</th>
                      <th style="width: 20%;">fecha</th>
                      <th style="width: 10%;">meses</th>
                      <th style="width: 10%;"></th>
                    </thead>
                    <tbody id="cuerpoTablaAsociar">
                    </tbody>
                  </table> -->
                </div>
              </div>
            </form>
          </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btnclose2" data-dismiss="modal">Cerrar</button>
        </div>
        
      </div>
    </div>
  </div> 

  v
  <!-- The Modal -->
  <div class="modal fade" id="modalCuotas" >
    <div class="modal-dialog modal-lg" style="width: 1300px;margin-left: -300px;" role="document">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title" id="title_cuotas"></h4>
          <h4 class="modal-title">Cuotas</h4>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
           <form id="">
              <div class="form-row">
                <div class="col-md-12 mb-2">
                  <table id="table_cuotas" class="table table-striped table-hover compact" cellspacing="0" width="100%">
                    <thead>
                        <th style="width: 60%;">Curso</th>
                        <th style="width: 20%;">fecha</th>
                        <th style="width: 10%;">meses</th>
                        <th style="width: 10%;"></th>
                    </thead>
                    <tbody id="cuerpoTablaAsociar">
                    </tbody>
                  </table>
               </div>
            </div>
          </form>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btnclose2" data-dismiss="modal">Cerrar</button>
        </div>
        
      </div>
    </div>
  </div> 


           <!-- The Modal -->
  <div class="modal fade" id="eliminarAlu" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title danger">Eliminar Alumno</h4>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <p id="msj-eliminar"></p>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-danger btneliminarAlu" name="btneliminarAlu" id="btneliminarAlu">Aceptar</button>
          <button type="button" class="btn btn-secondary btnclosealu" data-dismiss="modal">Cancelar</button>
        </div>
        
      </div>
    </div>
  </div> 

    <!-- The Modal -->
    <div class="modal fade" id="bonificarAlu" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title danger">Bonificar Alumno</h4>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <p id="msj-bonificar">¿Realmente quiere bonificar el curso?</p>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-primary btn-primary btnbonificarAlu" name="btnbonificarAlu" id="btnbonificarAlu">Aceptar</button>
          <button type="button" class="btn btn-secondary btnclosebonificaralu" data-dismiss="modal">Cancelar</button>
        </div>
        
      </div>
    </div>
  </div> 

  <!-- The Modal -->
  <div class="modal fade" id="renovarAlu" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title danger">Renovar Alumno</h4>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <p id="msj-renovar"></p>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-warning" name="btnrenovarAlu" id="btnrenovarAlu">Aceptar</button>
          <button type="button" class="btn btn-secondary btnclosealu" data-dismiss="modal" id="btncancelarRenov">Cancelar</button>
        </div>
        
      </div>
    </div>
  </div> 

   </div>     

  </body>

  <?php include_once '../../../public/libs/include_libs_js.html'; ?>

  <script src="../../js/alumnos/alumnos_ver8.js" type="text/javascript"></script>

</html>