<?php
/*
 *	Arquivo  usuarios.class.php
 *	Exibe todos os Usuarios ativos
 *	
 *	Sistema:	Doce___Bacana_Lingerie
 *	Autor:      Rogério Eduardo Pereira
 *	Data:       27/01/2015
 */

	/*
	 * Classe usuarios.class.php
	 */
	class usuarios 
	{
		/*
		 * Variaveis
		 */
		private $collectionUsuarios;
		
		/*
		 * Getters e Setters
		 */
		function getCollectionUsuarios()
		{
			return $this->collectionUsuarios;
		}

		function setCollectionUsuarios($collectionUsuarios)
		{
			$this->collectionUsuarios = $collectionUsuarios;
		}

				
		
		
		/*
		 * Método Contrutor
		 */
		public function __construct()
		{
			$this->setCollectionUsuarios((new controladorUsuario())->getCollectionUsuario());
		}
		
		/*
		 * Método show
		 * Exibe as informações na tela
		 */
		public function show()
		{
		?>
			<h1>Usuários</h1>
			<form class="formulario" name="ListaUsuarios" method="post">
				<input type="hidden" name="formularioNome" value="ListaUsuarios">
				<table class='tabelaFormulario'>
					<!--Titulo-->
					<tr>
						<td align='center'>
							Alterar
						</td>
						<td align='center'>
							Nome
						</td>
						<td align='center'>
							Login
						</td>
						<td align='center'>
							Usuario
						</td>
						<td align='center'>
							Categoria
						</td>
						<td align='center'>
							Produto
						</td>
						<td align='center'>
							Orçamento
						</td>
						<td align='center'>
							Excluir
						</td>
					</tr>
					<tr>
						<td colspan='8'>
							<hr>
						</td>
					</tr> 
					<!--Dados-->
					<?php
						foreach ($this->getCollectionUsuarios() as $usuario)
						{
							echo
								"
									<!--{$usuario->nome}-->
									<tr>
										<td align='center'>
											<input type='radio' name='radioUsuario' id='radioUsuario' value='{$usuario->codigo}'>
										</td>
										<td>
											{$usuario->nome}
										</td>
										<td>
											{$usuario->usuario}
										</td>
										<td align='center'>
								";
							if($usuario->telaUsuario == 1)
								echo '&check;';
							echo
								"
										</td>
										<td align='center'>
								";
							if($usuario->telaCategoria == 1)
								echo '&check;';
							echo
								"
										</td>
										<td align='center'>
								";
							if($usuario->telaProduto == 1)
								echo '&check;';
							echo
								"
										</td>
										<td align='center'>
								";
							if($usuario->telaOrcamento == 1)
								echo '&check;';
							echo
								"
										</td>
										<td align='center'>
											<input type='checkbox' name='usuariosApagar[]' class='chkUsuariosApagar' value='{$usuario->codigo}'>
										</td>
									</tr>
								";
						}
					?>
					<tr>
						<td colspan='8'>
							<hr>
						</td>
					</tr>
					<!--Botões-->
					<tr>
						<td align='center'>
							<input type='button' value='Alterar' onclick='alteraUsuario()'>
						</td>
						<td colspan='6' align='center'>
							<input type='button' value='Cadastrar' onclick='novoUsuario()'>
						</td>
						<td align='center'>
						<?php
							if(count($this->getCollectionUsuarios()) > 0)
								echo "<input type='button' value='Apagar' onclick='apagaUsuario()'>";
						?>
						</td>
					</tr>
				</table>
			</form>
		<?php
		}
	}

?>