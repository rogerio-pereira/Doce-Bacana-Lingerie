<?php
/*
 *	Arquivo  tutorial.class.php
 *	#DESCRIÇÂO#
 *	
 *	Sistema:	Doce___Bacana_Lingerie
 *	Autor:      Rogério Eduardo Pereira
 *	Data:       03/03/2015
 */

	/*
	 * Classe tutorial.class.php
	 */
	class tutorial 
	{
		/*
		 * Variaveis
		 */
		private $link;
		
		
		/*
		 * Getters e Setters
		 */
		function getLink()
		{
			return $this->link;
		}

		function setLink($link)
		{
			$this->link = $link;
		}

				
		
		/*
		 * Método Contrutor
		 */
		public function __construct()
		{
			$this->setLink((new controladorTutorial())->getLink());
		}
		
		/*
		 * Método show
		 * Exibe as informações na tela
		 */
		public function show()
		{
		?>
				<div class='video-container'>
					<iframe 
						src='<?php echo $this->getLink(); ?>' 
						frameborder='0' 
						width='560' 
						height='315'
						allowfullscreen
					>
					</iframe>
				</div>
		<?php
		}
	}

?>