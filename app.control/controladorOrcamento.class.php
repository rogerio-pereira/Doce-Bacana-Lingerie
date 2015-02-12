<?php

/*
 * 	Arquivo  controladorOrcamento.class.php
 * 	#DESCRIÇÂO#
 * 	
 * 	Sistema:	Doce___Bacana_Lingerie
 * 	Autor:      Rogério Eduardo Pereira
 * 	Data:       11/02/2015
 */

/*
 * Classe controladorOrcamento.class.php
 */
class controladorOrcamento
{
	/*
	 * Variaveis
	 */
	private $repository;
	private $collectionOrcamentos;
	private $collectionOrcamentosProdutos;
	
	private $orcamento; 
	private $codigoOrcamento;
	private $cliente;
	private $dataHora;
	private $codigoCorreio;
	private $status;
	
	private $orcamentoProduto;
	private $orcamentoProdutoCodigo;
	private $codigoProduto;
	private $quantidadePP;
	private $quantidadeP;
	private $quantidadeM;
	private $quantidadeG;
	private $quantidadeGG;
	private $quantidade48;
	private $quantidade50;
	private $quantidade52;
	private $quantidade54;

	/*
	 * Getters e Setters
	 */
	function getRepository()
	{
		return $this->repository;
	}

	function getCollectionOrcamentos()
	{
		return $this->collectionOrcamentos;
	}

	function getCollectionOrcamentosProdutos()
	{
		return $this->collectionOrcamentosProdutos;
	}

	function getOrcamento()
	{
		return $this->orcamento;
	}

	function getCodigoOrcamento()
	{
		return $this->codigoOrcamento;
	}

	function getCliente()
	{
		return $this->cliente;
	}

	function getDataHora()
	{
		return $this->dataHora;
	}

	function getCodigoCorreio()
	{
		return $this->codigoCorreio;
	}

	function getStatus()
	{
		return $this->status;
	}

	function getOrcamentoProduto()
	{
		return $this->orcamentoProduto;
	}

	function getOrcamentoProdutoCodigo()
	{
		return $this->orcamentoProdutoCodigo;
	}

	function getCodigoProduto()
	{
		return $this->codigoProduto;
	}

	function getQuantidadePP()
	{
		return $this->quantidadePP;
	}

	function getQuantidadeP()
	{
		return $this->quantidadeP;
	}

	function getQuantidadeM()
	{
		return $this->quantidadeM;
	}

	function getQuantidadeG()
	{
		return $this->quantidadeG;
	}

	function getQuantidadeGG()
	{
		return $this->quantidadeGG;
	}

	function getQuantidade48()
	{
		return $this->quantidade48;
	}

	function getQuantidade50()
	{
		return $this->quantidade50;
	}

	function getQuantidade52()
	{
		return $this->quantidade52;
	}

	function getQuantidade54()
	{
		return $this->quantidade54;
	}

	function setRepository($repository)
	{
		$this->repository = $repository;
	}

	function setCollectionOrcamentos($collectionOrcamentos)
	{
		$this->collectionOrcamentos = $collectionOrcamentos;
	}

	function setCollectionOrcamentosProdutos($collectionOrcamentosProdutos)
	{
		$this->collectionOrcamentosProdutos = $collectionOrcamentosProdutos;
	}

	function setOrcamento($orcamento)
	{
		$this->orcamento = $orcamento;
	}

	function setCodigoOrcamento($codigoOrcamento)
	{
		$this->codigoOrcamento = $codigoOrcamento;
	}

	function setCliente($cliente)
	{
		$this->cliente = $cliente;
	}

	function setDataHora($dataHora)
	{
		$this->dataHora = $dataHora;
	}

	function setCodigoCorreio($codigoCorreio)
	{
		$this->codigoCorreio = $codigoCorreio;
	}

	function setStatus($status)
	{
		$this->status = $status;
	}

	function setOrcamentoProduto($orcamentoProduto)
	{
		$this->orcamentoProduto = $orcamentoProduto;
	}

	function setOrcamentoProdutoCodigo($orcamentoProdutoCodigo)
	{
		$this->orcamentoProdutoCodigo = $orcamentoProdutoCodigo;
	}

	function setCodigoProduto($codigoProduto)
	{
		$this->codigoProduto = $codigoProduto;
	}

	function setQuantidadePP($quantidadePP)
	{
		$this->quantidadePP = $quantidadePP;
	}

	function setQuantidadeP($quantidadeP)
	{
		$this->quantidadeP = $quantidadeP;
	}

