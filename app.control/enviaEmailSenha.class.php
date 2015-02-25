<?php
    require_once ('class.phpmailer.php');
	
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
    
    /*
     *  Classe que controla o envio de e-mails da pagina Contato
     */
    class enviaEmailSenha
    {
		/*
		 * Constantes
		 */
		const DE		= 'Doce & Bacana Lingerie (Por favor nao responda)';
		const ASSUNTO	= 'Solicita��o Altera��o de Senha';
		
		/*
		 * Variaveis
		 */
		private $deEmail;
		private $cliente;
		
		private $headers;
		private $corpoMensagem;
		
		/*
		 * Getters e Setters
		 */
		function getDeEmail()
		{
			return $this->deEmail;
		}

		function getCliente()
		{
			return $this->cliente;
		}

		function setDeEmail($deEmail)
		{
			$this->deEmail = $deEmail;
		}

		function setCliente($cliente)
		{
			$this->cliente = $cliente;
		}

				
		
		/*
		 * M�todo contrutor
		 */
		public function __construct()
		{
			$this->setCliente((new controladorClientes())->getClienteByEmail($_POST['email']));
			
			if(($this->getCliente() != NULL) || ($this->cliente != ''))
			{
				$this->configuraEmail();
				$this->constroiEmail();
				//$this->send();
				$this->send2();
			}
			else
				echo	
					"
						<script>
							alert('Email n�o cadastrado!');
							window.history.back()
						</script>
					";
		}


		/*
         *  M�todo constroiEmail
         *  Monta o email no formato para ser enviado
         */
        public function constroiEmail()
        {
            /*
             *  Headers
             */
            $nome = self::DE;
            $this->headers = "MIME-Version: 1.1\n";
            $this->headers .= "Content-type: text/html; charset=iso-8859-1\n";		// ou UTF-8, como queira
            $this->headers .= "From: {$nome} <{$this->deEmail}}>\n";		       // remetente
            /*$this->headers .= "Return-Path: $this->de\n";							// return-path
            $this->headers .= "Reply-To: $this->de\n";								// Endere�o (devidamente validado) que o seu usu�rio informou no contato*/
            
            $this->corpoMensagem =  "
										<p>
											Ol� {$this->getCliente()->nome}, Voc� solicitou um link de redefini��o de senha do site
											<a href='http://www.docebacanalingerie.com.br' title='Doce & Bacana Lingerie' alt='Doce & Bacana Lingerie'>
												Doce & Bacana Lingerie
											</a>.
										</p>
										
										<p>
											Acesse o link para alterar a sua senha
											<a href='http://www.docebacanalingerie.com.br/alteraSenha/{$this->getCliente()->chave}'
											   title='Confirma��o de Cadastro'
											   alt='Confirma��o de Cadastro'
											>
												http://www.docebacanalingerie.com.br/alteraSenha/{$this->getCliente()->chave}
											</a>
										</p>
										
										<p>
											Caso n�o tenha sido voc� que solicitou a altera��o de senha, por favor ignore esse e-mail
										</p>
										
										<p>
											Este � um e-mail enviado de forma automatica, por favor nao responda... Qualquer d�vida entre em contato pelo e-mail 
											<a href='mailto:contato@docebacanalingerie.com.br' alt='E-mail de Contato' title='E-mail de Contato'>
												contato@docebacanalingerie.com.br
											</a>
										</p>
										
										<p>
											A Doce & Bacana Lingerie agradece pela sua preferencia.
										</p>
									";
        }
        
        /*
         *  M�todo configuraEmail
         *  Configura parametros da classe PHPMailer
         */
        public function configuraEmail()
        {
			// verifica se existe arquivo de configuração para este banco de dados
            if (file_exists("../app.config/mail.ini"))
            {
                // lê o INI e retorna um array
                $configMail = parse_ini_file("../app.config/mail.ini");
            }
            else
            {
                // se não existir, lança um erro
                throw new Exception("Arquivo mail.ini não encontrado");
            }
            
            $this->mail = new PHPMailer;
            //Configura��es SMTP
            // l� as informa��es contidas no arquivo
            $this->mail->isSmtp();
            $this->mail->Host         = isset($configMail['host'])          ? $configMail['host']       : NULL;     //Host
            $this->mail->SMTP_PORT    = isset($configMail['smtpPort'])      ? $configMail['smtpPort']   : NULL;     //Porta
            $this->mail->SMTPAuth     = isset($configMail['smtpAuth'])      ? $configMail['smtpAuth']   : NULL;     //Liga a autentica��o de seguran�a
            $this->mail->SMTPSecure   = isset($configMail['smtpSecure'])    ? $configMail['smtpSecure'] : NULL;     //Tipo de criptografia de autenticacao
            $this->mail->Username     = isset($configMail['username'])      ? $configMail['username']   : NULL;     //Usuario SMTP
            $this->mail->Password     = isset($configMail['password'])      ? $configMail['password']   : NULL;     //Senha SMTP
            $this->mail->SMTPDebug    = isset($configMail['smtpDebug'])     ? $configMail['smtpDebug']  : NULL;     //Ativa Debuga��o do codigo
            $this->mail->From         = isset($configMail['username'])      ? $configMail['username']   : NULL;     //Usuario SMTP
			$this->setDeEmail($configMail['username']);
            //Remetente
            $this->mail->FromName     = self::DE;																	//E-mail remetente
            //Destinatario
            $this->mail->AddAddress($this->getCliente()->email);				                                    //E-mail destinatario
			$this->mail->AddAddress($configMail['username']);                                                       //E-mail destinatario
            //Define mensagem HTML
            $this->mail->IsHTML(true);                                                                              //Formato do texto em HTML
            $this->mail->CharSet      = 'iso-8859-1';                                                               //Caracteres do E-mail
            //Assunto                                                      
            $this->mail->Subject      = self::ASSUNTO;																//Assunto
            $this->mail->Body         = $this->corpoMensagem;                                                       //Mensagem
            //Anexos (opcional)                                                    
            //$mail->AddAttachment("");                                                                             //Anexo
        }
        
        /*
         *  M�todo send
         *  Envia o email
         */
        public function send()
        {
            //Envia
            $enviado = $this->mail->Send();
            
            // Limpa os destinat�rios e os anexos
            $this->mail->ClearAllRecipients();
            $this->mail->ClearAttachments();
            
            // Exibe uma mensagem de resultado
            if ($enviado)
            {
                echo "
                        <script type='text/javascript'> 
                            alert('Mensagem enviada com sucesso!');
                            top.location='/';
                        </script>
                    ";
            }
            else
            {
                echo "
                        <script type='text/javascript'> 
                            alert(  'Mensagem não enviada');
							top.location='/';
                        </script>
                    ";
            }

        }
		
		/*
         *  M�todo send2
         *  Envia o email pela fun��o mail
         */
        public function send2()
        {			
			if(mail($this->getCliente()->email,	self::ASSUNTO, $this->corpoMensagem, $this->headers, '-r'.$this->getDeEmail()))
				echo "
                        <script type='text/javascript'> 
                            alert('Link de redefini��o de senha enviado com sucesso!');
                            top.location='/';
                        </script>
                    ";
            else
				echo "
                        <script type='text/javascript'> 
                            alert('Falha ao enviar link de redefini��o de senha!');
							top.location='/';
                        </script>
                    ";
        }
    }
	new enviaEmailSenha();
?>