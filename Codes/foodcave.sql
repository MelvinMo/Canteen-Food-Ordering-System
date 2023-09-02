-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2022 at 03:32 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodcave`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `ct_id` int(11) NOT NULL,
  `ct_amount` int(11) NOT NULL,
  `ct_note` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `s_id` int(11) NOT NULL,
  `f_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart`
--

-- INSERT INTO `cart` (`ct_id`, `ct_amount`, `ct_note`, `s_id`, `f_id`, `c_id`) VALUES
-- (1, 1, '', 0, 0, 0),
-- (18, 1, '', 0, 0, 0),
-- (29, 3, '', 0, 0, 0),
-- (84, 1, '', 3, 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `c_username` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `c_pwd` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `c_firstname` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `c_lastname` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `c_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `c_gender` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'M for Male, F for Female',
  `c_type` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Type of customer in this canteen (STD for student,STF for staff, GUE for guest, ADM for admin, OTH for other)',
  `c_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `customer` ADD `std_number` VARCHAR(10) NOT NULL AFTER `c_id`, ADD UNIQUE `std_num_idx` (`std_number`);

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`c_username`, `c_pwd`, `c_firstname`, `c_lastname`, `c_email`, `c_gender`, `c_type`, `c_id`) VALUES
('ali67', '12345678', 'Ali', 'Rezaei', 'ali.rezaei@example.com', 'M', 'STD', 1),
('narges89', '87654321', 'Narges', 'Kazemi', 'narges.kazemi@example.com', 'F', 'STD', 2),
('mohammad123', '11111111', 'Mohammad', 'Ahmadi', 'mohammad.ahmadi@example.com', 'M', 'STD', 3),
('admin', 'admin123', 'Melvin', 'Mokhtari', 'melvin.mokhtari@iut.ac.ir', 'M', 'ADM', 4),
('amirhossein', '22222222', 'Amirhossein', 'Soleimani', 'amirhossein.soleimani@example.com', 'M', 'STD', 5),
('mahnaz77', '33333333', 'Mahnaz', 'Gholami', 'mahnaz.gholami@example.com', 'F', 'STD', 6);

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `f_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `f_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `f_price` decimal(6,2) NOT NULL,
  `f_pic` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`f_id`, `s_id`, `f_name`, `f_price`, `f_pic`) VALUES
(1, 1, 'Kabab Koobideh', '10', '1.jpg'),
(2, 1, 'Joojeh Kabab', '12', '2.jpg'),
(3, 1, 'Ghormeh Sabzi', '9', '3.jpg'),
(4, 1, 'Baghali Polo Mahiche', '17', '4.jpg'),
(5, 1, 'Tahchin Morgh', '11', '5.jpg'),
(6, 1, 'Fesenjan', '9.5', '6.jpg'),
(7, 2, 'Ash Reshteh', '5', '7.jpg'),
(8, 2, 'Kashk-e Bademjan', '6', '8.jpg'),
(9, 2, 'Kookoo Sabzi', '5.5', '9.jpg'),
(10, 3, 'Gheymeh', '7.5', '10.jpg'),
(11, 3, 'Zereshk Polo Morgh', '9', '11.jpg'),
(12, 4, 'Pizza', '18.5', '12.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `ord_id` int(11) NOT NULL,
  `orh_id` int(11) NOT NULL,
  `f_id` int(11) NOT NULL,
  `ord_amount` int(11) NOT NULL,
  `ord_buyprice` decimal(6,2) NOT NULL,
  `ord_note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_detail`
--

-- INSERT INTO `order_detail` (`ord_id`, `orh_id`, `f_id`, `ord_amount`, `ord_buyprice`, `ord_note`) VALUES
-- (102, 72, 22, 1, '100.00', ''),
-- (103, 0, 25, 1, '35.00', ''),
-- (106, 47, 29, 1, '40.00', ''),
-- (107, 75, 15, 1, '25.00', ''),
-- (108, 49, 13, 1, '25.00', ''),
-- (109, 50, 16, 3, '10.00', ''),
-- (110, 51, 10, 1, '80.00', ''),
-- (112, 77, 11, 1, '25.00', ''),
-- (113, 54, 36, 1, '60.00', ''),
-- (114, 79, 24, 1, '25.00', ''),
-- (115, 80, 27, 1, '40.00', ''),
-- (116, 81, 17, 1, '25.00', ''),
-- (117, 82, 62, 1, '120.00', ''),
-- (118, 83, 25, 1, '35.00', '');

-- --------------------------------------------------------

--
-- Table structure for table `order_header`
--

CREATE TABLE `order_header` (
  `orh_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `orh_ordertime` timestamp NOT NULL DEFAULT current_timestamp(),
  `orh_orderstatus` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `orh_finishedtime` datetime DEFAULT NULL,
  `t_id` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_header`
--

-- INSERT INTO `order_header` (`orh_id`, `c_id`, `s_id`, `p_id`, `orh_ordertime`, `orh_orderstatus`, `orh_finishedtime`, `t_id`) VALUES
-- (72, 2, 3, 45, '2023-07-08 13:54:40', 'CNCL', '0000-00-00 00:00:00', ''),
-- (81, 3, 2, 57, '2023-07-09 13:42:35', 'FNSH', '2023-07-11 11:39:59', 'T75693953497569'),
-- (82, 1, 4, 58, '2023-07-09 02:17:22', 'VRFY', NULL, 'T75693953497569'),
-- (83, 1, 3, 59, '2023-07-10 02:19:16', 'VRFY', NULL, 'T75693953497569');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `p_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `p_amount` decimal(7,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment`
--

-- INSERT INTO `payment` (`p_id`, `c_id`, `p_amount`) VALUES
-- (45, 2, '100.00'),
-- (46, 5, '140.00'),
-- (47, 1, '40.00'),
-- (48, 1, '25.00'),
-- (49, 1, '25.00'),
-- (50, 1, '30.00'),
-- (51, 3, '80.00'),
-- (52, 3, '100.00'),
-- (53, 3, '25.00'),
-- (54, 3, '60.00'),
-- (55, 3, '25.00'),
-- (56, 3, '40.00'),
-- (57, 3, '25.00'),
-- (58, 1, '120.00'),
-- (59, 1, '35.00');

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `s_username` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `s_pwd` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `s_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `s_location` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `s_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `s_phoneno` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `s_pic` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `s_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`s_username`, `s_pwd`, `s_name`, `s_location`, `s_email`, `s_phoneno`, `s_pic`, `s_id`) VALUES
('shop1', 'central', 'Central restaurant', 'In front of the university mosque', 'shop01@email.com', '33911010', 'shop1.jpg', 1),
('shop2', 'aseman', 'Aseman restaurant', 'Under the fourth student dormitory', 'shop02@email.com', '33911011', 'shop2.png', 2),
('shop3', 'nikan', 'Nikan restaurant', 'Under the university guesthouse', 'shop3@gmail.com', '33911012', 'shop3.jpg', 3),
('shop4', 'shaher', 'Shaher restaurant', 'In the first floor of Mafakhar hall', 'shop4@gmail.com', '33911013', 'shop4.jpg', 4);
--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`ct_id`),
  ADD KEY `c_id` (`c_id`),
  ADD KEY `f_id` (`f_id`),
  ADD KEY `s_id` (`s_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`c_id`),
  ADD UNIQUE KEY `c_username` (`c_username`),
  ADD UNIQUE KEY `c_email` (`c_email`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`f_id`),
  ADD KEY `s_id` (`s_id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`ord_id`),
  ADD KEY `orh_id` (`orh_id`) USING BTREE,
  ADD KEY `f_id` (`f_id`) USING BTREE;

