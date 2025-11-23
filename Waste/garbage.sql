-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2025 at 02:11 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `garbage`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500', '2025-04-08 11:29:04'),
(2, 'collector1', 'a1f5706761102820b4019f9cf24933da', '2025-04-08 11:29:04'),
(3, 'collector2', '888057d53ae96554836a3b16320fb9e6', '2025-04-08 11:29:04');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `collection_id` int(11) NOT NULL,
  `payment_amount` decimal(10,2) NOT NULL,
  `payment_status` enum('pending','paid','failed') DEFAULT 'pending',
  `transaction_id` varchar(100) DEFAULT NULL,
  `payment_date` timestamp NULL DEFAULT NULL
) ;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `collection_id`, `payment_amount`, `payment_status`, `transaction_id`, `payment_date`) VALUES
(1, 1, 10.50, 'pending', NULL, NULL),
(2, 2, 15.00, 'pending', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pending_requests`
--

CREATE TABLE `pending_requests` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `zone` varchar(100) NOT NULL,
  `waste_type` varchar(100) NOT NULL,
  `collection_date` date NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL,
  `payment_mode` enum('cash','online') NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `collector_id` int(11) DEFAULT NULL
) ;

--
-- Dumping data for table `pending_requests`
--

INSERT INTO `pending_requests` (`id`, `user_id`, `address`, `zone`, `waste_type`, `collection_date`, `amount`, `description`, `payment_mode`, `image`, `status`, `collector_id`) VALUES
(1, 1, '123 Main St, City', 'Zone A', 'Plastic', '2025-04-10', 10.50, 'Household waste', 'cash', NULL, 'pending', NULL),
(2, 2, '456 Oak St, City', 'Zone B', 'Organic', '2025-04-11', 15.00, 'Garden waste', 'online', NULL, 'pending', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('active','deactivated') DEFAULT 'active'
) ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `created_at`, `status`) VALUES
(1, 'user1', '4a094e453e6ee6a8253def63db4d1509', 'user1@example.com', '2025-04-08 11:29:04', 'active'),
(2, 'user2', 'efd398f9c21a334f1c3940de1862d5e8', 'user2@example.com', '2025-04-08 11:29:04', 'active'),
(3, 'n', '25d55ad283aa400af464c76d713c07ad', 'n@gmail.com', '2025-04-08 11:51:18', 'active'),
(6, 'b', 'a75feb79aa566ae83caef372ad97e112', 'divyadivya@gmail.com', '2025-04-08 11:57:33', 'active'),
(7, 'new', '68a0099b3f45357798639a30c5fe3154', 'new@gmail.com', '2025-04-08 12:03:32', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `waste_categories`
--

CREATE TABLE `waste_categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ;

--
-- Dumping data for table `waste_categories`
--

INSERT INTO `waste_categories` (`id`, `category_name`, `created_at`) VALUES
(3, 'Organic', '2025-04-08 11:29:05'),
(4, 'Glass', '2025-04-08 11:29:05'),
(5, 'Metal', '2025-04-08 11:29:05'),
(6, 'Plastic', '2025-04-08 12:06:11');

-- --------------------------------------------------------

--
-- Table structure for table `waste_collection`
--

CREATE TABLE `waste_collection` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `zone` varchar(100) NOT NULL,
  `waste_type` varchar(100) NOT NULL,
  `collection_date` date NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL,
  `payment_mode` enum('cash','online') NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `collector_id` int(11) DEFAULT NULL,
  `payment_status` enum('pending','paid','failed') DEFAULT 'pending',
  `transaction_id` varchar(100) DEFAULT NULL,
  `payment_date` timestamp NULL DEFAULT NULL
) ;

--
-- Dumping data for table `waste_collection`
--

INSERT INTO `waste_collection` (`id`, `user_id`, `address`, `zone`, `waste_type`, `collection_date`, `amount`, `description`, `payment_mode`, `image`, `status`, `collector_id`, `payment_status`, `transaction_id`, `payment_date`) VALUES
(1, 1, '123 Main St, City', 'Zone A', 'Plastic', '2025-04-10', 10.50, 'Household waste', 'cash', NULL, 'approved', 2, 'pending', NULL, NULL),
(2, 2, '456 Oak St, City', 'Zone B', 'Organic', '2025-04-11', 15.00, 'Garden waste', 'online', NULL, 'pending', NULL, 'pending', NULL, NULL),
(3, 7, 'Madurai', 'Zone B', '0', '2025-04-12', 50.00, 'dispose this', 'cash', 'uploads/1.png', 'approved', 3, 'pending', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `collection_id` (`collection_id`);

--
-- Indexes for table `pending_requests`
--
ALTER TABLE `pending_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `collector_id` (`collector_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `waste_categories`
--
ALTER TABLE `waste_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `waste_collection`
--
ALTER TABLE `waste_collection`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `collector_id` (`collector_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pending_requests`
--
ALTER TABLE `pending_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `waste_categories`
--
ALTER TABLE `waste_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `waste_collection`
--
ALTER TABLE `waste_collection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`collection_id`) REFERENCES `waste_collection` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pending_requests`
--
ALTER TABLE `pending_requests`
  ADD CONSTRAINT `pending_requests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pending_requests_ibfk_2` FOREIGN KEY (`collector_id`) REFERENCES `admins` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `waste_collection`
--
ALTER TABLE `waste_collection`
  ADD CONSTRAINT `waste_collection_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `waste_collection_ibfk_2` FOREIGN KEY (`collector_id`) REFERENCES `admins` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
