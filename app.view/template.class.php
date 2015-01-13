<?php

/*	
	Classe template
	Exibe o template principal

	Sistema:	#SISTEMA#
	Autor: 		Rogério Eduardo Pereira
	Data: 		22/08/2014
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
				<title>		#TITULO# 		</title>
			
				<!--Meta Tags-->
				<meta name="description" content=	"">
				<meta name="keywords" content=	"">
				<meta charset='UTF-8' />
				
				<!--FavIcon-->
				<link rel="shortcut icon" type="image/x-icon" href="app.view/img/favicon.ico"/>
				
				<!--Acentos-->
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				
				<!--Fontes-->
				
				<!--CSS-->
				
				<!--JQuery-->
				
				<!--JavaScript-->
			</head>
			<body>
				
			</body>
		</html>
	<?php
	}
}
?>