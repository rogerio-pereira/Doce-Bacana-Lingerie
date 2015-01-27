<?php
/*
 *	Arquivo  categoria.class.php
 *	#DESCRIÇÂO#
 *	
 *	Sistema:	Doce___Bacana_Lingerie
 *	Autor:      Rogério Eduardo Pereira
 *	Data:       27/01/2015
 */

	/*
	 * Classe categoria.class.php
	 */
	class categoria 
	{
		/*
		 * Variaveis
		 */
		private $categoria;
		
		
		/*
		 * Getters e Setters
		 */
		function getCategoria()
		{
			return $this->categoria;
		}

		function setCategoria($categoria)
		{
			$this->categoria = $categoria;
		}

				
		
		/*
		 * Método Contrutor
		 */
		public function __construct()
		{
			$this->setCategoria((new controladorCategoria())->getCategoria($_GET['cod']));
		}
		
		/*
		 * Método show
		 * Exibe as informações na tela
		 */
		public function show()
		{
		?>
			<h1>Categoria</h1>
			<form class="formulario" name="salvaCategoria"	method="post" onsubmit="validaCategoria()">
				<input type="hidden" name="formularioNome"	value="salvaCategoria">
				<input type="hidden" name="codigo"			id='codigo' value="<?php echo $this->getCategoria()->codigo; ?>">
				<table class='tabelaFormulario'>
					<tr>
						<td colspan='2'>
							<hr>
						</td>
					</tr>
					<tr>
						<td>
							Nome
						</td>
						<td>
							<input type='text' class='campo' name='nome' id='nome' placeholder='Nome' maxlength='20' value="<?php echo $this->getCategoria()->nome?>">
						</td>
					</tr>
					<tr>
						<td colspan='2'>
							<hr>
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