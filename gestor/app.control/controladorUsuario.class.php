<?php
/*
 * 	Classe  controladorUsuario
 * 	Controla a Classe Usuario
 * 	
 * 	Sistema:	Kanban
 * 	Autor:		Rog�rio Eduardo Pereira
 * 	Data:		27/01/2015
 */

/*
 * Classe controladorUsuario
 */
class controladorUsuario
{

	
	/*
	 * Variaveis
	 */
	private $repository;
	private $usuario;
	private $collectionUsuario;
	
	private $codigo;
	private $nome;
	private $user;
	private $senha;
	
	function getRepository()
	{
		return $this->repository;
	}

	function getCollectionUsuario()
	{
		return $this->collectionUsuario;
	}

	function setRepository($repository)
	{
		$this->repository = $repository;
	}

	function setCollectionUsuario($collectionUsuario)
	{
		$this->collectionUsuario = $collectionUsuario;
	}

		
	public function getUsuarioBDByCod($codigo)
	{
		$this->setUsuarioBD(NULL);
		$result;
		
		//RECUPERA CONEXAO BANCO DE DADOS
		TTransaction::open('my_bd_site');

		//TABELA exposition_gallery
		$criteria	= new TCriteria;
		$criteria->add(new TFilter('codigo', '=', $codigo));
		//$criteria->setProperty('order', 'ordem ASC');
		
		$this->usuario = new usuarios();
		$result = $this->usuario->load($codigo);
		
		return $result;
	}
	public function getUsuarioBDByCod2($codigo)
	{
		$this->setUsuarioBD(NULL);
		$result;
		
		//RECUPERA CONEXAO BANCO DE DADOS
		TTransaction2::open('my_bd_site');

		//TABELA exposition_gallery
		$criteria	= new TCriteria;
		$criteria->add(new TFilter('codigo', '=', $codigo));
		//$criteria->setProperty('order', 'ordem ASC');
		
		$this->setUsuarioBD(new usuarios2());
		$result = $this->usuario->load($codigo);
		
		return $result;
	}
	public function getUsuarioBDByUser($user)
	{
		$this->setUsuarioBD(NULL);
		$result;
		
		//RECUPERA CONEXAO BANCO DE DADOS
		TTransaction::open('my_bd_site');

		//TABELA exposition_gallery
		$criteria	= new TCriteria;
		$criteria->add(new TFilter('usuario', '=', $user));
		//$criteria->setProperty('order', 'ordem ASC');
		
		$this->setUsuarioBD(new usuarios());
		$result = $this->usuario->loadCriteria($criteria);
		
		return $result;
	}
	public function getUsuarioBDByUser2($user)
	{
		$this->setUsuarioBD(NULL);
		$result;
		
		//RECUPERA CONEXAO BANCO DE DADOS
		TTransaction2::open('my_bd_site');

		//TABELA exposition_gallery
		$criteria	= new TCriteria;
		$criteria->add(new TFilter('usuario', '=', $user));
		//$criteria->setProperty('order', 'ordem ASC');
		
		$this->setUsuarioBD(new usuarios2());
		$result = $this->usuario->loadCriteria($criteria);
		
		return $result;
	}
	public function setUsuarioBD($usuario)
	{
		$this->usuario = $usuario;
	}
	
	public function getCodigo()
	{
		return $this->codigo;
	}
	public function getNome()
	{
		return $this->nome;
	}
	public function getUser()
	{
		return $this->user;
	}
	public function getSenha()
	{
		return $this->senha;
	}
	public function setCodigo($codigo)
	{
		$this->codigo = $codigo;
	}
	public function setNome($nome)
	{
		$this->nome = $nome;
	}
	public function setUser($user)
	{
		$this->user = $user;
	}
	public function setSenha($senha)
	{
		$this->senha = md5($senha);
	}
	

	/*
	 * Método construtor
	 */
	public function __construct()
	{
		$this->setRepository(NULL);
		$this->setUsuarioBD(NULL);
		$this->setCodigo(NULL);
		$this->setNome(NULL);
		$this->setUser(NULL);
		$this->setSenha(NULL);
	}

	public function zeraRepository()
	{
		$this->setRepository(NULL);
	}
	
	/*
	 *	M�todo getUsuarios
	 *	Obtem todos os usuarios
	 */
	public function getUsuarios()
	{
		$this->setCollectionUsuario(NULL);
		
		//RECUPERA CONEXAO BANCO DE DADOS
		TTransaction::open('my_bd_site');

		//TABELA exposition_gallery
		$criteria	= new TCriteria;
		//$criteria->add(new TFilter('situacao', '=', $situacao));
		$criteria->setProperty('order', 'nome');
		
		$this->setRepository(new TRepository());
		
		$this->repository->addColumn('*');
		$this->repository->addEntity('usuarios');
		
		$this->setCollectionUsuario($this->repository->load($criteria));
		
		return $this->collectionUsuario;
	}
	
	/*
	 *	Método getUsuarios2
	 *	Obtem todos os usuarios
	 */
	public function getUsuarios2()
	{
		$this->setCollectionUsuario(NULL);
		
		//RECUPERA CONEXAO BANCO DE DADOS
		TTransaction2::open('my_bd_site');

		//TABELA exposition_gallery
		$criteria	= new TCriteria;
		//$criteria->add(new TFilter('situacao', '=', $situacao));
		$criteria->setProperty('order', 'nome');
		
		$this->setRepository(new TRepository());
		
		$this->repository->addColumn('*');
		$this->repository->addEntity('usuarios2');
		
		$this->setCollectionUsuario($this->repository->load($criteria));
		
		return $this->collectionUsuario;
	}
	
	/*
	 *	Método salvarUsuario2
	 *	Insere/Atualiza a situação
	 *	Usado em IFRAMES
	 */
	public function salvarUsuario2()
	{
		try
		{
			$this->usuario = new kanban_usuario2();
			
			$this->usuario->codigo		= $this->getCodigo();
			$this->usuario->nome		= $this->getNome();
			$this->usuario->usuario		= $this->getUser();
			if($this->getCodigo() == '')
				$this->usuario->senha	= $this->getSenha();
			$this->usuario->cor			= $this->getCor();
			
			//RECUPERA CONEXAO BANCO DE DADOS
			TTransaction2::open('my_bd_site');

			$result = $this->usuario->store();

			TTransaction2::close();

			return true;
		}
		catch(Exception $e)
		{
			return false;
		}
	}
	
	/*
	 *	Método alteraSenha
	 *	Altera a senha do Usuario
	 *	Usado em IFRAMES
	 */
	public function alteraSenha()
	{
		try
		{
			$this->usuario = new kanban_usuario2();
			
			$this->usuario->codigo		= $_SESSION['usuario']->codigo;
			$this->usuario->nome		= $_SESSION['usuario']->nome;
			$this->usuario->usuario		= $_SESSION['usuario']->usuario;
			$this->usuario->senha		= $this->getSenha();
			$this->usuario->cor			= $_SESSION['usuario']->cor;
			
			//RECUPERA CONEXAO BANCO DE DADOS
			TTransaction2::open('my_bd_site');

			$result = $this->usuario->store();
			
			TTransaction2::close();

			return true;
		}
		catch(Exception $e)
		{
			return false;
		}
	}
}
?>