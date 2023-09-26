-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 18-Abr-2023 às 20:28
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `lap_220920`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `addresses`
--

CREATE TABLE `addresses` (
  `id` int(11) NOT NULL,
  `street` varchar(255) DEFAULT NULL,
  `postalcode` varchar(10) DEFAULT NULL,
  `house_number` varchar(30) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `order_id` int(11) NOT NULL,
  `type` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `addresses`
--

INSERT INTO `addresses` (`id`, `street`, `postalcode`, `house_number`, `city`, `order_id`, `type`) VALUES
(1, 'Flurgasse', '8330', '1', 'Feldbach', 1, 1),
(2, 'Flurgasse', '8330', '1', 'Feldbach', 1, 2),
(3, 'Flurgasse', '8330', '1', 'Feldbach', 2, 1),
(4, 'Flurgasse', '8330', '1', 'Feldbach', 2, 2),
(5, 'Flurgasse', '8330', '1', 'Feldbach', 3, 1),
(6, 'Flurgasse', '8330', '1', 'Feldbach', 3, 2),
(7, 'Woworskyweg', '8330', '2/10', 'Feldbach', 4, 1),
(8, 'Woworskyweg', '8330', '2/10', 'Feldbach', 4, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `credit_card`
--

CREATE TABLE `credit_card` (
  `id` int(11) NOT NULL,
  `card_number` varchar(255) NOT NULL,
  `card_owner` varchar(255) NOT NULL,
  `card_type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `credit_card`
--

INSERT INTO `credit_card` (`id`, `card_number`, `card_owner`, `card_type`) VALUES
(1, 'ooo', 'ööö', 'Mastercard');

-- --------------------------------------------------------

--
-- Estrutura da tabela `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_number` varchar(255) DEFAULT NULL,
  `payment_type` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `credit_card_id` int(11) DEFAULT NULL,
  `sent_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `orders`
--

INSERT INTO `orders` (`id`, `order_number`, `payment_type`, `user_id`, `credit_card_id`, `sent_date`) VALUES
(1, '2303000001', 2, 2, NULL, '2023-03-16 20:52:50'),
(2, '2303000002', 1, 2, NULL, '2023-03-27 22:03:12'),
(3, '2304000003', 1, 2, NULL, '2023-04-05 20:10:56'),
(4, '2304000004', 1, 2, NULL, '2023-04-06 21:36:22');

-- --------------------------------------------------------

--
-- Estrutura da tabela `order__products`
--

CREATE TABLE `order__products` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(9,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `order__products`
--

INSERT INTO `order__products` (`order_id`, `product_id`, `quantity`, `price`) VALUES
(1, 1, 1, '149.99'),
(2, 2, 1, '599.98'),
(3, 1, 1, '149.99'),
(4, 1, 1, '149.99');

-- --------------------------------------------------------

--
-- Estrutura da tabela `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(9,2) DEFAULT 0.00,
  `description` varchar(1000) DEFAULT '',
  `picture` varchar(255) DEFAULT '',
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `description`, `picture`, `user_id`) VALUES
(1, 'Uhr', '149.99', 'Eine sehr elegante Uhr', '1.jpg', 1),
(2, 'Fernseher', '599.98', 'Ein toller Fernseher', '2.jpg', 1),
(3, 'Sofa', '359.49', 'Ein bequemes Sofa', '3.jpg', 1),
(4, 'Tisch', '115.79', 'Ein großer Tisch', '4.jpg', 1),
(5, 'Sonnenbrille', '59.99', 'Eine richtig coole Sonnenbrille', '5.jpg', 2),
(6, 'Laptop', '875.99', 'Ein neuer Laptop', '6.jpg', 1),
(7, 'Quitscheentchen', '15.79', 'Have you tried explainig it to the rubber duck', '7.jpg', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Administrator'),
(2, 'Benutzer');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `date_of_birth`, `role_id`, `password`) VALUES
(1, 'Peter', 'Silie', 'petersilie@lap.com', '1978-05-06', 1, '$2y$10$V4OqWm4GdfHI6F9V7qg6FO1rPG1zCYZDD7dghBAP494.M3MmOAK2W'),
(2, 'Anna', 'Nahs', 'annanahs@test.com', '1985-07-21', 2, '$2y$10$V4OqWm4GdfHI6F9V7qg6FO1rPG1zCYZDD7dghBAP494.M3MmOAK2W');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Índices para tabela `credit_card`
--
ALTER TABLE `credit_card`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `credit_card_id` (`credit_card_id`);

--
-- Índices para tabela `order__products`
--
ALTER TABLE `order__products`
  ADD PRIMARY KEY (`order_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Índices para tabela `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Índices para tabela `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `credit_card`
--
ALTER TABLE `credit_card`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Limitadores para a tabela `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`credit_card_id`) REFERENCES `credit_card` (`id`);

--
-- Limitadores para a tabela `order__products`
--
ALTER TABLE `order__products`
  ADD CONSTRAINT `order__products_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order__products_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Limitadores para a tabela `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Limitadores para a tabela `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
