<?php
include_once 'Importes.php';
 /**
 * 
 */
 class CursoImporte extends Importes
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
 	 protected $_id_curso;
 	 protected $_id_importe;
 	 protected $_vigente;


 	function __construct()
 	{

 		$database = new Conexion();

 		$this->DB = $database->db;
 	}

 	

public function guardar($conn){

 		try {

 			$id = null;
 			$idcurso = $this->_id_curso;
 			$idimporte = $this->_id_importe;


 			$sql = "INSERT INTO curso_importe VALUES (?, ?, ?, 'S')";

        	$conn->db->Execute($sql,array($id,$idcurso,$idimporte));


 		} catch (Exception $e) {
 			
 			print_r('MODEL: ' . $e);

 		}

 	}

 	public function sacarVigencia($conn){

 		try {

 			$id = $this->_id;

 			$sql = "UPDATE curso_importe SET vigente = 'N' WHERE id = ?";

        	$conn->db->Execute($sql,array($id));


 		} catch (Exception $e) {
 			
 			print_r('MODEL: ' . $e);

 		}

 	}

 	public function getCursoImporte(){

 		try {

 			$idcurso = $this->_id_curso;

 			$sql = "SELECT * FROM curso_importe_vw WHERE curso_id = ? ORDER BY fecha desc";

        	$fila = $this->DB->Execute($sql,array($idcurso));

        	return $fila;

 		} catch (Exception $e) {
 			
 			print_r('MODEL: ' . $e);

 		}

 	}

 }