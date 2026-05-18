<?php

//include_once 'CursoImporte.php';

 /**
 * 
 */
 class Activos{
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
 	 protected $_importe;
 	 protected $_fecha;
 	 protected $_forma_pago;
 	 protected $_id_usuario;
 	 protected $_id_alumno;


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

  
 			$desc = $this->_descripcion;
 			$imp = $this->_importe;
 			$fp = $this->_forma_pago;
 			$usu = $this->_id_usuario;
 			$alu = $this->_id_alumno;

 	

 			$sql = "INSERT INTO activos 
                    (id,descripcion,importe,fecha,forma_pago,id_usuario,id_alumno,activo)
                    VALUES(NULL,?,?,NOW(),?,?,?,'S')";

        	$conn->db->Execute($sql,array($desc,$imp,$fp,$usu,$alu));

			return true;


 		} catch (Exception $e) {
 			
 			print_r('MODEL: ' . $e);

 		}

 	}

	 public function modificar($conn){

		try {

			$id = $this->_id;
			$desc = $this->_descripcion;
			$imp = $this->_importe;
			$fp = $this->_forma_pago;
			$usu = $this->_id_usuario;
			$alu = $this->_id_alumno;

			$sql = "UPDATE activos SET descripcion = ?, importe = ?, forma_pago = ?, id_usuario = ?, id_alumno = ?
					WHERE id = ?";

		   $conn->db->Execute($sql,array($desc,$imp,$fp,$usu,$alu,$id));

		   return true;


		} catch (Exception $e) {
			
			print_r('MODEL: ' . $e);

		}

	}

	 public function getActivos(){

		try {

			$sql = "SELECT id, descripcion, importe, fecha_activo, fecha, pago, nombre_alumno, apellido_alumno FROM activos_vw ORDER BY fecha desc";

		   $this->DB->SetFetchMode(ADODB_FETCH_ASSOC);

			$stmt = $this->DB->Prepare($sql);
			
		   $filas = $this->DB->Execute($stmt);

		   return $filas;


		} catch (Exception $e) {
			
			print_r('MODEL: ' . $e);

		}

	 }

	 public function getActivo(){

		

		try {

			$sql = "SELECT id, descripcion, importe, fecha_activo, fecha, pago,forma_pago, alumno_id FROM activos_vw WHERE id = ?";

		   $this->DB->SetFetchMode(ADODB_FETCH_ASSOC);

			$stmt = $this->DB->Prepare($sql);
			
		   $filas = $this->DB->Execute($stmt,array($this->_id));

		   return $filas;


		} catch (Exception $e) {
			
			print_r('MODEL: ' . $e);

		}

	 }
	 

public function getActivosAlumno(){

		

		try {

			$sql = "SELECT id, descripcion, importe, fecha_activo, fecha, pago,forma_pago, alumno_id FROM activos_vw WHERE alumno_id = ? order by fecha desc";

		   $this->DB->SetFetchMode(ADODB_FETCH_ASSOC);

			$stmt = $this->DB->Prepare($sql);
			
		   $filas = $this->DB->Execute($stmt,array($this->_id_alumno));

		   return $filas;


		} catch (Exception $e) {
			
			print_r('MODEL: ' . $e);

		}

	 }
	 

 }