<?php
/*
 *	Arquivo  produto.class.php
 *	Cadastro/Alteração de Produto
 *	
 *	Sistema:	Doce___Bacana_Lingerie
 *	Autor:      Rogério Eduardo Pereira
 *	Data:       28/01/2015
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
		private $collectionCategoria;
		
		
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
			$this->setProduto((new controladorProdutos())->getProduto($_GET['cod']));
			$this->setCollectionCategoria((new controladorCategoria())->getCollectionCategoria());
		}
		
		/*
		 * Método show
		 * Exibe as informações na tela
		 */
		public function show()
		{
		?>
			<h1>Produto</h1>
			<!--Hack para centralizar os botões das tabelas-->
			<div style='position: absolute;'>
				<!--<form class="formulario" name="salvaProduto" enctype="multipart/form-data" method="post" action='/app.control/ajax.php'>-->
				<form class="formulario" name="salvaProduto" enctype="multipart/form-data" method="post" onsubmit="validaProduto()">
					<input type="hidden" name="formularioNome"	value="salvaProduto">
					<input type="hidden" name="numeroCor"		id='numeroCor'	value="0">
					<input type="hidden" name="codigo"			id='codigo'		value="<?php echo $this->getProduto()->codigo; ?>">
					<table class='tabelaFormulario'>
						<tr>
							<td colspan='2'>
								<hr>
							</td>
						</tr>
						<!--Referencia-->
						<tr>
							<td>
								Referência
							</td>
							<td>
								<input type='text' class='campo' name='referencia' id='referencia' placeholder='Referência' maxlength='20' value="<?php echo $this->getProduto()->referencia?>">
							</td>
						</tr>
						<!--Categoria-->
						<tr>
							<td>
								Categoria
							</td>
							<td>
								<select class='campo' name='categoria' id='categoria'>
									<option value='' disabled selected label>Estados</option>
									<?php
										foreach ($this->getCollectionCategoria() as $categoria)
										{
											if($this->getProduto()->categoria == $categoria->codigo)
												echo "<option value='{$categoria->codigo}' checked>{$categoria->nome}</option>";
											else
												echo "<option value='{$categoria->codigo}'>{$categoria->nome}</option>";
										}
									?>
								</select>
							</td>
						</tr>
						<!--Descrição-->
						<tr>
							<td>
								Descrição
							</td>
						</tr>
						<tr>
							<td colspan='2'>
								<textarea rows='3' class='campo' name='descricao' id='descricao' maxlength="150" placeholder='Descrição'></textarea>
							</td>
						</tr>
						<!--Caracteristicas-->
						<tr>
							<td colspan='2'>
								Caracteristicas
							</td>
						</tr>
						<tr>
							<td colspan='2'>
								<textarea class='campo' name='caracteristicas' id='caracteristicas' placeholder='Caracteristicas'></textarea>
							</td>
						</tr>
						<tr>
							<td colspan='2'>
								<hr>
							</td>
						</tr>
						<!--Tamanhos-->
						<tr>
							<td>
								Tamanhos
							</td>
							<td>
								<input type='checkbox' name='tamanhoPP' id='tamanhoPP'	class='chkTamanhoPP'	value='1'>PP
								<input type='checkbox' name='tamanhoP'	id='tamanhoP'	class='chkTamanhoP'		value='1'	checked>P
								<input type='checkbox' name='tamanhoM'	id='tamanhoM'	class='chkTamanhoM'		value='1'	checked>M
								<input type='checkbox' name='tamanhoG'	id='tamanhoG'	class='chkTamanhoG'		value='1'	checked>G
								<input type='checkbox' name='tamanhoGG' id='tamanhoGG'	class='chkTamanhoGG'	value='1'	checked>GG
								<input type='checkbox' name='tamanho48' id='tamanho48'	class='chkTamanho48'	value='1'>48
								<input type='checkbox' name='tamanho50' id='tamanho50'	class='chkTamanho50'	value='1'>50
								<input type='checkbox' name='tamanho52' id='tamanho52'	class='chkTamanho52'	value='1'>52
								<input type='checkbox' name='tamanho54' id='tamanho54'	class='chkTamanho54'	value='1'>54
							</td>
						</tr>
						<tr>
							<td colspan='2'>
								<hr>
							</td>
						</tr>
						<!--Cor-->
					</table>
					<table>
						<div id='produtoCor'>

						</div>
					</table>
					<table style="position: relative; width: 100%;">
						<tr>
							<td colspan='2' align='center'>
								<input name="botaoInserirCor" type="button" id="botaoInserirCor" value="Inserir Cor" onclick='insereCor()'/>
							</td>
						</tr>
						<tr>
							<td colspan='2'>
								<hr>
							</td>
						</tr>
						<tr>
							<td colspan='2' align='center'>
								<input name="botaoSalvar" type="submit" id="botaoSalvar" value="Salvar" />
							</td>
						</tr>
					</table>
				</form>
			</div>
			<script>
				iniciaTextArea();
			</script>
		<?php
		}
	}

?>