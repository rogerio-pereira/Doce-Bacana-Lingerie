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
	 * Constantes
	 */
	const DIRETORIO						= '../../app.view/img/produtos/';
	const DIRETORIO_THUMB				= '../../app.view/img/produtos/thumbs/';
	const DIRETORIO_MINIATURA			= '../../app.view/img/produtos/miniaturas/';
	const DIRETORIO_BANNER1				= '../../app.view/img/produtos/banner1/';
	const DIRETORIO_BANNER2				= '../../app.view/img/produtos/banner2/';
	const DIRETORIO_BANNER3				= '../../app.view/img/produtos/banner3/';
	const DIRETORIO_HOME				= '../../app.view/img/produtos/home/';		
	
		
	
	/*
	 * Variaveis
	 */
	private	$extensao;
	private	$foto_temp;
	private	$foto_name;
	private	$foto_size;
	private	$foto_type;
	private $imagem;


	/*
	 * Getters e Setters
	 */
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

	function getImagem()
	{
		return $this->imagem;
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

	function setImagem($imagem)
	{
		$this->imagem = $imagem;
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

	public function upload($nome, $banner1, $banner2, $banner3, $home)
	{
		
		//Alterando nome da imagem
		$array = explode('.', $this->foto_name);
		$array[0] = $nome;
		$this->setFoto_name(implode('.', $array));
		
		//ENVIA O ARQUIVO PARA A PASTA
		if(move_uploaded_file($this->foto_temp, self::DIRETORIO.$this->foto_name))
		{
			//Copia a imagem para a pasta Thumbs
			if(copy(self::DIRETORIO.$this->foto_name, self::DIRETORIO_THUMB.$this->foto_name))
				$this->redimensionaImagem (self::DIRETORIO_THUMB.$this->foto_name, 114);
			
			//Copia a imagem para a pasta Miniatura
			if(copy(self::DIRETORIO.$this->foto_name, self::DIRETORIO_MINIATURA.$this->foto_name))
				$this->redimensionaImagem (self::DIRETORIO_MINIATURA.$this->foto_name, 35);
			
			//Banner 1
			if($banner1 == true)
			{
				if(copy(self::DIRETORIO.$this->foto_name, self::DIRETORIO_BANNER1.$this->foto_name))
					$this->redimensionaImagem (self::DIRETORIO_BANNER1.$this->foto_name, 161);
			}
			
			//Banner 2
			if($banner2 == true)
			{
				if(copy(self::DIRETORIO.$this->foto_name, self::DIRETORIO_BANNER2.$this->foto_name))
					$this->redimensionaImagem (self::DIRETORIO_BANNER2.$this->foto_name, 161);
			}
			
			//Banner 3
			if($banner3 == true)
			{
				if(copy(self::DIRETORIO.$this->foto_name, self::DIRETORIO_BANNER3.$this->foto_name))
					$this->redimensionaImagem (self::DIRETORIO_BANNER3.$this->foto_name, 161);
			}
			
			//Home
			if($home == true)
			{
				if(copy(self::DIRETORIO.$this->foto_name, self::DIRETORIO_HOME.$this->foto_name))
					$this->redimensionaImagem (self::DIRETORIO_HOME.$this->foto_name, 228);
			}
		}
	}
	
	/*
	 *  Método redimensionaImagem
	 *  Redimensiona imagem
	 */
	protected function redimensionaImagem($imagem, $larguraNova)
	{
		try
		{
			$this->setImagem($imagem);											//Seta o diretorio completo
			//
			//Imagem PNG
			if(strpos($this->getImagem(), '.png') !== FALSE)
			{
				$original		= imagecreatefrompng($this->getImagem());		//Carrega PNG
			}
			else if(strpos($this->getImagem(), '.jpg') !== FALSE)
			{
				$original		= imagecreatefromjpeg($this->getImagem());		//Carrega PNG
			}
			
			$largOriginal	= imagesx($original);								//Carrega Largura;
			$altOriginal	= imagesy($original);								//Carrega Altura
			
			$fator		= $altOriginal / $largOriginal;							//Calcula Fator de redimensionamento
			$alturaNova	= $larguraNova * $fator;								//Calcula Altura Nova
			
			$saida		= imagecreatetruecolor($larguraNova,$alturaNova);		//Cria imagem nova
			//
			//Transparencia PNG
			if(strpos($this->getImagem(), '.png') !== FALSE)
			{
				imagealphablending($saida,	false);
				imagesavealpha($saida,		true);
				$transparent = imagecolorallocatealpha($saida, 255, 255, 255, 127);
				imagefilledrectangle($saida, 0, 0, $larguraNova, $alturaNova, $transparent);
			}
			
			imagecopyresized($saida,$original, 0, 0, 0, 0,$larguraNova,$alturaNova,$largOriginal,$altOriginal);	//Cria copia da imagem redimentionada
			
			if(strpos($this->getImagem(), '.png') !== FALSE)
			{
				imagepng($saida, $this->getImagem());																//Grava imagem PNG nova, com qualidade 100%
			}
			else if(strpos($this->getImagem(), '.jpg') !== FALSE)
				imagejpeg($saida, $this->getImagem(), 100);															//Grava imagem JPG nova, com qualidade 100%
			
			imagedestroy($saida);
			imagedestroy($original);
			$this->setImagem(NULL);
			
			return true;
		}
		catch (Exception $e)
		{
			return false;
		}
	}
	
	/*
	 * Método apagaImagem($imagem)
	 * Apaga a imagem passada como parametro
	 */
	public function apagaImagem($imagem)
	{
		try
		{
			if(file_exists($imagem))
				unlink($imagem);
		} 
		catch (Exception $ex) 
		{
			echo "<script>alert('Erro ao apagar imagem!');</script>";
		}
	}
}

?>