-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 16, 2023 at 07:15 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `meu_projeto`
--

-- --------------------------------------------------------

--
-- Table structure for table `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int NOT NULL,
  `comentario` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `data_hora` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `comentarios`
--

INSERT INTO `comentarios` (`id`, `comentario`, `data_hora`) VALUES
(38, 'ESSE DAQUI É O PRIMEIRO COMENTÁRIO DEFINITIVO. <strong> OBG POR ESTAR AQUI </strong>', '2023-07-16 05:25:47'),
(42, 'Backend feito em PHP, banco de dados mysql, estou usando o AJAX 3.5.1 para a velocidade de busca.', '2023-07-16 06:57:18'),
(43, 'teste com utf8_general_ci', '2023-07-16 16:07:07'),
(44, 'teste com utf8_general_ci1', '2023-07-16 16:12:05');

-- --------------------------------------------------------

--
-- Table structure for table `likes_comentario`
--

CREATE TABLE `likes_comentario` (
  `id` int NOT NULL,
  `comentario_id` int DEFAULT NULL,
  `likes` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `likes_comentario`
--

INSERT INTO `likes_comentario` (`id`, `comentario_id`, `likes`) VALUES
(60, 38, 1),
(62, 38, 1),
(63, 38, 1),
(64, 38, 1),
(66, 38, 1),
(67, 43, 1),
(68, 43, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes_comentario`
--
ALTER TABLE `likes_comentario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comentario_id` (`comentario_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `likes_comentario`
--
ALTER TABLE `likes_comentario`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `likes_comentario`
--
ALTER TABLE `likes_comentario`
  ADD CONSTRAINT `likes_comentario_ibfk_1` FOREIGN KEY (`comentario_id`) REFERENCES `comentarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
