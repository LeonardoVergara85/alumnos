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

        try {
		
           // $conn = new Conexion();
           
            // $conn->db->startTrans();
 
            $resultado = $this->respaldo->generarRespaldo();
            return false;
            if ($resultado) {
                echo 'ok';
            } else {
                
            }
            

           // $conn->db->completeTrans();

           

       } catch (Exception $e) {
           
           print_r($e);

       }

	}


}