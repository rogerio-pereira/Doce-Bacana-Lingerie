<?php 
	session_start();
	header("Content-Type:text/html; charset=ISO-8859-1",true)
?>

<?php
/*
 * 	Arquivo  ajax
 * 	Destino de todos os fomrularios
 * 	
 * 	Sistema:	Doce___Bacana_Lingerie
 * 	Autor:		Rogério Eduardo Pereira
 * 	Data:		27/01/2015
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
	
	//Obtem informa��o do que sera feito atrav�s do campo hiddens
	$request = $_POST['formularioNome'];
	
	//Login
	if($request == 'login')
	{
		$controlador	= new controladorLogin();
		
		$controlador->setUsuario( $_POST['usuario']);
		$controlador->setSenha($_POST['senha']);
		
		$retorno = $controlador->login();
		
		if($retorno == true)
		{
			return true;
		}
		else
		{
			session_destroy();
			echo "Falha ao fazer login";
		}
	}
	//Salvar Categoria
	else if($request == 'salvaCategoria')
	{
		$controlador = new controladorCategoria();
		
		$controlador->setCodigo($_POST['codigo']);
		$controlador->setNome($_POST['nome']);
		
		if($controlador->salva())
			return true;
		else
			return false;
	}
	//Apagar Categoria
	else if($request == 'apagaCategorias')
	{
		$codigos = $_POST['codigos'];
		$apagado  = 0;
		
		$controlador	= new controladorCategoria();
		
		foreach ($codigos as $codigo)
		{
			$controlador->apaga2($codigo);
		}
		
		$collectionCategorias = $controlador->getCollectionCategoria2();
		
		echo "<!--Titulo-->
					<tr>
						<td align='center'>
							Alterar
						</td>
						<td align='center'>
							Nome
						</td>
						<td align='center'>
							Excluir
						</td>
					</tr>
					<tr>
						<td colspan='3'>
							<hr>
						</td>
					</tr>";
		
		foreach ($collectionCategorias as $categoria)
							echo
								"
									<!--{$categoria->nome}-->
									<tr>
										<td align='center'>
											<input type='radio' name='radioCategoria' id='radioCategoria' value='{$categoria->codigo}'>
										</td>
										<td>
											{$categoria->nome}
										</td>
										<td align='center'>
											<input type='checkbox' name='categoriasApagar[]' class='chkCategoriasApagar' value='{$categoria->codigo}'>
										</td>
									</tr>
								";
											
		echo "<tr>
						<td colspan='3'>
							<hr>
						</td>
					</tr>
					<!--Bot�es-->
					<tr>
						<td>
							<input type='button' value='Alterar' onclick='alteraCategoria()'>
						</td>
						<td>
							<input type='button' value='Cadastrar' onclick='novaCategoria()'>
						</td>
						<td>
				";
		if(count($collectionCategorias) > 0)
								echo "<input type='button' value='Apagar' onclick='apagaCategorias()'>";
		echo "
						</td>
					</tr>";
	}
	//Salvar Usuario
	if($request == 'salvaUsuario')
	{
		$controlador = new controladorUsuario;
		
		$controlador->setCodigo($_POST['codigo']);
		$controlador->setNome($_POST['nome']);
		$controlador->setUser($_POST['usuario']);
		$controlador->setSenha($_POST['senha']);
		$controlador->setTelaCategoria($_POST['telaCategoria']);
		$controlador->setTelaOrcamento($_POST['telaOrcamento']);
		$controlador->setTelaProduto($_POST['telaProduto']);
		$controlador->setTelaUsuario($_POST['telaUsuario']);
		$controlador->setTelaCliente($_POST['telaCliente']);
		
		if($controlador->salvarUsuario2())
			return true;
		else
			return false;
	}
	//Apagar Usuario
	else if($request == 'apagaUsuarios')
	{
		$codigos = $_POST['codigos'];
		$apagado  = 0;
		
		$controlador	= new controladorUsuario();
		
		foreach ($codigos as $codigo)
		{
			$controlador->apaga2($codigo);
		}
		
		$collectionUsuario = $controlador->getCollectionUsuario2();
		
		echo
			"
				<!--Titulo-->
				<tr>
					<td align='center'>
						Alterar
					</td>
					<td align='center'>
						Nome
					</td>
					<td align='center'>
						Login
					</td>
					<td align='center'>
						Usuario
					</td>
					<td align='center'>
						Categoria
					</td>
					<td align='center'>
						Produto
					</td>
					<td align='center'>
						Or�amento
					</td>
					<td align='center'>
						Excluir
					</td>
				</tr>
				<tr>
					<td colspan='8'>
						<hr>
					</td>
				</tr> 
				<!--Dados-->
			";
		foreach ($collectionUsuario as $usuario)
		{
			echo
				"
					<!--{$usuario->nome}-->
					<tr>
						<td align='center'>
							<input type='radio' name='radioUsuario' id='radioUsuario' value='{$usuario->codigo}'>
						</td>
						<td>
							{$usuario->nome}
						</td>
						<td>
							{$usuario->usuario}
						</td>
						<td align='center'>
				";
			if($usuario->telaUsuario == 1)
				echo '&check;';
			echo
				"
						</td>
						<td align='center'>
				";
			if($usuario->telaCategoria == 1)
				echo '&check;';
			echo
				"
						</td>
						<td align='center'>
				";
			if($usuario->telaProduto == 1)
				echo '&check;';
			echo
				"
						</td>
						<td align='center'>
				";
			if($usuario->telaOrcamento == 1)
				echo '&check;';
			echo
				"
						</td>
						<td align='center'>
							<input type='checkbox' name='usuariosApagar[]' class='chkUsuariosApagar' value='{$usuario->codigo}'>
						</td>
					</tr>
				";
		}
		echo
			"
				<tr>
					<td colspan='8'>
						<hr>
					</td>
				</tr>
				<!--Bot�es-->
				<tr>
					<td align='center'>
						<input type='button' value='Alterar' onclick='alteraUsuario()'>
					</td>
					<td colspan='6' align='center'>
						<input type='button' value='Cadastrar' onclick='novoUsuario()'>
					</td>
					<td align='center'>
			";
		if(count($collectionUsuario()) > 0)
			echo "<input type='button' value='Apagar' onclick='apagaUsuario()'>";
		echo
			"
				</td>
				</tr>
			";
	}
	//Altera��o de Senha
	else if($request == 'alteraSenha')
	{
		$controlador = new controladorUsuario;
		$controlador->setSenhaAtual($_POST['senhaAtual']);
		$controlador->setSenha($_POST['senhaNova']);
		
		if($controlador->verificaSenhaAtual())
		{
			if($controlador->alteraSenha())
			{
				$_SESSION['usuario']->senha = $controlador->getSenha();
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
	//Altera��o de Senha Cliente
	else if($request == 'alteraSenhaCliente')
	{
		$controlador = new controladorClientes();
		$controlador->setCodigo($_POST['codigo']);
		$controlador->setSenha($_POST['senhaNova']);
		
		if($controlador->alteraSenha())
			echo 'Senha alterada com sucesso!';
		else
			echo 'Erro ao alterar senha!';
	}
	//Remover Cor
	else if($request == 'apagaCor')
	{
		
		$controlador = new controladorProdutos();
		
		$controlador->setCodigoProd($_POST['codProd']);
		$controlador->setCodigoProdCor($_POST['codCor']);
				
		$controlador->apagarCor();
		
		$controlador->setCollectionProdutosCores(NULL);
		$collectionCor = $controlador->getCollectionProdutosCores2($controlador->getCodigoProd());
		
		$numeroCor = 1;
		foreach ($collectionCor as $cor)
		{
			echo
			"	<tr>																														
					<td>																													
						Nome																												
					</td>																													
					<td>																													
						<input																												
							type='text'																										
							class='campo'																									
							name='nomeCor_".strval($numeroCor)."'																						
							id='nomeCor_".strval($numeroCor)."'																						
							placeholder='Nome'																								
							maxlength='20'																									
							value='{$cor->nome}'																							
						/>																													
					</td>																													
				</tr>																														
				<tr>																														
					<td>																													
						Cor 1																												
					</td>																													
					<td>																													
						<input																												
							type='color'																									
							class='campo cor_".strval($numeroCor)."'																					
							name='cor1_".strval($numeroCor)."'																						
							id='cor1_".strval($numeroCor)."'																							
							placeholder='Cor 1'																								
							value='{$cor->cor1}'																							
							onchange=\"alteraCor('cor_{$numeroCor}', this.value)\"															
						>																													
					</td>																													
				</tr>																														
				<tr>																														
					<td>																													
						Cor 2																												
					</td>																													
					<td>																													
						<input																												
							type='color'																									
							class='campo cor_".strval($numeroCor)."'																					
							name='cor2_".strval($numeroCor)."'																						
							id='cor2_".strval($numeroCor)."'																							
							placeholder='Cor 1'																								
							value='{$cor->cor2}'																							
						>																													
					</td>																													
				</tr>																														
				<tr>																														
					<td>																													
						Banner																												
					</td>																													
					<td>																													";

			/*//Banner 1
			if($cor->banner1 == 1)
				echo "<input type='checkbox' name='banner1_".strval($numeroCor)."'	class='chkBanner1_".strval($numeroCor)."'	value='1' checked>Banner 1<br>";
			else
				echo "<input type='checkbox' name='banner1_".strval($numeroCor)."'	class='chkBanner1_".strval($numeroCor)."'	value='1'>Banner 1<br>";

			//Banner2
			if($cor->banner2 == 1)
				echo "<input type='checkbox' name='banner2_".strval($numeroCor)."'	class='chkBanner2_".strval($numeroCor)."'	value='1' checked>Banner 2<br>";
			else
				echo "<input type='checkbox' name='banner2_".strval($numeroCor)."'	class='chkBanner2_".strval($numeroCor)."'	value='1'>Banner 2<br>";

			//Banner3
			if($cor->banner3 == 1)
				echo "<input type='checkbox' name='banner3_".strval($numeroCor)."'	class='chkBanner3_".strval($numeroCor)."'	value='1' checked>Banner 3<br>";
			else
				echo "<input type='checkbox' name='banner3_".strval($numeroCor)."'	class='chkBanner3_".strval($numeroCor)."'	value='1'>Banner 3<br>";*/

			//Home
			if($cor->home == 1)
				echo "<input type='checkbox' name='home_".strval($numeroCor)."'	class='chkHome_".strval($numeroCor)."'	value='1' checked>Home";
			else
				echo "<input type='checkbox' name='home_".strval($numeroCor)."'	class='chkHome_".strval($numeroCor)."'	value='1'>Home";

			echo
			"		</td>																														
				</tr>																															
				<tr>																															
					<td>																														
						Foto																													
					</td>																														
					<td>																														
						<img																													
							src='http://www.docebacanalingerie.com.br/app.view/img/produtos/thumbs/{$this->getProduto()->codigo}_{$cor->codigo}.jpg'		
							alt='{$cor->nome}'																									
							title='{$cor->nome}'																								
						/>																														
					</td>																														
				</tr>																															
				<tr>																															
					<td colspan='2' align='center'>																								
						<input																													
							name='botaoRemoverCor'																								
							type='button'																										
							id='botaoRemoverCor'																								
							value='Remover Cor'																									
							onclick='removeCor({$this->getProduto()->codigo}, {$cor->codigo})'													
						/>																														
					</td>																														
				</tr>																															
				<tr> <td colspan='2'><hr></td></tr>																								";

			$numeroCor++;
		}
	}
	else if($request == 'apagaProdutos')
	{
		$codigos = $_POST['codigos'];
		
		$controlador	= new controladorProdutos();
		
		foreach ($codigos as $codigo)
		{
			$controlador->apagaProduto($codigo);
		}
		
		
		$collectionProdutos = $controlador->getCollectionProdutos2();
		
		
		echo
			"
				<tr>
					<td align='center'>
						Alterar
					</td>
					<td align='center'>
						Referencia
					</td>
					<td align='center'>
						Categoria
					</td>
					<td align='center'>
						Excluir
					</td>
				</tr>
				<tr>
					<td colspan='4'>
						<hr>
					</td>
				</tr>
			";
		
		foreach ($collectionProdutos as $produto)
		{
			echo
				"
					<!--{$produto->referencia}-->
					<tr>
						<td align='center'>
							<input type='radio' name='radioProduto' id='radioProduto' value='{$produto->codigo}'>
						</td>
						<td>
							{$produto->referencia}
						</td>
						<td>
							{$produto->nome} <!--Nome Categoria-->
						</td>
						<td align='center'>
							<input type='checkbox' name='produtosApagar[]' class='chkProdutosApagar' value='{$produto->codigo}'>
						</td>
					</tr>
				";
		}
		
		echo
			"
				<tr>
					<td colspan='4'>
						<hr>
					</td>
				</tr>
				<!--Bot�es-->
				<tr>
					<td>
						<input type='button' value='Alterar' onclick='alteraProduto()'>
					</td>
					<td colspan='2' align='center'>
						<input type='button' value='Cadastrar' onclick='novoProduto()'>
					</td>
					<td>
			";
			
			if(count($collectionProdutos > 0))
				echo "<input type='button' value='Apagar' onclick='apagaProdutos()'>";
			
			echo "
					</td>
				</tr>
			";
	}
	else if($request == 'buscaCorDefinida')
	{
		$controlador = new controladorProdutos();
		$cor = $controlador->getCor($_POST['codigo']);
		$cor = $cor->nome.'~'.$cor->cor1.'~'.$cor->cor2;
		echo $cor;
	}
	else if($request == 'atualizaOrcamento')
	{
		$controlador = new controladorOrcamentos();
		
		$controlador->setCodigoOrcamento($_POST['codigo']);
		$controlador->setStatus($_POST['status']);
		$controlador->setCodigoCorreio($_POST['rastreio']);
		
		if($controlador->salva())
			echo 'Or�amento atualizado com sucesso!';
		else
			echo 'Falha ao atualizar or�amento!';
	}
	else if($request == 'alteraCor')
	{
		$controlador = new controladorProdutos();
		
		$controlador->setCodigoCores($_POST['codigo']);
		$controlador->setNomeCores($_POST['nome']);
		$controlador->setCor1Cores($_POST['cor1']);
		$controlador->setCor2Cores($_POST['cor2']);
		
		if($controlador->atualizaCor())
			echo 'Cor atualizada com sucesso!';
		else
			echo 'Falha ao atualizar cor!';
	}
	//Apagar Categoria
	else if($request == 'apagaClientes')
	{
		$codigos = $_POST['codigos'];
		$apagado  = 0;
		
		$controlador	= new controladorClientes();
		
		foreach ($codigos as $codigo)
		{
			$controlador->apaga2($codigo);
		}
		
		$collectionCliente = $controlador->getCollectionClientes2();
		
		echo
			"
				<tr>
					<td align='center'>
						Selecionar
					</td>
					<td align='center'>
						Nome
					</td>
					<td align='center'>
						Documento
					</td>
					<td align='center'>
						Email
					</td>
					<td align='center'>
						Excluir
					</td>
				</tr>
				<tr>
					<td colspan='5'>
						<hr>
					</td>
				</tr>
			";
		
		foreach($collectionCliente as $cliente)
		{
			if(isset($cliente->cpf) && ($cliente->cpf != ''))
				$documento = $cliente->cpf;
			if(isset($cliente->cnpj) && ($cliente->cnpj != ''))
				$documento = $cliente->cnpj;
			echo 
				"
					<tr>
						<td>
							<input type='radio' name='radioCliente' id='radioCliente' value='{$cliente->codigo}'>
						</td>
						<td>
							{$cliente->nome}
						</td>
						<td>
							{$documento}
						</td>
						<td>
							{$cliente->email}
						</td>
						<td align='center'>
							<input type='checkbox' name='clientesApagar[]' class='chkClientesApagar' value='{$cliente->codigo}'>
						</td>
					</tr>
				";
		}
		
		echo
			"
				<tr>
					<td colspan='5'>
						<hr>
					</td>
				</tr>
				<!--Bot�es-->
				<tr>
					<td colspan='5' align='center'>
						<input type='button' value='Visualizar'		onclick='visualizaCliente()'>
						<input type='button' value='AlterarSenha'	onclick='redirecionaSenhaCliente()'>
			";
		
		if(count($this->getCollectionClientes()) > 0)
			echo "<input type='button' value='Apagar' onclick='apagaClientes()'>";
		
		echo
			"
					</td>
				</tr>
			";
	}
	else if($request == 'salvaTutorial')
	{
		
		$link = $_POST['link'];
		if(strpos($link, 'watch?v=') !== false)
			$link = str_replace('watch?v=', 'embed/', $link);
		
		$controlador = new controladorTutorial();
		
		$controlador->setLink($link);
		if($controlador->salva())
			echo "";
		else
			echo "";
	}
	else if($request == 'apagaOrcamento')
	{
		$codigos = $_POST['codigos'];
		
		$controlador	= new controladorOrcamentos();
		
		foreach ($codigos as $codigo)
		{
			if($controlador->apagaProdutoOrcamento($codigo))
				$controlador->apagaOrcamento($codigo);
		}
		
		$collectionOrcamento = $controlador->getCollectionOrcamentos2();
		
		echo 
			"
				<tr>
					<td align='center'>
						Selecionar
					</td>
					<td align='center'>
						C�digo
					</td>
					<td align='center'>
						Cliente
					</td>
					<td align='center'>
						Data e Hora
					</td>
					<td align='center'>
						Quantidade de itens
					</td>
					<td>
						Status
					</td>
					<td>
						Excluir
					</td>
				</tr>
				<tr>
					<td colspan='7'>
						<hr>
					</td>
				</tr>
			";
		
		
		foreach($collectionOrcamento as $orcamento)
		{
			
			$data = $controlador->converteData($orcamento->dataHora);

			if($orcamento->status == 0)
				$status = 'Aberto';
			else if($orcamento->status == 1)
				$status = 'Realizando Or�amento';
			else if($orcamento->status == 2)
				$status = 'Aguardando Cliente';
			else if($orcamento->status == 3)
				$status = 'Aguardando Pagamento';
			else if($orcamento->status == 4)
				$status = 'Postado no Correio';
			else if($orcamento->status == 5)
				$status = 'Entregue';

			echo
				"
					<tr>
						<td align='center'>
							<input type='radio' name='radioOrcamento' id='radioOrcamento' value='{$orcamento->codigo}'>
						</td>
						<td>
							{$orcamento->codigo}
						</td>
						<td>
							{$orcamento->cliente}
						</td>
						<td>
							{$data}
						</td>
						<td align='center'>
							{$orcamento->total}
						</td>
						<td>
							{$status}
						</td>
						<td align='center'>
							<input type='checkbox' name='orcamentosApagar[]' class='chkOrcamentosApagar' value='{$orcamento->codigo}'>
						</td>
					</tr>
				";
		}
		
		echo
			"
				<tr>
					<td colspan='7'>
						<hr>
					</td>
				</tr>
				<!--Bot�es-->
				<tr>
					<td colspan='7' align='center'>
						<input type='button' value='Selecionar' onclick='selecionaOrcamento()'>
			";
		
		if(count($collectionOrcamento > 0))
			echo "<input type='button' value='Apagar' onclick='apagaOrcamentos()'>";
		
		echo 
			'
					</td>
				</tr>
			';
	}
?>