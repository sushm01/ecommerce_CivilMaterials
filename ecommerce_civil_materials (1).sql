-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2025 at 06:26 AM
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
-- Database: `ecommerce_civil_materials`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_to_cart`
--

CREATE TABLE `add_to_cart` (
  `id` int(100) NOT NULL,
  `user_id` varchar(250) NOT NULL,
  `product_id` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `add_to_wishlist`
--

CREATE TABLE `add_to_wishlist` (
  `id` int(100) NOT NULL,
  `user_id` varchar(250) NOT NULL,
  `product_id` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `add_to_wishlist`
--

INSERT INTO `add_to_wishlist` (`id`, `user_id`, `product_id`) VALUES
(6, '28', '110'),
(10, '29', '107');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin@');

-- --------------------------------------------------------

--
-- Table structure for table `brand_master`
--

CREATE TABLE `brand_master` (
  `id` int(50) NOT NULL,
  `brand_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brand_master`
--

INSERT INTO `brand_master` (`id`, `brand_name`) VALUES
(1, 'Birla'),
(2, 'TATA '),
(3, 'JSW');

-- --------------------------------------------------------

--
-- Table structure for table `cart_detail`
--

CREATE TABLE `cart_detail` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `fi_name` varchar(150) NOT NULL,
  `ls_name` varchar(150) NOT NULL,
  `email_add` varchar(150) NOT NULL,
  `phone_no` varchar(20) NOT NULL,
  `address_house` varchar(150) NOT NULL,
  `address_appartment` varchar(150) NOT NULL,
  `town` varchar(150) NOT NULL,
  `state` varchar(150) NOT NULL,
  `pincode` int(10) NOT NULL,
  `note` varchar(300) NOT NULL,
  `cart_subtotal` double(10,2) NOT NULL,
  `shipping` double(10,2) NOT NULL,
  `handling` double(10,2) NOT NULL,
  `order_total` double(10,2) NOT NULL,
  `payment_method` varchar(100) NOT NULL,
  `curr_date` date NOT NULL,
  `curr_time` varchar(50) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'confirm'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart_detail`
--

INSERT INTO `cart_detail` (`id`, `user_id`, `fi_name`, `ls_name`, `email_add`, `phone_no`, `address_house`, `address_appartment`, `town`, `state`, `pincode`, `note`, `cart_subtotal`, `shipping`, `handling`, `order_total`, `payment_method`, `curr_date`, `curr_time`, `status`) VALUES
(18, 28, 'sushmita', 'chavan', 'sushmarathod25@gmail.com', '7760017131', 'Near station road', 'Apartment 01', 'Bijapure', 'Karnataka', 586101, 'Good', 200.00, 10.00, 5.00, 215.00, '', '2024-10-04', '16:03:53', 'confirmed'),
(19, 28, 'sushmita', 'chavan', 'sushmarathod25@gmail.com', '9878765656', 'Near station road', 'Apartment 01', 'Bijapure', 'Karnataka', 586101, 'Very good', 2500.00, 10.00, 5.00, 2515.00, '', '2024-10-04', '16:17:16', 'confirmed'),
(22, 28, 'sushma', 'rathod', 'sushmarathod25@gmail.com', '9874512456', 'near station road', 'apartment 1', 'bijapure', 'karnataka', 586101, 'good', 650.00, 10.00, 5.00, 665.00, '', '2024-10-05', '13:26:16', 'confirmed');

-- --------------------------------------------------------

--
-- Table structure for table `cart_product_detail`
--

