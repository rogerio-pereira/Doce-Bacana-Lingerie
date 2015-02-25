/*
 *	Arquivo  cadastro.js
 *	Javascript do arquivo cadastro.class.php
 *	
 *	Sistema:	Doce___Bacana_Lingerie
 *	Autor:      Rogério Eduardo Pereira
 *	Data:       22/01/2015
 */
function adicionaMascaras ()
{
    $("#cpf").mask("999.999.999-99");
    $("#cnpj").mask("99.999.999/9999-99");
	$("#cep").mask("99999-999");
	$("#telefone").mask("(99) 9999 - 9999?9").ready(function(event) 
	{
        var target, phone, element;
        target = (event.currentTarget) ? event.currentTarget : event.srcElement;
        phone = target.value.replace(/\D/g, '');
        element = $(target);
        element.unmask();
        if(phone.length > 10) 
            element.mask("(99) 99999-999?9");
        else
            element.mask("(99) 9999-9999?9");
    });
	$("#celular").mask("(99) 9999 - 9999?9").ready(function(event) 
	{
        var target, phone, element;
        target = (event.currentTarget) ? event.currentTarget : event.srcElement;
        phone = target.value.replace(/\D/g, '');
        element = $(target);
        element.unmask();
        if(phone.length > 10) 
            element.mask("(99) 99999-999?9");
        else
            element.mask("(99) 9999-9999?9");
    });
};

function selecionaPessoaFisica()
{
	$(".camposFisico").show();
	$(".camposJuridico").hide();
}

function selecionaPessoaJuridica()
{
	$(".camposFisico").hide();
	$(".camposJuridico").show();
}

function selecionaInformacoesTributarias()
{
	if($("#radioInformacoesTributariasIsento").is(":checked") == true)
		$("#inscricaoEstadual").attr('disabled','disabled');  
	else
		$("#inscricaoEstadual").removeAttr('disabled');
}

function validaEmail(field)
{
	usuario = field.substring(0, field.indexOf("@"));
	dominio = field.substring(field.indexOf("@")+ 1, field.length);
	if ( (usuario.length >=1) &&
			(dominio.length >=3) &&
			(usuario.search("@")==-1) &&
			(dominio.search("@")==-1) &&
			(usuario.search(" ")==-1) &&
			(dominio.search(" ")==-1) &&
			(dominio.search(".")!=-1) &&
			(dominio.indexOf(".") >=1)&&
			(dominio.lastIndexOf(".") < dominio.length - 1) )
	{
		return true;
	}
	else
		return false
}

