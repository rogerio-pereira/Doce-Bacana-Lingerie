<?php
/*
 *	Arquivo  categoria.class.php
 *	Produtos Filtrados por categoria
 *	
 *	Sistema:	Doce___Bacana_Lingerie
 *	Autor:      Rogério Eduardo Pereira
 *	Data:       21/01/2015
 * 
 *	Paginação obtida em
 *  http://tutorial.thiagobueno.tk/paginacao-avancada-com-php 
 *	04/02/2014 17:17
 */

	/*
	 * Classe categoria.class.php
	 */
	class categoria
	{
		/*
		 * Contantes
		 */
		const ADJACENTES	= 4;
		const LIMITE		= 9;
		
		/*
		 * Variaveis
		 */
		private $codigo;
		private $pagina;
		private $collectionProduto;
		private $total;
		private $proximo;
		private $anterior;
		private $ultimaPagina;
		

		/*
		 * Getters e Setters
		 */
		function getCodigo()
		{
			return $this->codigo;
		}

		function getPagina()
		{
			return $this->pagina;
		}

		function getCollectionProduto()
		{
			return $this->collectionProduto;
		}

		function setCodigo($codigo)
		{
			$this->codigo = $codigo;
		}

		function setPagina($pagina)
		{
			$this->pagina = $pagina;
		}

		function setCollectionProduto($collectionProduto)
		{
			$this->collectionProduto = $collectionProduto;
		}

		function getTotal()
		{
			return $this->total;
		}

		function setTotal($total)
		{
			$this->total = $total;
		}

		function getProximo()
		{
			return $this->proximo;
		}

		function getAnterior()
		{
			return $this->anterior;
		}

		function getUltimaPagina()
		{
			return $this->ultimaPagina;
		}

		function setProximo($proximo)
		{
			$this->proximo = $proximo;
		}

		function setAnterior($anterior)
		{
			$this->anterior = $anterior;
		}

		function setUltimaPagina($ultimaPagina)
		{
			$this->ultimaPagina = $ultimaPagina;
		}

								
		
		/*
		 * Método Contrutor
		 */
		public function __construct()
		{
			//Codigo
			if(!empty($_GET['cod']))
				$this->setCodigo($_GET['cod']);
			else
				$this->setCodigo (NULL);
			
			//Pagina
			if(!empty($_GET['pag']))
				$this->setPagina ($_GET['pag']);
			else
				$this->setPagina(1);
			
			//Calcula Inicio do limite 
			$inicio = ($this->getPagina() - 1) * 9;
			
			//Calcula itens para paginação
			$this->setTotal((new controladorProdutos())->getTotal($this->getCodigo()));
			$this->setProximo($this->getPagina()+1);
			$this->setAnterior($this->getPagina()-1);
			$this->setUltimaPagina(ceil($this->getTotal() / self::LIMITE));
			
			
			//Home
			if($this->getCodigo() == NULL)
				$this->setCollectionProduto((new controladorProdutos())->getCollectionProduto(NULL, NULL));
			//Categoria
			else
				$this->setCollectionProduto((new controladorProdutos())->getCollectionProduto($this->getCodigo(), $inicio));
		}
		
		/*
		 * Método show
		 * Exibe as informações na tela
		 */
		public function show()
		{
			
			echo 
				"
					<h1>Produtos</h1>
					<hr>
					<ul class='produtosLista'>
				";
			foreach($this->getCollectionProduto() as $produto)
			{
				echo
					"
						<li>
								<a class='linkImagem' href='/produto/{$produto->codProd}'>
									<figure class='imgProduto'>
										<img src='/app.view/img/produtos/home/{$produto->codProd}_{$produto->codCor}.jpg' title='{$produto->referencia}' alt='{$produto->referencia}'>
										<legend>
											{$produto->referencia}
										</legend>
									</figure>
								</a>
								<a href='/produto/{$produto->codProd}'>Detalhes</a>
						</li>
					";
			}
			echo "</ul>";
			
			//Paginação
			if($this->getCodigo() != NULL)
			{
				echo '<div class="paginacao">';
				
				if ($this->getPagina() > 1)
				{
					$paginacao = "<a href='/categoria/{$this->getCodigo()}/{$this->getAnterior()}'>		&lsaquo; Anterior	</a>";
				}
				
				if ($ultima_pag <= 9)
				{
					for ($i=1; $i<=$ultima_pag; $i++)
					{
						if ($i == $pag)
							$paginacao = "<a class='atual' href='/categoria/{$this->getCodigo()}/{$i}'>		{$i}	</a>";			
						else 
							$paginacao = "<a href='/categoria/{$this->getCodigo()}/{$i}'>		{$i}	</a>";
					}
				} 
			}
		}
	}

?>
