-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2017 at 03:32 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dimsum`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_date` datetime NOT NULL,
  `order_fullname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `order_address` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `order_phone` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_date`, `order_fullname`, `order_address`, `order_phone`) VALUES
(73, '2017-02-22 18:43:52', 'Varasak Ardsan', '4', '0838987141'),
(71, '2017-02-21 16:10:50', 'wq', 'w', '222'),
(72, '2017-02-21 20:34:15', 'vvc', 'cc', 'cvcvc'),
(70, '2017-02-21 14:12:09', 'ssss', 'ssss', 'ssss'),
(69, '2017-02-21 13:08:30', 'เจ้านางอนัญทิพย์', 'หอคำ', '1911'),
(68, '2017-02-21 01:47:57', 'มาช่า วัฒนพานิชย์', 'กทม', '0921312121'),
(67, '2017-02-21 01:46:31', 'อารยา เอ ฮาร์เก็ต', 'ช่อง 3', '090'),
(66, '2017-02-21 01:45:30', 'Varasak Ardsan', '4', '0838987141'),
(65, '2017-02-21 01:45:10', 'll', 'll', 'll'),
(64, '2017-02-21 01:43:28', 'q', 'q', '11'),
(63, '2017-02-21 01:42:57', 'ssa', 'ssa', '21'),
(62, '2017-02-21 01:41:08', 'Varasak Ardsan', '4', '0838987141'),
(61, '2017-02-21 01:39:36', 'อารยา เอ ฮาร์เก็ต', 'ช่อง 3', '0211110213');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_detail_quantity` tinyint(4) NOT NULL,
  `order_detail_price` decimal(10,2) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_detail_quantity`, `order_detail_price`, `product_id`, `order_id`) VALUES
(95, 1, '25.00', 6, 73),
(94, 1, '35.00', 1, 73),
(93, 1, '17.00', 3, 72),
(92, 3, '25.00', 6, 71),
(91, 1, '25.00', 6, 70),
(90, 1, '35.00', 5, 70),
(89, 1, '35.00', 4, 70),
(88, 1, '35.00', 5, 69),
(87, 1, '35.00', 4, 69),
(86, 1, '17.00', 3, 69),
(85, 1, '40.00', 11, 68),
(84, 4, '40.00', 8, 68),
(83, 1, '25.00', 6, 68),
(82, 1, '40.00', 2, 67),
(81, 1, '35.00', 1, 67),
(80, 1, '17.00', 3, 1),
(79, 1, '40.00', 2, 66),
(78, 1, '40.00', 2, 65),
(77, 1, '17.00', 3, 1),
(76, 1, '40.00', 2, 64),
(75, 1, '40.00', 11, 63),
(74, 13, '15.00', 12, 1),
(73, 1, '40.00', 11, 1),
(72, 1, '16.00', 10, 1),
(71, 2, '25.00', 6, 1),
(69, 1, '17.00', 3, 1),
(68, 1, '40.00', 2, 1),
(70, 3, '35.00', 5, 62);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_code` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `product_name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `product_img_name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `product_price` decimal(10,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_code`, `product_name`, `product_img_name`, `product_price`) VALUES
(1, 'DS01', 'ฮะเก๋า', 'm1.png', '35.00'),
(2, 'DS02', 'ขนมจีบกุ้ง', 'm2.png', '40.00'),
(3, 'DS03', 'เปาครีมลาวา', 'm3.png', '17.00'),
(4, 'DS04', 'ฝันโก๋ แต้จิ๋ว', 'm4.png', '35.00'),
(5, 'DS05', 'ก๋วยเตี๋ยวหลอด', 'm5.png', '35.00'),
(6, 'DS06', 'ขนมจีบหมูเห็ดหอม', 'm6.png', '25.00'),
(7, 'DS07', 'เสี่ยวหลงเปาเซี่ยงไฮ้', 'm7.png', '40.00'),
(8, 'DS08', 'สาหร่ายห่อกุ้ง', 'm8.png', '40.00'),
(9, 'DS09', 'เกี๋ยวทอด', 'm9.png', '15.00'),
(10, 'DS10', 'เปาลาวาไส้ชาเขียว', 'm10.png', '16.00'),
(11, 'DS11', 'ซี่โครงหมู', 'm11.png', '40.00'),
(12, 'DS12', 'เผือกทอด', 'm12.png', '15.00'),
(13, 'DS13', 'ขาไก่', 'm13.png', '40.00'),
(14, 'DS14', 'เปาลาวาไส้ช็อกโลแล็ต', 'm14.png', '16.00'),
(15, 'DS15', 'ฟองเต้าหู้น้ำมันหอย', 'm15.png', '40.00'),
(16, 'DS16', 'เปาลาวาไส้เผือก', 'm16.png', '16.00'),
(17, 'DM17', 'มาลัยโก๊ว', 'm17.png', '16.00'),
(18, 'DS18', 'เปาไส้ผัก', 'm18.png', '16.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_code` (`product_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
