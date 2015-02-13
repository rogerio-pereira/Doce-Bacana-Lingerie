<?php

/*
 * 	Arquivo  controladorClientes.class.php
 * 	Controlador de Cadastro de Clientes
 * 	
 * 	Sistema:	Doce___Bacana_Lingerie
 * 	Autor:      Rogério Eduardo Pereira
 * 	Data:       22/01/2015
 */

/*
 * Classe controladorClientes.class.php
 */
class controladorClientes
{
	/*
	 * Variaveis
	 */
	private $cliente;
	
	private $codigo;
	private $pessoa;
	private $nome;
	private $nomeResponsavel;
	private $cpf;
	private $cnpj;
	private $informacaoTributaria;
	private $inscricaoEstadual;
	private $nascimento;
	private $sexo;
	private $telefone;
	private $celular;
	private $email;
	private $senha;
	private $ofertaEmail;
	private $ofertaCelular;
	private $cep;
	private $endereco;
	private $numero;
	private $complemento;
	private $bairro;
	private $cidade;
	private $estado;
	private $pontoReferencia;
	private $chave;
	private $ativo;
	
	private $senhaAtual;


	/*
	 * Getters e Setters
	 */
	function getCliente($codigo)
	{
		$this->setCliente(NULL);
		$result;
		
		//RECUPERA CONEXAO BANCO DE DADOS
		TTransaction::open('my_bd_site');

		//TABELA exposition_gallery
		//$criteria	= new TCriteria;
		//$criteria->add(new TFilter('codigo', '=', $codigo));
		//$criteria->setProperty('order', 'ordem ASC');
		
		$this->setCliente(new clientes());
		$result = $this->cliente->load($codigo);
		
		return $result;
	}

	function getCodigo()
	{
		return $this->codigo;
	}

	function getPessoa()
	{
		return $this->pessoa;
	}

	function getNome()
	{
		return $this->nome;
	}

	function getNomeResponsavel()
	{
		return $this->nomeResponsavel;
	}

	function getCpf()
	{
		return $this->cpf;
	}

	function getCnpj()
	{
		return $this->cnpj;
	}

	function getInformacaoTributaria()
	{
		return $this->informacaoTributaria;
	}

	function getInscricaoEstadual()
	{
		return $this->inscricaoEstadual;
	}

	function getNascimento()
	{
		return $this->nascimento;
	}

	function getSexo()
	{
		return $this->sexo;
	}

	function getTelefone()
	{
		return $this->telefone;
	}

	function getCelular()
	{
		return $this->celular;
	}

	function getEmail()
	{
		return $this->email;
	}

	function getSenha()
	{
		return $this->senha;
	}

	function getOfertaEmail()
	{
		return $this->ofertaEmail;
	}

	function getOfertaCelular()
	{
		return $this->ofertaCelular;
	}

	function getCep()
	{
		return $this->cep;
	}

	function getEndereco()
	{
		return $this->endereco;
	}

	function getNumero()
	{
		return $this->numero;
	}

	function getComplemento()
	{
		return $this->complemento;
	}

	function getBairro()
	{
		return $this->bairro;
	}

	function getCidade()
	{
		return $this->cidade;
	}

	function getEstado()
	{
		return $this->estado;
	}

	function getPontoReferencia()
	{
		return $this->pontoReferencia;
	}
	
	function getChave()
	{
		return $this->chave;
	}

	function getAtivo()
	{
		return $this->ativo;
	}

	function setCliente($cliente)
	{
		$this->cliente = $cliente;
	}

	function setCodigo($codigo)
	{
		$this->codigo = $codigo;
	}

	function setPessoa($pessoa)
	{
		$this->pessoa = $pessoa;
	}

	function setNome($nome)
	{
		$this->nome = $nome;
	}

	function setNomeResponsavel($nomeResponsavel)
	{
		$this->nomeResponsavel = $nomeResponsavel;
	}

	function setCpf($cpf)
	{
		$this->cpf = $cpf;
	}

	function setCnpj($cnpj)
	{
		$this->cnpj = $cnpj;
	}

	function setInformacaoTributaria($informacaoTributaria)
	{
		$this->informacaoTributaria = $informacaoTributaria;
	}

	function setInscricaoEstadual($inscricaoEstadual)
	{
		$this->inscricaoEstadual = $inscricaoEstadual;
	}

