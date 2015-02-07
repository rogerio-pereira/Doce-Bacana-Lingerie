/*
 *	Arquivo  busca.js
 *	Javascript do campo busca
 *	
 *	Sistema:	Doce___Bacana_Lingerie
 *	Autor:      Rogério Eduardo Pereira
 *	Data:       05/02/2015
 */
function bProd()
{
	var busca = $('#buscaProduto').val();
	busca = busca.replace(' ', '+');
	top.location='/busca/'+busca;
}