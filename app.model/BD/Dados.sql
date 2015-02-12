-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 12-Fev-2015 às 19:07
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`codigo`, `pessoa`, `nome`, `nomeResponsavel`, `cpf`, `cnpj`, `informacaoTributaria`, `inscricaoEstadual`, `nascimento`, `sexo`, `telefone`, `celular`, `email`, `senha`, `ofertaEmail`, `ofertaCelular`, `cep`, `endereco`, `numero`, `complemento`, `bairro`, `cidade`, `estado`, `pontoReferencia`, `chave`, `ativo`) VALUES
(13, 1, 'Rogério Eduardo Pereira', NULL, '101.042.346-01', NULL, NULL, NULL, '1991-03-01', 1, '(35) 9109 - 0906', '(35) 9109 - 0906', 'rogerio@rogerio.com', '673026bc5f6bf0bdcf136c961e0b3a09', 0, 0, '37701-223', 'Rua Major Luis Loiola', 45, NULL, 'Jardim Bela Vista', 'Poços de Caldas', 'MG', NULL, '8c0f45f4ad8126311b4f9869728cf0af', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cores`
--

CREATE TABLE IF NOT EXISTS `cores` (
  `codigo` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(20) NOT NULL,
  `cor1` varchar(7) NOT NULL,
  `cor2` varchar(7) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Extraindo dados da tabela `cores`
--

INSERT INTO `cores` (`codigo`, `nome`, `cor1`, `cor2`) VALUES
(1, 'Preto', '#000000', '#000000'),
(2, 'Branco', '#ffffff', '#ffffff'),
(3, 'Chocolate', '#c48888', '#c48888'),
(4, 'Rubi', '#c80a14', '#c80a14'),
(5, 'Suzy', '#00c8e6', '#ffffff'),
(6, 'Branco', '#ffffff', '#00c8e6'),
(7, 'Estampado Rubi', '#ffffff', '#c80a14'),
(8, 'Estampado Preto', '#ffffff', '#000000'),
(9, 'Estampado Rosa', '#ffffff', '#d2a0b4'),
(10, 'Estampado Suzy', '#ffffff', '#00c8e6'),
(11, 'Rosa Bebe', '#d2a0b4', '#d2a0b4'),
(12, 'Suzy', '#00c8e6', '#00c8e6'),
(13, 'Bic', '#4132c8', '#4132c8'),
(14, 'Camaro', '#fae10f', '#fae10f'),
(15, 'Onça', '#000000', '#ffff80'),
(16, 'Chocolate', '#e6c391', '#e6c391'),
(17, 'Preto com Bic', '#000000', '#4132c8'),
(18, 'Zebra', '#000000', '#ffffff'),
(19, 'Mamona Assassina', '#00ff00', '#ff0000');

-- --------------------------------------------------------

--
-- Estrutura da tabela `orcamento`
--

CREATE TABLE IF NOT EXISTS `orcamento` (
  `codigo` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cliente` bigint(20) unsigned NOT NULL,
  `dataHora` datetime NOT NULL,
  `codigoCorreio` varchar(30) DEFAULT NULL,
  `status` int(11) NOT NULL COMMENT '0 - Aberto; 1 - Fazendo Orçamento; 2 - Aguardando Cliente; 3 - Aguardando Pagamento; 4 - Postado no Correio; 5 - Entregue',
  PRIMARY KEY (`codigo`),
  KEY `cliente` (`cliente`),
  FULLTEXT KEY `codigoCorreio` (`codigoCorreio`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Extraindo dados da tabela `orcamento`
--

INSERT INTO `orcamento` (`codigo`, `cliente`, `dataHora`, `codigoCorreio`, `status`) VALUES
(39, 13, '2015-02-12 15:15:00', NULL, 0),
(40, 13, '2015-02-12 15:15:00', NULL, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `orcamentoproduto`
--

CREATE TABLE IF NOT EXISTS `orcamentoproduto` (
  `codigo` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `codigoOrcamento` bigint(20) unsigned NOT NULL,
  `codigoProduto` bigint(20) unsigned NOT NULL,
  `quantidadePP` int(11) DEFAULT NULL,
  `quantidadeP` int(11) DEFAULT NULL,
  `quantidadeM` int(11) DEFAULT NULL,
  `quantidadeG` int(11) DEFAULT NULL,
  `quantidadeGG` int(11) DEFAULT NULL,
  `quantidade48` int(11) DEFAULT NULL,
  `quantidade50` int(11) DEFAULT NULL,
  `quantidade52` int(11) DEFAULT NULL,
  `quantidade54` int(11) DEFAULT NULL,
  `referencia` varchar(20) NOT NULL,
  `nome` varchar(20) NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `codigoOrcamento` (`codigoOrcamento`,`codigoProduto`),
  KEY `codigoProduto` (`codigoProduto`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=162 ;

--
-- Extraindo dados da tabela `orcamentoproduto`
--

INSERT INTO `orcamentoproduto` (`codigo`, `codigoOrcamento`, `codigoProduto`, `quantidadePP`, `quantidadeP`, `quantidadeM`, `quantidadeG`, `quantidadeGG`, `quantidade48`, `quantidade50`, `quantidade52`, `quantidade54`, `referencia`, `nome`) VALUES
(150, 39, 61, 0, 1, 2, 3, 4, 0, 0, 0, 0, 'Ref1100', 'Branco'),
(151, 39, 62, 0, 5, 6, 7, 8, 0, 0, 0, 0, 'Ref1100', 'Chocolate'),
(152, 39, 60, 0, 9, 10, 11, 12, 0, 0, 0, 0, 'Ref1100', 'Preto'),
(153, 39, 55, 0, 13, 14, 15, 16, 0, 0, 0, 0, 'Ref1105', 'Branco'),
(154, 39, 56, 0, 17, 18, 19, 20, 0, 0, 0, 0, 'Ref1105', 'Chocolate'),
(155, 39, 54, 0, 21, 22, 23, 24, 0, 0, 0, 0, 'Ref1105', 'Preto'),
(156, 40, 61, 0, 1, 2, 3, 4, 0, 0, 0, 0, 'Ref1100', 'Branco'),
(157, 40, 62, 0, 5, 6, 7, 8, 0, 0, 0, 0, 'Ref1100', 'Chocolate'),
(158, 40, 60, 0, 9, 10, 11, 12, 0, 0, 0, 0, 'Ref1100', 'Preto'),
(159, 40, 55, 0, 13, 14, 15, 16, 0, 0, 0, 0, 'Ref1105', 'Branco'),
(160, 40, 56, 0, 17, 18, 19, 20, 0, 0, 0, 0, 'Ref1105', 'Chocolate'),
(161, 40, 54, 0, 21, 22, 23, 24, 0, 0, 0, 0, 'Ref1105', 'Preto');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`codigo`, `referencia`, `categoria`, `descricao`, `caracteristicas`, `tamanhoPP`, `tamanhoP`, `tamanhoM`, `tamanhoG`, `tamanhoGG`, `tamanho48`, `tamanho50`, `tamanho52`, `tamanho54`) VALUES
(9, 'Ref1100', 1, 'Conjunto bojo liso com base de espuma calcinha conforto lisa', '<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">PRAZO DE ENTREGA</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">Envio em at&eacute; 2 dias &uacute;teis ap&oacute;s confirma&ccedil;&atilde;o do pagamento.</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">Entrega em at&eacute; 15 dias dependendo da forma de envio e do local de entrega.&nbsp;</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">GARANTIA</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">90 dias ap&oacute;s o recebimento contra defeitos de fabrica&ccedil;&atilde;o.</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">EMBALAGEM</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">Caixa personalizada.</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">OBSERVA&Ccedil;&Otilde;ES</span>&nbsp;</p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">Pode haver alguma pequena varia&ccedil;&atilde;o na cor real dos produtos devido ao tipo de monitor utilizado</span></p>', NULL, 1, 1, 1, 1, NULL, NULL, NULL, NULL),
(10, 'Ref1105', 1, 'Conjunto bojo liso calcinha conforto lisa ', '<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">PRAZO DE ENTREGA</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">Envio em at&eacute; 2 dias &uacute;teis ap&oacute;s confirma&ccedil;&atilde;o do pagamento.</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">Entrega em at&eacute; 15 dias dependendo da forma de envio e do local de entrega.&nbsp;</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">GARANTIA</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">90 dias ap&oacute;s o recebimento contra defeitos de fabrica&ccedil;&atilde;o.</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">EMBALAGEM</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">Caixa personalizada.</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">OBSERVA&Ccedil;&Otilde;ES</span>&nbsp;</p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">Pode haver alguma pequena varia&ccedil;&atilde;o na cor real dos produtos devido ao tipo de monitor utilizado</span></p>', NULL, 1, 1, 1, 1, NULL, NULL, NULL, NULL),
(11, 'Ref1107', 1, 'Conjunto bojo com detalhe franzido calcinha conforto com pala alta na cintura', '<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">PRAZO DE ENTREGA</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">Envio em at&eacute; 2 dias &uacute;teis ap&oacute;s confirma&ccedil;&atilde;o do pagamento.</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">Entrega em at&eacute; 15 dias dependendo da forma de envio e do local de entrega.&nbsp;</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">GARANTIA</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">90 dias ap&oacute;s o recebimento contra defeitos de fabrica&ccedil;&atilde;o.</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">EMBALAGEM</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">Caixa personalizada.</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">OBSERVA&Ccedil;&Otilde;ES</span>&nbsp;</p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">Pode haver alguma pequena varia&ccedil;&atilde;o na cor real dos produtos devido ao tipo de monitor utilizado</span></p>', NULL, 1, 1, 1, 1, NULL, NULL, NULL, NULL),
(12, 'Ref1113', 3, 'Conjunto nadador com detalhe renda no bojo calcinha conforto com detalhe de renda na cintura', '<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">PRAZO DE ENTREGA</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">Envio em at&eacute; 2 dias &uacute;teis ap&oacute;s confirma&ccedil;&atilde;o do pagamento.</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">Entrega em at&eacute; 15 dias dependendo da forma de envio e do local de entrega.&nbsp;</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">GARANTIA</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">90 dias ap&oacute;s o recebimento contra defeitos de fabrica&ccedil;&atilde;o.</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">EMBALAGEM</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">Caixa personalizada.</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">OBSERVA&Ccedil;&Otilde;ES</span>&nbsp;</p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">Pode haver alguma pequena varia&ccedil;&atilde;o na cor real dos produtos devido ao tipo de monitor utilizado</span></p>', NULL, 1, 1, 1, 1, NULL, NULL, NULL, NULL),
(13, 'Ref1007', 2, 'Calcinha conforto lateral dupla com detalhe franzido ', '<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">PRAZO DE ENTREGA</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">Envio em at&eacute; 2 dias &uacute;teis ap&oacute;s confirma&ccedil;&atilde;o do pagamento.</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">Entrega em at&eacute; 15 dias dependendo da forma de envio e do local de entrega.&nbsp;</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">GARANTIA</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">90 dias ap&oacute;s o recebimento contra defeitos de fabrica&ccedil;&atilde;o.</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">EMBALAGEM</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">Caixa personalizada.</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">OBSERVA&Ccedil;&Otilde;ES</span>&nbsp;</p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">Pode haver alguma pequena varia&ccedil;&atilde;o na cor real dos produtos devido ao tipo de monitor utilizado</span></p>', NULL, 1, 1, 1, 1, NULL, NULL, NULL, NULL),
(14, 'Ref1008', 3, 'Calcinha conforto sem elástico', '<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">PRAZO DE ENTREGA</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">Envio em at&eacute; 2 dias &uacute;teis ap&oacute;s confirma&ccedil;&atilde;o do pagamento.</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">Entrega em at&eacute; 15 dias dependendo da forma de envio e do local de entrega.&nbsp;</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">GARANTIA</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">90 dias ap&oacute;s o recebimento contra defeitos de fabrica&ccedil;&atilde;o.</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">EMBALAGEM</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">Caixa personalizada.</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">OBSERVA&Ccedil;&Otilde;ES</span>&nbsp;</p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">Pode haver alguma pequena varia&ccedil;&atilde;o na cor real dos produtos devido ao tipo de monitor utilizado</span></p>', NULL, 1, 1, 1, 1, NULL, NULL, NULL, NULL),
(15, 'Ref1010', 2, 'Calcinha conforto lisa ', '<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">PRAZO DE ENTREGA</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">Envio em at&eacute; 2 dias &uacute;teis ap&oacute;s confirma&ccedil;&atilde;o do pagamento.</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">Entrega em at&eacute; 15 dias dependendo da forma de envio e do local de entrega.&nbsp;</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">GARANTIA</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">90 dias ap&oacute;s o recebimento contra defeitos de fabrica&ccedil;&atilde;o.</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">EMBALAGEM</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">Caixa personalizada.</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">OBSERVA&Ccedil;&Otilde;ES</span>&nbsp;</p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">Pode haver alguma pequena varia&ccedil;&atilde;o na cor real dos produtos devido ao tipo de monitor utilizado</span></p>', NULL, 1, 1, 1, 1, NULL, NULL, NULL, NULL),
(16, 'Ref2102', 1, 'Conjunto bojo de rendão calcinha com detalhe rendão na frente', '<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">PRAZO DE ENTREGA</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">Envio em at&eacute; 2 dias &uacute;teis ap&oacute;s confirma&ccedil;&atilde;o do pagamento.</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">Entrega em at&eacute; 15 dias dependendo da forma de envio e do local de entrega.&nbsp;</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">GARANTIA</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">90 dias ap&oacute;s o recebimento contra defeitos de fabrica&ccedil;&atilde;o.</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">EMBALAGEM</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">Caixa personalizada.</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">OBSERVA&Ccedil;&Otilde;ES</span>&nbsp;</p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">Pode haver alguma pequena varia&ccedil;&atilde;o na cor real dos produtos devido ao tipo de monitor utilizado</span></p>', NULL, 1, 1, 1, 1, NULL, NULL, NULL, NULL),
(17, 'Ref2104', 1, 'Conjunto bojo com detalhe  franzido calcinha conforto lateral dupla com detalhe franzido e frente de renda', '<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">PRAZO DE ENTREGA</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">Envio em at&eacute; 2 dias &uacute;teis ap&oacute;s confirma&ccedil;&atilde;o do pagamento.</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">Entrega em at&eacute; 15 dias dependendo da forma de envio e do local de entrega.&nbsp;</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">GARANTIA</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">90 dias ap&oacute;s o recebimento contra defeitos de fabrica&ccedil;&atilde;o.</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">EMBALAGEM</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">Caixa personalizada.</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">OBSERVA&Ccedil;&Otilde;ES</span>&nbsp;</p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">Pode haver alguma pequena varia&ccedil;&atilde;o na cor real dos produtos devido ao tipo de monitor utilizado</span></p>', NULL, 1, 1, 1, 1, NULL, NULL, NULL, NULL),
(18, 'Ref2106', 1, 'Conjunto bojo de renda com detalhe franzido calcinha conforto com detalhe de renda na lateral', '<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">PRAZO DE ENTREGA</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">Envio em at&eacute; 2 dias &uacute;teis ap&oacute;s confirma&ccedil;&atilde;o do pagamento.</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">Entrega em at&eacute; 15 dias dependendo da forma de envio e do local de entrega.&nbsp;</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">GARANTIA</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">90 dias ap&oacute;s o recebimento contra defeitos de fabrica&ccedil;&atilde;o.</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">EMBALAGEM</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">Caixa personalizada.</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">OBSERVA&Ccedil;&Otilde;ES</span>&nbsp;</p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">Pode haver alguma pequena varia&ccedil;&atilde;o na cor real dos produtos devido ao tipo de monitor utilizado</span></p>', NULL, 1, 1, 1, 1, NULL, NULL, NULL, NULL),
(19, 'Ref2110', 3, 'Conjunto bojo com detalhe de pregas calcinha com renda nas pernas ', '<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">PRAZO DE ENTREGA</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">Envio em at&eacute; 2 dias &uacute;teis ap&oacute;s confirma&ccedil;&atilde;o do pagamento.</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">Entrega em at&eacute; 15 dias dependendo da forma de envio e do local de entrega.&nbsp;</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">GARANTIA</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">90 dias ap&oacute;s o recebimento contra defeitos de fabrica&ccedil;&atilde;o.</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">EMBALAGEM</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">Caixa personalizada.</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">OBSERVA&Ccedil;&Otilde;ES</span>&nbsp;</p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">Pode haver alguma pequena varia&ccedil;&atilde;o na cor real dos produtos devido ao tipo de monitor utilizado</span></p>', NULL, 1, 1, 1, 1, NULL, NULL, NULL, NULL),
(20, 'Ref3001', 2, 'Fio dental com regulagem (veste P/M/G)', '<p>PRAZO DE ENTREGA</p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">Envio em at&eacute; 2 dias &uacute;teis ap&oacute;s confirma&ccedil;&atilde;o do pagamento.</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">Entrega em at&eacute; 15 dias dependendo da forma de envio e do local de entrega.&nbsp;</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">GARANTIA</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">90 dias ap&oacute;s o recebimento contra defeitos de fabrica&ccedil;&atilde;o.</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">EMBALAGEM</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">Caixa personalizada.</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">OBSERVA&Ccedil;&Otilde;ES</span>&nbsp;</p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">Pode haver alguma pequena varia&ccedil;&atilde;o na cor real dos produtos devido ao tipo de monitor utilizado</span></p>', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 'Ref3002', 2, 'Fio dental frente de microfibra e costa de renda com regulagem (veste P/M/G)', '<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">PRAZO DE ENTREGA</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">Envio em at&eacute; 2 dias &uacute;teis ap&oacute;s confirma&ccedil;&atilde;o do pagamento.</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">Entrega em at&eacute; 15 dias dependendo da forma de envio e do local de entrega.&nbsp;</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">GARANTIA</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">90 dias ap&oacute;s o recebimento contra defeitos de fabrica&ccedil;&atilde;o.</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">EMBALAGEM</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">Caixa personalizada.</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">OBSERVA&Ccedil;&Otilde;ES</span>&nbsp;</p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">Pode haver alguma pequena varia&ccedil;&atilde;o na cor real dos produtos devido ao tipo de monitor utilizado</span></p>', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 'Ref3003', 2, 'Fio dental frente de renda costas de microfibra com regulagem (veste P/M/G)', '<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">PRAZO DE ENTREGA</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">Envio em at&eacute; 2 dias &uacute;teis ap&oacute;s confirma&ccedil;&atilde;o do pagamento.</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">Entrega em at&eacute; 15 dias dependendo da forma de envio e do local de entrega.&nbsp;</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">GARANTIA</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">90 dias ap&oacute;s o recebimento contra defeitos de fabrica&ccedil;&atilde;o.</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">EMBALAGEM</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">Caixa personalizada.</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">OBSERVA&Ccedil;&Otilde;ES</span>&nbsp;</p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">Pode haver alguma pequena varia&ccedil;&atilde;o na cor real dos produtos devido ao tipo de monitor utilizado</span></p>', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 'Ref3004', 2, 'Fio duplo frente de renda lateral dupla com detalhe franzido', '<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">PRAZO DE ENTREGA</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">Envio em at&eacute; 2 dias &uacute;teis ap&oacute;s confirma&ccedil;&atilde;o do pagamento.</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">Entrega em at&eacute; 15 dias dependendo da forma de envio e do local de entrega.&nbsp;</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">GARANTIA</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">90 dias ap&oacute;s o recebimento contra defeitos de fabrica&ccedil;&atilde;o.</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">EMBALAGEM</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">Caixa personalizada.</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">OBSERVA&Ccedil;&Otilde;ES</span>&nbsp;</p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">Pode haver alguma pequena varia&ccedil;&atilde;o na cor real dos produtos devido ao tipo de monitor utilizado</span></p>', NULL, 1, 1, 1, 1, NULL, NULL, NULL, NULL),
(24, 'Ref3006', 2, 'Fio duplo frente de  renda detalhe lateral', '<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">PRAZO DE ENTREGA</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">Envio em at&eacute; 2 dias &uacute;teis ap&oacute;s confirma&ccedil;&atilde;o do pagamento.</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">Entrega em at&eacute; 15 dias dependendo da forma de envio e do local de entrega.&nbsp;</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">GARANTIA</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">90 dias ap&oacute;s o recebimento contra defeitos de fabrica&ccedil;&atilde;o.</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">EMBALAGEM</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">Caixa personalizada.</span></p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">OBSERVA&Ccedil;&Otilde;ES</span>&nbsp;</p>\r\n<p><span style="font-size: 10pt; font-family: Arial, sans-serif;">Pode haver alguma pequena varia&ccedil;&atilde;o na cor real dos produtos devido ao tipo de monitor utilizado</span></p>', NULL, 1, 1, 1, 1, NULL, NULL, NULL, NULL),
(25, 'dsad', 3, 'dasd', '<p>dasdasd</p>', NULL, 1, 1, 1, 1, NULL, NULL, NULL, NULL),
(26, 'eqweq', 1, 'eqwd', '<p>dsad</p>', NULL, 1, 1, 1, 1, NULL, NULL, NULL, NULL),
(27, '231', 1, 'dsad', '<p>dasd</p>', NULL, 1, 1, 1, 1, NULL, NULL, NULL, NULL),
(28, 'ewqdasdsa', 1, 'dasda', '<p>dsadas</p>', NULL, 1, 1, 1, 1, NULL, NULL, NULL, NULL),
(29, 'dwqewe', 2, 'dasd', '<p>asd</p>', NULL, 1, 1, 1, 1, NULL, NULL, NULL, NULL),
(30, 'ewqeqwe', 2, 'dasds', '<p>dasdasd</p>', NULL, 1, 1, 1, 1, NULL, NULL, NULL, NULL),
(31, 'ewqe132', 2, 'dsad', '<p>dasd</p>', NULL, 1, 1, 1, 1, NULL, NULL, NULL, NULL),
(32, 'dsadadqwe123', 2, 'dasda', '<p>dasda</p>', NULL, 1, 1, 1, 1, NULL, NULL, NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=133 ;

--
-- Extraindo dados da tabela `produtoscores`
--

INSERT INTO `produtoscores` (`codigo`, `codigoProduto`, `nome`, `cor1`, `cor2`, `banner1`, `banner2`, `banner3`, `home`) VALUES
(54, 10, 'Preto', '#000000', '#000000', NULL, NULL, NULL, NULL),
(55, 10, 'Branco', '#ffffff', '#ffffff', 1, NULL, NULL, NULL),
(56, 10, 'Chocolate', '#c48888', '#c48888', NULL, NULL, NULL, 1),
(60, 9, 'Preto', '#000000', '#000000', NULL, NULL, NULL, NULL),
(61, 9, 'Branco', '#ffffff', '#ffffff', NULL, NULL, NULL, 1),
(62, 9, 'Chocolate', '#c48888', '#c48888', 1, NULL, NULL, NULL),
(63, 11, 'Preto', '#000000', '#000000', NULL, NULL, NULL, NULL),
(65, 11, 'Chocolate', '#c48888', '#c48888', NULL, NULL, NULL, 1),
(66, 11, 'Branco', '#ffffff', '#ffffff', NULL, NULL, NULL, NULL),
(67, 12, 'Rubi', '#c80a14', '#c80a14', NULL, NULL, NULL, NULL),
(69, 12, 'Suzy', '#00c8e6', '#ffffff', NULL, NULL, NULL, 1),
(70, 12, 'Preto', '#000000', '#000000', NULL, NULL, NULL, NULL),
(71, 12, 'Branco', '#ffffff', '#00c8e6', NULL, NULL, 1, NULL),
(72, 13, 'Preto', '#000000', '#000000', NULL, NULL, NULL, NULL),
(73, 13, 'Estampado Rubi', '#ffffff', '#c80a14', NULL, 1, NULL, 1),
(74, 14, 'Branco', '#ffffff', '#ffffff', NULL, NULL, NULL, NULL),
(75, 14, 'Estampado Preto', '#ffffff', '#000000', NULL, 1, NULL, NULL),
(76, 14, 'Estampado Rosa', '#ffffff', '#d2a0b4', NULL, NULL, NULL, NULL),
(77, 14, 'Estampado Rubi', '#ffffff', '#c80a14', NULL, NULL, NULL, NULL),
(78, 14, 'Estampado Suzy', '#ffffff', '#00c8e6', NULL, NULL, NULL, NULL),
(79, 14, 'Preto', '#000000', '#000000', NULL, NULL, NULL, NULL),
(80, 14, 'Rosa Bebe', '#d2a0b4', '#d2a0b4', NULL, NULL, NULL, NULL),
(81, 14, 'Rubi', '#c80a14', '#c80a14', NULL, NULL, NULL, 1),
(82, 14, 'Suzy', '#00c8e6', '#00c8e6', NULL, NULL, NULL, NULL),
(83, 15, 'Branco', '#ffffff', '#ffffff', NULL, NULL, NULL, NULL),
(84, 15, 'Estampado Rosa', '#ffffff', '#d2a0b4', NULL, 1, NULL, NULL),
(85, 15, 'Estampado Rubi', '#ffffff', '#c80a14', NULL, NULL, NULL, NULL),
(86, 15, 'Estampado Suzy', '#ffffff', '#00c8e6', NULL, NULL, NULL, 1),
(87, 15, 'Preto', '#000000', '#000000', NULL, NULL, NULL, NULL),
(88, 15, 'Rubi', '#c80a14', '#c80a14', NULL, NULL, NULL, NULL),
(89, 15, 'Suzy', '#00c8e6', '#00c8e6', NULL, NULL, NULL, NULL),
(90, 16, 'Bic', '#4132c8', '#4132c8', NULL, NULL, NULL, NULL),
(91, 16, 'Preto', '#000000', '#000000', NULL, NULL, NULL, NULL),
(92, 16, 'Rubi', '#c80a14', '#c80a14', 1, NULL, NULL, 1),
(93, 17, 'Branco', '#ffffff', '#ffffff', 1, NULL, NULL, 1),
(94, 17, 'Preto', '#000000', '#000000', NULL, NULL, NULL, NULL),
(95, 17, 'Bic', '#4132c8', '#4132c8', NULL, NULL, NULL, NULL),
(96, 18, 'Rubi', '#c80a14', '#c80a14', 1, NULL, NULL, 1),
(97, 18, 'Branco', '#ffffff', '#ffffff', NULL, NULL, NULL, NULL),
(98, 18, 'Bic', '#4132c8', '#4132c8', NULL, NULL, NULL, NULL),
(99, 19, 'Camaro', '#fae10f', '#fae10f', NULL, NULL, 1, NULL),
(100, 19, 'Suzy', '#00c8e6', '#00c8e6', NULL, NULL, NULL, 1),
(101, 19, 'Preto', '#000000', '#000000', NULL, NULL, NULL, NULL),
(102, 19, 'Branco', '#ffffff', '#ffffff', NULL, NULL, NULL, NULL),
(103, 19, 'Rubi', '#c80a14', '#c80a14', NULL, NULL, NULL, NULL),
(104, 20, 'Branco', '#ffffff', '#ffffff', NULL, NULL, NULL, NULL),
(105, 20, 'Onça', '#000000', '#ffff80', 1, NULL, NULL, 1),
(107, 20, 'Preto', '#000000', '#000000', NULL, NULL, NULL, NULL),
(108, 20, 'Rubi', '#c80a14', '#c80a14', NULL, NULL, NULL, NULL),
(109, 20, 'Chocolate', '#e6c391', '#e6c391', NULL, NULL, NULL, NULL),
(110, 21, 'Bic', '#4132c8', '#4132c8', NULL, 1, NULL, 1),
(111, 21, 'Branco', '#ffffff', '#ffffff', NULL, NULL, NULL, NULL),
(112, 21, 'Preto', '#000000', '#000000', NULL, NULL, NULL, NULL),
(113, 21, 'Rubi', '#c80a14', '#c80a14', NULL, NULL, NULL, NULL),
(114, 22, 'Bic', '#4132c8', '#4132c8', NULL, 1, NULL, NULL),
(115, 22, 'Branco', '#ffffff', '#ffffff', NULL, NULL, NULL, NULL),
(116, 22, 'Preto', '#000000', '#000000', NULL, NULL, NULL, NULL),
(117, 22, 'Preto com Bic', '#000000', '#4132c8', NULL, NULL, NULL, 1),
(118, 23, 'Onça', '#000000', '#ffff80', 1, NULL, NULL, 1),
(119, 23, 'Preto', '#000000', '#000000', NULL, NULL, NULL, NULL),
(120, 24, 'Preto', '#000000', '#000000', NULL, NULL, NULL, NULL),
(121, 24, 'Zebra', '#000000', '#ffffff', NULL, 1, NULL, 1),
(122, 25, 'Preto', '#000000', '#000000', NULL, NULL, NULL, NULL),
(123, 26, 'Preto', '#000000', '#000000', NULL, NULL, NULL, NULL),
(124, 27, 'Branco', '#ffffff', '#ffffff', NULL, NULL, NULL, NULL),
(125, 28, 'Preto', '#000000', '#000000', NULL, NULL, NULL, NULL),
(126, 29, 'Preto', '#000000', '#000000', NULL, NULL, NULL, NULL),
(127, 30, 'Mamona Assassina', '#00ff00', '#ff0000', NULL, NULL, NULL, NULL),
(128, 31, 'Mamona Assassina', '#00ff00', '#ff0000', NULL, NULL, NULL, NULL),
(129, 31, 'Mamona Assassina', '#00ff00', '#ff0000', NULL, NULL, NULL, NULL),
(130, 31, 'Chocolate', '#c48888', '#c48888', NULL, NULL, NULL, NULL),
(131, 32, 'Mamona Assassina', '#00ff00', '#ff0000', NULL, NULL, NULL, NULL),
(132, 32, 'Chocolate', '#c48888', '#c48888', NULL, NULL, NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`codigo`, `nome`, `usuario`, `senha`, `telaCategoria`, `telaOrcamento`, `telaProduto`, `telaUsuario`) VALUES
(20, 'Rogerio Eduardo Pereira', 'rodu_pereira', '673026bc5f6bf0bdcf136c961e0b3a09', 1, 1, 1, 1),
(21, 'Administrador', 'docebac_admin', '60517bfbcd49ce758a56feb0d9299494', 1, 1, 1, 1);

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `orcamento`
--
ALTER TABLE `orcamento`
  ADD CONSTRAINT `orcamento_cliente` FOREIGN KEY (`cliente`) REFERENCES `clientes` (`codigo`) ON UPDATE CASCADE;

--
-- Limitadores para a tabela `orcamentoproduto`
--
ALTER TABLE `orcamentoproduto`
  ADD CONSTRAINT `orcamento_produto_` FOREIGN KEY (`codigoProduto`) REFERENCES `produtoscores` (`codigo`) ON UPDATE CASCADE,
  ADD CONSTRAINT `produto_orcamento` FOREIGN KEY (`codigoOrcamento`) REFERENCES `orcamento` (`codigo`) ON UPDATE CASCADE;

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
