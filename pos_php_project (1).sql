-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2024 at 05:15 PM
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
-- Database: `pos_php_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `phone` varchar(14) NOT NULL,
  `password` varchar(191) NOT NULL,
  `active` tinyint(1) NOT NULL COMMENT '0=no_actice,1=active',
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `phone`, `password`, `active`, `created_at`) VALUES
(11, 'hubert hirwa', 'hhirwa1390@stu.kemu.ac.ke', '0781794795', '12345', 1, '2024-04-17'),
(12, 'hubert hirwa', 'stockmanager@gmail.com', '0781794795', '567u', 0, '2024-04-18'),
(13, 'new data', 'text@gmail.com', '54324432222', '123ewqaa', 0, '2024-05-06');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(10) NOT NULL,
  `name` varchar(191) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `status`) VALUES
(2, 'Hp refurbished proDesk 600g i5', 1),
(4, 'AILYONS FK-0301 Stainless Steel', 1),
(5, 'Ramtons Rw/115', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(10) NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `phone` varchar(14) NOT NULL,
  `active` tinyint(1) NOT NULL COMMENT '0=no_actice,1=active',
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `phone`, `active`, `created_at`) VALUES
(4, 'User php', 'cst123@gmail.com', '0781794795', 0, '2024-04-18'),
(5, 'new', '', '6756432', 1, '2024-04-24'),
(7, 'new test user', 'test.user@gmail.com', '345678', 1, '2024-05-08'),
(8, 'number', 'number@gmail.com', '3456789', 1, '2024-05-08');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `tracking_no` varchar(100) NOT NULL,
  `invoice_no` varchar(100) NOT NULL,
  `total_amount` varchar(100) NOT NULL,
  `order_date` date NOT NULL,
  `order_status` varchar(100) DEFAULT NULL,
  `payment_mode` varchar(100) NOT NULL,
  `order_placed_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `tracking_no`, `invoice_no`, `total_amount`, `order_date`, `order_status`, `payment_mode`, `order_placed_by`) VALUES
(1, 8, 'Track-96380', 'INV-890618', '3360', '2024-05-14', 'booked', 'cash_payment', 'hubert hirwa'),
(2, 7, 'Track-27076', 'INV-727162', '4080', '2024-05-14', 'booked', 'cash_payment', 'hubert hirwa'),
(3, 7, 'Track-52146', 'INV-154746', '300', '2024-05-14', 'booked', 'cash_payment', 'hubert hirwa'),
(4, 4, 'Track-43225', 'INV-226741', '300', '2024-05-14', 'booked', 'cash_payment', 'hubert hirwa'),
(5, 4, 'Track-64283-INV-689847', 'INV-689847', '2328', '2024-05-14', 'booked', 'cash_payment', 'hubert hirwa'),
(6, 4, 'Track-22724-INV-743609', 'INV-743609', '776', '2024-05-14', 'booked', 'cash_payment', 'hubert hirwa');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` varchar(100) NOT NULL,
  `quantity` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `price`, `quantity`) VALUES
(1, 1, 7, '1200', '2'),
(2, 1, 8, '120', '3'),
(3, 1, 9, '300', '2'),
(4, 2, 7, '1200', '3'),
(5, 2, 8, '120', '4'),
(6, 3, 9, '300', '1'),
(7, 4, 9, '300', '1'),
(8, 5, 10, '776', '3'),
(9, 6, 10, '776', '1');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) NOT NULL,
  `categ_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1=visible,0=non-visible',
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `categ_id`, `name`, `description`, `price`, `quantity`, `image`, `status`, `created_at`) VALUES
(7, 2, 'driver', 'none', 1200, 17, 'background.png', 1, '2024-04-19'),
(8, 2, 'second product', '', 120, 13, 'form_detai5.png', 1, '2024-04-22'),
(9, 2, 'the third product', '', 300, 16, 'hubert.png.jpg', 1, '2024-04-22'),
(10, 5, 'new data', 'none', 776, 16, 'Screenshot_51.png', 1, '2024-05-06');

-- --------------------------------------------------------

--
-- Table structure for table `temporary_card`
--

CREATE TABLE `temporary_card` (
  `id` int(10) NOT NULL,
  `user_ip` varchar(20) NOT NULL,
  `product_id` int(10) NOT NULL,
  `product_name` varchar(191) NOT NULL,
  `product_price` int(50) NOT NULL,
  `product_qty` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `temporary_card`
--

INSERT INTO `temporary_card` (`id`, `user_ip`, `product_id`, `product_name`, `product_price`, `product_qty`) VALUES
(14, '::1', 7, 'driver', 1200, 4),
(15, '::1', 9, 'the third product', 300, 7),
(16, '::1', 8, 'second product', 120, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temporary_card`
--
ALTER TABLE `temporary_card`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `temporary_card`
--
ALTER TABLE `temporary_card`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
