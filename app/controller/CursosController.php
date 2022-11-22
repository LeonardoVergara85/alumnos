<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/alumnos/app/model/Cursos.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/alumnos/app/model/Importes.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/alumnos/app/model/CursoImporte.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/alumnos/app/model/Cuotas.php';


Class CursosController extends Cursos{
	
	private $CursosModel;

	private $ImportesModel;

	private $CursoImporteModel;

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

		$this->CursosModel = new Cursos();

		$this->ImportesModel = new Importes();

		$this->CursoImporte = new CursoImporte();

		$this->CuotaModel = new Cuotas();

		/**
		 * Ejecuta la funcion solicitada en la peticion (route.php)
		 */
		$this->$function();

	}

	public function store(){

		try {

			$conn = new Conexion();
			
			$conn->db->startTrans();

			$this->CursosModel->_descripcion = $_POST['nombrec'];
			$this->CursosModel->_meses = $_POST['meses'];
			$id_curso = $this->CursosModel->guardar($conn);

			$this->ImportesModel->_importe = $_POST['costo'];
			$id_importe = $this->ImportesModel->guardar($conn);

			$this->CursoImporte->_id_curso = intval($id_curso[0]);
			$this->CursoImporte->_id_importe = intval($id_importe[0]);
			$this->CursoImporte->guardar($conn);


			$conn->db->completeTrans();

			echo 'ok';

		} catch (Exception $e) {
			
			print_r($e);

		}

	}

	public function modificarCurso(){

		try {

			$conn = new Conexion();
			
			$conn->db->startTrans();

			$this->CursosModel->_id = $_POST['idc'];
			$this->CursosModel->_descripcion = $_POST['nombrec'];
			$this->CursosModel->_meses = $_POST['meses'];
				// $this->CursosModel->_fecha_inico = $_POST['fechai'];

			$this->CursosModel->modificar($conn);


			$conn->db->completeTrans();

			echo 'ok';

		} catch (Exception $e) {
			
			print_r($e);

		}

	}

	public function modificarCosto(){


		try {

			$conn = new Conexion();
			
			$conn->db->startTrans();


			$this->CursoImporte->_id = $_POST['idCI'];
			$this->CursoImporte->sacarVigencia($conn);

			$this->ImportesModel->_importe = $_POST['costo'];
			$id_importe = $this->ImportesModel->guardar($conn);

			$this->CursoImporte->_id_curso = intval($_POST['idc']);
			$this->CursoImporte->_id_importe = intval($id_importe[0]);
			$this->CursoImporte->guardar($conn);

			$idc = intval($_POST['idc']);
			$idi = $id_importe[0];

			$this->CuotaModel->cambiarCosto($conn,$idc,$idi);




			$conn->db->completeTrans();

			echo 'ok';

		} catch (Exception $e) {
			
			print_r($e);

		}

	}

	public function eliminarCurso(){

		try {

			$conn = new Conexion();
			
			$conn->db->startTrans();

			$this->CursosModel->_id = $_POST['idcurso'];

			$rta = $this->CursosModel->getCursoAsociado();

			if($rta == 'NO'){

				echo "no_eliminar";
				return;

			}else{

				$this->CursosModel->eliminar($conn);

			}




			$conn->db->completeTrans();

			echo 'ok';

		} catch (Exception $e) {
			
			print_r($e);

		}

	}	


	public function renovarCurso(){

		try {

			$conn = new Conexion();
			
			$conn->db->startTrans();

			$this->CursosModel->_id = $_POST['idcurso'];

			$rta = $this->CursosModel->getCursoFecha();

			if($rta == 'NO'){

				echo "no_renovar";
				return;

			}else{

				$this->CursosModel->renovar($conn);

			}

			$conn->db->completeTrans();

			echo 'ok';

		} catch (Exception $e) {
			
			print_r($e);

		}

	}

	public function anioLectivoActual(){

		try {

			$conn = new Conexion();

			$rta = $this->CursosModel->getAnioLectivo();

			echo $rta;

		} catch (Exception $e) {
			
			print_r($e);

		}

	}

	public function anioLectivoActual_(){

		try {

			$conn = new Conexion();

			$rta = $this->CursosModel->getAnioLectivo();
			$rta2 = $this->CursosModel->getAnio();

			if($rta == $rta2){
				echo 'actualizado';
			}else if($rta < $rta2){
				{echo 'noactualizado';}
			}else{
				{echo 'error';}
			}

		} catch (Exception $e) {
			
			print_r($e);

		}

	}
	
	public function verAnios(){

		try {

			$conn = new Conexion();

			$this->CursosModel->_id = $_POST['idcurso'];

			$anios = $this->CursosModel->getAniosCurso();

			$lista = array();

			foreach ($anios as $curso) {

				array_push($lista, ['anio' => $curso['anio']]);

			}

			echo json_encode($lista);

			

		} catch (Exception $e) {
			
			print_r($e);

		}

	}

	public function renovarCursos(){

		try {

			$conn = new Conexion();
			
			$conn->db->startTrans();

			$rta = $this->CursosModel->getFecha();

			if($rta == 'NO'){

				echo "no_renovar";
				return;

			}else{

				$this->CursosModel->renovarAnio($conn);

			}

			$conn->db->completeTrans();

			echo 'ok';

		} catch (Exception $e) {
			
			print_r($e);

		}

	}


	public function show(){

		try {
			
			$cursos = $this->CursosModel->getCursos();

			$lista = array();

			foreach ($cursos as $curso) {

				array_push($lista, ['id' => $curso['id'],'descripcion' => $curso['descripcion'],'meses' => $curso['meses'],'fecha_inicio' => $curso['fecha_inicio'],'fecha' => $curso['fecha'],'importe' => number_format($curso['importe'],0,',','.'),'id_importe' => $curso['importe_id'],'fechai' => $curso['fechaI'],'anio' => $curso['anio']]);

			}

			echo json_encode($lista);

		} catch (Exception $e) {
			
			print_r($e);

		}

	}
	
	public function showSetCuotas(){

		try {
			
			$cursos = $this->CuotaModel->getSetCuotas();

			$lista = array();

			foreach ($cursos as $curso) {

				array_push($lista, ['id' => $curso['id'],'mes' => $curso['mes_inicio'],'dia' => $curso['dia_vence'],'fecha' => $curso['fecha']]);

			}

			echo json_encode($lista);

		} catch (Exception $e) {
			
			print_r($e);

		}

	}

	public function showCurso(){

		try {


			$this->CursosModel->_id = $_POST['idcurso'];

			$cursos = $this->CursosModel->getCurso();

			$lista = array();

			foreach ($cursos as $curso) {

				array_push($lista, ['id' => $curso['id'],'descripcion' => $curso['descripcion'],'meses' => $curso['meses'],'fecha_inicio' => $curso['fecha_inicio'],'fecha' => $curso['fecha'],'importe' => number_format($curso['importe'],0,',','.'),'fechai' => $curso['fechaI'],'id_ci' => $curso['id_ci']]);

			}

			echo json_encode($lista);

		} catch (Exception $e) {
			
			print_r($e);

		}

	}

	public function importe_historico(){

		try {

			$this->CursoImporte->_id_curso = intval($_POST['curso']);

			$historicos = $this->CursoImporte->getCursoImporte();

			$lista = array();

			foreach ($historicos as $historico) {

				array_push($lista, ['id' => $historico['id'],'importe' =>  number_format($historico['importe'],0,',','.'),'fechaimp' => $historico['fecha_imp'],'curso' => $historico['curso'],'vigente' => $historico['vigente']]);

			}

			echo json_encode($lista);

		} catch (Exception $e) {
			
			print_r($e);

		}

	}








}