<?php
 /**
 * 
 */
 class Importes
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
 	 protected $_importe;
 	 protected $_fecha;


 	function __construct()
 	{

 		$database = new Conexion();

 		$this->DB = $database->db;
 	}

 	

public function guardar($conn){

 		try {

 			$id = null;
 			$importe = $this->_importe;


 			$sql = "INSERT INTO importes VALUES (?, ?, NOW())";

        	$conn->db->Execute($sql,array($id,$importe));

        	$ADODB_FETCH_MODE = ADODB_FETCH_NUM;

        	$sql2 = "SELECT MAX(id) AS id FROM importes";

        	$stmt2 = $conn->db->Prepare($sql2);

        	$fila = $conn->db->Execute($stmt2);

			return $fila->fields;


 		} catch (Exception $e) {
 			
 			print_r('MODEL: ' . $e);

 		}

 	}

 }