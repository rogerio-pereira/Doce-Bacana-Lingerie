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
		
		private $headers;
		private $corpoMensagem;
		
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
			
            $this->configuraEmail();
            $this->constroiEmail();
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
			$nome = self::DE;
            $this->headers = "MIME-Version: 1.1\n";
            $this->headers .= "Content-type: text/plain; charset=iso-8859-1\n";		// ou UTF-8, como queira
            $this->headers .= "From: {$nome} <{$this->deEmail}}>\n";		       // remetente
            /*$this->headers .= "Return-Path: $this->de\n";							// return-path
            $this->headers .= "Reply-To: $this->de\n";								// Endere�o (devidamente validado) que o seu usu�rio informou no contato*/
            
            $this->corpoMensagem =  "
										<p>
											Nova solicita��o de or�amento com c�digo <strong>{$this->getCodigoOrcamento()}</strong>
										</p>
										
										<hr>
										
										<p>
											<strong>Dados do Cliente</strong>
										</p>
										
										<p>
											<strong>Nome:</strong>		{$_SESSION['cliente']->nome}<br>
											<strong>Telefone:</strong>	{$_SESSION['cliente']->telefone}<br>
											<strong>Celular:</strong>	{$_SESSION['cliente']->celular}<br>
											<strong>E-Mail:</strong>	{$_SESSION['cliente']->email}<br>
											<strong>Endere�o:</strong>	{$_SESSION['cliente']->endereco} , 
																		{$_SESSION['cliente']->numero}. 
																		{$_SESSION['cliente']->complemento}<br>
											<strong>Bairro:</strong>	{$_SESSION['cliente']->bairro}<br>
											<strong>Cidade:</strong>	{$_SESSION['cliente']->cidade} - 
																		{$_SESSION['cliente']->estado}<br>
											<strong>CEP:</strong>		{$_SESSION['cliente']->cep}
										</p>
										
										<hr>
										
										<p>
											<strong>Or�amento</strong>
										</p>
										
										<table>
											<tr>
												<td style='padding: 0 10px 0 0px;'>		<strong>Referencia</strong>		</td>
												<td style='padding: 0 10px 0 0px'>		<strong>Cor</strong>			</td>
												<td style='padding: 0 10px 0 10px'>		<strong>PP</strong>				</td>
												<td style='padding: 0 10px 0 10px'>		<strong>P</strong>				</td>
												<td style='padding: 0 10px 0 10px'>		<strong>M</strong>				</td>
												<td style='padding: 0 10px 0 10px'>		<strong>G</strong>				</td>
												<td style='padding: 0 10px 0 10px'>		<strong>GG</strong>				</td>
												<td style='padding: 0 10px 0 10px'>		<strong>48</strong>				</td>
												<td style='padding: 0 10px 0 10px'>		<strong>50</strong>				</td>
												<td style='padding: 0 10px 0 10px'>		<strong>52</strong>				</td>
												<td style='padding: 0 10px 0 10px'>		<strong>54</strong>				</td>
											</tr>
									";
										
			foreach($this->getCollectionProdutos() as $produto)
				$this->corpoMensagem .=
										"
											<tr>
												<td>					$produto[11]					</td>
												<td>					$produto[12]					</td>
												<td align='center'>		$produto[2]						</td>
												<td align='center'>		<strong>$produto[3]</strong>	</td>
												<td align='center'>		<strong>$produto[4]</strong>	</td>
												<td align='center'>		<strong>$produto[5]</strong>	</td>
												<td align='center'>		<strong>$produto[6]</strong>	</td>
												<td align='center'>		$produto[7]						</td>
												<td align='center'>		$produto[8]						</td>
												<td align='center'>		$produto[9]						</td>
												<td align='center'>		$produto[10]					</td>	
											<tr>
										";
			
			$this->corpoMensagem .=
									"
										</table>
										
										<hr>
										
										<p>
											A <strong>Doce & Bacana Lingerie</strong> agradece a preferencia. <br>
											Logo um de nossos representantes entrar� em contato com os valores do or�amento.
										</p>
									";
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
					mail($this->getDeEmail(),			self::ASSUNTO,		$this->corpoMensagem,	$this->headers,		'-r'.$_SESSION['cliente']->email) &&
					mail($_SESSION['cliente']->email,	self::ASSUNTO,		$this->corpoMensagem,	$this->headers,		'-r'.$this->getDeEmail())
				)
                return true;
            else
                return false;
        }
    }
?>