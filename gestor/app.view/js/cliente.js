/*
 *	Arquivo  cliente.js
 *	Javascript do arquivo cliente.class.php
 *	
 *	Sistema:	Doce___Bacana_Lingerie
 *	Autor:      Rogério Eduardo Pereira
 *	Data:       20/02/2015
 */
function visualizaCliente()
{
	var codigo = $('input[name=radioCliente]:checked').val();
	
	top.location='/cliente/'+codigo;
}
function redirecionaSenhaCliente()
{
	var codigo = $('input[name=radioCliente]:checked').val();
	
	top.location='/alteraSenhaCliente/'+codigo;
}

function validaAlteracaoSenhaCliente()
{
	var valida;
	valida = true;
	
	if($('#senhaNova').val() == '')
	{
		alert('Campo em branco: Senha Nova');
		$('#senhaNova').focus();
		return false;
	}
	if($('#confirmacao').val() == '')
	{
		alert('Campo em branco: Confirmação de Senha');
		$('#confirmacao').focus();
		return false;
	}
	if( $("#senhaNova").val() != $("#confirmacao").val())
	{
		alert( "Confirmação de Senha diferente da Senha" );
		$("#senhaNova").val('');
		$("#confirmacao").val('');
		$('#senhaNova').focus();
		return false;
	}	
	
	if (valida = true)
		alteraSenhaCliente();
}

function alteraSenhaCliente()
{
	$.ajax
	({
		type: "POST",
		url: "/app.control/ajax.php",
		data: 
		{
			codigo:			$('#codigo').val(),
			senhaNova:		$('#senhaNova').val(),
			formularioNome:	'alteraSenhaCliente'
		},
		success: function(data) 
		{
			alert(data);
			top.location='/';
		}
	});
}

function apagaClientes()
{
	var arrCod = [];
	$(".chkClientesApagar:checked").each(function() {
		arrCod.push($(this).val());
	});
	
	$.ajax
	({
		type: "POST",
		url: "/app.control/ajax.php",
		data: 
		{
			codigos:		arrCod,
			formularioNome:	'apagaClientes'
		},
		success: function(data) 
		{
			$('.tabelaFormulario').html(data);
		}
	});	
}