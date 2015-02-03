<?php

/*
 * 	Arquivo  controladorProdutos.class.php
 * 	Controla os produtos;
 * 	
 * 	Sistema:	Doce___Bacana_Lingerie
 * 	Autor:      Rogério Eduardo Pereira
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

	
	
	/*
	 * Método Contrutor
	 */
	public function __construct()
	{
		$this->setRepository(NULL);
		$this->setCollectionBanner(NULL);
	}
	
}

?>