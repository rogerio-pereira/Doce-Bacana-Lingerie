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
	private $controladorCliente;
	private $clienteBD;
	private $email;
	private $senha;
	
	
	/*
	 * Getters e Setter
	 */
	function getControladorCliente()
	{
		return $this->controladorCliente;
	}

	function getClienteBD()
	{
		return $this->clienteBD;
	}

	function getEmail()
	{
		return $this->email;
	}

	function getSenha()
	{
		return $this->senha;
	}

	function setControladorCliente($controladorCliente)
	{
		$this->controladorCliente = $controladorCliente;
	}

	function setClienteBD($clienteBD)
	{
		$this->clienteBD = $clienteBD;
	}

	function setEmail($email)
	{
		$this->email = $email;
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
		$this->setControladorCliente(new controladorClientes);
		$this->setEmail(NULL);
		$this->setSenha(NULL);
		$this->setClienteBD(NULL);
	}
	
	/*
	 * Método login
	 * Realiza o login
	 */
	public function login()
	{
		$this->setClienteBD((new controladorClientes())->getClienteByEmail($this->getEmail()));
		
		if($this->compara())
		{
			$_SESSION['cliente'] = $this->getClienteBD();
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
				($this->getEmail()	== $this->getClienteBD()->email) &&
				($this->getSenha()   == $this->getClienteBD()->senha)
			)
		{
			return true;
		}
		else
			return false;
	}
}
?>