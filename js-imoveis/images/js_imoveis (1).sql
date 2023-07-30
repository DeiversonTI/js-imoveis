-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 30-Jul-2023 às 16:08
-- Versão do servidor: 8.0.27
-- versão do PHP: 8.0.13

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
-- Estrutura da tabela `cad_cliente`
--

DROP TABLE IF EXISTS `cad_cliente`;
CREATE TABLE IF NOT EXISTS `cad_cliente` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(220) NOT NULL,
  `email` varchar(150) NOT NULL,
  `celular` varchar(100) NOT NULL,
  `fixo` varchar(100) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `cad_cliente`
--

INSERT INTO `cad_cliente` (`id`, `nome`, `email`, `celular`, `fixo`, `created`) VALUES
(4, 'Adailton Moraes', 'adailton@gmail.com', '(21) 99666-5241', '(21) 3366-5874', '2023-07-28 08:28:47'),
(5, 'Maria do Carmo', 'maria@hotmail.com', '(21) 99856-85698', '(21) 2123-5263', '2023-07-28 08:30:49'),
(6, 'Bruno Costa Silva', 'bruno@gmail.com', '(21) 89652-6363', '(21) 2563-9658', '2023-07-28 08:31:34');

-- --------------------------------------------------------

--
-- Estrutura da tabela `contato_empresa`
--

DROP TABLE IF EXISTS `contato_empresa`;
CREATE TABLE IF NOT EXISTS `contato_empresa` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL,
  `creci` varchar(20) NOT NULL,
  `email` varchar(150) NOT NULL,
  `semana` varchar(100) NOT NULL,
  `horario` varchar(100) NOT NULL,
  `endereco` varchar(220) NOT NULL,
  `numero` varchar(50) NOT NULL,
  `bairro` varchar(50) NOT NULL,
  `tel_one` varchar(50) NOT NULL,
  `tel_two` varchar(50) NOT NULL,
  `facebook` varchar(220) NOT NULL,
  `instagram` varchar(220) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `contato_empresa`
--

INSERT INTO `contato_empresa` (`id`, `nome`, `creci`, `email`, `semana`, `horario`, `endereco`, `numero`, `bairro`, `tel_one`, `tel_two`, `facebook`, `instagram`, `created`, `modified`) VALUES
(10, 'Josias Pereira', '12965', 'deiverson.dtg@gmail.com', 'Segunda à Sábado', '8h-12h', 'Rua Correa Dutra', '324', 'Copacabana', '21967465467', '21967465467', 'http://localhost/facebook/', 'http://localhost/facebook/', '2023-07-27 12:08:53', '2023-07-29 09:55:01');

-- --------------------------------------------------------

--
-- Estrutura da tabela `enderecos`
--

