<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/alumnos/app/model/CajaChica.php';

Class CajaChicaController extends CajaChica{
	
	private $CajaChicaModel;

	/**
	 * [__construct Inicializa el Controlador]
	 * @param [type] $function [Funcion a ejecutar]
	 */
	function __construct($function){
		$this->CajaChicaModel = new CajaChica();
		$this->$function();
	}


  public function show(){
		try {
			
			$cajas = $this->CajaChicaModel->getCajas();

			$lista = array();

			foreach ($cajas as $caja) {

				array_push($lista, [
                    'id' => $caja['id'],
                    'fecha_apertura' => $caja['fecha_a'],
                    'apertura' => $caja['fecha_apertura'],
                    'cierre' => $caja['fecha_cierre'],
                    'monto_inicial' => number_format($caja['monto_inicial'],2,',','.'),
                    'monto_final' => number_format($caja['monto_final'],2,',','.'),
                    'usuario_apertura' => $caja['usuario_apertura'],
                    'usuario_cierre' => $caja['usuario_cierre'],
                    'observaciones' => $caja['observaciones'],
                    'hoy' => $caja['hoy']
                    ]);

			}

			echo json_encode($lista);

		} catch (Exception $e) {
			
			print_r($e);

		}

	}

	public function guardarCaja(){
		try {
		
			 $conn = new Conexion();
			  $conn->db->startTrans();
				$this->CajaChicaModel->_monto_inicial = $_POST['inicial'];
				$this->CajaChicaModel->_usuario_apertura_id = $_POST['usuario'];
				$this->CajaChicaModel->_observaciones = $_POST['obs'];
				$id = $this->CajaChicaModel->guardar($conn);
			 $conn->db->completeTrans();
			echo 'ok';

		} catch (Exception $e) {
			print_r($e);
		}
	}  


	public function cerrarCaja(){
		try {
		
			 $conn = new Conexion();
			  $conn->db->startTrans();
				$this->CajaChicaModel->_id = $_POST['id'];
				$this->CajaChicaModel->_monto_final = $_POST['final'];
				$this->CajaChicaModel->_usuario_cierre_id = $_POST['usuario'];
				$this->CajaChicaModel->cerrar($conn);
			 $conn->db->completeTrans();
			echo 'ok';

		} catch (Exception $e) {
			print_r($e);
		}
	}

	// fin controlador //

}