<?php
/*
 *	Arquivo  orcamento.class.php
 *	Faz o or�amento
 *	
 *	Sistema:	Doce___Bacana_Lingerie
 *	Autor:      Rog�rio Eduardo Pereira
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
			var_dump($_SESSION['orcamento']);
		}
	}

?>