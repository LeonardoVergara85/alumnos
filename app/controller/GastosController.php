<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/alumnos/app/model/Gastos.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/alumnos/app/model/TipoPago.php';


Class GastosController extends Gastos{
	
	private $GastosModel;
	private $TipoPagoModel;

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

		$this->GastosModel = new Gastos();

		/**
		 * Ejecuta la funcion solicitada en la peticion (route.php)
		 */
		$this->$function();

	}


    public function store(){

		try {
		
			 $conn = new Conexion();
			
			  $conn->db->startTrans();
	
				$this->GastosModel->_id_tipogasto = $_POST['tipog'];
				$this->GastosModel->_importe = $_POST['importe'];
				$this->GastosModel->_observaciones = $_POST['obs'];
				$this->GastosModel->_pagado_por = $_POST['pagado'];
				$this->GastosModel->_forma_pago = $_POST['formapago'];
				$this->GastosModel->_id_usuario = 1;
	
				$idPer = $this->GastosModel->guardar($conn);

			 $conn->db->completeTrans();

			echo 'ok';

		} catch (Exception $e) {
			
			print_r($e);

		}

	}    

	public function modificarGasto(){

		try {
		
			 $conn = new Conexion();
			
			  $conn->db->startTrans();
	
				$this->GastosModel->_id = $_POST['idg'];
				$this->GastosModel->_id_tipogasto = $_POST['tipog'];
				$this->GastosModel->_importe = $_POST['importe'];
				$this->GastosModel->_observaciones = $_POST['obs'];
				$this->GastosModel->_pagado_por = $_POST['pagado'];
				$this->GastosModel->_forma_pago = $_POST['formapago'];
	
				$idPer = $this->GastosModel->modificar($conn);

			 $conn->db->completeTrans();

			echo 'ok';

		} catch (Exception $e) {
			
			print_r($e);

		}

	}

	public function showHoy(){

		try {
			
			$gastosh = $this->GastosModel->getGastosHoy();

			$lista = array();

			foreach ($gastosh as $gasto) {

				array_push($lista, ['ID' => $gasto['ID'],'DESCRIPCION' => $gasto['DESCRIPCION'],'IMPORTE' => number_format($gasto['IMPORTE'],2,',','.'),'FECHA' => $gasto['FECHAGASTO_']
				,'OBS' => $gasto['OBSERVACIONES']
				,'FORMA_PAGO' => $gasto['FORMA_PAGO'],'PAGADO_POR' => $gasto['PAGADO_POR']]);

			}

			echo json_encode($lista);

		} catch (Exception $e) {
			
			print_r($e);

		}

	}

	public function showFecha(){

		try {

			$desde = $_POST['fechad'];
			$hasta = $_POST['fechah'];
			
			$gastosh = $this->GastosModel->getGastosFecha($desde,$hasta);

			$lista = array();

			foreach ($gastosh as $gasto) {

				array_push($lista, ['ID' => $gasto['ID'],'DESCRIPCION' => $gasto['DESCRIPCION'],'IMPORTE' => number_format($gasto['IMPORTE'],2,',','.'),'FECHA' => $gasto['FECHAGASTO_'],'OBS' => $gasto['OBSERVACIONES'],'PAGADO_POR' => $gasto['PAGADO_POR'],'FORMA_PAGO' => $gasto['FORMA_PAGO']]);

			}

			echo json_encode($lista);

		} catch (Exception $e) {
			
			print_r($e);

		}

	}

	public function showTipo(){

		try {

			$desde = $_POST['fechad'];
			$hasta = $_POST['fechah'];
			 $tipo = $_POST['tipo'];
			
			$gastostipo = $this->GastosModel->getGastosTipoFecha($desde,$hasta,$tipo);

			$lista = array();

			foreach ($gastostipo as $gasto) {

				array_push($lista, ['ID' => $gasto['ID'],'DESCRIPCION' => $gasto['DESCRIPCION'],'IMPORTE' => number_format($gasto['IMPORTE'],2,',','.'),'FECHA' => $gasto['FECHAGASTO_'],'OBS' => $gasto['OBSERVACIONES'],'PAGADO_POR' => $gasto['PAGADO_POR'],'FORMA_PAGO' => $gasto['FORMA_PAGO']]);

			}

			echo json_encode($lista);

		} catch (Exception $e) {
			
			print_r($e);

		}

	}

	public function showGasto(){

		try {

			$this->GastosModel->_id = $_POST['idgasto'];
			
			$gastosh = $this->GastosModel->getGasto();

			$lista = array();

			foreach ($gastosh as $gasto) {

				array_push($lista, ['ID' => $gasto['ID'],'ID_TIPO_GASTO' => $gasto['ID_TIPO_GASTO'],'DESCRIPCION' => $gasto['DESCRIPCION'],'IMPORTE' => $gasto['IMPORTE'],'FECHA' => $gasto['FECHAGASTO_'],'OBS' => $gasto['OBSERVACIONES'],'PAGOPOR' => $gasto['PAGADO_POR'],'FORMA_PAGO_ID' => $gasto['FORMA_PAGO_ID']]);

			}

			echo json_encode($lista);

		} catch (Exception $e) {
			
			print_r($e);

		}

	}

	
	public function verTipoPagos(){

		try {

			$this->TipoPagoModel = new TipoPago();
			
			$pagos = $this->TipoPagoModel->getTipoPagos();

			$lista = array();

			foreach ($pagos as $pagosa) {

				array_push($lista, ['id' => $pagosa['id'],'descripcion' => $pagosa['descripcion']]);

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