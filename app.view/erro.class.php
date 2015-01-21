<?php
/*
 *	Arquivo  erro.class.php
 *	#DESCRIÇÂO#
 *	
 *	Sistema:	Doce___Bacana_Lingerie
 *	Autor:      Rogério Eduardo Pereira
 *	Data:       21/01/2015
 */

	/*
	 * Classe erro.class.php
	 */
	class erro 
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
			echo '<h1>Erro</h1><hr>';
			//Erro 400 - Bad Request
			if($_GET['codigo'] == 400)
				echo 
					"
						<h2>Solicitação Imprópria</h2>
						<p>
							O servidor não pode compreender a solicitação e processá-la.<br>
							Contate o <a href='mailto:suporte@rogeriopereira.info'>Suporte Técnico</a>
						</p>
					";
			//Erro 401 - Unauthorized
			if($_GET['codigo'] == 401)
				echo 
					'
						<h2>Não autorizado</h2>
						<p>
							Por favor faça o login primeiro
						</p>
					';
			//Erro 403 - Forbidden 
			if($_GET['codigo'] == 403)
				echo 
					'
						<h2>Acesso Negado</h2>
						<p>
							O acesso a esse local foi proibido
						</p>
					';
			//Erro 404 - Not Found
			if($_GET['codigo'] == 404)
				echo 
					'
						<h2>Não encontrado</h2>
						<p>
							O conteudo solicitado não foi encontrado em nossos servidores.
						</p>
					';
			//Erro 500 - Internal Server Error
			if($_GET['codigo'] == 500)
				echo 
					"
						<h2>Erro interno no Servidor</h2>
						<p>
							O servidor encontrou uma condição inesperada<br>
							Contate o <a href='mailto:suporte@rogeriopereira.info'>Suporte Técnico</a>
						</p>
					";
		}
	}

?>