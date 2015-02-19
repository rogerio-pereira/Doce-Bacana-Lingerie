<?php

    /*
     *  Classe Contato
     *  Formulario de Contato
     */
    class contato
    {
        /*
         *  Método construtor
         *  Inicia a classe e exibe o formulario
         */
        //public function __construct($codigo)
        public function __construct()
        {
        
        }
        
        /*
         *  Método show
         *  Exibe a pagina
         */
        public function show()
        {
            ?>
				<!--<h1>Contato</h1>
				<hr>-->
                <div class='contatoContent'>
                    <form class="formulario" name="contato" method="post" action="app.control/enviaEmail.class.php" onsubmit="return validaCamposContato();">
                        <table class="contatoTable">
                            <!--Nome-->
                            <tr>
                                <td style="width: 30%">
                                    <label for='txtNome' class='titulo obrigatorio'>Nome:</label>
                                </td>
                                <td style="width: 70%">
                                    <input name="txtNome" type="text" class="campo" id='txtNome' width="150px" placeholder='Nome'/>
                                </td>
                            </tr>
                            <!--Email-->
                            <tr>
                                <td style="width: 30%">
                                    <label for='txtEmail' class='titulo obrigatorio'>E-mail</label>
                                </td>
                                <td style="width: 70%">
                                    <input name="txtEmail" type="text" class="campo" id='txtEmail' placeholder='E-mail'/>
                                </td>
                            </tr>
                            <!--Telefone-->
                            <tr>
                                <td style="width: 30%">
                                    <label for='txtTelefone' class='titulo obrigatorio'>Telefone</label>
                                </td>
                                <td style="width: 70%">
                                    <input name="txtTelefone" class='campoTelefone campo' type="text" id="txtTelefone" placeholder='Telefone'/>
                                </td>
                            </tr>
							<!--Telefone-->
                            <tr>
                                <td style="width: 30%">
                                    <label for='txtOperadora' class='titulo'>Operadora</label>
                                </td>
                                <td style="width: 70%">
                                    <input name="txtOperadora" class='campo' type="text" id="txtOperadora" placeholder='Operadora'/>
                                </td>
                            </tr>
                            <!--Cidade-->
                            <tr>
                                <td style="width: 30%">
                                    <label for='txtCidade' class='titulo obrigatorio'>Cidade</label>
                                </td>
                                <td style="width: 70%">
                                    <input name="txtCidade" type="text" class="campo" id="txtCidade" placeholder='Cidade'/>
                                </td>
                            </tr>
                            <!--Assunto-->
                            <tr>
                                <td style="width: 30%">
                                    <label for='txtAssunto' class='titulo obrigatorio'>Assunto</label>
                                </td>
                                <td style="width: 70%">
                                    <input name="txtAssunto" type="text" class="campo" id="txtAssunto" placeholder='Assunto'/>
                                </td>
                            </tr>
                            <!--Label Mensagem-->
                            <tr>
                                <td colspan="2" style="width: 100%">
                                    <label for='txtMensagem' class='titulo obrigatorio'>Mensagem</label>
                                </td>
                            </tr>
                            <!--Mensagem-->
                            <tr>
                                <td colspan="2" style="width: 100%">
                                    <textarea name="txtMensagem" class="campo" style="height: 100px; width: 98%;" id="txtMensagem" placeholder='Mensagem'></textarea>
                                </td>
                            </tr>
                            <!--Botões-->
                            <tr>
                                <td colspan=2 align=center style="width: 100%">
                                    <input name="botaoEnviar" type="submit" id="botaoEnviar" value="Enviar" />
                                    <input name="botaoLimpar" type="reset" id="botaoLimpar" value="Limpar" />
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
                <script>
                    adicionaMascaraTelefone();
                </script>
            <?php
        }
    }
?>