<?php
include_once 'Personas.php';

 /**
 * 
 */
 class Alumnos extends Personas{
 	/**
 	 * Variable de Conexion a BD
 	 * @var [Conexion]
 	 */
 	protected $DB;

 	/**
 	 * Variables de la Tabla
 	 */
 	 protected $_id;
 	 protected $_id_persona;
 	 protected $_escuela;
 	 protected $_grado_anio;
 	 protected $_email;
 	 protected $_hermanos;
	 protected $_tipo;



	/***********************
	 * **** GETTERS ********
	 * *********************
	 */

	public function getId()
	{
	    return $this->_id;
	}
	public function getIdPersona()
	{
	    return $this->_id_persona;
	}

	public function getEscuela()
	{
	    return $this->_escuela;
	}

	public function getGrado()
	{
	    return $this->_grado_anio;
	}

	public function getEmail()
	{
	    return $this->_email;
	}

	public function getHermanos()
	{
	    return $this->_hermanos;
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
 			$idper = $this->_id_persona;
 			$esc = $this->_escuela;
 			$g_a = $this->_grado_anio;
 			$email = $this->_email;
 			$her = $this->_hermanos;

 			$sql = "INSERT INTO alumnos VALUES (?, ?, ?, ?, ?, ?, 'S', NULL)";

        	$conn->db->Execute($sql,array($id,$idper,$esc,$g_a,$email,$her));


 		} catch (Exception $e) {
 			
 			print_r('MODEL: ' . $e);

 		}

 	}

 	public function modificar($conn){

 		try {

 			$id = $this->_id;
 			$esc = $this->_escuela;
 			$g_a = $this->_grado_anio;
 			$email = $this->_email;
 			$her = $this->_hermanos;

 			$sql = "UPDATE alumnos SET escuela = ?, grado= ?, email= ?, hermanos= ?
                    WHERE id = ?";

        	$conn->db->Execute($sql,array($esc,$g_a,$email,$her,$id));


 		} catch (Exception $e) {
 			
 			print_r('MODEL: ' . $e);

 		}

	 }
	 
	 public function eliminarAlumno($conn){

		try {

			$id_alu = $this->_id;

			$sql = "UPDATE alumnos SET ACTIVO = 'N', FECHA_BAJA = NOW() WHERE ID = ? ";

		    $sentencia = $conn->db->Execute($sql,array($id_alu));

			$sql2 = "DELETE c FROM cuota c INNER JOIN alumno_curso ac ON (c.id_alumno_curso = ac.id) WHERE c.fecha_pago = '0000-00-00' AND c.fecha_vencimiento > NOW() AND ac.id_alumno = ?";

		    $sentencia2 = $conn->db->Execute($sql2,array($id_alu));
		

		} catch (Exception $e) {
			
			print_r('MODEL: ' . $e);

		}

	}

	public function renovar($conn){

		try {

			$id_alu = $this->_id;

			$sql = "UPDATE alumnos SET ACTIVO = 'S', FECHA_BAJA = '' WHERE ID = ? ";

		   $conn->db->Execute($sql,array($id_alu));


		} catch (Exception $e) {
			
			print_r('MODEL: ' . $e);

		}

	}


 	public function getAlumnos(){

 		try {
			$tipo = $this->_tipo;
 			$sql = "SELECT id, dni, nombre, apellido, telefono, celular, fecha_nacimiento, activo, fecha_baja FROM alumnos_vw WHERE activo = ? ORDER BY apellido";		
			$this->DB->SetFetchMode(ADODB_FETCH_ASSOC);

 			//$stmt = $this->DB->Prepare($sql);
 			
			 $filas = $this->DB->Execute($sql,array($tipo));

			return $filas;


 		} catch (Exception $e) {
 			
 			print_r('MODEL: ' . $e);

 		}

 	}

 	public function getAlumno(){

 		try {

 			$id = $this->_id;

 			$sql = "SELECT id, id_persona, dni, nombre, apellido, domicilio, telefono, celular, 
			 		fecha_nac, escuela, grado, email, hermanos 
			 		FROM alumnos_vw 
			 		WHERE id = ?";

			$this->DB->SetFetchMode(ADODB_FETCH_ASSOC);

 			
			$filas = $this->DB->Execute($sql,array($id));

			return $filas;


 		} catch (Exception $e) {
 			
 			print_r('MODEL: ' . $e);

 		}

 	}

 	public function getAlumnoExiste(){

 		try {

 			$doc = $this->_documento;

 			$ADODB_FETCH_MODE = ADODB_FETCH_NUM;

 			$sql = "SELECT id FROM alumnos_vw where dni = ?";


			$fila = $this->DB->Execute($sql,array($doc));

			return $fila->fields;


 		} catch (Exception $e) {
 			
 			print_r('MODEL: ' . $e);

 		}

 	}


 	public function getCursosAlumno(){

 		try {

 			$id = $this->_id;

 			$sql = "SELECT * FROM alumno_curso_vw WHERE id_alumno = ? AND vigente = 'S' ORDER BY anio desc ";

			$this->DB->SetFetchMode(ADODB_FETCH_ASSOC);

 			
			$filas = $this->DB->Execute($sql,array($id));

			return $filas;


 		} catch (Exception $e) {
 			
 			print_r('MODEL: ' . $e);

 		}

 	}


 }