<?php
 /**
 * 
 */
 class TipoGasto
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
 	 protected $_descripcion;

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

 	

 public function getTipoGastos(){

 		try {

 			$sql = "SELECT * FROM tipo_gasto ORDER BY descripcion ASC";

			$this->DB->SetFetchMode(ADODB_FETCH_ASSOC);

 			$stmt = $this->DB->Prepare($sql);
 			
			$filas = $this->DB->Execute($stmt);

			return $filas;


 		} catch (Exception $e) {
 			
 			print_r('MODEL: ' . $e);

 		}

 	}

 }