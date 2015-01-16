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
				
				<!--JQuery-->
				
				<!--JavaScript-->
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
					</div> <!--Fim Header-->
					
					<div id='menu'>
						<!--Menu-->
						<nav id='navMenuPrincipal'>
							<ul id='navMenuPrincipalLista'>
								<a href='?class=home'>		<li>	Home				</li>	</a>
								<a href='?class=empresa'>	<li>	Quem Somos			</li>	</a>
								<a href='?class=produtos'>	<li>	Produtos			</li>	</a>
								<a href='?class=medidas'>	<li>	Guia de Medidas		</li>	</a>
								<a href='?class=contato'>	<li>	Contato				</li>	</a>
							</ul>
						</nav>
					</div>
					
					<div id='section'>
						<!--Section-->
						<section>
							<div>
								<aside id='categoria'>
									<strong>Categorias</strong>
									<hr>
									<nav id='navMenuCategorias'>
										<ul id='navMenuCategoriasLista'>
											<?php
												foreach ($this->getCollectionCategoria() as $categoria)
												{
													echo "<a href='?class=categoria&nome={$categoria->nome}'><li>	{$categoria->nome}	</li></a>";
												}
											?>
										</ul>
									</nav>
								</aside>
								<div id='conteudo'>
									#CONTENT#
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
												<a href='?class=quemSomos'			title='Quem Somos'				alt='Quem Somos'>				Quem Somos				</a><br>
												<a href='?class=politicaCompras'	title='Politica de Compras'		alt='Politica de Compras'>		Politica de Compras		</a><br>
												<a href='?class=pagamento'			title='Formas de Pagamento'		alt='Formas de Pagamento'>		Formas de Pagamento		</a><br>
											</p>
										</div>
										<div id='footerDescConta'>
											<p>
												<strong>Minha Conta</strong>
											</p>
											<hr>
											<p>
												<a href='?class=perfil'		title='Meu Perfil e dados'		alt='Meu Perfil e dados'>		Meu Perfil e dados		</a><br>
												<a href='?class=carrinho'	title='Carrinho de Compras'		alt='Carrinho de Compras'>		Carrinho de Compras		</a><br>
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
												<a href='?class=perfil'		title='Meu Perfil e dados'		alt='Meu Perfil e dados'>		Meu Perfil e dados		</a><br>
												<a href='?class=carrinho'	title='Carrinho de Compras'		alt='Carrinho de Compras'>		Carrinho de Compras		</a><br>
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
		</html>
	<?php
	}
}
?>