DROP TABLE IF EXISTS `enderecos`;
CREATE TABLE IF NOT EXISTS `enderecos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `valor_imovel` float NOT NULL,
  `endereco` varchar(220) NOT NULL,
  `num_casa` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `estado` varchar(50) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `fk_id_imoveis` int NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `enderecos`
--

INSERT INTO `enderecos` (`id`, `valor_imovel`, `endereco`, `num_casa`, `estado`, `bairro`, `fk_id_imoveis`, `created`, `modified`) VALUES
(1, 300000, 'Estrada da Posse', '324', 'Rio de Janeiro', 'Campo Grande', 6, '2023-07-24 08:11:23', NULL),
(2, 980001, 'Caminho do Portinho ', '3698', 'Rio de Janeiro', 'Guaratiba', 7, '2023-07-24 08:12:59', '2023-07-25 14:34:09'),
(3, 125000, 'Estrada do Magarça', '85', 'Cosme Velho', 'Rio de Janeiro', 8, '2023-07-24 08:13:16', '2023-07-24 08:14:20'),
(4, 550000, 'Rua Correa Dutra', '1203', 'Rio de Janeiro', 'Copacabana', 9, '2023-07-24 08:15:25', NULL),
(5, 110000, 'Caminho do Portinho ', '516', 'Rio de Janeiro', 'Guaratiba', 10, '2023-07-24 08:16:31', NULL),
(6, 280000, 'Estrada do Magarça', '11', 'Rio de Janeiro', 'Campo Grande', 11, '2023-07-24 08:17:40', NULL),
(7, 25000, 'Estrada da Posse', '3', 'Rio de Janeiro', 'Nova Iguaçu', 12, '2023-07-24 08:18:53', NULL),
(8, 500000, 'Rua Correa Dutra', '725', 'Rio de Janeiro', 'Guaratiba', 13, '2023-07-24 08:21:22', '2023-07-25 15:21:31'),
(9, 58, 'Caminho do Portinho ', '25', 'Rio de Janeiro', 'Pedra de Guaratiba', 14, '2023-07-24 08:22:22', NULL),
(10, 0, '', '', '', '', 15, '2023-07-24 12:50:42', NULL),
(11, 0, '', '', '', '', 16, '2023-07-24 12:51:23', NULL),
(12, 0, '', '', '', '', 17, '2023-07-24 12:51:38', NULL),
(13, 490000, 'Nossa Senhora de Lourdes', '64/303', 'Rio de Janeiro', 'Grajaú', 18, '2023-07-25 16:30:53', '2023-07-28 10:25:40'),
(14, 35000, 'Rua Correa Dutra', '02', 'Rio de Janeiro', 'Cosme Velho', 19, '2023-07-26 16:31:10', NULL),
(15, 2100, 'Estrada da Posse', '324', 'Guaratiba', 'RJ', 20, '2023-07-28 08:58:18', '2023-07-28 10:26:05'),
(16, 155, 'Caminho do Portinho ', '324', 'RJ', 'Campo Grande', 21, '2023-07-28 09:13:20', NULL),
(17, 100000, 'Caminho do Portinho ', '324', 'RJ', 'Guaratiba', 22, '2023-07-28 10:02:53', NULL),
(18, 500000, 'Estrada do Magarça', '516', 'Guaratiba', 'Rio de Janeiro', 23, '2023-07-28 10:14:14', '2023-07-28 10:26:24'),
(19, 490000, 'Caminho do Portinho ', '1203', 'Rio de Janeiro', 'Nova Iguaçu', 24, '2023-07-28 12:45:05', NULL),
(20, 2100, 'RUA CORREA DUTRA 11 FLAMNEGO', '324', 'RJ', 'Guaratiba', 25, '2023-07-28 14:58:47', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `estado_msn`
--

DROP TABLE IF EXISTS `estado_msn`;
CREATE TABLE IF NOT EXISTS `estado_msn` (
  `id` int NOT NULL AUTO_INCREMENT,
  `estado` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fk_id_msn` int NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `estado_msn`
--

