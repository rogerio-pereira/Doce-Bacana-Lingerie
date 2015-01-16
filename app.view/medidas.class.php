<?php
/*
 *	Arquivo  medidas.class.php
 *	Guia de Medidas
 *	
 *	Sistema:	Doce___Bacana_Lingerie
 *	Autor:      Rogério Eduardo Pereira
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
		?>
			<h1>Guia de Medidas</h1>
			<hr>
			<div class='imagemResponsiva'>
				<img id='imgMedidas' src='app.view/img/medida/guia_medida.jpg' title='Guia de Medidas' alt='Guia de Medida'>
			</div>
				
			<p>
				As medidas apresentadas servem como referência, sendo que podem sofrer variações de um modelo para outro devido a utilização de marteriais com 
				maior ou menor fator de elasticidade.
			</p>
			<p>
				Em caso de dúvidas favor solicitar mais  informações .
			</p>
		<?php
		}
	}

?>