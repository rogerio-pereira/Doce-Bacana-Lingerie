<?php

/*	
 *	Classe template
 *	Exibe o template principal
 *
 *	Sistema:	#SISTEMA#
 *	Autor: 		Rogério Eduardo Pereira
 *	Data: 		#DATA#
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
        
		/*if(!isset($_SESSION['usuario']))
		{
			echo "
				<script>
					top.location='../?class=login';
				</script>
			";
		}*/
	}


	/*
		Método show
		Exibe as informações da página
	*/
	public function show()
	{
	?>
		
	<?php
	}
}
?>