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

				
		
		/*
		 * Método Contrutor
		 */
		public function __construct()
		{
			$this->setCollectionProdutos((new controladorProdutos())->getCollectionProdutos());
		}
		
		/*
		 * Método show
		 * Exibe as informações na tela
		 */
		public function show()
		{
		?>

			<h1>Produtos</h1>
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
		<?php
		}
	}

?>