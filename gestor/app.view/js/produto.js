/*
 *	Arquivo  produto.js
 *	Javascript do arquivo produto.class.php e produtos.class.php
 *	
 *	Sistema:	Doce___Bacana_Lingerie
 *	Autor:      Rogério Eduardo Pereira
 *	Data:       28/01/2015
 */
var files;

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
	
	
	var combo = $('.divCores').html();
	combo = combo.split("#numero#").join(numeroCor);	//Método alternativo para o replace usando em todas as ocorrencias... o replace substitui só a primeira
			
	var data =	"	<tr>																																					" +
				"		<td>																																				" +
				"			Cores Definidas																																	" +
				"		</td>																																				" +
				"		<td>																																				" +
							combo																																			  +
				"		</td>																																				" +
				"	</tr>																																					" +
				"	<tr>																																					" +
				"		<td>																																				" +
				"			Nome																																			" +
				"			<input type='hidden' name='corSalva_" + numeroCor + "' id='corSalva_" + numeroCor + "'	value='0'>												" +
				"		</td>																																				" +
				"		<td>																																				" +
				"			<input type='text' class='campo' name='nomeCor_" + numeroCor + "' id='nomeCor_" + numeroCor + "' placeholder='Nome' maxlength='20'>				" +
				"		</td>																																				" +
				"	</tr>																																					" +
				"	<tr>																																					" +
				"		<td>																																				" +
				"			Cor 1																																			" +
				"		</td>																																				" +
				"		<td>																																				" +
				"			<input																																			" +
				"				type='color'																																" +
				"				class='campo cor_" + numeroCor + "'																											" +
				"				name='cor1_" + numeroCor + "'																												" +
				"				id='cor1_" + numeroCor + "'																													" +
				"				placeholder='Cor 1'																															" +
				"				onchange=\"alteraCor('cor_" + numeroCor + "', this.value)\"																					" +
				"			>																																				" +
				"		</td>																																				" +
				"	</tr>																																					" +
				"	<tr>																																					" +
				"		<td>																																				" +
				"			Cor 2																																			" +
				"		</td>																																				" +
				"		<td>																																				" +
				"			<input																																			" +
				"				type='color'																																" +
				"				class='campo cor_" + numeroCor + "'																											" +
				"				name='cor2_" + numeroCor + "'																												" +
				"				id='cor2_" + numeroCor + "'																													" +
				"				placeholder='Cor 1'																															" +
				"			>																																				" +
				"		</td>																																				" +
				"	</tr>																																					" +
				"	<tr>																																					" +
				"		<td>																																				" +
				"			Banner																																			" +
				"		</td>																																				" +
				"		<td>																																				" +
				//"			<input type='checkbox' name='banner1_"	+ numeroCor + "' class='chkBanner1_"	+ numeroCor + "'	value='1'>Banner 1<br>						" +
				//"			<input type='checkbox' name='banner2_"	+ numeroCor + "' class='chkBanner2_"	+ numeroCor + "'	value='1'>Banner 2<br>						" +
				//"			<input type='checkbox' name='banner3_"	+ numeroCor + "' class='chkBanner3_"	+ numeroCor + "'	value='1'>Banner 3<br>						" +
				"			<input type='checkbox' name='home_"		+ numeroCor + "' class='chkHome_"		+ numeroCor + "'	value='1'>Home<br>							" +
				"		</td>																																				" +
				"	</tr>																																					" +
				"	<tr>																																					" +
				"		<td>																																				" +
				"			Foto																																			" +
				"		</td>																																				" +
				"		<td>																																				" +
				"			<input type='file' class='arquivo' name='foto_" + numeroCor + "' id='foto_" + numeroCor + "' placeholder='Foto''>								" +
				"		</td>																																				" +
				"	</tr>																																					" +
				"	<tr><td colspan='2'><hr></td></tr>																														";
	
	
	$("#produtoCor").append(data);
}

function alteraCor(element, value)
{
	$("."+element).val(value);
}

