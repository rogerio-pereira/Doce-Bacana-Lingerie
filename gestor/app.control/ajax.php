<?php 
	session_start();
	header("Content-Type:text/html; charset=UTF-8",true) 
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
	
	//error_reporting(E_WARNING);
	
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
?>