--
-- Indexes for table `order_header`
--
ALTER TABLE `order_header`
  ADD PRIMARY KEY (`orh_id`),
  ADD KEY `c_id` (`c_id`) USING BTREE,
  ADD KEY `s_id` (`s_id`) USING BTREE,
  ADD KEY `p_id` (`p_id`) USING BTREE;

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `c_id` (`c_id`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`s_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `ct_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `ord_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `order_header`
--
ALTER TABLE `order_header`
  MODIFY `orh_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

ALTER TABLE `order_detail` ADD FOREIGN KEY (`orh_id`) REFERENCES `order_header`(`orh_id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `order_detail` ADD FOREIGN KEY (`f_id`) REFERENCES `food`(`f_id`) ON DELETE CASCADE ON UPDATE CASCADE;


ALTER TABLE `order_header` ADD FOREIGN KEY (`c_id`) REFERENCES `customer`(`c_id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `order_header` ADD FOREIGN KEY (`s_id`) REFERENCES `shop`(`s_id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `order_header` ADD FOREIGN KEY (`p_id`) REFERENCES `payment`(`p_id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `food` ADD FOREIGN KEY (`s_id`) REFERENCES `shop`(`s_id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `payment` ADD FOREIGN KEY (`c_id`) REFERENCES `customer`(`c_id`) ON DELETE CASCADE ON UPDATE CASCADE;