	function setNascimento($nascimento)
	{
		$this->nascimento = $nascimento;
	}

	function setSexo($sexo)
	{
		$this->sexo = $sexo;
	}

	function setTelefone($telefone)
	{
		$this->telefone = $telefone;
	}

	function setCelular($celular)
	{
		$this->celular = $celular;
	}

	function setEmail($email)
	{
		$this->email = $email;
	}

	function setSenha($senha)
	{
		$this->senha = md5($senha);
	}

	function setOfertaEmail($ofertaEmail)
	{
		$this->ofertaEmail = $ofertaEmail;
	}

	function setOfertaCelular($ofertaCelular)
	{
		$this->ofertaCelular = $ofertaCelular;
	}

	function setCep($cep)
	{
		$this->cep = $cep;
	}

	function setEndereco($endereco)
	{
		$this->endereco = $endereco;
	}

	function setNumero($numero)
	{
		$this->numero = $numero;
	}

	function setComplemento($complemento)
	{
		$this->complemento = $complemento;
	}

	function setBairro($bairro)
	{
		$this->bairro = $bairro;
	}

	function setCidade($cidade)
	{
		$this->cidade = $cidade;
	}

	function setEstado($estado)
	{
		$this->estado = $estado;
	}

	function setPontoReferencia($pontoReferencia)
	{
		$this->pontoReferencia = $pontoReferencia;
	}
	
	function setChave($chave)
	{
		$this->chave = $chave;
	}

	function setAtivo($ativo)
	{
		$this->ativo = $ativo;
	}
	
	function getSenhaAtual()
	{
		return $this->senhaAtual;
	}

	function setSenhaAtual($senhaAtual)
	{
		$this->senhaAtual = md5($senhaAtual);
	}

	

	/*
	 * Método Contrutor
	 */
	public function __construct()
	{
		$this->setCliente(NULL);
	
		$this->setCodigo(NULL);
		$this->setPessoa(NULL);
		$this->setNome(NULL);
		$this->setNomeResponsavel(NULL);
		$this->setCpf(NULL);
		$this->setCnpj(NULL);
		$this->setInformacaoTributaria(NULL);
		$this->setInscricaoEstadual(NULL);
		$this->setNascimento(NULL);
		$this->setSexo(NULL);
		$this->setTelefone(NULL);
		$this->setCelular(NULL);
		$this->setEmail(NULL);
		$this->setSenha(NULL);
		$this->setOfertaEmail(NULL);
		$this->setOfertaCelular(NULL);
		$this->setCep(NULL);
		$this->setEndereco(NULL);
		$this->setNumero(NULL);
		$this->setComplemento(NULL);
		$this->setBairro(NULL);
		$this->setCidade(NULL);
		$this->setEstado(NULL);
		$this->setPontoReferencia(NULL);
		$this->setChave(NULL);
		$this->setAtivo(NULL);
	}

	
	
	/*
	 * Método salvar
	 * Cadastra/atualiza cliente
	 */
	public function salvar()
	{
		try
		{
			$this->setCliente(new clientes2);
			
			$this->cliente->pessoa					= $this->getPessoa();
			$this->cliente->nome					= $this->getNome();
			$this->cliente->nomeResponsavel			= $this->getNomeResponsavel();
			$this->cliente->cpf						= $this->getCpf();
			$this->cliente->cnpj					= $this->getCnpj();
			$this->cliente->informacaoTributaria	= $this->getInformacaoTributaria();
			$this->cliente->inscricaoEstadual		= $this->getInscricaoEstadual();
			$this->cliente->nascimento				= $this->getNascimento();
			$this->cliente->sexo					= $this->getSexo();
			$this->cliente->telefone				= $this->getTelefone();
			$this->cliente->celular					= $this->getCelular();
			$this->cliente->email					= $this->getEmail();
			$this->cliente->senha					= $this->getSenha();
			$this->cliente->ofertaEmail				= $this->getOfertaEmail();
			$this->cliente->ofertaCelular			= $this->getOfertaCelular();
			$this->cliente->cep						= $this->getCep();
			$this->cliente->endereco				= $this->getEndereco();
			$this->cliente->numero					= $this->getNumero();
			$this->cliente->complemento				= $this->getComplemento();
			$this->cliente->bairro					= $this->getBairro();
			$this->cliente->cidade					= $this->getCidade();
			$this->cliente->estado					= $this->getEstado();
			$this->cliente->pontoReferencia			= $this->getPontoReferencia();
			$this->cliente->chave					= $this->getChave();
			$this->cliente->ativo					= $this->getAtivo();
			

			//RECUPERA CONEXAO BANCO DE DADOS
			TTransaction2::open('my_bd_site');

			$result = $this->cliente->store();

			TTransaction2::close();

			return true;
		}
		catch (Exception $e)
		{
			return false;
		}
	}
	
