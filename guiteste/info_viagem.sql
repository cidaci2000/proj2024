-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30/09/2024 às 17:04
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `info_viagem`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `viagens`
--

CREATE TABLE `viagens` (
  `id` int(11) NOT NULL,
  `data_saida` date DEFAULT NULL,
  `data_chegada` date DEFAULT NULL,
  `combustivel` decimal(10,2) DEFAULT NULL,
  `pedagio` decimal(10,2) DEFAULT NULL,
  `manutencao` decimal(10,2) DEFAULT NULL,
  `lucro` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `viagens`
--

INSERT INTO `viagens` (`id`, `data_saida`, `data_chegada`, `combustivel`, `pedagio`, `manutencao`, `lucro`) VALUES
(12, '2024-10-24', '0000-00-00', 300.00, NULL, NULL, NULL),
(13, '2024-10-24', '0000-00-00', 200.00, 100.00, 50.00, NULL),
(14, '2024-10-24', '2024-11-05', 1500.00, 300.00, 200.00, 5000.00);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `viagens`
--
ALTER TABLE `viagens`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `viagens`
--
ALTER TABLE `viagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
