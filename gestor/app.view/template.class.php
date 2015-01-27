<?php

/*
 *	Arquivo  template.class.php
 *	Template
 *	
 *	Sistema:	Doce___Bacana_Lingerie
 *	Autor:      Rogério Eduardo Pereira
 *	Data:       16/01/2015
 */
class template
{
	/*
		Variaveis
	*/


	/*
		MÃ©todo construtor
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
		MÃ©todo show
		Exibe as informaÃ§Ãµes da pÃ¡gina
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
				<link rel="stylesheet" type="text/css" href="/app.view/css/formulario.css">				
				
				<!--JQuery-->
				<script type="text/javascript" src="/app.view/js/jquery.js"></script>
				
				<!--JavaScript-->
				<script type="text/javascript" src="/app.view/js/categoria.js"></script>
				<script type="text/javascript" src="/app.view/js/usuario.js"></script>
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
						<hr>
						<aside>
							<nav id='menu'>
								<ul id='menuLista'>
								<?php
									//Categoria
									if($_SESSION['usuario']->telaCategoria == true)
										echo "<a href='/categorias'><li>		Categorias	</li></a>";
									//Orçamento
									if($_SESSION['usuario']->telaOrcamento == true)
										echo "<a href='/orcamentos'><li>		Orcamentos	</li></a>";
									//Produto
									if($_SESSION['usuario']->telaProduto == true)
										echo "<a href='/produtos'><li>		Produtos	</li></a>";
									//Usuario
									if($_SESSION['usuario']->telaUsuario == true)
										echo "<a href='/usuarios'><li>		Usuarios	</li></a>";
								?>
									<a href='/senha'><li>		Alterar Senha	</li></a>
									<a href='/logoff'><li>		Logoff			</li></a>
								</ul>
							</nav>
						</aside>
						
						<section>
							#CONTENT#
						</section>
					</div>
					
					<!--Footer-->
					<!--<div id='footer'>
						<footer>
							<hr>
							&copy; Copyright 2015 - Doce & Bacana Lingerie<br>
							Desenvolvedor: <a href='http://www.rogeriopereira.info.com' title='Desenvolvedor Rogério Pereira'>Rogério Pereira</a>
						</footer>
					</div>-->
				</div>
			</body>
		</html>
	<?php
	}
}
?>