CREATE TABLE `cart_product_detail` (
  `id` int(100) NOT NULL,
  `cart_detail_id` int(100) NOT NULL,
  `product_id` int(100) NOT NULL,
  `resgister_id` int(100) NOT NULL,
  `product` varchar(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `amount` double(10,2) NOT NULL,
  `order_status` varchar(100) NOT NULL DEFAULT 'ordering'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart_product_detail`
--

INSERT INTO `cart_product_detail` (`id`, `cart_detail_id`, `product_id`, `resgister_id`, `product`, `quantity`, `amount`, `order_status`) VALUES
(31, 18, 105, 30, 'Ordinary Portland Cement', 1, 150.00, 'ordered'),
(32, 18, 107, 30, 'Fly Cement Bricks ', 1, 50.00, 'ordered'),
(33, 19, 108, 31, 'Stainless Steel', 1, 2500.00, 'ordered'),
(36, 22, 110, 31, 'Square Steel', 1, 500.00, 'ordered'),
(37, 22, 105, 30, 'Ordinary Portland Cement', 1, 150.00, 'ordered');

-- --------------------------------------------------------

--
-- Table structure for table `category_master`
--

CREATE TABLE `category_master` (
  `id` int(20) NOT NULL,
  `category_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category_master`
--

INSERT INTO `category_master` (`id`, `category_name`) VALUES
(1, 'Steel'),
(2, 'Cement '),
(5, 'Binding wires'),
(6, 'Bricks');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(50) NOT NULL,
  `ms_brand_id` int(100) NOT NULL,
  `ms_category_id` int(100) NOT NULL,
  `ms_size_id` int(100) NOT NULL,
  `product_name` varchar(130) NOT NULL,
  `product_image` varchar(250) NOT NULL,
  `product_quantity` int(150) NOT NULL,
  `product_price` double(10,2) NOT NULL,
  `product_amount` double(10,5) NOT NULL,
  `registration_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `ms_brand_id`, `ms_category_id`, `ms_size_id`, `product_name`, `product_image`, `product_quantity`, `product_price`, `product_amount`, `registration_id`) VALUES
(104, 1, 6, 10, 'Design Red Bricks', 'vendor_upload/IMG-2024_08.jpg', 50, 50.00, 2500.00000, 30),
(105, 2, 2, 7, 'Ordinary Portland Cement', 'vendor_upload/IMG-2024_05.jpg', 5, 150.00, 750.00000, 30),
(107, 3, 6, 10, 'Fly Cement Bricks ', 'vendor_upload/IMG-2024_03.jpg', 100, 50.00, 5000.00000, 30),
(108, 1, 1, 8, 'Stainless Steel', 'vendor_upload/IMG-2024_04.jpg', 20, 2500.00, 50000.00000, 31),
(109, 2, 2, 9, 'Ordinary Portland Cement', 'vendor_upload/IMG-2024_06.jpg', 60, 250.00, 15000.00000, 31),
(110, 1, 1, 6, 'Square Steel', 'vendor_upload/IMG-2024_02.jpg', 40, 500.00, 20000.00000, 31),
(111, 2, 2, 9, 'Ordinary Portland Cement', 'vendor_upload/IMG-2024_01.jpg', 80, 350.00, 28000.00000, 31),
(112, 2, 6, 10, 'Red Bricks', 'vendor_upload/IMG-2024_09.jpg', 200, 99.00, 19800.00000, 31),
(114, 2, 1, 6, 'Mild Steel', 'vendor_upload/IMG-2024_07.jpg', 5, 1500.00, 7500.00000, 30);

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int(100) NOT NULL,
  `fname` varchar(250) NOT NULL,
  `account_type` varchar(100) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile_no` varchar(20) NOT NULL,
  `address` varchar(250) NOT NULL,
  `curr_date` date NOT NULL,
  `curr_time` varchar(50) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'confirm '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `fname`, `account_type`, `password`, `email`, `mobile_no`, `address`, `curr_date`, `curr_time`, `status`) VALUES
(28, 'Sushma Rathod', 'User', 'Sushma@2000', 'sushmarathod25@gmail.com', '7760017131', 'Bijapure, Karnataka ', '2024-08-23', '08:20:34', 'confirmed'),
(29, 'sushma rathod', 'User', 'Sush@2000', 'rathodsushma121@gmail.com', '7760017131', 'Bijapure, Karnataka ', '2024-08-23', '08:22:30', 'confirmed'),
(30, 'Shahista Patel', 'Vendor', 'Shahista@12', 'shahista2apatel@gmail.com', '8867984425', 'Bijapure, Karnataka ', '2024-08-23', '08:24:31', 'confirmed'),
(31, 'Waheeda PM', 'Vendor', 'Waheeda@09', 'waheeda.akkalkot@gmail.com', '7456783626', 'Bijapure, Karnataka ', '2024-08-23', '08:26:44', 'confirmed'),
(38, 'varsha s', 'User', 'Varsha@123', 'varshachikkmathv@gmail.com', '8217341253', 'belagavi', '2024-10-05', '08:37:20', 'confirmed'),
(39, 'sushma s', 'Vendor', 'Sushma@1234', 'sushmarathod090@gmail.com', '9784561254', 'NEAR station road', '2024-10-05', '09:49:15', 'confirmed');

-- --------------------------------------------------------

--
-- Table structure for table `size_master`
--

CREATE TABLE `size_master` (
  `id` int(30) NOT NULL,
  `size` varchar(35) NOT NULL,
  `category_id` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `size_master`
--

INSERT INTO `size_master` (`id`, `size`, `category_id`) VALUES
(6, '55mm', '1'),
(7, '50kg', '2'),
(8, '25mm', '5'),
(9, '150kg', '2'),
(10, '190mm', '6');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id` int(40) NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `image`) VALUES
(27, 'cement1.jpg'),
(28, 'steels.jpg'),
(29, 'binding_wires.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_to_cart`
--
ALTER TABLE `add_to_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `add_to_wishlist`
--
ALTER TABLE `add_to_wishlist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand_master`
--
ALTER TABLE `brand_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart_detail`
--
ALTER TABLE `cart_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart_product_detail`
--
ALTER TABLE `cart_product_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_master`
--
ALTER TABLE `category_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `size_master`
--
ALTER TABLE `size_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add_to_cart`
--
ALTER TABLE `add_to_cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `add_to_wishlist`
--
ALTER TABLE `add_to_wishlist`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brand_master`
--
ALTER TABLE `brand_master`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `cart_detail`
--
ALTER TABLE `cart_detail`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `cart_product_detail`
--
ALTER TABLE `cart_product_detail`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `category_master`
--
ALTER TABLE `category_master`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `size_master`
--
ALTER TABLE `size_master`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
