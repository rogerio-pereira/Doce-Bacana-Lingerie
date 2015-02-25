<?php
/*
 *	Arquivo  alteraSenha.class.php
 *	Altera a senha do Usuario de acordo com a chave
 *	
 *	Sistema:	Doce___Bacana_Lingerie
 *	Autor:      Rogério Eduardo Pereira
 *	Data:       25/02/2015
 */

	/*
	 * Classe alteraSenha.class.php
	 */
	class alteraSenha 
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
			<form class="formulario" name="novaSenha"	method="post" onsubmit="validaNovaSenha()">
				<input type="hidden" name="formularioNome"		value="novaSenha">
				<input type="hidden" name="chave" id='chave'	value="<?php echo $_GET['chave']; ?>">
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