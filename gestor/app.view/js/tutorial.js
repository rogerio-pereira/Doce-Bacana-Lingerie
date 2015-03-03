/*
 *	Arquivo  tutorial.js
 *	Javascript do arquivo tutorial.class.php
 *	
 *	Sistema:	Doce___Bacana_Lingerie
 *	Autor:      Rogério Eduardo Pereira
 *	Data:       03/03/2015
 */
function validaTutorial()
{
	var valida;
	valida = true;
	
	if ($('#link').val() == '')
	{
		alert('Digite um link');
		$('#link').focus();
		return;
	}
	
	if (valida = true)
		salvaTutorial();
}

function salvaTutorial()
{
	$.ajax
	({
		type: "POST",
		url: "/app.control/ajax.php",
		data: 
		{
			link:			$('#link').val(),
			formularioNome:	'salvaTutorial'
		},
		success: function(data) 
		{
			alert('Salvo com sucesso!');
			top.location='/';
		}
	});
}