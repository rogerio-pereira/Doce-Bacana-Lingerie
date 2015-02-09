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
	$('#imagemGrande').html("<img src='/app.view/img/produtos/"+codigoProduto+"_"+codigo+".jpg' id='prodImgZoom' data-zoom-image='/app.view/img/produtos/"+codigoProduto+"_"+codigo+".jpg'>");
	adicionaZoom();
}

function incluirOrcamento(codigo)
{
	$.ajax
	({
		type: "POST",
		url: "/app.control/ajax.php",
		data: 
		{
			codigo:			codigo,
			formularioNome:	'incluiOrcamento'
		},
		success: function(data) 
		{
			$('.retornoAjax').html(data);
		}
	});
}
function adicionaZoom()
{
	$("#prodImgZoom").elevateZoom(
	{
		/*tint:			true, 
		tintColour:		'#000000', 
		tintOpacity:	0.5,*/
		zoomType:		"lens", 
		lensShape:		"round", 
		lensSize:		200
	});
}