<?php
/*
 *	Arquivo  alteraSenha.class.php
 *	Altera a senha do Usuario de acordo com a chave
 *	
 *	Sistema:	Doce___Bacana_Lingerie
 *	Autor:      Rog�rio Eduardo Pereira
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