	/*
	 * Método getClienteByChave
	 * Obtem o cliente pela chave
	 */
	public function getClienteByChave($chave)
	{
		$this->setCliente(NULL);
		$result;
		
		//RECUPERA CONEXAO BANCO DE DADOS
		TTransaction::open('my_bd_site');

		//TABELA exposition_gallery
		$criteria	= new TCriteria;
		$criteria->add(new TFilter('chave', '=', $chave));
		//$criteria->setProperty('order', 'ordem ASC');
		
		$this->setCliente( new clientes());
		$result = $this->cliente->loadCriteria($criteria);
		
		TTransaction::close();
		
		return $result;
	}
	
	/*
	 * Método ativaClienteByChave
	 * Obtem o cliente pela chave
	 */
	public function ativaClienteByChave($chave)
	{
		try
		{
			$this->setCliente(NULL);
			
			//RECUPERA CONEXAO BANCO DE DADOS
			TTransaction::open('my_bd_site');

			//TABELA exposition_gallery
			$criteria	= new TCriteria;
			$criteria->add(new TFilter('chave', '=', $chave));
			//$criteria->setProperty('order', 'ordem ASC');

			$this->setCliente( (new clientes())->loadCriteria($criteria));

			$this->cliente->ativo = true;

			$this->cliente->store();

			TTransaction::close();
			
			return true;
		}
		catch (Exception $e)
		{
			return false;
		}
	}
	
	/*
	 * Método getClienteByEmail
	 * Obtem o cliente pela chave
	 */
	public function getClienteByEmail($email)
	{
		$this->setCliente(NULL);
		$result;
		
		//RECUPERA CONEXAO BANCO DE DADOS
		TTransaction2::open('my_bd_site');

		//TABELA exposition_gallery
		$criteria	= new TCriteria;
		$criteria->add(new TFilter('email', '=', "'{$email}'"));
		//$criteria->setProperty('order', 'ordem ASC');
		
		$this->setCliente( new clientes2());
		
		$result = $this->cliente->loadCriteria($criteria);
		
		TTransaction2::close();
		
		return $result;
	}
	
	/*
	 * Método atualizar()
	 * Atualiza as informações do cliente
	 */
	public function atualizar()
	{
		try
		{
			$this->setCliente(new clientes2);
			
			$this->cliente->codigo				= $this->getCodigo();
			$this->cliente->telefone			= $this->getTelefone();
			$this->cliente->celular				= $this->getCelular();
			$this->cliente->email				= $this->getEmail();
			$this->cliente->senha				= $this->getSenha();
			$this->cliente->ofertaEmail			= $this->getOfertaEmail();
			$this->cliente->ofertaCelular		= $this->getOfertaCelular();
			$this->cliente->cep					= $this->getCep();
			$this->cliente->endereco			= $this->getEndereco();
			$this->cliente->numero				= $this->getNumero();
			$this->cliente->complemento			= $this->getComplemento();
			$this->cliente->bairro				= $this->getBairro();
			$this->cliente->cidade				= $this->getCidade();
			$this->cliente->estado				= $this->getEstado();
			$this->cliente->pontoReferencia		= $this->getPontoReferencia();			

			//RECUPERA CONEXAO BANCO DE DADOS
			TTransaction2::open('my_bd_site');

			$result = $this->cliente->store();

			TTransaction2::close();

			return true;
		}
		catch (Exception $e)
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
		if($this->getSenhaAtual() === $_SESSION['cliente']->senha)
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
			$this->setCliente(new clientes2());
			
			$this->cliente->codigo	= $_SESSION['cliente']->codigo;
			$this->cliente->senha	= $this->getSenha();
			
			//RECUPERA CONEXAO BANCO DE DADOS
			TTransaction2::open('my_bd_site');

			$result = $this->cliente->store();

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