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
			<h1>Video Tutorial</h1>
			<hr>
			<form class="formulario" name="salvaCategoria"	method="post" onsubmit="validaTutorial()">
				<input type="hidden" name="formularioNome"	value="salvaCategoria">
				<table class='tabelaFormulario'>
					<tr>
						<td>
							Link
						</td>
						<td>
							<input 
								type='text' 
								class='campo' 
								name='link' 
								id='link' 
								placeholder='Link' 
								maxlength='100' 
								size='50'
								value="<?php echo $this->getLink(); ?>">
						</td>
					</tr>
					<tr>
						<td colspan='2' align='center'>
							<input name="botaoSalvar" type="submit" id="botaoSalvar" value="Salvar" />
						</td>
					</tr>
				</table>
			</form>
		<?php
		}
	}

?>