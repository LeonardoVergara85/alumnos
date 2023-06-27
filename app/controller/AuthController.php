<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/alumnos/app/model/Auth.php';
/**
* 
*/

define("CLAVE_SECRETA", "6LdPx9YmAAAAAJ4C0h-2CPfKjdCbc31-D1enWgF3");

class AuthController extends Auth{	

	private $AuthModel;
	
	function __construct($function = null)
	{
		
		$this->AuthModel = new Auth();

		if($function != null){

			$this->$function();

		}

	}



	function logueo(){
		try {

			  function verificarToken($token, $claveSecreta)
				{
				# La API en donde verificamos el token
				$url = "https://www.google.com/recaptcha/api/siteverify";
				# Los datos que enviamos a Google
				$datos = [
					"secret" => $claveSecreta,
					"response" => $token,
				];
				// Crear opciones de la petición HTTP
				$opciones = array(
					"http" => array(
						"header" => "Content-type: application/x-www-form-urlencoded\r\n",
						"method" => "POST",
						"content" => http_build_query($datos), # Agregar el contenido definido antes
					),
				);
				# Preparar petición
				$contexto = stream_context_create($opciones);
				# Hacerla
				$resultado = file_get_contents($url, false, $contexto);
				# Si hay problemas con la petición (por ejemplo, que no hay internet o algo así)
				# entonces se regresa false. Este NO es un problema con el captcha, sino con la conexión
				# al servidor de Google
				if ($resultado === false) {
					# Error haciendo petición
					return false;
				}
			
				# En caso de que no haya regresado false, decodificamos con JSON
				# https://parzibyte.me/blog/2018/12/26/codificar-decodificar-json-php/
			
				$resultado = json_decode($resultado);
				# La variable que nos interesa para saber si el usuario pasó o no la prueba
				# está en success
				$pruebaPasada = $resultado->success;
				# Regresamos ese valor, y listo (sí, ya sé que se podría regresar $resultado->success)
				return $pruebaPasada;
			}
				// Antes de comprobar usuario y contraseña, vemos si resolvieron el captcha
				$token = $_POST['recaptcha']; // acá viene el response del recaptcha del frontend
				$verificado = verificarToken($token, CLAVE_SECRETA); // verificamos llamando a la función
				if($verificado){
					$this->AuthModel->_username = $_POST['user'];
					$this->AuthModel->_password = $_POST['pass'];
	
					$rdo = $this->AuthModel->getAccesSystem();
				
					if( $rdo != null ){
	
						$hashBase = $rdo[0]['pass'];
	
						// verificamos el hash con la constraseña ingresada
						$verifica = password_verify($_POST['pass'], $hashBase);
						
						if($verifica){
	
							$pass = 'skills123456';    
							$passHash = password_hash($pass, PASSWORD_BCRYPT);
	
							$this->AuthModel->_token = $passHash;
							$this->AuthModel->_id = $rdo[0]['id'];
							$this->AuthModel->SaveApiToken();
	
							/*
							* Guardar en SESSION
							*/
							$this->sett_var('user_id', $rdo[0]['id']);
							$this->sett_var('user', $rdo[0]['username']);
							$this->sett_var('user_name', $rdo[0]['nombre']);
							$this->sett_var('user_ape', $rdo[0]['apellido']);
							$this->sett_var('dni', $rdo[0]['dni']);
							$this->sett_var('api_token', $passHash);
							
							echo 'ok';
	
						}else{
							
							session_destroy();
							echo 'pass';
	
						}
						
	
					}else{
	
						
						session_destroy();
						echo 'usu';
	
					}
				}else{
					session_destroy();
					echo 'recaptcha';	
				}
				
		} catch (Exception $e) {
			
		}

	}


	function logout(){


		$this->AuthModel->_id = $_SESSION['user_id'];
		$rdo = $this->AuthModel->DeleteApiToken();

		session_destroy();

		$ruta = '../../../alumnos/site_media/views/logueo';

		header('location: '. $ruta);

	}


	function ChequearAuth(){

		 $check = $this->gett_var('user');

		if($check == 'Error Session'){

			$ruta = '../../../site_media/views/logueo';

		     header('location: '. $ruta);

		     exit();
		 } 

		

		if ($this->checkAuth() == 'false'){
			
			$this->logout();

		}else{

			// if( $this->ChekTimeSession() == 'out'){

			// 	$this->logout();

			// }

		}

	}


	/*
	function TiempoDeSession(){

		if( $this->ChekTimeSession() == 'out'){

			$this->logout();

		}

	}
	*/


	/**
	 * Controla el accesos a la pagina que recibe como parametro.
	 * Además, controla las acciones que tiene permitidas dentro de dicha pagina.
	 * @param [string] $server_request_uri [URL de la pagina]
	 */
	function CheckPermisosAcciones($server_request_uri){

		$patch = substr(strrchr($server_request_uri, "/"), 1);
		
		$url = '/' . substr($patch, 0, strrpos($patch, "."));


		/**
		 * Verificar que tenga permiso para acceder a la pagina.
		 * Retorna TRUE si tiene acceso, de lo contrario devuelve FALSE.
		 * Las paginas a las cuales tiene acceso estan guardas en la VARIABLES
		 * de SESSION['fuenciones'].
		 * @var [type]
		 */
		$access = $this->AuthModel->url_access($url);

		if( $access ){

			return $this->AuthModel->url_actions($url);

		}else{

			$ruta = '../../../alumnos/site_media/views/access_denied.php';

			header('location: '. $ruta);

			//$this->logout();

		}
		

	}




}