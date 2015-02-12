/*
 *	Arquivo  orcamento.js
 *	Javascript do arquivo orcamento.class.php
 *	
 *	Sistema:	Doce___Bacana_Lingerie
 *	Autor:      Rogério Eduardo Pereira
 *	Data:       12/02/2015
 */

function selecionaOrcamento()
{
	var codigo = $('input[name=radioOrcamento]:checked').val();
	
	top.location='/orcamento/'+codigo;
}

function atualizaOrcamento()
{
	var rastreio;
	if($('#codigoRastreio').val() == '')
		rastreio = '';
	else
		rastreio = $('#codigoRastreio').val();
	
	$.ajax
	({
		type: "POST",
		url: "/app.control/ajax.php",
		data: 
		{
			codigo:			$('#codigo').val(),
			status:			$('#status').val(),
			rastreio:		rastreio,
			formularioNome:	'atualizaOrcamento'
		},
		success: function(data) 
		{
			alert(data);
			top.location='/orcamentos';
		}
	});
}