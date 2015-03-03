<?php

/*
 * 	Arquivo  controladorTutorial.class.php
 * 	#DESCRIÇÂO#
 * 	
 * 	Sistema:	Doce___Bacana_Lingerie
 * 	Autor:      Rogério Eduardo Pereira
 * 	Data:       03/03/2015
 */

/*
 * Classe controladorTutorial.class.php
 */
class controladorTutorial
{
	/*
	 * Variaveis
	 */
	private $link;


	/*
	 * Getters e Setters
	 */
	function getLink()
	{
		$this->setLink(NULL);
		$result;
		
		//RECUPERA CONEXAO BANCO DE DADOS
		TTransaction::open('my_bd_site');

		//TABELA exposition_gallery
		//$criteria	= new TCriteria;
		//$criteria->add(new TFilter('codigo', '=', $codigo));
		//$criteria->setProperty('order', 'ordem ASC');
		
		$this->setLink(new tutorialModel());
		$result = $this->link->load(1);
		
		
		return $result->link;
	}

	function setLink($link)
	{
		$this->link = $link;
	}
	
	function retornaLink()
	{
		return $this->link;
	}

	

	/*
	 * Método Contrutor
	 */
	public function __construct()
	{
		$this->setLink(NULL);
	}
	
	/*
	 * Método salva
	 * Atualiza o link
	 */
	public function salva()
	{
		try
		{
			$model = new tutorialModel2();
			
			$model->codigo	= '1';
			$model->link	= $this->retornaLink();
			
			//RECUPERA CONEXAO BANCO DE DADOS
			TTransaction2::open('my_bd_site');
			
			$result = $model->store();

			TTransaction2::close();

			return true;
		}
		catch(Exception $e)
		{
			return false;
		}
	}

}

?>