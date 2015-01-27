<?php
/*
 *	Arquivo  categorias.class.php
 *	Exibe todas as categorias cadastradas
 *	
 *	Sistema:	Doce___Bacana_Lingerie
 *	Autor:      Rogério Eduardo Pereira
 *	Data:       27/01/2015
 */

	/*
	 * Classe categorias.class.php
	 */
	class categorias 
	{
		/*
		 * Variaveis
		 */
		private $collectionCategoria;
		
		
		/*
		 * Getters e Setters
		 */
		function getCollectionCategoria()
		{
			return $this->collectionCategoria;
		}

		function setCollectionCategoria($collectionCategoria)
		{
			$this->collectionCategoria = $collectionCategoria;
		}

				
		
		/*
		 * Método Contrutor
		 */
		public function __construct()
		{
			$this->setCollectionCategoria((new controladorCategoria())->getCollectionCategoria());
		}
		
		/*
		 * Método show
		 * Exibe as informações na tela
		 */
		public function show()
		{
		?>
			<h1>Categorias</h1>
			<form class="formulario" name="ListaCategoria" method="post" onsubmit="">
				<input type="hidden" name="formularioNome" value="ListaCategoria">
				<table class='tabelaFormulario'>
					<!--Titulo-->
					<tr>
						<td align='center'>
							Alterar
						</td>
						<td align='center'>
							Nome
						</td>
						<td align='center'>
							Excluir
						</td>
					</tr>
					<tr>
						<td colspan='3'>
							<hr>
						</td>
					</tr>
					<!--Dados-->
					<?php
						foreach ($this->getCollectionCategoria() as $categoria)
							echo
								"
									<!--{$categoria->nome}-->
									<tr>
										<td align='center'>
											<input type='radio' name='radioCategoria' id='radioCategoria' value='{$categoria->codigo}'>
										</td>
										<td>
											{$categoria->nome}
										</td>
										<td align='center'>
											<input type='checkbox' name='categoriasApagar[]' class='chkCategoriasApagar' value='{$categoria->codigo}'>
										</td>
									</tr>
								";
					?>
					<tr>
						<td colspan='3'>
							<hr>
						</td>
					</tr>
					<!--Botões-->
					<tr>
						<td>
							<input type='button' value='Alterar' onclick='alteraCategoria()'>
						</td>
						<td>
							<input type='button' value='Cadastrar' onclick='novaCategoria()'>
						</td>
						<td>
						<?php
							if(count($this->getCollectionCategoria()) > 0)
								echo "<input type='button' value='Apagar' onclick='apagaCategorias()'>";
						?>
						</td>
					</tr>
				</table>
			</form>
		<?php
		}
	}

?>