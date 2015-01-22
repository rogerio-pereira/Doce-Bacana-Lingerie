<?php
/*
 *	Arquivo  cadastro.class.php
 *	Tela de Cadastro de Usuarios
 *	
 *	Sistema:	Doce___Bacana_Lingerie
 *	Autor:      Rogério Eduardo Pereira
 *	Data:       21/01/2015
 */

	/*
	 * Classe cadastro.class.php
	 */
	class cadastro 
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
			<h1>Cadastro</h1>
			<hr>
			<form class="formulario" name="cadastro" method="post" action="app.control/ajax.php" onsubmit="return validaCamposCadastro();">
				<input type="hidden" name="formularioNome" value="cadastro">
				<table class='tabelaFormulario'>
					<!--Pessoa-->
					<tr>
						<td>
							<label class='titulo obrigatorio'>Pessoa</label>
						</td>
						<td>
							<input type='radio' name='pessoa' id='radioPessoaFisica' checked><label for='radioPessoaFisica'>Pessoa Física</label><br />
							<input type='radio' name='pessoa' id='radioPessoaJuridica' ><label for='radioPessoaJuridica'>Pessoa Jurídica</label>
						</td>
					</tr>
					<!--Nome-->
					<tr>
						<td>
							<label for='nome' class='titulo obrigatorio'>Nome</label>
						</td>
						<td>
							<input type='text' class='campo' name='nome' id='nome' placeholder='Nome' maxlength='100'>
						</td>
					</tr>
					<!--Nome Responsavel-->
					<tr class='camposJuridico'>
						<td>
							<label for='nomeResponsavel' class='titulo'>Nome Responsavel</label>
						</td>
						<td>
							<input type='text' class='campo' name='nomeResponsavel' id='nomeResponsavel' placeholder='Nome Responsável' maxlength='100'>
						</td>
					</tr>
					<!--CNPJ-->
					<tr class="camposJuridico">
						<td>
							<label for='cnpj obrigatorio' class='titulo'>CNPJ</label>
						</td>
						<td>
							<input type='text' class='campo' name='cnpj' id='cnpj' placeholder='CNPJ' maxlength='18'>
						</td>
					</tr>
					<!--Informações tributárias-->
					<tr class="camposJuridico">
						<td>
							<label for='radioInformacoesTributarias' class='titulo obrigatorio'>Informações Tributárias</label>
						</td>
						<td>
							<input type='radio' name='radioInformacoesTributarias' id='radioInformacoesTributariasContribuinte' >
								<label for='radioInformacoesTributariasContribuinte'>Contribuinte ICMS</label><br />
							<input type='radio' name='radioInformacoesTributarias' id='radioInformacoesTributariasNaoContribuinte' >
								<label for='radioInformacoesTributariasNaoContribuinte'>Não Contribuinte</label><br />
							<input type='radio' name='radioInformacoesTributarias' id='radioInformacoesTributariasIsento' >
								<label for='radioInformacoesTributariasIsento'>Isento de Inscrição Estadual</label>
						</td>
					</tr>
					<!--Inscrição Estadual-->
					<tr class="camposJuridico">
						<td>
							<label for='inscricaoEstadual' class='titulo obrigatorio'>Inscrição Estadual</label>
						</td>
						<td>
							<input type='text' class='campo' name='inscricaoEstadual' id='inscricaoEstadual' placeholder='Inscrição Estadual' maxlength='20'>
						</td>
					</tr>
					<!--CPF-->
					<tr class="camposFisico">
						<td>
							<label for='cpf' class='titulo obrigatorio'>CPF</label>
						</td>
						<td>
							<input type='text' class='campo' name='cpf' id='cpf' placeholder='CPF' maxlength='14'>
						</td>
					</tr>
					<!--DataNascimento-->
					<tr class="camposFisico">
						<td>
							<label for='nascimento' class='titulo obrigatorio'>Data Nascimento</label>
						</td>
						<td>
							<input type='date' class='campo' name='nascimento' id='nascimento' placeholder='Data de Nascimento' maxlength='14'>
						</td>
					</tr>
					<!--Sexo-->
					<tr class="camposFisico">
						<td>
							<label for='sexo' class='titulo obrigatorio'>Sexo</label>
						</td>
						<td>
							<input type='radio' name='radioInformacoesTributarias' id='radioSexoMasculino' ><label for='radioSexoMasculino'>Masculino</label><br />
							<input type='radio' name='radioInformacoesTributarias' id='radioSexoFeminino' ><label for='radioSexoFeminino'>Feminino</label>
						</td>
					</tr>
					<!--Telefone-->
					<tr>
						<td>
							<label for='telefone' class='titulo'>Telefone</label>
						</td>
						<td>
							<input type='text' class='campo' name='telefone' id='telefone' placeholder='Telefone' maxlength='17'>
						</td>
					</tr>
					<!--Celular-->
					<tr>
						<td>
							<label for='celular' class='titulo obrigatorio'>Celular</label>
						</td>
						<td>
							<input type='text' class='campo' name='celular' id='celular' placeholder='Celular' maxlength='17'>
						</td>
					</tr>
					<!--E-mail-->
					<tr>
						<td>
							<label for='email' class='titulo obrigatorio'>E-mail</label>
						</td>
						<td>
							<input type='email' class='campo' name='email' id='email' placeholder='E-mail' maxlength='100'>
						</td>
					</tr>
					<!--Senha-->
					<tr>
						<td>
							<label for='senha' class='titulo obrigatorio'>Senha</label>
						</td>
						<td>
							<input type='password' class='campo' name='senha' id='senha' placeholder='Senha'>
						</td>
					</tr>
					<!--Quebra de Linha-->
					<tr>
						<td colspan='2'>
							<br />
						</td>
					</tr>
					<!--Oferta Email-->
					<tr>
						<td colspan='2'>
							<input type='checkbox' name='ofertaEmail' id='ofertaEmail'><label for='ofertaEmail'>Desejo Receber informações por e-mail</label>
						</td>
					</tr>
					<!--Oferta Celular-->
					<tr>
						<td colspan='2'>
							<input type='checkbox' name='ofertaCelular' id='ofertaCelular'><label for='ofertaCelular'>Desejo Receber informações por celular</label>
						</td>
					</tr>
					<!--Quebra de Linha-->
					<tr>
						<td colspan='2'>
							<br />
						</td>
					</tr>
					<!--CEP-->
					<tr>
						<td>
							<label for='cep' class='titulo obrigatorio'>CEP</label>
						</td>
						<td>
							<input type='text' class='campo' name='cep' id='cep' placeholder='CEP' maxlength='9'>
						</td>
					</tr>
					<!--Endereço-->
					<tr>
						<td>
							<label for='endereco' class='titulo obrigatorio'>Endereço</label>
						</td>
						<td>
							<input type='text' class='campo' name='endereco' id='endereco' placeholder='Endereço' maxlength='100'>
						</td>
					</tr>
					<!--Número-->
					<tr>
						<td>
							<label for='numero' class='titulo obrigatorio'>Número</label>
						</td>
						<td>
							<input type='number' class='campo' name='numero' id='numero' placeholder='Número' min="1">
						</td>
					</tr>
					<!--Complemento-->
					<tr>
						<td>
							<label for='complemento' class='titulo'>Complemento</label>
						</td>
						<td>
							<input type='text' class='campo' name='complemento' id='complemento' placeholder='Complemento' maxlength='30'>
						</td>
					</tr>
					<!--Bairro-->
					<tr>
						<td>
							<label for='bairro' class='titulo obrigatorio'>Bairro</label>
						</td>
						<td>
							<input type='text' class='campo' name='bairro' id='bairro' placeholder='Bairro' maxlength='30'>
						</td>
					</tr>
					<!--Cidade-->
					<tr>
						<td>
							<label for='cidade' class='titulo obrigatorio'>Cidade</label>
						</td>
						<td>
							<input type='text' class='campo' name='cidade' id='cidade' placeholder='Cidade' maxlength='50'>
						</td>
					</tr>
					<!--Estado-->
					<tr>
						<td>
							<label for='estado' class='titulo obrigatorio'>Estado</label>
						</td>
						<td>
							<select class='campo'>
								<option value='' disabled label selected>Estados</option>
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
						</td>
					</tr>
					<!--Ponto de Referencia-->
					<tr>
						<td colspan='2'>
							<label for='referencia' class='titulo'>Referencia</label>
						</td>
					</tr>
					<tr>
						<td colspan='2'>
							<textarea class='campo' name='referencia' id='referencia' maxlength="500" rows="10"></textarea>
						</td>
					</tr>
					<!--Botões-->
					<tr>
						<td colspan=2 align=center style="width: 100%">
							<input name="botaoEnviar" type="submit" id="botaoEnviar" value="Enviar" />
							<input name="botaoLimpar" type="reset" id="botaoLimpar" value="Limpar" />
						</td>
					</tr>
				</table>
			</form>
		<?php
		}
	}

?>