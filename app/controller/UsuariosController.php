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

	function backupDatabase($host, $username, $password, $database, $outputDir = './') {
            $date = date('Y-m-d_H-i-s');
            $backupFile = $outputDir . "backup_{$database}_{$date}.sql";
        
            // Comando para exportar la base de datos
            $command = "mysqldump --host={$host} --user={$username} --password={$password} {$database} > {$backupFile}";
        
            // Ejecutar el comando
            system($command, $output);
        
            if ($output === 0) {
                echo "Respaldo exitoso: {$backupFile}\n";
            } else {
                echo "Error al realizar el respaldo.\n";
            }
    }

	public function backupBase(){
	        
	        
            // Configuración de la base de datos
            //$this->db->Connect("mysql.hostinger.com.ar", "u622404615_ingles", "Ingles--2023", "u622404615_ingles");
            $host = 'mysql.hostinger.com.ar';
            var_dump($host);
            $username = 'u622404615_ingles';
            $password = 'Ingles--2023';
            $database = 'u622404615_ingles';
            $outputDir = __DIR__ . '/backups/';
        
            // Crear el directorio de respaldo si no existe
        if (!is_dir($outputDir)) {
            mkdir($outputDir, 0755, true);
        }
        
        backupDatabase($host, $username, $password, $database, $outputDir);

	}


}