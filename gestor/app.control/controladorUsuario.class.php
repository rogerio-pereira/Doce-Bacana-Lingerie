<?php
/*
 * 	Classe  controladorUsuario
 * 	Controla a Classe Usuario
 * 	
 * 	Sistema:	Kanban
 * 	Autor:		Rogério Eduardo Pereira
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
	private $telaCategoria;
	private $telaOrcamento;
	private $telaProduto;
	private $telaUsuario;
	private $telaCliente;
	
	private $senhaAtual;
	
	function getRepository()
	{
		return $this->repository;
	}

	function getCollectionUsuario()
	{
		$this->setCollectionUsuario(NULL);
		
		//RECUPERA CONEXAO BANCO DE DADOS
		TTransaction::open('my_bd_site');

		//TABELA exposition_gallery
		$criteria	= new TCriteria;
		//$criteria->add(new TFilter('situacao', '=', $situacao));
		$criteria->setProperty('order', 'nome');
		
		$this->repository = new TRepository();
		
		$this->repository->addColumn('*');
		$this->repository->addEntity('usuarios');
		
		$this->setCollectionUsuario($this->repository->load($criteria));
		
		TTransaction::close();
		
		return $this->collectionUsuario;
	}
	
	function getCollectionUsuario2()
	{
		$this->setCollectionUsuario(NULL);
		
		//RECUPERA CONEXAO BANCO DE DADOS
		TTransaction2::open('my_bd_site');
		
		//TABELA exposition_gallery
		$criteria	= new TCriteria;
		//$criteria->add(new TFilter('situacao', '=', $situacao));
		$criteria->setProperty('order', 'nome');
		
		$this->repository = new TRepository2();
		
		$this->repository->addColumn('*');
		$this->repository->addEntity('usuarios');
		
		$this->setCollectionUsuario($this->repository->load($criteria));
		
		
		TTransaction2::close();
		
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
		//$criteria	= new TCriteria;
		//$criteria->add(new TFilter('codigo', '=', $codigo));
		//$criteria->setProperty('order', 'ordem ASC');
		
		$this->usuario = new usuariosModel();
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
		
		$this->setUsuarioBD(new usuariosModel2());
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
		
		$this->setUsuarioBD(new usuariosModel());
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
		
		$this->setUsuarioBD(new usuariosModel2());
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
	function getTelaCategoria()
	{
		return $this->telaCategoria;
	}

	function getTelaOrcamento()
	{
		return $this->telaOrcamento;
	}

	function getTelaProduto()
	{
		return $this->telaProduto;
	}

	function getTelaUsuario()
	{
		return $this->telaUsuario;
	}

	function setTelaCategoria($telaCategoria)
	{
		$this->telaCategoria = $telaCategoria;
	}

	function setTelaOrcamento($telaOrcamento)
	{
		$this->telaOrcamento = $telaOrcamento;
	}

	function setTelaProduto($telaProduto)
	{
		$this->telaProduto = $telaProduto;
	}

	function setTelaUsuario($telaUsuario)
	{
		$this->telaUsuario = $telaUsuario;
	}
	
	function getSenhaAtual()
	{
		return $this->senhaAtual;
	}

	function setSenhaAtual($senhaAtual)
	{
		$this->senhaAtual = md5($senhaAtual);
	}
	function getTelaCliente()
	{
		return $this->telaCliente;
	}

	function setTelaCliente($telaCliente)
	{
		$this->telaCliente = $telaCliente;
	}

		
		

	/*
	 * MÃ©todo construtor
	 */
	public function __construct()
	{
		$this->setRepository(NULL);
		$this->setUsuarioBD(NULL);
		$this->setCodigo(NULL);
		$this->setNome(NULL);
		$this->setUser(NULL);
		$this->setSenha(NULL);
		$this->setSenhaAtual(NULL);
		$this->setTelaCliente(NULL);
	}

	public function zeraRepository()
	{
		$this->setRepository(NULL);
	}
	
	/*
	 *	Método getUsuarios
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
	 *	MÃ©todo getUsuarios2
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
		$this->repository->addEntity('usuarios');
		
		$this->setCollectionUsuario($this->repository->load($criteria));
		
		return $this->collectionUsuario;
	}
	
	/*
	 *	MÃ©todo salvarUsuario2
	 *	Insere/Atualiza a situaÃ§Ã£o
	 *	Usado em IFRAMES
	 */
	public function salvarUsuario2()
	{
		try
		{
			$this->usuario = new usuariosModel2();
			
			$this->usuario->codigo			= $this->getCodigo();
			$this->usuario->nome			= $this->getNome();
			$this->usuario->usuario			= $this->getUser();
			if($this->getCodigo() == '')
				$this->usuario->senha		= $this->getSenha();
			$this->usuario->telaCategoria	= $this->getTelaCategoria();
			$this->usuario->telaOrcamento	= $this->getTelaOrcamento();
			$this->usuario->telaProduto		= $this->getTelaProduto();
			$this->usuario->telaUsuario		= $this->getTelaUsuario();
			$this->usuario->telaCliente		= $this->getTelaCliente();
			
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
	 *	Método apaga2
	 *	Apaga o usuário com o codigo especifico;
	 *	Usado em IFRAME
	 */
	public function apaga2($codigo)
	{
		try
		{
			$this->setUsuarioBD(new usuariosModel2());

			//RECUPERA CONEXAO BANCO DE DADOS
			TTransaction2::open('my_bd_site');

			$this->usuario->delete($codigo);

			TTransaction2::close();

			return true;
		}
		catch(Exception $e)
		{
			return false;
		}
	}
	
	/*
	 * Método confirma Senha Atual
	 * Confirma a senha do usuario logado
	 */
	public function verificaSenhaAtual()
	{
		if($this->getSenhaAtual() === $_SESSION['usuario']->senha)
			return true;
		else
			return false;
	}
	
	/*
	 * Método altera senha
	 * Altera a senha do usuario ativo
	 */
	public function alteraSenha()
	{
		try
		{
			$this->setUsuarioBD(new usuariosModel2);
			
			$this->usuario->codigo	= $_SESSION['usuario']->codigo;
			$this->usuario->senha	= $this->getSenha();

			//RECUPERA CONEXAO BANCO DE DADOS
			TTransaction2::open('my_bd_site');

			$result = $this->usuario->store();

			TTransaction2::close();

			return true;
		}
		catch (Exception $e)
		{
			return false;;
		}
	}
}
?>