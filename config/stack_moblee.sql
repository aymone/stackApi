-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 27-Jul-2015 às 03:29
-- Versão do servidor: 5.5.43-0ubuntu0.14.04.1
-- versão do PHP: 5.5.9-1ubuntu4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `stack_moblee`
--
CREATE DATABASE IF NOT EXISTS `stack_moblee` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `stack_moblee`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `question_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `owner_name` varchar(255) NOT NULL,
  `score` int(11) NOT NULL,
  `creation_date` int(10) NOT NULL,
  `link` varchar(255) NOT NULL,
  `is_answered` tinyint(1) NOT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`question_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `updates`
--

DROP TABLE IF EXISTS `updates`;
CREATE TABLE IF NOT EXISTS `updates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
