<?php

/*	
 *	Classe template
 *	Exibe o template principal
 *
 *	Sistema:	#SISTEMA#
 *	Autor: 		Rog�rio Eduardo Pereira
 *	Data: 		27/01/2015
*/
class home
{
	/*
		Variaveis
	*/


	/*
		Método construtor
	*/
	public function __construct()
	{
		new session();
        
		if(!isset($_SESSION['usuario']))
		{
			echo "
				<script>
					top.location='../?class=login';
				</script>
			";
		}
	}


	/*
		Método show
		Exibe as informa��es da p�gina
	*/
	public function show()
	{
	?>
		
	<?php
	}
}
?>