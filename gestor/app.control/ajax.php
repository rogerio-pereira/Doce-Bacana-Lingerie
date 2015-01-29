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
 * 	Autor:		RogÃ©rio Eduardo Pereira
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
	
	//Obtem informação do que sera feito através do campo hiddens
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
			echo "
					<script>
						alert('Falha ao fazer login');
					</script>
				";
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
					<!--Botões-->
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
		
		echo 
			"
				{$_POST['codigo']}\n
				{$_POST['nome']}\n
				{$_POST['usuario']}\n
				{$_POST['senha']}\n
				{$_POST['categoria']}\n
				{$_POST['orcamento']}\n
				{$_POST['produto']}\n
				{$_POST['usuario']}\n
			";
		
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
		
		echo '1';
		
		$collectionUsuario = $controlador->getCollectionUsuario2();
		
		echo '2';
		
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
						Orçamento
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
				<!--Botões-->
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
	//Alteração de Senha
	else if($request == 'alteraSenha')
	{
		$controlador = new controladorUsuario;
		$controlador->setSenhaAtual($_POST['senhaAtual']);
		$controlador->setSenha($_POST['senhaNova']);
		
		if($controlador->verificaSenhaAtual())
		{
			if($controlador->alteraSenha())
				echo 'Senha alterada com sucesso!';
			else
				echo 'Erro ao alterar senha!';
		}
		else
		{
			echo 'Senha Atual Inválida!';
		}
	}
	//Salvar Produto
	else if($request == 'salvaProduto')
	{
		$controlador =  new controladorProdutos();
		
		$controlador->setCodigoProd($_POST['codigo']);
		$controlador->setReferencia($_POST['referencia']);
		$controlador->setCategoria($_POST['categoria']);
		$controlador->setDescricao($_POST['descricao']);
		$controlador->setCaracteristicas($_POST['caracteristicas']);
		$controlador->setTamanhoPP($_POST['tamanhoPP']);
		$controlador->setTamanhoP($_POST['tamanhoP']);
		$controlador->setTamanhoM($_POST['tamanhoM']);
		$controlador->setTamanhoG($_POST['tamanhoG']);
		$controlador->setTamanhoGG($_POST['tamanhoGG']);
		$controlador->setTamanho48($_POST['tamanho48']);
		$controlador->setTamanho50($_POST['tamanho50']);
		$controlador->setTamanho52($_POST['tamanho52']);
		$controlador->setTamanho54($_POST['tamanho54']);
		$controlador->setCollectionProdutosCores(explode('¢', $_POST['cores']));
		
		
		if($controlador->salvaProduto())
		{
			$codigo = $controlador->getLast();
			$controlador->setCodigoProduto($codigo);
			
			$i=1;
			foreach ($controlador->getCollectionProdutosCores() as $data)
			{
				$cor = explode('¬', $data);
								
				$controlador->setNome($cor[0]);
				$controlador->setCor1($cor[1]);
				$controlador->setCor2($cor[2]);
				$controlador->setBanner1($cor[3]);
				$controlador->setBanner2($cor[4]);
				$controlador->setBanner3($cor[5]);
				$controlador->setHome($cor[6]);
				
				if($controlador->salvaCor())
				{
					if(isset($_FILES["foto_{$i}"]["tmp_name"]))
					{
						$foto_temp	= $_FILES["foto_{$i}"]["tmp_name"];
						$foto_name	= $_FILES["foto_{$i}"]["name"];
						$foto_size	= $_FILES["foto_{$i}"]["size"];
						$foto_type	= $_FILES["foto_{$i}"]["type"];
					}
				}
				else
					echo 'Erro ao salvar cor '.$i;
				
				$i++;
			}
		}
		else
			echo 'Falha ao salvar Produto!';
	}
?>