function validaCamposCadastroCliente()
{
	//Nome
	if( $("#nome").val() == '')
	{
		alert( "Campo em branco: Nome" );
		$('#nome').focus();
		return false;
	}
	//Pessoa
	if (($("#radioPessoaFisica").is(":checked") == false) && ($("#radioPessoaJuridica").is(":checked") == false))
	{
		alert( "Campo em branco: Tipo Pessoa" );
		$('#radioPessoaFisica').focus();
		return false;
	}
	//Pessoa Fisica
	if($("#radioPessoaFisica").is(":checked") == true)
	{
		//CPF
		if( $("#cpf").val() == '')
		{
			alert( "Campo em branco: CPF" );
			$('#cpf').focus();
			return false;
		}
		//Valida CPF
		else
		{
			cpf = $("#cpf").val();
			cpf = cpf.replace(/[^\d]+/g,'');
                    
			if(cpf == '') 
				return false;

			// Elimina CPFs invalidos conhecidos
			if (cpf.length != 11 || 
				cpf == "00000000000" || 
				cpf == "11111111111" || 
				cpf == "22222222222" || 
				cpf == "33333333333" || 
				cpf == "44444444444" || 
				cpf == "55555555555" || 
				cpf == "66666666666" || 
				cpf == "77777777777" || 
				cpf == "88888888888" || 
				cpf == "99999999999")
			{
				alert('CPF Inválido!');
				$("#cpf").val('');
				$('#cpf').focus();
				return false;
			}

			// Valida 1o digito
			add = 0;
			for (i=0; i < 9; i ++)
				add += parseInt(cpf.charAt(i)) * (10 - i);
			rev = 11 - (add % 11);
			if (rev == 10 || rev == 11)
				rev = 0;
			if (rev != parseInt(cpf.charAt(9)))
			{
				alert('CPF Inválido!');
				$("#cpf").val('');
				$('#cpf').focus();
				return false;
			}

			// Valida 2o digito
			add = 0;
			for (i = 0; i < 10; i ++)
				add += parseInt(cpf.charAt(i)) * (11 - i);
			rev = 11 - (add % 11);
			if (rev == 10 || rev == 11)
				rev = 0;
			if (rev != parseInt(cpf.charAt(10)))
			{
				alert('CPF Inválido!');
				$("#cpf").val('');
				$('#cpf').focus();
				return false;
			}
		}
		//Data de Nascimento
		if( $("#nascimento").val() == '')
		{
			alert( "Campo em branco: Data de Nascimento" );
			$('#nascimento').focus();
			return false;
		}
		//Sexo
		if (($("#radioSexoMasculino").is(":checked") == false) && ($("#radioSexoFeminino").is(":checked") == false))
		{
			alert( "Campo em branco: Sexo" );
			$('#radioSexoMasculino').focus();
			return false;
		}
	}
	//Pessoa Juridica
	if($("#radioPessoaJuridica").is(":checked") == true)
	{
		//CNPJ
		if( $("#cnpj").val() == '')
		{
			alert( "Campo em branco: CNPJ" );
			$('#cnpj').focus();
			return false;
		}
		//Valida CNPJ
		else
		{
			cnpj = $("#cnpj").val();
			cnpj = cnpj.replace(/[^\d]+/g,'');
                    
			if(cnpj == '') 
				return false;

			// Elimina CPFs invalidos conhecidos 86415314000170
			if (cnpj.length != 14 || 
				cnpj == "00000000000000" || 
				cnpj == "11111111111111" || 
				cnpj == "22222222222222" || 
				cnpj == "33333333333333" || 
				cnpj == "44444444444444" || 
				cnpj == "55555555555555" || 
				cnpj == "66666666666666" || 
				cnpj == "77777777777777" || 
				cnpj == "88888888888888" || 
				cnpj == "99999999999999")
			{
				alert('CNPJ Inválido!');
				$("#cnpj").val('');
				$('#cnpj').focus();
				return false;
			}

			// Valida 1o digito
			add = 0;
			aux = 5;
			for (i=0; i < 12; i ++)
			{
				if(i == 4)
					aux = 9;
				
				add += parseInt(cnpj.charAt(i)) * (aux);
				
				aux--;
			}
			
			rev = 11 - (add % 11);
			if (rev == 10 || rev == 11)
				rev = 0;
			if (rev != parseInt(cnpj.charAt(12)))
			{
				alert('CNPJ Inválido!');
				$("#cnpj").val('');
				$('#cnpj').focus();
				return false;
			}

			// Valida 2o digito
			add = 0;
			aux = 6;
			for (i = 0; i < 13; i ++)
			{
				if(i == 5)
					aux = 9;
				
				add += parseInt(cnpj.charAt(i)) * (aux);
				
				aux--;
			}
			rev = 11 - (add % 11);
			if (rev == 10 || rev == 11)
				rev = 0;
			if (rev != parseInt(cnpj.charAt(13)))
			{
				alert('CNPJ Inválido!');
				$("#cnpj").val('');
				$('#cnpj').focus();
				return false;
			}
		}
		//Informações Tributárias
		if	(
				($("#radioInformacoesTributariasContribuinte").is(":checked") == false) &&
				($("#radioInformacoesTributariasNaoContribuinte").is(":checked") == false) &&
				($("#radioInformacoesTributariasIsento").is(":checked") == false)
			)
		{
			alert( "Campo em branco: Informações Tributárias" );
			$('#radioInformacoesTributariasContribuinte').focus();
			return false;
		}
		//Inscrição Estadual
		if	(
				($("#radioInformacoesTributariasContribuinte").is(":checked") == true) ||
				($("#radioInformacoesTributariasNaoContribuinte").is(":checked") == true)
			)
		{
			if( $("#inscricaoEstadual").val() == '')
			{
				alert( "Campo em branco: Inscrição Estadual" );
				$('#inscricaoEstadual').focus();
				return false;
			}
		}
	}
	//E-mail
	if( $("#email").val() == '')
	{
		alert( "Campo em branco: E-mail" );
		$('#email').focus();
		return false;
	}
	//Valida Email
	else
	{
		if(validaEmail($("#email").val()) == false)
		{
			alert( "E-mail invalido!" );
			$("#email").val('');
			$('#email').focus();
			return false;
		}
	}
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
	//CEP
	if( $("#cep").val() == '')
	{
		alert( "Campo em branco: CEP" );
		$('#cep').focus();
		return false;
	}
	//Endereço
	if( $("#endereco").val() == '')
	{
		alert( "Campo em branco: Endereco" );
		$('#endereco').focus();
		return false;
	}
	//Numero
	if($("#numero").val() == '')
	{
		alert( "Campo em branco: Numero" );
		$('#numero').focus();
		return false;
	}
	//Bairro
	if( $("#bairro").val() == '')
	{
		alert( "Campo em branco: Bairro" );
		$('#bairro').focus();
		return false;
	}
	//Cidade
	if( $("#cidade").val() == '')
	{
		alert( "Campo em branco: Cidade" );
		$('#cidade').focus();
		return false;
	}
	//Estado
	if ($("#estado").find(":selected").val() == '')
	{
		alert( "Campo em branco: Estado" );
		$('#estado').focus();
		return false;
	}
}

