<?php
/*
 *	Arquivo  medidas.class.php
 *	Guia de Medidas
 *	
 *	Sistema:	Doce___Bacana_Lingerie
 *	Autor:      Rog�rio Eduardo Pereira
 *	Data:       15/01/2015
 */

	/*
	 * Classe medidas.class.php
	 */
	class medidas 
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
		?>
			<h1>Guia de Medidas</h1>
			<hr>
			<div class='imagemResponsiva'>
				<img id='imgMedidas' src='app.view/img/medida/guia_medida.jpg' title='Guia de Medidas' alt='Guia de Medida'>
			</div>
				
			<p>
				As medidas apresentadas servem como refer�ncia, sendo que podem sofrer varia��es de um modelo para outro devido a utiliza��o de marteriais com 
				maior ou menor fator de elasticidade.
			</p>
			<p>
				Em caso de d�vidas favor solicitar mais  informa��es .
			</p>
		<?php
		}
	}

?>