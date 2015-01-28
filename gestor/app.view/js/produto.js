/*
 *	Arquivo  produto.js
 *	Javascript do arquivo produto.class.php e produtos.class.php
 *	
 *	Sistema:	Doce___Bacana_Lingerie
 *	Autor:      Rogério Eduardo Pereira
 *	Data:       28/01/2015
 */
function iniciaTextArea()
{
	tinymce.init
	({
		selector: "#caracteristicas",
		height: 200,
		toolbar: " bold italic underline | bullist numlist |",
		menubar: false,
		statusbar: false
	});
}

function insereCor()
{
	var numeroCor = (parseInt($('#numeroCor').val()) + 1);
	$('#numeroCor').val(numeroCor.toString());
			
	var data =	"	<tr>																																			" +
				"		<td>																																		" +
				"			Nome																																	" +
				"		</td>																																		" +
				"		<td>																																		" +
				"			<input type='text' class='campo' name='nomeCor_" + numeroCor + "' id='nomeCor" + numeroCor + "' placeholder='Nome' maxlength='20'>		" +
				"		</td>																																		" +
				"	</tr>																																			" +
				"	<tr>																																			" +
				"		<td>																																		" +
				"			Cor 1																																	" +
				"		</td>																																		" +
				"		<td>																																		" +
				"			<input type='color' class='campo' name='cor1_" + numeroCor + "' id='cor1_" + numeroCor + "' placeholder='Cor 1'>						" +
				"		</td>																																		" +
				"	</tr>																																			" +
				"	<tr>																																			" +
				"		<td>																																		" +
				"			Cor 2																																	" +
				"		</td>																																		" +
				"		<td>																																		" +
				"			<input type='color' class='campo' name='cor2_" + numeroCor + "' id='cor2_" + numeroCor + "' placeholder='Cor 2'>						" +
				"		</td>																																		" +
				"	</tr>																																			" +
				"	<tr>																																			" +
				"		<td>																																		" +
				"			Banner																																	" +
				"		</td>																																		" +
				"		<td>																																		" +
				"			<input type='checkbox' name='banner1_" + numeroCor + "' class='chkBanner1_" + numeroCor + "'	value='1'>Banner 1<br>					" +
				"			<input type='checkbox' name='banner2_" + numeroCor + "' class='chkBanner2_" + numeroCor + "'	value='1'>Banner 2<br>					" +
				"			<input type='checkbox' name='banner3_" + numeroCor + "' class='chkBanner3_" + numeroCor + "'	value='1'>Banner 3<br>					" +
				"			<input type='checkbox' name='home_" + numeroCor + "'	class='chkHome_" + numeroCor + "'		value='1'>Home<br>						" +
				"		</td>																																		" +
				"	</tr>																																			";
	
	
	$("#produtoCor").append(data);
}

function novoProduto()
{
	top.location='/produto/';
}

function alteraProduto()
{
	var codigo = $('input[name=radioProduto]:checked').val();
	
	top.location='/produto/'+codigo;
}