function validaCamposAlterarCliente()
{
	//E-mail
	if( $("#email").val() == '')
	{
		alert( "Campo em branco: E-mail" );
		$('#email').focus();
		return false;
	}
	//Valida Email
	else
	{
		if(validaEmail($("#email").val()) == false)
		{
			alert( "E-mail invalido!" );
			$("#email").val('');
			$('#email').focus();
			return false;
		}
	}
	//CEP
	if( $("#cep").val() == '')
	{
		alert( "Campo em branco: CEP" );
		$('#cep').focus();
		return false;
	}
	//Endereço
	if( $("#endereco").val() == '')
	{
		alert( "Campo em branco: Endereco" );
		$('#endereco').focus();
		return false;
	}
	//Numero
	if($("#numero").val() == '')
	{
		alert( "Campo em branco: Numero" );
		$('#numero').focus();
		return false;
	}
	//Bairro
	if( $("#bairro").val() == '')
	{
		alert( "Campo em branco: Bairro" );
		$('#bairro').focus();
		return false;
	}
	//Cidade
	if( $("#cidade").val() == '')
	{
		alert( "Campo em branco: Cidade" );
		$('#cidade').focus();
		return false;
	}
	//Estado
	if ($("#estado").find(":selected").val() == '')
	{
		alert( "Campo em branco: Estado" );
		$('#estado').focus();
		return false;
	}
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

function validaNovaSenha()
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
		novaSenha();
}

function novaSenha()
{
	$.ajax
	({
		type: "POST",
		url: "/app.control/ajax.php",
		data: 
		{
			chave:			$('#chave').val(),
			senhaNova:		$('#senhaNova').val(),
			formularioNome:	'novaSenha'
		},
		success: function(data) 
		{
			$('.retornoAjax').html(data);
		}
	});
}	