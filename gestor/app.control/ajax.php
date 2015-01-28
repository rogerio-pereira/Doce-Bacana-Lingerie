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
?>