INSERT INTO `estado_msn` (`id`, `estado`, `fk_id_msn`, `created`, `modified`) VALUES
(12, 'Negociando', 4, '2023-07-29 12:25:40', '0000-00-00 00:00:00'),
(30, 'Finalizado', 2, '2023-07-29 12:40:46', '0000-00-00 00:00:00'),
(33, 'Finalizado', 6, '2023-07-29 12:43:53', '0000-00-00 00:00:00'),
(37, 'Finalizado', 8, '2023-07-29 12:52:46', '0000-00-00 00:00:00'),
(38, 'Finalizado', 3, '2023-07-30 09:53:19', '0000-00-00 00:00:00');

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
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
(15, 'img_8.jpg', 5, '2023-07-13 17:04:06'),
(16, 'img_1.jpg', 6, '2023-07-24 08:11:23'),
(17, 'img_2.jpg', 6, '2023-07-24 08:11:23'),
(18, 'img_3.jpg', 6, '2023-07-24 08:11:23'),
(19, 'img-55.jpg', 7, '2023-07-24 08:12:59'),
(20, 'img-56.jpg', 7, '2023-07-24 08:12:59'),
(21, 'img-57.jpg', 7, '2023-07-24 08:12:59'),
(22, 'img_5.jpg', 9, '2023-07-24 08:15:25'),
(23, 'img_6.jpg', 9, '2023-07-24 08:15:25'),
(24, 'img_7.jpg', 9, '2023-07-24 08:15:25'),
(25, 'img_5.jpg', 10, '2023-07-24 08:16:31'),
(26, 'img_6.jpg', 10, '2023-07-24 08:16:31'),
(27, 'img_7.jpg', 10, '2023-07-24 08:16:31'),
(28, 'ms-1.jpg', 11, '2023-07-24 08:17:40'),
(29, 'ms-2.jpg', 11, '2023-07-24 08:17:40'),
(30, 'ms-3.jpg', 11, '2023-07-24 08:17:40'),
(31, 'person_3-min.jpg', 12, '2023-07-24 08:18:53'),
(32, 'person_4-min.jpg', 12, '2023-07-24 08:18:53'),
(33, 'person_5-min.jpg', 12, '2023-07-24 08:18:53'),
(34, 'img_6.jpg', 13, '2023-07-24 08:21:22'),
(35, 'img_7.jpg', 13, '2023-07-24 08:21:22'),
(36, 'img_8.jpg', 13, '2023-07-24 08:21:22'),
(37, 'img_1.jpg', 14, '2023-07-24 08:22:22'),
(38, 'img_2.jpg', 14, '2023-07-24 08:22:22'),
(39, 'img_3.jpg', 14, '2023-07-24 08:22:22'),
(40, 'WhatsApp Image 2023-07-25 at 07.03.18.jpeg', 18, '2023-07-25 16:30:53'),
(41, 'WhatsApp Image 2023-07-25 at 07.03.19.jpeg', 18, '2023-07-25 16:30:53'),
(42, 'WhatsApp Image 2023-07-25 at 07.03.20.jpeg', 18, '2023-07-25 16:30:53'),
(43, 'WhatsApp Image 2023-07-25 at 07.03.22.jpeg', 18, '2023-07-25 16:30:53'),
(44, 'WhatsApp Image 2023-07-25 at 07.03.23 (1).jpeg', 18, '2023-07-25 16:30:53'),
(45, 'WhatsApp Image 2023-07-25 at 07.03.23.jpeg', 18, '2023-07-25 16:30:53'),
(46, 'WhatsApp Image 2023-07-25 at 07.03.24.jpeg', 18, '2023-07-25 16:30:53'),
(47, 'WhatsApp Image 2023-07-25 at 07.06.07.jpeg', 18, '2023-07-25 16:30:53'),
(48, 'img_7.jpg', 19, '2023-07-26 16:31:10'),
(49, 'img_8.jpg', 19, '2023-07-26 16:31:10'),
(50, 'img-55.jpg', 19, '2023-07-26 16:31:10'),
(51, 'img_4.jpg', 20, '2023-07-28 08:58:18'),
(52, 'person_5-min.jpg', 21, '2023-07-28 09:13:20'),
(53, 'person_6-min.jpg', 22, '2023-07-28 10:02:53'),
(54, 'person_5-min.jpg', 23, '2023-07-28 10:14:14'),
(55, 'WhatsApp Image 2023-07-25 at 07.03.18.jpeg', 24, '2023-07-28 12:45:05'),
(56, 'WhatsApp Image 2023-07-25 at 07.03.19.jpeg', 24, '2023-07-28 12:45:05'),
(57, 'WhatsApp Image 2023-07-25 at 07.03.20.jpeg', 24, '2023-07-28 12:45:05'),
(58, 'WhatsApp Image 2023-07-25 at 07.03.22.jpeg', 24, '2023-07-28 12:45:05'),
(59, 'WhatsApp Image 2023-07-25 at 07.03.24.jpeg', 24, '2023-07-28 12:45:05'),
(60, 'WhatsApp Image 2023-07-25 at 07.06.07.jpeg', 24, '2023-07-28 12:45:05'),
(61, 'teste01.jpg', 25, '2023-07-28 14:58:47'),
(62, 'teste02.jpg', 25, '2023-07-28 14:58:47'),
(63, 'teste03.jpg', 25, '2023-07-28 14:58:47');

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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `images_imoveis_one`
--

