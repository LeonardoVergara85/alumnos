<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/alumnos/app/model/Productos.php';

Class ProductosController extends Productos{
	
	private $Producto;

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
		$this->Producto = new Productos();


		/**
		 * Ejecuta la funcion solicitada en la peticion (route.php)
		 */
		$this->$function();

	}


	public function show(){

		try {
			
			$productos = $this->Producto->getProductos();

			$lista = array();

			foreach ($productos as $producto) {

				array_push($lista, ['title' => $producto['descripcion'],'cod' => $producto['cod_barra'], 'width' => '10%']);

			}

			echo json_encode($lista);

		} catch (Exception $e) {
			
			print_r($e);

		}

	}




}