-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2017 at 04:02 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_imedia`
--

-- --------------------------------------------------------

--
-- Table structure for table `accessories`
--

CREATE TABLE `accessories` (
  `id` int(5) NOT NULL,
  `image` varchar(50) NOT NULL,
  `brand` varchar(30) NOT NULL,
  `model` varchar(30) NOT NULL,
  `description` varchar(500) NOT NULL,
  `dealer_price` bigint(20) NOT NULL,
  `retail_price` bigint(20) NOT NULL,
  `cat` varchar(30) NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accessories`
--

INSERT INTO `accessories` (`id`, `image`, `brand`, `model`, `description`, `dealer_price`, `retail_price`, `cat`) VALUES
(10, 'Wolf Desktop Wallpaper.jpg', 'Belden', 'ASCII-UTF8', 'Chewy Tamarind Candy', 1200, 1500, '2');

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `username`, `password`) VALUES
(1, 'jerlon', 'pass'),
(2, 'john', 'pass');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `name`, `status`) VALUES
(1, 'HikVision', 1),
(2, 'DaHua', 1),
(5, 'CD-R King', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cable`
--

CREATE TABLE `cable` (
  `id` int(5) NOT NULL,
  `image` varchar(50) NOT NULL,
  `brand` varchar(30) NOT NULL,
  `model` varchar(30) NOT NULL,
  `type` varchar(10) NOT NULL,
  `description` varchar(500) NOT NULL,
  `dealer_price` int(11) NOT NULL,
  `retail_price` int(11) NOT NULL,
  `cat` int(30) NOT NULL DEFAULT '8'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cable`
--

INSERT INTO `cable` (`id`, `image`, `brand`, `model`, `type`, `description`, `dealer_price`, `retail_price`, `cat`) VALUES
(1, '2-wolf.jpg', 'Belden', 'Belden-UTF334', 'Coaxial', 'With Ground', 1000, 1500, 8);

-- --------------------------------------------------------

--
-- Table structure for table `camera`
--

CREATE TABLE `camera` (
  `id` int(5) NOT NULL,
  `image` varchar(50) NOT NULL,
  `brand` varchar(30) NOT NULL,
  `model` varchar(30) NOT NULL,
  `type` varchar(20) NOT NULL,
  `ctype` varchar(10) NOT NULL,
  `poe` int(2) NOT NULL,
  `description` varchar(500) NOT NULL,
  `lens` varchar(10) NOT NULL,
  `dealer_price` int(10) NOT NULL,
  `retail_price` int(11) NOT NULL,
  `cat` int(20) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `camera`
--

INSERT INTO `camera` (`id`, `image`, `brand`, `model`, `type`, `ctype`, `poe`, `description`, `lens`, `dealer_price`, `retail_price`, `cat`) VALUES
(45, 'screenshot-child.png', 'DaHua', 'DSCOPA-1231FSD', 'Dome', 'PTZ', 1, '', '12mm', 5325, 7000, 1),
(46, 'screenshot.png', 'HikVision', 'HK-88944-L', 'Dome', 'Starlight', 1, '', '3.10mm', 2250, 3800, 1),
(47, 'Untitled.png', 'CD-R King', 'ZXC-CMERA 1515', 'IP', 'Starlight', 1, 'Presyong Abot Kaya', '2.5mm', 700, 900, 1);

-- --------------------------------------------------------

--
-- Table structure for table `camera_type`
--

CREATE TABLE `camera_type` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `camera_type`
--

INSERT INTO `camera_type` (`id`, `name`, `status`) VALUES
(3, 'PTZ', 1),
(4, 'Starlight', 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `parentID` int(11) DEFAULT '0',
  `catID` int(11) NOT NULL,
  `catName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`parentID`, `catID`, `catName`) VALUES
(0, 22, 'Camera'),
(0, 23, 'Recorder'),
(22, 24, 'IP'),
(23, 25, 'DVR'),
(23, 26, 'NVR'),
(0, 27, 'Switch');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `itemCat` int(11) NOT NULL,
  `itemName` varchar(100) NOT NULL,
  `retail_price` int(11) NOT NULL,
  `dealer_price` int(11) NOT NULL,
  `itemDesc` varchar(255) NOT NULL,
  `flag` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `quotation_details`
--

CREATE TABLE `quotation_details` (
  `id` int(11) NOT NULL,
  `subject` varchar(120) NOT NULL,
  `recipient` varchar(120) NOT NULL,
  `company` varchar(120) NOT NULL,
  `email` varchar(120) NOT NULL,
  `item_list` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `quantity` varchar(200) NOT NULL,
  `pricing` varchar(10) NOT NULL,
  `discount` int(11) DEFAULT '0',
  `dateCreated` varchar(100) NOT NULL,
  `qtnStatus` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `salesID` int(11) NOT NULL,
  `qtnID` int(11) NOT NULL,
  `month` varchar(100) NOT NULL,
  `year` varchar(100) NOT NULL,
  `amountSold` int(11) NOT NULL,
  `salesStatus` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`salesID`, `qtnID`, `month`, `year`, `amountSold`, `salesStatus`) VALUES
(7, 36, 'February', '2017', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `sName` varchar(101) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `supplierdetails`
--

CREATE TABLE `supplierdetails` (
  `sID` int(11) NOT NULL,
  `itemID` int(11) NOT NULL,
  `itemCat` int(11) NOT NULL,
  `expose` int(11) NOT NULL,
  `jvs` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vat`
--

CREATE TABLE `vat` (
  `vat` varchar(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vat`
--

INSERT INTO `vat` (`vat`) VALUES
('15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accessories`
--
ALTER TABLE `accessories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cable`
--
ALTER TABLE `cable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `camera`
--
ALTER TABLE `camera`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `camera_type`
--
ALTER TABLE `camera_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`catID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotation_details`
--
ALTER TABLE `quotation_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`salesID`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accessories`
--
ALTER TABLE `accessories`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `cable`
--
ALTER TABLE `cable`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `camera`
--
ALTER TABLE `camera`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `camera_type`
--
ALTER TABLE `camera_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `catID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `quotation_details`
--
ALTER TABLE `quotation_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `salesID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
