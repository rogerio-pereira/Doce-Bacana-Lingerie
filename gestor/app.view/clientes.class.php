<?php
/*
 *	Arquivo  clientes.class.php
 *	#DESCRI��O#
 *	
 *	Sistema:	Doce___Bacana_Lingerie
 *	Autor:      Rog�rio Eduardo Pereira
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
		 * M�todo Contrutor
		 */
		public function __construct()
		{
			$this->setCollectionClientes((new controladorClientes())->getCollectionClientes());
		}
		
		/*
		 * M�todo show
		 * Exibe as informa��es na tela
		 */
		public function show()
		{
		?>
			<h1>Categorias</h1>
			<form class="formulario" name="ListaCategoria" method="post">
				<input type="hidden" name="formularioNome" value="ListaCategoria">
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
					</tr>
					<tr>
						<td colspan='4'>
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
									</tr>
								";
						}
					?>
					<tr>
						<td colspan='4'>
							<hr>
						</td>
					</tr>
					<!--Bot�es-->
					<tr>
						<td colspan='4' align='center'>
							<input type='button' value='Visualizar'		onclick='visualizaCliente()'>
							<input type='button' value='AlterarSenha'	onclick='alteraSenhaCliente()'>
						</td>
					</tr>
				</table>
			</form>
		<?php
		}
	}

?>