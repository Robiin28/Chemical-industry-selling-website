-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2024 at 04:09 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `asax-compny`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_tbl`
--

CREATE TABLE `account_tbl` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account_tbl`
--

INSERT INTO `account_tbl` (`id`, `username`, `password`) VALUES
(6, 'admin', '$2y$10$iJA5spfhgPVBqoTK1dgKleL26VCCPlUTXcdke8Va/1IXovWYMnUay');

-- --------------------------------------------------------

--
-- Table structure for table `billing_tbl`
--

CREATE TABLE `billing_tbl` (
  `id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `tin` varchar(20) NOT NULL,
  `title` varchar(10) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `billing_tbl`
--

INSERT INTO `billing_tbl` (`id`, `company_name`, `tin`, `title`, `first_name`, `last_name`, `address1`, `city`, `country`, `state`, `email`, `phone`, `created_at`) VALUES
(45, 'trial comapny', '100023456', 'Mr', 'robel', 'hailu', 'adiss ababa', 'adiss ababa', 'Ethiopia', 'Addis Ababa', 'robiiihailuu@gmail.com', '+251 986991447', '2024-01-25 15:01:54'),
(46, 'trial comapny', '100023456', 'Mr', 'robel', 'hailu', 'adiss ababa', 'adiss ababa', 'Ethiopia', 'Addis Ababa', 'robiiihailuu@gmail.com', '+251 986991447', '2024-01-25 15:07:25');

-- --------------------------------------------------------

--
-- Table structure for table `chemical_tbl`
--

CREATE TABLE `chemical_tbl` (
  `id` int(10) UNSIGNED NOT NULL,
  `ptype` int(255) NOT NULL,
  `cname` varchar(255) NOT NULL,
  `spec` varchar(1000) NOT NULL,
  `image` varchar(255) NOT NULL,
  `packing` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `active` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chemical_tbl`
--

INSERT INTO `chemical_tbl` (`id`, `ptype`, `cname`, `spec`, `image`, `packing`, `price`, `active`) VALUES
(22, 58, 'AMMONIUM BICARBONATE', '99% min', 'chemical_4573.jpg', '25kg bags', 3450, 'YES'),
(23, 58, 'CALCIUM CARBONATE', 'Food grade', 'chemical_982.jpg', '25Kg bags', 3450, 'YES'),
(24, 58, 'POTASSIUM BICARBONATE', '98% min', 'chemical_6565.jpg', '25Kg bags', 3450, 'YES'),
(25, 58, 'CMC', '1000-7000cps', 'chemical_9810.jpg', '25kg bags', 3680, 'YES'),
(26, 58, 'BENZONIC ACID', 'BP98', 'chemical_1839.jpg', '25Kg bags', 4025, 'YES'),
(27, 58, 'CITRIC ACID ANHY MONOHYDRATE', 'BP98', 'chemical_3562.jpg', '25kg bags', 4140, 'YES'),
(28, 55, 'BARIUM SULPHATE', 'Different Mesh Size', 'chemical_3094.jpg', '25Kg bags', 4600, 'YES'),
(29, 55, 'IRON OXIDE', 'Red/Green/Yellow', 'chemical_6870.jpg', '25kg bags', 4600, 'YES'),
(30, 55, 'CARBON BLACK', 'Different Mesh Size', 'chemical_2517.jpg', '25Kg bags', 4830, 'YES'),
(31, 55, 'GLASS BEADS', 'Different Mesh Size', 'chemical_2761.jpg', '25kg bags', 5175, 'YES'),
(32, 55, 'METHYLENE CHLORIDE', '99% min', 'chemical_8328.jpg', '250/270kg drum', 5290, 'YES'),
(33, 55, 'SOYA LECITHIN', '60% min', 'chemical_171.jpg', '200kg drum', 5520, 'YES'),
(34, 53, 'CALCIUM STEARATE', '99% min', 'chemical_4696.jpg', '25Kg bags', 2300, 'YES'),
(35, 53, 'PE WAX', '99% min', 'chemical_7808.jpg', '25kg bags', 2875, 'YES'),
(36, 53, 'SODIUM HEXAMETAPHOSPHATE POWDER', '68% min', 'chemical_13.jpg', '25Kg bags', 3450, 'YES'),
(37, 53, 'SODIUM TRISODIUM ACID', '99% min', 'chemical_9920.jpg', '1000Kg bags', 4025, 'YES'),
(38, 53, 'SULFAMIC ACID', '99.5% min', 'chemical_8237.jpg', '25kg bags', 4600, 'YES'),
(39, 53, 'TITANIUM DIOXIDE', '94% min', 'chemical_9895.jpg', '25Kg bags', 5175, 'YES'),
(40, 54, 'CAUSTIC SODA FLAKE / PEARL', ' 96-99% min; 44-50% min', 'chemical_5912.jpg', '25Kg bags', 2300, 'YES'),
(41, 54, 'MAGNESIUM SULPHATE ANHY / HEPTA', ' Tech Grade 99.5% min', 'chemical_2144.jpg', '25Kg bags', 2645, 'YES'),
(42, 54, 'SODIUM SILICATE', ' Ratio: 1.8 - 3.5', 'chemical_1688.jpg', '50/1000Kg bag', 3680, 'YES'),
(43, 54, 'SODIUM CITRATE', 'BP93', 'chemical_1148.jpg', '25kg bags', 2530, 'YES'),
(44, 54, 'SOAP NOODLES', '74%', 'chemical_6804.jpg', '50Kg bags', 2875, 'YES'),
(45, 54, 'SODA ASH LIGHT', 'Tech Grade 99.2% min', 'chemical_3807.jpg', '25/50kg', 2990, 'YES'),
(46, 56, 'ALUMINIUM NITRATE', '95% min', 'chemical_1460.jpg', '50Kg Drums', 5750, 'YES'),
(47, 56, 'AMMONIUM CHLORIDE', '99.5% min', 'chemical_1665.jpg', '25Kg bags', 5980, 'YES'),
(48, 56, 'LITHOPHONE', ' 28-30% min', 'chemical_6996.jpg', '25/50kg bag', 6670, 'YES'),
(49, 56, 'CALCIUM CHLORIDE DIHYDRATE', '72 / 74% min', 'chemical_1617.jpg', '185kg drum', 6640, 'YES'),
(50, 56, 'BARIUM CHLORIDE', '98% min', 'chemical_9902.jpg', '50/100Kf bag', 6325, 'YES'),
(51, 56, 'ARSENIC TRIOXIDE', '99% min', 'chemical_2158.jpg', '50Kg Drum', 6210, 'YES'),
(52, 57, 'AMMONIUM SULPHATE', 'N 21% min', 'chemical_4423.jpg', '25/50kg bag', 3450, 'YES'),
(53, 57, 'BARIUM SULPHATE 2', '98% min', 'chemical_6725.jpg', '25Kg bags', 3680, 'YES'),
(54, 57, 'UREA', '46% min', 'chemical_5508.jpg', '50Kg bags', 4370, 'YES'),
(55, 57, 'FERROUS SULFATE', '98% min', 'chemical_1591.jpg', '25Kg bag', 3795, 'YES'),
(57, 57, 'SODA ASH', '99% min', 'chemical_4475.jpg', '25/50kg bag', 4140, 'YES'),
(58, 57, 'POLYALUMINIUM CHLORIDE', ' 28%/30% min', 'chemical_2316.jpg', '25Kg bags', 4025, 'YES');

-- --------------------------------------------------------

--
-- Table structure for table `order_tbl`
--

CREATE TABLE `order_tbl` (
  `id` int(11) NOT NULL,
  `billing_id` int(11) NOT NULL,
  `shipping_id` int(11) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `shipment_option` varchar(255) DEFAULT NULL,
  `payment_option` varchar(255) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `request` varchar(1000) DEFAULT NULL,
  `order_info` varchar(255) DEFAULT NULL,
  `order_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_tbl`
--

INSERT INTO `order_tbl` (`id`, `billing_id`, `shipping_id`, `total_price`, `shipment_option`, `payment_option`, `note`, `request`, `order_info`, `order_date`) VALUES
(33, 45, 6, '14375.00', 'Self-pick up from source', 'bank', 'Chemical Name: PE WAX(35)......Product Type: PLASTIC AND ADDITIVE CHMICALS ..... Number of Quantity ordered:... 5\n', '', 'delivery requested', '2024-01-25 09:01:54'),
(34, 46, 0, '10350.00', 'Self-pick up from source', 'cash', 'Chemical Name: AMMONIUM BICARBONATE(22)......Product Type: FOOD AND BEVERAGE ..... Number of Quantity ordered:... 3\n', '', NULL, '2024-01-25 09:07:25');

-- --------------------------------------------------------

--
-- Table structure for table `product_tbl`
--

CREATE TABLE `product_tbl` (
  `id` int(255) UNSIGNED NOT NULL,
  `pname` varchar(255) NOT NULL,
  `pdsc` varchar(1000) DEFAULT NULL,
  `image` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_tbl`
--

INSERT INTO `product_tbl` (`id`, `pname`, `pdsc`, `image`) VALUES
(53, 'PLASTIC AND ADDITIVE CHMICALS', 'plastic additive chemicals', 'product_431.png'),
(54, 'SOAP AND DETERGENTS CHEMICALS', 'soap and detergents chmicals', 'product_255.png'),
(55, 'PAINTING AND COATING CHEMICALS', 'painting and coating chemicals', 'product_995.png'),
(56, 'TANNING CHEMICALS', 'Tanning chemicals', 'product_714.png'),
(57, 'TEXTILE CHEMICALS', 'Textile chemicals', 'product_433.png'),
(58, 'FOOD AND BEVERAGE', 'Food and beverage chemicals', 'product_2261.png');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_tbl`
--

CREATE TABLE `shipping_tbl` (
  `id` int(11) NOT NULL,
  `address_nick` varchar(255) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `title` varchar(10) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shipping_tbl`
--

INSERT INTO `shipping_tbl` (`id`, `address_nick`, `company_name`, `title`, `first_name`, `last_name`, `address1`, `city`, `country`, `state`, `email`, `phone`, `created_at`) VALUES
(6, 'sheger', 'trial comapny', 'Mr', 'robel', 'hailu', 'adiss ababa', 'adiss ababa', 'Ethiopia', 'Addis Ababa', 'robiiihailuu@gmail.com', '+251 986991447', '2024-01-25 15:01:54');

-- --------------------------------------------------------

--
-- Table structure for table `treview_tbl`
--

CREATE TABLE `treview_tbl` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `treview_tbl`
--

INSERT INTO `treview_tbl` (`id`, `name`, `phone`, `email`, `message`) VALUES
(54, 'robel', '+251 986991447', 'robiiihailuu@gmail.com', ' STORE WEBSITE DEVELOEPED');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_tbl`
--
ALTER TABLE `account_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `billing_tbl`
--
ALTER TABLE `billing_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chemical_tbl`
--
ALTER TABLE `chemical_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_tbl`
--
ALTER TABLE `order_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_tbl`
--
ALTER TABLE `product_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping_tbl`
--
ALTER TABLE `shipping_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `treview_tbl`
--
ALTER TABLE `treview_tbl`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_tbl`
--
ALTER TABLE `account_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `billing_tbl`
--
ALTER TABLE `billing_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `chemical_tbl`
--
ALTER TABLE `chemical_tbl`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `order_tbl`
--
ALTER TABLE `order_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `product_tbl`
--
ALTER TABLE `product_tbl`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `shipping_tbl`
--
ALTER TABLE `shipping_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `treview_tbl`
--
ALTER TABLE `treview_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
