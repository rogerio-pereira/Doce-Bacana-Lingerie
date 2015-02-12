<?php
/*
 *	Arquivo  orcamento.class.php
 *	Exibe o orcamento individual
 *	
 *	Sistema:	Doce___Bacana_Lingerie
 *	Autor:      Rogério Eduardo Pereira
 *	Data:       12/02/2015
 */

	/*
	 * Classe orcamento.class.php
	 */
	class orcamento 
	{
		/*
		 * Variaveis
		 */
		private $orcamento;
		private $collectionOrcamentoProdutos;
		private $cliente;
		
		
		/*
		 * Getters e Setters
		 */
		function getOrcamento()
		{
			return $this->orcamento;
		}

		function getCollectionOrcamentoProdutos()
		{
			return $this->collectionOrcamentoProdutos;
		}

		function setOrcamento($orcamento)
		{
			$this->orcamento = $orcamento;
		}

		function setCollectionOrcamentoProdutos($collectionOrcamentoProdutos)
		{
			$this->collectionOrcamentoProdutos = $collectionOrcamentoProdutos;
		}
		
		function getCliente()
		{
			return $this->cliente;
		}

		function setCliente($cliente)
		{
			$this->cliente = $cliente;
		}

		
						
		
		/*
		 * Método Contrutor
		 */
		public function __construct()
		{
			$this->setOrcamento((new controladorOrcamentos())->getOrcamento($_GET['cod']));
			$this->setCliente((new controladorClientes())->getCliente($this->getOrcamento()->cliente));
			$this->setCollectionOrcamentoProdutos((new controladorOrcamentos())->getCollectionOrcamentosProdutos($_GET['cod']));
		}
		
		/*
		 * Método show
		 * Exibe as informações na tela
		 */
		public function show()
		{
		?>
			<h1>Orçamento</h1>
			<hr>
			<h2>Orçamento <?php echo $this->getOrcamento()->codigo; ?></h2>
			<strong>Dados do Cliente</strong>
			<?php
				echo
					"
						<p>
							<strong>Nome:</strong>		{$this->getCliente()->nome}<br>
							<strong>Telefone:</strong>	{$this->getCliente()->telefone}<br>
							<strong>Celular:</strong>	{$this->getCliente()->celular}<br>
							<strong>E-Mail:</strong>	{$this->getCliente()->email}<br>
							<strong>Endereço:</strong>	{$this->getCliente()->endereco} , 
														{$this->getCliente()->numero}. 
														{$this->getCliente()->complemento}<br>
							<strong>Bairro:</strong>	{$this->getCliente()->bairro}<br>
							<strong>Cidade:</strong>	{$this->getCliente()->cidade} - 
														{$this->getCliente()->estado}<br>
							<strong>CEP:</strong>		{$this->getCliente()->cep}
						</p>
						
						<hr>
										
						<p>
							<strong>Orçamento</strong>
						</p>
						
						<table>
							<tr>
								<td style='padding: 0 10px 0 0px;'>		<strong>Referencia</strong>		</td>
								<td style='padding: 0 10px 0 0px'>		<strong>Cor</strong>			</td>
								<td style='padding: 0 10px 0 10px'>		<strong>PP</strong>				</td>
								<td style='padding: 0 10px 0 10px'>		<strong>P</strong>				</td>
								<td style='padding: 0 10px 0 10px'>		<strong>M</strong>				</td>
								<td style='padding: 0 10px 0 10px'>		<strong>G</strong>				</td>
								<td style='padding: 0 10px 0 10px'>		<strong>GG</strong>				</td>
								<td style='padding: 0 10px 0 10px'>		<strong>48</strong>				</td>
								<td style='padding: 0 10px 0 10px'>		<strong>50</strong>				</td>
								<td style='padding: 0 10px 0 10px'>		<strong>52</strong>				</td>
								<td style='padding: 0 10px 0 10px'>		<strong>54</strong>				</td>
							</tr>
					";
				
				foreach($this->collectionOrcamentoProdutos as $produto)
				{
					echo 
						"
							<tr>
								<td>					$produto->referencia						</td>
								<td>					$produto->nome								</td>
								<td align='center'>		$produto->quantidadePP						</td>
								<td align='center'>		<strong>$produto->quantidadeP</strong>		</td>
								<td align='center'>		<strong>$produto->quantidadeM</strong>		</td>
								<td align='center'>		<strong>$produto->quantidadeG</strong>		</td>
								<td align='center'>		<strong>$produto->quantidadeGG</strong>		</td>
								<td align='center'>		$produto->quantidade48						</td>
								<td align='center'>		$produto->quantidade50						</td>
								<td align='center'>		$produto->quantidade52						</td>
								<td align='center'>		$produto->quantidade54						</td>	
							<tr>
						";
				}
							
				echo 
					"
						</table>
										
						<hr>
					";
			?>
			<form class="formulario" name="alteraOrcamento" method="post" onsubmit='atualizaOrcamento()'>
				<input type="hidden" name="formularioNome"	value="alteraOrcamento">
				<input type="hidden" name="codigo"			id='codigo'		value="<?php echo $this->getOrcamento()->codigo; ?>">
				<table class='tabelaFormulario'>
					<tr>
						<td>
							Status
						</td>
						<td>
							<select class='campo' name='status' id='status'>
								<option value='' disabled label>	Status					</option>
								<option value='0'>					Aberto					</option>
								<option value='1'>					Realizando Orçamento	</option>
								<option value='2'>					Aguardando Cliente		</option>
								<option value='3'>					Aguardando Pagamento	</option>
								<option value='4'>					Postado no Correio		</option>
								<option value='5'>					Entregue				</option>
							</select>
							<script>
								//Seleciona o valor 
								$("#status").val("<?php echo $this->orcamento->status; ?>");
							</script>
						</td>
					</tr>
					<tr>
						<td>
							Código de Rastreio
						</td>
						<td>
							<input 
								type='text' 
								class='campo' 
								name='codigoRastreio' 
								id='codigoRastreio' 
								placeholder='Código de Rastreio' 
								maxlength='30' 
								value="<?php echo $this->getOrcamento()->codigoCorreio; ?>"
							>
						</td>
					</tr>
					<tr>
						<td colspan="2" align='center'>
							<input name="botaoAtualizar" type="submit" id="botaoAtualizar" value="Atualizar" />
						</td>
					</tr>
				</table>
			</form>
		<?php
		}
	}

?>