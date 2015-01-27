<?php

/*
 * 	Classe  login
 * 	#RESUMO DA CLASSE#
 * 	
 * 	Sistema:	Kanban
 * 	Autor:	Rogério Eduardo Pereira
 * 	Data:	Sep 1, 2014
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
	}
	/*
	 * Método show
	 * Exibe as informações na tela
	 */
	public function show()
	{
	?>
	<!DOCTYPE HTML>
		<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
			<head>
				<title>
					Kanban - Login
				</title>
			
				<!--FavIcon-->
				<link rel="shortcut icon" type="image/x-icon" href="/app.view/img/template/favicon2.ico"/>
				
				<!--Acentos-->
				<meta http-equiv="content-type" content="text/html; charset=utf-8" />
				
				<!--Fontes-->
				
				<!--CSS-->
				<link rel="stylesheet" href="/app.view/css/template.css">
				<link rel="stylesheet" href="/app.view/css/formulario.css">
				<link rel="stylesheet" href="/app.view/css/login.css">
					
				<!--JQuery-->
				<script type="text/javascript" src="/app.view/js/jquery.js"></script>
				
				<!--JavaScript-->
				<script type="text/javascript" src="/app.view/js/login.js"></script>
			</head>
			<body>
				<div class='contentLogin'>
					<form 
							class="formulario"
							name="login"
							id="login"
							method="post"
					>
						<input type="hidden" name="formularioNome" value="login">
						<table>
							<!--Titulo-->
							<tr>
								<td align=center>
									<h1>Login</h1>
								</td>
							</tr>
							<!--Login-->
							<tr>
								<td>
									<input 
										type='text' 
										class='campo'
										id='usuario' 
										name='usuario'  
										placeholder='Login' 
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
			</body>
		</html>
		<?php
	}
}
?>