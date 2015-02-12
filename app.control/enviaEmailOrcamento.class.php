<?php
    require_once ('class.phpmailer.php');
    
    /*
     *  Classe que controla o envio de e-mails da pagina Contato
     */
    class enviaEmailOrcamento
    {
		/*
		 * Constantes
		 */
		const DE		= 'Or�amento - Doce & Bacana Lingerie';
		const ASSUNTO	= 'Solicita��o de Or�amento';
		
		/*
		 * Variaveis
		 */
		private $deEmail;
		private $codigoOrcamento;
        private $collectionProdutos;
		
		/*
		 * Getters e Setters
		 */
		function getDeEmail()
		{
			return $this->deEmail;
		}

		function getCodigoOrcamento()
		{
			return $this->codigoOrcamento;
		}

		function getCollectionProdutos()
		{
			return $this->collectionProdutos;
		}

		function setDeEmail($deEmail)
		{
			$this->deEmail = $deEmail;
		}

		function setCodigoOrcamento($codigoOrcamento)
		{
			$this->codigoOrcamento = $codigoOrcamento;
		}

		function setCollectionProdutos($collectionProdutos)
		{
			$this->collectionProdutos = $collectionProdutos;
		}

		
		
		        
        /*
         *  M�todo construtor
         *  Inicializa as variaveis, constroi o email, configura servidor e envia
         */
        public function __construct($codigoOrcamento, $collectionProdutos)
        {
			$this->setCodigoOrcamento($codigoOrcamento);
			$this->setCollectionProdutos($collectionProdutos);
		
            $this->constroiEmail();
            $this->configuraEmail();
            //$this->send();
            if($this->send2())
				return true;
			else
				return false;
        }
        
        /*
         *  M�todo constroiEmail
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
            $this->headers .= "Reply-To: $this->de\n";                          // Endere�o (devidamente validado) que o seu usu�rio informou no contato*/
            
            $this->corpoMensagem =  ""?>
										<p>
											Nova solicita��o de or�amento com c�digo <strong><?php echo $this->getCodigoOrcamento(); ?></strong>
										</p>
										
										<hr>
										
										<p>
											<strong>Dados do Cliente</strong>
										</p>
										
										<p>
											<strong>Nome:</strong>		<?php echo $_SESSION['cliente']->nome; ?><br>
											<strong>Telefone:</strong>	<?php echo $_SESSION['cliente']->telefone; ?><br>
											<strong>Celular:</strong>	<?php echo $_SESSION['cliente']->celular; ?><br>
											<strong>E-Mail:</strong>	<?php echo $_SESSION['cliente']->email; ?><br>
											<strong>Endere�o:</strong>	<?php 
																			echo	$_SESSION['cliente']->endereco		.	', '	.
																					$_SESSION['cliente']->numero		.	'. '	.
																					$_SESSION['cliente']->complemento
																			; 
																		?><br>
											<strong>Bairro:</strong>	<?php echo $_SESSION['cliente']->bairro; ?><br>
											<strong>Cidade:</strong>	<?php 
																			echo	$_SESSION['cliente']->email		.	' - '	.
																					$_SESSION['cliente']->estado
																			; 
																		?><br>
											<strong>CEP:</strong>		<?php echo $_SESSION['cliente']->cep; ?>
										</p>
										
										<hr>
										
										<p>
											<strong>Or�amento</strong>
										</p>
										
										<table>
											<tr>
												<td>	Referencia		</td>
												<td>	Cor				</td>
												<td>	Quantidade PP	</td>
												<td>	Quantidade P	</td>
												<td>	Quantidade M	</td>
												<td>	Quantidade G	</td>
												<td>	Quantidade GG	</td>
												<td>	Quantidade 48	</td>
												<td>	Quantidade 50	</td>
												<td>	Quantidade 52	</td>
												<td>	Quantidade 54	</td>
											</tr>
											<?php
												foreach($this->getCollectionProdutos() as $produto)
													echo
														"
															<td>	$produto[11]					</td>
															<td>	$produto[12]					</td>
															<td>	$produto[2]						</td>
															<td>	<strong>$produto[3]</strong>	</td>
															<td>	<strong>$produto[4]</strong>	</td>
															<td>	<strong>$produto[5]</strong>	</td>
															<td>	<strong>$produto[6]</strong>	</td>
															<td>	$produto[7]						</td>
															<td>	$produto[8]						</td>
															<td>	$produto[9]						</td>
															<td>	$produto[10]					</td>	
														";
											?>
										</table>
										
										<hr>
										
										<p>
											A Doce & Bacana Lingerie agradece a preferencia. Logo um de nossos representantes entrara em contato com os
											valores do or�amento.
										</p>
									<?php
        }
        
        /*
         *  M�todo configuraEmail
         *  Configura parametros da classe PHPMailer
         */
        private function configuraEmail()
        {
            // verifica se existe arquivo de configuração para este banco de dados
            if (file_exists("../app.config/mailOrcamento.ini"))
            {
                // lê o INI e retorna um array
                $configMail = parse_ini_file("../app.config/mailOrcamento.ini");
            }
            else
            {
                // se não existir, lança um erro
                throw new Exception("Arquivo mailOrcamento.ini não encontrado");
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
            $this->mail->AddAddress($_SESSION['cliente']->email);				                                    //E-mail destinatario
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
        private function send()
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
                            history.back(1);
                        </script>
                    ";
            }
            else
            {
                echo "
                        <script type='text/javascript'> 
                            alert(  'Mensagem não enviada');
                            history.back(1)
                        </script>
                    ";
            }

        }
		
		/*
         *  M�todo send2
         *  Envia o email pela fun��o mail
         */
        private function send2()
        {
            if	(
					mail($this->deEmail,				$this->assunto,		$this->corpoMensagem,	$this->headers,		'-r'.$_SESSION['cliente']->email) &&
					mail($_SESSION['cliente']->email,	$this->assunto,		$this->corpoMensagem,	$this->headers,		'-r'.$this->deEmail)
				)
                return true;
            else
                return false;
        }
    }
    
    new enviaEmail;
?>