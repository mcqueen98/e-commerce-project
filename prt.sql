-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2024 at 09:06 AM
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
-- Database: `prt`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `username`, `password`) VALUES
(1, 'cms@gmail.com', 'admin', '$2y$10$xHNtVT1W7epP.NmbYBOPK.I9.HyT6gqnkeL9p6zEU5Ad3iSwd.RiO');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brandid` int(10) NOT NULL,
  `brandname` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brandid`, `brandname`) VALUES
(1, 'jio'),
(2, 'ncell');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(110) NOT NULL,
  `product_id` varchar(100) NOT NULL,
  `product_title` varchar(100) NOT NULL,
  `product_price` varchar(100) NOT NULL,
  `quantity` varchar(100) NOT NULL,
  `ip` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `catid` int(10) NOT NULL,
  `title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`catid`, `title`) VALUES
(1, 'necklace\r\n'),
(2, 'hat'),
(3, 'glassess'),
(4, 'bracelet'),
(5, 'earings'),
(6, 'ring');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `amount` int(110) NOT NULL,
  `total_pro` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `product_id` varchar(100) NOT NULL,
  `cart_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `amount`, `total_pro`, `status`, `date`, `product_id`, `cart_id`) VALUES
(1, '1', 800, '2', 'completed', '2024-11-30', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `mode` varchar(100) NOT NULL,
  `o_id` varchar(100) NOT NULL,
  `amount` int(199) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `contact`, `address`, `mode`, `o_id`, `amount`) VALUES
(1, '1111111111', '22222222222222', 'bank_transfer', '1', 800);

-- --------------------------------------------------------

--
-- Table structure for table `pending`
--

CREATE TABLE `pending` (
  `id` int(11) NOT NULL,
  `pro_id` varchar(110) NOT NULL,
  `quantity` int(110) NOT NULL,
  `amount` int(110) NOT NULL,
  `product_id` varchar(100) NOT NULL,
  `user_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pending`
--

INSERT INTO `pending` (`id`, `pro_id`, `quantity`, `amount`, `product_id`, `user_id`) VALUES
(1, '1', 2, 800, '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_des` text NOT NULL,
  `price` int(100) NOT NULL,
  `category_id` varchar(100) NOT NULL,
  `brand_id` varchar(100) NOT NULL,
  `states` varchar(100) NOT NULL,
  `product_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_title`, `product_des`, `price`, `category_id`, `brand_id`, `states`, `product_img`) VALUES
(1, 'white and emerald necklace', 'Material: Premium pearl blend .\r\nDesign: Modern, sleek design with an adjustable strap for a perfect fit.\r\nFeatures: Lightweight, sweat-resistant, and available in emerald colors to match your style.\r\nSize: One size fits most.', 800, '1', '', 'new', '674aba90cd29c.png'),
(2, 'white hat', 'Material: Premium cotton blend or [material specifics].\r\nDesign: Modern, sleek design with an adjustable strap for a perfect fit.\r\nFeatures: Lightweight, sweat-resistant, and available in multiple colors to match your style.\r\nSize: One size fits most (adjustable).\r\nStay stylish and protected from the sun while making a bold fashion statement. Get yours now and complete your look effortlessly!', 900, '2', '1', 'out', '674ac4a47e3bf.jpg'),
(3, 'star earing', 'Material: Premium metal blend .\r\nDesign: Modern, sleek design with a perfect fit.\r\nFeatures: Lightweight, sweat-resistant, and available in star shape to suit your style.\r\n', 700, '5', '1', 'default', '674ac6806f08c.jpg'),
(4, 'sapphire ring', 'Material: Premium gem blend .\r\nDesign: Modern, sleek design with  a perfect fit.\r\nFeatures: Lightweight, sweat-resistant, and available in blue colors to match your style.\r\n', 500, '6', '1', 'default', '674ac741d807c.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(110) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_ip` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_email`, `password`, `user_ip`) VALUES
(1, 'aa', 'cms@gmail.com', '$2y$10$qxFi3FJHZYkwfAT0EWxTUeDydfPe7DlslXl5tnxGwAl0lD9jT8DPa', '::1_aa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brandid`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`catid`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pending`
--
ALTER TABLE `pending`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brandid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(110) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `catid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pending`
--
ALTER TABLE `pending`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(110) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
