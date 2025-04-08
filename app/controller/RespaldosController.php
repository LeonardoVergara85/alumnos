<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/alumnos/app/model/Respaldos.php';

Class RespaldosController extends Respaldos{
	
	private $respaldo;

	/**
	 * [__construct Inicializa el Controlador]
	 * @param [type] $function [Funcion a ejecutar]
	 */
	function __construct($function){

		/**
		 * 
		 * 	$this->Cargo description: 
		 * 	Se inicializa el Objeto, el cual es el Modelo para la BD. 
		 * 	IMPORTANTE: Este Objeto ya inicializa la conexion con la DB a traves del atributo
		 * 	$this->Modelo->DB.
		 * 	
		 */
		$this->respaldo = new Respaldos();


		/**
		 * Ejecuta la funcion solicitada en la peticion (route.php)
		 */
		$this->$function();

	}



	public function backupBase(){

          
        ///////////
        //$activos = new Activos();
        $backupSQL = $this->respaldo->Respaldar();

        if (strpos($backupSQL, 'ERROR:') === 0) {
            http_response_code(500);
            echo json_encode(["error" => $backupSQL]);
            
            exit;
        }
        
        $this->respaldo->registrarRespaldo();
        // Generar el nombre del archivo
        $backupFile = "backup_".date("dmY").".sql";

        // Enviar respuesta al navegador
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $backupFile . '"');
        header('Pragma: no-cache');
        header('Expires: 0');

        echo $backupSQL;
        exit;

    }
    
    
    public function showUltimoRespaldo(){

		try {

			
			$resp = $this->respaldo->getRespaldo();

			$lista = array();

			foreach ($resp as $dato) {

				array_push($lista, [
					'id' => $dato['id'],
					'estado' => $dato['estado'],
					'fecha' => $dato['fecha'],
					]);

			}

			echo json_encode($lista);

		} catch (Exception $e) {
			
			print_r($e);

		}

  }
    // fin del controlador

}