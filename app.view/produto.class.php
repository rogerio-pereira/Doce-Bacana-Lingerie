<?php
/*
 *	Arquivo  produto.class.php
 *	Exibe as caracteristicas do produto
 *	
 *	Sistema:	Doce___Bacana_Lingerie
 *	Autor:      Rogério Eduardo Pereira
 *	Data:       06/02/2015
 */

	/*
	 * Classe produto.class.php
	 */
	class produto 
	{
		/*
		 * Variaveis
		 */
		private $produto;
		private $collectionCor;
		
		
		/*
		 * Getters e Setters
		 */
		function getProduto()
		{
			return $this->produto;
		}

		function setProduto($produto)
		{
			$this->produto = $produto;
		}
		function getCollectionCor()
		{
			return $this->collectionCor;
		}

		function setCollectionCor($collectionCor)
		{
			$this->collectionCor = $collectionCor;
		}

		
		/*
		 * Método Contrutor
		 */
		public function __construct()
		{
			$this->setProduto((new controladorProdutos())->getProduto($_GET['cod']));
			$this->setCollectionCor((new controladorProdutos())->getCollectionCores($_GET['cod']));
		}
		
		/*
		 * Método show
		 * Exibe as informações na tela
		 */
		public function show()
		{
		?>
			<h1>Produto</h1>
			<hr>
			<div class='produtoContainer'>
				<div class='detalheProduto'>
					<div class='incluirOrcamento' onclick="incluirOrcamento(<?php echo $this->getProduto()->codigoProduto; ?>)">
						Incluir no Orçamento
					</div>
					<h2>	<?php echo $this->getProduto()->referencia; ?>	</h2>
					<strong>	Categoria	</strong> <?php echo $this->getProduto()->categoria; ?><br><br>
					<strong>	Descrição	</strong><?php echo $this->getProduto()->descricao; ?><br><br>
					<strong>	Tamanhos Produzidos	</strong><br>
					<?php
						$array;
						
						if($this->getProduto()->tamanhoPP == 1)
							$array[] = 'PP';
						
						if($this->getProduto()->tamanhoP == 1)
							$array[] = 'P';
						
						if($this->getProduto()->tamanhoM == 1)
							$array[] = 'M';
						
						if($this->getProduto()->tamanhoG == 1)
							$array[] = 'G';
						
						if($this->getProduto()->tamanhoGG == 1)
							$array[] = 'GG';
						
						if($this->getProduto()->tamanho48 == 1)
							$array[] = '48';
						
						if($this->getProduto()->tamanho50 == 1)
							$array[] = '50';
						
						if($this->getProduto()->tamanho52 == 1)
							$array[] = '52';
						
						if($this->getProduto()->tamanho54 == 1)
							$array[] = '54';
						
						echo implode(', ', $array).'<br><br>';
					?>
					<strong>	Cores Disponíveis	</strong><br>
					<div>
					<?php
						$i = 1;
						foreach ($this->getCollectionCor() as $cor)
						{
							echo
								"
									<style>
										.cod_{$i}
										{
											width:			5%;
											height:			0;
											padding-top:	5%;
											overflow:		hidden;
											display:		inline-block;
											border:			solid 2px black;
											margin:			0px;
										}
										.cod_{$i}:after 
										{
											content:		'';
											display:		block;
											width:			0;
											height:			0;
											margin-top:		-500px;

											border-top:		500px solid {$cor->cor1};
											border-right:	500px solid {$cor->cor2};
										}
									</style>
									<div class='cod_{$i}'></div>
								";
							$i++;
						}
					?>
					</div>
					
					
					<strong>	Características	</strong><br><br>
					<?php echo $this->getProduto()->caracteristicas; ?><br><br>
				</div>
				<div class="imagensProduto">
					<div id='imagemGrande'>
						<img src='/app.view/img/produtos/<?php echo $this->getCollectionCor()[0]->codigoProduto.'_'.$this->getCollectionCor()[0]->codigo.'.jpg'; ?>'>
					</div>
					<div id='miniaturasCores'>
						<ul id='listaCoresProduto'>
						<?php
							foreach ($this->getCollectionCor() as $cor)
							{
								echo
									"
										<li>
											<img 
												src='/app.view/img/produtos/miniaturas/{$cor->codigoProduto}_{$cor->codigo}.jpg' 
												alt='$cor->nome' 
												title='$cor->nome'
												 onclick='mudaImagemProduto({$cor->codigoProduto}, {$cor->codigo})'
											>
										</li>
									";
							}
						?>
						</ul>
					</div>
				</div>
			</div>
		<?php
		}
	}

?>