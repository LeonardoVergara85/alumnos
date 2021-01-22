<?php
 /**
 * 
 */
 class Personas
 {
 	/**
 	 * Variable de Conexion a BD
 	 * @var [Conexion]
 	 */
 	protected $DB;

 	/**
 	 * Variables de la Tabla
 	 */
 	 protected $_id;
 	 protected $_dni;
 	 protected $_nombre;
 	 protected $_apellido;
 	 protected $_domicilio;
 	 protected $_telefono;
 	 protected $_celular;
 	 protected $_nacimiento;

 	 /***********************
	 * **** SETTERS ********
	 * *********************
	 */
	//  function setId($id) {
 //        $this->$id = $id;
 //     }

 //     function setDni($dni) {
 //        $this->$dni = $dni;
 //     }

 //     function setNombre($nombre) {
 //        $this->$nombre = $nombre;
 //     }

 //     function setApellido($apellido) {
 //        $this->$apellido = $apellido;
 //     }

 //     function setDomicilio($domicilio) {
 //        $this->$domicilio = $domicilio;
 //     }

 //      function setTelefono($telefono) {
 //        $this->$telefono = $telefono;
 //     }

 //     function setNacimiento($nacimiento) {
 //        $this->$nacimiento = $nacimiento;
 //     }


	// /***********************
	//  * **** GETTERS ********
	//  * *********************
	//  */
	
	// public function getId()
	// {
	//     return $this->id;
	// }

	// public function getDni()
	// {
	//     return $this->dni;
	// }
 	
 // 	public function getNombre()
	// {
	//     return $this->nombre;
	// }

	// public function getApellido()
	// {
	//     return $this->apellido;
	// }

	// public function getDomicilio()
	// {
	//     return $this->domicilio;
	// }

	// public function getTelefono()
	// {
	//     return $this->telefono;
	// }

	// public function getNacimiento()
	// {
	//     return $this->nacimiento;
	// }

	/***********************
	 * **** FIN GETTERS ********
	 * *********************
	 */

 	function __construct()
 	{

 		$database = new Conexion();

 		$this->DB = $database->db;
 	}

 	public function storePersona($conn){

 		try {
 			
 			$id = null;
 			$dni = $this->_dni;
 			$nombre = $this->_nombre;
 			$apellido = $this->_apellido;
 			$domicilio = $this->_domicilio;
 			$telefono = $this->_telefono;
 			$celu = $this->_celular;
 			$fechan = $this->_nacimiento;

 			$sql = "INSERT INTO personas VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        	$conn->db->Execute($sql,array($id,$dni,$nombre,$apellido,$domicilio,$telefono,$celu,$fechan));

        	$ADODB_FETCH_MODE = ADODB_FETCH_NUM;

        	$sql2 = "SELECT MAX(id) AS id FROM personas";

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
 			$dni = $this->_dni;
 			$nombre = $this->_nombre;
 			$apellido = $this->_apellido;
 			$domicilio = $this->_domicilio;
 			$telefono = $this->_telefono;
 			$celular = $this->_celular;
 			$fechan = $this->_nacimiento;

 			$sql = "UPDATE personas SET dni = ?, nombre= ?, apellido= ?, domicilio=?,telefono= ?, celular = ?,fecha_nac= ? WHERE id = ?";

        	$conn->db->Execute($sql,array($dni,$nombre,$apellido,$domicilio,$telefono,$celular,$fechan,$id));

 		} catch (Exception $e) {
 			
 			print_r('MODEL: ' . $e);

 		}

 	}

 }