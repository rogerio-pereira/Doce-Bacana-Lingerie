<?php

/*
 * 	Arquivo  controladorClientes.class.php
 * 	#DESCRIÇÂO#
 * 	
 * 	Sistema:	Doce___Bacana_Lingerie
 * 	Autor:      Rogério Eduardo Pereira
 * 	Data:       12/02/2015
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
	private $collectionClientes;
	
	private $codigo;
	private $senha;


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
		
		$this->setCliente(new clientesModel());
		$result = $this->cliente->load($codigo);
		
		return $result;
	}

	function setCliente($cliente)
	{
		$this->cliente = $cliente;
	}
	
	function getCollectionClientes()
	{
		$this->setCollectionClientes(NULL);
		
		//RECUPERA CONEXAO BANCO DE DADOS
		TTransaction::open('my_bd_site');

		//TABELA exposition_gallery
		$criteria	= new TCriteria;
		//$criteria->add(new TFilter('situacao', '=', $situacao));
		$criteria->setProperty('order', 'nome');
		
		$this->repository = new TRepository();
		
		$this->repository->addColumn('*');
		$this->repository->addEntity('clientes');
		
		$this->setCollectionClientes($this->repository->load($criteria));
		
		TTransaction::close();
		
		return $this->collectionClientes;
	}

	function setCollectionClientes($collectionClientes)
	{
		$this->collectionClientes = $collectionClientes;
	}
	
	function getCodigo()
	{
		return $this->codigo;
	}

	function getSenha()
	{
		return $this->senha;
	}

	function setCodigo($codigo)
	{
		$this->codigo = $codigo;
	}

	function setSenha($senha)
	{
		$this->senha = md5($senha);
	}

		
	/*
	 * Método Contrutor
	 */
	public function __construct()
	{
		$this->setCliente(NULL);
		$this->setCollectionClientes(NULL);
	}

	/*
	 * Método altera senha
	 * Altera a senha do usuario ativo
	 */
	public function alteraSenha()
	{
		try
		{
			$this->setCliente(new clientesModel2);
			
			$this->cliente->codigo	= $this->getCodigo();
			$this->cliente->senha	= $this->getSenha();

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
}

?>