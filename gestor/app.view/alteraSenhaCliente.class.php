<?php
/*
 *	Arquivo  alteraSenhaCliente.class.php
 *	#DESCRIÇÂO#
 *	
 *	Sistema:	Doce___Bacana_Lingerie
 *	Autor:      Rogério Eduardo Pereira
 *	Data:       20/02/2015
 */

	/*
	 * Classe alteraSenhaCliente.class.php
	 */
	class alteraSenhaCliente 
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
		?>
			<h1>Alteração de Senha Cliente</h1>
			<form class="formulario" name="alteraSenha"	method="post" action='/app.control/ajax.php' onsubmit="validaAlteracaoSenhaCliente()">
				<input type="hidden" name="formularioNome"		value="alteraSenhaCliente">
				<input type="hidden" name="codigo" id='codigo'	value="<?php echo $_GET['cod']; ?>">
				<table class='tabelaFormulario'>
					<!--Senha Nova-->
					<tr>
						<td>
							Senha Nova
						</td>
						<td>
							<input type='password' class='campo' name='senhaNova' id='senhaNova' placeholder='Senha Nova'>
						</td>
					</tr>
					<!--Confirmação-->
					<tr>
						<td>
							Confirmação
						</td>
						<td>
							<input type='password' class='campo' name='confirmacao' id='confirmacao' placeholder='Confirmação'>
						</td>
					</tr>
					<!--Botões-->
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