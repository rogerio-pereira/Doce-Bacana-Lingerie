<?php
/*
 *	Arquivo  esqueciSenha.class.php
 *	#DESCRIÇÂO#
 *	
 *	Sistema:	Doce___Bacana_Lingerie
 *	Autor:      Rogério Eduardo Pereira
 *	Data:       25/02/2015
 */

	/*
	 * Classe esqueciSenha.class.php
	 */
	class esqueciSenha 
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
			<!--<h1>Esqueci a senha</h1>
			<hr>-->
			<form class="formulario" name="esqueciSenha" method="post" action="app.control/enviaEmailSenha.class.php">
				<input type="hidden" name="formularioNome"	value="esqueciSenha">
				<table align='center'>
					<tr>
						<td>
							Digite o email cadastrado que enviaremos<br> um link para redefinição de senha
						</td>
					</tr>
					<tr>
						<td>
							<input 
								type='text' 
								class='campo'
								id='email' 
								name='email'  
								placeholder='E-mail' 
								size='35'
							/>
						</td>
					</tr>
					<tr>
						<td align='center'>
							<input name='botaoEnviar' type='submit' id='botaoEnviar' value='Enviar'/>
						</td>
					</tr>
				</table>
			</form>	
		<?php
		}
	}

?>