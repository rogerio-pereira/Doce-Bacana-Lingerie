<?php

/*
 * 	Arquivo  controladorProdutos.class.php
 * 	Controla os produtos;
 * 	
 * 	Sistema:	Doce___Bacana_Lingerie
 * 	Autor:      Rogщrio Eduardo Pereira
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
	private $produto;
	private $collectionCores;


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

		//Criterio de seleчуo
		$criteria	= new TCriteria;
		if(($categoria != NULL) && ($categoria != -1))
			$criteria->add(new TFilter('categoria', '=', $categoria));
		$criteria->add(new TFilter('home', '=', 1));
		$criteria->add(new TFilter('p.codigo', '=', 'c.codigoProduto'));
		$criteria->add(new TFilter('p.categoria', '=', 'cat.codigo'));
		//Ordenaчуo
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
	
	function getCollectionProdutoBusca($busca)
	{		
		$this->setCollectionProduto(NULL);
		
		//RECUPERA CONEXAO BANCO DE DADOS
		TTransaction::open('my_bd_site');

		//Criterio de seleчуo
		$criteria	= new TCriteria;
		
		
		//Busca por Referencia ou descricao
		$criteria->add(new TFilter('categoria', '=', $categoria));
				
				
				
		$criteria->add(new TFilter('home', '=', 1));
		$criteria->add(new TFilter('p.codigo', '=', 'c.codigoProduto'));
		$criteria->add(new TFilter('p.categoria', '=', 'cat.codigo'));
		//Ordenaчуo
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

	function getProduto($codigo)
	{
		$this->setProduto(NULL);
		
		//RECUPERA CONEXAO BANCO DE DADOS
		TTransaction::open('my_bd_site');

		//Criterio de seleчуo
		$criteria	= new TCriteria;
		$criteria->add(new TFilter('p.codigo', '=', $codigo));
		$criteria->add(new TFilter('p.categoria', '=', 'cat.codigo'));
		
		$this->repository = new TRepository();
		
		$this->repository->addColumn('p.codigo as codigoProduto');
		$this->repository->addColumn('p.referencia as referencia');
		$this->repository->addColumn('cat.nome as categoria');
		$this->repository->addColumn('p.descricao as descricao');
		$this->repository->addColumn('p.caracteristicas as caracteristicas');
		$this->repository->addColumn('p.tamanhoPP as tamanhoPP');
		$this->repository->addColumn('p.tamanhoP as tamanhoP');
		$this->repository->addColumn('p.tamanhoM as tamanhoM');
		$this->repository->addColumn('p.tamanhoG as tamanhoG');
		$this->repository->addColumn('p.tamanhoGG as tamanhoGG');
		$this->repository->addColumn('p.tamanho48 as tamanho48');
		$this->repository->addColumn('p.tamanho50 as tamanho50');
		$this->repository->addColumn('p.tamanho52 as tamanho52');
		$this->repository->addColumn('p.tamanho54 as tamanho54');
		$this->repository->addEntity('produtos p');
		$this->repository->addEntity('categorias cat');
		
		$this->setProduto($this->repository->load($criteria));
		
		TTransaction::close();
		
		return $this->produto[0];
	}

	function setProduto($produto)
	{
		$this->produto = $produto;
	}
		
	function getCollectionCores($codigo)
	{
		$this->setCollectionCores(NULL);
		
		//RECUPERA CONEXAO BANCO DE DADOS
		TTransaction::open('my_bd_site');

		//TABELA exposition_gallery
		$criteria	= new TCriteria;
		$criteria->add(new TFilter('codigoProduto', '=', $codigo));
		$criteria->setProperty('order', 'nome');
		
		$this->repository = new TRepository();
		
		$this->repository->addColumn('*');
		$this->repository->addEntity('produtoscores');
		
		$this->setCollectionCores($this->repository->load($criteria));
		
		TTransaction::close();
		
		return $this->collectionCores;
	}

	function setCollectionCores($collectionCores)
	{
		$this->collectionCores = $collectionCores;
	}

		
	
	/*
	 * Mщtodo Contrutor
	 */
	public function __construct()
	{
		$this->setRepository(NULL);
		$this->setCollectionProduto(NULL);
		$this->setCollectionBanner(NULL);
		$this->setProduto(NULL);
		$this->setCollectionCores(NULL);
	}
	
	/*
	 * Mщtodo getTotal
	 * Obtem o total de itens cadastrados
	 */
	public function getTotal($categoria)
	{
		$total = 0;
		$result;
		
		//RECUPERA CONEXAO BANCO DE DADOS
		TTransaction::open('my_bd_site');

		//Criterio de seleчуo
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