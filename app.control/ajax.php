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
		
		$controlador->setEmail($_POST['email']);
		$controlador->setSenha($_POST['senha']);
		
		$retorno = $controlador->login();
		
		if($retorno == true)
		{
			echo "Login sucedido!";
		}
		else
		{
			echo "Falha ao fazer login";
		}
	}
	else if($formulario == 'incluiOrcamento')
	{
		try
		{
			$adiciona = true;
			foreach ($_SESSION['orcamento'] as $orcamento)
			{
				if($orcamento == $_POST['codigo'])
					$adiciona = false;
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
										'0'
									);
					$arrayCor		= array_combine($keys, $values);
					
					$_SESSION['produtosOrcamento'][] = $arrayCor;
					
				}
			
				echo "
						<script>
							alert('Item incluido no orçamento!');
						</script>
					";
			}
			else
				echo "
						<script>
							alert('Item já havia sido incluido no orçamento antes!');
						</script>
					";
			
			if($_SESSION['cliente'] == '') 
				echo
					"
						<script>
							alert('Por favor faça o login para continuar!');
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
						alert('Falha ao incluir item no orçamento!');
					</script>
				";
		}
	}
	else if($formulario == 'alteraQuantidadeOrcamento')
	{
		$i=0;
		//Percorre o vetor de Orçamento
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
		//Percorre o vetor de Orçamento
		foreach($_SESSION['produtosOrcamento'] as $orcamento)
		{
			if($orcamento['codigoProduto'] == $_POST['codigo'])
			{
				unset($_SESSION['produtosOrcamento'][$i]);
			}
			
			$i++;
		}
		
		$i=0;
		//Percorre o vetor de Orçamento
		foreach($_SESSION['orcamento'] as $orcamento)
		{
			if($orcamento == $_POST['codigo'])
			{
				unset($_SESSION['orcamento'][$i]);
			}
			
			$i++;
		}
		
		
		$_SESSION['produtosOrcamento'] = array_values($_SESSION['produtosOrcamento']);
		$_SESSION['orcamento'] = array_values($_SESSION['orcamento']);
		
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
						echo "<tr><td colspan='10'><hr></td></tr>";
				}

				if($codigoAnterior != $codigoAtual)
					echo "<tr><td colspan='10' align='center' style='font-size: 1.3em;'><input type='button' value='Apagar Referencia' onclick='removeOrcamento({$produto['codigoProduto']})'></td></tr>";

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
			echo "<tr><td colspan='10'><hr></td></tr>";
		}
		else
			echo 'Ainda não há nenhum produto em orçamento';
	}
	//Envio de Orçamento
	else if($formulario == 'enviaOrcamento')
	{
		//Não existe cliente logado
		if($_SESSION['cliente'] != '')
			echo
					"
						<script>
							top.location='/login';
						</script>
					";
		else
		{
			
		}
	}
?>