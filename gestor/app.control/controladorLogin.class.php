<?php 
	session_start();
	header("Content-Type:text/html; charset=UTF-8",true) 
?>

<?php
/*
 * 	Classe  controladorLogin
 * 	Controla o Login
 * 	
 *	Sistema:	Doce___Bacana_Lingerie
 *	Autor: 		Rogério Eduardo Pereira
 *	Data: 		27/01/2015
 */

/*
 * Classe login
 */
class controladorLogin
{
	/*
	 * Variaveis
	 */
	private $controladorUsuario;
	private $usuarioBD;
	private $usuario;
	private $senha;
	
	
	/*
	 * Getters e Setter
	 */
	function getControladorUsuario()
	{
		return $this->controladorUsuario;
	}

	function getUsuarioBD()
	{
		return $this->usuarioBD;
	}

	function getUsuario()
	{
		return $this->usuario;
	}

	function getSenha()
	{
		return $this->senha;
	}

	function setControladorUsuario($controladorUsuario)
	{
		$this->controladorUsuario = $controladorUsuario;
	}

	function setUsuarioBD($usuarioBD)
	{
		$this->usuarioBD = $usuarioBD;
	}

	function setUsuario($usuario)
	{
		$this->usuario = $usuario;
	}

	function setSenha($senha)
	{
		$this->senha = md5($senha);
	}

		

	/*
	 * Método construtor
	 */
	public function __construct()
	{		
		new session();
		$this->setControladorUsuario(new controladorUsuario);
		$this->setUsuario(NULL);
		$this->setSenha(NULL);
		$this->setUsuarioBD(NULL);
	}
	
	/*
	 * Método login
	 * Realiza o login
	 */
	public function login()
	{
		$this->setUsuarioBD($this->controladorUsuario->getUsuarioBDByUser2($this->getUsuario()));
		
		if($this->compara())
		{
			$_SESSION['usuario'] = $this->usuarioBD;
			
			return true;
		}
		else
			return false;
	}
	
	/*
	 * MÃ©todo compara
	 * Compara usuario e senha
	 */
	private function compara()
	{	
		if  (
				($this->getUsuario() == $this->usuarioBD->usuario) &&
				($this->getSenha()   == $this->usuarioBD->senha)
			)
		{
			return true;
		}
		else
			return false;
	}
}
?>