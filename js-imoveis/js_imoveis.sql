-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 14-Jul-2023 às 20:06
-- Versão do servidor: 8.0.31
-- versão do PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `js_imoveis`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `images_imoveis`
--

DROP TABLE IF EXISTS `images_imoveis`;
CREATE TABLE IF NOT EXISTS `images_imoveis` (
  `id` int NOT NULL AUTO_INCREMENT,
  `images` varchar(220) NOT NULL,
  `fk_id_imoveis` int NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `images_imoveis`
--

INSERT INTO `images_imoveis` (`id`, `images`, `fk_id_imoveis`, `created`) VALUES
(1, 'img_1.jpg', 1, '2023-07-12 15:25:31'),
(2, 'img_2.jpg', 1, '2023-07-12 15:25:31'),
(3, 'img_3.jpg', 1, '2023-07-12 15:25:31'),
(4, 'img_6.jpg', 2, '2023-07-12 15:30:35'),
(5, 'img_7.jpg', 2, '2023-07-12 15:30:35'),
(6, 'img_8.jpg', 2, '2023-07-12 15:30:35'),
(7, 'img_5.jpg', 3, '2023-07-12 15:31:03'),
(8, 'img_6.jpg', 3, '2023-07-12 15:31:03'),
(9, 'img_7.jpg', 3, '2023-07-12 15:31:03'),
(10, 'img_3.jpg', 4, '2023-07-13 17:02:10'),
(11, 'img_4.jpg', 4, '2023-07-13 17:02:10'),
(12, 'img_5.jpg', 4, '2023-07-13 17:02:10'),
(13, 'img_6.jpg', 5, '2023-07-13 17:04:06'),
(14, 'img_7.jpg', 5, '2023-07-13 17:04:06'),
(15, 'img_8.jpg', 5, '2023-07-13 17:04:06');

-- --------------------------------------------------------

--
-- Estrutura da tabela `images_imoveis_one`
--

DROP TABLE IF EXISTS `images_imoveis_one`;
CREATE TABLE IF NOT EXISTS `images_imoveis_one` (
  `id` int NOT NULL AUTO_INCREMENT,
  `images` varchar(220) NOT NULL,
  `fk_id_imoveis` int NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `images_imoveis_one`
--

INSERT INTO `images_imoveis_one` (`id`, `images`, `fk_id_imoveis`, `created`) VALUES
(1, 'person_6-min.jpg', 1, '2023-07-12 15:25:31'),
(2, 'person_4-min.jpg', 2, '2023-07-12 15:30:35'),
(3, 'person_2-min.jpg', 3, '2023-07-12 15:31:03'),
(4, 'img_1.jpg', 4, '2023-07-13 17:02:10'),
(5, 'img_2.jpg', 5, '2023-07-13 17:04:06');

-- --------------------------------------------------------

--
-- Estrutura da tabela `img_banner`
--

DROP TABLE IF EXISTS `img_banner`;
CREATE TABLE IF NOT EXISTS `img_banner` (
  `id` int NOT NULL AUTO_INCREMENT,
  `imag_banner` varchar(220) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `img_banner`
--

INSERT INTO `img_banner` (`id`, `imag_banner`, `created`) VALUES
(29, 'hero_bg_2.jpg', '2023-07-14 13:38:27'),
(30, 'home1.jpg', '2023-07-14 13:38:36'),
(31, 'home2.jpg', '2023-07-14 13:40:44'),
(33, 'hero_bg_3.jpg', '2023-07-14 16:21:31');

-- --------------------------------------------------------

--
-- Estrutura da tabela `imoveis`
--

DROP TABLE IF EXISTS `imoveis`;
CREATE TABLE IF NOT EXISTS `imoveis` (
  `id` int NOT NULL AUTO_INCREMENT,
  `valor` varchar(50) NOT NULL,
  `endereco` varchar(220) NOT NULL,
  `numero` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `estado` varchar(100) NOT NULL,
  `bairro` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `dormitorio` int NOT NULL,
  `banheiro` int NOT NULL,
  `piscina` varchar(5) NOT NULL,
  `churrasqueira` varchar(5) NOT NULL,
  `descricao` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `imoveis`
--

INSERT INTO `imoveis` (`id`, `valor`, `endereco`, `numero`, `estado`, `bairro`, `dormitorio`, `banheiro`, `piscina`, `churrasqueira`, `descricao`, `created`, `modified`) VALUES
(4, '2100', 'RUA CORREA DUTRA 11 FLAMENGO RJ', '516', 'RJ', 'Guaratiba', 1, 1, 'Sim', 'Sim', 'dfadfa', '2023-07-13 17:02:10', NULL),
(5, '2100', 'RUA CORREA DUTRA 11 FLAMENGO RJ', '1203', 'RJ', 'Copacabana', 1, 1, 'Sim', 'Sim', 'fadfdfafadfaf', '2023-07-13 17:04:06', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `mani_banner`
--

DROP TABLE IF EXISTS `mani_banner`;
CREATE TABLE IF NOT EXISTS `mani_banner` (
  `id` int NOT NULL AUTO_INCREMENT,
  `images` varchar(255) NOT NULL,
  `fk_id_img_banner` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `mani_banner`
--

INSERT INTO `mani_banner` (`id`, `images`, `fk_id_img_banner`) VALUES
(43, 'home1.jpg', 30);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
