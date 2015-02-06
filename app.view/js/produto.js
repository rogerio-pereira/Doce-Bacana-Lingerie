/*
 *	Arquivo  produto.js
 *	Javascript do arquivo produto.class.php
 *	
 *	Sistema:	Doce___Bacana_Lingerie
 *	Autor:      Rogério Eduardo Pereira
 *	Data:       06/02/2015
 */
function mudaImagemProduto(codigoProduto, codigo)
{
	$('#imagemGrande').html("<img src='/app.view/img/produtos/"+codigoProduto+"_"+codigo+".jpg'>");
}