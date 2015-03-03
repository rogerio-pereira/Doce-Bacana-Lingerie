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

	

	/*
	 * Método Contrutor
	 */
	public function __construct()
	{
		$this->setLink(NULL);
	}

}

?>