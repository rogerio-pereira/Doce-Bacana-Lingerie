<?php
/*
 *	Arquivo  cliente.class.php
 *	#DESCRIÇÂO#
 *	
 *	Sistema:	Doce___Bacana_Lingerie
 *	Autor:      Rogério Eduardo Pereira
 *	Data:       20/02/2015
 */

	/*
	 * Classe cliente.class.php
	 */
	class cliente 
	{
		/*
		 * Variaveis
		 */
		private $cliente;
		
		
		/*
		 * Getters e Setters
		 */
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
			$this->setCliente((new controladorClientes())->getCliente($_GET['cod']));
		}
		
		/*
		 * Método show
		 * Exibe as informações na tela
		 */
		public function show()
		{
		?>
			<h1>Categoria</h1>
			<hr>
			<table>
				<tr>
					<td><strong>Nome</strong></td>
					<td><?php echo $this->getCliente()->nome; ?></td>
				</tr>
				<?php 
					if($this->getCliente()->pessoa == 1)
					{
						echo 
							"
								<tr>
									<td colspan=2>
										<strong>Pessoa Fisica</strong>
									</td>
								</tr>
								<tr>
									<td><strong>CPF</strong></td>
									<td> {$this->getCliente()->cpf}</td>
								</tr>
								<tr>
									<td><strong>Data Nascimento</strong></td>
									<td> {$this->converteData($this->getCliente()->nascimento)}</td>
								</tr>
								<tr>
									<td>
										<strong>Sexo</strong>
									</td>
									<td>
							";
						if($this->getCliente()->sexo == 1)
							echo "Masculino";
						else
							echo "Feminino";
						echo
							"
								</td>
							";
					}
					else
					{
						echo 
							"
								<tr>
									<td colspan=2>
										<strong>Pessoa Jurídica</strong>
									</td>
								</tr>
								<tr>
									<td>
										<strong>Responsável</strong>
									</td>
									<td>
										{$this->getCliente()->nomeResponsavel}
									</td>
								</tr>
								<tr>
									<td>
										<strong>CNPJ</strong>
									</td>
									<td>
										{$this->getCliente()->cnpj}
									</td>
								</tr>	
								<tr>
									<td>
										<strong>Inscrição Estadual</strong>
									</td>
									<td>
										{$this->getCliente()->inscricaoEstadual}
									</td>
								</tr>
								<tr>
									<td>
										<strong>Informação tributária</strong>
									</td>
									<td>
							";
						if($this->getCliente()->informacaoTributaria == 0)
							echo 'Contribuinte ICMS';
						else if($this->getCliente()->informacaoTributaria == 1)
							echo 'Não Contribuinte';
						else if($this->getCliente()->informacaoTributaria == 2)
							echo 'Isento';
						echo '</td>';
					}
				?>
				<tr>
					<td colspan='2'>
						<hr>
					</td>
				</tr>
				<tr>
					<td>
						<strong>Telefone</strong>
					</td>
					<td>
						<?php echo $this->getCliente()->telefone; ?>
					</td>
				</tr>
				<tr>
					<td>
						<strong>Celular</strong>
					</td>
					<td>
						<?php echo $this->getCliente()->celular; ?>
					</td>
				</tr>
				<tr>
					<td>
						<strong>E-mail</strong>
					</td>
					<td>
						<?php echo $this->getCliente()->email; ?>
					</td>
				</tr>
				<tr>
					<?php 
						if($this->getCliente()->ofertaEmail == 1)
							echo '<tr><td>Recebe informações por e-mail</td></tr>';
						if($this->getCliente()->ofertaCelular == 1)
							echo '<tr><td>Recebe informações por celular</td></tr>';
					?>
				</tr>
				<tr>
					<td colspan='2'>
						<hr>
					</td>
				</tr>
				<tr>
					<td>
						<strong>Endereço</strong>
					</td>
					<td>
						<?php echo $this->getCliente()->endereco.' , '.$this->getCliente()->numero.'. '.$this->getCliente()->complemento; ?>
					</td>
				</tr>
				<tr>
					<td>
						<strong>Bairro</strong>
					</td>
					<td>
						<?php echo $this->getCliente()->bairro; ?>
					</td>
				</tr>
				<tr>
					<td>
						<strong>Cidade</strong>
					</td>
					<td>
						<?php echo $this->getCliente()->cidade.' - '.$this->getCliente()->estado; ?>
					</td>
				</tr>
				<?php
					if($this->getCliente()->referencia != '')
						echo
							"
								<tr>
									<td>
										<strong>Referencia</strong>
									</td>
									<td>
										{$this->getCliente()->referencia}			
									</td>				
								</tr>
							";
				?>
			</table>
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
            $array  = array();
            $convert;
            //Data no formato Brasileir
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
            return $convert;
        }
	}

?>