-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 02-Fev-2015 às 13:29
-- Versão do servidor: 5.6.12-log
-- versão do PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `docebacana`
--
CREATE DATABASE IF NOT EXISTS `docebacana` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `docebacana`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE IF NOT EXISTS `categorias` (
  `codigo` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(20) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`codigo`, `nome`) VALUES
(1, 'Conjuntos'),
(2, 'Calcinhas'),
(3, 'Lançamentos');

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `codigo` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pessoa` tinyint(1) NOT NULL COMMENT '1 - Pessoa Fisica; 0 - Pessoa Juridica',
  `nome` varchar(100) NOT NULL,
  `nomeResponsavel` varchar(100) DEFAULT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `cnpj` varchar(18) DEFAULT NULL,
  `informacaoTributaria` int(3) unsigned zerofill DEFAULT NULL COMMENT '0 - Contribuinte ICMS; 1 - Não Contribuinte; 2 - Isento',
  `inscricaoEstadual` varchar(20) DEFAULT NULL,
  `nascimento` date DEFAULT NULL,
  `sexo` tinyint(1) DEFAULT NULL COMMENT '1 - Masculino; 0 - Feminino',
  `telefone` varchar(17) DEFAULT NULL,
  `celular` varchar(17) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `ofertaEmail` tinyint(1) NOT NULL,
  `ofertaCelular` tinyint(1) NOT NULL,
  `cep` varchar(9) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `numero` int(11) NOT NULL,
  `complemento` varchar(30) DEFAULT NULL,
  `bairro` varchar(30) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `estado` varchar(2) NOT NULL,
  `pontoReferencia` varchar(500) DEFAULT NULL,
  `chave` varchar(32) NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `chave` (`chave`),
  UNIQUE KEY `cpf` (`cpf`,`cnpj`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`codigo`, `pessoa`, `nome`, `nomeResponsavel`, `cpf`, `cnpj`, `informacaoTributaria`, `inscricaoEstadual`, `nascimento`, `sexo`, `telefone`, `celular`, `email`, `senha`, `ofertaEmail`, `ofertaCelular`, `cep`, `endereco`, `numero`, `complemento`, `bairro`, `cidade`, `estado`, `pontoReferencia`, `chave`, `ativo`) VALUES
(12, 1, 'Rogério', NULL, '101.042.346-01', NULL, NULL, NULL, '1991-03-01', 1, NULL, NULL, 'rogerio@rogerio.com', 'c4ca4238a0b923820dcc509a6f75849b', 1, 1, '37701-223', 'Rua', 45, NULL, 'Jardim Bela Vista', 'Poços de Caldas', 'MG', NULL, '8c0f45f4ad8126311b4f9869728cf0af', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE IF NOT EXISTS `produtos` (
  `codigo` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `referencia` varchar(20) NOT NULL,
  `categoria` bigint(20) unsigned NOT NULL,
  `descricao` varchar(150) NOT NULL,
  `caracteristicas` longtext NOT NULL,
  `tamanhoPP` tinyint(1) DEFAULT NULL,
  `tamanhoP` tinyint(1) DEFAULT NULL,
  `tamanhoM` tinyint(1) DEFAULT NULL,
  `tamanhoG` tinyint(1) DEFAULT NULL,
  `tamanhoGG` tinyint(1) DEFAULT NULL,
  `tamanho48` tinyint(1) DEFAULT NULL,
  `tamanho50` tinyint(1) DEFAULT NULL,
  `tamanho52` tinyint(1) DEFAULT NULL,
  `tamanho54` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `referencia` (`referencia`),
  KEY `categoria` (`categoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`codigo`, `referencia`, `categoria`, `descricao`, `caracteristicas`, `tamanhoPP`, `tamanhoP`, `tamanhoM`, `tamanhoG`, `tamanhoGG`, `tamanho48`, `tamanho50`, `tamanho52`, `tamanho54`) VALUES
