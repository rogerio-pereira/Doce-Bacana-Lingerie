<?php
/*
 *	Arquivo  orcamento.class.php
 *	Faz o orçamento
 *	
 *	Sistema:	Doce___Bacana_Lingerie
 *	Autor:      Rogério Eduardo Pereira
 *	Data:       07/02/2015
 */

	/*
	 * Classe orcamento.class.php
	 */
	class orcamento 
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
			var_dump($_SESSION['orcamento']);
		}
	}

?>