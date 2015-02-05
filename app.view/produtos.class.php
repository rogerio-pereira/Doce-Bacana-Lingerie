<?php
/*
 *	Arquivo  produtos.class.php
 *	Exibe todos os produtos
 *	
 *	Sistema:	Doce___Bacana_Lingerie
 *	Autor:      Rogério Eduardo Pereira
 *	Data:       05/02/2015
 * 
 *	Paginação obtida em
 *  http://tutorial.thiagobueno.tk/paginacao-avancada-com-php 
 *	04/02/2014 17:17
 */

	/*
	 * Classe produtos.class.php
	 */
	class produtos
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
		private $collectionProduto;
		private $pagina;
		private $total;
		private $proximo;
		private $anterior;
		private $ultimaPagina;
		private $categoriaAtual;
		private $categoriaAnterior;
		

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
		
		function getCategoriaAtual()
		{
			return $this->categoriaAtual;
		}

		function getCategoriaAnterior()
		{
			return $this->categoriaAnterior;
		}

		function setCategoriaAtual($categoriaAtual)
		{
			$this->categoriaAtual = $categoriaAtual;
		}

		function setCategoriaAnterior($categoriaAnterior)
		{
			$this->categoriaAnterior = $categoriaAnterior;
		}

												
		
		/*
		 * Método Contrutor
		 */
		public function __construct()
		{
			
			//Codigo
				$this->setCodigo(-1);
			
			//Pagina
			//Usa o parametro do GET cod, devido ao htaccess
			if(!empty($_GET['cod']))
				$this->setPagina ($_GET['cod']);
			else
				$this->setPagina(1);
			
			//Calcula Inicio do limite 
			$inicio = ($this->getPagina() - 1) * 9;
			
			//Calcula itens para paginação
			$this->setTotal((new controladorProdutos())->getTotal($this->getCodigo()));
			$this->setProximo($this->getPagina()+1);
			$this->setAnterior($this->getPagina()-1);
			$this->setUltimaPagina(ceil($this->getTotal() / self::LIMITE));
			
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
					<ul class='produtosLista'>
				";
			
			//Define a categoria atual;
			$this->setCategoriaAtual('');
			
			
			foreach($this->getCollectionProduto() as $produto)
			{
				$this->setCategoriaAnterior($this->getCategoriaAtual());
				$this->setCategoriaAtual($produto->categoria);
				
				if(strcmp($this->getCategoriaAtual(), $this->getCategoriaAnterior()) != 0)
				{
					echo
						"
							<h1>{$produto->categoria}</h1>
							<hr>
						";
				}
						
				
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
				$paginacao = '';
				
				if ($this->getPagina() > 1)
				{
					$paginacao .= "<a href='/produtos/{$this->getAnterior()}'>		&lt; Anterior	</a>";
				}
				
				//Menos de 9 paginas no total
				if ($this->getUltimaPagina() <= 9)
				{
					for ($i=1; $i<=$this->getUltimaPagina(); $i++)
					{
						if ($i == $this->getPagina())
							$paginacao .= "<a class='atual' href='/produtos/{$i}'>		{$i}	</a>";			
						else 
							$paginacao .= "<a href='/produtos/{$i}'>		{$i}	</a>";
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
								$paginacao .= "<a class='atual' href='/produtos/{$i}'>		{$i}	</a>";					
							else 
								$paginacao .= "<a href='/produtos/{$i}'>		{$i}	</a>";
						}
						$paginacao .= '...';
						$paginacao = "<a href='/produtos/{$this->getUltimaPagina()}'>		{$this->getUltimaPagina()}	</a>";
					}
					else if($this->getPagina() > (2 * self::ADJACENTES) && $this->getPagina() < $this->getUltimaPagina() - 3)
					{
						$paginacao = "<a href='/produtos/1'>		1	</a>";				
						$paginacao .= '... ';	
						for ($i = $this->getPagina()-self::ADJACENTES; $i<= $this->getPagina() + self::ADJACENTES; $i++)
						{
							if ($i == $this->getPagina())
								$paginacao .= "<a class='atual' href='/produtos/{$i}'>		{$i}	</a>";					
							else
								$paginacao .= "<a href='/produtos/{$i}'>		{$i}	</a>";
						}
						$paginacao .= '...';
						$paginacao .= "<a href='/produtos/{$this->getUltimaPagina()}'>		{$$this->getUltimaPagina()}	</a>";
					}
					else 
					{
						$paginacao .= "<a href='/produtos/1'>		1	</a>";				
						$paginacao .= '... ';	
						for ($i = $this->getUltimaPagina() - (4 + (2 * self::ADJACENTES)); $i <= $this->getUltimaPagina(); $i++)
						{
							if ($i == $this->getPagina())
								$paginacao .= "<a class='atual' href='/produtos/{$i}'>		{$i}	</a>";	
							else 
								$paginacao .= "<a href='/produtos/{$i}'>		{$i}	</a>";
						}
					}
				}
				
				if ($this->getProximo() <= $this->getUltimaPagina() && $this->getUltimaPagina() > 1)
					$paginacao .= "<a href='/produtos/{$this->getProximo()}'>		Próximo &gt;	</a>";

				echo $paginacao;

				echo '</div>';
			}
		}
	}

?>
