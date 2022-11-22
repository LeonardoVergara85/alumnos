<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/alumnos/app/model/Usuarios.php';

Class UsuariosController extends Usuarios{
	
	private $usuario;

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
		$this->usuario = new Usuarios();


		/**
		 * Ejecuta la funcion solicitada en la peticion (route.php)
		 */
		$this->$function();

	}


	public function show(){

		try {
			
			$Usuarios = $this->usuario->getUsuarios();

			$lista = array();

			foreach ($Usuarios as $usu) {

				array_push($lista, $usu);

			}

			echo json_encode($lista);

		} catch (Exception $e) {
			
			print_r($e);

		}

	}




}