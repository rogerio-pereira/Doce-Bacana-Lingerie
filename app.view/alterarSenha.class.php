<?php
/*
 *	Arquivo  senha.class.php
 *	Formulario para altera��o de Senha
 *	
 *	Sistema:	Doce___Bacana_Lingerie
 *	Autor:      Rog�rio Eduardo Pereira
 *	Data:       28/01/2015
 */

	/*
	 * Classe alterarSenha
	 */
	class alterarSenha 
	{
		/*
		 * Variaveis
		 */
		
		
		/*
		 * Getters e Setters
		 */
		
		
		/*
		 * M�todo Contrutor
		 */
		public function __construct()
		{
			
		}
		
		/*
		 * M�todo show
		 * Exibe as informa��es na tela
		 */
		public function show()
		{
		?>
			<!--<h1>Altera��o de Senha</h1>-->
			<form class="formulario" name="alteraSenha"	method="post" onsubmit="validaAlteracaoSenha()">
				<input type="hidden" name="formularioNome"	value="alteraSenha">
				<table class='tabelaFormulario'>
					<!--Senha Atual-->
					<tr>
						<td>
							Senha Atual
						</td>
						<td>
							<input type='password' class='campo' name='senhaAtual' id='senhaAtual' placeholder='Senha Atual'>
						</td>
					</tr>
					<!--Senha Nova-->
					<tr>
						<td>
							Senha Nova
						</td>
						<td>
							<input type='password' class='campo' name='senhaNova' id='senhaNova' placeholder='Senha Nova'>
						</td>
					</tr>
					<!--Confirma��o-->
					<tr>
						<td>
							Confirma��o
						</td>
						<td>
							<input type='password' class='campo' name='confirmacao' id='confirmacao' placeholder='Confirma��o'>
						</td>
					</tr>
					<!--Bot�es-->
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