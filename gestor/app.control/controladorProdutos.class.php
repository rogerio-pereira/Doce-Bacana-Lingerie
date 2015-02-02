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
class controladorProdutos extends controladorUpload
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
	private $descricao;
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
	private $nome;
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
		
		$this->repository->addColumn('p.codigo as codigo');
		$this->repository->addColumn('p.referencia as referencia');
		$this->repository->addColumn('c.nome as nome');
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

	function getCollectionProdutosCores($codigo)
	{
		$this->setCollectionProdutosCores(NULL);
		
		//RECUPERA CONEXAO BANCO DE DADOS
		TTransaction::open('my_bd_site');

		//TABELA exposition_gallery
		$criteria	= new TCriteria;
		$criteria->add(new TFilter('codigoProduto', '=', $codigo));
		$criteria->setProperty('order', 'nome');
		
		$this->repository = new TRepository();
		
		$this->repository->addColumn('*');
		$this->repository->addEntity('produtoscores');
		
		$this->setCollectionProdutosCores($this->repository->load($criteria));
		
		TTransaction::close();
		
		return $this->collectionProdutosCores;
	}
	
	function getCollectionProdutosCores2($codigo)
	{
		$this->setCollectionProdutosCores(NULL);
		
		//RECUPERA CONEXAO BANCO DE DADOS
		TTransaction2::open('my_bd_site');
		

		//TABELA exposition_gallery
		$criteria	= new TCriteria;
		$criteria->add(new TFilter('codigoProduto', '=', $codigo));
		$criteria->setProperty('order', 'nome');
		
		
		$this->repository = new TRepository2();
		
		$this->repository->addColumn('*');
		$this->repository->addEntity('produtoscores');
		
		$this->setCollectionProdutosCores($this->repository->load($criteria));
		
		TTransaction2::close();
		
		return $this->collectionProdutosCores;
	}
	
	function getVariableCollectionProdutosCores()
	{
		return $this->collectionProdutosCores;
	}
	
	function addCor($cor)
	{
		$this->collectionProdutosCores[] = $cor;
	}

	function getProdutoCor($codigo)
	{
		$this->setProdutoCor(NULL);
		$result;
		
		//RECUPERA CONEXAO BANCO DE DADOS
		TTransaction2::open('my_bd_site');

		//TABELA exposition_gallery
		//$criteria	= new TCriteria;
		//$criteria->add(new TFilter('codigo', '=', $codigo));
		//$criteria->setProperty('order', 'ordem ASC');
		
		$this->setProdutoCor(new produtoscoresModel2());
				
		$result = $this->produtoCor->load($codigo);
				
		return $result;
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
	function getDescricao()
	{
		return $this->descricao;
	}

	function setDescricao($descricao)
	{
		$this->descricao = $descricao;
	}

	function getNome()
	{
		return $this->nome;
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
		$this->setCollectionProdutos(NULL);
		$this->setProduto(NULL);
		$this->setCodigoProd(NULL);
		$this->setReferencia(NULL);
		$this->setCategoria(NULL);
		$this->setDescricao(NULL);
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

	/*
	 * Método salvaProduto
	 * Salva o Produto
	 */
	public function salvaProduto()
	{
		try
		{
			$this->setProduto(new produtosModel2());
			
			
			$this->produto->codigo			= $this->getCodigoProd();
			$this->produto->referencia		= $this->getReferencia();
			$this->produto->categoria		= $this->getCategoria();
			$this->produto->descricao		= $this->getDescricao();
			$this->produto->caracteristicas	= $this->getCaracteristicas();
			$this->produto->tamanhoPP		= $this->getTamanhoPP();
			$this->produto->tamanhoP		= $this->getTamanhoP();
			$this->produto->tamanhoM		= $this->getTamanhoM();
			$this->produto->tamanhoG		= $this->getTamanhoG();
			$this->produto->tamanhoGG		= $this->getTamanhoGG();
			$this->produto->tamanho48		= $this->getTamanho48();
			$this->produto->tamanho50		= $this->getTamanho50();
			$this->produto->tamanho52		= $this->getTamanho52();
			$this->produto->tamanho54		= $this->getTamanho54();
			
			
			//RECUPERA CONEXAO BANCO DE DADOS
			TTransaction2::open('my_bd_site');
			
			$result = $this->produto->store();

			TTransaction2::close();

			return true;
		}
		catch(Exception $e)
		{
			return false;
		}
	}
	
	/*
	 * Método salvaCores
	 * Salva cada cor
	 */
	public function salvaCor()
	{
		try
		{	
			$this->setProdutoCor(new produtoscoresModel2());
			
			$this->produtoCor->codigoProduto	= $this->getCodigoProduto();
			$this->produtoCor->nome				= $this->getNome();
			$this->produtoCor->cor1				= $this->getCor1();
			$this->produtoCor->cor2				= $this->getCor2();
			$this->produtoCor->banner1			= $this->getBanner1();
			$this->produtoCor->banner2			= $this->getBanner2();
			$this->produtoCor->banner3			= $this->getBanner3();
			$this->produtoCor->home				= $this->getHome();
			
			//RECUPERA CONEXAO BANCO DE DADOS
			TTransaction2::open('my_bd_site');

			$result = $this->produtoCor->store();

			TTransaction2::close();
			return true;
		} 
		catch (Exception $ex)
		{
			return false;
		}
	}
	
	/*
	 * Método getLastProduto
	 * Retorna o ultimo codigo de produto cadastrado
	 */
	public function getLastProduto()
	{
		$this->setProduto(new produtosModel2());
		
		//RECUPERA CONEXAO BANCO DE DADOS
		TTransaction2::open('my_bd_site');
		
		$codigo =  $this->produto->getLast();
		
		TTransaction2::close();
		
		return $codigo;
	}
	
	/*
	 * Método getLastCor
	 * Retorna o ultimo codigo de cor cadastrada
	 */
	public function getLastCor()
	{
		$this->setProdutoCor(new produtoscoresModel2());
		
		//RECUPERA CONEXAO BANCO DE DADOS
		TTransaction2::open('my_bd_site');
		
		$codigo =  $this->produtoCor->getLast();
		
		TTransaction2::close();
		
		return $codigo;
	}
	
	/*
	 * Método Apaga Cor
	 * Apaga a cor do produto
	 */
	public function apagarCor()
	{
		try
		{
			//RECUPERA CONEXAO BANCO DE DADOS
			TTransaction2::open('my_bd_site');
			
			$this->setProdutoCor(new produtoscoresModel2());
			$this->produtoCor->delete($this->getCodigoProdCor());

			TTransaction2::close();
			
			$nome = $this->getCodigoProd().'_'.$this->getCodigoProdCor();
			
			//RECUPERA CONEXAO BANCO DE DADOS
			TTransaction2::open('my_bd_site');
			
			$this->setProdutoCor($this->getProdutoCor($this->getCodigoProdCor()));
			
			TTransaction2::close();

			//Apaga as imagens
			$this->apagaImagem (self::DIRETORIO.$nome.'.jpg');
			$this->apagaImagem (self::DIRETORIO_MINIATURA.$nome.'.jpg');
			$this->apagaImagem (self::DIRETORIO_THUMB.$nome.'.jpg');
			//Banner 1
			if($this->produtoCor->banner1 == 1)
				$this->apagaImagem (self::DIRETORIO_BANNER1.$nome.'.jpg');
			//Banner2
			if($this->produtoCor->banner2 == 1)
				$this->apagaImagem (self::DIRETORIO_BANNER2.$nome.'.jpg');
			//Banner 3
			if($this->produtoCor->banner3 == 1)
				$this->apagaImagem (self::DIRETORIO_BANNER3.$nome.'.jpg');
			//Home
			if($this->produtoCor->home == 1)
				$this->apagaImagem (self::DIRETORIO_HOME.$nome.'.jpg');
			
			return true;
		}
		catch (Exception $e)
		{
			return false;
		}
	}
}

?>