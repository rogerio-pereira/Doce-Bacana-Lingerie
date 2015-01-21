<?php
/*
 *	Arquivo  erro.class.php
 *	#DESCRI��O#
 *	
 *	Sistema:	Doce___Bacana_Lingerie
 *	Autor:      Rog�rio Eduardo Pereira
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
		 * M�todo Contrutor
		 */
		public function __construct()
		{
			
		}
		
		/*
		 * M�todo show
		 * Exibe as informa��es na tela
		 */
		public function show()
		{
			echo '<h1>Erro</h1><hr>';
			//Erro 400 - Bad Request
			if($_GET['codigo'] == 400)
				echo 
					"
						<h2>Solicita��o Impr�pria</h2>
						<p>
							O servidor n�o pode compreender a solicita��o e process�-la.<br>
							Contate o <a href='mailto:suporte@rogeriopereira.info'>Suporte T�cnico</a>
						</p>
					";
			//Erro 401 - Unauthorized
			if($_GET['codigo'] == 401)
				echo 
					'
						<h2>N�o autorizado</h2>
						<p>
							Por favor fa�a o login primeiro
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
						<h2>N�o encontrado</h2>
						<p>
							O conteudo solicitado n�o foi encontrado em nossos servidores.
						</p>
					';
			//Erro 500 - Internal Server Error
			if($_GET['codigo'] == 500)
				echo 
					"
						<h2>Erro interno no Servidor</h2>
						<p>
							O servidor encontrou uma condi��o inesperada<br>
							Contate o <a href='mailto:suporte@rogeriopereira.info'>Suporte T�cnico</a>
						</p>
					";
		}
	}

?>