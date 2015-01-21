-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 22-Jan-2015 às 00:55
-- Versão do servidor: 5.0.45-community-nt
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `docebacana`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE IF NOT EXISTS `categorias` (
  `codigo` bigint(20) unsigned NOT NULL auto_increment,
  `nome` varchar(30) NOT NULL,
  PRIMARY KEY  (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `codigo` bigint(20) unsigned NOT NULL auto_increment,
  `pessoa` tinyint(1) NOT NULL COMMENT '1 - Pessoa Fisica; 0 - Pessoa Juridica',
  `nome` varchar(100) NOT NULL,
  `nomeResponsavel` varchar(100) NOT NULL,
  `cpf` varchar(14) default NULL,
  `cnpj` varchar(18) default NULL,
  `informacaoTriburaria` int(3) unsigned zerofill default NULL COMMENT '0 - Contribuinte ICMS; 1 - Não Contribuinte; 2 - Isento',
  `inscricaoEstadual` varchar(20) default NULL,
  `nascimento` date default NULL,
  `sexo` tinyint(1) default NULL COMMENT '1 - Masculino; 0 - Feminino',
  `telefone` varchar(17) default NULL,
  `celular` varchar(17) default NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `ofertaEmail` tinyint(1) NOT NULL,
  `ofertaCelular` tinyint(1) NOT NULL,
  `cep` varchar(9) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `numero` int(11) NOT NULL,
  `complemento` varchar(30) default NULL,
  `bairro` varchar(30) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `estado` varchar(2) NOT NULL,
  `pontoReferencia` varchar(150) default NULL,
  PRIMARY KEY  (`codigo`),
  UNIQUE KEY `cpf` (`cpf`,`cnpj`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
