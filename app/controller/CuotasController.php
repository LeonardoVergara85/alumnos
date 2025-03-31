<?php

// include_once $_SERVER['DOCUMENT_ROOT'].'/skills/app/model/Cursos.php';
// include_once $_SERVER['DOCUMENT_ROOT'].'/skills/app/model/Importes.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/alumnos/app/model/Cuotas.php';


Class CuotasController extends Cuotas{
	
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

		$this->CuotasModel = new Cuotas();


		/**
		 * Ejecuta la funcion solicitada en la peticion (route.php)
		 */
		$this->$function();

	}

	// public function store(){

	// 	try {
		
	// 		 $conn = new Conexion();
			
	// 		  $conn->db->startTrans();
	
	// 			$this->CursosModel->_descripcion = $_POST['nombrec'];
	// 			$this->CursosModel->_meses = $_POST['meses'];
	// 			$id_curso = $this->CursosModel->guardar($conn);

	// 			$this->ImportesModel->_importe = $_POST['costo'];
	// 			$id_importe = $this->ImportesModel->guardar($conn);

	// 			$this->CursoImporte->_id_curso = intval($id_curso[0]);
	// 			$this->CursoImporte->_id_importe = intval($id_importe[0]);
	// 			$this->CursoImporte->guardar($conn);


	// 		 $conn->db->completeTrans();

	// 		echo 'ok';

	// 	} catch (Exception $e) {
			
	// 		print_r($e);

	// 	}

	// }

	public function pagar(){

		try {
		
			 $conn = new Conexion();
			
			  $conn->db->startTrans();
	
				$this->CuotasModel->_id = $_POST['idc'];
				$this->CuotasModel->_descuento = $_POST['desc'];
				$this->CuotasModel->_interes = $_POST['int'];
				$this->CuotasModel->_tipo_pago = $_POST['tipopago'];

				$now = $this->CuotasModel->pagarCuota($conn);


			 $conn->db->completeTrans();

			echo 'ok-'.$now[0].'-'.$now[1];

		} catch (Exception $e) {
			
			print_r($e);

		}

	}

	
	public function guardarConfCuotas(){

		try {
		
			 $conn = new Conexion();
			
			  $conn->db->startTrans();
	
				$this->CuotasModel->_mes_inicio = $_POST['mes'];
				$this->CuotasModel->_dia_vencimiento = $_POST['dia'];

				$this->CuotasModel->guardarConfig($conn);


			 $conn->db->completeTrans();

			echo 'ok';

		} catch (Exception $e) {
			
			print_r($e);

		}

	}



	public function showCuotas(){

		try {

			$this->CuotasModel->_id_alumno_curso = $_POST['idac'];

			$cuotas = $this->CuotasModel->getCuotas();

			$lista = array();

			foreach ($cuotas as $cuota) {

				array_push($lista, ['id' => $cuota['id'],'fecha_v' => $cuota['fecha_vencimiento_'],'descuento' => $cuota['descuento'],'interes' => $cuota['interes'],'nro' => $cuota['nro_cuota'],'importe' => number_format($cuota['importe'],2,',','.'),'fechap' => $cuota['fechapago'],'total' => number_format($cuota['total'],2,',','.')]);

			}

			echo json_encode($lista);

		} catch (Exception $e) {
			
			print_r($e);

		}

	}

	public function showCuotaPrint(){

		try {

			$this->CuotasModel->_id = $_POST['idc'];

			$cuotas = $this->CuotasModel->getCuotaPrint();

			$lista = array();

			foreach ($cuotas as $cuota) {

				array_push($lista, ['id' => $cuota['id'],'fecha_v' => $cuota['fecha_vencimiento_'],'nro' => $cuota['nro_cuota'],'importe' => $cuota['total'],'fecha_p' => $cuota['fechapago'],'meses' => $cuota['meses_curso'],'curso' => $cuota['curso'],'nombre' => $cuota['nombre'],'apellido' => $cuota['apellido'],'tipo_pago' => $cuota['tipo_pago']]);

			}

			echo json_encode($lista);

		} catch (Exception $e) {
			
			print_r($e);

		}

	}

	public function BalanceDario(){

		try {

			$balance = $this->CuotasModel->getBalanceDiario();

			$lista = array();
			
			$sumaDebe = 0;
			$sumaHaber = 0;
			$saldo = 0;

			foreach ($balance as $value) {

				$debe = '-';
				$haber = '-';

				if($value['haber'] != NULL){
					$haber = number_format($value['haber'],2,',','.');
					$sumaHaber = $sumaHaber+$value['haber'];
				}

				if($value['debe'] != NULL){
					$debe = number_format($value['debe'],2,',','.');
					$sumaDebe = $sumaDebe+$value['debe'];
				}

				array_push($lista, ['fecha' => $value['fecha'],
				'denominacion' => $value['denominacion'],
				'detalle' => $value['detalle'],
				'debe' => $debe,
				'haber' => $haber,
				'saldo' => $value['saldo'],
				'pagadopor' => $value['pagadopor'],
				'forma_pago' => $value['forma_pago']]);

			}

            $saldo = $sumaDebe - $sumaHaber;
			$sumaDebe = number_format($sumaDebe,2,',','.');
			$sumaHaber= number_format($sumaHaber,2,',','.');
			$saldo= number_format($saldo,2,',','.');
			echo json_encode(['lista' =>$lista, 'totalDebe' =>$sumaDebe, 'totalHaber' =>$sumaHaber, 'saldo' =>$saldo],200);    
			//echo json_encode($lista);

		} catch (Exception $e) {
			
			print_r($e);

		}

	}

	public function BalanceDarioFecha(){

		try {
			  $desde = $_POST['fechad'];
			  $hasta = $_POST['fechah'];
			  $efectivo = $_POST['efectivo'];

			 if($efectivo == 0){

			 	$balance = $this->CuotasModel->getBalanceFecha($desde,$hasta);

			 }else{

			 	$balance = $this->CuotasModel->getBalanceFechaEfectivo($desde,$hasta);

			 }

			

			$lista = array();
			
            $sumaDebe = 0;
			$sumaHaber = 0;
			$saldo = 0;
			
			foreach ($balance as $value) {

				$debe = '-';
				$haber = '-';

				if($value['haber'] != NULL){
					$haber = number_format($value['haber'],2,',','.');
					$sumaHaber = $sumaHaber+$value['haber'];
				}

				if($value['debe'] != NULL){
					$debe = number_format($value['debe'],2,',','.');
					$sumaDebe = $sumaDebe+$value['debe'];
				}

				array_push($lista, ['fecha' => $value['fecha'],'denominacion' => $value['denominacion'],'detalle' => $value['detalle'],'debe' => $debe,'haber' => $haber,'saldo' => $value['saldo'],'pagadopor' => $value['pagadopor'],'forma_pago' => $value['forma_pago']]);

			}
            $saldo = $sumaDebe - $sumaHaber;
			$sumaDebe = number_format($sumaDebe,2,',','.');
			$sumaHaber= number_format($sumaHaber,2,',','.');
			$saldo= number_format($saldo,2,',','.');
			echo json_encode(['lista' =>$lista, 'totalDebe' =>$sumaDebe, 'totalHaber' =>$sumaHaber,  'saldo' =>$saldo],200);
			//echo json_encode($lista);

		} catch (Exception $e) {
			
			print_r($e);

		}

	}


	public function showCuotasInforme(){

		try {

			  $desde = $_POST['fdesde'];
			  $hasta = $_POST['fhasta'];
			  $tipo = $_POST['tipo'];


			 $cuotas = $this->CuotasModel->getCuotasRango($desde,$hasta,$tipo);


			$lista = array();

			foreach ($cuotas as $value) {

				array_push($lista, [
					'nombre' => $value['nombre'],
					'apellido' => $value['apellido'],
					'curso' => $value['curso'],
					'nro_cuota' => $value['nro_cuota'],
					'fecha_vencimiento' => $value['fecha_vencimiento_'],
					'importe' => number_format($value['total'],2,',','.'),
					'fecha_pago' => $value['fecha_pago'],
					'fechapago' => $value['fechapago'],
			      ]);
			}

			echo json_encode($lista);

		} catch (Exception $e) {
			
			print_r($e);

		}

	}


}