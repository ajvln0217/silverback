-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2023 at 01:43 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `silverback`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `cart_qty` int(11) NOT NULL,
  `cart_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(100) NOT NULL,
  `cat_index` varchar(100) NOT NULL,
  `cat_description` mediumtext NOT NULL,
  `cat_status` tinyint(4) NOT NULL DEFAULT 0,
  `cat_popular` tinyint(4) NOT NULL DEFAULT 0,
  `cat_image` varchar(100) NOT NULL,
  `cat_keywords` mediumtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`, `cat_index`, `cat_description`, `cat_status`, `cat_popular`, `cat_image`, `cat_keywords`, `created_at`) VALUES
(1, 'Gaming Chair', 'Gaming', 'For gamers who love to play more than hours.', 0, 1, 'Jupiter.png', 'Gaming', '2022-12-24 16:04:52'),
(2, 'Office Chair', 'Office', 'For people who works at home.', 0, 1, 'p1.png', 'Office Chair', '2022-12-26 06:05:15');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `tracking_no` varchar(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `total_price` decimal(7,2) NOT NULL,
  `payment_mode` varchar(100) NOT NULL,
  `payment_id` varchar(100) DEFAULT NULL,
  `order_status` tinyint(4) NOT NULL DEFAULT 0,
  `order_status1` tinyint(4) NOT NULL DEFAULT 0,
  `comments` varchar(200) DEFAULT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `oitem_id` int(11) NOT NULL,
  `order_id` int(100) NOT NULL,
  `prod_id` int(100) NOT NULL,
  `oitem_qty` int(100) NOT NULL,
  `oitem_price` decimal(7,2) NOT NULL,
  `oitem_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `prod_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `prod_name` varchar(50) NOT NULL,
  `prod_index` varchar(50) NOT NULL,
  `prod_description` mediumtext NOT NULL,
  `prod_price` decimal(7,2) NOT NULL,
  `prod_image` varchar(100) NOT NULL,
  `prod_img1` varchar(20) NOT NULL,
  `prod_img2` varchar(20) NOT NULL,
  `prod_img3` varchar(20) NOT NULL,
  `prod_qty` int(11) NOT NULL,
  `prod_status` tinyint(4) NOT NULL,
  `prod_trending` tinyint(4) NOT NULL,
  `prod_keywords` mediumtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`prod_id`, `cat_id`, `prod_name`, `prod_index`, `prod_description`, `prod_price`, `prod_image`, `prod_img1`, `prod_img2`, `prod_img3`, `prod_qty`, `prod_status`, `prod_trending`, `prod_keywords`, `created_at`) VALUES
