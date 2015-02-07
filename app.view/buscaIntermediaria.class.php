<?php

/*
 * 	Arquivo  buscaIntermediaria.class.php
 * 	Redireciona a url para a busca
 * 	
 * 	Sistema:	Doce___Bacana_Lingerie
 * 	Autor:      Rogério Eduardo Pereira
 * 	Data:       07/02/2015
 */

/*
 * Classe buscaIntermediaria.class.php
 */
class buscaIntermediaria
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
		$busca = str_replace(' ', '+', $_POST['buscaProduto']);
		echo
			"
				<script>
					top.location='/busca/{$busca}';
				</script>
			";
	}

}

?>