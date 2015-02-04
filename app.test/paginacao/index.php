<?php 
	$db = "paginacao";
	@mysql_connect("localhost", "root", "") or trigger_error(mysql_error(),E_USER_ERROR);
	mysql_select_db($db);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Paginação Avançada com PHP</title>
<link rel="stylesheet" type="text/css" href="estilo.css" />
</head>

<body>
<div class="global-div">

<h1>Pagina&ccedil;&atilde;o Avan&ccedil;ada com PHP</h1>

<?php

$pag = ($_GET['pag']);
$pag = filter_var($pag, FILTER_VALIDATE_INT);

$inicio = 0;
$limite = 9	;

if ($pag!='')
{
	$inicio = $pag - 1;
} 

$busca_total = mysql_query("SELECT COUNT(*) as total FROM artigos");
$total = mysql_fetch_array($busca_total);
$total = $total['total'];

	$busca = mysql_query("SELECT * FROM artigos LIMIT $inicio, $limite");
	if (mysql_num_rows($busca)>0)
	{
		while ($texto = mysql_fetch_array($busca))
		{
			extract($texto);
			echo '<h2>'.$titulo.'</h2>';
			echo '<p>'. nl2br($artigo).'</p>';
		}
	
	$prox = $pag + 1;
	$ant = $pag - 1;
	$ultima_pag = ceil($total / $limite);
	$adjacentes = 4;
	
	echo '<div class="paginacao">';
	
	if ($pag>1)
	{
		$paginacao = '<a href="index.php?pag='.$ant.'">anterior</a>';
	}
	
	
if ($ultima_pag <= 9)
{
	for ($i=1; $i< $ultima_pag+1; $i++)
	{
		if ($i == $pag)
		{
			$paginacao .= '<a class="atual" href="index.php?pag='.$i.'">'.$i.'</a>';				
		} else {
			$paginacao .= '<a href="index.php?pag='.$i.'">'.$i.'</a>';	
		}
	}
} 

if ($ultima_pag > 9)
{
	if ($pag < 1 + (2 * $adjacentes))
	{
		for ($i=1; $i< 2 + (2 * $adjacentes); $i++)
		{
			if ($i == $pag)
			{
				$paginacao .= '<a class="atual" href="index.php?pag='.$i.'">'.$i.'</a>';				
			} else {
				$paginacao .= '<a href="index.php?pag='.$i.'">'.$i.'</a>';	
			}
		}
		$paginacao .= '...';
		$paginacao .= '<a href="index.php?pag='.$ultima_pag.'">'.$ultima_pag.'</a>';
	}
	elseif($pag > (2 * $adjacentes) && $pag < $ultima_pag - 3)
	{
		$paginacao .= '<a href="index.php?pag=1">1</a>';				
		$paginacao .= '... ';	
		for ($i = $pag-$adjacentes; $i<= $pag + $adjacentes; $i++)
		{
			if ($i == $pag)
			{
				$paginacao .= '<a class="atual" href="index.php?pag='.$i.'">'.$i.'</a>';				
			} else {
				$paginacao .= '<a href="index.php?pag='.$i.'">'.$i.'</a>';	
			}
		}
		$paginacao .= '...';
		$paginacao .= '<a href="index.php?pag='.$penultima.'">'.$penultima.'</a>';
		$paginacao .= '<a href="index.php?pag='.$ultima_pag.'">'.$ultima_pag.'</a>';
	}
	else {
		$paginacao .= '<a href="index.php?pag=1">1</a>';				
		$paginacao .= '... ';	
		for ($i = $ultima_pag - (4 + (2 * adjacentes)); $i <= $ultima_pag; $i++)
		{
			if ($i == $pag)
			{
				$paginacao .= '<a class="atual" href="index.php?pag='.$i.'">'.$i.'</a>';				
			} else {
				$paginacao .= '<a href="index.php?pag='.$i.'">'.$i.'</a>';	
			}
		}
	}
}

	}
	

	if ($prox <= $ultima_pag && $ultima_pag > 2)
	{
		$paginacao .= '<a href="index.php?pag='.$prox.'">pr&oacute;xima &raquo;</a>';
	}
	
		echo $paginacao;
		
	echo '</div>';
?>

</div>

</body>
</html>