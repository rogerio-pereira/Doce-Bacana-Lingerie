/*
 *	Arquivo  login.js
 *	Javascript do arquivo login.class.php
 *	
 *	Sistema:	Doce___Bacana_Lingerie
 *	Autor:      Rogério Eduardo Pereira
 *	Data:       27/01/2015
 */
function executaLogin()
{
	$.ajax
	({
		type: "POST",
		url: "app.control/ajax.php",
		data: 
		{
			email:			$('#email').val(),
			senha:			$('#senha').val(),
			formularioNome:	'login'
		},
		success: function(data) 
		{
			top.location='/orcamento';
		}
	});
}