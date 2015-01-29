<?php

/*
 * 	Arquivo  controladorUpload.class.php
 * 	Controla Upload de Arquivos
 * 	
 * 	Sistema:	Doce___Bacana_Lingerie
 * 	Autor:      Rogério Eduardo Pereira
 * 	Data:       29/01/2015
 */

/*
 * Classe controladorUpload.class.php
 */
class controladorUpload
{
	/*
	 * Variaveis
	 */
	private $diretorio;
	private	$subdiretorio;
	private	$extensao;
	private	$foto_temp;
	private	$foto_name;
	private	$foto_size;
	private	$foto_type;


	/*
	 * Getters e Setters
	 */
	function getDiretorio()
	{
		return $this->diretorio;
	}

	function getSubdiretorio()
	{
		return $this->subdiretorio;
	}

	function getExtensao()
	{
		return $this->extensao;
	}

	function getFoto_temp()
	{
		return $this->foto_temp;
	}

	function getFoto_name()
	{
		return $this->foto_name;
	}

	function getFoto_size()
	{
		return $this->foto_size;
	}

	function getFoto_type()
	{
		return $this->foto_type;
	}

	function setDiretorio($diretorio)
	{
		$this->diretorio = $diretorio;
	}

	function setSubdiretorio($subdiretorio)
	{
		$this->subdiretorio = $subdiretorio;
	}

	function setExtensao($extensao)
	{
		$this->extensao = $extensao;
	}

	function setFoto_temp($foto_temp)
	{
		$this->foto_temp = $foto_temp;
	}

	function setFoto_name($foto_name)
	{
		$this->foto_name = $foto_name;
	}

	function setFoto_size($foto_size)
	{
		$this->foto_size = $foto_size;
	}

	function setFoto_type($foto_type)
	{
		$this->foto_type = $foto_type;
	}

	

	/*
	 * Método Contrutor
	 */
	public function __construct()
	{
		$this->setExtensao(NULL);
		$this->setFoto_name(NULL);
		$this->setFoto_temp(NULL);
		$this->setFoto_size(NULL);
		$this->setFoto_type(NULL);
	}

	public function upload()
	{
		$this->setDiretorio('../../app.view/img/');
		echo getcwd()."\n";
		chdir($this->getDiretorio());
		echo getcwd()."\n";
		
		var_dump(scandir(getcwd()));
	}
}

?>