<?php

/*
 * 	Arquivo  controladorCategoria.class.php
 * 	#DESCRIÇÂO#
 * 	
 * 	Sistema:	Doce___Bacana_Lingerie
 * 	Autor:      Rogério Eduardo Pereira
 * 	Data:       15/01/2015
 */

/*
 * Classe controladorCategoria.class.php
 */
class controladorCategoria
{
	/*
	 * Variaveis
	 */
	private $repository;
	private $collectionCategoria;
	private $categoria;
	private $codigo;
	private $nome;


	/*
	 * Getters e Setters
	 */
	function getRepository()
	{
		return $this->repository;
	}

	function setRepository($repository)
	{
		$this->repository = $repository;
	}

	function getCollectionCategoria()
	{
		$this->setCollectionCategoria(NULL);
		
		//RECUPERA CONEXAO BANCO DE DADOS
		TTransaction::open('my_bd_site');

		//TABELA exposition_gallery
		$criteria	= new TCriteria;
		//$criteria->add(new TFilter('situacao', '=', $situacao));
		$criteria->setProperty('order', 'nome');
		
		$this->repository = new TRepository();
		
		$this->repository->addColumn('*');
		$this->repository->addEntity('categorias');
		
		$this->setCollectionCategoria($this->repository->load($criteria));
		
		TTransaction::close();
		
		return $this->collectionCategoria;
	}
	
	function getCollectionCategoria2()
	{
		$this->setCollectionCategoria(NULL);
		
		//RECUPERA CONEXAO BANCO DE DADOS
		TTransaction2::open('my_bd_site');

		//TABELA exposition_gallery
		$criteria	= new TCriteria;
		//$criteria->add(new TFilter('situacao', '=', $situacao));
		$criteria->setProperty('order', 'nome');
		$this->repository = new TRepository2();
		
		$this->repository->addColumn('*');
		
		$this->repository->addEntity('categorias');
		
		$this->setCollectionCategoria($this->repository->load($criteria));
		
		TTransaction2::close();
		
		return $this->collectionCategoria;
	}

	function getCategoria($codigo)
	{
		$this->setCategoria(NULL);
		$result;
		
		//RECUPERA CONEXAO BANCO DE DADOS
		TTransaction::open('my_bd_site');

		//TABELA exposition_gallery
		//$criteria	= new TCriteria;
		//$criteria->add(new TFilter('codigo', '=', $codigo));
		//$criteria->setProperty('order', 'ordem ASC');
		
		$this->setCategoria(new categoriasModel());
		$result = $this->categoria->load($codigo);
		
		return $result;
	}

	function setCollectionCategoria($collectionCategoria)
	{
		$this->collectionCategoria = $collectionCategoria;
	}

	function setCategoria($categoria)
	{
		$this->categoria = $categoria;
	}
	function getCodigo()
	{
		return $this->codigo;
	}

	function getNome()
	{
		return $this->nome;
	}

	function setCodigo($codigo)
	{
		$this->codigo = $codigo;
	}

	function setNome($nome)
	{
		$this->nome = $nome;
	}

	
	

	/*
	 * Método Contrutor
	 */
	public function __construct()
	{
		$this->setRepository(NULL);
		$this->setCategoria(NULL);
		$this->setCollectionCategoria(NULL);
		$this->setCodigo(NULL);
		$this->setNome(NULL);
	}

	/*
	 * Método salva
	 * Salva/Altera a categoria
	 */
	public function salva()
	{
		try
		{
			$this->setCategoria(new categoriasModel2());
			
			$this->categoria->codigo	= $this->getCodigo();
			$this->categoria->nome		= $this->getNome();
			
			//RECUPERA CONEXAO BANCO DE DADOS
			TTransaction2::open('my_bd_site');
			
			$result = $this->categoria->store();

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
	 *	Apaga as categorias com o codigo especifico;
	 *	Usado em IFRAME
	 */
	public function apaga2($codigo)
	{
		try
		{
			$this->setCategoria(new categoriasModel2());

			//RECUPERA CONEXAO BANCO DE DADOS
			TTransaction2::open('my_bd_site');

			$this->categoria->delete($codigo);

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