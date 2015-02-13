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
	class meuOrcamento 
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
			$this->setOrcamento((new controladorOrcamento())->getOrcamento($_GET['cod']));
			$this->setCollectionOrcamentoProdutos((new controladorOrcamento())->getCollectionOrcamentosProdutos($_GET['cod']));
		}
		
		/*
		 * Método show
		 * Exibe as informações na tela
		 */
		public function show()
		{
		?>
			<!--<h1>Orçamento</h1>
			<hr>-->
			<h2>Orçamento <?php echo $this->getOrcamento()->codigo; ?></h2>
			<?php
				echo
					"
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
							<strong>Status</strong>
						</td>
						<td>
							<?php
								if($this->orcamento->status == 0)
									echo "Aberto";
								else if($this->orcamento->status == 1)
									echo "Realizando Orçamento";
								else if($this->orcamento->status == 2)
									echo "Aguardando Cliente";
								else if($this->orcamento->status == 3)
									echo "Aguardando Pagamento";
								else if($this->orcamento->status == 4)
									echo "Postado no Correio";
								else if($this->orcamento->status == 4)
									echo "Entregue";
							?>
						</td>
					</tr>
					<?php
						if(($this->getOrcamento()->codigoCorreio != NULL) || ($this->getOrcamento()->codigoCorreio != ''))
							echo
								"
									<tr>
										<td>
											<strong>Código de Rastreio</strong>
										</td>
										<td>
											{$this->getOrcamento()->codigoCorreio}
										</td>
									</tr>
								";
					?>
				</table>
			</form>
		<?php
		}
	}

?>