<?php

/*	Arquivo  home.class.php
 *	Exibe 9 Produtos Aleatorios
 *	
 *	Sistema:	Doce___Bacana_Lingerie
 *	Autor:      Rogério Eduardo Pereira
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
	 *	Método construtor
	 */
	public function __construct()
	{
		$this->setCollectionProduto((new controladorProdutos())->getCollectionProduto(NULL));
	}


	/*
	 *	Método show
	 *	Exibe as informações da página
	 */
	public function show()
	{
		var_dump($this->getCollectionProduto());
	}
}
?>