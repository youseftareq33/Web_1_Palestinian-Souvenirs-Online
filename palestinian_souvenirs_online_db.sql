-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2024 at 01:56 PM
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
-- Database: `palestinian_souvenirs_online_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(12) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_dob` date NOT NULL,
  `customer_id_number` varchar(255) NOT NULL,
  `customer_country` varchar(255) NOT NULL,
  `customer_city` varchar(255) NOT NULL,
  `customer_street` varchar(255) NOT NULL,
  `customer_house_no` int(11) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_telephone` varchar(255) NOT NULL,
  `customer_cc_number` varchar(255) NOT NULL,
  `customer_cc_expiration_date` date NOT NULL,
  `customer_cc_name` varchar(255) NOT NULL,
  `customer_cc_bank` varchar(255) NOT NULL,
  `customer_username` varchar(255) NOT NULL,
  `customer_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `customer_dob`, `customer_id_number`, `customer_country`, `customer_city`, `customer_street`, `customer_house_no`, `customer_email`, `customer_telephone`, `customer_cc_number`, `customer_cc_expiration_date`, `customer_cc_name`, `customer_cc_bank`, `customer_username`, `customer_password`) VALUES
(1000000000, 'yousef', '2002-09-19', '1202057', 'Palestinian Authority', 'Ramallah', 'henri', 12, 'yousef@gmail.com', '0597714891', '123456789', '2024-02-16', 'Visa', 'Arabi', 'yousef123', '123456789'),
(1000000001, 'ahmad', '2003-09-02', '1223456', 'Palestinian Authority', 'Ramallah', 'yaffa', 6, 'ahmad@gmail.com', '056635467', '1234569', '2024-02-28', 'Visa', 'palestain', 'ahmad123', '123456789'),
(1000000002, 'YousefSharbi', '2002-09-19', '120222222', 'Palestinian Authority', 'Ramallah', 'henri', 2, 'yousef@gmail.com', '0597714891', '123456789', '2024-07-25', 'Visa', 'Arabi', 'yousef_sharbi', '123456789');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` int(11) NOT NULL,
  `employee_username` varchar(255) NOT NULL,
  `employee_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `employee_username`, `employee_password`) VALUES
(1, 'mohammad', '123456789'),
(2, 'admin1', '123456789');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `order_total_amount` double NOT NULL,
  `order_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `product_id`, `customer_id`, `order_date`, `order_total_amount`, `order_status`) VALUES
(1, 1000000000, 1000000000, '2024-02-03', 6000, 'Shipping'),
(2, 1000000001, 1000000002, '2024-07-17', 1500, 'Shipping');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_category` varchar(255) NOT NULL,
  `product_price` double NOT NULL,
  `product_size` int(11) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_remarks` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_description`, `product_category`, `product_price`, `product_size`, `product_quantity`, `product_remarks`, `product_image`) VALUES
(1000000000, 'HandCraft', 'palestinian made', 'On Sale', 120, 500, 300, 'good', 'item1000000000img1.gif'),
(1000000001, 'Decorated plate', 'palestinian made', 'High Demand', 30, 20, 50, 'good', 'item1000000001img1.gif'),
(1000000002, 'Rugs', 'palestinian made', 'Normal', 50, 60, 80, 'good', 'item1000000002img1.gif'),
(1000000003, 'Coffee Mug', 'palestinian made', 'On Sale', 30, 10, 40, 'good', 'item1000000003img1.gif'),
(1000000004, 'palestine T-Shirt', 'palestinian made', 'Featured', 50, 32, 60, 'good', 'item1000000004img1.gif'),
(1000000005, 'palestine Hoodie', 'palestinian made', 'High Demand', 60, 32, 100, 'good', 'item1000000005img1.gif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000000003;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000000006;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
