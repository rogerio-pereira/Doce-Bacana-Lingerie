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