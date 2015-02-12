<?php

/*
 * 	Arquivo  controladorClientes.class.php
 * 	#DESCRIÇÂO#
 * 	
 * 	Sistema:	Doce___Bacana_Lingerie
 * 	Autor:      Rogério Eduardo Pereira
 * 	Data:       12/02/2015
 */

/*
 * Classe controladorClientes.class.php
 */
class controladorClientes
{
	/*
	 * Variaveis
	 */
	private $cliente;


	/*
	 * Getters e Setters
	 */
	function getCliente($codigo)
	{
		$this->setCliente(NULL);
		$result;
		
		//RECUPERA CONEXAO BANCO DE DADOS
		TTransaction::open('my_bd_site');

		//TABELA exposition_gallery
		//$criteria	= new TCriteria;
		//$criteria->add(new TFilter('codigo', '=', $codigo));
		//$criteria->setProperty('order', 'ordem ASC');
		
		$this->setCliente(new clientes());
		$result = $this->cliente->load($codigo);
		
		return $result;
	}

	function setCliente($cliente)
	{
		$this->cliente = $cliente;
	}

	

	/*
	 * Método Contrutor
	 */
	public function __construct()
	{
		$this->setCliente(NULL);
	}

}

?>