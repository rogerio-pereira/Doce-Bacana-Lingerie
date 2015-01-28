<?php

/*
 * 	Arquivo  controladorProdutos.class.php
 * 	#DESCRIÇÂO#
 * 	
 * 	Sistema:	Doce___Bacana_Lingerie
 * 	Autor:      Rogério Eduardo Pereira
 * 	Data:       28/01/2015
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
	private $collectionProdutos;
	private $produto;
	
	private $codigoProd;
	private $referencia;
	private $categoria;
	private $caracteristicas;
	private $tamanhoPP;
	private $tamanhoP;
	private $tamanhoM;
	private $tamanhoG;
	private $tamanhoGG;
	private $tamanho48;
	private $tamanho50;
	private $tamanho52;
	private $tamanho54;
	
	private $collectionProdutosCores;
	private $produtoCor;
	
	private $codigoProdCor;
	private $codigoProduto;
	private $cor1;
	private $cor2;
	private $banner1;
	private $banner2;
	private $banner3;
	private $home;


	/*
	 * Getters e Setters
	 */
	function getRepository()
	{
		return $this->repository;
	}

	function getCollectionProdutos()
	{
		$this->setCollectionProdutos(NULL);
		
		//RECUPERA CONEXAO BANCO DE DADOS
		TTransaction::open('my_bd_site');

		//TABELA exposition_gallery
		$criteria	= new TCriteria;
		$criteria->add(new TFilter('p.categoria', '=', 'c.codigo'));
		$criteria->setProperty('order', 'referencia');
		
		$this->repository = new TRepository();
		
		$this->repository->addColumn('*');
		$this->repository->addEntity('produtos p');
		$this->repository->addEntity('categorias c');
		
		$this->setCollectionProdutos($this->repository->load($criteria));
		
		TTransaction::close();
		
		return $this->collectionProdutos;
	}

	function getProduto($codigo)
	{
		$this->setProduto(NULL);
		$result;
		
		//RECUPERA CONEXAO BANCO DE DADOS
		TTransaction::open('my_bd_site');

		//TABELA exposition_gallery
		//$criteria	= new TCriteria;
		//$criteria->add(new TFilter('codigo', '=', $codigo));
		//$criteria->setProperty('order', 'ordem ASC');
		
		$this->setProduto(new produtosModel());
		$result = $this->produto->load($codigo);
		
		return $result;
	}

	function getCodigoProd()
	{
		return $this->codigoProd;
	}

	function getReferencia()
	{
		return $this->referencia;
	}

	function getCategoria()
	{
		return $this->categoria;
	}

	function getCaracteristicas()
	{
		return $this->caracteristicas;
	}

	function getTamanhoPP()
	{
		return $this->tamanhoPP;
	}

	function getTamanhoP()
	{
		return $this->tamanhoP;
	}

	function getTamanhoM()
	{
		return $this->tamanhoM;
	}

	function getTamanhoG()
	{
		return $this->tamanhoG;
	}

	function getTamanhoGG()
	{
		return $this->tamanhoGG;
	}

	function getTamanho48()
	{
		return $this->tamanho48;
	}

	function getTamanho50()
	{
		return $this->tamanho50;
	}

	function getTamanho52()
	{
		return $this->tamanho52;
	}

	function getTamanho54()
	{
		return $this->tamanho54;
	}

	function getCollectionProdutosCores()
	{
		return $this->collectionProdutosCores;
	}

	function getProdutoCor()
	{
		return $this->produtoCor;
	}

	function getCodigoProdCor()
	{
		return $this->codigoProdCor;
	}

	function getCodigoProduto()
	{
		return $this->codigoProduto;
	}

	function getCor1()
	{
		return $this->cor1;
	}

	function getCor2()
	{
		return $this->cor2;
	}

	function getBanner1()
	{
		return $this->banner1;
	}

	function getBanner2()
	{
		return $this->banner2;
	}

	function getBanner3()
	{
		return $this->banner3;
	}

	function getHome()
	{
		return $this->home;
	}

	function setRepository($repository)
	{
		$this->repository = $repository;
	}

	function setCollectionProdutos($collectionProdutos)
	{
		$this->collectionProdutos = $collectionProdutos;
	}

	function setProduto($produto)
	{
		$this->produto = $produto;
	}

	function setCodigoProd($codigoProd)
	{
		$this->codigoProd = $codigoProd;
	}

	function setReferencia($referencia)
	{
		$this->referencia = $referencia;
	}

	function setCategoria($categoria)
	{
		$this->categoria = $categoria;
	}

	function setCaracteristicas($caracteristicas)
	{
		$this->caracteristicas = $caracteristicas;
	}

	function setTamanhoPP($tamanhoPP)
	{
		$this->tamanhoPP = $tamanhoPP;
	}

	function setTamanhoP($tamanhoP)
	{
		$this->tamanhoP = $tamanhoP;
	}

	function setTamanhoM($tamanhoM)
	{
		$this->tamanhoM = $tamanhoM;
	}

	function setTamanhoG($tamanhoG)
	{
		$this->tamanhoG = $tamanhoG;
	}

	function setTamanhoGG($tamanhoGG)
	{
		$this->tamanhoGG = $tamanhoGG;
	}

	function setTamanho48($tamanho48)
	{
		$this->tamanho48 = $tamanho48;
	}

	function setTamanho50($tamanho50)
	{
		$this->tamanho50 = $tamanho50;
	}

	function setTamanho52($tamanho52)
	{
		$this->tamanho52 = $tamanho52;
	}

	function setTamanho54($tamanho54)
	{
		$this->tamanho54 = $tamanho54;
	}

	function setCollectionProdutosCores($collectionProdutosCores)
	{
		$this->collectionProdutosCores = $collectionProdutosCores;
	}

	function setProdutoCor($produtoCor)
	{
		$this->produtoCor = $produtoCor;
	}

	function setCodigoProdCor($codigoProdCor)
	{
		$this->codigoProdCor = $codigoProdCor;
	}

	function setCodigoProduto($codigoProduto)
	{
		$this->codigoProduto = $codigoProduto;
	}

	function setCor1($cor1)
	{
		$this->cor1 = $cor1;
	}

	function setCor2($cor2)
	{
		$this->cor2 = $cor2;
	}

	function setBanner1($banner1)
	{
		$this->banner1 = $banner1;
	}

	function setBanner2($banner2)
	{
		$this->banner2 = $banner2;
	}

	function setBanner3($banner3)
	{
		$this->banner3 = $banner3;
	}

	function setHome($home)
	{
		$this->home = $home;
	}

	
	
	/*
	 * Método Contrutor
	 */
	public function __construct()
	{
		$this->setRepository(NULL);
		$this->setCollectionProdutos(NULL);
		$this->setProduto(NULL);
		$this->setCodigoProd(NULL);
		$this->setReferencia(NULL);
		$this->setCategoria(NULL);
		$this->setCaracteristicas(NULL);
		$this->setTamanhoPP(NULL);
		$this->setTamanhoP(NULL);
		$this->setTamanhoM(NULL);
		$this->setTamanhoG(NULL);
		$this->setTamanhoGG(NULL);
		$this->setTamanho48(NULL);
		$this->setTamanho50(NULL);
		$this->setTamanho52(NULL);
		$this->setTamanho54(NULL);
		$this->setCollectionProdutosCores(NULL);
		$this->setProdutoCor(NULL);
		$this->setCodigoProdCor(NULL);
		$this->setCodigoProduto(NULL);
		$this->setCor1(NULL);
		$this->setCor2(NULL);
		$this->setBanner1(NULL);
		$this->setBanner2(NULL);
		$this->setBanner3(NULL);
		$this->setHome(NULL);
		
	}

}

?>