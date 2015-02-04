<?php 
	$conn = mysql_connect('localhost','root','');
	mysql_select_db('paginacao');
	
	for($i=0;$i<500;$i++)
	{
		$query = mysql_query("INSERT INTO artigos VALUES ('Titulo {$i}', 'Texto {$i}')") or die(mysql_error());
	}
	echo 'ok';
	mysql_close($conn);
?>