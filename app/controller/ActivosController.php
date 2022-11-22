<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/alumnos/app/model/Activos.php';


Class ActivosController extends Activos{
	
	private $ActivosModel;

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

		$this->ActivosModel = new Activos();

		/**
		 * Ejecuta la funcion solicitada en la peticion (route.php)
		 */
		$this->$function();

	}


    public function store(){

		try {
		
			 $conn = new Conexion();
			
			  $conn->db->startTrans();

				$this->ActivosModel->_descripcion = $_POST['activo'];
				$this->ActivosModel->_importe = $_POST['importe'];
				$this->ActivosModel->_forma_pago = $_POST['formapago'];
				$this->ActivosModel->_id_usuario = $_POST['usu'];
	
				$idPer = $this->ActivosModel->guardar($conn);

			 $conn->db->completeTrans();

			echo 'ok';

		} catch (Exception $e) {
			
			print_r($e);

		}

	}  

	
	public function ModificarActivo(){

		try {
		
			 $conn = new Conexion();
			
			  $conn->db->startTrans();

				$this->ActivosModel->_id = $_POST['ida'];
				$this->ActivosModel->_descripcion = $_POST['activo'];
				$this->ActivosModel->_importe = $_POST['importe'];
				$this->ActivosModel->_forma_pago = $_POST['formapago'];
				$this->ActivosModel->_id_usuario = $_POST['usu'];

				$idPer = $this->ActivosModel->modificar($conn);

			 $conn->db->completeTrans();

			echo 'ok';

		} catch (Exception $e) {
			
			print_r($e);

		}

	}
	
	public function show(){

		try {

			//$this->GastosModel->_id = $_POST['idgasto'];
			
			$activos = $this->ActivosModel->getActivos();

			$lista = array();

			foreach ($activos as $activo) {

				array_push($lista, [
					'id' => $activo['id'],
					'descripcion' => $activo['descripcion'],
					'importe' => number_format($activo['importe'],2,',','.'),
					'fecha' => $activo['fecha_activo'],
					'formapago' => $activo['pago']
				]);

			}

			echo json_encode($lista);

		} catch (Exception $e) {
			
			print_r($e);

		}

	}

	public function showActivo(){

		try {

			$this->ActivosModel->_id = $_POST['idactivo'];
			
			$activos = $this->ActivosModel->getActivo();

			$lista = array();

			foreach ($activos as $activo) {

				array_push($lista, [
					'id' => $activo['id'],
					'descripcion' => $activo['descripcion'],
					'importe' => number_format($activo['importe'],2,',','.'),
					'fecha' => $activo['fecha_activo'],
					'formapago' => $activo['pago'],
					'forma_pago' => $activo['forma_pago']
				]);

			}

			echo json_encode($lista);

		} catch (Exception $e) {
			
			print_r($e);

		}

	}
	

	

}