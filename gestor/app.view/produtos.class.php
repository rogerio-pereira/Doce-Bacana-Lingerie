<?php
/*
 *	Arquivo  produtos.class.php
 *	Lista de Produtos
 *	
 *	Sistema:	Doce___Bacana_Lingerie
 *	Autor:      Rogério Eduardo Pereira
 *	Data:       28/01/2015
 */

	/*
	 * Classe produtos.class.php
	 */
	class produtos
	{
		/*
		 * Variaveis
		 */
		private $collectionProdutos;
		private $collectionCores;
		
		
		/*
		 * Getters e Setters
		 */
		function getCollectionProdutos()
		{
			return $this->collectionProdutos;
		}

		function setCollectionProdutos($collectionProdutos)
		{
			$this->collectionProdutos = $collectionProdutos;
		}
		
		function getCollectionCores()
		{
			return $this->collectionCores;
		}

		function setCollectionCores($collectionCores)
		{
			$this->collectionCores = $collectionCores;
		}

		
				
		
		/*
		 * Método Contrutor
		 */
		public function __construct()
		{
			$this->setCollectionProdutos((new controladorProdutos())->getCollectionProdutos());
			$this->setCollectionCores((new controladorProdutos())->getCollectionCores());
		}
		
		/*
		 * Método show
		 * Exibe as informações na tela
		 */
		public function show()
		{
		?>
			<h1>Produtos</h1>
			<hr>
			<form class="formulario" name="listaProdutos"	method="post" onsubmit="validaAlteracaoSenha()">
				<input type="hidden" name="formularioNome"	value="listaProdutos">
				<table class='tabelaFormulario'>
					<!--Titulo-->
					<tr>
						<td align='center'>
							Alterar
						</td>
						<td align='center'>
							Referencia
						</td>
						<td align='center'>
							Categoria
						</td>
						<td align='center'>
							Excluir
						</td>
					</tr>
					<tr>
						<td colspan='4'>
							<hr>
						</td>
					</tr>
					<!--Dados-->
					<?php
						foreach ($this->getCollectionProdutos() as $produto)
						{
							echo
								"
									<!--{$produto->referencia}-->
									<tr>
										<td align='center'>
											<input type='radio' name='radioProduto' id='radioProduto' value='{$produto->codigo}'>
										</td>
										<td>
											{$produto->referencia}
										</td>
										<td>
											{$produto->nome} <!--Nome Categoria-->
										</td>
										<td align='center'>
											<input type='checkbox' name='produtosApagar[]' class='chkProdutosApagar' value='{$produto->codigo}'>
										</td>
									</tr>
								";
						}
					?>
					<tr>
						<td colspan='4'>
							<hr>
						</td>
					</tr>
					<!--Botões-->
					<tr>
						<td>
							<input type='button' value='Alterar' onclick='alteraProduto()'>
						</td>
						<td colspan='2' align='center'>
							<input type='button' value='Cadastrar' onclick='novoProduto()'>
						</td>
						<td>
						<?php
							if(count($this->getCollectionProdutos()) > 0)
								echo "<input type='button' value='Apagar' onclick='apagaProdutos()'>";
						?>
						</td>
					</tr>
				</table>
			</form>
			<hr><br>
			<h1>Cores</h1>
			<hr>
			<form class="formulario" name="listaCores"	method="post">
				<input type="hidden" name="formularioNome"	value="listaCores">
				<table class='tabelaFormulario'>
					<tr>
						<td>
							Selecionar
						</td>
						<td>
							Nome
						</td>
						<td>
							Cor
						</td>
					</tr>
					<?php
						$i = 0;
						foreach ($this->getCollectionCores() as $cor)
						{
							echo
								"
									<tr>
										<td align='center'>
											<input type='radio' name='radioCor' id='radioCor' value='{$cor->codigo}'>
										</td>
										<td>
											{$cor->nome}
										</td>
										<td>
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
													cursor:			pointer;
												}
												.cod_{$i}:after 
												{
													content:		'';
													display:		block;
													width:			0;
													height:			0;
													margin-top:		-500px;

													cursor:			pointer;

													border-top:		500px solid {$cor->cor1};
													border-right:	500px solid {$cor->cor2};
												}
											</style>
											<div 
												class='cod_{$i}' alt='{$cor->nome}' title='{$cor->nome}'>
											</div>
										</td>
									</tr>
								";
							$i++;
						}
					?>
					<tr>
						<!--Estou usando 3 td no lugar de colspan devido ao .cod_{$i}:after (border-right) ser de 500px, então a tabela fica bem grande-->
						<td></td>
						<td align='center'>
							<input type='button' value='Alterar' onclick='alteraCor()'>
						</td>
						<td></td>
					</tr>
				</table>
			</form>
		<?php
		}
	}

?>