function prepareUpload()
{
	$(".arquivo").each(function( index, value)
	{
		files.push(this.files[0]);
	});
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

function validaProduto()
{
	tinyMCE.triggerSave();
	//Referencia
	if( $("#referencia").val() == '')
	{
		alert( "Campo em branco: Referencia" );
		$('#referencia').focus();
		return;
	}
	//Categoria
	if ($("#categoria").find(":selected").val() == '')
	{
		alert( "Campo em branco: Categoria" );
		$('#categoria').focus();
		return;
	}
	//Descrição	
	if( $("#descricao").val() == '')
	{
		alert( "Campo em branco: Descrição" );
		$('#descricao').focus();
		return;
	}
	//Caracteristicas	
	if( $("#caracteristicas").val() == '')
	{
		alert( "Campo em branco: Caracteristicas" );
		$('#caracteristicas').focus();
		return;
	}
	//Cores
	for(i=1; i<=parseInt($('#numeroCor').val()); i++)
	{
		//NomeCor
		if( $("#nomeCor_"+i.toString()).val() == '')
		{
			alert( "Campo em branco: Nome Cor "+i.toString );
			$("#nomeCor_"+i.toString()).focus();
			return;
		}
		//Foto Cor
		if( $("#foto_"+i.toString()).val() == '')
		{
			alert( "Campo em branco: Foto Cor "+i.toString );
			$("#foto_"+i.toString()).focus();
			return;
		}
	}
	
	if (valida = true)
		salvarProduto();
}

function salvarProduto()
{
	var cores = '\0';
	var tamPP;
	var tamP;
	var tamM;
	var tamG;
	var tamGG;
	var tam48;
	var tam50;
	var tam52;
	var tam54;
	
	prepareUpload();
	
	for(i=1; i<=parseInt($('#numeroCor').val()); i++)
	{	
		cores = cores.concat($("#nomeCor_"+i).val()).concat('¬');
		cores = cores.concat($("#cor1_"+i).val()).concat('¬');
		cores = cores.concat($("#cor2_"+i).val()).concat('¬');
		
		if ($(".chkBanner1_"+i).is(":checked"))
			cores = cores.concat('1¬');
		else
			cores = cores.concat('0¬');
		
		if ($(".chkBanner2_"+i).is(":checked"))
			cores = cores.concat('1¬');
		else
			cores = cores.concat('0¬');
		
		if ($(".chkBanner3_"+i).is(":checked"))
			cores = cores.concat('1¬');
		else
			cores = cores.concat('0¬');
		
		if ($(".chkHome_"+i).is(":checked"))
			cores = cores.concat('1');
		else
			cores = cores.concat('0');
		
		if(i < parseInt($('#numeroCor').val()))
			cores = cores.concat('¢');
	}
	
	if ($("#tamanhoPP").is(":checked"))
		tamPP = 1;
	else
		tamPP = 0;
	
	if ($("#tamanhoP").is(":checked"))
		tamP = 1;
	else
		tamP = 0;
	
	if ($("#tamanhoM").is(":checked"))
		tamM = 1;
	else
		tamM = 0;
	
	if ($("#tamanhoG").is(":checked"))
		tamG = 1;
	else
		tamG = 0;
	
	if ($("#tamanhoGG").is(":checked"))
		tamGG = 1;
	else
		tamGG = 0;
	
	if ($("#tamanho48").is(":checked"))
		tam48 = 1;
	else
		tam48 = 0;
	
	if ($("#tamanho50").is(":checked"))
		tam50 = 1;
	else
		tam50 = 0;
	
	if ($("#tamanho52").is(":checked"))
		tam52 = 1;
	else
		tam52 = 0;
	
	if ($("#tamanho54").is(":checked"))
		tam54 = 1;
	else
		tam54 = 0;
	
	/*$.ajax
	({
		type: "POST",
		url: "/app.control/ajax.php",
		data: 
		{
			codigo:				$('#codigo').val(),
			numeroCor:			$('#numeroCor').val(),
			referencia:			$("#referencia").val(),
			categoria:			$("#categoria").val(),
			descricao:			$("#descricao").val(),
			caracteristicas:	$("#caracteristicas").val(),
			tamanhoPP:			tamPP,
			tamanhoP:			tamP,
			tamanhoM:			tamM,
			tamanhoG:			tamG,
			tamanhoGG:			tamGG,
			tamanho48:			tam48,
			tamanho50:			tam50,
			tamanho52:			tam52,
			tamanho54:			tam54,
			cores:				cores,
			arquivos:			files,
			formularioNome:		'salvaProduto'
		},
		success: function(data) 
		{
			alert(data);
			//top.location='/produtos';
		}
	});*/
	
	var formData = $('#salvaProduto').serialize();
	
	$.each(data.files, function(key, value)
	{
		formData = formData + '&filenames[]=' + value;
	});
	
	$.ajax({
		url: '/app.control/ajaxUpload.php',
		type: 'POST',
		data: formData,
		cache: false,
		dataType: 'json',
		success: function(data, textStatus, jqXHR)
		{
			if(typeof data.error === 'undefined')
			{
				// Success so call function to process the form
				alert(data);
				//console.log('SUCCESS: ' + data.success);
			}
			else
			{
				// Handle errors here
				console.log('ERRORS: ' + data.error);
			}
		},
		error: function(jqXHR, textStatus, errorThrown)
		{
			// Handle errors here
			console.log('ERRORS: ' + textStatus);
		},
		complete: function()
		{
			// STOP LOADING SPINNER
		}
});
}

function removeCor(codProd, codCor)
{
	$.ajax
	({
		type: "POST",
		url: "/app.control/ajax.php",
		data: 
		{
			codProd:		codProd,
			codCor:			codCor,
			formularioNome:	'apagaCor'
		},
		success: function(data) 
		{
			//$('.corSalva').empty();
			//$('.corSalva').html(data);
			location.reload();
		}
	});
}

function apagaProdutos()
{
	var arrCod = [];
	$(".chkProdutosApagar:checked").each(function() {
		arrCod.push($(this).val());
	});
	
	$.ajax
	({
		type: "POST",
		url: "/app.control/ajax.php",
		data: 
		{
			codigos:		arrCod,
			formularioNome:	'apagaProdutos'
		},
		success: function(data) 
		{
			$('.tabelaFormulario').html(data);
		}
	});	
}

function selecionaCorDefinida(componente)
{
	$.ajax
	({
		type: "POST",
		url: "/app.control/ajax.php",
		data: 
		{
			codigo:			$('.'+componente).val(),
			formularioNome:	'buscaCorDefinida'
		},
		success: function(data) 
		{
			data = data.split("~");
			$('#nomeCor_'+componente).val(data[0]);
			$('#cor1_'+componente).val(data[1]);
			$('#cor2_'+componente).val(data[2]);
		}
	});	
}