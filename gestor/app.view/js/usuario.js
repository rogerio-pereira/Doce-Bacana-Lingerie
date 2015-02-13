/*
 *	Arquivo  usuario.js
 *	Javascript do arquivo usuario.class.php e usuarios.class.php
 *	
 *	Sistema:	Doce___Bacana_Lingerie
 *	Autor:      Rogério Eduardo Pereira
 *	Data:       27/01/2015
 */
function novoUsuario()
{
	top.location='/usuario/';
}

function alteraUsuario()
{
	var codigo = $('input[name=radioUsuario]:checked').val();
	
	top.location='/usuario/'+codigo;
}

function validaUsuario()
{
	var valida;
	valida = true;
	
	if($('#nome').val() == '')
	{
		alert('Digite um nome');
		$('#nome').focus();
		return;
	}
	if($('#usuario').val() == '')
	{
		alert('Digite um login');
		$('#usuario').focus();
		return;
	}
	if($('#codigo').val() == '')
	{
		//Senha
		if( $("#senha").val() == '')
		{
			alert( "Campo em branco: Senha" );
			$('#senha').focus();
			return false;
		}
		//Confirmacao de Senha
		if( $("#confirmacao").val() == '')
		{
			alert( "Campo em branco: Confirmação de Senha" );
			$('#confirmacao').focus();
			return false;
		}
		//Igualdade de Senha
		if( $("#senha").val() != $("#confirmacao").val())
		{
			alert( "Confirmação de Senha diferente da Senha" );
			$("#senha").val('');
			$("#confirmacao").val('');
			$('#senha').focus();
			return false;
		}	
	}
	
	if (valida = true)
		salvarUsuario();
}

function salvarUsuario()
{
	if ($('#checkCategoria').is(":checked"))
		cat = 1;
	else
		cat = 0;
	
	if ($('#checkUsuario').is(":checked"))
		user = 1;
	else
		user = 0;
	
	if ($('#checkProduto').is(":checked"))
		prod = 1;
	else
		prod = 0;
	
	if ($('#checkOrcamento').is(":checked"))
		orc = 1;
	else
		orc = 0;
	
	$.ajax
	({
		type: "POST",
		url: "/app.control/ajax.php",
		data: 
		{
			codigo:			$('#codigo').val(),
			nome:			$('#nome').val(),
			usuario:		$('#login').val(),
			senha:			$('#senha').val(),
			telaCategoria:	cat,
			telaOrcamento:	orc,
			telaProduto:	prod,
			telaUsuario:	user,
			formularioNome:	'salvaUsuario'
		},
		success: function(data) 
		{
			alert("Usuario Cadastrado com sucesso!");
			top.location='/usuarios';
		}
	});
}

function apagaUsuario()
{
	var arrCod = [];
	$(".chkUsuariosApagar:checked").each(function() {
		arrCod.push($(this).val());
	});
	
	$.ajax
	({
		type: "POST",
		url: "/app.control/ajax.php",
		data: 
		{
			codigos:		arrCod,
			formularioNome:	'apagaUsuarios'
		},
		success: function(data) 
		{
			$('.tabelaFormulario').html(data);
		}
	});	
}

function validaAlteracaoSenha()
{
	var valida;
	valida = true;
	
	if($('#senhaAtual').val() == '')
	{
		alert('Campo em branco: Senha Atual');
		$('#senhaAtual').focus();
		return false;
	}
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
		alteraSenha();
}

function alteraSenha()
{
	$.ajax
	({
		type: "POST",
		url: "/app.control/ajax.php",
		data: 
		{
			senhaAtual:		$('#senhaAtual').val(),
			senhaNova:		$('#senhaNova').val(),
			formularioNome:	'alteraSenha'
		},
		success: function(data) 
		{
			alert(data);
			top.location='/';
		}
	});
}