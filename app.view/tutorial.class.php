<?php
/*
 *	Arquivo  tutorial.class.php
 *	#DESCRI��O#
 *	
 *	Sistema:	Doce___Bacana_Lingerie
 *	Autor:      Rog�rio Eduardo Pereira
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
		 * M�todo Contrutor
		 */
		public function __construct()
		{
			$this->setLink((new controladorTutorial())->getLink());
		}
		
		/*
		 * M�todo show
		 * Exibe as informa��es na tela
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