<?php
/*
 *	Arquivo  clientes.class.php
 *	#DESCRIÇÂO#
 *	
 *	Sistema:	Doce___Bacana_Lingerie
 *	Autor:      Rogério Eduardo Pereira
 *	Data:       20/02/2015
 */

	/*
	 * Classe clientes.class.php
	 */
	class clientes 
	{
		/*
		 * Variaveis
		 */
		private $collectionClientes;
		
		
		/*
		 * Getters e Setters
		 */
		function getCollectionClientes()
		{
			return $this->collectionClientes;
		}

		function setCollectionClientes($collectionClientes)
		{
			$this->collectionClientes = $collectionClientes;
		}
		
		
		
		/*
		 * Método Contrutor
		 */
		public function __construct()
		{
			$this->setCollectionClientes((new controladorClientes())->getCollectionClientes());
		}
		
		/*
		 * Método show
		 * Exibe as informações na tela
		 */
		public function show()
		{
		?>
			<h1>Clientes</h1>
			<form class="formulario" name="listaClientes" method="post">
				<input type="hidden" name="formularioNome" value="listaClientes">
				<table class='tabelaFormulario'>
					<!--Titulo-->
					<tr>
						<td align='center'>
							Selecionar
						</td>
						<td align='center'>
							Nome
						</td>
						<td align='center'>
							Documento
						</td>
						<td align='center'>
							Email
						</td>
						<td align='center'>
							Excluir
						</td>
					</tr>
					<tr>
						<td colspan='5'>
							<hr>
						</td>
					</tr>
					<!--Dados-->
					<?php
						foreach($this->getCollectionClientes() as $cliente)
						{
							if(isset($cliente->cpf) && ($cliente->cpf != ''))
								$documento = $cliente->cpf;
							if(isset($cliente->cnpj) && ($cliente->cnpj != ''))
								$documento = $cliente->cnpj;
							echo 
								"
									<tr>
										<td>
											<input type='radio' name='radioCliente' id='radioCliente' value='{$cliente->codigo}'>
										</td>
										<td>
											{$cliente->nome}
										</td>
										<td>
											{$documento}
										</td>
										<td>
											{$cliente->email}
										</td>
										<td align='center'>
											<input type='checkbox' name='clientesApagar[]' class='chkClientesApagar' value='{$cliente->codigo}'>
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
							<input type='button' value='Visualizar'		onclick='visualizaCliente()'>
							<input type='button' value='AlterarSenha'	onclick='redirecionaSenhaCliente()'>
							<?php
								if(count($this->getCollectionClientes()) > 0)
									echo "<input type='button' value='Apagar' onclick='apagaClientes()'>";
							?>
						</td>
					</tr>
				</table>
			</form>
		<?php
		}
	}

?>