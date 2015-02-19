<?php
/*
 *	Arquivo  busca.class.php
 *	Pagina de Bsca
 *	
 *	Sistema:	Doce___Bacana_Lingerie
 *	Autor:      Rogério Eduardo Pereira
 *	Data:       05/02/2015
 */

	/*
	 * Classe busca.class.php
	 */
	class busca
	{
		/*
		 * Contantes
		 */
		const ADJACENTES	= 4;
		const LIMITE		= 9;
		
		/*
		 * Variaveis
		 */
		private $busca;
		private $collectionProduto;
		private $categoria;
		private $pagina;
		private $total;
		private $proximo;
		private $anterior;
		private $ultimaPagina;
		
		
		/*
		 * Getters e Setters
		 */
		function getBusca()
		{
			return $this->busca;
		}

		function getCollectionProduto()
		{
			return $this->collectionProduto;
		}

		function getCategoria()
		{
			return $this->categoria;
		}

		function getPagina()
		{
			return $this->pagina;
		}

		function getTotal()
		{
			return $this->total;
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

		function setBusca($busca)
		{
			$this->busca = $busca;
		}

		function setCollectionProduto($collectionProduto)
		{
			$this->collectionProduto = $collectionProduto;
		}

		function setCategoria($categoria)
		{
			$this->categoria = $categoria;
		}

		function setPagina($pagina)
		{
			$this->pagina = $pagina;
		}

		function setTotal($total)
		{
			$this->total = $total;
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
			
			//Busca
			if(!empty($_GET['chave']))
				$this->setBusca($_GET['chave']);
			else
				$this->setBusca (NULL);
			
			//Pagina
			if(!empty($_GET['pag']))
				$this->setPagina ($_GET['pag']);
			else
				$this->setPagina(1);
			
			//Calcula Inicio do limite 
			$inicio = ($this->getPagina() - 1) * 9;
			
			//Calcula itens para paginação
			$this->setTotal((new controladorProdutos())->getTotalBusca($this->getBusca()));	
			$this->setProximo($this->getPagina()+1);
			$this->setAnterior($this->getPagina()-1);
			$this->setUltimaPagina(ceil($this->getTotal() / self::LIMITE));
			
			//Home
			$this->setCollectionProduto((new controladorProdutos())->getCollectionProdutoBusca($this->getBusca(), $inicio));
			
		}
		
		/*
		 * Método show
		 * Exibe as informações na tela
		 */
		public function show()
		{
		
			echo
				"
					<!--<h1>Busca: <span id='logotipo'>{$_GET['chave']}</span></h1>
					<hr>-->
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
								<a href='/produto/{$produto->codProd}' id='botaoDetalhes'>Detalhes</a>
								<a class='incluirOrcamento' href='/orcamento' onclick='incluirOrcamento({$produto->codProd})'>
									Orçamento
								</a>
						</li>
					";
			}
			echo "</ul>";


			//Paginação			
			echo '<div class="paginacao">';
			$paginacao = '';
			
			if ($this->getPagina() > 1)
			{
				$paginacao .= "<a href='/categoria/{$this->getCodigo()}/{$this->getAnterior()}'>		&lt; Anterior	</a>";
			}
			
			//Menos de 9 paginas no total
			if ($this->getUltimaPagina() <= 9)
			{
				for ($i=1; $i<=$this->getUltimaPagina(); $i++)
				{
					if ($i == $this->getPagina())
						$paginacao .= "<a class='atual' href='/busca/{$this->getBusca()}/{$i}'>		{$i}	</a>";			
					else 
						$paginacao .= "<a href='/busca/{$this->getBusca()}/{$i}'>		{$i}	</a>";
				}
			} 
			//Mais de 9 paginas no total
			if ($this->getUltimaPagina() > 9)
			{
				if ($this->getPagina() < 1 + (2 * self::ADJACENTES))
				{
					for ($i=1; $i< 2 + (2 * self::ADJACENTES); $i++)
					{
						if ($i == $this->getPagina())
							$paginacao .= "<a class='atual' href='/busca/{$this->getBusca()}/{$i}'>		{$i}	</a>";					
						else 
							$paginacao .= "<a href='/busca/{$this->getBusca()}/{$i}'>		{$i}	</a>";
					}
					$paginacao .= '...';
					$paginacao = "<a href='/busca/{$this->getBusca()}/{$this->getUltimaPagina()}'>		{$this->getUltimaPagina()}	</a>";
				}
				else if($this->getPagina() > (2 * self::ADJACENTES) && $this->getPagina() < $this->getUltimaPagina() - 3)
				{
					$paginacao = "<a href='/busca/{$this->getBusca()}/1'>		1	</a>";				
					$paginacao .= '... ';	
					for ($i = $this->getPagina()-self::ADJACENTES; $i<= $this->getPagina() + self::ADJACENTES; $i++)
					{
						if ($i == $this->getPagina())
							$paginacao .= "<a class='atual' href='/busca/{$this->getBusca()}/{$i}'>		{$i}	</a>";					
						else
							$paginacao .= "<a href='/busca/{$this->getBusca()}/{$i}'>		{$i}	</a>";
					}
					$paginacao .= '...';
					$paginacao .= "<a href='/busca/{$this->getBusca()}/{$this->getUltimaPagina()}'>		{$$this->getUltimaPagina()}	</a>";
				}
				else 
				{
					$paginacao .= "<a href='//busca/{$this->getBusca()}/1'>		1	</a>";				
					$paginacao .= '... ';	
					for ($i = $this->getUltimaPagina() - (4 + (2 * self::ADJACENTES)); $i <= $this->getUltimaPagina(); $i++)
					{
						if ($i == $this->getPagina())
							$paginacao .= "<a class='atual' href='/busca/{$this->getBusca()}/{$i}'>		{$i}	</a>";	
						else 
							$paginacao .= "<a href='/busca/{$this->getBusca()}/{$i}'>		{$i}	</a>";
					}
				}
			}

			if ($this->getProximo() <= $this->getUltimaPagina() && $this->getUltimaPagina() > 1)
				$paginacao .= "<a href='/busca/{$this->getBusca()}/{$this->getProximo()}'>		Próximo &gt;	</a>";

			echo $paginacao;

			echo '</div>';
		}
	}

?>