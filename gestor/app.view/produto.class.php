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
		private $collectionCores;
		private $collectionCategoria;
		private $collectionCoresDefinidas;
		private $comboCores;
		
		
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
		function getCollectionCores()
		{
			return $this->collectionCores;
		}

		function setCollectionCores($collectionCores)
		{
			$this->collectionCores = $collectionCores;
		}

		function getCollectionCoresDefinidas()
		{
			return $this->collectionCoresDefinidas;
		}

		function setCollectionCoresDefinidas($collectionCoresDefinidas)
		{
			$this->collectionCoresDefinidas = $collectionCoresDefinidas;
		}

						
				
		/*
		 * Método Contrutor
		 */
		public function __construct()
		{
			$this->setProduto((new controladorProdutos())->getProduto($_GET['cod']));
			$this->setCollectionCores((new controladorProdutos())->getCollectionProdutosCores($_GET['cod']));
			$this->setCollectionCategoria((new controladorCategoria())->getCollectionCategoria());
			$this->setCollectionCoresDefinidas((new controladorProdutos())->getCollectionCores());
			
			$this->comboCores	= "<select id='coresDefinidas' class='campo #numero#' onchange='selecionaCorDefinida(#numero#)'>";
			$this->comboCores	.= "<option value='' selected></option>";
			//Cria o combobox de cores
			foreach ($this->collectionCoresDefinidas as $corDefinida)
			{
				$this->comboCores	.= "<option value='{$corDefinida->codigo}'>{$corDefinida->nome}</option>";
			}
			$this->comboCores	.= "</select>";
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
				<form class="formulario" name="salvaProduto" enctype="multipart/form-data" method="post" action='/app.control/ajaxUpload.php'>
				<!--<form class="formulario" name="salvaProduto" id='salvaProduto' enctype="multipart/form-data" method="post" onsubmit="validaProduto()">-->
					<input type="hidden" name="formularioNome"	value="salvaProduto">
					<input type="hidden" name="numeroCor"		id='numeroCor'	value="<?php echo count($this->getCollectionCores()); ?>">
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
												echo "<option value='{$categoria->codigo}' selected>{$categoria->nome}</option>";
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
								<textarea rows='3' class='campo' name='descricao' id='descricao' maxlength="150" placeholder='Descrição'><?php echo $this->getProduto()->descricao; ?></textarea>
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
								<textarea class='campo' name='caracteristicas' id='caracteristicas' placeholder='Caracteristicas'><?php echo $this->getProduto()->caracteristicas; ?></textarea>
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
								<?php 
									if($this->getProduto() == NULL)
									{
										?>
										<input type='checkbox' name='tamanhoPP' id='tamanhoPP'	class='chkTamanhoPP'	value='1'>PP
										<input type='checkbox' name='tamanhoP'	id='tamanhoP'	class='chkTamanhoP'		value='1'	checked>P
										<input type='checkbox' name='tamanhoM'	id='tamanhoM'	class='chkTamanhoM'		value='1'	checked>M
										<input type='checkbox' name='tamanhoG'	id='tamanhoG'	class='chkTamanhoG'		value='1'	checked>G
										<input type='checkbox' name='tamanhoGG' id='tamanhoGG'	class='chkTamanhoGG'	value='1'	checked>GG
										<input type='checkbox' name='tamanho48' id='tamanho48'	class='chkTamanho48'	value='1'>48
										<input type='checkbox' name='tamanho50' id='tamanho50'	class='chkTamanho50'	value='1'>50
										<input type='checkbox' name='tamanho52' id='tamanho52'	class='chkTamanho52'	value='1'>52
										<input type='checkbox' name='tamanho54' id='tamanho54'	class='chkTamanho54'	value='1'>54
										<?php
									}
									else
									{
										//Tamanho PP
										if($this->getProduto()->tamanhoPP == 1)
											echo "<input type='checkbox' name='tamanhoPP' id='tamanhoPP'	class='chkTamanhoPP'	value='1'	checked>PP";
										else
											echo "<input type='checkbox' name='tamanhoPP' id='tamanhoPP'	class='chkTamanhoPP'	value='1'>PP";
										
										//Tamanho P
										if($this->getProduto()->tamanhoP == 1)
											echo "<input type='checkbox' name='tamanhoP' id='tamanhoP'	class='chkTamanhoP'	value='1'	checked>P";
										else
											echo "<input type='checkbox' name='tamanhoP' id='tamanhoP'	class='chkTamanhoP'	value='1'>P";
										
										//Tamanho M
										if($this->getProduto()->tamanhoM == 1)
											echo "<input type='checkbox' name='tamanhoM' id='tamanhoM'	class='chkTamanhoM'	value='1'	checked>M";
										else
											echo "<input type='checkbox' name='tamanhoM' id='tamanhoM'	class='chkTamanhoM'	value='1'>M";
										
										//Tamanho G
										if($this->getProduto()->tamanhoG == 1)
											echo "<input type='checkbox' name='tamanhoG' id='tamanhoG'	class='chkTamanhoG'	value='1'	checked>G";
										else
											echo "<input type='checkbox' name='tamanhoG' id='tamanhoG'	class='chkTamanhoG'	value='1'>G";
										
										//Tamanho GG
										if($this->getProduto()->tamanhoGG == 1)
											echo "<input type='checkbox' name='tamanhoGG' id='tamanhoGG'	class='chkTamanhoGG'	value='1'	checked>GG";
										else
											echo "<input type='checkbox' name='tamanhoGG' id='tamanhoGG'	class='chkTamanhoGG'	value='1'>GG";
										
										//Tamanho 48
										if($this->getProduto()->tamanho48 == 1)
											echo "<input type='checkbox' name='tamanho48' id='tamanho48'	class='chkTamanho48'	value='1'	checked>48";
										else
											echo "<input type='checkbox' name='tamanho48' id='tamanho48'	class='chkTamanho48'	value='1'>48";
										
										//Tamanho 50
										if($this->getProduto()->tamanho50 == 1)
											echo "<input type='checkbox' name='tamanho50' id='tamanho50'	class='chkTamanho50'	value='1'	checked>50";
										else
											echo "<input type='checkbox' name='tamanho50' id='tamanho50'	class='chkTamanho50'	value='1'>50";
										
										//Tamanho 52
										if($this->getProduto()->tamanho52 == 1)
											echo "<input type='checkbox' name='tamanho52' id='tamanho52'	class='chkTamanho52'	value='1'	checked>52";
										else
											echo "<input type='checkbox' name='tamanho52' id='tamanho52'	class='chkTamanho52'	value='1'>52";
										
										//Tamanho 54
										if($this->getProduto()->tamanho54 == 1)
											echo "<input type='checkbox' name='tamanho54' id='tamanho54'	class='chkTamanho54'	value='1'	checked>54";
										else
											echo "<input type='checkbox' name='tamanho54' id='tamanho54'	class='chkTamanho54'	value='1'>54";
									}
								?>
							</td>
						</tr>
						<tr>
							<td colspan='2'>
								<hr>
							</td>
						</tr>
						</table>
					<table class='corSalva'>
							<!--Cor-->
							<?php
								$numeroCor = 1;
								foreach ($this->getCollectionCores() as $cor)
								{
									echo
									"	<tr>																														" .
									"		<td>																													" .
									"			Nome																												" .
									"			<input type='hidden' name='corSalva_".$numeroCor."' id='corSalva_".$numeroCor."'	value='1'>						" .
									"		</td>																													" .
									"		<td>																													" .
									"			<input																												" .
									"				type='text'																										" .
									"				class='campo'																									" .
									"				name='nomeCor_".$numeroCor."'																					" .
									"				id='nomeCor_".$numeroCor."'																						" .
									"				placeholder='Nome'																								" .
									"				maxlength='20'																									" .
									"				value='{$cor->nome}'																							" .
									"				disabled																										" .
									"			/>																													" .
									"		</td>																													" .
									"	</tr>																														" .
									"	<tr>																														" .
									"		<td>																													" .
									"			Cor 1																												" .
									"		</td>																													" .
									"		<td>																													" .
									"			<input																												" .
									"				type='color'																									" .
									"				class='campo cor_'.$numeroCor.'																					" .
									"				name='cor1_''.$numeroCor.																						" .
									"				id='cor1_'.$numeroCor.'																							" .
									"				placeholder='Cor 1'																								" .
									"				value='{$cor->cor1}'																							" .
									"				onchange=\"alteraCor('cor_.$numeroCor.', this.value)\"															" .
									"				disabled																										" .
									"			>																													" .
									"		</td>																													" .
									"	</tr>																														" .
									"	<tr>																														" .
									"		<td>																													" .
									"			Cor 2																												" .
									"		</td>																													" .
									"		<td>																													" .
									"			<input																												" .
									"				type='color'																									" .
									"				class='campo cor_'.$numeroCor.'																					" .
									"				name='cor2_'.$numeroCor.'																						" .
									"				id='cor2_'.$numeroCor.'																							" .
									"				placeholder='Cor 1'																								" .
									"				value='{$cor->cor2}'																							" .
									"				disabled																										" .
									"			>																													" .
									"		</td>																													" .
									"	</tr>																														" .
									"	<tr>																														" .
									"		<td>																													" .
									"			Banner																												" .
									"		</td>																													" .
									"		<td>																													";

									/*//Banner 1
									if($cor->banner1 == 1)
										echo "<input type='checkbox' name='banner1_'.$numeroCor.'	class='chkBanner1_'.$numeroCor.'	value='1' checked disabled>Banner 1<br>";
									else
										echo "<input type='checkbox' name='banner1_'.$numeroCor.'	class='chkBanner1_'.$numeroCor.'	value='1' disabled>Banner 1<br>";

									//Banner2
									if($cor->banner2 == 1)
										echo "<input type='checkbox' name='banner2_'.$numeroCor.'	class='chkBanner2_'.$numeroCor.'	value='1' checked disabled>Banner 2<br>";
									else
										echo "<input type='checkbox' name='banner2_'.$numeroCor.'	class='chkBanner2_'.$numeroCor.'	value='1' disabled>Banner 2<br>";

									//Banner3
									if($cor->banner3 == 1)
										echo "<input type='checkbox' name='banner3_'.$numeroCor.'	class='chkBanner3_'.$numeroCor.'	value='1' checked disabled>Banner 3<br>";
									else
										echo "<input type='checkbox' name='banner3_'.$numeroCor.'	class='chkBanner3_'.$numeroCor.'	value='1' disabled>Banner 3<br>";*/

									//Home
									if($cor->home == 1)
										echo "<input type='checkbox' name='home_'.$numeroCor.'	class='chkHome_'.$numeroCor.'	value='1' checked disabled>Home<br>";
									else
										echo "<input type='checkbox' name='home_'.$numeroCor.'	class='chkHome_'.$numeroCor.'	value='1' disabled>Home<br>";

									echo
									"		</td>																														" .
									"	</tr>																															" .
									"	<tr>																															" .
									"		<td>																														" .
									"			Foto																													" .
									"		</td>																														" .
									"		<td>																														" .
									"			<img																													" .
									"				src='http://www.docebacanalingerie.com.br/app.view/img/produtos/thumbs/{$this->getProduto()->codigo}_{$cor->codigo}.jpg'		" .
									"				alt='{$cor->nome}'																									" .
									"				title='{$cor->nome}'																								" .
									"			>																														" .
									"		</td>																														" .
									"	</tr>																															" .
									"		</td>																														" .
									"	</tr>																															" .
									"	<tr>																															" .
									"		<td colspan='2' align='center'>																								" .
									"			<input																													" .
									"				name='botaoRemoverCor'																								" .
									"				type='button'																										" .
									"				id='botaoRemoverCor'																								" .
									"				value='Remover Cor'																									" .
									"				onclick='removeCor({$this->getProduto()->codigo}, {$cor->codigo})'													" .
									"			/>																														" .
									"		</td>																														" .
									"	</tr>																															" .
									"	<tr> <td colspan='2'><hr></td></tr>																								";

									$numeroCor++;
								}
							?>	
					</table>
					<table>
						<div id='produtoCor'>
							
						</div>
					</table>
					<table style="position: relative; width: 100%;">
						<tr>
							<td colspan='2' align='center'>
								<input name="botaoInserirCor" type="button" id="botaoInserirCor" value="Inserir Cor" onclick="insereCor()"/>
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
			<div class='divCores' style='visibility: hidden'>
				<?php
					echo $this->comboCores;
				?>
			</div>
		<?php
		}
	}

?>