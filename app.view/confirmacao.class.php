<?php
/*
 *	Arquivo  confirmacao.class.php
 *	Pagina de Confirmação de Cadastro de Cliente
 *	
 *	Sistema:	Doce___Bacana_Lingerie
 *	Autor:      Rogério Eduardo Pereira
 *	Data:       23/01/2015
 */

	/*
	 * Classe confirmacao.class.php
	 */
	class confirmacao 
	{
		/*
		 * Variaveis
		 */
		private $resultado;
		
		
		/*
		 * Getters e Setters
		 */
		function getResultado()
		{
			return $this->resultado;
		}

		function setResultado($resultado)
		{
			$this->resultado = $resultado;
		}
				
		
		/*
		 * Método Contrutor
		 */
		public function __construct()
		{
			$this->setResultado((new controladorClientes())->ativaClienteByChave($_GET['chave']));
		}
		
		/*
		 * Método show
		 * Exibe as informações na tela
		 */
		public function show()
		{
			echo '<h1>Confirmação de Cadastro</h1><hr>';
			if($this->getResultado() == true)
				echo 'Cliente ativado com sucesso!';
			else
				echo 'Falha ao ativar Cliente!';
		}
	}

?>