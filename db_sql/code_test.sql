-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2021 at 08:48 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `code_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_user`
--

CREATE TABLE `admin_user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `number` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `login_key` varchar(255) DEFAULT NULL,
  `token_hidden` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updeted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_user`
--

INSERT INTO `admin_user` (`id`, `name`, `number`, `email`, `password`, `login_key`, `token_hidden`, `created_at`, `updeted_at`) VALUES
(1, 'Admin', '01911223344', 'admin@mail.com', '$2y$10$PQRIO2iQ40I3pfqLqBD5vuiwjm5f4u9UNug0vK324tkPIJy7JLHAm', 'EJ3R6gRJL3sFOZK8PdOo48moSPt6sKWpjqlZriPmHAn426Tsu7aLzvXQAmZl9l5NNGmM7iCNH3htTN4qRamNutwIud', 'adfadfasdfasdf', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Dhaka', NULL, NULL),
(2, 'Rajshahi', NULL, NULL),
(3, 'Chittagong', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_id` varchar(255) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `unit_count` int(11) NOT NULL DEFAULT 1,
  `discount_unit_price` float DEFAULT NULL,
  `unit_price` float DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1 COMMENT '1-submitted, 2-in transit,3-delivered',
  `pay_amount` float DEFAULT NULL,
  `order_time` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_id`, `customer_id`, `product_id`, `unit_count`, `discount_unit_price`, `unit_price`, `status`, `pay_amount`, `order_time`) VALUES
(1, 'pLrQXrFb', 10, 1, 1, 8.25, 11, 2, 8.25, '2021-03-21 16:55:58'),
(2, 'fr85shfC', 10, 2, 1, 0, 11, 2, 11, '2021-03-21 16:59:57'),
(3, 'XWEj6hJM', 10, 2, 1, 0, 11, 2, 11, '2021-03-21 17:00:01'),
(4, 'ojMB5gsv', 10, 2, 1, 0, 11, 2, 11, '2021-03-21 17:00:09'),
(5, 'Ra9BO6TU', NULL, 1, 1, 0, 11, 1, 11, '2021-03-21 19:35:45'),
(6, '6mmfDHt3', 10, 1, 1, 8.25, 11, 1, 8.25, '2021-03-21 19:36:09'),
(7, 'TDhDo3LA', 10, 2, 1, 0, 11, 1, 11, '2021-03-21 19:36:13');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `unit_price` float NOT NULL,
  `location` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `unit_price`, `location`, `created_at`, `updated_at`) VALUES
(1, 'mini shampo', 11, 1, NULL, NULL),
(2, 'Mengo', 11, 3, '2021-03-21 12:58:11', '2021-03-21 12:58:11');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `login_key` varchar(255) DEFAULT NULL,
  `token_hidden` varchar(255) DEFAULT NULL,
  `location` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `number`, `email`, `password`, `login_key`, `token_hidden`, `location`, `created_at`, `updated_at`) VALUES
(10, 'roman', '01721704552', 'romansyed007@gmail.com', '$2y$10$3mBFM56V96GBUFGEQAH/Wuzl4jMbPaVZyJjV3HAEPRHu1SkTSe7NG', 'PX8sKYCvQk54MFnNlPXKLddUJYSqCbgNYKDCj1ifPzdX97F1QUvVWbfgorLkDxA11CT7CYJxkG8segHlDPNcDAL23h', NULL, 1, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_user`
--
ALTER TABLE `admin_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cus_order` (`customer_id`),
  ADD KEY `product_order` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_location` (`location`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uaer_location` (`location`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_user`
--
ALTER TABLE `admin_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `cus_order` FOREIGN KEY (`customer_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_order` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_location` FOREIGN KEY (`location`) REFERENCES `location` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `uaer_location` FOREIGN KEY (`location`) REFERENCES `location` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
