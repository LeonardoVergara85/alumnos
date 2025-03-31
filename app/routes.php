<?php

// $GLOBALS['escrutinio'] = '../../../escrutinio/';


include_once $_SERVER['DOCUMENT_ROOT'].'/alumnos/config/Conexion.php';
//---------------------------------------------

 include_once 'controller/AuthController.php';
 include_once 'controller/AlumnosController.php';
 include_once 'controller/UsuariosController.php';
 include_once 'controller/CursosController.php';
 include_once 'controller/TipoGastoController.php';
 include_once 'controller/GastosController.php';
 include_once 'controller/AlumnoCursoController.php';
 include_once 'controller/CuotasController.php';
 include_once 'controller/ActivosController.php';
 include_once 'controller/RespaldosController.php';


new routes();

/**
* 
*/
class routes
{
	private $_peticion;

	function __construct()
	{

		if( isset($_POST['peticion']) ){

			$this->_peticion = $_POST['peticion'];

		}else if(isset($_GET['peticion'])){

			$this->_peticion = $_GET['peticion'];

		}else{

			return 'route not found';

		}


		$this->Peticiones();

	}




	//--------------------------------------------------------------------------------
	//---------------------------------- Rutas/Peticiones ----------------------------
	//--------------------------------------------------------------------------------
	
	public function Peticiones(){

		switch ($this->_peticion) {


			case 'AuthLogin':

				new AuthController('logueo');
				// echo 10;
				break;

			case 'AuthLogout':

				new AuthController('logout');
				// echo 10;
				break;

			case 'productosview':

				new ProductosController('show');

				break;


			case 'guardar_alumno':

				new AlumnosController('store');

				break;	

			case 'ver_usuarios':

				new UsuariosController('show');

				break;

			case 'ver_alumnos':

				new AlumnosController('show');

				break;

			case 'ver_alumno':

				new AlumnosController('showAlumno');

				break;	

			case 'modificar_alumno':

				new AlumnosController('modAlumno');

				break;	

			case 'ver_cursos_alumno':

				new AlumnosController('showCursosAlumno');

				break;

			case 'buscar_alumno_docu':

				new AlumnosController('existe');

				break;

			case 'eliminar_alumno':

				new AlumnosController('eliminar');

				break;	
			
			case 'renovar_alumno':

				new AlumnosController('renovar_alumno');

				break;		

			case 'guardar_curso':

				new CursosController('store');

				break;

			case 'ver_cursos':

				new CursosController('show');

				break;
			
			case 'ver_set_cuotas':

			new CursosController('showSetCuotas');

			break;

			case 'ver_curso':

				new CursosController('showCurso');

				break;

			case 'modificar_curso':

				new CursosController('modificarCurso');

				break;

			case 'modificar_costos':

				new CursosController('modificarCosto');

				break;

			case 'eliminar_curso':

				new CursosController('eliminarCurso');

				break;

			case 'renovar_curso':

				new CursosController('renovarCurso');

				break;

			case 'renovar_cursos':

			new CursosController('renovarCursos');

			break;	
			
			case 'ver_anios':

			new CursosController('verAnios');

			break;

			case 'anio_lectivo':

			new CursosController('anioLectivoActual');

			break;	

			case 'anio_lectivo_':

			new CursosController('anioLectivoActual_');

			break;
					

			case 'ver_historico':

				new CursosController('importe_historico');

				break;

			case 'ver_tipo_gastos':

				new TipoGastoController('show');

				break;

			case 'guardar_gasto':

				new GastosController('store');

				break;

			case 'ver_gastos_hoy':

				new GastosController('showHoy');

				break;

			case 'buscar_gasto_fecha':

				new GastosController('showFecha');

				break;	

			case 'buscar_gasto_tipo':

				new GastosController('showTipo');

				break;	

			case 'ver_gasto':

				new GastosController('showGasto');

				break;	

			case 'mod_gasto':

				new GastosController('modificarGasto');

				break;	
			
			case 'ver_tipo_pagos':

				new GastosController('verTipoPagos');

				break;		

			case 'ver_alumnos_curso':

				new AlumnoCursoController('showCurso');

				break;

			case 'ver_alumnos_no_asociados':

				new AlumnoCursoController('showAlumnosNoAsoc');

				break;

			case 'asociar_alumnos':

				new AlumnoCursoController('asociarAlumnos');

				break;

			case 'ver_cuotas':

				new CuotasController('showCuotas'); 

				break;	

		    case 'pagar_cuota':

				new CuotasController('pagar'); 

				break;	 

			case 'ver_balance_diario':

				new CuotasController('BalanceDario'); 

				break;

			case 'buscar_balance_fecha':

				new CuotasController('BalanceDarioFecha'); 

				break;	

			case 'ver_cuota_print':

				new CuotasController('showCuotaPrint'); 

				break;

			case 'buscar_cuotas':

				new CuotasController('showCuotasInforme'); 

				break;	
			case 'guardar_conf_cuotas':

				new CuotasController('guardarConfCuotas'); 

			break;

			case 'guardar_activo':
				new ActivosController('store'); 
			break;	

			case 'modificar_activo':
				new ActivosController('ModificarActivo'); 
			break;
			

			case 'ver_activos':
				new ActivosController('show'); 
			break;
			
			case 'ver_activo':
				new ActivosController('showActivo'); 
			break;
			
			case 'bonificar_alumno_curso':
				new AlumnoCursoController('bonificar'); 
			break;

            case 'backup_db':
				new RespaldosController('backupBase'); 
			break;
			
			default:
				# code...
			    echo "otra cosa - no tiene controlador";
				break;
		}

	}


}





?>