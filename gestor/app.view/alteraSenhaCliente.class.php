<?php
/*
 *	Arquivo  alteraSenhaCliente.class.php
 *	#DESCRI��O#
 *	
 *	Sistema:	Doce___Bacana_Lingerie
 *	Autor:      Rog�rio Eduardo Pereira
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
			<h1>Altera��o de Senha Cliente</h1>
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