	function setQuantidadeM($quantidadeM)
	{
		$this->quantidadeM = $quantidadeM;
	}

	function setQuantidadeG($quantidadeG)
	{
		$this->quantidadeG = $quantidadeG;
	}

	function setQuantidadeGG($quantidadeGG)
	{
		$this->quantidadeGG = $quantidadeGG;
	}

	function setQuantidade48($quantidade48)
	{
		$this->quantidade48 = $quantidade48;
	}

	function setQuantidade50($quantidade50)
	{
		$this->quantidade50 = $quantidade50;
	}

	function setQuantidade52($quantidade52)
	{
		$this->quantidade52 = $quantidade52;
	}

	function setQuantidade54($quantidade54)
	{
		$this->quantidade54 = $quantidade54;
	}

	

	/*
	 * Método Contrutor
	 */
	public function __construct()
	{
		$this->setRepository(NULL);
		$this->setCollectionOrcamentos(NULL);
		$this->setCollectionOrcamentosProdutos(NULL);
		
		$this->setOrcamento(NULL);
		$this->setCodigoOrcamento(NULL);
		$this->setCliente(NULL);
		$this->setDataHora(NULL);
		$this->setCodigoCorreio(NULL);
		$this->setStatus(NULL);
		
		$this->setOrcamentoProduto(NULL);
		$this->setOrcamentoProdutoCodigo(NULL);
		$this->setCodigoProduto(NULL);
		$this->setQuantidadePP(NULL);
		$this->setQuantidadeP(NULL);
		$this->setQuantidadeM(NULL);
		$this->setQuantidadeG(NULL);
		$this->setQuantidadeGG(NULL);
		$this->setQuantidade48(NULL);
		$this->setQuantidade50(NULL);
		$this->setQuantidade52(NULL);
		$this->setQuantidade54(NULL);		
	}

	/*
	 * Método salvaOrcamento
	 * Salva o orçamentos
	 */
	public function salvaOrcamento()
	{
		try
		{
			$this->setOrcamento(new orcamentoModel2());
			
			$this->orcamento->cliente	= $this->getCliente();
			$this->orcamento->dataHora	= $this->getDataHora();
			$this->orcamento->status	= $this->getStatus();
			
			//RECUPERA CONEXAO BANCO DE DADOS
			TTransaction2::open('my_bd_site');
			
			$result = $this->orcamento->store();

			TTransaction2::close();

			return true;
		}
		catch(Exception $e)
		{
			return false;
		}
	}
	
	/*
	 * Método getLastProduto
	 * Retorna o ultimo codigo de orçamento cadastrado
	 */
	public function getLastProduto()
	{
		$this->setOrcamento(new orcamentoModel2());
		
		//RECUPERA CONEXAO BANCO DE DADOS
		TTransaction2::open('my_bd_site');
		
		$codigo =  $this->orcamento->getLast();
		
		TTransaction2::close();
		
		return $codigo;
	}
	
	/*
	 * Método salvaProdutoOrcamento
	 * Salva os produtos do orçamento
	 */
	public function salvaProdutosOrcamento()
	{
		try
		{
			foreach($this->getCollectionOrcamentosProdutos() as $produto)
			{
				$this->setOrcamentoProduto(new orcamentoprodutoModel2());
				
				$this->orcamentoProduto->codigoOrcamento	= $produto[0];
				$this->orcamentoProduto->codigoProduto		= $produto[1];
				$this->orcamentoProduto->quantidadePP		= $produto[2];
				$this->orcamentoProduto->quantidadeP		= $produto[3];
				$this->orcamentoProduto->quantidadeM		= $produto[4];
				$this->orcamentoProduto->quantidadeG		= $produto[5];
				$this->orcamentoProduto->quantidadeGG		= $produto[6];
				$this->orcamentoProduto->quantidade48		= $produto[7];
				$this->orcamentoProduto->quantidade50		= $produto[8];
				$this->orcamentoProduto->quantidade52		= $produto[9];
				$this->orcamentoProduto->quantidade54		= $produto[10];
				$this->orcamentoProduto->referencia			= $produto[11];
				$this->orcamentoProduto->nome				= $produto[12];
				
				//RECUPERA CONEXAO BANCO DE DADOS
				TTransaction2::open('my_bd_site');

				$result = $this->orcamentoProduto->store();

				TTransaction2::close();
			}

			return true;
		}
		catch(Exception $e)
		{
			return false;
		}
	}
}

?>