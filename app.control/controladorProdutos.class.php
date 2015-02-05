<?php

/*
 * 	Arquivo  controladorProdutos.class.php
 * 	Controla os produtos;
 * 	
 * 	Sistema:	Doce___Bacana_Lingerie
 * 	Autor:      Rogйrio Eduardo Pereira
 * 	Data:       03/02/2015
 */

/*
 * Classe controladorProdutos.class.php
 */
class controladorProdutos
{
	/*
	 * Variaveis
	 */
	private $repository;
	private $collectionBanner;
	private $collectionProduto;


	/*
	 * Getters e Setters
	 */
	function getRepository()
	{
		return $this->repository;
	}

	function getCollectionBanner($banner)
	{
		$this->setCollectionBanner(NULL);
		
		//RECUPERA CONEXAO BANCO DE DADOS
		TTransaction::open('my_bd_site');

		//TABELA exposition_gallery
		$criteria	= new TCriteria;
		$criteria->add(new TFilter('banner'.$banner, '=', 1));
		$criteria->setProperty('order', 'RAND()');
		$criteria->setProperty('limit', 5);
		
		$this->repository = new TRepository();
		
		$this->repository->addColumn('codigo');
		$this->repository->addColumn('codigoProduto');
		$this->repository->addEntity('produtoscores');
		
		$this->setCollectionBanner($this->repository->load($criteria));
		
		TTransaction::close();
		
		return $this->collectionBanner;
	}

	function setRepository($repository)
	{
		$this->repository = $repository;
	}

	function setCollectionBanner($collectionBanner)
	{
		$this->collectionBanner = $collectionBanner;
	}
	
	function getCollectionProduto($categoria, $inicio)
	{		
		$this->setCollectionProduto(NULL);
		
		//RECUPERA CONEXAO BANCO DE DADOS
		TTransaction::open('my_bd_site');

		//Criterio de seleзгo
		$criteria	= new TCriteria;
		if(($categoria != NULL) && ($categoria != -1))
			$criteria->add(new TFilter('categoria', '=', $categoria));
		$criteria->add(new TFilter('home', '=', 1));
		$criteria->add(new TFilter('p.codigo', '=', 'c.codigoProduto'));
		$criteria->add(new TFilter('p.categoria', '=', 'cat.codigo'));
		//Ordenaзгo
		if($categoria == NULL)
		{
			$criteria->setProperty('order', 'RAND()');
			$criteria->setProperty('limit', 9);
		}
		else if($categoria == -1)
		{
			$criteria->setProperty('order', 'categoria, codigoProduto');
			$criteria->setProperty('limit', $inicio.',9');
		}
		else
		{
			$criteria->setProperty('order', 'codigoProduto');
			$criteria->setProperty('limit', $inicio.',9');
		}
		
		$this->repository = new TRepository();
		
		$this->repository->addColumn('DISTINCT p.codigo as codProd');
		$this->repository->addColumn('p.referencia');
		$this->repository->addColumn('c.codigo as codCor');
		$this->repository->addColumn('cat.nome as categoria');
		$this->repository->addEntity('produtos p');
		$this->repository->addEntity('produtoscores c');
		$this->repository->addEntity('categorias cat');
		
		$this->setCollectionProduto($this->repository->load($criteria));
		
		TTransaction::close();
		
		return $this->collectionProduto;
	}

	function setCollectionProduto($collectionProduto)
	{
		$this->collectionProduto = $collectionProduto;
	}

	
	
	
	/*
	 * Mйtodo Contrutor
	 */
	public function __construct()
	{
		$this->setRepository(NULL);
		$this->setCollectionProduto(NULL);
		$this->setCollectionBanner(NULL);
	}
	
	/*
	 * Mйtodo getTotal
	 * Obtem o total de itens cadastrados
	 */
	public function getTotal($categoria)
	{
		$total = 0;
		$result;
		
		//RECUPERA CONEXAO BANCO DE DADOS
		TTransaction::open('my_bd_site');

		//Criterio de seleзгo
		$criteria	= new TCriteria;
		if(($categoria != NULL) && ($categoria != -1))
			$criteria->add(new TFilter('categoria', '=', $categoria));		
		$criteria->add(new TFilter('home', '=', 1));
		$criteria->add(new TFilter('p.codigo', '=', 'c.codigoProduto'));
				
		$this->repository = new TRepository();
		
		$this->repository->addColumn('count(*) as total');
		$this->repository->addEntity('produtos p');
		$this->repository->addEntity('produtoscores c');
		
		$result = $this->repository->load($criteria);
		$total = $result[0]->total;
		
		TTransaction::close();
		
		return $total;
	}
}

?>