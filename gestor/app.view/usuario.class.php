<?php
/*
 *	Arquivo  usuario.php
 *	Altera/CAdastra Usuario
 *	
 *	Sistema:	Doce___Bacana_Lingerie
 *	Autor:      Rog�rio Eduardo Pereira
 *	Data:       27/01/2015
 */

	/*
	 * Classe usuario.class.php
	 */
	class usuario 
	{
		/*
		 * Variaveis
		 */
		private $usuario;
		
		
		/*
		 * Getters e Setters
		 */
		function getUsuario()
		{
			return $this->usuario;
		}

		function setUsuario($usuario)
		{
			$this->usuario = $usuario;
		}

				
		/*
		 * M�todo Contrutor
		 */
		public function __construct()
		{
			$this->setUsuario((new controladorUsuario)->getUsuarioBDByCod($_GET['cod']));
		}
		
		/*
		 * M�todo show
		 * Exibe as informa��es na tela
		 */
		public function show()
		{
		?>
			<h1>Usu�rio</h1>
			<form class="formulario" name="salvaUsuario"	method="post" onsubmit="validaUsuario()">
				<input type="hidden" name="formularioNome"	value="salvaUsuario">
				<input type="hidden" name="codigo"			id='codigo' value="<?php echo $this->getUsuario()->codigo; ?>">
				<table class='tabelaFormulario'>
					<tr>
						<td colspan='2'>
							<hr>
						</td>
					</tr>
					<!--Nome-->
					<tr>
						<td>
							Nome
						</td>
						<td>
							<input type='text' class='campo' name='nome' id='nome' placeholder='Nome' maxlength='100' value="<?php echo $this->getUsuario()->nome; ?>">
						</td>
					</tr>
					<!--Login-->
					<tr>
						<td>
							Login
						</td>
						<td>
							<input type='text' class='campo' name='login' id='login' placeholder='Login' maxlength='15' value="<?php echo $this->getUsuario()->usuario; ?>">
						</td>
					</tr>
					<?php
						if($this->getUsuario()->codigo == '')
							echo
								"
									<!--Senha-->
									<tr>
										<td>
											Senha
										</td>
										<td>
											<input type='password' class='campo' name='senha' id='senha' placeholder='Senha'>
										</td>
									</tr>
									<tr>
										<td>
											Confirma��o
										</td>
										<td>
											<input type='password' class='campo' name='confirmacao' id='confirmacao' placeholder='Senha'>
										</td>
									</tr>
								";
					?>
					<!--Permiss�es-->
					<tr>
						<td colspan='2'>
							<hr>
						</td>
					</tr>
					<tr>
						<td colspan='2' align='center'>
							Permiss�es
						</td>
					</tr>
					<!--Usuario-->
					<tr>
						<td>
							Usu�rio
						</td>
						<td>
						<?php
							if($this->getUsuario()->telaUsuario == 1)
								echo "<input type='checkbox' name='checkUsuario' id='checkUsuario' value='1' checked>";
							else
								echo "<input type='checkbox' name='checkUsuario' id='checkUsuario' value='1'>";
						?>
						</td>
					</tr>
					<!--Categoria-->
					<tr>
						<td>
							Categoria
						</td>
						<td>
						<?php
							if($this->getUsuario()->telaCategoria == 1)
								echo "<input type='checkbox' name='checkCategoria' id='checkCategoria' value='1' checked>";
							else
								echo "<input type='checkbox' name='checkCategoria' id='checkCategoria' value='1'>";
						?>
						</td>
					</tr>
					<!--Produto-->
					<tr>
						<td>
							Produto
						</td>
						<td>
						<?php
							if($this->getUsuario()->telaProduto == 1)
								echo "<input type='checkbox' name='checkProduto' id='checkProduto' value='1' checked>";
							else
								echo "<input type='checkbox' name='checkProduto' id='checkProduto' value='1'>";
						?>
						</td>
					</tr>
					<!--Or�amento-->
					<tr>
						<td>
							Or�amento
						</td>
						<td>
						<?php
							if($this->getUsuario()->telaOrcamento == 1)
								echo "<input type='checkbox' name='checkOrcamento' id='checkOrcamento' value='1' checked>";
							else
								echo "<input type='checkbox' name='checkOrcamento' id='checkOrcamento' value='1'>";
						?>
							
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
		<?php
		}
	}

?>