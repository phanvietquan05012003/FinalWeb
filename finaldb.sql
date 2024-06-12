-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2024 at 04:42 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `finaldb`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `author` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `author`, `name`, `price`, `image`) VALUES
(66, 'Akira Toriyama', 'Dragon Ball - Tập 8', 1, 'uploads/dragon-ball-super---tap-8.jpg'),
(67, 'Akira Toriyama', 'Dragon Ball - Tập 16', 1, 'uploads/dragon-ball-super---tap-16.jpg'),
(68, 'Masashi Kishimoto', 'Naruto tập - 35', 2, 'uploads/naruto35.jpg'),
(69, 'Masashi Kishimoto', 'Naruto tập - 52', 2, 'uploads/naruto 52.jpg'),
(70, 'Phan Viết Quân', 'Onepiece - Tập 5', 3, 'uploads/onepiece 5.jpg'),
(71, 'Phan Viết Quân', 'Onepiece - Tập 37', 3, 'uploads/onepiece 37.jpg'),
(72, 'Eiichiro Oda', 'Onepiece - Tập 41', 3, 'uploads/onepiece 41.jpg'),
(73, 'Eiichiro Oda', 'Onepiece - Tập 57', 3, 'uploads/onepiece 57.jpg'),
(74, 'Eiichiro Oda', 'Onepiece - Tập 90', 3, 'uploads/onepiece 90.jpg'),
(75, 'Eiichiro Oda', 'Onepiece - Tập 91', 3, 'uploads/onepiece 91.jpg'),
(76, 'Eiichiro Oda', 'Onepiece - Tập 99', 3, 'uploads/onepiece 99.jpg'),
(77, 'Yoshito Usui', 'Shin - Tập 25', 4, 'uploads/shin tap 25.jpg'),
(78, 'Yoshito Usui', 'Shin - Tập 46', 4, 'uploads/shin tap 46.jpg'),
(79, 'Gosho Aoyama', 'Conan - Tập 6', 5, 'uploads/tap6.jpg'),
(80, 'Gosho Aoyama', 'Conan - Tập 35', 5, 'uploads/tap35.jpg'),
(81, 'Gosho Aoyama', 'Conan - Tập 55', 5, 'uploads/tap55.jpg'),
(82, 'Gosho Aoyama', 'Conan - Tập 97', 5, 'uploads/tap97.jpg'),
(83, 'Fujiko F. Fujio', 'Doremon - Tập 11', 6, 'uploads/vol11.jpg'),
(84, 'Fujiko F. Fujio', 'Doremon - Tập 21', 6, 'uploads/vol21.jpg'),
(85, 'Fujiko F. Fujio', 'Doremon - Tập 18', 6, 'uploads/vol18.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`) VALUES
(14, 'Hiền Nguyễn', 'hiennguyen@gmail.com', '123456789', 'user'),
(15, 'Hòe Đặng', 'hoedang@gmail.com', '123456789', 'user'),
(16, 'Mạnh Hùng', 'manhhung@gmail.com', '123456789', 'user'),
(17, 'Phan Viết Quân', 'phanquan@gmail.com', '123456789', 'user'),
(18, 'Phúc Đỗ', 'phucdo@gmail.com', '123456789', 'user'),
(19, 'admin', 'admin@gmail.com', 'admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
