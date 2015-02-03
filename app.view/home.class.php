<?php

/*	Arquivo  home.class.php
 *	Exibe 9 Produtos Aleatorios
 *	
 *	Sistema:	Doce___Bacana_Lingerie
 *	Autor:      Rog�rio Eduardo Pereira
 *	Data:       03/02/2015
 */
class home
{
	/*
	 *	Variaveis
	 */
	private $collectionProduto;
	
	/*
	 * Getters e Setters
	 */
	function getCollectionProduto()
	{
		return $this->collectionProduto;
	}

	function setCollectionProduto($collectionProduto)
	{
		$this->collectionProduto = $collectionProduto;
	}

		
	/*
	 *	M�todo construtor
	 */
	public function __construct()
	{
		$this->setCollectionProduto((new controladorProdutos())->getCollectionProduto(NULL));
	}


	/*
	 *	M�todo show
	 *	Exibe as informa��es da p�gina
	 */
	public function show()
	{
		var_dump($this->getCollectionProduto());
	}
}
?>