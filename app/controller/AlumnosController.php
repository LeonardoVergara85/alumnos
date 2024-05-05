<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/alumnos/app/model/Personas.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/alumnos/app/model/Alumnos.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/alumnos/app/model/Cuotas.php';

Class AlumnosController extends Alumnos{
	
	private $PersonasModel;

	private $AlumnosModel;

	private $CuotasModel;

	/**
	 * [__construct Inicializa el Controlador]
	 * @param [type] $function [Funcion a ejecutar]
	 */
	function __construct($function){

		/**
		 * 
		 * 	$this->Cargo description: 
		 * 	Se inicializa el Objeto, el cual es el Modelo para la BD. 
		 * 	IMPORTANTE: Este Objeto ya inicializa la conexion con la DB a traves del atributo
		 * 	$this->Modelo->DB.
		 * 	
		 */
		$this->PersonasModel = new Personas();

		$this->AlumnosModel = new Alumnos();

		$this->CuotasModel = new Cuotas();

		


		/**
		 * Ejecuta la funcion solicitada en la peticion (route.php)
		 */
		$this->$function();

	}

	public function store(){

		try {
		
			 $conn = new Conexion();
			
			  $conn->db->startTrans();
	
				$this->PersonasModel->_dni = $_POST['docu'];
				$this->PersonasModel->_nombre = $_POST['nom'];
				$this->PersonasModel->_apellido = $_POST['ape'];
				$this->PersonasModel->_domicilio = $_POST['dom'];
				$this->PersonasModel->_telefono = $_POST['tel'];
				$this->PersonasModel->_nacimiento = $_POST['nac'];
				$this->PersonasModel->_celular = $_POST['cel'];
				// insertamos en la tabla personas y recuperamos el último id cargado.
				$idPer = $this->PersonasModel->storePersona($conn);

				$this->AlumnosModel->_id_persona = intval($idPer[0]);
				$this->AlumnosModel->_escuela = $_POST['esc'];
				$this->AlumnosModel->_grado_anio = $_POST['grado'];
				$this->AlumnosModel->_email = $_POST['email'];
				$this->AlumnosModel->_hermanos = $_POST['hermanos'];
				$this->AlumnosModel->guardar($conn);

			 $conn->db->completeTrans();

			echo 'ok';

		} catch (Exception $e) {
			
			print_r($e);

		}

	}


	public function show(){

		try {
			$this->AlumnosModel->_tipo = $_POST['tipo'];
			$alumnos = $this->AlumnosModel->getAlumnos();

			$lista = array();

			foreach ($alumnos as $alumno) {

				array_push($lista, [
				'id' => $alumno['id'],
				'dni' => $alumno['dni'],
				'nombre' => $alumno['nombre'],
				'apellido' => $alumno['apellido'],
				'telefono' => $alumno['telefono'],
				'celular' => $alumno['celular'],
				'activo' => $alumno['activo'],
				'fecha_nacimiento' => $alumno['fecha_nacimiento'],
				'fecha_baja' => $alumno['fecha_baja'],
				]);

			}

			echo json_encode($lista);

		} catch (Exception $e) {
			
			print_r($e);

		}

	}

    public function showAlumno(){

		try {
			
			$this->AlumnosModel->_id = $_POST['idAlumno'];

			$alumnos = $this->AlumnosModel->getAlumno();

			$lista = array();

			foreach ($alumnos as $alumno) {

				array_push($lista, ['id' => $alumno['id'],'id_persona' => $alumno['id_persona'],'dni' => $alumno['dni'],'nombre' => $alumno['nombre'],'apellido' => $alumno['apellido'],'domicilio' => $alumno['domicilio'],'telefono' => $alumno['telefono'],'celular' => $alumno['celular'],'fecha_nac' => $alumno['fecha_nac'],'escuela' => $alumno['escuela'],'grado' => $alumno['grado'],'email' => $alumno['email'],'hermanos' => $alumno['hermanos']]);

			}

			echo json_encode($lista);

		} catch (Exception $e) {
			
			print_r($e);

		}

	}

	public function existe(){

		try {
			
			$this->AlumnosModel->_documento = $_POST['documento'];

			$rta = $this->AlumnosModel->getAlumnoExiste();
			
			if($rta == NULL){

				echo "no_existe";

			}else{
				echo "existe";
			}

		} catch (Exception $e) {
			
			print_r($e);

		}

	} 


	public function showCursosAlumno(){

		try {
			
			$this->AlumnosModel->_id = $_POST['idAlumno'];

			$cursos = $this->AlumnosModel->getCursosAlumno();

			// $lista = array();

			// foreach ($cursos as $curso) {

			// 	array_push($lista, ['id' => $curso['id'],'fecha' => $curso['fechaac'],'curso' => $curso['descripcion'],'meses' => $curso['meses'],'nombre' => $curso['nombre'],'apellido' => $curso['apellido'],'hermanos' => $curso['hermanos'],'anio' => $curso['anio']]);

			// }

			echo json_encode($cursos);

		} catch (Exception $e) {
			
			print_r($e);

		}

	}

	public function modAlumno(){

		try {

			  $conn = new Conexion();
			
			  $conn->db->startTrans();
	
				$this->PersonasModel->_id = $_POST['idp'];
				$this->PersonasModel->_dni = $_POST['docu'];
				$this->PersonasModel->_nombre = $_POST['nom'];
				$this->PersonasModel->_apellido = $_POST['ape'];
				$this->PersonasModel->_domicilio = $_POST['dom'];
				$this->PersonasModel->_telefono = $_POST['tel'];
				$this->PersonasModel->_celular = $_POST['cel'];
				$this->PersonasModel->_nacimiento = $_POST['nac'];
				$this->PersonasModel->modificar($conn);

				$this->AlumnosModel->_id = $_POST['id'];
				$this->AlumnosModel->_escuela = $_POST['esc'];
				$this->AlumnosModel->_grado_anio = $_POST['grado'];
				$this->AlumnosModel->_email = $_POST['email'];
				$this->AlumnosModel->_hermanos = $_POST['hermanos'];

				$this->AlumnosModel->modificar($conn);

			 $conn->db->completeTrans();

			echo 'ok';		

		} catch (Exception $e) {
			
			print_r($e);

		}

	}



	public function eliminar(){

		try {

			  $conn = new Conexion();
			
			  $conn->db->startTrans();

				$this->AlumnosModel->_id = $_POST['id_alumno'];
				//$this->CuotasModel->_id_alumno = $_POST['id_alumno'];
				$this->AlumnosModel->eliminarAlumno($conn);
				//$this->CuotasModel->eliminarCuotas($conn);

			 $conn->db->completeTrans();

			echo 'ok';		

		} catch (Exception $e) {
			
			print_r($e);

		}

	}


	public function renovar_alumno(){

		try {

			  $conn = new Conexion();
			
			  $conn->db->startTrans();

				$this->AlumnosModel->_id = $_POST['id'];
				$this->AlumnosModel->renovar($conn);

			 $conn->db->completeTrans();

			echo 'ok';		

		} catch (Exception $e) {
			
			print_r($e);

		}

	}




}