<?php

 /**
 * 
 */
 // class Gastos extends TipoGasto{
  class Gastos{	
 	/**
 	 * Variable de Conexion a BD
 	 * @var [Conexion]
 	 */
 	protected $DB;

 	/**
 	 * Variables de la Tabla
 	 */
 	 protected $_id;
 	 protected $_id_tipogasto;
 	 protected $_id_usuario;
 	 protected $_importe;
 	 protected $_fecha;
 	 protected $_observaciones;
 	 protected $_pagado_por;
 	 protected $_forma_pago;


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
 			$idtg = $this->_id_tipogasto;
 			$importe = $this->_importe;
 			$obs = $this->_observaciones;
 			$idusuario = $this->_id_usuario;
 			$pagadopor = $this->_pagado_por;
 			$formap = $this->_forma_pago;
 			// $email = $this->_email;
 			// $her = $this->_hermanos;

 			$sql = "INSERT INTO gastos VALUES (?, ?, ?, ?, NOW(), ?, ?, ?)";

        	$conn->db->Execute($sql,array($id,$idtg,$idusuario,$importe,$obs,$pagadopor,$formap));


 		} catch (Exception $e) {
 			
 			print_r('MODEL: ' . $e);

 		}

 	}

 	public function modificar($conn){

 		try {

 			$id = $this->_id;
 			$idtg = $this->_id_tipogasto;
 			$importe = $this->_importe;
 			$obs = $this->_observaciones;
 			$pagadopor = $this->_pagado_por;
 			$formap = $this->_forma_pago;
 
 			$sql = "UPDATE gastos SET id_tipo_gasto = ?, importe= ?, observaciones= ?, pagado_por= ?, forma_pago= ?
					WHERE id = ?";

        	$conn->db->Execute($sql,array($idtg,$importe,$obs,$pagadopor,$formap,$id));


 		} catch (Exception $e) {
 			
 			print_r('MODEL: ' . $e);

 		}

 	}


 	public function getGastos(){

 		try {

 			$sql = "SELECT * FROM gastos_vw";

			$this->DB->SetFetchMode(ADODB_FETCH_ASSOC);

 			$stmt = $this->DB->Prepare($sql);
 			
			$filas = $this->DB->Execute($stmt);

			return $filas;


 		} catch (Exception $e) {
 			
 			print_r('MODEL: ' . $e);

 		}

 	}

    public function getGastosHoy(){

 		try {

 			$sql = "SELECT * 
					FROM gastos_vw
					WHERE date(fecha) = date(NOW())";

			$this->DB->SetFetchMode(ADODB_FETCH_ASSOC);

 			$stmt = $this->DB->Prepare($sql);
 			
			$filas = $this->DB->Execute($stmt);

			return $filas;


 		} catch (Exception $e) {
 			
 			print_r('MODEL: ' . $e);

 		}

 	}


 	public function getGastosFecha($desde,$hasta){

 		try {
 			$d = $desde;
 			$h = $hasta;

 			$sql = "SELECT * 
					FROM gastos_vw 
					WHERE fecha BETWEEN CAST(? AS DATE) AND CAST(? AS DATE) order by fecha;";
 			
			$filas = $this->DB->Execute($sql,array($d,$h));

			return $filas;


 		} catch (Exception $e) {
 			
 			print_r('MODEL: ' . $e);

 		}

 	}

 	public function getGastosTipoFecha($desde,$hasta,$tipo){

 		try {
 			$d = $desde;
 			$h = $hasta;
 			$t = $tipo;

 			$sql = "SELECT * FROM gastos_vw 
			WHERE fecha BETWEEN CAST(? AS DATE) AND CAST(? AS DATE) AND ID_TIPO_GASTO = ? order by fecha;";
 			
			$filas = $this->DB->Execute($sql,array($d,$h,$t));

			return $filas;


 		} catch (Exception $e) {
 			
 			print_r('MODEL: ' . $e);

 		}

 	}


 	public function getGasto(){

 		try {

 			$id = $this->_id;

 			$sql = "SELECT * FROM gastos_vw where id = ?";

			$this->DB->SetFetchMode(ADODB_FETCH_ASSOC);

 			
			$filas = $this->DB->Execute($sql,array($id));

			return $filas;


 		} catch (Exception $e) {
 			
 			print_r('MODEL: ' . $e);

 		}

 	}


 }