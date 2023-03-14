-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2023 at 01:11 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

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
(1, 'Gaming Chairs', 'Gaming', 'For gamers who love to play more than hours.', 0, 1, 'Jupiter.png', 'Gaming', '2022-12-24 16:04:52'),
(2, 'Office Chairs', 'Office', 'For people who works at home.', 0, 1, 'p1.png', 'Office Chair', '2022-12-26 06:05:15');

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

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `tracking_no`, `user_id`, `total_price`, `payment_mode`, `payment_id`, `order_status`, `order_status1`, `comments`, `order_date`) VALUES
(1, 'SLVRBCK-10001382784931', 2, '8000.00', 'COD', NULL, 2, 1, NULL, '2023-01-09 01:15:12'),
(2, 'SLVRBCK-1000396750414', 3, '6500.00', 'COD', NULL, 2, 1, NULL, '2023-01-13 07:15:00'),
(3, 'SLVRBCK-10001931639338', 4, '6500.00', 'COD', NULL, 2, 1, NULL, '2023-01-20 03:30:19'),
(4, 'SLVRBCK-1000586395552', 5, '8000.00', 'COD', NULL, 2, 1, NULL, '2023-01-21 02:32:03'),
(5, 'SLVRBCK-100049770736', 6, '6500.00', 'COD', NULL, 2, 1, NULL, '2023-01-21 11:12:34'),
(6, 'SLVRBCK-1000134667413', 7, '6500.00', 'COD', NULL, 2, 1, NULL, '2023-01-27 09:13:03'),
(7, 'SLVRBCK-10001314414375', 8, '8000.00', 'COD', NULL, 2, 1, NULL, '2023-01-28 13:43:28'),
(8, 'SLVRBCK-10001939516977', 9, '5500.00', 'COD', NULL, 2, 1, NULL, '2023-02-03 04:04:22'),
(9, 'SLVRBCK-1000929920459', 10, '5500.00', 'COD', NULL, 2, 1, NULL, '2023-02-09 01:57:44'),
(10, 'SLVRBCK-1000477503541', 11, '5500.00', 'COD', NULL, 2, 1, NULL, '2023-02-13 05:11:06'),
(11, 'SLVRBCK-10001509110895', 12, '5500.00', 'COD', NULL, 2, 1, NULL, '2023-02-14 04:35:25'),
(12, 'SLVRBCK-1000297947827', 13, '8000.00', 'COD', NULL, 2, 1, NULL, '2023-02-15 07:35:43'),
(13, 'SLVRBCK-1000501717852', 14, '6500.00', 'COD', NULL, 2, 1, NULL, '2023-02-16 08:36:00'),
(14, 'SLVRBCK-10001244581420', 15, '6500.00', 'COD', NULL, 2, 1, NULL, '2023-02-17 09:17:17'),
(15, 'SLVRBCK-10001382167910', 16, '8000.00', 'COD', NULL, 2, 1, NULL, '2023-03-06 07:27:03'),
(16, 'SLVRBCK-1000320361719', 17, '6500.00', 'COD', NULL, 2, 1, NULL, '2023-03-07 03:07:45'),
(17, 'SLVRBCK-10001945383589', 18, '6500.00', 'COD', NULL, 2, 1, NULL, '2023-03-08 11:48:07'),
(18, 'SLVRBCK-1000573347095', 19, '8000.00', 'COD', NULL, 2, 1, NULL, '2023-03-09 07:49:13'),
(19, 'SLVRBCK-1000878935413', 20, '5500.00', 'COD', NULL, 2, 1, NULL, '2023-03-10 02:28:47'),
(20, 'SLVRBCK-1000124348531', 21, '5500.00', 'COD', NULL, 2, 1, NULL, '2023-03-11 00:09:24'),
(21, 'SLVRBCK-100094033439', 22, '5500.00', 'COD', NULL, 2, 1, NULL, '2023-03-13 08:42:09'),
(22, 'SLVRBCK-100099370896', 23, '8000.00', 'COD', NULL, 2, 1, NULL, '2023-03-14 12:05:53'),
(23, 'SLVRBCK-100031627712', 24, '6500.00', 'COD', NULL, 2, 1, NULL, '2023-03-14 12:06:20'),
(24, 'SLVRBCK-10001596220181', 25, '6500.00', 'COD', NULL, 2, 1, NULL, '2023-03-14 12:06:40'),
(25, 'SLVRBCK-10001472184824', 26, '8000.00', 'COD', NULL, 2, 1, NULL, '2023-03-14 12:06:59');

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

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`oitem_id`, `order_id`, `prod_id`, `oitem_qty`, `oitem_price`, `oitem_date`) VALUES
(1, 1, 1, 1, '8000.00', '2023-01-09 01:15:12'),
(2, 2, 2, 1, '6500.00', '2023-01-13 07:15:00'),
(3, 3, 3, 1, '6500.00', '2023-01-20 03:30:19'),
(4, 4, 4, 1, '8000.00', '2023-01-21 02:32:03'),
(5, 5, 5, 1, '6500.00', '2023-01-21 11:12:34'),
(6, 6, 6, 1, '6500.00', '2023-01-27 09:13:03'),
(7, 7, 7, 1, '8000.00', '2023-01-28 13:43:28'),
(8, 8, 8, 1, '5500.00', '2023-02-03 04:04:22'),
(9, 9, 9, 1, '5500.00', '2023-02-09 01:57:44'),
(10, 10, 10, 1, '5500.00', '2023-02-13 05:11:06'),
(11, 11, 11, 1, '5500.00', '2023-02-14 04:35:25'),
(12, 12, 1, 1, '8000.00', '2023-02-15 07:35:43'),
(13, 13, 2, 1, '6500.00', '2023-02-16 08:36:00'),
(14, 14, 3, 1, '6500.00', '2023-02-17 17:17:17'),
(15, 15, 4, 1, '8000.00', '2023-03-06 07:27:03'),
(16, 16, 5, 1, '6500.00', '2023-03-07 03:07:45'),
(17, 17, 6, 1, '6500.00', '2023-03-08 11:48:07'),
(18, 18, 7, 1, '8000.00', '2023-03-09 07:49:13'),
(19, 19, 8, 1, '5500.00', '2023-03-10 02:28:47'),
(20, 20, 9, 1, '5500.00', '2023-03-11 00:09:24'),
(21, 21, 10, 1, '5500.00', '2023-03-13 08:42:09'),
(22, 22, 1, 2, '8000.00', '2023-03-14 11:54:12'),
(23, 22, 1, 1, '8000.00', '2023-03-14 12:05:53'),
(24, 23, 2, 1, '6500.00', '2023-03-14 12:06:20'),
(25, 24, 3, 1, '6500.00', '2023-03-14 12:06:40'),
(26, 25, 4, 1, '8000.00', '2023-03-14 12:06:59');

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
(1, 1, 'Asteroid', 'Asteroid-Gaming-Chair', '- High quality PU\r\n- High quality molded foam cushion and\r\n  high-density primary foam backrest\r\n- Nylon base 350mm with color corresponding covers\r\n- Nylon moveable 2D armrests\r\n- 100mm class 3 gas lift with 3-layer cover\r\n  with footrest part \r\n- PU headrest & lumbar support\r\n- Nylon color-corresponding castor*5', '8000.00', 'Asteroid.png', 'Asteroid.png', 'Asteroid1.png', 'Asteroid3.png', 5, 0, 0, 'Gaming Chair, Black Chair, RGB', '2022-12-27 11:41:22'),
(2, 1, 'Jupiter', 'Jupiter-Gaming-Chair', '- High quality PU\r\n- High quality molded foam cushion and\r\n  high-density primary foam backrest\r\n- Nylon base 350mm with color corresponding covers\r\n- Nylon moveable 2D armrests\r\n- 100mm class 3 gas lift with 3-layer cover\r\n  with footrest part \r\n- PU headrest & lumbar support\r\n- Nylon color-corresponding castor*5', '6500.00', 'Jupiter.png', 'Jupiter.png', 'Jupiter1.png', 'Jupiter3.png', 5, 0, 1, 'Gaming Chair, Yellow Gaming Chair, NON-RGB', '2022-12-27 11:43:40'),
(3, 1, 'Mars', 'Mars-Gaming-Chair', '- High quality PU\r\n- High quality molded foam cushion and\r\n  high-density primary foam backrest\r\n- Nylon base 350mm with colorcorresponding covers\r\n- Nylon moveable 2D armrests\r\n- 100mm class 3 gas lift with 3-layer cover\r\n  with footrest part \r\n- PU headrest & lumbar support\r\n- Nylon color-corresponding castor*5', '6500.00', 'mars1.png', 'mars1.png', 'mars2.png', 'mars3.png', 5, 0, 1, 'Gaming Chair, Red Gaming Chair, NON-RGB', '2022-12-27 11:44:52'),
(4, 1, 'Mercury', ' Mercury-Gaming-Chair', '- High quality PU\r\n- High quality molded foam cushion and\r\n  high-density primary foam backrest\r\n- Nylon base 350mm with color corresponding covers\r\n- Nylon moveable 2D armrests\r\n- 100mm class 3 gas lift with 3-layer cover\r\n- Colorful LED light belt\r\n- PU headrest & lumbar support\r\n- Nylon color-corresponding castor*5', '8000.00', 'Mercury.png', 'Mercury.png', 'Mercury1.png', 'Mercury3.png', 5, 0, 1, 'White Gaming Chair, RGB, Gaming Chair', '2022-12-30 13:49:03'),
(5, 1, 'Pluto', ' Pluto-Gaming-Chair', '- High quality PU\r\n- High quality molded foam cushion and\r\n  high-density primary foam backrest\r\n- Nylon base 350mm with color corresponding covers\r\n- Nylon moveable 2D armrests\r\n- 100mm class 3 gas lift with 3-layer cover\r\n- With footrest part \r\n- PU headrest & lumbar support\r\n- Nylon color-corresponding castor*5', '6500.00', 'Pluto.png', 'Pluto.png', 'Pluto1.png', 'Pluto2.png', 6, 0, 1, 'Black Gaming Chair, NON-RGB, Gaming Chair', '2022-12-30 13:50:40'),
(6, 1, 'Uranus', ' Uranus-Gaming-Chair', '- High quality PU\r\n- High quality molded foam cushion and\r\n  high-density primary foam backrest\r\n- Nylon base 350mm with color corresponding covers\r\n- Nylon moveable 2D armrests\r\n- 100mm class 3 gas lift with 3-layer cover\r\n- With footrest part \r\n- PU headrest & lumbar support\r\n- Nylon color-corresponding castor*5', '6500.00', 'Uranus.png', 'Uranus.png', 'Uranus1.png', 'Uranus3.png', 6, 1, 0, 'Gaming Chair, NON-RGB, Black Gaming Chair', '2022-12-30 13:52:20'),
(7, 1, 'Venus', ' Venus-Gaming-Chair', '- High quality PU\r\n- High quality molded foam cushion and\r\n   high-density primary foam backrest\r\n- Nylon base 350mm with color corresponding covers\r\n- Nylon moveable 2D armrests\r\n- 100mm class 3 gas lift with 3-layer cover\r\n- Colorful LED light belt\r\n- PU headrest & lumbar support\r\n- Nylon color-corresponding castor*5', '8000.00', 'Venus.png', 'Venus.png', 'Venus1.png', 'Venus3.png', 6, 1, 0, 'Gaming Chair, Pink Chair, RGB', '2023-02-22 05:20:30'),
(8, 2, 'Office Chair Pink', ' Pink-Office-Chair', '- Original Thickness PVC\r\n- Adjustable armrest\r\n- 320mm metal base\r\n- Butterfly mechanism + footrest\r\n- Class 3 standard #80L\r\n- Recline 90°-130° molded Foam.\r\n- With LOGO', '5500.00', 'p1.png', 'p1.png', 'p3.png', 'p2.png', 6, 1, 0, 'Office Chair, Pink Chair', '2023-02-22 05:26:54'),
(9, 2, 'Office Chair Brown', ' Brown-Office-Chair', '- Original Thickness PVC\r\n- Adjustable armrest\r\n- 320mm metal base\r\n- Butterfly mechanism + footrest\r\n- Class 3 standard #80L\r\n- Recline 90°-130° molded Foam.\r\n- With LOGO', '5500.00', 'b1.png', 'b1.png', 'b2.png', 'b3.png', 6, 1, 0, 'Office Chair, Brown', '2023-02-22 05:33:50'),
(10, 2, 'Office Chair Black', ' Black-Office-Chair', '- Original Thickness PVC\r\n- Adjustable armrest\r\n- 320mm metal base\r\n- Butterfly mechanism + footrest\r\n- Class 3 standard #80L\r\n- Recline 90°-130° molded Foam.\r\n- With LOGO', '5500.00', 'bl1.png', 'bl1.png', 'bl2.png', 'bl3.png', 6, 0, 1, 'Office Chair, Black Chair', '2023-02-22 05:50:23'),
(11, 2, 'Office Chair White', ' White-Office-Chair', '- Original Thickness PVC\r\n- Adjustable armrest\r\n- 320mm metal base\r\n- Butterfly mechanism + footrest\r\n- Class 3 standard #80L\r\n- Recline 90°-130° molded Foam.\r\n- With LOGO', '5500.00', 'w1.png', 'w1.png', 'w2.png', 'w3.png', 7, 1, 0, 'Office Chair, White Chair', '2023-02-22 05:51:28');

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
  `ip_add` varchar(12) NOT NULL,
  `token` varchar(40) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `lastactivity` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_email`, `user_password`, `fname`, `lname`, `contactnum`, `birthday`, `address`, `city`, `region`, `zip`, `image`, `role`, `ip_add`, `token`, `created_at`, `lastactivity`) VALUES
(1, 'Admin', 'admin@example.com', '123456', 'Super', 'Admin', '09123456789', '2002-02-17', 'Bagumbong Rd.', 'Caloocan City', 'Metro Manila', 1428, 'user.png', 1, '::1', '6dba6c0d74259ec1df26a5c246404a65', '2022-12-29 05:22:41', '2023-03-14 12:10:26'),
(2, 'user1', 'user1@example.com', '123456', 'First1', 'Name', '09123456789', '2023-02-17', 'Address', 'City', 'Region', 1428, '', 0, '::1', '22afd2cd8704fb7477e32149112cfc03', '2023-03-07 13:51:16', '2023-03-07 13:51:16'),
(3, 'user2', 'user2@example.com', '123456', 'First2', 'Name', '09123456789', '2023-02-17', 'Address', 'City', 'Region', 1428, '', 0, '::1', 'fafbacd3dafb0e7d9826aeeb5bd6d10dSILVERBA', '2023-03-07 13:53:42', '2023-03-07 13:53:42'),
(4, 'user3', 'user3@example.com', '123456', 'First3', 'Name', '09123456789', '2023-03-07', 'Address', 'City', 'Region', 1428, '', 0, '::1', '4782f353276c236179720a3e5b154851', '2023-03-07 13:58:06', '2023-03-07 13:58:06'),
(5, 'user4', 'user4@example.com', '123456', 'First4', 'Last', '09123456789', '2023-03-12', 'Address', 'City', 'Region', 1428, '', 0, '::1', '407fbbc412595e9ff3945acd3a3f3215', '2023-03-12 10:31:34', '2023-03-12 10:43:58'),
(6, 'user5', 'user5@example.com', '123456', 'First5', 'Last', '09123456789', '2023-03-10', 'user5', 'user5', 'user5', 8521, '', 0, '::1', 'b774895a5fb48926f11735505d06d933', '2023-03-13 07:48:26', '2023-03-13 07:48:26'),
(7, 'user6', 'user6@example.com', '123456', 'First6', 'Last', '09123456789', '2023-03-10', 'user6', 'user6', 'user5', 8521, '', 0, '::1', '4503c3c42fd59fe8fa35271b9f41ff6c', '2023-03-13 07:50:09', '2023-03-13 07:50:09'),
(8, 'user7', 'user7@example.com', '123456', 'First7', 'Last', '09123456789', '2023-03-10', 'user6', 'user6', 'user5', 8521, '', 0, '::1', '93b15d7be48b9bdbadacb0edd37c7272', '2023-03-13 07:51:14', '2023-03-13 07:51:14'),
(9, 'user8', 'user8@example.com', '123456', 'First8', 'Last', '09123456789', '2023-03-08', 'user6', 'user6', 'user5', 8521, '', 0, '::1', '2c2cd48628c6e69ff98f855d277a3fe8', '2023-03-13 07:51:41', '2023-03-13 07:51:41'),
(10, 'user9', 'user9@example.com', '123456', 'First9', 'Last', '09123456789', '2023-03-02', 'user6', 'user6', 'user5', 8521, '', 0, '::1', '21229d11d207a976ab65cd66ffab929e', '2023-03-13 07:53:14', '2023-03-13 07:53:14'),
(11, 'user10', 'user10@example.com', '123456', 'First10', 'Last', '09123456789', '2023-03-09', 'user6', 'user6', 'user5', 8521, '', 0, '::1', '97bf31344b92482abc0484c91f5ce2fc', '2023-03-13 07:54:05', '2023-03-13 07:54:05'),
(12, 'user11', 'user11@example.com', '123456', 'First11', 'Last', '09123456789', '2023-03-25', 'Adress', 'City', 'Region', 1254, '', 0, '::1', '264ba98f86bfb2e79d857c536c387edd', '2023-03-13 07:56:59', '2023-03-13 07:56:59'),
(13, 'user12', 'user12@example.com', '123456', 'First12', 'Last', '09123456789', '2023-03-18', 'Adress', 'City', 'Region', 1254, '', 0, '::1', 'b40fdf84dd33e82eb3327e2d1af68ba5', '2023-03-13 07:58:14', '2023-03-13 07:58:14'),
(14, 'user13', 'user13@example.com', '123456', 'First13', 'Last', '09123456789', '2023-03-16', 'Adress', 'City', 'Region', 1254, '', 0, '::1', '02159e92ce7132e798685eddb92da1dc', '2023-03-13 07:59:30', '2023-03-13 07:59:30'),
(15, 'user14', 'user14@example.com', '123456', 'First14', 'Last', '09123456789', '2023-03-22', 'Adress', 'City', 'Region', 1254, '', 0, '::1', 'f6150d461207d333f60488fa5286a455', '2023-03-13 08:05:04', '2023-03-13 08:05:04'),
(16, 'user15', 'user15@example.com', '123456', 'First15', 'Last', '09123456789', '2023-03-04', 'Adress', 'City', 'Region', 1254, '', 0, '::1', '524daa84e10bf1fa3df05434e11fa007', '2023-03-13 08:17:36', '2023-03-13 08:17:36'),
(17, 'user16', 'user16@example.com', '123456', 'First16', 'Last', '09123456789', '2023-03-02', 'Adress', 'City', 'Region', 1254, '', 0, '::1', '3a86cb693e31c19c432bbf59f47d1179', '2023-03-13 08:17:59', '2023-03-13 08:17:59'),
(18, 'user17', 'user17@example.com', '123456', 'First17', 'Last', '09123456789', '2023-03-02', 'Adress', 'City', 'Region', 1254, '', 0, '::1', '30b977747446e9db7c9cb19f99f8a575', '2023-03-13 08:22:24', '2023-03-13 08:22:24'),
(19, 'user18', 'user18@example.com', '123456', 'First18', 'Last', '09123456789', '2023-03-02', 'Adress', 'City', 'Region', 1254, '', 0, '::1', 'f986cc9b96d201f93f70c2d3ddcc806e', '2023-03-13 08:22:54', '2023-03-13 08:22:54'),
(20, 'user19', 'user19@example.com', '123456', 'First19', 'Last', '09123456789', '2023-03-22', 'Adress', 'City', 'Region', 1254, '', 0, '::1', 'b649b870164d0b376324e518ea6961b4', '2023-03-13 08:24:04', '2023-03-13 08:24:04'),
(21, 'user20', 'user20@example.com', '123456', 'First20', 'Last', '09123456789', '2023-03-05', 'Adress', 'City', 'Region', 1254, '', 0, '::1', 'f1a8bc37156b16d49befdb327f987b89', '2023-03-13 08:25:40', '2023-03-13 08:25:40'),
(22, 'user21', 'user21@example.com', '123456', 'First21', 'Last', '09123456789', '2023-03-29', 'Adress', 'City', 'Region', 1254, '', 0, '::1', 'cd7a14e2b2a259aa4f56137ad31cf7e3', '2023-03-13 08:41:44', '2023-03-13 08:41:44'),
(23, 'user22', 'user22@example.com', '123456', 'First22', 'Last', '09123456789', '2023-03-02', 'Adress', 'City', 'Bicol Region', 1254, '', 0, '::1', 'dc4dfe24e6ec39042c3df1935c91c5c1', '2023-03-14 12:01:09', '2023-03-14 12:01:09'),
(24, 'user23', 'user23@example.com', '123456', 'First23', 'Last', '09123456789', '2023-03-24', 'Adress', 'City', 'Bicol Region', 1254, '', 0, '::1', 'ae19f6d4a52ad66259a8cd540e79a342', '2023-03-14 12:01:43', '2023-03-14 12:01:43'),
(25, 'user24', 'user24@example.com', '123456', 'First24', 'Last', '09123456789', '2023-03-02', 'Adress', 'City', 'Bicol Region', 1254, '', 0, '::1', '8a19dd78c383cb04f1188b1ed1962e62', '2023-03-14 12:02:24', '2023-03-14 12:02:24'),
(26, 'user25', 'user25@example.com', '123456', 'First25', 'Last', '09123456789', '2023-03-04', 'Adress', 'City', 'Bicol Region', 1254, '', 0, '::1', '35f7a06cb88be755a49cc096ea96700d', '2023-03-14 12:02:49', '2023-03-14 12:02:49');

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
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `oitem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
