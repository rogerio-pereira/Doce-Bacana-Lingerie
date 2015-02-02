<?php 
	session_start();
	header("Content-Type:text/html; charset=ISO-8859-1",true)
?>

<?php

/*
 * 	Arquivo  ajaxUpload.php
 * 	Arquivo Ajax para Upload de arquivos
 * 	
 * 	Sistema:	Doce___Bacana_Lingerie
 * 	Autor:      Rogério Eduardo Pereira
 * 	Data:       02/02/2015
 */
	
	//Autoload
    function __autoload($classe)
    {
        $pastas = array('../app.widgets', '../app.ado', '../app.config', '../app.model', '../app.control','../app.view');
        foreach ($pastas as $pasta)
        {
            if (file_exists("{$pasta}/{$classe}.class.php"))
            {
                include_once "{$pasta}/{$classe}.class.php";
            }
        }
    }
	
	error_reporting(E_WARNING);
	
	$request = $_POST['formularioNome'];
	
	//Salvar Produto
	if($request == 'salvaProduto')
	{
		/*
		 * Ver http://stackoverflow.com/questions/10899384/uploading-both-data-and-files-in-one-form-using-ajax
		 * e tentar adaptar para o que eu preciso
		 */
		
		$controlador =  new controladorProdutos();
		
		$controlador->setCodigoProd($_POST['codigo']);
		$controlador->setReferencia($_POST['referencia']);
		$controlador->setCategoria($_POST['categoria']);
		$controlador->setDescricao($_POST['descricao']);
		$controlador->setCaracteristicas($_POST['caracteristicas']);
		//Tamanho PP
		if(isset($_POST['tamanhoPP']))
			$controlador->setTamanhoPP(1);
		else
			$controlador->setTamanhoPP(0);
		//Tamanho P
		if(isset($_POST['tamanhoP']))
			$controlador->setTamanhoP(1);
		else
			$controlador->setTamanhoP(0);
		//Tamanho M
		if(isset($_POST['tamanhoM']))
			$controlador->setTamanhoM(1);
		else
			$controlador->setTamanhoM(0);
		//Tamanho G
		if(isset($_POST['tamanhoG']))
			$controlador->setTamanhoG(1);
		else
			$controlador->setTamanhoG(0);
		//Tamanho GG
		if(isset($_POST['tamanhoGG']))
			$controlador->setTamanhoGG(1);
		else
			$controlador->setTamanhoGG(0);
		//Tamanho 48
		if(isset($_POST['tamanho48']))
			$controlador->setTamanho48(1);
		else
			$controlador->setTamanho48(0);
		//Tamanho 50
		if(isset($_POST['tamanho50']))
			$controlador->setTamanho50(1);
		else
			$controlador->setTamanho50(0);
		//Tamanho 52
		if(isset($_POST['tamanho52']))
			$controlador->setTamanho52(1);
		else
			$controlador->setTamanho52(0);
		//Tamanho 54
		if(isset($_POST['tamanho54']))
			$controlador->setTamanho54(1);
		else
			$controlador->setTamanho54(0);
		
		for($i=1; $i<=$_POST['numeroCor']; $i++)
		{
			//Banner 1
			if(isset($_POST['banner1_'.$i]))
				$banner1 = 1;
			else
				$banner1 = 0;
			//Banner 2
			if(isset($_POST['banner2_'.$i]))
				$banner2 = 1;
			else
				$banner2 = 0;			
			//Banner 3
			if(isset($_POST['banner3_'.$i]))
				$banner3 = 1;
			else
				$banner3 = 0;
			//Home
			if(isset($_POST['home_'.$i]))
				$home = 1;
			else
				$home = 0;
			
			
			
			$controlador->addCor([
									$_POST['nomeCor_'.$i], 
									$_POST['cor1_'.$i], 
									$_POST['cor2_'.$i], 
									$banner1,
									$banner2,
									$banner3,
									$home,
									$_FILES["foto_{$i}"]["tmp_name"],
									$_FILES["foto_{$i}"]["name"],
									$_FILES["foto_{$i}"]["size"],
									$_FILES["foto_{$i}"]["type"]
								]);
		}
		
		if($controlador->salvaProduto())
		{
			$codigoProduto = $controlador->getLastProduto();
			$controlador->setCodigoProduto($codigoProduto);
			
			$i=1;
			$erro=0;
			foreach ($controlador->getVariableCollectionProdutosCores() as $data)
			{
				//$cor = explode('¬', $data);
								
				$controlador->setNome($data[0]);
				$controlador->setCor1($data[1]);
				$controlador->setCor2($data[2]);
				$controlador->setBanner1($data[3]);
				$controlador->setBanner2($data[4]);
				$controlador->setBanner3($data[5]);
				$controlador->setHome($data[6]);
								
				if($controlador->salvaCor())
				{
					$codigoCor = $controlador->getLastCor();
					
					$controlador->setFoto_temp($data[7]);
					$controlador->setFoto_name($data[8]);
					$controlador->setFoto_size($data[9]);
					$controlador->setFoto_type($data[10]);

					$nome = $codigoProduto.'_'.$codigoCor;

					$controlador->upload($nome, $controlador->getBanner1(), $controlador->getBanner2(), $controlador->getBanner3(), $controlador->getHome());
					
				}
				else
				{
					$erro++;
					echo "<script>top.location='/produtos';alert('Erro ao salvar cor '.$i')</script>";
				}
					
				$i++;
			}
			
			if($erro == 0)
				echo "<script>top.location='/produtos';alert('Produto salvo com sucesso!')</script>";
		}
		else
			echo "<script>top.location='/produtos';alert('Falha ao salvar Produto!')</script>";
	}
?>