INSERT INTO `images_imoveis_one` (`id`, `images`, `fk_id_imoveis`, `created`) VALUES
(1, 'person_6-min.jpg', 1, '2023-07-12 15:25:31'),
(2, 'person_4-min.jpg', 2, '2023-07-12 15:30:35'),
(3, 'person_2-min.jpg', 3, '2023-07-12 15:31:03'),
(4, 'img_1.jpg', 4, '2023-07-13 17:02:10'),
(5, 'img_2.jpg', 5, '2023-07-13 17:04:06'),
(6, 'img_1.jpg', 6, '2023-07-24 08:11:23'),
(7, 'img-55.jpg', 7, '2023-07-24 08:12:59'),
(8, 'img_2.jpg', 8, '2023-07-24 08:13:16'),
(9, 'img_7.jpg', 9, '2023-07-24 08:15:25'),
(10, 'img_6.jpg', 10, '2023-07-24 08:16:31'),
(11, 'ms-3.jpg', 11, '2023-07-24 08:17:40'),
(12, 'person_6-min.jpg', 12, '2023-07-24 08:18:53'),
(13, 'img_6.jpg', 13, '2023-07-24 08:21:22'),
(14, 'img_8.jpg', 14, '2023-07-24 08:22:22'),
(15, 'img_1.jpg', 17, '2023-07-24 12:51:38'),
(16, 'WhatsApp Image 2023-07-25 at 07.06.07.jpeg', 18, '2023-07-25 16:30:53'),
(17, 'img_5.jpg', 19, '2023-07-26 16:31:10'),
(18, 'img_1.jpg', 20, '2023-07-28 08:58:18'),
(19, 'img_3.jpg', 21, '2023-07-28 09:13:20'),
(20, 'anonimo.png', 22, '2023-07-28 10:02:53'),
(21, 'person_6-min.jpg', 23, '2023-07-28 10:14:14'),
(22, 'WhatsApp Image 2023-07-25 at 07.03.24.jpeg', 24, '2023-07-28 12:45:05'),
(23, 'teste02.jpg', 25, '2023-07-28 14:58:47');

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
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `img_banner`
--

INSERT INTO `img_banner` (`id`, `imag_banner`, `created`) VALUES
(60, 'hero_bg_1.jpg', '2023-07-27 10:12:29'),
(61, 'hero_bg_2.jpg', '2023-07-27 10:12:51'),
(62, 'hero_bg_3.jpg', '2023-07-27 10:13:20'),
(64, 'casa_futuro.jpg', '2023-07-27 10:22:15');

-- --------------------------------------------------------

--
-- Estrutura da tabela `imoveis`
--

