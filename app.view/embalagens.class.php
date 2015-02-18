<?php
/*
 *	Arquivo  embalagens.class.php.php
 *	Exibe as embalagens
 *	
 *	Sistema:	Doce___Bacana_Lingerie
 *	Autor:      Rog�rio Eduardo Pereira
 *	Data:       13/02/2015
 */

	/*
	 * Classe embalagens.class.php.php
	 */
	class embalagens
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
			//Slider
			echo "<div align='center'><ul class='rslides' id='sliderEmbalagem'>";
			for($i=1; $i<9; $i++)
			{
				echo "
						<li>
							<img 
								src='/app.view/img/embalagens/embalagem_0{$i}.jpg'
								alt='Embalagem {$i}' 
								title'Embalagem {$i}'
							>
						</li>
					";
			}
			echo '</ul><br>';
			
			//Pagina��o
			echo "<ul id='sliderEmbalagem-pager'>";
			for($i=1; $i<9; $i++)
			{
				echo "<li><a href='#'><img src='/app.view/img/embalagens/miniaturas/embalagem_0{$i}.jpg' alt='Embalagem {$i}' title'Embalagem {$i}></a></li>";
			}
			echo '</ul></div>';
			
			?>
				<script>
					 // SlideShow
					$("#sliderEmbalagem").responsiveSlides(
					{
						manualControls: '#sliderEmbalagem-pager',
						speed: 1000,
						timeout: 6000,
						maxwidth: 600
					});
				</script>
			<?php
		}
	}

?>