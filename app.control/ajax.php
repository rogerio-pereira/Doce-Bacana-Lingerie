<?php

/*
 * 	Arquivo  ajax.php
 * 	Destino de todos os formularios
 * 	
 * 	Sistema:	Doce___Bacana_Lingerie
 * 	Autor:      Rog�rio Eduardo Pereira
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
	
	//Obtem informa��o do que sera feito atrav�s do campo hiddens
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
		$controlador->setAtivo(1);
		
		if($controlador->salvar() == true)
		{
			$_SESSION['cliente'] = $controlador->getClienteByEmail($controlador->getEmail());
			echo "<script>alert('Cadastrado com Sucesso!');top.location='/';</script>";
		}
		else
			echo "<script>alert('Falha ao cadastrar!');window.history.back();</script>";
	}
	else if ($formulario == 'login')
	{
		$controlador	= new controladorLogin();
		
		$controlador->setEmail($_POST['email']);
		$controlador->setSenha($_POST['senha']);
		
		$retorno = $controlador->login();
		
		if($retorno == true)
		{
			echo 
				"
					<script>
						top.location='/orcamento';
					</script>
				";
		}
		else
		{
			echo 
				"
					<script>
						alert('Falha ao fazer login');
					</script>
				";
		}
	}
	else if($formulario == 'incluiOrcamento')
	{
		try
		{
			$adiciona = true;
			if(count($_SESSION['orcamento']) > 0)
			{
				foreach ($_SESSION['orcamento'] as $orcamento)
				{
					if($orcamento == $_POST['codigo'])
						$adiciona = false;
				}
			}
					
			if($adiciona == true)	
			{
				$_SESSION['orcamento'][] = $_POST['codigo'];
				
				$produto		= (new controladorProdutos())->getProduto2($_POST['codigo']);
				$collectionCor	= (new controladorProdutos())->getCollectionCores2($_POST['codigo']);
				
				$keys			= array
										(
											'codigoProduto',
											'codigoCor',
											'campoPP',
											'campoP',
											'campoM',
											'campoG',
											'campoGG',
											'campo48',
											'campo50',
											'campo52',
											'campo54',
											'quantidadePP',
											'quantidadeP',
											'quantidadeM',
											'quantidadeG',
											'quantidadeGG',
											'quantidade48',
											'quantidade50',
											'quantidade52',
											'quantidade54',
											'referencia',
											'nome'
										);
				
				foreach($collectionCor as $cor)
				{	
					//                
					$values = array(
										$produto->codigo,
										$cor->codigo, 
										$produto->tamanhoPP,
										$produto->tamanhoP,
										$produto->tamanhoM,
										$produto->tamanhoG,
										$produto->tamanhoGG,
										$produto->tamanho48,
										$produto->tamanho50,
										$produto->tamanho52,
										$produto->tamanho54,
										'0', 
										'0', 
										'0', 
										'0', 
										'0', 
										'0', 
										'0', 
										'0', 
										'0',
										$produto->referencia,
										$cor->nome
									);
					$arrayCor		= array_combine($keys, $values);
					
					$_SESSION['produtosOrcamento'][] = $arrayCor;
					
				}
			
				echo "
						<script>
							alert('Item incluido no or�amento!');
							top.location='/orcamento';
						</script>
					";
			}
			else
				echo "
						<script>
							alert('Item j� havia sido incluido no or�amento antes!');
							top.location='/orcamento';
						</script>
					";
			
			if($_SESSION['cliente'] == '') 
				echo
					"
						<script>
							alert('Por favor fa�a o login para continuar!');
							top.location='/login';
						</script>
					";
			else
				echo
					"
						<script>
							top.location='/orcamento';
						</script>
					";
				
		} 
		catch (Exception $ex) 
		{
			echo "
					<script>
						alert('Falha ao incluir item no or�amento!');
					</script>
				";
		}
	}
	else if($formulario == 'alteraQuantidadeOrcamento')
	{
		$i=0;
		//Percorre o vetor de Or�amento
		foreach($_SESSION['produtosOrcamento'] as $orcamento)
		{
			//Verifica o codigo da Cor
			if($orcamento['codigoCor'] == $_POST['codigo'])
			{
				//Altera a quantidade do campo correspondente
				$_SESSION['produtosOrcamento'][$i]["{$_POST['campo']}"] = $_POST['valor'];
				break;
			}
			
			$i++;
		}
	}
	else if($formulario == 'apagarOrcamento')
	{
		$i=0;
		//Percorre o vetor de Or�amento
		foreach($_SESSION['produtosOrcamento'] as $orcamento)
		{
			if($orcamento['codigoProduto'] == $_POST['codigo'])
			{
				unset($_SESSION['produtosOrcamento'][$i]);
			}
			
			$i++;
		}
		
		$i=0;
		//Percorre o vetor de Or�amento
		foreach($_SESSION['orcamento'] as $orcamento)
		{
			if($orcamento == $_POST['codigo'])
			{
				unset($_SESSION['orcamento'][$i]);
			}
			
			$i++;
		}
		
		
		$_SESSION['produtosOrcamento']	= array_values($_SESSION['produtosOrcamento']);
		$_SESSION['orcamento']			= array_values($_SESSION['orcamento']);
		
		echo 
			"
				<tr><td colspan='10' align='center' style='font-size: 1.3em'><input type='button' value='Incluir nova referencia' onclick=\"top.location='/'\"></td></tr>
				<tr><td colspan='10'><hr></td></tr>
			";
		
		if(count($_SESSION['produtosOrcamento']) > 0)
		{
			$i = 0;
			$codigoAnterior = '';
			$codigoAtual	= '';
			foreach($_SESSION['produtosOrcamento'] as $produto)
			{
				$codigoAnterior = $codigoAtual;
				$codigoAtual	= $produto['codigoProduto'];

				if($i>0)
				{
					if($codigoAnterior != $codigoAtual)
						echo 
							"
								<tr>
									<td colspan='10' align='center' style='font-size: 1.3em;'>
										<input type='button' value='Excluir do or�amento' onclick='removeOrcamento($codigoAnterior)'>
									</td>
								</tr>
								<tr><td colspan='10'><hr></td></tr>
							";
				}

				if($codigoAnterior != $codigoAtual)
					echo	
						"
							<tr>
								<td colspan='10' align='center' style='font-size: 1.3em;'>
									<strong>{$produto['referencia']}<strong>
								</td>
							</tr>
						";

				echo
					"
						<tr>
							<td>

							</td>
							<td>
								Tamanho PP
							</td>

							<td>
								Tamanho P
							</td>

							<td>
								Tamanho M
							</td>

							<td>
								Tamanho G
							</td>

							<td>
								Tamanho GG
							</td>

							<td>
								Tamanho 48
							</td>

							<td>
								Tamanho 50
							</td>

							<td>
								Tamanho 52
							</td>
							<td>
								Tamanho 54
							</td>
						</tr>
					";


				echo 
					"
						<tr>
							<td align='center'>
								<img src='/app.view/img/produtos/thumbs/{$produto['codigoProduto']}_{$produto['codigoCor']}.jpg'><br>
							</td>
					";
				//Campo PP
				if($produto['campoPP'] == true)
					echo 
						"
							<td>
								<input 
									type='number' 
									class='campoOrcamento integer {$produto['codigoCor']} quantidadePP' 
									name='quantidadePP_{$produto['codigoCor']}' 
									id='quantidadePP_{$produto['codigoCor']}' 
									min='0' 
									value='{$produto['quantidadePP']}'
									onchanche='alteraQuantidade(this, {$produto['codigoCor']})'
								>
							</td>
						";
				else
					echo 
						"
							<td>
								<input 
									type='number' 
									class='campoOrcamento integer {$produto['codigoCor']} quantidadePP' 
									name='quantidadePP_{$produto['codigoCor']}' 
									id='quantidadePP_{$produto['codigoCor']}' 
									min='0' 
									onchanche='alteraQuantidade(this, {$produto['codigoCor']})'
									disabled
								>
							</td>
						";

				//Campo P
				if($produto['campoP'] == true)
					echo 
						"
							<td>
								<input 
									type='number' 
									class='campoOrcamento integer {$produto['codigoCor']} quantidadeP' 
									name='quantidadeP_{$produto['codigoCor']}' 
									id='quantidadeP_{$produto['codigoCor']}' 
									min='0' 
									value='{$produto['quantidadeP']}'
									onchanche='alteraQuantidade(this, {$produto['codigoCor']})'
								>
							</td>
						";
				else
					echo 
						"
							<td>
								<input 
									type='number' 
									class='campoOrcamento integer {$produto['codigoCor']} quantidadeP' 
									name='quantidadeP_{$produto['codigoCor']}' 
									id='quantidadeP_{$produto['codigoCor']}' 
									min='0' 
									onchanche='alteraQuantidade(this, {$produto['codigoCor']})'
									disabled
								>
							</td>
						";

				//Campo M
				if($produto['campoM'] == true)
					echo 
						"
							<td>
								<input 
									type='number' 
									class='campoOrcamento integer {$produto['codigoCor']} quantidadeM' 
									name='quantidadeM_{$produto['codigoCor']}' 
									id='quantidadeM_{$produto['codigoCor']}' 
									min='0' 
									value='{$produto['quantidadeM']}'
									onchanche='alteraQuantidade(this, {$produto['codigoCor']})'
								>
							</td>
						";
				else
					echo 
						"
							<td>
								<input 
									type='number' 
									class='campoOrcamento integer {$produto['codigoCor']} quantidadeM' 
									name='quantidadeM_{$produto['codigoCor']}' 
									id='quantidadeM_{$produto['codigoCor']}' 
									min='0' 
									onchanche='alteraQuantidade(this, {$produto['codigoCor']})'
									disabled
								>
							</td>
						";

				//Campo G
				if($produto['campoG'] == true)
					echo 
						"
							<td>
								<input 
									type='number' 
									class='campoOrcamento integer {$produto['codigoCor']} quantidadeG' 
									name='quantidadeG_{$produto['codigoCor']}' 
									id='quantidadeG_{$produto['codigoCor']}' 
									min='0' 
									value='{$produto['quantidadeG']}'
									onchanche='alteraQuantidade(this, {$produto['codigoCor']})'
								>
							</td>
						";
				else
					echo 
						"
							<td>
								<input 
									type='number' 
									class='campoOrcamento integer {$produto['codigoCor']} quantidadeG' 
									name='quantidadeG_{$produto['codigoCor']}' 
									id='quantidadeG_{$produto['codigoCor']}' 
									min='0' 
									onchanche='alteraQuantidade(this, {$produto['codigoCor']})'
									disabled
								>
							</td>
						";					

				//Campo GG
				if($produto['campoGG'] == true)
					echo 
						"
							<td>
								<input 
									type='number' 
									class='campoOrcamento integer {$produto['codigoCor']} quantidadeGG' 
									name='quantidadeGG_{$produto['codigoCor']}' 
									id='quantidadeGG_{$produto['codigoCor']}' 
									min='0' 
									value='{$produto['quantidadeGG']}'
									onchanche='alteraQuantidade(this, {$produto['codigoCor']})'
								>
							</td>
						";
				else
					echo 
						"
							<td>
								<input 
									type='number' 
									class='campoOrcamento integer {$produto['codigoCor']} quantidadeGG' 
									name='quantidadeGG_{$produto['codigoCor']}' 
									id='quantidadeGG_{$produto['codigoCor']}' 
									min='0' 
									onchanche='alteraQuantidade(this, {$produto['codigoCor']})'
									disabled
								>
							</td>
						";	

				//Campo 48
				if($produto['campo48'] == true)
					echo 
						"
							<td>
								<input 
									type='number' 
									class='campoOrcamento integer {$produto['codigoCor']} quantidade48' 
									name='quantidade48_{$produto['codigoCor']}' 
									id='quantidade48_{$produto['codigoCor']}' 
									min='0' 
									value='{$produto['quantidade48']}'
									onchanche='alteraQuantidade(this, {$produto['codigoCor']})'
								>
							</td>
						";
				else
					echo 
						"
							<td>
								<input 
									type='number' 
									class='campoOrcamento integer {$produto['codigoCor']} quantidade48' 
									name='quantidade48_{$produto['codigoCor']}' 
									id='quantidade48_{$produto['codigoCor']}' 
									min='0' 
									onchanche='alteraQuantidade(this, {$produto['codigoCor']})'
									disabled
								>
							</td>
						";		

				//Campo 50
				if($produto['campo50'] == true)
					echo 
						"
							<td>
								<input 
									type='number' 
									class='campoOrcamento integer {$produto['codigoCor']} quantidade50' 
									name='quantidade50_{$produto['codigoCor']}' 
									id='quantidade50_{$produto['codigoCor']}' 
									min='0' 
									value='{$produto['quantidade50']}'
									onchanche='alteraQuantidade(this, {$produto['codigoCor']})'
								>
							</td>
						";
				else
					echo 
						"
							<td>
								<input 
									type='number' 
									class='campoOrcamento integer {$produto['codigoCor']} quantidade50' 
									name='quantidade50_{$produto['codigoCor']}' 
									id='quantidade50_{$produto['codigoCor']}' 
									min='0' 
									onchanche='alteraQuantidade(this, {$produto['codigoCor']})'
									disabled
								>
							</td>
						";	

				//Campo 52
				if($produto['campo52'] == true)
					echo 
						"
							<td>
								<input 
									type='number' 
									class='campoOrcamento integer {$produto['codigoCor']} quantidade52' 
									name='quantidade52_{$produto['codigoCor']}' 
									id='quantidade52_{$produto['codigoCor']}' 
									min='0' 
									value='{$produto['quantidade52']}'
									onchanche='alteraQuantidade(this, {$produto['codigoCor']})'
								>
							</td>
						";
				else
					echo 
						"
							<td>
								<input 
									type='number' 
									class='campoOrcamento integer {$produto['codigoCor']} quantidade52' 
									name='quantidade52_{$produto['codigoCor']}' 
									id='quantidade52_{$produto['codigoCor']}' 
									min='0' 
									onchanche='alteraQuantidade(this, {$produto['codigoCor']})'
									disabled
								>
							</td>
						";	

				//Campo 54
				if($produto['campo54'] == true)
					echo 
						"
							<td>
								<input 
									type='number' 
									class='campoOrcamento integer {$produto['codigoCor']} quantidade54' 
									name='quantidade54_{$produto['codigoCor']}' 
									id='quantidade54_{$produto['codigoCor']}' 
									min='0' 
									value='{$produto['quantidade54']}'
									onchanche='alteraQuantidade(this, {$produto['codigoCor']})'
								>
							</td>
						";
				else
					echo 
						"
							<td>
								<input 
									type='number' 
									class='campoOrcamento integer {$produto['codigoCor']} quantidade54'  
									name='quantidade54_{$produto['codigoCor']}' 
									id='quantidade54_{$produto['codigoCor']}' 
									min='0' 
									onchange='alteraQuantidade(this, {$produto['codigoCor']})'
									disabled
								>
							</td>
						";		
				echo 
					"
						</tr>
					";

				$i++;
			}
			echo 
				"
					<tr>
						<td colspan='10' align='center' style='font-size: 1.3em;'>
							<input type='button' value='Excluir do or�amento' onclick='removeOrcamento($codigoAnterior)'>
						</td>
					</tr>
				";
			echo "<tr><td colspan='10'><hr></td></tr>";
			echo "<tr><td colspan='10' align='center' style='font-size: 1.3em;'><input type='submit' value='Enviar Or�amento'></td></tr>";
		}
		else
			echo 'Ainda n�o h� nenhum produto em or�amento';
	}
	//Envio de Or�amento
	else if($formulario == 'enviaOrcamento')
	{
		
		//N�o existe cliente logado
		if($_SESSION['cliente'] == '')
			echo
					"
						<script>
							top.location='/login';
						</script>
					";
		else
		{			
			$controlador = new controladorOrcamento();
			
			$controlador->setCliente($_SESSION['cliente']->codigo);
			$controlador->setDataHora(date('Y-m-d H:i'));
			$controlador->setStatus('0');	
			
			if($controlador->salvaOrcamento())
			{
				$codigoOrcamento = $controlador->getLastProduto();
				
				$arrayProdutos;
				foreach($_SESSION['produtosOrcamento'] as $orcamento)
				{
					$somaQuantidade = 0;
					$somaQuantidade =	$orcamento['quantidadePP'] + 
										$orcamento['quantidadeP'] + 
										$orcamento['quantidadeM'] + 
										$orcamento['quantidadeG'] + 
										$orcamento['quantidadeGG'] + 
										$orcamento['quantidade48'] + 
										$orcamento['quantidade50'] + 
										$orcamento['quantidade52'] + 
										$orcamento['quantidade54'];

					if($somaQuantidade > 0)
						//Adicionar produtos no array... e depois
						$arrayProdutos[] =	array(
													$codigoOrcamento,
													$orcamento['codigoCor'],
													$orcamento['quantidadePP'],
													$orcamento['quantidadeP'],
													$orcamento['quantidadeM'],
													$orcamento['quantidadeG'],
													$orcamento['quantidadeGG'],
													$orcamento['quantidade48'],
													$orcamento['quantidade50'],
													$orcamento['quantidade52'],
													$orcamento['quantidade54'],
													$orcamento['referencia'],
													$orcamento['nome'],
												);
				}

				$controlador->setCollectionOrcamentosProdutos($arrayProdutos);

				if($controlador->salvaProdutosOrcamento())
				{
					$email = new enviaEmailOrcamento();
					$email->iniciaEmail($codigoOrcamento, $controlador->returnCollectioOrcamentosProdutos());
					
					if($email->send2())
					{
						$_SESSION['orcamento']			= NULL;
						$_SESSION['produtosOrcamento']	= NULL;
						echo "<script>alert('Or�amento enviado com sucesso!');top.location='/';</script>";
					}
					else
						echo "<script>alert('Falha ao enviar o or�amento!');top.location='/';</script>";
				}
			}
		}
	}
	//Altera��o de Cadastro
	else if($formulario == 'alteraCliente')
	{
		$controlador = new controladorClientes();
		
		$controlador->setCodigo($_POST['codigo']);
		$controlador->setTelefone($_POST['telefone']);
		$controlador->setCelular($_POST['celular']);
		$controlador->setEmail($_POST['email']);
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
		
		if($controlador->atualizar() == true)
		{
			$_SESSION['cliente']->telefone			= $controlador->getTelefone();
			$_SESSION['cliente']->celular			= $controlador->getCelular();
			$_SESSION['cliente']->email				= $controlador->getEmail();
			$_SESSION['cliente']->ofertaEmail		= $controlador->getOfertaEmail();
			$_SESSION['cliente']->ofertaCelular		= $controlador->getOfertaCelular();
			$_SESSION['cliente']->cep				= $controlador->getCep();
			$_SESSION['cliente']->endereco			= $controlador->getEndereco();
			$_SESSION['cliente']->numero			= $controlador->getNumero();
			$_SESSION['cliente']->complemento		= $controlador->getComplemento();
			$_SESSION['cliente']->bairro			= $controlador->getBairro();
			$_SESSION['cliente']->cidade			= $controlador->getCidade();
			$_SESSION['cliente']->telefone			= $controlador->getTelefone();
			$_SESSION['cliente']->estado			= $controlador->getEstado();
			$_SESSION['cliente']->referencia		= $controlador->getPontoReferencia();
			
			
			echo "<script>alert('Alterado com Sucesso!');	top.location='/perfil';</script>";
		}
		else
			echo "<script>alert('Falha ao alterar!');top.location='/perfil';</script>";
	}
	//Altera��o de Senha
	else if($formulario == 'alteraSenha')
	{
		$controlador = new controladorClientes;
		$controlador->setSenhaAtual($_POST['senhaAtual']);
		$controlador->setSenha($_POST['senhaNova']);
		if($controlador->verificaSenhaAtual())
		{
			if($controlador->alteraSenha())
			{
				$_SESSION['cliente']->senha = $controlador->getSenha();
				echo 'Senha alterada com sucesso!';
			}
			else
				echo 'Erro ao alterar senha!';
		}
		else
		{
			echo 'Senha Atual Inv�lida!';
		}
	}
	//Cliente perdeu a senha
	else if($formulario == 'novaSenha')
	{
		$controlador = new controladorClientes();
		$controlador->setSenha($_POST['senhaNova']);
		$controlador->setChave($_POST['chave']);
		
		if($controlador->alteraSenhaChave())
		{
			$_SESSION['cliente'] = $controlador->getClienteByChave2($controlador->getChave());
			
			echo "<script>alert('Senha Alterada com Sucesso!');top.location='/';</script>";
		}
		else
		{
			echo "<script>alert('2');</script>";
			echo "<script>alert('Falha ao alterar Senha!');</script>";
		}
	}
?>