DROP TABLE IF EXISTS `imoveis`;
CREATE TABLE IF NOT EXISTS `imoveis` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cod_imovel` varchar(50) NOT NULL,
  `fk_nome_cli` int NOT NULL,
  `dormitorio` int NOT NULL,
  `banheiro` int NOT NULL,
  `area` varchar(50) NOT NULL,
  `suite` varchar(10) NOT NULL,
  `vagas` varchar(10) NOT NULL,
  `piscina` varchar(5) NOT NULL,
  `churrasqueira` varchar(5) NOT NULL,
  `descricao` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `imoveis`
--

INSERT INTO `imoveis` (`id`, `cod_imovel`, `fk_nome_cli`, `dormitorio`, `banheiro`, `area`, `suite`, `vagas`, `piscina`, `churrasqueira`, `descricao`, `created`, `modified`) VALUES
(4, '2100', 4, 1, 1, '10m2', '', '', 'Sim', 'Sim', 'dfadfa', '2023-07-13 17:02:10', NULL),
(5, '2100', 6, 1, 1, '70m2', '', '', 'Sim', 'Sim', 'fadfdfafadfaf', '2023-07-13 17:04:06', NULL),
(7, 'MDO36522', 5, 1, 1, '150m2', '', '', 'Não', 'Não', '<p>Abrão deixou se filho no altar</p>', '2023-07-24 08:12:59', '2023-07-25 14:34:09'),
(8, 'MKO3652', 4, 2, 1, '110m2', '1', '1', 'Não', 'Não', 'value=\"<h2 style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; font-family: DauphinPlain; font-size: 24px; line-height: 24px; color: rgb(0, 0, 0);\">What is Lorem Ipsum?</h2><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\"><strong style=\"margin: 0px; padding: 0px;\">Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\"', '2023-07-24 08:13:16', '2023-07-24 08:14:20'),
(9, 'MGT3652', 4, 1, 1, '700m2', '2', '2', 'Sim', 'Não', '<h2 style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; font-family: DauphinPlain; font-size: 24px; line-height: 24px; text-align: left; color: rgb(0, 0, 0);\">What is Lorem Ipsum?</h2><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;\"><strong style=\"margin: 0px; padding: 0px;\">Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '2023-07-24 08:15:25', NULL),
(10, 'JDM36514', 6, 2, 2, '250m2', '1', '2', 'Sim', 'Sim', '<h2 style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; font-family: DauphinPlain; font-size: 24px; line-height: 24px; text-align: left; color: rgb(0, 0, 0);\">What is Lorem Ipsum?</h2><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;\"><strong style=\"margin: 0px; padding: 0px;\">Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '2023-07-24 08:16:31', NULL),
(11, 'DGP2541', 5, 2, 1, '500m2', '1', '1', 'Não', 'Não', '<h2 style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; font-family: DauphinPlain; font-size: 24px; line-height: 24px; text-align: left; color: rgb(0, 0, 0);\">What is Lorem Ipsum?</h2><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;\"><strong style=\"margin: 0px; padding: 0px;\">Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '2023-07-24 08:17:40', NULL),
(12, 'JJK11200', 5, 1, 2, '75m2', '1', '1', 'Sim', 'Não', '<h2 style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; font-family: DauphinPlain; font-size: 24px; line-height: 24px; text-align: left; color: rgb(0, 0, 0);\">What is Lorem Ipsum?</h2><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;\"><strong style=\"margin: 0px; padding: 0px;\">Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '2023-07-24 08:18:53', NULL),
(19, 'mjo123456', 4, 1, 1, '45m2', '', '1', 'Não', 'Não', '<p style=\"text-align: left; \"><strong>ATENÇAO:</strong></p><p>Área externa com 350m2, amplo espaço interno com cobertura para o mar do recreio, garagem é coberta com tapume.</p>', '2023-07-26 16:31:10', NULL),
(24, 'jko3256', 5, 1, 1, '', '1', '1', 'Sim', 'Sim', '<p>Casa bacana</p>', '2023-07-28 12:45:05', NULL),
(25, '22222', 5, 2, 2, '', '2', '2', 'Sim', 'Sim', '<p>dfsdfdsfsf</p>', '2023-07-28 14:58:47', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `imovel_interesse`
--

DROP TABLE IF EXISTS `imovel_interesse`;
CREATE TABLE IF NOT EXISTS `imovel_interesse` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefone` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_imovel` int NOT NULL,
  `email` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `imovel_interesse`
--

INSERT INTO `imovel_interesse` (`id`, `nome`, `telefone`, `id_imovel`, `email`, `created`) VALUES
(1, 'Deiverson Chaves de Araujo', '21967465467', 24, 'deiverson.dtg@gmail.com', '2023-07-30 12:37:25'),
(2, '', '', 24, '', '2023-07-30 12:44:53'),
(3, '', '', 24, '', '2023-07-30 12:46:44'),
(4, 'Deiverson Chaves de Araujo', '21967465467', 24, 'deiverson.dtg@gmail.com', '2023-07-30 12:46:54'),
(5, '', '', 24, '', '2023-07-30 13:01:58'),
(6, 'Deiverson Chaves de Araujo', '21967465467', 24, 'deiverson.dtg@gmail.com', '2023-07-30 13:02:19'),
(7, 'Deiverson Chaves de Araujo', '21967465467', 24, 'deiverson.dtg@gmail.com', '2023-07-30 13:02:49');

-- --------------------------------------------------------

--
-- Estrutura da tabela `logo`
--

DROP TABLE IF EXISTS `logo`;
CREATE TABLE IF NOT EXISTS `logo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `img_logo` varchar(220) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `logo`
--

INSERT INTO `logo` (`id`, `img_logo`, `created`) VALUES
(59, 'banner-assessoria-branco.png', '2023-07-27 09:27:15');

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
) ENGINE=MyISAM AUTO_INCREMENT=72 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `mani_banner`
--

INSERT INTO `mani_banner` (`id`, `images`, `fk_id_img_banner`) VALUES
(71, 'hero_bg_3.jpg', 62);

-- --------------------------------------------------------

--
-- Estrutura da tabela `message_cliente`
--

