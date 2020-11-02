-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 01-Nov-2020 às 01:53
-- Versão do servidor: 10.4.14-MariaDB
-- versão do PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ionize`
--
CREATE DATABASE IF NOT EXISTS `ionize` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `ionize`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_category`
--

CREATE TABLE `tb_category` (
  `pk_cat_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_credentials`
--

CREATE TABLE `tb_credentials` (
  `pk_cred_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `fk_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_product`
--

CREATE TABLE `tb_product` (
  `pk_prod_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `product_condition` enum('new','used') NOT NULL,
  `img_dir` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` longtext DEFAULT '',
  `stock` int(11) NOT NULL,
  `fk_category_id` int(11) NOT NULL,
  `fk_salesman_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_transaction`
--

CREATE TABLE `tb_transaction` (
  `pk_tran_id` int(11) NOT NULL,
  `tr_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `fk_product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` enum('to_send','in_transit','done') NOT NULL,
  `fk_buyer_id` int(11) NOT NULL,
  `fk_seller_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_user`
--

CREATE TABLE `tb_user` (
  `pk_user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `birthday` date NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `balance` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tb_category`
--
ALTER TABLE `tb_category`
  ADD PRIMARY KEY (`pk_cat_id`);

--
-- Índices para tabela `tb_credentials`
--
ALTER TABLE `tb_credentials`
  ADD PRIMARY KEY (`pk_cred_id`),
  ADD KEY `fk_user_id` (`fk_user_id`);

--
-- Índices para tabela `tb_product`
--
ALTER TABLE `tb_product`
  ADD PRIMARY KEY (`pk_prod_id`),
  ADD KEY `fk_salesman_id` (`fk_salesman_id`),
  ADD KEY `fk_category_id` (`fk_category_id`);

--
-- Índices para tabela `tb_transaction`
--
ALTER TABLE `tb_transaction`
  ADD PRIMARY KEY (`pk_tran_id`),
  ADD KEY `fk_product_id` (`fk_product_id`),
  ADD KEY `fk_buyer_id` (`fk_buyer_id`),
  ADD KEY `fk_seller_id` (`fk_seller_id`);

--
-- Índices para tabela `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`pk_user_id`),
  ADD UNIQUE KEY `cpf` (`cpf`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_category`
--
ALTER TABLE `tb_category`
  MODIFY `pk_cat_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_credentials`
--
ALTER TABLE `tb_credentials`
  MODIFY `pk_cred_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_product`
--
ALTER TABLE `tb_product`
  MODIFY `pk_prod_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_transaction`
--
ALTER TABLE `tb_transaction`
  MODIFY `pk_tran_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `pk_user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `tb_credentials`
--
ALTER TABLE `tb_credentials`
  ADD CONSTRAINT `tb_credentials_ibfk_1` FOREIGN KEY (`fk_user_id`) REFERENCES `tb_user` (`pk_user_id`);

--
-- Limitadores para a tabela `tb_product`
--
ALTER TABLE `tb_product`
  ADD CONSTRAINT `tb_product_ibfk_1` FOREIGN KEY (`fk_salesman_id`) REFERENCES `tb_user` (`pk_user_id`),
  ADD CONSTRAINT `tb_product_ibfk_2` FOREIGN KEY (`fk_category_id`) REFERENCES `tb_category` (`pk_cat_id`);

--
-- Limitadores para a tabela `tb_transaction`
--
ALTER TABLE `tb_transaction`
  ADD CONSTRAINT `tb_transaction_ibfk_1` FOREIGN KEY (`fk_product_id`) REFERENCES `tb_product` (`pk_prod_id`),
  ADD CONSTRAINT `tb_transaction_ibfk_2` FOREIGN KEY (`fk_buyer_id`) REFERENCES `tb_user` (`pk_user_id`),
  ADD CONSTRAINT `tb_transaction_ibfk_3` FOREIGN KEY (`fk_seller_id`) REFERENCES `tb_product` (`fk_salesman_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
