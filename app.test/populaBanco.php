<?php

/*
 * 	Arquivo  populabanco.php
 *	Insere varios produtos
 * 	
 * 	Sistema:	Doce___Bacana_Lingerie
 * 	Autor:      Rogério Eduardo Pereira
 * 	Data:       04/02/2015
 */
	//Autoload
    function __autoload($classe)
    {
        $pastas = array('../app.widgets', '../app.ado', '../app.config', '../app.model', '../gestor/app.control','../app.view');
        foreach ($pastas as $pasta)
        {
            if (file_exists("{$pasta}/{$classe}.class.php"))
            {
                include_once "{$pasta}/{$classe}.class.php";
            }
        }
    }
	
	$controlador = new controladorProdutos();
	
	for($i=0; $i<50; $i++)
	{
		$controlador->setReferencia('Referencia '.$i);
		if($i < 20)
			$controlador->setCategoria(1);
		else if($i>20 && $i<40)
			$controlador->setCategoria(2);
		else
			$controlador->setCategoria(3);
		$controlador->setDescricao('Descricao '.$i);
		$controlador->setCaracteristicas('Caracteristica '.$i);
		$controlador->setTamanhoPP(0);
		$controlador->setTamanhoP(1);
		$controlador->setTamanhoM(1);
		$controlador->setTamanhoG(1);
		$controlador->setTamanhoGG(1);
		$controlador->setTamanho48(0);
		$controlador->setTamanho50(0);
		$controlador->setTamanho52(0);
		$controlador->setTamanho54(0);
		
		$controlador->salvaProduto();
		$controlador->setCodigoProduto($controlador->getLastProduto());
		
		$controlador->setNome('Branco');
		$controlador->setCor1('#ffffff');
		$controlador->setCor2('#ffffff');
		$controlador->setBanner1(1);
		$controlador->setBanner2(0);
		$controlador->setBanner3(0);
		$controlador->setHome(1);
		
		$controlador->salvaCor();
		
		$controlador->setNome('Vermelho');
		$controlador->setCor1('#ff0000');
		$controlador->setCor2('#ff0000');
		$controlador->setBanner1(0);
		$controlador->setBanner2(1);
		$controlador->setBanner3(0);
		$controlador->setHome(0);
		
		$controlador->salvaCor();
		
		$controlador->setNome('Azul');
		$controlador->setCor1('#0000ff');
		$controlador->setCor2('#0000ff');
		$controlador->setBanner1(0);
		$controlador->setBanner2(0);
		$controlador->setBanner3(1);
		$controlador->setHome(0);
		
		$controlador->salvaCor();
	}
	
	echo 'ok';
?>