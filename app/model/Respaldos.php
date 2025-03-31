<?php
 /**
 * 
 */
 class Respaldos
 {
 	/**
 	 * Variable de Conexion a BD
 	 * @var [Conexion]
 	 */
 	protected $DB;

 	/**
 	 * Variables de la Tabla
 	 */

	 private $host = "localhost";
	 private $usuario = "root"; // Cambiar según tu configuración
	 private $password = ""; // Cambiar según tu configuración
	 private $base_datos = "alumnos"; // Cambiar según tu configuración
	 private $ruta_respaldo = 'C:/'; // Carpeta donde se guardarán los respaldos

 	
 	function __construct()
 	{
 		$database = new Conexion();
 		$this->DB = $database->db;
 	}



	 public function generarRespaldo() {
		
		$fecha = date("Ymd_His");
		$archivo_sql = $this->ruta_respaldo . "respaldo_" . $this->base_datos . "_$fecha.sql";
		//var_dump($archivo_sql);
		// Comando mysqldump
		$comando = "mysqldump --host={$this->host} --user={$this->usuario} --password={$this->password} {$this->base_datos} > {$archivo_sql}";
		//var_dump($comando);
		// Ejecutar comando
		$resultado = system($comando, $salida);
		
		// Verificar si se generó el archivo
		if ($salida === 0 && file_exists($archivo_sql)) {
			return true;
		} else {
			return false;
		}
	}
    
 }