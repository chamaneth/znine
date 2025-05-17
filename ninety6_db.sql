-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 17, 2025 at 03:44 PM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ninety6_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `name` varchar(40) NOT NULL,
  `order_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `quantity` int NOT NULL DEFAULT '1',
  `order_status` varchar(50) DEFAULT 'pending',
  PRIMARY KEY (`order_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE IF NOT EXISTS `order_items` (
  `order_item_id` int NOT NULL AUTO_INCREMENT,
  `order_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`order_item_id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `price` decimal(10,2) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `sales` int DEFAULT '0',
  `selling_price` decimal(10,4) NOT NULL,
  `regular_price` decimal(10,4) NOT NULL,
  `stock` int NOT NULL,
  `brand` varchar(100) NOT NULL,
  `sku` varchar(64) NOT NULL,
  `status` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `size` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `category`, `image_url`, `sales`, `selling_price`, `regular_price`, `stock`, `brand`, `sku`, `status`, `size`) VALUES
(29, 'Floral Dress Pink', 'Pink Flora is one of a best design.', 0.00, 'Women', 'uploads/8ab811b684136778ed4b7d0980a72fb0.jpg', 0, 1300.0000, 1400.0000, 400, 'NINETY6', 'FD23', '', NULL),
(28, 'Green Crocodile', 'Crocodile is a best clothing brand global', 0.00, 'Men', 'uploads/91NgMnjiMoL._AC_UY1000_.jpg', 0, 2998.0000, 3000.0000, 380, 'Crocodile', 'MT345', '', NULL),
(27, 'Black Shirt', 'Quality Shirts', 0.00, 'Men', 'uploads/crocodile.jpg', 0, 2500.0002, 2300.0000, 284, 'Crocodile', 'MT234', '', NULL),
(26, 'Floral Frock', 'Floral Designs by Jezza', 0.00, 'Women', 'uploads/c9a80da62720749eda3e973d8b8ee490.jpg', 0, 0.0000, 0.0000, 100, 'Jezza', 'F1', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int NOT NULL AUTO_INCREMENT,
  `reviewer_name` varchar(100) NOT NULL,
  `rating` int NOT NULL,
  `review_text` text NOT NULL,
  `reviewer_image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `site_title` varchar(255) NOT NULL,
  `site_description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shipping_addresses`
--

DROP TABLE IF EXISTS `shipping_addresses`;
CREATE TABLE IF NOT EXISTS `shipping_addresses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `street_address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `zip_code` varchar(20) NOT NULL,
  `country` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `User_N` varchar(30) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `z_code` varchar(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(10) DEFAULT 'user',
  `status` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `User_N`, `first_name`, `last_name`, `email`, `Address`, `z_code`, `password`, `role`, `status`) VALUES
(1, '', 'Thiliniqz', 'Ekanayake', 'thili@gmail.com', '', '', '$2y$10$Is8KWhufQLxQgAvcXVr0CO7oiL/5pYeLRQ5ZX9rYFnIGypxJIs3W6', 'customer', 'deleted'),
(2, '', 'Admin', 'Userz', 'admin@ninety6.com', '', '', '$2y$10$XCC/IBIyPmbn7.GT1.daUe93kJDTsR0UrP5A689z9LDT.gTDvwvqe', 'admin', 'active'),
(3, 'qaz', 'qaz', 'qaaq', 'qaaq@gmu.co', '', '', '', 'admin', 'deleted'),
(4, 'Chamatha', 'Chamathka', 'Nethmini', 'Chama@gmail.com', '123', '10230', '$2y$10$spnEl8UYxEG8imG6.HXRH.PXZz6akJBDlhdRgTSp.E5pd0KKV9em2', 'customer', 'active');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
