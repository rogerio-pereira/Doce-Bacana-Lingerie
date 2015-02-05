<?php

/*
 * 	Arquivo  ajax.php
 * 	Destino de todos os formularios
 * 	
 * 	Sistema:	Doce___Bacana_Lingerie
 * 	Autor:      Rogério Eduardo Pereira
 * 	Data:       22/01/2015
 */
    session_start();
    header("Content-Type:text/html; charset=ISO-8859-1",true);
	error_reporting(E_WARNING);

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
	
	//Obtem informação do que sera feito através do campo hiddens
	$formulario = $_POST['formularioNome'];
	
	//Cadastro de Clientes
	if($formulario == 'cadastroCliente')
	{
		$controlador = new controladorClientes();
		
		$controlador->setPessoa($_POST['radioPessoa']);
		$controlador->setNome($_POST['nome']);
		$controlador->setNomeResponsavel($_POST['nomeResponsavel']);
		$controlador->setCpf($_POST['cpf']);
		$controlador->setCnpj($_POST['cnpj']);
		$controlador->setInformacaoTributaria($_POST['radioInformacoesTributarias']);
		$controlador->setInscricaoEstadual($_POST['inscricaoEstadual']);
		$controlador->setNascimento($_POST['nascimento']);
		$controlador->setSexo($_POST['radioSexo']);
		$controlador->setTelefone($_POST['telefone']);
		$controlador->setCelular($_POST['celular']);
		$controlador->setEmail($_POST['email']);
		$controlador->setSenha($_POST['senha']);
		if($_POST['ofertaEmail'] == 'on')
			$controlador->setOfertaEmail(1);
		else
			$controlador->setOfertaEmail(0);
		if($_POST['ofertaCelular'] == 'on')
			$controlador->setOfertaCelular(1);
		else
			$controlador->setOfertaCelular(0);
		$controlador->setCep($_POST['cep']);
		$controlador->setEndereco($_POST['endereco']);
		$controlador->setNumero($_POST['numero']);
		$controlador->setComplemento($_POST['complemento']);
		$controlador->setBairro($_POST['bairro']);
		$controlador->setCidade($_POST['cidade']);
		$controlador->setEstado($_POST['estado']);
		$controlador->setPontoReferencia($_POST['referencia']);
		$controlador->setChave(md5($_POST['email']));
		$controlador->setAtivo(FALSE);
		
		if($controlador->salvar() == true)
			echo "<script>alert('Cadastrado com Sucesso!');</script>";
		else
			echo "<script>alert('Falha ao cadastrar!');</script>";
	}
	else if ($formulario == 'login')
	{
		$controlador	= new controladorLogin();
		
		$controlador->setEmail( $_POST['email']);
		$controlador->setSenha($_POST['senha']);
		
		$retorno = $controlador->login();
		
		if($retorno == true)
		{
			return true;
		}
		else
		{
			session_destroy();
			echo "
					<script>
						alert('Falha ao fazer login');
					</script>
				";
		}
	}
?>