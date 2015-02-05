/*
 *	Arquivo  busca.js
 *	Javascript do campo busca
 *	
 *	Sistema:	Doce___Bacana_Lingerie
 *	Autor:      Rogério Eduardo Pereira
 *	Data:       05/02/2015
 */
function buscaProd()
{
	alert($('#buscaProduto').val());
	//$(location).attr('href','/busca/');
	windows.top.location.href='/busca/';
}