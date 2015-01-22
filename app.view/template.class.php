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
	 *	Variaveis
	 */
	private $collectionCategoria;


	/*
	 * Getters Setters
	 */
	function getCollectionCategoria()
	{
		return $this->collectionCategoria;
	}

	function setCollectionCategoria($collectionCategoria)
	{
		$this->collectionCategoria = $collectionCategoria;
	}

		
	/*
	 *	Método construtor
	 */
	public function __construct()
	{
		$this->setCollectionCategoria((new controladorCategoria())->getCollectionCategoria());
	}


	/*
	 *	Método show
	 *	Exibe as informações da página
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
				<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
				
				<!--CSS-->
				<link rel="stylesheet" type="text/css" href="app.view/css/template.css">
				<link rel="stylesheet" type="text/css" href="app.view/css/formulario.css">
				<link rel="stylesheet" type="text/css" href="app.view/css/contato.css">
				
				<!--JQuery-->
				<script type="text/javascript" src="app.view/js/jquery.js"></script>
				<script type="text/javascript" src="app.view/js/jquery.maskedinput.js"></script>
				<script type="text/javascript" src="app.view/js/jquery-cycle.js"></script>
				
				<!--JavaScript-->
				<script type="text/javascript" src="app.view/js/contato.js"></script>
				<script type="text/javascript" src="app.view/js/slider.js"></script>
			</head>
			<body>
				<div id='page'>
					<div id='header'>
						<header>
							<!--Logotipo-->
							<figure>
								<img src='app.view/img/template/logoVermelho.png' alt='Logotipo' title='Logotipo'>
							</figure>
							<!--Login-->
							<div id='headerLogin'>
								<a href='./login' title='Login'>Login</a>
							</div>
							<!--Cadastro-->
							<div id='headerCadastro'>
								<a href="./cadastro" title='Cadastro'>Cadastre-se</a>
							</div>
							<!--Busca-->
							<div id='headerBusca'>
								<form id='formBusca'>
									<input type='text' name='buscaProduto' id='buscaProduto' placeholder='Busca de Produtos'>
									<label for='buscaProduto'><img src='app.view/img/template/buscarIcon.png'></label>
								</form>
							</div>
						</header>
					</div> <!--Fim Header-->
					
					<div id='menu'>
						<!--Menu-->
						<nav id='navMenuPrincipal'>
							<ul id='navMenuPrincipalLista'>
								<a href='./home'><li>Home</li></a>
								<a href='./empresa'><li>Quem Somos</li></a>
								<a href='./produtos'><li>Produtos</li></a>
								<a href='./medidas'><li>Guia de Medidas</li></a>
								<a href='./carrinho'><li>Orçamento</li></a>
								<a href='./contato'><li>Contato</li></a>
							</ul>
						</nav>
					</div>
					
					<div id='section'>
						<!--Section-->
						<section>
							<div id='bannerTop'>
								<div class='sliderTop' id='1'>
									<div class='sliderTopImg'>
										<img src='app.view/img/produtos/banner/1.jpg'>
										<img src='app.view/img/produtos/banner/3.jpg'>
									</div>
								</div>
								<div class='sliderTop' id='2'>
									<div class='sliderTopImg'>
										<img src='app.view/img/produtos/banner/2.jpg'>
										<img src='app.view/img/produtos/banner/1.jpg'>
									</div>
								</div>
								<div class='sliderTop' id='3'>
									<div class='sliderTopImg'>
										<img src='app.view/img/produtos/banner/5.jpg'>
										<img src='app.view/img/produtos/banner/4.jpg'>
									</div>
								</div>
								<div class='sliderTop' id='4'>
									<div class='sliderTopImg'>
									<img src='app.view/img/template/frete.jpg' alt='Frete' title='Frete'>
								</div>
							</div>
							
							<div>
								<!--Barra Lateral-->
								<aside id='categoria'>
									<h1>Categorias</h1>
									<hr>
									<nav id='navMenuCategorias'>
										<ul id='navMenuCategoriasLista'>
											<?php
												foreach ($this->getCollectionCategoria() as $categoria)
												{
													echo "<a href='./categoria/{$categoria->codigo}'><li>	{$categoria->nome}	</li></a>";
												}
											?>
										</ul>
									</nav>
								</aside>
								
								<!--Conteudo-->
								<div id='conteudo'>
									#CONTENT#
								</div>
								
								<!--Banner de Baixo-->
								<div id='bannerFooter'>
									<img src='app.view/img/template/banner_pagseguro2.png'	alt='Formas de Pagamento'	title='Formas de Pagamento'>
									<img src='app.view/img/template/entrega.jpg'			alt='Entrega'				title='Entrega'>
								</div>
							</div>
							
							
					
							<div id='footer'>
								<footer>
									<div id='footerDesc'>
										<div id='footerDescInformacoes'>
											<p>
												<strong>INFORMAÇÕES</strong>
											</p>
											<hr>
											<p>
												<a href='./empresa'				title='Quem Somos'				alt='Quem Somos'>				Quem Somos				</a><br>
												<a href='./politicaCompras'		title='Politica de Compras'		alt='Politica de Compras'>		Politica de Compras		</a><br>
												<a href='./pagamento'			title='Formas de Pagamento'		alt='Formas de Pagamento'>		Formas de Pagamento		</a><br>
											</p>
										</div>
										<div id='footerDescConta'>
											<p>
												<strong>Minha Conta</strong>
											</p>
											<hr>
											<p>
												<a href='./perfil'		title='Meu Perfil e dados'		alt='Meu Perfil e dados'>		Meu Perfil e dados		</a><br>
												<a href='./carrinho'	title='Carrinho de Compras'		alt='Carrinho de Compras'>		Carrinho de Compras		</a><br>
											</p>
										</div>
										<div id='footerDescContato'>
											<p>
												<strong>Contate-nos</strong>
											</p>
											<hr>
											<p>
												ENDEREÇO<br />
												Rua Jairo Domingues Siqueira, 50 - Centro - Juruaia - MG - Cep 37805-000
											</p>
												
											<p>
												TELEFONE<br />
												(35) 3571 - 5785<br />
												(35) 3571 - 5785 - WhatsApp
											</p>
												
											<p>
												E-MAIL<br />
												<a href='mailto:contato@docebacanalingerue.com.br'>contato@docebacanalingerie.com.br</a>
											</p>
										</div>
										<div id='footerDescSocial'>
											<p>
												<strong>Mídias Sociais</strong>
											</p>
											<hr>
											<p>
												
											</p>
										</div>
									</div>
									
									<hr>
									&copy; Copyright 2015 - Doce & Bacana Lingerie<br>
									Desenvolvedor: <a href='http://www.rogeriopereira.info.com' title='Desenvolvedor Rogério Pereira'>Rogério Pereira</a>
								</footer>
							</div>
						</section>
					</div>		
				</div> <!--Fim page-->
			</body>
			
			<!--Scripts-->
			<script>iniciaSlider();</script>
		</html>
	<?php
	}
}
?>