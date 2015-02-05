<?php

/*
 * 	Classe  login
 * 	Tela de Login
 * 	
 * 	Sistema:	Doce___Bacana_Lingerie
 * 	Autor:		Rog�rio Eduardo Pereira
 * 	Data:		Sep 1, 2014
 */

/*
 * Classe login
 */
class login
{
	/*
	 * Variaveis
	 */

	/*
	 * Método construtor
	 */
	public function __construct()
	{
		new session();
		$_SESSION['cliente'] = NULL;
	}
	/*
	 * M�todo show
	 * Exibe as informações na tela
	 */
	public function show()
	{
	?>
		<h1>Login</h1>
		<hr>
		<div class='contentLogin' align='center'>
			<form 
					class="formulario"
					name="login"
					id="login"
					method="post"
			>
				<input type="hidden" name="formularioNome" value="login">
				<table>
					<!--Login-->
					<tr>
						<td>
							<input 
								type='text' 
								class='campo'
								id='email' 
								name='email'  
								placeholder='E-mail' 
							/>
						</td>
					</tr>
					<!--Senha-->
					<tr>
						<td>
							<input 
								type='password' 
								class='campo'
								id='senha' 
								name='senha' 
								placeholder='Senha' 
							>
						</td>
					</tr>
					<!--Bot�o-->
					<tr>
						<td align=center >
							<input name='botaoLogin' type='submit' id='botaoLogin' value='Login' onclick='executaLogin()'/>
						</td>
					</tr>
				</table>
			  </form>
		</div>
		<br>
		<?php
	}
}
?>