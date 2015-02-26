<?php

/*
 * 	Classe  login
 * 	Tela de Login
 * 	
 * 	Sistema:	Doce___Bacana_Lingerie
 * 	Autor:		Rogério Eduardo Pereira
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
	 * MÃ©todo construtor
	 */
	public function __construct()
	{
		new session();
		//$_SESSION['cliente'] = NULL;
	}
	/*
	 * Método show
	 * Exibe as informaÃ§Ãµes na tela
	 */
	public function show()
	{
	?>
		<!--<h1>Login</h1>
		<hr>-->
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
					<!--Botão-->
					<tr>
						<td align=center >
							<input name='botaoLogin' type='submit' id='botaoLogin' value='Login' onclick='executaLogin()'/><br>
							<input 
								name='botaoEsqueciSenha' 
								type='button' 
								id='botaoEsqueciSenha' 
								value='Esqueci a Senha' 
								onclick="top.location='/esqueciSenha'"
							/>
						</td>
					</tr>
					<tr>
						<td>
							<hr>
						</td>
					</tr>
					<tr>
						<td align='center'>
							Ainda não é cadastrado<br>
							<input 
								name='botaoCadastro' 
								type='button' 
								id='botaoCadastro' 
								value='Cadastro' 
								onclick="top.location='/cadastro'"
							/>
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