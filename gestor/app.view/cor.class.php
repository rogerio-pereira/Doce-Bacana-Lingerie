<?php
/*
 *	Arquivo  cor.class.php
 *	Altera a Cor
 *	
 *	Sistema:	Doce___Bacana_Lingerie
 *	Autor:      Rogério Eduardo Pereira
 *	Data:       21/02/2015
 */

	/*
	 * Classe cor.class.php
	 */
	class cor 
	{
		/*
		 * Variaveis
		 */
		private $cor;
		
		
		/*
		 * Getters e Setters
		 */
		function getCor()
		{
			return $this->cor;
		}

		function setCor($cor)
		{
			$this->cor = $cor;
		}

				
		
		/*
		 * Método Contrutor
		 */
		public function __construct()
		{
			$this->setCor((new controladorProdutos())->getCor($_GET['cod']));
		}
		
		/*
		 * Método show
		 * Exibe as informações na tela
		 */
		public function show()
		{
		?>
			<h1>Cor</h1>
			<hr>
			<form class="formulario" name="alteraCor"		method="post" onsubmit='validaCor()'>
				<input type="hidden" name="formularioNome"	value="alteraCor">
				<input type="hidden" name="codigo"			id='codigo'		value="<?php echo $this->getCor()->codigo; ?>">
				<table class='tabelaFormulario'>
					<tr>
						<td>
							<label for='nomeCor'>Nome</label>
						</td>
						<td>
							<input																												
								type='text'
								class='campo'
								name='nome'
								id='nome'
								placeholder='Nome'
								maxlength='20'
								value='<?php echo $this->getCor()->nome; ?>'
							/>		
						</td>
					</tr>
					<tr>
						<td>
							<label for='cor1'>Cor 1</label>
						</td>
						<td>
							<input																												
								type='color'
								class='campo cor1'
								name='cor1'
								id='cor1'
								placeholder='Cor 1'
								value='<?php echo $this->getCor()->cor1; ?>'
								onchange="$('.cor2').val(this.value)"
							>
						</td>
					</tr>
					<tr>
						<td>
							Cor 2
						</td>
						<td>
							<input																												
								type='color'
								class='campo cor2'
								name='cor2'
								id='cor2'
								placeholder='Cor 2'
								value='<?php echo $this->getCor()->cor2; ?>'
							>		
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