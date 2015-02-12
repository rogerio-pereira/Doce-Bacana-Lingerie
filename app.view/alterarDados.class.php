<?php
/*
 *	Arquivo  alterarDados.class.php
 *	Altera os dados do cliente
 *	
 *	Sistema:	Doce___Bacana_Lingerie
 *	Autor:      Rogério Eduardo Pereira
 *	Data:       12/02/2015
 */

	/*
	 * Classe alterarDados.class.php
	 */
	class alterarDados
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
			<h1>Alterar Dados Pessoais</h1>
			<hr>
			<form class="formulario" name="alteraCliente" method="post" action="/app.control/ajax.php" onsubmit="return validaCamposAlterarCliente();">
				<input type="hidden" name="formularioNome" value="alteraCliente">
				<input type="hidden" name="codigo"			id='codigo'		value="<?php echo $_SESSION['cliente']->codigo; ?>">
				<table class='tabelaFormulario'>
					<!--Telefone-->
					<tr>
						<td>
							<label for='telefone' class='titulo'>Telefone</label>
						</td>
						<td>
							<input 
								type='text' 
								class='campo' 
								name='telefone' 
								id='telefone' 
								placeholder='Telefone' 
								maxlength='17' 
								value='<?php echo $_SESSION['cliente']->telefone; ?>'
							>
						</td>
					</tr>
					<!--Celular-->
					<tr>
						<td>
							<label for='celular' class='titulo obrigatorio'>Celular</label>
						</td>
						<td>
							<input 
								type='text' 
								class='campo' 
								name='celular' 
								id='celular' 
								placeholder='Celular' 
								maxlength='17' 
								value='<?php echo $_SESSION['cliente']->celular; ?>'
							>
						</td>
					</tr>
					<!--E-mail-->
					<tr>
						<td>
							<label for='email' class='titulo obrigatorio'>E-mail</label>
						</td>
						<td>
							<input 
								type='text' 
								class='campo' 
								name='email' 
								id='email' 
								placeholder='E-mail' 
								maxlength='100'
								value='<?php echo $_SESSION['cliente']->email; ?>'
							>
						</td>
					</tr>
					<!--Quebra de Linha-->
					<tr>
						<td colspan='2'>
							<hr>
						</td>
					</tr>
					<!--Oferta Email-->
					<tr>
						<td colspan='2'>
							<?php
								if($_SESSION['cliente']->ofertaEmail == true)
									echo "<input type='checkbox' name='ofertaEmail' id='ofertaEmail' checked>";
								else
									echo "<input type='checkbox' name='ofertaEmail' id='ofertaEmail'>";
							?>
							<label for='ofertaEmail'>Desejo Receber informações por e-mail</label>
						</td>
					</tr>
					<!--Oferta Celular-->
					<tr>
						<td colspan='2'>
							<?php
								if($_SESSION['cliente']->ofertaCelular == true)
									echo "<input type='checkbox' name='ofertaCelular' id='ofertaCelular' checked>";
								else
									echo "<input type='checkbox' name='ofertaCelular' id='ofertaCelular'>";
							?>
							<label for='ofertaCelular'>Desejo Receber informações por celular</label>
						</td>
					</tr>
					<!--Quebra de Linha-->
					<tr>
						<td colspan='2'>
							<hr>
						</td>
					</tr>
					<!--CEP-->
					<tr>
						<td>
							<label for='cep' class='titulo obrigatorio'>CEP</label>
						</td>
						<td>
							<input 
								type='text' 
								class='campo' 
								name='cep' 
								id='cep' 
								placeholder='CEP' 
								maxlength='9'
								value='<?php echo $_SESSION['cliente']->cep; ?>'
							>
						</td>
					</tr>
					<!--Endereço-->
					<tr>
						<td>
							<label for='endereco' class='titulo obrigatorio'>Endereço</label>
						</td>
						<td>
							<input 
								type='text' 
								class='campo' 
								name='endereco' 
								id='endereco' 
								placeholder='Endereço'
								maxlength='100'								
								value='<?php echo $_SESSION['cliente']->endereco; ?>'
							>
						</td>
					</tr>
					<!--Número-->
					<tr>
						<td>
							<label for='numero' class='titulo obrigatorio'>Número</label>
						</td>
						<td>
							<input 
								type='number' 
								class='campo' 
								name='numero' 
								id='numero' 
								placeholder='Número' 
								min="1"								
								value='<?php echo $_SESSION['cliente']->numero; ?>'
							>
						</td>
					</tr>
					<!--Complemento-->
					<tr>
						<td>
							<label for='complemento' class='titulo'>Complemento</label>
						</td>
						<td>
							<input 
								type='text' 
								class='campo' 
								name='complemento' 
								id='complemento' 
								placeholder='Complemento' 
								maxlength='30'
								value='<?php echo $_SESSION['cliente']->complemento; ?>'
							>
						</td>
					</tr>
					<!--Bairro-->
					<tr>
						<td>
							<label for='bairro' class='titulo obrigatorio'>Bairro</label>
						</td>
						<td>
							<input 
								type='text' 
								class='campo' 
								name='bairro' 
								id='bairro' 
								placeholder='Bairro' 
								maxlength='30'
								value='<?php echo $_SESSION['cliente']->bairro; ?>'
							>
						</td>
					</tr>
					<!--Cidade-->
					<tr>
						<td>
							<label for='cidade' class='titulo obrigatorio'>Cidade</label>
						</td>
						<td>
							<input 
								type='text' 
								class='campo' 
								name='cidade' 
								id='cidade' 
								placeholder='Cidade' 
								maxlength='50'
								value='<?php echo $_SESSION['cliente']->cidade; ?>'
							>
						</td>
					</tr>
					<!--Estado-->
					<tr>
						<td>
							<label for='estado' class='titulo obrigatorio'>Estado</label>
						</td>
						<td>
							<select class='campo' name='estado' id='estado'>
								<option value='' disabled label>Estados</option>
								<option value='AC'>Acre</option>
								<option value='AL'>Alagoas</option>
								<option value='AP'>Amapá</option>
								<option value='AM'>Amazonas</option>
								<option value='BA'>Bahia</option>
								<option value='CE'>Ceará</option>
								<option value='DF'>Distrito Federal</option>
								<option value='ES'>Espírito Santo</option>
								<option value='GO'>Goiás</option>
								<option value='MA'>Maranhão</option>
								<option value='MS'>Mato Grosso do Sul</option>
								<option value='MT'>Mato Grosso</option>
								<option value='MG'>Minas Gerais</option>
								<option value='PA'>Pará</option>
								<option value='PB'>Paraíba</option>
								<option value='PR'>Paraná</option>
								<option value='PE'>Pernambuco</option>
								<option value='PI'>Piauí</option>
								<option value='RJ'>Rio de Janeiro</option>
								<option value='RN'>Rio Grande do Norte</option>
								<option value='RS'>Rio Grande do Sul</option>
								<option value='RO'>Rondônia</option>
								<option value='RR'>Roraima</option>
								<option value='SC'>Santa Catarina</option>
								<option value='SP'>São Paulo</option>
								<option value='SE'>Sergipe</option>
								<option value='TO'>Tocantins</option>								
							</select>
							<script>
								//Seleciona o valor 
								$("#estado").val("<?php echo $_SESSION['cliente']->estado; ?>");
							</script>
						</td>
					</tr>
					<!--Ponto de Referencia-->
					<tr>
						<td colspan='2'>
							<label for='referencia' class='titulo'>Ponto de Referencia</label>
						</td>
					</tr>
					<tr>
						<td colspan='2'>
							<textarea class='campo' name='referencia' id='referencia' maxlength="500" rows="10"><?php echo $_SESSION['cliente']->pontoReferencia; ?></textarea>
						</td>
					</tr>
					<!--Botões-->
					<tr>
						<td colspan=2 align=center style="width: 100%">
							<input name="botaoEnviar" type="submit" id="botaoEnviar" value="Enviar" />
						</td>
					</tr>
				</table>
			</form>
		<?php
		}
	}
?>