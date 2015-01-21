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
			<table class='tabelaFormulario'>
				<!--Pessoa-->
				<tr>
					<td>
						<label>Pessoa</label>
					</td>
					<td>
						<input type='radio' name='pessoa' id='radioPessoaFisica' checked>Pessoa Física
						<input type='radio' name='pessoa' id='radioPessoaJuridica' >Pessoa Jurídica
					</td>
				</tr>
				<!--Nome-->
				<tr>
					<td>
						<label for='nome'>Nome</label>
					</td>
					<td>
						<input type='text' name='nome' id='nome' placeholder='Nome' maxlength='100'>
					</td>
				</tr>
				<!--Nome Responsavel-->
				<tr class='camposJuridico'>
					<td>
						<label for='nomeResponsavel'>Nome Responsavel</label>
					</td>
					<td>
						<input type='text' name='nomeResponsavel' id='nomeResponsavel' placeholder='Nome Responsável' maxlength='100'>
					</td>
				</tr>
				<!--CNPJ-->
				<tr class="camposJuridico">
					<td>
						<label for='cnpj'>CNPJ</label>
					</td>
					<td>
						<input type='text' name='cnpj' id='cnpj' placeholder='CNPJ' maxlength='18'>
					</td>
				</tr>
				<!--Informações tributárias-->
				<tr class="camposJuridico">
					<td>
						<label for='radioInformacoesTributarias'>Informações Tributárias</label>
					</td>
					<td>
						<input type='radio' name='radioInformacoesTributarias' id='radioInformacoesTributariasContribuinte' >Contribuinte ICMS
						<input type='radio' name='radioInformacoesTributarias' id='radioInformacoesTributariasNaoContribuinte' >Não Contribuinte
						<input type='radio' name='radioInformacoesTributarias' id='radioInformacoesTributariasIsento' >Isento de Inscrição Estadual
					</td>
				</tr>
				<!--Inscrição Estadual-->
				<tr class="camposJuridico">
					<td>
						<label for='inscricaoEstadual'>Inscrição Estadual</label>
					</td>
					<td>
						<input type='text' name='inscricaoEstadual' id='inscricaoEstadual' placeholder='Inscrição Estadual' maxlength='20'>
					</td>
				</tr>
			</table>
		<?php
		}
	}

?>