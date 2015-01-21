/*
 *	Arquivo  slider.js
 *	Javascript do arquivo slider.class.php
 *	
 *	Sistema:	Doce___Bacana_Lingerie
 *	Autor:      Rogério Eduardo Pereira
 *	Data:       21/01/2015
 */
function iniciaSlider()
{
	$(document).ready(function() 
	{
		$('.sliderTopImg').cycle({
			fx:			'fade',
			speed:		3000, 
			timeout:	5000 
		});
	});
}