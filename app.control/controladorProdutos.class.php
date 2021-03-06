<?php

/*
 * 	Arquivo  controladorProdutos.class.php
 * 	Controla os produtos;
 * 	
 * 	Sistema:	Doce___Bacana_Lingerie
 * 	Autor:      Rog�rio Eduardo Pereira
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
	
	function getCollectionProdutosCores2($categoria, $inicio)
	{		
		$this->setCollectionProduto(NULL);
		
		//RECUPERA CONEXAO BANCO DE DADOS
		TTransaction::open('my_bd_site');

		//Criterio de sele��o
		$criteria	= new TCriteria;
		if(($categoria != NULL) && ($categoria != -1))
			$criteria->add(new TFilter('categoria', '=', $categoria));
		$criteria->add(new TFilter('home', '=', 1));
		$criteria->add(new TFilter('p.codigo', '=', 'c.codigoProduto'));
		$criteria->add(new TFilter('p.categoria', '=', 'cat.codigo'));
		//Ordena��o
		if($categoria == NULL)
		{
			$criteria->setProperty('order', 'RAND()');
			$criteria->setProperty('limit', 12);
		}
		else if($categoria == -1)
		{
			$criteria->setProperty('order', 'categoria, codigoProduto');
			$criteria->setProperty('limit', $inicio.',12');
		}
		else
		{
			$criteria->setProperty('order', 'codigoProduto');
			$criteria->setProperty('limit', $inicio.',12');
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
	
	
	function getCollectionProdutoBusca($busca, $inicio)
	{		
		$busca = str_replace('+', ' ', $busca);
		
		$this->setCollectionProduto(NULL);
		
		//RECUPERA CONEXAO BANCO DE DADOS
		TTransaction::open('my_bd_site');

		//Criterio de sele��o
		$criteria	= new TCriteria;
		$criteria1	= new TCriteria;
		$criteria2	= new TCriteria;
		
		//Busca por Referencia ou descricao
		$criteria1->add(new TFilter('referencia', 'LIKE', '%'.$busca.'%'), TExpression::OR_OPERATOR);
		$criteria1->add(new TFilter('descricao', 'LIKE', '%'.$busca.'%'),  TExpression::OR_OPERATOR);
				
		//Outras campos do criterio de sele��o
		$criteria2->add(new TFilter('home', '=', 1));
		$criteria2->add(new TFilter('p.codigo', '=', 'c.codigoProduto'));
		$criteria2->add(new TFilter('p.categoria', '=', 'cat.codigo'));
		
		$criteria->add($criteria1, TExpression::AND_OPERATOR);
		$criteria->add($criteria2, TExpression::AND_OPERATOR);
		//Ordena��o
		$criteria->setProperty('order', 'categoria, codigoProduto');
		$criteria->setProperty('limit', $inicio.',12');
		
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

		//Criterio de sele��o
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
	
	function getProduto2($codigo)
	{
		$this->setProduto(NULL);
		
		//RECUPERA CONEXAO BANCO DE DADOS
		TTransaction2::open('my_bd_site');

		//Criterio de sele��o
		$criteria	= new TCriteria;
		$criteria->add(new TFilter('codigo', '=', $codigo));
		
		$this->repository = new TRepository2();
		
		$this->repository->addColumn('*');
		$this->repository->addEntity('produtos');
		
		$this->setProduto($this->repository->load($criteria));
		
		TTransaction2::close();
		
		return $this->produto[0];
	}

	function setProduto($produto)
	{
		$this->produto = $produto;
	}
	
	function getCollectionProduto($categoria, $inicio)
	{
		$this->setCollectionProduto(NULL);
		
		//RECUPERA CONEXAO BANCO DE DADOS
		TTransaction::open('my_bd_site');

		//TABELA exposition_gallery
		$criteria	= new TCriteria;
		if(($categoria != NULL) && ($categoria != -1))
			$criteria->add(new TFilter('categoria', '=', $categoria));		
		$criteria->add(new TFilter('home', '=', 1));
		$criteria->add(new TFilter('p.codigo', '=', 'c.codigoProduto'));
		$criteria->add(new TFilter('p.categoria', '=', 'cat.codigo'));
		
		$criteria->setProperty('order', 'categoria, codigoProduto');
		if(($categoria != NULL) && ($categoria == -1))
			$criteria->setProperty('limit', $inicio.',12');
		else
		{
			$criteria->setProperty('limit', '12');
			$criteria->setProperty('order', 'rand()');
		}
				
		
		$this->repository = new TRepository();
		
		$this->repository = new TRepository();
		
		$this->repository->addColumn('DISTINCT p.codigo as codProd');
		$this->repository->addColumn('p.referencia');
		$this->repository->addColumn('c.codigo as codCor');
		$this->repository->addColumn('cat.nome as categoria');
		$this->repository->addEntity('produtos p');
		$this->repository->addEntity('produtoscores c');
		$this->repository->addEntity('categorias cat');
		
		$this->setCollectionCores($this->repository->load($criteria));
		
		TTransaction::close();
		
		return $this->collectionCores;
	}
		
	function getCollectionCores($codigo)
	{
		$this->setCollectionCores(NULL);
		
		//RECUPERA CONEXAO BANCO DE DADOS
		TTransaction::open('my_bd_site');

		//TABELA exposition_gallery
		$criteria	= new TCriteria;
		$criteria->add(new TFilter('p.codigoProduto', '=', $codigo));
		$criteria->add(new TFilter('p.codigoCoresDefinidas', '=', 'c.codigo'));
		$criteria->setProperty('order', 'nome');
		
		$this->repository = new TRepository();
		
		$this->repository->addColumn('p.codigo as codigo');
		$this->repository->addColumn('p.codigoProduto as codigoProduto');
		$this->repository->addColumn('p.codigoProduto as codigoProduto');
		$this->repository->addColumn('p.banner1 as banner1');
		$this->repository->addColumn('p.banner2 as banner2');
		$this->repository->addColumn('p.banner3 as banner3');
		$this->repository->addColumn('p.home as home');
		$this->repository->addColumn('p.codigoCoresDefinidas as codigoCoresDefinidas');
		$this->repository->addColumn('c.nome as nome');
		$this->repository->addColumn('c.cor1 as cor1');
		$this->repository->addColumn('c.cor2 as cor2');
		$this->repository->addEntity('produtoscores p');
		$this->repository->addEntity('cores c');
		
		$this->setCollectionCores($this->repository->load($criteria));
		
		TTransaction::close();
		
		return $this->collectionCores;
	}
	
	function getCollectionCores2($codigo)
	{
		$this->setCollectionCores(NULL);
		
		//RECUPERA CONEXAO BANCO DE DADOS
		TTransaction2::open('my_bd_site');

		//TABELA exposition_gallery
		$criteria	= new TCriteria;
		$criteria->add(new TFilter('p.codigoProduto', '=', $codigo));
		$criteria->add(new TFilter('p.codigoCoresDefinidas', '=', 'c.codigo'));
		$criteria->setProperty('order', 'nome');
		
		$this->repository = new TRepository2();
		
		$this->repository->addColumn('p.codigo as codigo');
		$this->repository->addColumn('p.codigoProduto as codigoProduto');
		$this->repository->addColumn('p.codigoProduto as codigoProduto');
		$this->repository->addColumn('p.banner1 as banner1');
		$this->repository->addColumn('p.banner2 as banner2');
		$this->repository->addColumn('p.banner3 as banner3');
		$this->repository->addColumn('p.home as home');
		$this->repository->addColumn('p.codigoCoresDefinidas as codigoCoresDefinidas');
		$this->repository->addColumn('c.nome as nome');
		$this->repository->addColumn('c.cor1 as cor1');
		$this->repository->addColumn('c.cor2 as cor2');
		$this->repository->addEntity('produtoscores p');
		$this->repository->addEntity('cores c');
		
		$this->setCollectionCores($this->repository->load($criteria));
		
		TTransaction2::close();
		
		return $this->collectionCores;
	}

	function setCollectionCores($collectionCores)
	{
		$this->collectionCores = $collectionCores;
	}

		
	
	/*
	 * M�todo Contrutor
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
	 * M�todo getTotal
	 * Obtem o total de itens cadastrados
	 */
	public function getTotal($categoria)
	{
		$total = 0;
		$result;
		
		//RECUPERA CONEXAO BANCO DE DADOS
		TTransaction::open('my_bd_site');

		//Criterio de sele��o
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
	
	/*
	 * M�todo getTotalBusca
	 * Obtem o total de itens da busca
	 */
	function getTotalBusca($busca)
	{
		$total = 0;
		$result;
		
		//RECUPERA CONEXAO BANCO DE DADOS
		TTransaction::open('my_bd_site');

		//Criterio de sele��o
		$criteria	= new TCriteria;
		$criteria1	= new TCriteria;
		$criteria2	= new TCriteria;
		
		//Busca por Referencia ou descricao
		$criteria1->add(new TFilter('referencia', 'LIKE', '%'.$busca.'%'), TExpression::OR_OPERATOR);
		$criteria1->add(new TFilter('descricao', 'LIKE', '%'.$busca.'%'),  TExpression::OR_OPERATOR);
				
		//Outras campos do criterio de sele��o
		$criteria2->add(new TFilter('home', '=', 1));
		$criteria2->add(new TFilter('p.codigo', '=', 'c.codigoProduto'));
		$criteria2->add(new TFilter('p.categoria', '=', 'cat.codigo'));
		
		$criteria->add($criteria1, TExpression::AND_OPERATOR);
		$criteria->add($criteria2, TExpression::AND_OPERATOR);
		
		$this->repository = new TRepository();
		
		$this->repository->addColumn('count(*) as total');
		$this->repository->addEntity('produtos p');
		$this->repository->addEntity('produtoscores c');
		$this->repository->addEntity('categorias cat');
		
		$result = $this->repository->load($criteria);
		$total = $result[0]->total;
		
		TTransaction::close();
		
		return $total;
	}
}

?>