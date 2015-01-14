<?php

/*	Arquivo  template.php
 *	Template
 *	
 *	Sistema:	Doce___Bacana_Lingerie
 *	Autor:      Rogério Eduardo Pereira
 *	Data:       11/01/2015
 */
class template
{
	/*
		Variaveis
	*/


	/*
		Método construtor
	*/
	public function __construct()
	{

	}


	/*
		Método show
		Exibe as informações da página
	*/
	public function show()
	{
	?>
		<!DOCTYPE HTML>
		<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
			<head>
				<title>		Doce & Bacana Lingerie 		</title>
			
				<!--Meta Tags-->
				<meta name="description" content=	"">
				<meta name="keywords" content=	"">
				<meta charset='UTF-8' />
				
				<!--FavIcon-->
				<link rel="shortcut icon" type="image/x-icon" href="app.view/img/favicon2.ico"/>
				
				<!--Acentos-->
				<!--<meta http-equiv="content-type" content="text/html; charset=utf-8" />-->
				<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
				
				<!--Fontes-->
				
				<!--CSS-->
				<link rel="stylesheet" type="text/css" href="app.view/css/template.css">
				
				<!--JQuery-->
				
				<!--JavaScript-->
			</head>
			<body>
				<div id='page'>
					<header>
						<!--Logotipo-->
						<figure>
							<img src='app.view/img/template/logoPreto.png' alt='Logotipo' title='Logotipo'>
						</figure>
						<!--Login-->
						<div id='headerLogin'>
							<a href='?class=login' title='Login'>Login</a>
						</div>
						<!--Cadastro-->
						<div id='headerCadastro'>
							<a href="?class=cadastro" title='Cadastro'>Cadastre-se</a>
						</div>
						<!--Busca-->
						<div id='headerBusca'>
							<form id='formBusca'>
								<input type='text' name='buscaProduto' id='buscaProduto' placeholder='Busca de Produtos'>
								<label for='buscaProduto'><img src='app.view/img/template/buscarIcon.png'></label>
							</form>
						</div>
					</header>

					<!--Menu-->
					<nav id='navMenuPrincipal'>
						<ul id='navMenuPrincipalLista'>
							<a href='?class=home'>		<li>	Home</li>	</a>
							<a href='?class=empresa'>	<li>	Quem Somos</li>	</a>
							<a href='?class=produtos'>	<li>	Produtos</li>	</a>
							<a href='?class=medidas'>	<li>	Guia de Medidas</li>	</a>
							<a href='?class=contato'>	<li>	Contato</li>	</a>
						</ul>
					</nav>

					<!--Section-->
					<section>
						#CONTENT#
					</section>
					
					<footer>
						dsd
					</footer>
				</div>
			</body>
		</html>
	<?php
	}
}
?>