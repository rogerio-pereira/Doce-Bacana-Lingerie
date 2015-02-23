<?php
    require_once ('class.phpmailer.php');
    
    /*
     *  Classe que controla o envio de e-mails da pagina Contato
     */
    class enviaEmailCadastro
    {
        private $nome;
        private $email;
        private $chave;
		private $de			= 'Doce & Bacana Lingerie (Por favor nao responda)';
		private $assunto	= 'Cadastro Doce & Bacana Lingerie';
		private $deEmail;
		
		function getNome()
		{
			return $this->nome;
		}

		function getEmail()
		{
			return $this->email;
		}

		function getChave()
		{
			return $this->chave;
		}

		function setNome($nome)
		{
			$this->nome = $nome;
		}

		function setEmail($email)
		{
			$this->email = $email;
		}

		function setChave($chave)
		{
			$this->chave = $chave;
		}
		function getDeEmail()
		{
			return $this->deEmail;
		}

		function setDeEmail($deEmail)
		{
			$this->deEmail = $deEmail;
		}

		
		        
        /*
         *  Método construtor
         *  Inicializa as variaveis, constroi o email, configura servidor e envia
         */
        public function __construct($nome, $email, $chave)
        {
			$this->setNome($nome);
			$this->setEmail($email);
			$this->setChave($chave);
		
			
            $this->constroiEmail();
            $this->configuraEmail();
            //$this->send();
            $this->send2();
        }
        
        /*
         *  Método constroiEmail
         *  Monta o email no formato para ser enviado
         */
        private function constroiEmail()
        {
            /*
             *  Headers
             */
            /*$this->headers = "MIME-Version: 1.1\n";
            $this->headers .= "Content-type: text/plain; charset=iso-8859-1\n"; // ou UTF-8, como queira
            $this->headers .= "From: $this->Nome <$this->de>\n";                // remetente
            $this->headers .= "Return-Path: $this->de\n";                       // return-path
            $this->headers .= "Reply-To: $this->de\n";                          // Endereço (devidamente validado) que o seu usuário informou no contato*/
            
            $this->corpoMensagem =  ""?>
										<p>
											Olá <?php echo $this->getNome(); ?>, Você foi cadastrado com sucesso no site 
											<a href='http://www.docebacanalingerie.com.br' title='Doce & Bacana Lingerie' alt='Doce & Bacana Lingerie'>
												Doce & Bacana Lingerie
											</a>.
										</p>
										
										<p>
											Precisamos que confirme que você se cadastrou clicando no link abaixo
											<a href="http://www.docebacanalingerie.com.br/confirmacao/<?php echo $this->getChave(); ?>" 
											   title="Confirmação de Cadastro" 
											   alt='Confirmação de Cadastro'
											>
												http://www.docebacanalingerie.com.br/confirmacao/<?php echo $this->getChave(); ?>
											</a>
										</p>
										
										<p>
											Caso não tenha sido você que se cadastrou, entre em contato pelo e-mail 
											<a href='mailto:adm@docebacanalingerie.com.br'>adm@docebacanalingerie.com.br</a>
										</p>
										
										<p>
											Este é um e-mail enviado de forma automatica, por favor nao responda... Qualquer dúvida entre em contato pelo e-mail 
											<a href='mailto:contato@docebacanalingerie.com.br' alt='E-mail de Contato' title='E-mail de Contato'>
												contato@docebacanalingerie.com.br
											</a>
										</p>
										
										<p>
											A Doce & Bacana Lingerie agradece pela sua preferencia.
										</p>
									<?php
        }
        
        /*
         *  Método configuraEmail
         *  Configura parametros da classe PHPMailer
         */
        private function configuraEmail()
        {
            // verifica se existe arquivo de configuraÃ§Ã£o para este banco de dados
            if (file_exists("../app.config/mail.ini"))
            {
                // lÃª o INI e retorna um array
                $configMail = parse_ini_file("../app.config/mail.ini");
            }
            else
            {
                // se nÃ£o existir, lanÃ§a um erro
                throw new Exception("Arquivo mail.ini nÃ£o encontrado");
            }
            
            $this->mail = new PHPMailer;
            //Configurações SMTP
            // lê as informações contidas no arquivo
            $this->mail->isSmtp();
            $this->mail->Host         = isset($configMail['host'])          ? $configMail['host']       : NULL;     //Host
            $this->mail->SMTP_PORT    = isset($configMail['smtpPort'])      ? $configMail['smtpPort']   : NULL;     //Porta
            $this->mail->SMTPAuth     = isset($configMail['smtpAuth'])      ? $configMail['smtpAuth']   : NULL;     //Liga a autenticação de segurança
            $this->mail->SMTPSecure   = isset($configMail['smtpSecure'])    ? $configMail['smtpSecure'] : NULL;     //Tipo de criptografia de autenticacao
            $this->mail->Username     = isset($configMail['username'])      ? $configMail['username']   : NULL;     //Usuario SMTP
            $this->mail->Password     = isset($configMail['password'])      ? $configMail['password']   : NULL;     //Senha SMTP
            $this->mail->SMTPDebug    = isset($configMail['smtpDebug'])     ? $configMail['smtpDebug']  : NULL;     //Ativa Debugação do codigo
            $this->mail->From         = isset($configMail['username'])      ? $configMail['username']   : NULL;     //Usuario SMTP
			$this->setDeEmail($configMail['username']);
            //Remetente
            $this->mail->FromName     = $this->de;																	//E-mail remetente
            //Destinatario
            $this->mail->AddAddress($this->email);                                                                   //E-mail destinatario
            //Define mensagem HTML
            $this->mail->IsHTML(true);                                                                              //Formato do texto em HTML
            $this->mail->CharSet      = 'iso-8859-1';                                                               //Caracteres do E-mail
            //Assunto                                                      
            $this->mail->Subject      = $this->assunto;																//Assunto
            $this->mail->Body         = $this->corpoMensagem;                                                       //Mensagem
            //Anexos (opcional)                                                    
            //$mail->AddAttachment("");                                                                             //Anexo
        }
        
        /*
         *  Método send
         *  Envia o email
         */
        private function send()
        {
            //Envia
            $enviado = $this->mail->Send();
            
            // Limpa os destinatários e os anexos
            $this->mail->ClearAllRecipients();
            $this->mail->ClearAttachments();
            
            // Exibe uma mensagem de resultado
            if ($enviado)
            {
                echo "
                        <script type='text/javascript'> 
                            alert('Mensagem enviada com sucesso!');
                            history.back(1);
                        </script>
                    ";
            }
            else
            {
                echo "
                        <script type='text/javascript'> 
                            alert(  'Mensagem nÃ£o enviada');
                            history.back(1)
                        </script>
                    ";
            }

        }
		
		/*
         *  Método send2
         *  Envia o email pela função mail
         */
        private function send2()
        {
            if(mail($this->para, $this->assunto, $this->corpoMensagem, $this->headers, '-r'.$this->deEmail))
            {
                echo "
                        <script type='text/javascript'> 
                            alert('Mensagem enviada com sucesso!');
                            history.back(1);
                        </script>
                    ";
            }
            else
                echo "
                        <script type='text/javascript'> 
                            alert(  'Mensagem não enviada');
                            history.back(1);
                        </script>
                    ";
        }
    }
?>