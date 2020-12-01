<?php

include_once 'CursoImporte.php';

 /**
 * 
 */
 class Cursos extends CursoImporte{
 	/**
 	 * Variable de Conexion a BD
 	 * @var [Conexion]
 	 */
 	protected $DB;

 	/**
 	 * Variables de la Tabla
 	 */
 	 protected $_id;
 	 protected $_descripcion;
 	 protected $_meses;
 	 protected $_fecha_inico;


	/***********************
	 * **** GETTERS ********
	 * *********************
	 */

	public function getId()
	{
	    return $this->_id;
	}


	/***********************
	 * **** FIN GETTERS ********
	 * *********************
	 */

 	function __construct()
 	{
 		$database = new Conexion();
 		$this->DB = $database->db;
 	}

 	public function guardar($conn){

 		try {

 			$id = null;
 			$desc = $this->_descripcion;
 			$mese = $this->_meses;
 			$vig = 'S';
 			// $fechai = '2019-03-20';

 			$sql = "INSERT INTO cursos VALUES (?,?,?,NOW(),?)";

        	$conn->db->Execute($sql,array($id,$desc,$mese,$vig));

        	$ADODB_FETCH_MODE = ADODB_FETCH_NUM;

        	$sql2 = "SELECT MAX(id) AS id FROM cursos";

        	$stmt2 = $conn->db->Prepare($sql2);

        	$fila = $conn->db->Execute($stmt2);

			return $fila->fields;


 		} catch (Exception $e) {
 			
 			print_r('MODEL: ' . $e);

 		}

 	}

 	public function modificar($conn){

 		try {

 			$id = $this->_id;
 			$desc = $this->_descripcion;
 			$mese = $this->_meses;

 			$sql = "UPDATE cursos SET descripcion = ?, meses= ?, fecha_inicio= NOW()
                    WHERE id = ?";

        	$conn->db->Execute($sql,array($desc,$mese,$id));


 		} catch (Exception $e) {
 			
 			print_r('MODEL: ' . $e);

 		}

 	}

 	public function eliminar($conn){

 		try {

 			$id = $this->_id;
 	
 			$sql = "UPDATE cursos SET vigente = 'N' WHERE id = ?";

        	$conn->db->Execute($sql,array($id));


 		} catch (Exception $e) {
 			
 			print_r('MODEL: ' . $e);

 		}

 	}

 	 public function renovar($conn){

 		try {

 			$id = $this->_id;
 	
 			$sql = "UPDATE cursos SET fecha_inicio = NOW() WHERE id = ?";

        	$conn->db->Execute($sql,array($id));


 		} catch (Exception $e) {
 			
 			print_r('MODEL: ' . $e);

 		}

	 }
	 
	 public function renovarAnio($conn){

		try {

			$sql = "UPDATE cursos SET fecha_inicio = NOW() WHERE vigente = 'S'";

		    $conn->db->Execute($sql);


		} catch (Exception $e) {
			
			print_r('MODEL: ' . $e);

		}

	}


 	public function getCursos(){

 		try {

 			$sql = "SELECT c.id,c.descripcion,c.meses,c.fecha_inicio,DATE_FORMAT(c.fecha_inicio,'%d/%m/%Y') AS fecha,ci.importe_id,i.importe, DATE_FORMAT(i.fecha,'%d/%m/%Y') AS fechaI, DATE_FORMAT(c.fecha_inicio,'%Y') AS anio FROM cursos c
				INNER JOIN curso_importe ci ON (ci.curso_id = c.id) 
				INNER JOIN importes i ON (ci.importe_id = i.id) 
				WHERE c.vigente = 'S' AND ci.vigente = 'S' ";

			$this->DB->SetFetchMode(ADODB_FETCH_ASSOC);

 			$stmt = $this->DB->Prepare($sql);
 			
			$filas = $this->DB->Execute($stmt);

			return $filas;


 		} catch (Exception $e) {
 			
 			print_r('MODEL: ' . $e);

 		}

 	}

 	public function getCurso(){

 		try {

 			$id = $this->_id;

 			$sql = "SELECT c.id,c.descripcion,c.meses,c.fecha_inicio,DATE_FORMAT(c.fecha_inicio,'%d/%m/%Y') AS fecha, i.importe, DATE_FORMAT(i.fecha,'%d/%m/%Y') AS fechaI, ci.id AS id_ci, DATE_FORMAT(c.fecha_inicio,'%Y') AS anio FROM cursos c
				INNER JOIN curso_importe ci ON (ci.curso_id = c.id) 
				INNER JOIN importes i ON (ci.importe_id = i.id) 
				WHERE c.vigente = 'S' AND ci.vigente = 'S' AND c.id = ?";

			$this->DB->SetFetchMode(ADODB_FETCH_ASSOC);

 			
			$filas = $this->DB->Execute($sql,array($id));

			return $filas;


 		} catch (Exception $e) {
 			
 			print_r('MODEL: ' . $e);

 		}

	 }
	 

	 public function getAniosCurso(){

		try {

			$id = $this->_id;

			$sql = "SELECT DISTINCT (anio) FROM alumno_curso_vw WHERE id_curso = ?";

		   $this->DB->SetFetchMode(ADODB_FETCH_ASSOC);

			
		   $filas = $this->DB->Execute($sql,array($id));

		   return $filas;


		} catch (Exception $e) {
			
			print_r('MODEL: ' . $e);

		}

	}

 	public function getCursoAsociado(){

 		try {

 			$id = $this->_id;

 			$sql = "SELECT COUNT(*) AS CANT FROM alumno_curso WHERE id_curso = ?";

			$this->DB->SetFetchMode(ADODB_FETCH_ASSOC);

 			
			 $filas = $this->DB->Execute($sql,array($id));

			if($filas->fields['CANT'] != 0){
				return "NO";
			}else{
				return "SI";
			}

			 // return $filas->fields['CANT']; exit();


 		} catch (Exception $e) {
 			
 			print_r('MODEL: ' . $e);

 		}

 	}
 	public function getCursoFecha(){

 		try {

 			$id = $this->_id;

 			$sql = "SELECT count(*) AS CANT FROM cursos
					WHERE id = ? AND DATE_FORMAT(fecha_inicio,'%Y') = DATE_FORMAT(NOW(),'%Y')";

			$this->DB->SetFetchMode(ADODB_FETCH_ASSOC);

 			
			 $filas = $this->DB->Execute($sql,array($id));

			if($filas->fields['CANT'] != 0){
				return "NO";
			}else{
				return "SI";
			}


 		} catch (Exception $e) {
 			
 			print_r('MODEL: ' . $e);

 		}

	 }
	 
	 public function getFecha(){

		try {


			$sql = "SELECT count(*) AS CANT FROM cursos
				   WHERE DATE_FORMAT(fecha_inicio,'%Y') = DATE_FORMAT(NOW(),'%Y')";

		   $this->DB->SetFetchMode(ADODB_FETCH_ASSOC);

			
			$filas = $this->DB->Execute($sql);

		   if($filas->fields['CANT'] != 0){
			   return "NO";
		   }else{
			   return "SI";
		   }


		} catch (Exception $e) {
			
			print_r('MODEL: ' . $e);

		}

	}

	public function getAnioLectivo(){

		try {


			$sql = "SELECT DISTINCT (DATE_FORMAT(fecha_inicio,'%Y')) AS ANIO from cursos WHERE vigente = 'S' ";

		    $this->DB->SetFetchMode(ADODB_FETCH_ASSOC);

			
			$filas = $this->DB->Execute($sql);

		    return $filas->fields['ANIO'];


		} catch (Exception $e) {
			
			print_r('MODEL: ' . $e);

		}

	}

	public function getAnio(){

		try {


			$sql = "SELECT DATE_FORMAT(NOW(),'%Y') AS ANIO ";

		    $this->DB->SetFetchMode(ADODB_FETCH_ASSOC);

			
			$filas = $this->DB->Execute($sql);

		    return $filas->fields['ANIO'];


		} catch (Exception $e) {
			
			print_r('MODEL: ' . $e);

		}

	}


 }