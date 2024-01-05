-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2021 at 10:57 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nonstopcyber`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brand` varchar(1500) NOT NULL,
  `code` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brand`, `code`) VALUES
('aaa', 'AAA'),
('aaaaaaa', 'ABC'),
('ALBA BOTANICA', 'ABT'),
('ALLERGAN', 'ALG'),
('AVLON', 'ALN'),
('AGIOLAX', 'ALX'),
('ALWAYS', 'ALY'),
('ARIEL', 'ARL'),
('acx', 'ASC'),
('ASTER', 'ASR'),
('ANASTASIA', 'ATS'),
('AVALON', 'AVL'),
('AIRWICK', 'AWC'),
('AIR WICK', 'AWK'),
('BATH & BODY WORKS', 'BBW'),
('BOSCIA', 'BCI'),
('BIODERMA', 'BDR'),
('BETTER', 'BER'),
('BHPC', 'BHP'),
('BIO-OIL', 'BIO'),
('BOJEUX', 'BJU'),
('BALANCE', 'BLC'),
('BALAMAIN', 'BLM'),
('BARLEANS', 'BLN'),
('BUMBLEBEE', 'BMB'),
('BENEFIT', 'BNF'),
('BOSS', 'BOS'),
('BOOST OXYGEN', 'BOX'),
('BIG RIGS', 'BRG'),
('BURBERRY', 'BRY'),
('BEAUTY FORMULAS', 'BTF'),
('BOTANICS', 'BTN'),
('BIO TRUE', 'BTR'),
('BOOTS', 'BTS'),
('COOL & COOL', 'CAC'),
('COCO MADEMOISELLE', 'CCM'),
('CAREFREE', 'CFR'),
('CHUBS', 'CHB'),
('CAROLINA HERRERA', 'CHR'),
('CALVIN KLEIN', 'CKL'),
('CALI', 'CLI'),
('CAROLINA', 'CLN'),
('CLASSIC', 'CLS'),
('CLOROX', 'CLX'),
('COSMO', 'CMO'),
('COMFORT', 'CMT'),
('CHANEL', 'CNL'),
('CANON', 'CNN'),
('COMPEED', 'CPD'),
('CARREFOUR', 'CRF'),
('CRYSTAL', 'CRY'),
('COSOM', 'CSM'),
('CARLSON', 'CSN'),
('CETAPHIL', 'CTP'),
('CETTUA', 'CTU'),
('COVER FX', 'CVF'),
('CELLUVISC', 'CVS'),
('DAC', 'DAC'),
('DOLCE & GABBANA', 'DAG'),
('DIOR ADDICT', 'DAT'),
('DUNHILL EDITION', 'DHE'),
('DIOR', 'DIO'),
('D-LINK', 'DLK'),
('DAVID OFF', 'DOF'),
('DR. FORMULATED', 'DRF'),
('DR. IRENA', 'DRI'),
('DUREX', 'DRX'),
('DISNEY', 'DSN'),
('DISAAR', 'DSR'),
('DETTOL', 'DTL'),
('DOVE', 'DVE'),
('DIVINE', 'DVN'),
('DYSON', 'DYS'),
('ESCADA', 'ECD'),
('ENCHANTED FOREST', 'ECF'),
('EUCERINE', 'ECN'),
('ECO', 'ECO'),
('EUCERIN', 'ECR'),
('ENCHANTEUR', 'ECT'),
('ENFRESH', 'EFS'),
('ELAVE', 'ELV'),
('ENER C', 'ENR'),
('EPSON', 'EPS'),
('ERBORIAN', 'ERB'),
('ESI', 'ESI'),
('EAU THERMALE', 'ETH'),
('EVELINE COSMETICS', 'EVC'),
('EVELINE', 'EVL'),
('EMBRYOLISSE', 'EYL'),
('FAST&FURIOUS', 'FAF'),
('FENTY BEAUTY', 'FBT'),
('FILORGA', 'FIG'),
('FOLIGAIN', 'FLG'),
('FLORMAR', 'FLR'),
('FILLY', 'FLY'),
('FORAMEN', 'FMN'),
('FINE', 'FNE'),
('FISHER PRICE', 'FPR'),
('GARNIER', 'GAR'),
('GUCCI', 'GCI'),
('GARDEN', 'GDN'),
('GIORGIO ARMANI', 'GGA'),
('GOOD GIRL', 'GGL'),
('GLAMGLOW', 'GGW'),
('GLADE', 'GLD'),
('GOOGLE', 'GLE'),
('GIOVANNI', 'GVN'),
('HERBAL ESSENCES', 'HBE'),
('HUDA BEAUTY', 'HBY'),
('Hira Chemicals', 'HCC'),
('HOURGLASS', 'HGL'),
('HELLO', 'HLO'),
('HIMALAYA', 'HML'),
('HP', 'HPD'),
('HICKORY', 'HRY'),
('HASK', 'HSK'),
('HUAWEI', 'HWI'),
('IHEALTH', 'IHT'),
('IKEA', 'IKA'),
('INDIAN NIGHT', 'ING'),
('INJECTO', 'INJ'),
('INECTO', 'INO'),
('JEJU', 'JEJ'),
('JOHNSONS', 'JHN'),
('JOHNSON', 'JON'),
('JASON', 'JSN'),
('KAT HON', 'KHN'),
('KIKI', 'KKI'),
('KIKI HEALTH', 'KKL'),
('KERATESE', 'KRT'),
('KERASTASE', 'KST'),
('KOTEX', 'KTX'),
('KVD', 'KVD'),
('KYOLIC', 'KYC'),
('LB LINK', 'LBL'),
('LIFEBUOY', 'LBY'),
('LACOSTE', 'LCT'),
('LIFE', 'LFE'),
('LABORATOIRES FILORGA', 'LFG'),
('LANCOME', 'LNM'),
('LINKSYS', 'LNS'),
('LENOVO', 'LNV'),
('LOGITECH', 'LOG'),
('LOREAL PARIS', 'LRL'),
('LA ROCHE POSAY', 'LRP'),
('LITTLEST PETSHOP', 'LTP'),
('LUX', 'LUX'),
('MARC ANTHONY', 'MAT'),
('MY CLARINS', 'MCR'),
('MICASA', 'MCS'),
('MARC JACOBS', 'MJS'),
('MAYBELLINE NEW YORK', 'MNY'),
('MAX FACTOR', 'MXF'),
('NATURES AID', 'NAD'),
('NESCAFE', 'NCF'),
('NO11', 'NEE'),
('NUHAIR', 'NHR'),
('NIVEA', 'NIV'),
('NATURALIS', 'NLS'),
('NEW NB', 'NNB'),
('NINA RICCI', 'NNR'),
('NO8', 'NOE'),
('NO9', 'NON'),
('NO7', 'NOS'),
('NO10', 'NOT'),
('NATURES PLUS', 'NPS'),
('NERB', 'NRB'),
('NORDIC', 'NRD'),
('NARS', 'NRS'),
('NO13', 'NTH'),
('NATURTINT', 'NTR'),
('NATURES', 'NTS'),
('NO12', 'NTW'),
('NOVO', 'NVO'),
('NZ HEALTH NATURALLY', 'NZH'),
('OCTOPIROX', 'OCP'),
('ODDBODS', 'ODB'),
('OPTI-FREE', 'OFR'),
('ORGANIC', 'OGN'),
('OGX', 'OGX'),
('OILLAN', 'OLN'),
('OLAY', 'OLY'),
('OMO', 'OM'),
('OMRON', 'OMR'),
('ORIGINS', 'ORG'),
('ORLANE', 'ORL'),
('ORGANIC TRADITIONS', 'ORT'),
('OVELLE', 'OVL'),
('PB FIT', 'PBF'),
('PLAY-DOH', 'PDH'),
('PANDERM', 'PDR'),
('PETAL FRESH', 'PFH'),
('PIGEON', 'PGN'),
('PHARMACIERS', 'PHC'),
('PHILIPS', 'PHL'),
('PARIS HILTON', 'PHT'),
('PLASMACHASER', 'PLC'),
('PONDS', 'PND'),
('PANTENE', 'PNT'),
('PERSIL', 'PSL'),
('PASANTE', 'PSN'),
('PASTON', 'PST'),
('POPTATERS', 'PTR'),
('PURESSENTIAL', 'PUE'),
('PURITA', 'PUR'),
('PIXI', 'PXI'),
('qasd', 'QEW'),
('RIRI BY RIHANNA', 'RBR'),
('RIMMEL LONDON', 'RLN'),
('REPLICA MAISON', 'RMS'),
('RENU', 'RNU'),
('REPLICA MASON', 'RPM'),
('ROSSMAX', 'RSM'),
('ROYAL', 'RYL'),
('SCHOLL', 'SCH'),
('ST DUPONT', 'SDP'),
('SANDISC', 'SDS'),
('SENSILIS', 'SEN'),
('SUNFOOD', 'SFD'),
('SOLGAR', 'SGR'),
('SHIFFA', 'SHF'),
('SALLY HANSEN', 'SHN'),
('SUPERLIFE', 'SLF'),
('salman', 'SLM'),
('SLEEP RIGHT', 'SLR'),
('SEBA MED', 'SMD'),
('SAMSUNG', 'SMS'),
('SHINE', 'SNE'),
('SAMPAR NETTOYAGE', 'SNG'),
('SUNSHINE NUTRITION', 'SNS'),
('SONY', 'SNY'),
('SPORT', 'SPT'),
('SEPHORA', 'SRA'),
('SONASHI', 'SSH'),
('SOSKIN', 'SSK'),
('SOLO SOFT', 'SST'),
('S. T. Dupont', 'STD'),
('SOFT FORM', 'STF'),
('ST IVES', 'STI'),
('ST. IVES', 'STS'),
('STAR WARS', 'STW'),
('SUGAR', 'SUG'),
('SUNWOO COSME', 'SWC'),
('SWISS', 'SWS'),
('SYOSS', 'SYS'),
('TED BAKER', 'TBK'),
('TP-LINK', 'TBL'),
('THE BODY SHOP', 'TBS'),
('TIDE', 'TDE'),
('TFS REAL', 'TFR'),
('THE FACE SHOP', 'TFS'),
('TUTTI FRUTTI', 'TFT'),
('3M', 'THM'),
('TRACHIOL LOZENGES', 'TLO'),
('TRADITIONAL MEDICINALS', 'TMD'),
('TEAMSTERZ', 'TMT'),
('TRISTER', 'TRS'),
('TRESEMME', 'TSM'),
('TEA TREE', 'TTR'),
('URBAN DECAY', 'UDY'),
('USC', 'USC'),
('VILLEROY & BOCH', 'VAB'),
('VICTOR & ROLF', 'VAR'),
('VEET', 'VET'),
('VICHY LABORATORIES', 'VLB'),
('VEET SENSITIVE', 'VSV'),
('VICTORIA SECRETS', 'VTS'),
('WEBER', 'WBR'),
('WET N\' WILD', 'WNW'),
('WESTLAB', 'WTL'),
('XBOX', 'XBX'),
('X-MINI', 'XMN'),
('XYLICHEW', 'XYL'),
('EVIDENCE YVES', 'YVS');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `s_no` int(255) NOT NULL,
  `category` varchar(300) NOT NULL,
  `sub_category` varchar(300) NOT NULL,
  `brand` varchar(300) NOT NULL,
  `nsi_number` varchar(12) NOT NULL,
  `barcode` int(40) NOT NULL,
  `product_name` varchar(200) NOT NULL,
  `purchase_date` date NOT NULL,
  `purchase_qty` int(255) NOT NULL,
  `purchase_price` int(255) NOT NULL,
  `shelf_number` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`s_no`, `category`, `sub_category`, `brand`, `nsi_number`, `barcode`, `product_name`, `purchase_date`, `purchase_qty`, `purchase_price`, `shelf_number`) VALUES
(79, 'Baby & Toddler', 'Baby Toys & Activity Equipment', 'ALLERGAN', '0', 789654123, 'salman', '2021-05-14', 56, 10, 0),
(80, 'Food, Beverages & Tobacco', 'Beverages', 'ANASTASIA', '78654', 55663322, 'salman', '2021-05-10', 89, 63, 0),
(81, 'Media', 'Audio', 'BHPC', '789', 55441122, 'ateeq', '2021-05-22', 75, 67, 0),
(82, 'Electronics', 'Mobile Phones & Tablets', 'AVLON', 'qwer7896', 741258, 'qwertyuiop', '2021-05-12', 52, 32, 0),
(83, 'Sporting Goods', 'Sporting Supplements', 'BOOST OXYGEN', 'qweasd123', 852369741, 'oxygen', '2021-05-02', 46, 63, 0),
(84, 'Office Supplies', 'Office Accessories', 'BETTER', 'qazxsw1234', 789654, 'sdfgh', '2021-05-05', 85, 14, 3),
(85, 'Mature', 'Erotic', 'BARLEANS', 'Qweasdzxc177', 12345678, 'Maria', '2021-05-07', 14, 178, 45),
(86, 'Cosmetics', 'Eye', 'CHUBS', 'Qabshsj1804', 258963147, 'Ameer', '2021-04-14', 47, 16, 5),
(87, 'Health & Beauty', 'Hand Sanitizers', 'PURITA', 'qwerfs125874', 2147483647, 'Instant Hand Sanitizer 500 ml', '2021-05-11', 15, 20, 11),
(101, 'Cameras & Optics', 'Cameras', 'AGIOLAX', 'AGIL00112233', 741258963, 'Salman', '2021-07-14', 10, 25, 741);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD UNIQUE KEY `code` (`code`),
  ADD UNIQUE KEY `brand` (`brand`) USING HASH;

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`s_no`),
  ADD UNIQUE KEY `barcode` (`barcode`),
  ADD UNIQUE KEY `nsi_number` (`nsi_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `s_no` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
