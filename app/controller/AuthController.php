<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/alumnos/app/model/Auth.php';
/**
* 
*/
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