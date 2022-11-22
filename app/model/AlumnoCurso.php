<?php

include_once 'Cuotas.php';
 /**
 * 
 */
 class AlumnoCurso extends Cuotas{
 	/**
 	 * Variable de Conexion a BD
 	 * @var [Conexion]
 	 */
 	protected $DB;

 	/**
 	 * Variables de la Tabla
 	 */
 	 protected $_id;
 	 protected $_id_alumno;
 	 protected $_id_curso;
 	 protected $_fecha;
 	 protected $_vigente;
 

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
 			$cur = $this->_id_curso;
 			$alu = $this->_id_alumno;

 			$sql = "INSERT INTO alumno_curso VALUES (?, ?, ?,NOW(),'S')";

        	$conn->db->Execute($sql,array($id,$alu,$cur));

        	$ADODB_FETCH_MODE = ADODB_FETCH_NUM;

        	$sql2 = "SELECT MAX(id) AS id FROM alumno_curso";

        	$stmt2 = $conn->db->Prepare($sql2);

        	$fila = $conn->db->Execute($stmt2);

        	return $fila->fields;


 		} catch (Exception $e) {
 			
 			print_r('MODEL: ' . $e);

 		}

 	}

 	// public function modificar($conn){

 	// 	try {

 	// 		$id = $this->_id;
 	// 		$desc = $this->_descripcion;
 	// 		$mese = $this->_meses;

 	// 		$sql = "UPDATE cursos SET descripcion = ?, meses= ?, fecha_inicio= NOW()
  //                   WHERE id = ?";

  //       	$conn->db->Execute($sql,array($desc,$mese,$id));


 	// 	} catch (Exception $e) {
 			
 	// 		print_r('MODEL: ' . $e);

 	// 	}

 	// }

 	// public function eliminar($conn){

 	// 	try {

 	// 		$id = $this->_id;
 	
 	// 		$sql = "UPDATE cursos SET vigente = 'N' WHERE id = ?";

  //       	$conn->db->Execute($sql,array($id));


 	// 	} catch (Exception $e) {
 			
 	// 		print_r('MODEL: ' . $e);

 	// 	}

 	// }


 	public function getAlumnosCurso(){

 		try {

 			$id = $this->_id_curso;

 			$sql = "SELECT * FROM alumno_curso_vw WHERE id_curso = ? AND vigente = 'S' AND anio = anio_curso";

			$this->DB->SetFetchMode(ADODB_FETCH_ASSOC);

 			
			$filas = $this->DB->Execute($sql,array($id));

			return $filas;


 		} catch (Exception $e) {
 			
 			print_r('MODEL: ' . $e);

 		}

 	}
 	public function getAlumnosCursoPorAnio($anio){

 		try {

 			$id = $this->_id_curso;
 			$a = $anio;

 			$sql = "SELECT * FROM alumno_curso_vw WHERE id_curso = ? AND vigente = 'S' AND anio = ? ";

			$this->DB->SetFetchMode(ADODB_FETCH_ASSOC);

 			
			$filas = $this->DB->Execute($sql,array($id,$a));

			return $filas;


 		} catch (Exception $e) {
 			
 			print_r('MODEL: ' . $e);

 		}

 	}

 	public function getAlumnosCursoMeses($conn){

 		try {

 			$id = $this->_id_curso;

 			$ADODB_FETCH_MODE = ADODB_FETCH_NUM;
 			
 			$sql = "SELECT meses 
					FROM alumno_curso_vw 
					WHERE id_curso = ? AND vigente = 'S'
					GROUP BY meses";

			$conn->db->SetFetchMode(ADODB_FETCH_NUM);

 			
			$filas = $conn->db->Execute($sql,array($id));

			return $filas->fields;


 		} catch (Exception $e) {
 			
 			print_r('MODEL: ' . $e);

 		}

 	}

 	public function getAlumnosNoAsociado(){

 		try {

 			$id = $this->_id_curso;

 			$sql = "SELECT id,dni,apellido,nombre,alu_activo FROM alumnos_vw t1
                    WHERE NOT EXISTS (SELECT t2.id_alumno
                    FROM alumno_curso_vw t2
                    WHERE t2.id_alumno = t1.id AND t2.id_curso = ? AND t2.anio=t2.anio_curso) AND alu_activo = 'S'";

			$this->DB->SetFetchMode(ADODB_FETCH_ASSOC);

 			
			$filas = $this->DB->Execute($sql,array($id));

			return $filas;


 		} catch (Exception $e) {
 			
 			print_r('MODEL: ' . $e);

 		}

 	}


 }