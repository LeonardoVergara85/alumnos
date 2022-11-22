<?php
 /**
 * 
 */
 class Productos
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
 	protected $_nombre;


 	
 	function __construct()
 	{
 		$database = new Conexion();
 		$this->DB = $database->db;
 	}


 	public function getProductos(){

 		try {

 			$sql = "SELECT * FROM productos";

			$this->DB->SetFetchMode(ADODB_FETCH_ASSOC);

 			$stmt = $this->DB->Prepare($sql);
 			
			$filas = $this->DB->Execute($stmt);

			return $filas;


 		} catch (Exception $e) {
 			
 			print_r('MODEL: ' . $e);

 		}

 	}


 }