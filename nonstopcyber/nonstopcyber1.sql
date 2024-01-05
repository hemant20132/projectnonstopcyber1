-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2022 at 04:36 PM
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
-- Database: `nonstopcyber1`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `fbareturn1`
--

CREATE TABLE `fbareturn1` (
  `id` int(11) NOT NULL,
  `return_image` varchar(255) DEFAULT NULL,
  `orderno` varchar(255) DEFAULT NULL,
  `platform` varchar(255) DEFAULT NULL,
  `product_value` varchar(255) DEFAULT NULL,
  `commissioncharges` varchar(255) DEFAULT NULL,
  `totalamount` varchar(255) DEFAULT NULL,
  `addtinfo` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `tdate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `fbareturn_products`
--

CREATE TABLE `fbareturn_products` (
  `id` int(11) NOT NULL,
  `returnid` varchar(255) DEFAULT NULL,
  `returnorderno` varchar(255) DEFAULT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  `nsinumber` varchar(255) DEFAULT NULL,
  `productname` varchar(255) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `isdamaged` varchar(255) DEFAULT NULL,
  `rate` varchar(255) DEFAULT NULL,
  `subtotal` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `fbasale`
--

CREATE TABLE `fbasale` (
  `id` int(11) NOT NULL,
  `sale_image` varchar(255) DEFAULT NULL,
  `orderno` varchar(255) DEFAULT NULL,
  `platform` varchar(255) DEFAULT NULL,
  `product_value` varchar(255) DEFAULT NULL,
  `commissioncharges` varchar(255) DEFAULT NULL,
  `shippingcharges` varchar(255) DEFAULT NULL,
  `totalamount` varchar(255) DEFAULT NULL,
  `addtinfo` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `tdate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `fbasale_products`
--

CREATE TABLE `fbasale_products` (
  `id` int(11) DEFAULT NULL,
  `saleid` varchar(255) DEFAULT NULL,
  `saleorderno` varchar(255) DEFAULT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  `nsinumber` varchar(255) DEFAULT NULL,
  `productname` varchar(255) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `rate` varchar(255) DEFAULT NULL,
  `subtotal` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `fbastocksend`
--

CREATE TABLE `fbastocksend` (
  `id` int(11) NOT NULL,
  `sale_image` varchar(255) DEFAULT NULL,
  `receiptno` varchar(255) DEFAULT NULL,
  `platform` varchar(255) DEFAULT NULL,
  `addtinfo` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `tdate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `fbastocksend_products`
--

CREATE TABLE `fbastocksend_products` (
  `id` int(11) DEFAULT NULL,
  `saleid` varchar(255) DEFAULT NULL,
  `receiptno` varchar(255) DEFAULT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  `nsinumber` varchar(255) DEFAULT NULL,
  `productname` varchar(255) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `fiforate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `fba_product`
--

CREATE TABLE `fba_product` (
  `id` int(11) NOT NULL,
  `s_no` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `sub_category` varchar(255) DEFAULT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `nsi_number` varchar(255) DEFAULT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_images` varchar(255) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `second_name` varchar(255) DEFAULT NULL,
  `short_description` varchar(255) DEFAULT NULL,
  `long_description` longtext DEFAULT NULL,
  `shelf_number` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `fbnreturn1`
--

CREATE TABLE `fbnreturn1` (
  `id` int(11) DEFAULT NULL,
  `return_image` varchar(255) DEFAULT NULL,
  `orderno` varchar(255) DEFAULT NULL,
  `platform` varchar(255) DEFAULT NULL,
  `product_value` varchar(255) DEFAULT NULL,
  `commissioncharges` varchar(255) DEFAULT NULL,
  `totalamount` varchar(255) DEFAULT NULL,
  `addtinfo` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `tdate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `fbnreturn_products`
--

CREATE TABLE `fbnreturn_products` (
  `id` int(11) NOT NULL,
  `returnid` varchar(255) DEFAULT NULL,
  `returnorderno` varchar(255) DEFAULT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  `nsinumber` varchar(255) DEFAULT NULL,
  `productname` varchar(255) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `isdamaged` varchar(255) DEFAULT NULL,
  `rate` varchar(255) DEFAULT NULL,
  `subtotal` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `fbnsale`
--

CREATE TABLE `fbnsale` (
  `id` int(11) NOT NULL,
  `sale_image` varchar(255) DEFAULT NULL,
  `orderno` varchar(255) DEFAULT NULL,
  `platform` varchar(255) DEFAULT NULL,
  `product_value` varchar(255) DEFAULT NULL,
  `commissioncharges` varchar(255) DEFAULT NULL,
  `shippingcharges` varchar(255) DEFAULT NULL,
  `totalamount` varchar(255) DEFAULT NULL,
  `addtinfo` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `tdate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `fbnsale_products`
--

CREATE TABLE `fbnsale_products` (
  `id` int(11) NOT NULL,
  `saleid` varchar(255) DEFAULT NULL,
  `saleorderno` varchar(255) DEFAULT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  `nsinumber` varchar(255) DEFAULT NULL,
  `productname` varchar(255) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `rate` varchar(255) DEFAULT NULL,
  `subtotal` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `fbnstocksend_products`
--

CREATE TABLE `fbnstocksend_products` (
  `id` int(11) DEFAULT NULL,
  `saleid` varchar(255) DEFAULT NULL,
  `receiptno` varchar(255) DEFAULT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  `nsinumber` varchar(255) DEFAULT NULL,
  `productname` varchar(255) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `fiforate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `fbn_product`
--

CREATE TABLE `fbn_product` (
  `id` int(11) NOT NULL,
  `s_no` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `sub_category` varchar(255) DEFAULT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `nsi_number` varchar(255) DEFAULT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_images` varchar(255) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `second_name` varchar(255) DEFAULT NULL,
  `short_description` varchar(255) DEFAULT NULL,
  `long_description` longtext DEFAULT NULL,
  `shelf_number` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `notificationtext` longtext DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `tdate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `sub_category` varchar(255) DEFAULT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `nsi_number` varchar(255) DEFAULT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `product_images` varchar(255) DEFAULT NULL,
  `second_name` varchar(255) DEFAULT NULL,
  `short_description` varchar(255) DEFAULT NULL,
  `long_description` longtext DEFAULT NULL,
  `stocks_quantity` varchar(255) DEFAULT NULL,
  `shelf_number` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `id` int(11) DEFAULT NULL,
  `invoiceno` varchar(255) DEFAULT NULL,
  `product_value` varchar(255) DEFAULT NULL,
  `vat` varchar(255) DEFAULT NULL,
  `totalamount` varchar(255) DEFAULT NULL,
  `addtinfo` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `tdate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_products`
--

CREATE TABLE `purchase_products` (
  `id` int(11) DEFAULT NULL,
  `purchaseid` varchar(255) DEFAULT NULL,
  `purchaseinvoiceno` varchar(255) DEFAULT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  `nsinumber` varchar(255) DEFAULT NULL,
  `productname` varchar(255) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `rate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `return_products`
--

CREATE TABLE `return_products` (
  `id` int(11) NOT NULL,
  `returnid` varchar(255) DEFAULT NULL,
  `returnorderno` varchar(255) DEFAULT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  `nsinumber` varchar(255) DEFAULT NULL,
  `productname` varchar(255) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `isdamaged` varchar(255) DEFAULT NULL,
  `rate` varchar(255) DEFAULT NULL,
  `subtotal` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE `sale` (
  `id` int(11) NOT NULL,
  `sale_image` varchar(255) DEFAULT NULL,
  `orderno` varchar(255) DEFAULT NULL,
  `platform` varchar(255) DEFAULT NULL,
  `product_value` varchar(255) DEFAULT NULL,
  `commissioncharges` varchar(255) DEFAULT NULL,
  `shippingcharges` varchar(255) DEFAULT NULL,
  `totalamount` varchar(255) DEFAULT NULL,
  `addtinfo` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `tdate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sale_products`
--

CREATE TABLE `sale_products` (
  `id` int(11) NOT NULL,
  `saleid` int(11) DEFAULT NULL,
  `saleorderno` varchar(255) DEFAULT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  `nsinumber` varchar(255) DEFAULT NULL,
  `productname` varchar(255) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `rate` varchar(255) DEFAULT NULL,
  `subtotal` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `user_image` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `useraddress` varchar(255) DEFAULT NULL,
  `usercontactno` varchar(255) DEFAULT NULL,
  `useremail` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fbareturn1`
--
ALTER TABLE `fbareturn1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fbareturn_products`
--
ALTER TABLE `fbareturn_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fbasale`
--
ALTER TABLE `fbasale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fbastocksend`
--
ALTER TABLE `fbastocksend`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fba_product`
--
ALTER TABLE `fba_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fbnreturn_products`
--
ALTER TABLE `fbnreturn_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fbnsale`
--
ALTER TABLE `fbnsale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fbnsale_products`
--
ALTER TABLE `fbnsale_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fbn_product`
--
ALTER TABLE `fbn_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `return_products`
--
ALTER TABLE `return_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_products`
--
ALTER TABLE `sale_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fbareturn1`
--
ALTER TABLE `fbareturn1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fbasale`
--
ALTER TABLE `fbasale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fbastocksend`
--
ALTER TABLE `fbastocksend`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fba_product`
--
ALTER TABLE `fba_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fbnreturn_products`
--
ALTER TABLE `fbnreturn_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fbnsale`
--
ALTER TABLE `fbnsale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fbnsale_products`
--
ALTER TABLE `fbnsale_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fbn_product`
--
ALTER TABLE `fbn_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `return_products`
--
ALTER TABLE `return_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sale`
--
ALTER TABLE `sale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sale_products`
--
ALTER TABLE `sale_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
