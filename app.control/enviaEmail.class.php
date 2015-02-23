<?php
    require_once ('class.phpmailer.php');
    
    /*
     *  Classe que controla o envio de e-mails da pagina Contato
     */
    class enviaEmail
    {
        private $nome;
        private $de;
        private $assunto;
        private $mensagem;
        private $corpoMensagem;
        private $para;
        private $mail;
        private $telefone;
		private $operadora;
        private $cidade;
        //private $headers;
        
        /*
         *  MÈtodo construtor
         *  Inicializa as variaveis, constroi o email, configura servidor e envia
         */
        public function __construct()
        {
            enviaEmail::getValores();
            enviaEmail::constroiEmail();
            enviaEmail::configuraEmail();
            //enviaEmail::send();
            enviaEmail::send2();
        }
        
        /*
         *  MÈtodo getValores
         *  Obtem os valores do formulario
         */
        private function getValores()
        {
            $this->nome			= $_POST['txtNome'];
            $this->de			= $_POST['txtEmail'];
            $this->assunto		= $_POST['txtAssunto'];
            $this->mensagem		= $_POST['txtMensagem'];
            $this->telefone		= $_POST['txtTelefone'];
			$this->operadora	= $_POST['txtOperadora'];
            $this->cidade		= $_POST['txtCidade'];
            $this->para			= 'contato@docebacanalingerie.com.br';  //Email que vai receber o email de contato
        }
        
        /*
         *  MÈtodo constroiEmail
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
            $this->headers .= "Reply-To: $this->de\n";                          // EndereÁo (devidamente validado) que o seu usu·rio informou no contato*/
			
			if(isset($this->operadora) || ($this->operadora != ''))
				$op = " ({$this->operadora})";
            
            $this->corpoMensagem =  "
                                        <b>Nome:</b> {$this->nome}<br>\n
                                        <b>Email:</b> {$this->de}<br>\n
                                        <b>Telefone:</b> {$this->telefone}{$op}<br>\n
                                        <b>Cidade:</b> {$this->cidade}<br>\n
                                        <b>Assunto:</b> {$this->assunto}<br>\n
                                        <b>Mensgem:</b><br>\n
                                        {$this->mensagem};
                                    ";
        }
        
        /*
         *  MÈtodo configuraEmail
         *  Configura parametros da classe PHPMailer
         */
        private function configuraEmail()
        {
            // verifica se existe arquivo de configura√ß√£o para este banco de dados
            if (file_exists("../app.config/mail.ini"))
            {
                // l√™ o INI e retorna um array
                $configMail = parse_ini_file("../app.config/mail.ini");
            }
            else
            {
                // se n√£o existir, lan√ßa um erro
                throw new Exception("Arquivo mail.ini n√£o encontrado");
            }
            
            $this->mail = new PHPMailer;
            //ConfiguraÁıes SMTP
            // lÍ as informaÁıes contidas no arquivo
            $this->mail->isSmtp();
            $this->mail->Host         = isset($configMail['host'])          ? $configMail['host']       : NULL;     //Host
            $this->mail->SMTP_PORT    = isset($configMail['smtpPort'])      ? $configMail['smtpPort']   : NULL;     //Porta
            $this->mail->SMTPAuth     = isset($configMail['smtpAuth'])      ? $configMail['smtpAuth']   : NULL;     //Liga a autenticaÁ„o de seguranÁa
            $this->mail->SMTPSecure   = isset($configMail['smtpSecure'])    ? $configMail['smtpSecure'] : NULL;     //Tipo de criptografia de autenticacao
            $this->mail->Username     = isset($configMail['username'])      ? $configMail['username']   : NULL;     //Usuario SMTP
            $this->mail->Password     = isset($configMail['password'])      ? $configMail['password']   : NULL;     //Senha SMTP
            $this->mail->SMTPDebug    = isset($configMail['smtpDebug'])     ? $configMail['smtpDebug']  : NULL;     //Ativa DebugaÁ„o do codigo
            $this->mail->From         = isset($configMail['username'])      ? $configMail['username']   : NULL;     //Usuario SMTP
            //Remetente
            $this->mail->FromName     = $this->nome;                                                                //E-mail remetente
            //Destinatario
            $this->mail->AddAddress($this->para);                                                                   //E-mail destinatario
            $this->mail->AddReplyTo($this->de);
            //Define mensagem HTML
            $this->mail->IsHTML(true);                                                                              //Formato do texto em HTML
            $this->mail->CharSet      = 'iso-8859-1';                                                               //Caracteres do E-mail
            //Assunto                                                      
            $this->mail->Subject      = $this->assunto;                                                             //Assunto
            $this->mail->Body         = $this->corpoMensagem;                                                       //Mensagem
            //Anexos (opcional)                                                    
            //$mail->AddAttachment("");                                                                             //Anexo
        }
        
        /*
         *  MÈtodo send
         *  Envia o email
         */
        private function send()
        {
            //Envia
            $enviado = $this->mail->Send();
            
            // Limpa os destinat·rios e os anexos
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
                            alert(  'Mensagem n√£o enviada');
                            history.back(1)
                        </script>
                    ";
            }

        }
		
		/*
         *  MÈtodo send2
         *  Envia o email pela funÁ„o mail
         */
        private function send2()
        {
            if(mail($this->para, $this->assunto, $this->corpoMensagem, $this->headers, '-r'.$this->de))
            {
                echo "
                        <script type='text/javascript'> 
                            alert('Mensagem enviada com sucesso!');
                            top.location='/';
                        </script>
                    ";
            }
            else
                echo "
                        <script type='text/javascript'> 
                            alert(  'Mensagem n„o enviada');
                            top.location='/';
                        </script>
                    ";
        }
    }
    
    new enviaEmail;
?>