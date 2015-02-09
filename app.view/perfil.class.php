<?php
/*
 *	Arquivo  perfil.class.php
 *	Exibe Perfil do cliente
 *	
 *	Sistema:	Doce___Bacana_Lingerie
 *	Autor:      Rogério Eduardo Pereira
 *	Data:       09/02/2015
 */

	/*
	 * Classe perfil.class.php
	 */
	class perfil 
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
			if($_SESSION['cliente'] == '') 
				echo 
					"
						<script>
							alert('Faça o login para continuar!');
							top.location = '/login/';
						</script>
					"; 
		}
		
		/*
		 * Método show
		 * Exibe as informações na tela
		 */
		public function show()
		{
		?>
			<h1>Perfil</h1>
			<hr>
			<div class='menuPerfil'>
				<a href='/alterarPerfil/'>	Alterar Perfil	</a><br>
				<a href='/alterarSenha/'>	Alterar Senha	</a><br>
				<a href='/meusOrcamentos/'>	Meus Orcamentos	</a>
			</div>
			
			<div class='informacoesPerfil'>
				<table>
					<tr>
						<td><strong>Nome</strong></td>
						<td><?php echo $_SESSION['cliente']->nome; ?></td>
					</tr>
					<?php 
						if($_SESSION['cliente']->pessoa == 1)
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
										<td> {$_SESSION['cliente']->cpf}</td>
									</tr>
									<tr>
										<td><strong>Data Nascimento</strong></td>
										<td> {$this->converteData($_SESSION['cliente']->nascimento)}</td>
									</tr>
									<tr>
										<td>
											<strong>Sexo</strong>
										</td>
										<td>
								";
							if($_SESSION['cliente']->sexo == 1)
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
											{$_SESSION['cliente']->nomeResponsavel}
										</td>
									</tr>
									<tr>
										<td>
											<strong>CNPJ</strong>
										</td>
										<td>
											{$_SESSION['cliente']->cnpj}
										</td>
									</tr>	
									<tr>
										<td>
											<strong>Inscrição Estadual</strong>
										</td>
										<td>
											{$_SESSION['cliente']->inscricaoEstadual}
										</td>
									</tr>
									<tr>
										<td>
											<strong>Informação tributária</strong>
										</td>
										<td>
								";
							if($_SESSION['cliente']->informacaoTributaria == 0)
								echo 'Contribuinte ICMS';
							else if($_SESSION['cliente']->informacaoTributaria == 1)
								echo 'Não Contribuinte';
							else if($_SESSION['cliente']->informacaoTributaria == 2)
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
							<?php echo $_SESSION['cliente']->telefone; ?>
						</td>
					</tr>
					<tr>
						<td>
							<strong>Celular</strong>
						</td>
						<td>
							<?php echo $_SESSION['cliente']->celular; ?>
						</td>
					</tr>
					<tr>
						<td>
							<strong>E-mail</strong>
						</td>
						<td>
							<?php echo $_SESSION['cliente']->email; ?>
						</td>
					</tr>
					<tr>
						<?php 
							if($_SESSION['cliente']->ofertaEmail == 1)
								echo '<td>Recebe informações por e-mail</td>';
							if($_SESSION['cliente']->ofertaCelular == 1)
								echo '<td>Recebe informações por celular</td>';
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
							<?php echo $_SESSION['cliente']->endereco.' , '.$_SESSION['cliente']->numero.'. '.$_SESSION['cliente']->complemento; ?>
						</td>
					</tr>
					<tr>
						<td>
							<strong>Bairro</strong>
						</td>
						<td>
							<?php echo $_SESSION['cliente']->bairro; ?>
						</td>
					</tr>
					<tr>
						<td>
							<strong>Cidade</strong>
						</td>
						<td>
							<?php echo $_SESSION['cliente']->cidade.' - '.$_SESSION['cliente']->estado; ?>
						</td>
					</tr>
					<?php
						if($_SESSION['cliente']->referencia != '')
							echo
								"
									<tr>
										<td>
											<strong>Referencia</strong>
										</td>
										<td>
											{$_SESSION['cliente']->referencia}			
										</td>				
									</tr>
								";
					?>
				</table>
			</div>
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