(30, 'Ref01', 1, 'Calcinha e Soutien Com Pingente e Renda', '<p><strong>SOUTIEN</strong></p>\r\n<p>Material utilizado - microfibra e renda com m&iacute;nimo de 85% de poliamida, bojo, vi&eacute;s m&eacute;xico, vi&eacute;s aro, fita cetenco, aro,linha e fio de helanca.&nbsp;</p>\r\n<p><span style="text-decoration: underline;">Bojos</span> - encapados com microfibra possuindo detalhes de pregas</p>\r\n<p><span style="text-decoration: underline;">Base</span> - n&atilde;o tem&nbsp;</p>\r\n<p><span style="text-decoration: underline;">Laterais</span> - microfibra com detalhe de renda</p>\r\n<p><span style="text-decoration: underline;">Costas</span> - normal</p>\r\n<p><span style="text-decoration: underline;">Fecho</span> - duplo 3cm</p>\r\n<p><span style="text-decoration: underline;">Al&ccedil;as</span> - com regulador de metal&nbsp;</p>\r\n<p>La&ccedil;o com pingente em banho steel</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><strong>CALCINHA&nbsp;</strong></p>\r\n<p><span style="text-decoration: underline;">Material utilizado</span> - microfibra e renda com no m&iacute;nimo de 85% de poliamida,malha 100% algod&atilde;o,vies m&eacute;xico, linha e fio de helanca.</p>\r\n<p><span style="text-decoration: underline;">Frente</span> - microfibra&nbsp;</p>\r\n<p><span style="text-decoration: underline;">Laterais</span> - renda&nbsp;</p>\r\n<p><span style="text-decoration: underline;">Costas</span> - microfibra&nbsp;</p>\r\n<p>La&ccedil;o na frente</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><strong>ITENS INCLUSOS</strong></p>\r\n<p>N&atilde;o acompanha acess&oacute;rios, colares e brincos.</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><strong>PRAZO DE ENTREGA</strong></p>\r\n<p>Envio em at&eacute; 2 dias &uacute;teis ap&oacute;s confirma&ccedil;&atilde;o do pagamento.</p>\r\n<p>Entrega em at&eacute; 15 dias dependendo da forma de envio e do local de entrega.&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><strong>GARANTIA</strong></p>\r\n<p>90 dias ap&oacute;s o recebimento contra defeitos de fabrica&ccedil;&atilde;o.</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><strong>EMBALAGEM</strong></p>\r\n<p>Caixa personalizada.</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><strong>OBSERVA&Ccedil;&Otilde;ES</strong></p>\r\n<p>Pode haver alguma pequena varia&ccedil;&atilde;o na cor real dos produtos devido ao tipo de monitor utilizado.</p>', NULL, 1, 1, 1, 1, NULL, NULL, NULL, NULL),
(31, 'Ref02', 1, 'Calcinha e Soutien com Renda', '<p><strong>SOUTIEN</strong></p>\r\n<p><span style="text-decoration: underline;">Material utilizado</span> - microfibra e renda com m&iacute;nimo de 85% de poliamida, bojo, vi&eacute;s m&eacute;xico, vi&eacute;s aro, fita cetenco, aro,linha e fio de helanca.&nbsp;</p>\r\n<p><span style="text-decoration: underline;">Bojos</span> - encapados com microfibra possuindo detalhes de pregas</p>\r\n<p><span style="text-decoration: underline;">Base</span> - n&atilde;o tem&nbsp;</p>\r\n<p><span style="text-decoration: underline;">Laterais</span> - microfibra com detalhe de renda</p>\r\n<p><span style="text-decoration: underline;">Costas</span> - normal</p>\r\n<p><span style="text-decoration: underline;">Fecho</span> - duplo 3cm</p>\r\n<p><span style="text-decoration: underline;">Al&ccedil;as</span> - com regulador de metal&nbsp;</p>\r\n<p>La&ccedil;o com pingente em banho steel</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><strong>CALCINHA&nbsp;</strong></p>\r\n<p><span style="text-decoration: underline;">Material utilizado</span> - microfibra e renda com no m&iacute;nimo de 85% de poliamida,malha 100% algod&atilde;o,vies m&eacute;xico, linha e fio de helanca.</p>\r\n<p><span style="text-decoration: underline;">Frente</span> - microfibra&nbsp;</p>\r\n<p><span style="text-decoration: underline;">Laterais</span> - renda&nbsp;</p>\r\n<p><span style="text-decoration: underline;">Costas</span> - microfibra&nbsp;</p>\r\n<p>La&ccedil;o na frente</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><strong>ITENS INCLUSOS</strong></p>\r\n<p>N&atilde;o acompanha acess&oacute;rios, colares e brincos.</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><strong>PRAZO DE ENTREGA</strong></p>\r\n<p>Envio em at&eacute; 2 dias &uacute;teis ap&oacute;s confirma&ccedil;&atilde;o do pagamento.</p>\r\n<p>Entrega em at&eacute; 15 dias dependendo da forma de envio e do local de entrega.&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><strong>GARANTIA</strong></p>\r\n<p>90 dias ap&oacute;s o recebimento contra defeitos de fabrica&ccedil;&atilde;o.</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><strong>EMBALAGEM</strong></p>\r\n<p>Caixa personalizada.</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><strong>OBSERVA&Ccedil;&Otilde;ES</strong></p>\r\n<p>Pode haver alguma pequena varia&ccedil;&atilde;o na cor real dos produtos devido ao tipo de monitor utilizado.</p>', NULL, 1, 1, 1, 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtoscores`
--

CREATE TABLE IF NOT EXISTS `produtoscores` (
  `codigo` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `codigoProduto` bigint(20) unsigned NOT NULL,
  `nome` varchar(20) NOT NULL,
  `cor1` varchar(7) NOT NULL,
  `cor2` varchar(7) NOT NULL,
  `banner1` tinyint(1) DEFAULT NULL,
  `banner2` tinyint(1) DEFAULT NULL,
  `banner3` tinyint(1) DEFAULT NULL,
  `home` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`codigo`),
  KEY `codigoProduto` (`codigoProduto`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Extraindo dados da tabela `produtoscores`
--

INSERT INTO `produtoscores` (`codigo`, `codigoProduto`, `nome`, `cor1`, `cor2`, `banner1`, `banner2`, `banner3`, `home`) VALUES
(19, 30, 'Rubi', '#ca252b', '#ca252b', 1, NULL, NULL, 1),
(20, 30, 'Bic', '#0127a4', '#0127a4', NULL, 1, NULL, NULL),
(21, 30, 'Branco', '#ffffff', '#ffffff', NULL, NULL, 1, NULL),
(22, 31, 'Suzy', '#0da5f9', '#0da5f9', 1, NULL, NULL, 1),
(23, 31, 'Rubi', '#cb0f10', '#cb0f10', NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `codigo` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `usuario` varchar(15) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `telaCategoria` tinyint(1) NOT NULL,
  `telaOrcamento` tinyint(1) NOT NULL,
  `telaProduto` tinyint(1) NOT NULL,
  `telaUsuario` tinyint(1) NOT NULL,
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`codigo`, `nome`, `usuario`, `senha`, `telaCategoria`, `telaOrcamento`, `telaProduto`, `telaUsuario`) VALUES
(1, 'Administrador', 'docebac_admin', '60517bfbcd49ce758a56feb0d9299494', 1, 1, 1, 1),
(18, 'Rogerio Eduardo Pereira', 'rodu_pereira', '673026bc5f6bf0bdcf136c961e0b3a09', 1, 1, 1, 1);

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `produto_categoria` FOREIGN KEY (`categoria`) REFERENCES `categorias` (`codigo`) ON UPDATE CASCADE;

--
-- Limitadores para a tabela `produtoscores`
--
ALTER TABLE `produtoscores`
  ADD CONSTRAINT `produtos_cor` FOREIGN KEY (`codigoProduto`) REFERENCES `produtos` (`codigo`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
