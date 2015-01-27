<?php

/*	
 *	Classe template
 *	Exibe o template principal
 *
 *	Sistema:	#SISTEMA#
 *	Autor: 		Rogério Eduardo Pereira
 *	Data: 		27/01/2015
*/
class home
{
	/*
		Variaveis
	*/


	/*
		MÃ©todo construtor
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
		MÃ©todo show
		Exibe as informações da página
	*/
	public function show()
	{
	?>
		
	<?php
	}
}
?>