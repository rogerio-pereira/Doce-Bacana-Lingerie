<?php
/*
 *	Arquivo  orcamentos.class.php
 *	Exibe os Orçamentos cadastrados
 *	
 *	Sistema:	Doce___Bacana_Lingerie
 *	Autor:      Rogério Eduardo Pereira
 *	Data:       12/02/2015
 */

	/*
	 * Classe orcamentos.class.php
	 */
	class meusOrcamentos 
	{
		/*
		 * Variaveis
		 */
		private $collectionOrcamento;
		
		
		/*
		 * Getters e Setters
		 */
		function getCollectionOrcamento()
		{
			return $this->collectionOrcamento;
		}

		function setCollectionOrcamento($collectionOrcamento)
		{
			$this->collectionOrcamento = $collectionOrcamento;
		}

				

				
		/*
		 * Método Contrutor
		 */
		public function __construct()
		{
			$this->setCollectionOrcamento((new controladorOrcamento())->getCollectionOrcamentos());
		}
		
		/*
		 * Método show
		 * Exibe as informações na tela
		 */
		public function show()
		{
		?>
			<!--<h1>Orçamentos</h1><hr>-->
			<form class="formulario" name="listaOrcamentos" method="post">
				<input type="hidden" name="formularioNome" value="listaOrcamentos">
				<table class='tabelaFormulario'>
					<!--Titulo-->
					<tr>
						<td align='center'>
							Selecionar
						</td>
						<td align='center'>
							Cliente
						</td>
						<td align='center'>
							Data e Hora
						</td>
						<td align='center'>
							Quantidade de itens
						</td>
						<td>
							Status
						</td>
					</tr>
					<tr>
						<td colspan='5'>
							<hr>
						</td>
					</tr>
					<?php
						foreach($this->getCollectionOrcamento() as $orcamento)
						{
							
							$data = $this->converteData($orcamento->dataHora);
							
							if($orcamento->status == 0)
								$status = 'Aberto';
							else if($orcamento->status == 1)
								$status = 'Realizando Orçamento';
							else if($orcamento->status == 2)
								$status = 'Aguardando Cliente';
							else if($orcamento->status == 3)
								$status = 'Aguardando Pagamento';
							else if($orcamento->status == 4)
								$status = 'Postado no Correio';
							else if($orcamento->status == 5)
								$status = 'Entregue';
							
							echo
								"
									<tr>
										<td align='center'>
											<input type='radio' name='radioOrcamento' id='radioOrcamento' value='{$orcamento->codigo}'>
										</td>
										<td>
											{$orcamento->cliente}
										</td>
										<td>
											{$data}
										</td>
										<td align='center'>
											{$orcamento->total}
										</td>
										<td>
											{$status}
										</td>
									</tr>
								";
						}
					?>
					<tr>
						<td colspan='5'>
							<hr>
						</td>
					</tr>
					<!--Botões-->
					<tr>
						<td colspan='5' align='center'>
							<input type='button' value='Selecionar' onclick='selecionaOrcamento()'>
						</td>
					</tr>
				</table>
			</form>
		<?php
		}
		
		/*
         *  Método converteData
         *  Converte da data
         *  Brasileiro -> Banco de Dados
         *  Banco de Dados -> Brasileiro
         *  @param $data = Data a ser convertida
         */
        private function converteData($data)
        {
            $array		= array();
			$dateTime	= array();
            $convert;
			
			$dateTime = explode(' ', $data);
			$data = $dateTime[0];
			
            //Data no formato Brasileiro
            if(strstr($data, '/'))
            {
                $array      = explode('/', $data);
                $convert    = $array[2] . '-' . $array[1] . '-' . $array[0];
            }
            if(strstr($data, '-'))
            {
                $array      = explode('-', $data);
                $convert    = $array[2] . '/' . $array[1] . '/' . $array[0];
            }
			$convert = $convert.' '.$dateTime[1];
			
            return $convert;
        }
	}

?>