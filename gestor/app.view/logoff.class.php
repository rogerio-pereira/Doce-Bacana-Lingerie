<?php

/*
 * 	Classe  logoff
 * 	Faz o logoff da sessão
 * 	
 * 	Sistema:	Kanban
 * 	Autor:	Rogério Eduardo Pereira
 * 	Data:	Sep 3, 2014
 */

/*
 * Classe logoff
 */
class logoff
{
	/*
	 * Variaveis
	 */

	/*
	 * Método construtor
	 */
	public function __construct()
	{
		$_SESSION['usuario'] = NULL;
		setcookie();
		session_destroy();
		echo
			"
				<script>
					top.location='?class=login';
				</script>
			";
	}
}
?>