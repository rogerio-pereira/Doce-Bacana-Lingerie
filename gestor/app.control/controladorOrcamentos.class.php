<?php

/*
 *	Arquivo  controladorOrcamentos.class
 *	Controlador de orçamentos
 *	
 *	Sistema:	Doce___Bacana_Lingerie
 *	Autor:      Rogério Eduardo Pereira
 *	Data:       12/02/2015
 */

	/*
	 * Classe controladorOrcamentos.class
	 */
	class controladorOrcamentos 
	{
		/*
		 * Variaveis
		 */
		private $repository;
		private $collectionOrcamentos;
		private $collectionOrcamentosProdutos;

		private $orcamento;
		private $codigoOrcamento;
		private $codigoCorreio;
		private $status;
		
		
		/*
		 * Getters e Setters
		 */
		function getRepository()
		{
			return $this->repository;
		}

		function getCollectionOrcamentos()
		{
			$this->setCollectionOrcamentos(NULL);
		
			//RECUPERA CONEXAO BANCO DE DADOS
			TTransaction::open('my_bd_site');
			//TABELA exposition_gallery
			$criteria	= new TCriteria;
			//$criteria->add(new TFilter('situacao', '=', $situacao));
			$criteria->add(new TFilter('o.cliente', '=', 'c.codigo'));
			$criteria->add(new TFilter('o.codigo', '=', 'p.codigoOrcamento'));
			$criteria->setProperty('group', 'codigoOrcamento');
			$criteria->setProperty('order', 'c.codigo DESC');	
			
			$this->repository = new TRepository();

			$this->repository->addColumn('o.codigo as codigo');
			$this->repository->addColumn('o.status as status');
			$this->repository->addColumn('p.codigoOrcamento as codigoOrcamento');
			$this->repository->addColumn('c.nome as cliente');
			$this->repository->addColumn('o.dataHora as dataHora');
			$this->repository->addColumn('count(p.codigo) as total');
			$this->repository->addEntity('orcamento o');
			$this->repository->addEntity('clientes c');
			$this->repository->addEntity('orcamentoproduto p');

			$this->setCollectionOrcamentos($this->repository->load($criteria));
			
			TTransaction::close();

			return $this->collectionOrcamentos;
		}
		
		function getCollectionOrcamentos2()
		{
			$this->setCollectionOrcamentos(NULL);
		
			//RECUPERA CONEXAO BANCO DE DADOS
			TTransaction2::open('my_bd_site');
			//TABELA exposition_gallery
			$criteria	= new TCriteria;
			//$criteria->add(new TFilter('situacao', '=', $situacao));
			$criteria->add(new TFilter('o.cliente', '=', 'c.codigo'));
			$criteria->add(new TFilter('o.codigo', '=', 'p.codigoOrcamento'));
			$criteria->setProperty('group', 'codigoOrcamento');
			$criteria->setProperty('order', 'c.codigo DESC');	
			
			$this->repository = new TRepository2();

			$this->repository->addColumn('o.codigo as codigo');
			$this->repository->addColumn('o.status as status');
			$this->repository->addColumn('p.codigoOrcamento as codigoOrcamento');
			$this->repository->addColumn('c.nome as cliente');
			$this->repository->addColumn('o.dataHora as dataHora');
			$this->repository->addColumn('count(p.codigo) as total');
			$this->repository->addEntity('orcamento o');
			$this->repository->addEntity('clientes c');
			$this->repository->addEntity('orcamentoproduto p');

			$this->setCollectionOrcamentos($this->repository->load($criteria));
			
			TTransaction2::close();

			return $this->collectionOrcamentos;
		}

		function getCollectionOrcamentosProdutos($codigo)
		{
			$this->setCollectionOrcamentosProdutos(NULL);
		
			//RECUPERA CONEXAO BANCO DE DADOS
			TTransaction::open('my_bd_site');
			
			//TABELA exposition_gallery
			$criteria	= new TCriteria;
			$criteria->add(new TFilter('codigoOrcamento', '=', $codigo));
			$criteria->setProperty('order', 'nome');	
			
			$this->repository = new TRepository();

			$this->repository->addColumn('*');
			$this->repository->addEntity('orcamentoproduto');
			
			$this->setCollectionOrcamentosProdutos($this->repository->load($criteria));
			
			TTransaction::close();

			return $this->collectionOrcamentosProdutos;
		}

		function getOrcamento($codigo)
		{
			$this->setOrcamento(NULL);
			$result;

			//RECUPERA CONEXAO BANCO DE DADOS
			TTransaction::open('my_bd_site');

			//TABELA exposition_gallery
			//$criteria	= new TCriteria;
			//$criteria->add(new TFilter('codigo', '=', $codigo));
			//$criteria->setProperty('order', 'ordem ASC');

			$this->setOrcamento(new orcamentoModel());
			$result = $this->orcamento->load($codigo);

			return $result;
		}

		function getCodigoOrcamento()
		{
			return $this->codigoOrcamento;
		}

		function getCodigoCorreio()
		{
			return $this->codigoCorreio;
		}

		function getStatus()
		{
			return $this->status;
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

		function setCodigoCorreio($codigoCorreio)
		{
			$this->codigoCorreio = $codigoCorreio;
		}

		function setStatus($status)
		{
			$this->status = $status;
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
			$this->setCodigoCorreio(NULL);
			$this->setStatus(NULL);
		}
		
		/*
		 * Método salva
		 * Atualiza o orçamento
		 */
		public function salva()
		{
			try
			{
								
				$this->setOrcamento(new orcamentoModel2());

				$this->orcamento->codigo		= $this->getCodigoOrcamento();
				$this->orcamento->status		= $this->getStatus();
				$this->orcamento->codigoCorreio	= $this->getCodigoCorreio();

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
		 *	Método apagaOrcamento
		 *	Apaga o orçamento com o codigo especifico;
		 *	Usado em IFRAME
		 */
		public function apagaOrcamento($codigo)
		{
			try
			{
				$this->setOrcamento(new orcamentoModel2());

				//RECUPERA CONEXAO BANCO DE DADOS
				TTransaction2::open('my_bd_site');

				$this->orcamento->delete($codigo);

				TTransaction2::close();

				return true;
			}
			catch(Exception $e)
			{
				return false;
			}
		}
		
		/*
		 *	Método apagaProdutoOrcamento
		 *	Apaga os produtos do orçamento com o codigo especifico;
		 *	Usado em IFRAME
		 */
		public function apagaProdutoOrcamento($codigo)
		{
			try
			{
				$this->setOrcamento(new orcamentoprodutoModel2());

				//RECUPERA CONEXAO BANCO DE DADOS
				TTransaction2::open('my_bd_site');
				
				$criteria	= new TCriteria;
				$criteria->add(new TFilter('codigoOrcamento', '=', $codigo));

				$this->orcamento->deleteCriteria($criteria);

				TTransaction2::close();
				
				return true;
			}
			catch(Exception $e)
			{
				return false;
			}
		}
		
		/*
         *  Método converteData
         *  Converte da data
         *  Brasileiro -> Banco de Dados
         *  Banco de Dados -> Brasileiro
         *  @param $data = Data a ser convertida
         */
        public function converteData($data)
        {
            $array		= array();
			$dateTime	= array();
            $convert;
			
			$dateTime = explode(' ', $data);
			$data = $dateTime[0];
			
            //Data no formato Brasileiro
            if(strstr($data, '/'))
            {
                $array      = explode('/', $data);
                $convert    = $array[2] . '-' . $array[1] . '-' . $array[0];
            }
            if(strstr($data, '-'))
            {
                $array      = explode('-', $data);
                $convert    = $array[2] . '/' . $array[1] . '/' . $array[0];
            }
			$convert = $convert.' '.$dateTime[1];
			
            return $convert;
        }
	}
?>