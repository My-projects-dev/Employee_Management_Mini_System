-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Hazırlanma Vaxtı: 19 Apr, 2026 saat 15:29
-- Server versiyası: 10.4.32-MariaDB
-- PHP Versiyası: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Verilənlər Bazası: `maffin_task`
--

-- --------------------------------------------------------

--
-- Cədvəl üçün cədvəl strukturu `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `position` varchar(50) NOT NULL,
  `salary` decimal(8,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Sxemi çıxarılan cedvel `employees`
--

INSERT INTO `employees` (`id`, `first_name`, `last_name`, `email`, `phone`, `position`, `salary`, `created_at`) VALUES
(1, 'John', 'Small', 'povapacad@mailinator.com', '+1 (643) 578-7135', 'Odio enim dolor repr', 28.00, '2026-04-17 17:22:13'),
(3, 'Meredith', 'Vazquez', 'huky@mailinator.com', '+1 (809) 982-4436', 'Similique excepteur', 5.00, '2026-04-18 11:54:52'),
(4, 'Axel', 'Gross', 'vucu@mailinator.com', '+1 (809) 751-4901', 'Pariatur Sunt eaque', 33.00, '2026-04-18 20:18:31'),
(6, 'Bevis', 'Morgan', 'wabuk@mailinator.com', '+1 (851) 335-2834', 'Neque quia reprehend', 44.00, '2026-04-19 10:46:14'),
(7, 'Brenna', 'Holman', 'kewa@mailinator.com', '+1 (293) 779-9658', 'Obcaecati fuga At i', 55.00, '2026-04-19 11:24:47'),
(8, 'Joy', 'Holden', 'bywaxyh@mailinator.com', '+1 (396) 767-3555', 'Officia sed quos est', 55.00, '2026-04-19 11:37:48'),
(9, 'Lara', 'Nielsen', 'byven@mailinator.com', '+1 (632) 478-8292', 'Aut enim autem offic', 55.00, '2026-04-19 11:38:02'),
(10, 'Benedict', 'Atkins', 'wefipeqy@mailinator.com', '+1 (445) 645-4043', 'Ullamco quo ratione', 5.00, '2026-04-19 12:06:08');

--
-- Indexes for dumped tables
--

--
-- Cədvəl üçün indekslər `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- Cədvəl üçün AUTO_INCREMENT `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
