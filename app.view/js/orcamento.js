/*
 *	Arquivo  orcamento.js
 *	Javascript do arquivo orcamento.class.php
 *	
 *	Sistema:	Doce___Bacana_Lingerie
 *	Autor:      Rogério Eduardo Pereira
 *	Data:       11/02/2015
 */
function alteraQuantidade(componente)
{
	var classes = $(componente).attr('class').split(' ');
	
	$.ajax
	({
		type: "POST",
		url: "/app.control/ajax.php",
		data: 
		{
			codigo:			classes[2],
			campo:			classes[3],
			valor:			$(componente).val(),
			formularioNome:	'alteraQuantidadeOrcamento'
		},
		success: function(data) 
		{
			
		}
	});
}

function removeOrcamento(codigo)
{
	$.ajax
	({
		type: "POST",
		url: "/app.control/ajax.php",
		data: 
		{
			codigo:			codigo,
			formularioNome:	'apagarOrcamento'
		},
		success: function(data) 
		{	
			//alert(data);
			$('.tabelaFormulario').html(data);
		}
	});
}

function enviaOrcamento()
{
	$.ajax
	({
		type: "POST",
		url: "/app.control/ajax.php",
		data: 
		{
			formularioNome:	'enviaOrcamento'
		},
		success: function(data) 
		{	
			$('.retornoAjax').html(data);
		}
	});
}

function selecionaOrcamento()
{
	var codigo = $('input[name=radioOrcamento]:checked').val();
	
	top.location='/meuOrcamento/'+codigo;
}