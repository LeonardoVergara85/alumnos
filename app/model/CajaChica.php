<?php
 class CajaChica
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
 	 protected $_fecha_apertura;
 	 protected $_fecha_cierre;
 	 protected $_monto_inicial;
 	 protected $_monto_final;
 	 protected $_usuario_apertura_id;
 	 protected $_usuario_cierre_id;
 	 protected $_observaciones;

 	function __construct()
 	{
 		$database = new Conexion();
 		$this->DB = $database->db;
 	}

 	

 public function getCajas(){

 		try {

 			$sql = "SELECT *,
						CASE 
							WHEN DATE(fecha_a) = CURDATE() THEN 'Si'
							ELSE 'No'
						END AS hoy
					FROM caja_vw";

			 $this->DB->SetFetchMode(ADODB_FETCH_ASSOC);

 			 $stmt = $this->DB->Prepare($sql);
 			
			 $filas = $this->DB->Execute($stmt);

			 return $filas;


 		} catch (Exception $e) {
 			
 			print_r('MODEL: ' . $e);

 		}

 	}

public function guardar($conn){
 		try {
 			$monto = $this->_monto_inicial;
 			$usuario = $this->_usuario_apertura_id;
 			$obs = $this->_observaciones;

 			$sql = "INSERT INTO 
				`caja_chica` (`id`, `fecha_apertura`, `fecha_cierre`, `monto_inicial`, `monto_final`, `usuario_apertura_id`, `usuario_cierre_id`, `observaciones`) 
				VALUES (NULL, NOW(), NULL, ?, NULL, ?, NULL, ?)";

        	$conn->db->Execute($sql,array($monto,$usuario,$obs));

			return true;
 		} catch (Exception $e) {
 			print_r('MODEL: ' . $e);
 		}
}

public function cerrar($conn){
 		try {

 			$id = $this->_id;
 			$monto = $this->_monto_final;
 			$usuario = $this->_usuario_cierre_id;

 			$sql = "UPDATE `caja_chica` 
					SET `fecha_cierre` = NOW(), `monto_final` = ?, `usuario_cierre_id` = ?
					WHERE `caja_chica`.`id` = ? ";

        	$conn->db->Execute($sql,array($monto,$usuario,$id));
			return true;

 		} catch (Exception $e) {
 			print_r('MODEL: ' . $e);
 		}
}	
	
	// fin modelo //

 }