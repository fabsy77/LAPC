/* 
User Login-Daten:
Administrator: E-Mail: petersilie@lap.com; Passwort: loginlogin
normaler Benutzer: E-Mail: annanahs@test.com; Passwort: loginlogin
*/

-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 26. Okt 2022 um 10:55
-- Server-Version: 10.4.18-MariaDB
-- PHP-Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Datenbank: `lap_220920`
--
CREATE DATABASE IF NOT EXISTS `lap_220920` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `lap_220920`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `addresses`
--

CREATE TABLE `addresses` (
  `id` int(11) NOT NULL,
  `street` varchar(255) DEFAULT NULL,
  `postalcode` varchar(10) DEFAULT NULL,
  `house_number` varchar(30) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `order_id` int(11) NOT NULL,
  `type` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `credit_card`
--

CREATE TABLE `credit_card` (
  `id` int(11) NOT NULL,
  `card_number` varchar(255) NOT NULL,
  `card_owner` varchar(255) NOT NULL,
  `card_type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_number` varchar(255) DEFAULT NULL,
  `payment_type` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `credit_card_id` int(11) DEFAULT NULL,
  `sent_date` datetime DEFAULT current_timestamp
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `order__products`
--

CREATE TABLE `order__products` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(9,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(9,2) DEFAULT 0.00,
  `description` varchar(1000) DEFAULT '',
  `picture` varchar(255) DEFAULT '',
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `products`
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
-- Tabellenstruktur für Tabelle `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Administrator'),
(2, 'Benutzer');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `date_of_birth`, `role_id`, `password`) VALUES
(1, 'Peter', 'Silie', 'petersilie@lap.com', '1978-05-06', 1, '$2y$10$V4OqWm4GdfHI6F9V7qg6FO1rPG1zCYZDD7dghBAP494.M3MmOAK2W'),
(2, 'Anna', 'Nahs', 'annanahs@test.com', '1985-07-21', 2, '$2y$10$V4OqWm4GdfHI6F9V7qg6FO1rPG1zCYZDD7dghBAP494.M3MmOAK2W');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indizes für die Tabelle `credit_card`
--
ALTER TABLE `credit_card`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `credit_card_id` (`credit_card_id`);

--
-- Indizes für die Tabelle `order__products`
--
ALTER TABLE `order__products`
  ADD PRIMARY KEY (`order_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indizes für die Tabelle `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indizes für die Tabelle `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT für Tabelle `credit_card`
--
ALTER TABLE `credit_card`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT für Tabelle `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT für Tabelle `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Constraints der Tabelle `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`credit_card_id`) REFERENCES `credit_card` (`id`);

--
-- Constraints der Tabelle `order__products`
--
ALTER TABLE `order__products`
  ADD CONSTRAINT `order__products_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order__products_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints der Tabelle `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints der Tabelle `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;