DROP TABLE IF EXISTS `message_cliente`;
CREATE TABLE IF NOT EXISTS `message_cliente` (
  `id` int NOT NULL AUTO_INCREMENT,
  `estado` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nome` varchar(120) NOT NULL,
  `email` varchar(120) NOT NULL,
  `cel` varchar(50) NOT NULL,
  `tel` varchar(50) NOT NULL,
  `assunto` varchar(220) NOT NULL,
  `textarea` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `message_cliente`
--

INSERT INTO `message_cliente` (`id`, `estado`, `nome`, `email`, `cel`, `tel`, `assunto`, `textarea`, `created`, `modified`) VALUES
(2, '', 'Elizangela', 'eliz@gmail.com', '(21) 98493-9125', '21967465467', 'O Sr. tem casa no Estácio?', 'Estou Procurando casas para alugar nas emidiações do Estácio', '2023-07-26 10:14:39', '2023-07-29 11:37:26'),
(3, '', 'Armando Araújo', 'deivoc@gmail.com', '(21) 98493-9125', '21967465467', 'Gostaria de Informações', 'Gostei muito do site, poderia me indicar quem fez?', '2023-07-27 12:53:54', '2023-07-29 11:36:20');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sit_imoveis`
--

DROP TABLE IF EXISTS `sit_imoveis`;
CREATE TABLE IF NOT EXISTS `sit_imoveis` (
  `id` int NOT NULL AUTO_INCREMENT,
  `situacao` varchar(50) NOT NULL,
  `tipo_imovel` varchar(50) NOT NULL,
  `fk_id_imoveis` int NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `sit_imoveis`
--

INSERT INTO `sit_imoveis` (`id`, `situacao`, `tipo_imovel`, `fk_id_imoveis`, `created`, `modified`) VALUES
(1, 'comprar', 'Apartamento', 6, '2023-07-24 08:11:23', NULL),
(2, 'comprar', 'Casa', 7, '2023-07-24 08:12:59', '2023-07-25 14:34:09'),
(3, 'Vender', 'Casa', 8, '2023-07-24 08:13:16', '2023-07-24 08:14:20'),
(4, 'comprar', 'Casa', 9, '2023-07-24 08:15:25', NULL),
(5, 'Vender', 'Apartamento', 10, '2023-07-24 08:16:31', NULL),
(6, 'Vender', 'Apartamento', 11, '2023-07-24 08:17:40', NULL),
(7, 'comprar', 'Apartamento', 12, '2023-07-24 08:18:53', NULL),
(8, 'comprar', 'Casa', 13, '2023-07-24 08:21:22', '2023-07-25 15:21:31'),
(9, 'comprar', 'Casa', 14, '2023-07-24 08:22:22', NULL),
(13, 'comprar', 'Casa', 18, '2023-07-25 16:30:53', '2023-07-28 10:25:40'),
(14, 'comprar', 'Apartamento', 19, '2023-07-26 16:31:10', NULL),
(15, 'comprar', 'Apartamento', 20, '2023-07-28 08:58:18', '2023-07-28 10:26:05'),
(16, 'comprar', 'Apartamento', 21, '2023-07-28 09:13:20', NULL),
(17, 'Vender', 'Apartamento', 22, '2023-07-28 10:02:53', NULL),
(18, 'comprar', 'Casa', 23, '2023-07-28 10:14:14', '2023-07-28 10:26:25'),
(19, 'comprar', 'Casa', 24, '2023-07-28 12:45:05', NULL),
(20, 'Vender', 'Apartamento', 25, '2023-07-28 14:58:47', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `title`
--

DROP TABLE IF EXISTS `title`;
CREATE TABLE IF NOT EXISTS `title` (
  `id` int NOT NULL AUTO_INCREMENT,
  `img_fivecon` varchar(100) NOT NULL,
  `title_site` varchar(220) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `slug` varchar(220) NOT NULL,
  `sub_slug` varchar(220) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `descript` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `title`
--

INSERT INTO `title` (`id`, `img_fivecon`, `title_site`, `slug`, `sub_slug`, `keywords`, `descript`, `created`, `modified`) VALUES
(7, 'favicon-32x32.png', 'dfadfa233', 'fadfadf', 'dfafadfd', 'dddddddd', 'adfadf', '2023-07-27 09:26:57', '2023-07-30 11:46:14');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(220) NOT NULL,
  `nivel_acesso` varchar(50) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `nivel_acesso`, `created`) VALUES
(1, 'Deiverson', 'd@d.com', '$2y$10$rhmkpPLvQxdUn/bPsLdbBuqZlCi3hqzfr7WFstZEAJ5aNjL9zjayy', '1', '2023-07-24 07:58:21'),
(2, 'Biel', 'b@b.com', '$2y$10$rhmkpPLvQxdUn/bPsLdbBuqZlCi3hqzfr7WFstZEAJ5aNjL9zjayy', '2', '2023-07-19 16:21:32');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
