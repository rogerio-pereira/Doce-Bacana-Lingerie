<?php

/*
 *	Arquivo  template.class.php
 *	Template
 *	
 *	Sistema:	Doce___Bacana_Lingerie
 *	Autor:      Rog�rio Eduardo Pereira
 *	Data:       16/01/2015
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
		new session();
        
		/*if(!isset($_SESSION['usuario']))
		{
			echo "
				<script>
					top.location='../?class=login';
				</script>
			";
		}*/
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
				<title>		Doce & Bacana Lingerie - Gestor 		</title>
			
				<!--Meta Tags-->
				<meta name="description" content=	"">
				<meta name="keywords" content=	"">
				<meta charset='UTF-8' />
				
				<!--FavIcon-->
				<link rel="shortcut icon" type="image/x-icon" href="/app.view/img/favicon2.ico"/>
				
				<!--Acentos-->
				<!--<meta http-equiv="content-type" content="text/html; charset=utf-8" />-->
				<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
				
				<!--Fontes-->
				<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
				
				<!--CSS-->
				<link rel="stylesheet" type="text/css" href="/app.view/css/template.css">
				
				<!--JQuery-->
				
				<!--JavaScript-->
			</head>
			<body>
				<div id='page'>
					<!--Header-->
					<div id='header'>
						<header>
							<!--Logotipo-->
							<figure>
								<img src='/app.view/img/template/logoVermelho.png' alt='Logotipo' title='Logotipo'>
							</figure>
							<h1>
								Bem vindo <span id='logotipo'><?php if($_SESSION['usuario'] != '') echo $_SESSION['usuario']->nome; ?></span>
							</h1>
						</header>
					</div>

					<!--Section-->
					<div id='section'>
						#CONTENT#
					</div>

					<!--Footer-->
					<div id='footer'>
						<footer>
							<hr>
							&copy; Copyright 2015 - Doce & Bacana Lingerie<br>
							Desenvolvedor: <a href='http://www.rogeriopereira.info.com' title='Desenvolvedor Rog�rio Pereira'>Rog�rio Pereira</a>
						</footer>
					</div>
				</div>
			</body>
		</html>
	<?php
	}
}
?>