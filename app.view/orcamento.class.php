<?php
/*
 *	Arquivo  orcamento.class.php
 *	Faz o orçamento
 *	
 *	Sistema:	Doce___Bacana_Lingerie
 *	Autor:      Rogério Eduardo Pereira
 *	Data:       07/02/2015
 */

	/*
	 * Classe orcamento.class.php
	 */
	class orcamento 
	{
		/*
		 * Variaveis
		 */
		
		
		/*
		 * Getters e Setters
		 */
		
		
		/*
		 * Método Contrutor
		 */
		public function __construct()
		{
			
		}
		
		/*
		 * Método show
		 * Exibe as informações na tela
		 */
		public function show()
		{
			//$_SESSION['orcamento'] = NULL;
			//$_SESSION['produtosOrcamento'] = NULL;
			//var_dump($_SESSION['orcamento']);
			//var_dump($_SESSION['produtosOrcamento']);
		?>
			<!--<h1>Orçamento</h1>
			<hr>-->
			<form class="formulario" name="orcamento" method="post" action="app.control/ajax.php" onsubmit="enviaOrcamento">
				<input type="hidden" name="formularioNome" value="enviaOrcamento">
				<table class='tabelaFormulario'>
					<tr>
						<td colspan='10'>
							<strong>Preencha a grade com a quantidade desejada de cada produto. Você ainda pode adicionar outras 
							referências clicando em "Incluir nova Referência", quando incluir todas as referências desejadas
							e ter preenchido a grade com a quantidade que deseja, clique em "Enviar Orçamento" que está no 
							final da página.</strong>
						</td>
					</tr>
					<tr><td colspan='10'><hr></td></tr>
					<tr><td colspan='10' align='center' style='font-size: 1.3em;'><input type='button' value='Incluir nova referência' onclick="top.location='/';"></td></tr>
					<tr><td colspan='10'><hr></td></tr>
					<?php
						if(count($_SESSION['produtosOrcamento']) > 0)
						{
							$i = 0;
							$codigoAnterior = '';
							$codigoAtual	= '';
							foreach($_SESSION['produtosOrcamento'] as $produto)
							{
								$codigoAnterior = $codigoAtual;
								$codigoAtual	= $produto['codigoProduto'];
								
								if($i>0)
								{
									if($codigoAnterior != $codigoAtual)
										echo 
											"
												<tr>
													<td colspan='10' align='center' style='font-size: 1.3em;'>
														<input type='button' value='Excluir do orçamento' onclick='removeOrcamento($codigoAnterior)'>
													</td>
												</tr>
												<tr><td colspan='10'><hr></td></tr>
											";
								}
								
								if($codigoAnterior != $codigoAtual)
									echo	
										"
											<tr>
												<td colspan='10' align='center' style='font-size: 1.3em;'>
													<strong>{$produto['referencia']}<strong>
												</td>
											</tr>
										";
								
								echo
									"
										<tr>
											<td>
												
											</td>
											<td>
												Tamanho PP
											</td>

											<td>
												Tamanho P
											</td>

											<td>
												Tamanho M
											</td>

											<td>
												Tamanho G
											</td>

											<td>
												Tamanho GG
											</td>

											<td>
												Tamanho 48
											</td>

											<td>
												Tamanho 50
											</td>

											<td>
												Tamanho 52
											</td>
											<td>
												Tamanho 54
											</td>
										</tr>
									";
									
								
								echo 
									"
										<tr>
											<td align='center'>
												<img src='/app.view/img/produtos/thumbs/{$produto['codigoProduto']}_{$produto['codigoCor']}.jpg'><br>
											</td>
									";
								//Campo PP
								if($produto['campoPP'] == true)
									echo 
										"
											<td>
												<input 
													type='number' 
													class='campoOrcamento integer {$produto['codigoCor']} quantidadePP' 
													name='quantidadePP_{$produto['codigoCor']}' 
													id='quantidadePP_{$produto['codigoCor']}' 
													min='0' 
													value='{$produto['quantidadePP']}'
													onchanche='alteraQuantidade(this, {$produto['codigoCor']})'
												>
											</td>
										";
								else
									echo 
										"
											<td>
												<input 
													type='number' 
													class='campoOrcamento integer {$produto['codigoCor']} quantidadePP' 
													name='quantidadePP_{$produto['codigoCor']}' 
													id='quantidadePP_{$produto['codigoCor']}' 
													min='0' 
													onchanche='alteraQuantidade(this, {$produto['codigoCor']})'
													disabled
												>
											</td>
										";

								//Campo P
								if($produto['campoP'] == true)
									echo 
										"
											<td>
												<input 
													type='number' 
													class='campoOrcamento integer {$produto['codigoCor']} quantidadeP' 
													name='quantidadeP_{$produto['codigoCor']}' 
													id='quantidadeP_{$produto['codigoCor']}' 
													min='0' 
													value='{$produto['quantidadeP']}'
													onchanche='alteraQuantidade(this, {$produto['codigoCor']})'
												>
											</td>
										";
								else
									echo 
										"
											<td>
												<input 
													type='number' 
													class='campoOrcamento integer {$produto['codigoCor']} quantidadeP' 
													name='quantidadeP_{$produto['codigoCor']}' 
													id='quantidadeP_{$produto['codigoCor']}' 
													min='0' 
													onchanche='alteraQuantidade(this, {$produto['codigoCor']})'
													disabled
												>
											</td>
										";

								//Campo M
								if($produto['campoM'] == true)
									echo 
										"
											<td>
												<input 
													type='number' 
													class='campoOrcamento integer {$produto['codigoCor']} quantidadeM' 
													name='quantidadeM_{$produto['codigoCor']}' 
													id='quantidadeM_{$produto['codigoCor']}' 
													min='0' 
													value='{$produto['quantidadeM']}'
													onchanche='alteraQuantidade(this, {$produto['codigoCor']})'
												>
											</td>
										";
								else
									echo 
										"
											<td>
												<input 
													type='number' 
													class='campoOrcamento integer {$produto['codigoCor']} quantidadeM' 
													name='quantidadeM_{$produto['codigoCor']}' 
													id='quantidadeM_{$produto['codigoCor']}' 
													min='0' 
													onchanche='alteraQuantidade(this, {$produto['codigoCor']})'
													disabled
												>
											</td>
										";

								//Campo G
								if($produto['campoG'] == true)
									echo 
										"
											<td>
												<input 
													type='number' 
													class='campoOrcamento integer {$produto['codigoCor']} quantidadeG' 
													name='quantidadeG_{$produto['codigoCor']}' 
													id='quantidadeG_{$produto['codigoCor']}' 
													min='0' 
													value='{$produto['quantidadeG']}'
													onchanche='alteraQuantidade(this, {$produto['codigoCor']})'
												>
											</td>
										";
								else
									echo 
										"
											<td>
												<input 
													type='number' 
													class='campoOrcamento integer {$produto['codigoCor']} quantidadeG' 
													name='quantidadeG_{$produto['codigoCor']}' 
													id='quantidadeG_{$produto['codigoCor']}' 
													min='0' 
													onchanche='alteraQuantidade(this, {$produto['codigoCor']})'
													disabled
												>
											</td>
										";					

								//Campo GG
								if($produto['campoGG'] == true)
									echo 
										"
											<td>
												<input 
													type='number' 
													class='campoOrcamento integer {$produto['codigoCor']} quantidadeGG' 
													name='quantidadeGG_{$produto['codigoCor']}' 
													id='quantidadeGG_{$produto['codigoCor']}' 
													min='0' 
													value='{$produto['quantidadeGG']}'
													onchanche='alteraQuantidade(this, {$produto['codigoCor']})'
												>
											</td>
										";
								else
									echo 
										"
											<td>
												<input 
													type='number' 
													class='campoOrcamento integer {$produto['codigoCor']} quantidadeGG' 
													name='quantidadeGG_{$produto['codigoCor']}' 
													id='quantidadeGG_{$produto['codigoCor']}' 
													min='0' 
													onchanche='alteraQuantidade(this, {$produto['codigoCor']})'
													disabled
												>
											</td>
										";	

								//Campo 48
								if($produto['campo48'] == true)
									echo 
										"
											<td>
												<input 
													type='number' 
													class='campoOrcamento integer {$produto['codigoCor']} quantidade48' 
													name='quantidade48_{$produto['codigoCor']}' 
													id='quantidade48_{$produto['codigoCor']}' 
													min='0' 
													value='{$produto['quantidade48']}'
													onchanche='alteraQuantidade(this, {$produto['codigoCor']})'
												>
											</td>
										";
								else
									echo 
										"
											<td>
												<input 
													type='number' 
													class='campoOrcamento integer {$produto['codigoCor']} quantidade48' 
													name='quantidade48_{$produto['codigoCor']}' 
													id='quantidade48_{$produto['codigoCor']}' 
													min='0' 
													onchanche='alteraQuantidade(this, {$produto['codigoCor']})'
													disabled
												>
											</td>
										";		

								//Campo 50
								if($produto['campo50'] == true)
									echo 
										"
											<td>
												<input 
													type='number' 
													class='campoOrcamento integer {$produto['codigoCor']} quantidade50' 
													name='quantidade50_{$produto['codigoCor']}' 
													id='quantidade50_{$produto['codigoCor']}' 
													min='0' 
													value='{$produto['quantidade50']}'
													onchanche='alteraQuantidade(this, {$produto['codigoCor']})'
												>
											</td>
										";
								else
									echo 
										"
											<td>
												<input 
													type='number' 
													class='campoOrcamento integer {$produto['codigoCor']} quantidade50' 
													name='quantidade50_{$produto['codigoCor']}' 
													id='quantidade50_{$produto['codigoCor']}' 
													min='0' 
													onchanche='alteraQuantidade(this, {$produto['codigoCor']})'
													disabled
												>
											</td>
										";	

								//Campo 52
								if($produto['campo52'] == true)
									echo 
										"
											<td>
												<input 
													type='number' 
													class='campoOrcamento integer {$produto['codigoCor']} quantidade52' 
													name='quantidade52_{$produto['codigoCor']}' 
													id='quantidade52_{$produto['codigoCor']}' 
													min='0' 
													value='{$produto['quantidade52']}'
													onchanche='alteraQuantidade(this, {$produto['codigoCor']})'
												>
											</td>
										";
								else
									echo 
										"
											<td>
												<input 
													type='number' 
													class='campoOrcamento integer {$produto['codigoCor']} quantidade52' 
													name='quantidade52_{$produto['codigoCor']}' 
													id='quantidade52_{$produto['codigoCor']}' 
													min='0' 
													onchanche='alteraQuantidade(this, {$produto['codigoCor']})'
													disabled
												>
											</td>
										";	

								//Campo 54
								if($produto['campo54'] == true)
									echo 
										"
											<td>
												<input 
													type='number' 
													class='campoOrcamento integer {$produto['codigoCor']} quantidade54' 
													name='quantidade54_{$produto['codigoCor']}' 
													id='quantidade54_{$produto['codigoCor']}' 
													min='0' 
													value='{$produto['quantidade54']}'
													onchanche='alteraQuantidade(this, {$produto['codigoCor']})'
												>
											</td>
										";
								else
									echo 
										"
											<td>
												<input 
													type='number' 
													class='campoOrcamento integer {$produto['codigoCor']} quantidade54'  
													name='quantidade54_{$produto['codigoCor']}' 
													id='quantidade54_{$produto['codigoCor']}' 
													min='0' 
													onchange='alteraQuantidade(this, {$produto['codigoCor']})'
													disabled
												>
											</td>
										";		
								echo 
									"
										</tr>
									";

								$i++;
							}
							echo 
								"
									<tr>
										<td colspan='10' align='center' style='font-size: 1.3em;'>
											<input type='button' value='Excluir do orçamento' onclick='removeOrcamento($codigoAnterior)'>
										</td>
									</tr>
								";
							echo "<tr><td colspan='10'><hr></td></tr>";
							echo "<tr><td colspan='10' align='center' style='font-size: 1.3em;'><input type='submit' value='Enviar Orçamento'></td></tr>";
						}
						else
							echo 'Ainda não há nenhum produto em orçamento';
					?>
				</table>
			</form>
			<script>
				$(".integer").numeric(false, function() 
				{ 
					alert("Insira somente números!"); 
					this.value = ""; 
					this.focus(); 
				});
				
				$(".campoOrcamento").bind('keyup mouseup', function () 
				{
					alteraQuantidade(this)
				});
			</script>
		<?php
		}
	}

?>