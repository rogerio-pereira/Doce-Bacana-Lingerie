/*
 *	Arquivo  categoria.js
 *	Javascript do arquivo categoria.class.php e categorias.class.php
 *	
 *	Sistema:	Doce___Bacana_Lingerie
 *	Autor:      Rogério Eduardo Pereira
 *	Data:       27/01/2015
 */
function novaCategoria()
{
	top.location='/categoria/';
}

function alteraCategoria()
{
	var codigo = $('input[name=radioCategoria]:checked').val();
	
	top.location='/categoria/'+codigo;
}

function validaCategoria()
{
	var valida;
	valida = true;
	
	if ($('#nome').val() == '')
	{
		alert('Digite um nome');
		$('#nome').focus();
		return;
	}
	
	if (valida = true)
		salvarCategoria();
}

function salvarCategoria()
{
	$.ajax
	({
		type: "POST",
		url: "/app.control/ajax.php",
		data: 
		{
			codigo:			$('#codigo').val(),
			nome:			$('#nome').val(),
			formularioNome:	'salvaCategoria'
		},
		success: function(data) 
		{
			alert("Categoria Cadastrado com sucesso!");
			top.location='/categorias';
		}
	});
}

function apagaCategorias()
{
	var arrCod = [];
	$(".chkCategoriasApagar:checked").each(function() {
		arrCod.push($(this).val());
	});
	
	$.ajax
	({
		type: "POST",
		url: "/app.control/ajax.php",
		data: 
		{
			codigos:		arrCod,
			formularioNome:	'apagaCategorias'
		},
		success: function(data) 
		{
			$('.tabelaFormulario').html(data);
		}
	});	
}