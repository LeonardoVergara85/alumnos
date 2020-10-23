<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/alumnos/app/model/TipoGasto.php';


Class TipoGastoController extends TipoGasto{
	
	private $TipoGastoModel;

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

		$this->TipoGastoModel = new TipoGasto();

		/**
		 * Ejecuta la funcion solicitada en la peticion (route.php)
		 */
		$this->$function();

	}




	public function show(){

		try {
			
			$tipos = $this->TipoGastoModel->getTipoGastos();

			$lista = array();

			foreach ($tipos as $tipo) {

				array_push($lista, ['id' => $tipo['id'],'descripcion' => $tipo['descripcion']]);

			}

			echo json_encode($lista);

		} catch (Exception $e) {
			
			print_r($e);

		}

	}

	// public function showCurso(){

	// 	try {


	// 		$this->CursosModel->_id = $_POST['idcurso'];

	// 		$cursos = $this->CursosModel->getCurso();

	// 		$lista = array();

	// 		foreach ($cursos as $curso) {

	// 			array_push($lista, ['id' => $curso['id'],'descripcion' => $curso['descripcion'],'meses' => $curso['meses'],'fecha_inicio' => $curso['fecha_inicio'],'fecha' => $curso['fecha']]);

	// 		}

	// 		echo json_encode($lista);

	// 	} catch (Exception $e) {
			
	// 		print_r($e);

	// 	}

	// }

 






}