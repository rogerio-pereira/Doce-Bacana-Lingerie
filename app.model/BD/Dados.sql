-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 28-Jan-2015 às 12:38
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
  `descricao` varchar(100) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos_cores`
--

CREATE TABLE IF NOT EXISTS `produtos_cores` (
  `codigo` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `codigoProduto` bigint(20) unsigned NOT NULL,
  `cor1` varchar(7) NOT NULL,
  `cor2` varchar(7) NOT NULL,
  `banner1` tinyint(1) DEFAULT NULL,
  `banner2` tinyint(1) DEFAULT NULL,
  `banner3` tinyint(1) DEFAULT NULL,
  `home` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`codigo`),
  KEY `codigoProduto` (`codigoProduto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

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
-- Limitadores para a tabela `produtos_cores`
--
ALTER TABLE `produtos_cores`
  ADD CONSTRAINT `produtos_cor` FOREIGN KEY (`codigoProduto`) REFERENCES `produtos` (`codigo`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
