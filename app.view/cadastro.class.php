<?php
/*
 *	Arquivo  cadastro.class.php
 *	Tela de Cadastro de Usuarios
 *	
 *	Sistema:	Doce___Bacana_Lingerie
 *	Autor:      Rog�rio Eduardo Pereira
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
						<input type='radio' name='pessoa' id='radioPessoaFisica' checked>Pessoa F�sica
						<input type='radio' name='pessoa' id='radioPessoaJuridica' >Pessoa Jur�dica
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
						<input type='text' name='nomeResponsavel' id='nomeResponsavel' placeholder='Nome Respons�vel' maxlength='100'>
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
				<!--Informa��es tribut�rias-->
				<tr class="camposJuridico">
					<td>
						<label for='radioInformacoesTributarias'>Informa��es Tribut�rias</label>
					</td>
					<td>
						<input type='radio' name='radioInformacoesTributarias' id='radioInformacoesTributariasContribuinte' >Contribuinte ICMS
						<input type='radio' name='radioInformacoesTributarias' id='radioInformacoesTributariasNaoContribuinte' >N�o Contribuinte
						<input type='radio' name='radioInformacoesTributarias' id='radioInformacoesTributariasIsento' >Isento de Inscri��o Estadual
					</td>
				</tr>
				<!--Inscri��o Estadual-->
				<tr class="camposJuridico">
					<td>
						<label for='inscricaoEstadual'>Inscri��o Estadual</label>
					</td>
					<td>
						<input type='text' name='inscricaoEstadual' id='inscricaoEstadual' placeholder='Inscri��o Estadual' maxlength='20'>
					</td>
				</tr>
			</table>
		<?php
		}
	}

?>