(1, 1, 'Asteroid', 'Asteroid-Gaming-Chair', '- High quality PU\r\n- High quality molded foam cushion and\r\n  high-density primary foam backrest\r\n- Nylon base 350mm with color corresponding covers\r\n- Nylon moveable 2D armrests\r\n- 100mm class 3 gas lift with 3-layer cover\r\n  with footrest part \r\n- PU headrest & lumbar support\r\n- Nylon color-corresponding castor*5', '8000.00', 'Asteroid.png', 'Asteroid.png', 'Asteroid1.png', 'Asteroid3.png', 8, 0, 0, 'Gaming Chair, Black Chair, RGB', '2022-12-27 11:41:22'),
(2, 1, 'Jupiter', 'Jupiter-Gaming-Chair', '- High quality PU\r\n- High quality molded foam cushion and\r\n  high-density primary foam backrest\r\n- Nylon base 350mm with color corresponding covers\r\n- Nylon moveable 2D armrests\r\n- 100mm class 3 gas lift with 3-layer cover\r\n  with footrest part \r\n- PU headrest & lumbar support\r\n- Nylon color-corresponding castor*5', '6500.00', 'Jupiter.png', 'Jupiter.png', 'Jupiter1.png', 'Jupiter3.png', 8, 0, 1, 'Gaming Chair, Yellow Gaming Chair, NON-RGB', '2022-12-27 11:43:40'),
(3, 1, 'Mars', 'Mars-Gaming-Chair', '- High quality PU\r\n- High quality molded foam cushion and\r\n  high-density primary foam backrest\r\n- Nylon base 350mm with colorcorresponding covers\r\n- Nylon moveable 2D armrests\r\n- 100mm class 3 gas lift with 3-layer cover\r\n  with footrest part \r\n- PU headrest & lumbar support\r\n- Nylon color-corresponding castor*5', '6500.00', 'mars1.png', 'mars1.png', 'mars2.png', 'mars3.png', 8, 0, 1, 'Gaming Chair, Red Gaming Chair, NON-RGB', '2022-12-27 11:44:52'),
(4, 1, 'Mercury', ' Mercury-Gaming-Chair', '- High quality PU\r\n- High quality molded foam cushion and\r\n  high-density primary foam backrest\r\n- Nylon base 350mm with color corresponding covers\r\n- Nylon moveable 2D armrests\r\n- 100mm class 3 gas lift with 3-layer cover\r\n- Colorful LED light belt\r\n- PU headrest & lumbar support\r\n- Nylon color-corresponding castor*5', '8000.00', 'Mercury.png', 'Mercury.png', 'Mercury1.png', 'Mercury3.png', 8, 0, 1, 'White Gaming Chair, RGB, Gaming Chair', '2022-12-30 13:49:03'),
(5, 1, 'Pluto', ' Pluto-Gaming-Chair', '- High quality PU\r\n- High quality molded foam cushion and\r\n  high-density primary foam backrest\r\n- Nylon base 350mm with color corresponding covers\r\n- Nylon moveable 2D armrests\r\n- 100mm class 3 gas lift with 3-layer cover\r\n- With footrest part \r\n- PU headrest & lumbar support\r\n- Nylon color-corresponding castor*5', '6500.00', 'Pluto.png', 'Pluto.png', 'Pluto1.png', 'Pluto2.png', 8, 0, 1, 'Black Gaming Chair, NON-RGB, Gaming Chair', '2022-12-30 13:50:40'),
(6, 1, 'Uranus', ' Uranus-Gaming-Chair', '- High quality PU\r\n- High quality molded foam cushion and\r\n  high-density primary foam backrest\r\n- Nylon base 350mm with color corresponding covers\r\n- Nylon moveable 2D armrests\r\n- 100mm class 3 gas lift with 3-layer cover\r\n- With footrest part \r\n- PU headrest & lumbar support\r\n- Nylon color-corresponding castor*5', '6500.00', 'Uranus.png', 'Uranus.png', 'Uranus1.png', 'Uranus3.png', 8, 1, 0, 'Gaming Chair, NON-RGB, Black Gaming Chair', '2022-12-30 13:52:20'),
(7, 1, 'Venus', ' Venus-Gaming-Chair', '- High quality PU\r\n- High quality molded foam cushion and\r\n   high-density primary foam backrest\r\n- Nylon base 350mm with color corresponding covers\r\n- Nylon moveable 2D armrests\r\n- 100mm class 3 gas lift with 3-layer cover\r\n- Colorful LED light belt\r\n- PU headrest & lumbar support\r\n- Nylon color-corresponding castor*5', '8000.00', 'Venus.png', 'Venus.png', 'Venus1.png', 'Venus3.png', 8, 1, 0, 'Gaming Chair, Pink Chair, RGB', '2023-02-22 05:20:30'),
(8, 2, 'Office Chair Pink', ' Pink-Office-Chair', '- Original Thickness PVC\r\n- Adjustable armrest\r\n- 320mm metal base\r\n- Butterfly mechanism + footrest\r\n- Class 3 standard #80L\r\n- Recline 90°-130° molded Foam.\r\n- With LOGO', '5500.00', 'p1.png', 'p1.png', 'p3.png', 'p2.png', 8, 1, 0, 'Office Chair, Pink Chair', '2023-02-22 05:26:54'),
(9, 2, 'Office Chair Brown', ' Brown-Office-Chair', '- Original Thickness PVC\r\n- Adjustable armrest\r\n- 320mm metal base\r\n- Butterfly mechanism + footrest\r\n- Class 3 standard #80L\r\n- Recline 90°-130° molded Foam.\r\n- With LOGO', '5500.00', 'b1.png', 'b1.png', 'b2.png', 'b3.png', 8, 1, 0, 'Office Chair, Brown', '2023-02-22 05:33:50'),
(10, 2, 'Office Chair Black', ' Black-Office-Chair', '- Original Thickness PVC\r\n- Adjustable armrest\r\n- 320mm metal base\r\n- Butterfly mechanism + footrest\r\n- Class 3 standard #80L\r\n- Recline 90°-130° molded Foam.\r\n- With LOGO', '5500.00', 'bl1.png', 'bl1.png', 'bl2.png', 'bl3.png', 8, 0, 1, 'Office Chair, Black Chair', '2023-02-22 05:50:23'),
(11, 2, 'Office Chair White', ' White-Office-Chair', '- Original Thickness PVC\r\n- Adjustable armrest\r\n- 320mm metal base\r\n- Butterfly mechanism + footrest\r\n- Class 3 standard #80L\r\n- Recline 90°-130° molded Foam.\r\n- With LOGO', '5500.00', 'w1.png', 'w1.png', 'w2.png', 'w3.png', 8, 1, 0, 'Office Chair, White Chair', '2023-02-22 05:51:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `contactnum` varchar(12) NOT NULL,
  `birthday` date NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `region` varchar(50) NOT NULL,
  `zip` int(10) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `role` tinyint(4) NOT NULL DEFAULT 0,
  `token` varchar(40) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `lastactivity` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_email`, `user_password`, `fname`, `lname`, `contactnum`, `birthday`, `address`, `city`, `region`, `zip`, `image`, `role`, `token`, `created_at`, `lastactivity`) VALUES
(1, 'Admin', 'silverbackph.official@gmail.com', '123456', 'Super', 'Admin', '09123456789', '2002-02-17', 'Bagumbong Rd.', 'Caloocan City', 'Metro Manila', 1428, 'user.png', 1, '6dba6c0d74259ec1df26a5c246404a65', '2022-12-29 05:22:41', '2023-03-07 08:47:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`oitem_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`prod_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `oitem_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
