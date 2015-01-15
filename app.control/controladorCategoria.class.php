<?php

/*
 * 	Arquivo  controladorCategoria.class.php
 * 	#DESCRI��O#
 * 	
 * 	Sistema:	Doce___Bacana_Lingerie
 * 	Autor:      Rog�rio Eduardo Pereira
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

	function getCategoria()
	{
		return $this->categoria;
	}

	function setCollectionCategoria($collectionCategoria)
	{
		$this->collectionCategoria = $collectionCategoria;
	}

	function setCategoria($categoria)
	{
		$this->categoria = $categoria;
	}

	

	/*
	 * M�todo Contrutor
	 */
	public function __construct()
	{
		$this->setRepository(NULL);
		$this->setCategoria(NULL);
		$this->setCollectionCategoria(NULL);
	}

}

?>