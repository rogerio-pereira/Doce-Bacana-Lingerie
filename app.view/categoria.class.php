<?php
/*
 *	Arquivo  categoria.class.php
 *	Produtos Filtrados por categoria
 *	
 *	Sistema:	Doce___Bacana_Lingerie
 *	Autor:      Rog�rio Eduardo Pereira
 *	Data:       21/01/2015
 */

	/*
	 * Classe categoria.class.php
	 */
	class categoria
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
			echo $_GET['cod'];
		}
	}

?>