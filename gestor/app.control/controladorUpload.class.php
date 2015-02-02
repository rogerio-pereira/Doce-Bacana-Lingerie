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
	private $diretorioBanner1;
	private $diretorioBanner2;
	private $diretorioBanner3;
	private $diretorioHome;
	private $diretorioMiniatura;
	private	$subdiretorio;
	private	$extensao;
	private	$foto_temp;
	private	$foto_name;
	private	$foto_size;
	private	$foto_type;
	private $imagem;


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
	function getDiretorioBanner1()
	{
		return $this->diretorioBanner1;
	}

	function getDiretorioBanner2()
	{
		return $this->diretorioBanner2;
	}

	function getDiretorioBanner3()
	{
		return $this->diretorioBanner3;
	}

	function getDiretorioHome()
	{
		return $this->diretorioHome;
	}

	function setDiretorioBanner1($diretorioBanner1)
	{
		$this->diretorioBanner1 = $diretorioBanner1;
	}

	function setDiretorioBanner2($diretorioBanner2)
	{
		$this->diretorioBanner2 = $diretorioBanner2;
	}

	function setDiretorioBanner3($diretorioBanner3)
	{
		$this->diretorioBanner3 = $diretorioBanner3;
	}

	function setDiretorioHome($diretorioHome)
	{
		$this->diretorioHome = $diretorioHome;
	}
	function getDiretorioMiniatura()
	{
		return $this->diretorioMiniatura;
	}

	function setDiretorioMiniatura($diretorioMiniatura)
	{
		$this->diretorioMiniatura = $diretorioMiniatura;
	}
	
	function getImagem()
	{
		return $this->imagem;
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
		
		$this->setDiretorio('../../app.view/img/produtos/');
		$this->setDiretorioMiniatura('../../app.view/img/produtos/miniaturas/');
		$this->setDiretorioBanner1('../../app.view/img/produtos/banner1/');
		$this->setDiretorioBanner2('../../app.view/img/produtos/banner2/');
		$this->setDiretorioBanner3('../../app.view/img/produtos/banner3/');
		$this->setDiretorioHome('../../app.view/img/produtos/home/');
		
		//Alterando nome da imagem
		$array = explode('.', $this->foto_name);
		$array[0] = $nome;
		$this->setFoto_name(implode('.', $array));
		
		//ENVIA O ARQUIVO PARA A PASTA
		if(move_uploaded_file($this->foto_temp,	$this->getDiretorio().$this->foto_name))
		{
			//Copia a imagem para a pasta Miniatura
			if(copy($this->getDiretorio().$this->foto_name, $this->getDiretorioMiniatura().$this->foto_name))
				$this->redimensionaImagem ($this->getDiretorioMiniatura().$this->foto_name, 35);
			
			//Banner 1
			if($banner1 == true)
			{
				if(copy($this->getDiretorio().$this->foto_name, $this->getDiretorioBanner1().$this->foto_name))
					$this->redimensionaImagem ($this->getDiretorioBanner1().$this->foto_name, 228);
			}
			
			//Banner 2
			if($banner2 == true)
			{
				if(copy($this->getDiretorio().$this->foto_name, $this->getDiretorioBanner2().$this->foto_name))
					$this->redimensionaImagem ($this->getDiretorioBanner2().$this->foto_name, 228);
			}
			
			//Banner 3
			if($banner3 == true)
			{
				if(copy($this->getDiretorio().$this->foto_name, $this->getDiretorioBanner3().$this->foto_name))
					$this->redimensionaImagem ($this->getDiretorioBanner3().$this->foto_name, 228);
			}
			
			//Home
			if($home == true)
			{
				if(copy($this->getDiretorio().$this->foto_name, $this->getDiretorioHome().$this->foto_name))
					$this->redimensionaImagem ($this->getDiretorioHome().$this->foto_name, 228);
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

			//Imagem PNG
			if(strpos($this->getImagem(), '.png') !== FALSE)
			{
				$original		= imagecreatefrompng($this->getImagem());		//Carrega PNG
			}
			else if(strpos($this->getImagem(), '.jpg') !== FALSE)
				$original		= imagecreatefromjpeg($this->getImagem());		//Carrega PNG

			$largOriginal	= imagesx($original);								//Carrega Largura
			$altOriginal	= imagesy($original);								//Carrega Altura

			$fator		= $altOriginal / $largOriginal;							//Calcula Fator de redimensionamento
			$alturaNova	= $larguraNova * $fator;								//Calcula Altura Nova

			$saida		= imagecreatetruecolor($larguraNova,$alturaNova);		//Cria imagem nova

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
				imagepng($saida, $this->getImagem());															//Grava imagem PNG nova, com qualidade 100%
			}
			else if(strpos($this->getImagem(), '.jpg') !== FALSE)
				imagejpeg($saida, $this->getImagem());															//Grava imagem JPG nova, com qualidade 100%

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
}

?>