<?php
 /**
 * 
 */
 class Usuarios
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
 	protected $_username;
 	protected $_password;
 	protected $_id_persona;
 	protected $_id_tipo_usuario;
 	protected $_fecha_carga;


 	
 	function __construct()
 	{
 		$database = new Conexion();
 		$this->DB = $database->db;
 	}


 	public function getUsuarios(){

 		try {

 			$sql = "SELECT * FROM usuarios_vw WHERE vigente = '0000-00-00'";

			$this->DB->SetFetchMode(ADODB_FETCH_ASSOC);

 			$stmt = $this->DB->Prepare($sql);
 			
			$filas = $this->DB->Execute($stmt);

			return $filas;


 		} catch (Exception $e) {
 			
 			print_r('MODEL: ' . $e);

 		}

 	}


 }