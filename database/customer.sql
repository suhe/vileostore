-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 23, 2015 at 11:35 AM
-- Server version: 5.5.42-cll
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `k4431623_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) NOT NULL DEFAULT '0',
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `email` varchar(96) NOT NULL,
  `telephone` varchar(32) NOT NULL,
  `fax` varchar(32) NOT NULL,
  `password` varchar(40) NOT NULL,
  `salt` varchar(9) NOT NULL,
  `cart` text,
  `wishlist` text,
  `newsletter` tinyint(1) NOT NULL DEFAULT '0',
  `address_id` int(11) NOT NULL DEFAULT '0',
  `customer_group_id` int(11) NOT NULL,
  `ip` varchar(40) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL,
  `approved` tinyint(1) NOT NULL,
  `token` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`customer_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=123 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `store_id`, `firstname`, `lastname`, `email`, `telephone`, `fax`, `password`, `salt`, `cart`, `wishlist`, `newsletter`, `address_id`, `customer_group_id`, `ip`, `status`, `approved`, `token`, `date_added`) VALUES
(1, 0, 'Cahya', 'Cahya', 'cahyaliverpudlian@yahoo.co.id', '08112701990', '', 'c64f340ad07ddab0ccdb57ae24553c9c29933c0c', '4c44b61fb', 'a:0:{}', '', 1, 1, 1, '182.253.72.212', 1, 1, '', '2014-05-14 16:51:02'),
(2, 0, 'Hendarsyah', 'Suhendar', 'hendarsyahss5@gmail.com', '085222054064', '08867777', 'c64f340ad07ddab0ccdb57ae24553c9c29933c0c', '4c44b61fb', 'a:1:{s:4:"50::";i:1;}', '', 1, 3, 1, '182.253.72.147', 1, 1, '', '2014-05-14 17:05:00'),
(3, 0, 'Suhendar', 'sSUhendar', 'hendarsyahss2@gmail.com', '08777777', '77777', 'c64f340ad07ddab0ccdb57ae24553c9c29933c0c', '4c44b61fb', 'a:2:{s:4:"50::";i:1;s:4:"30::";i:1;}', '', 1, 5, 1, '202.62.24.101', 1, 1, '', '2014-05-15 02:04:21'),
(4, 0, 'Suhendar', 'sSUhendar', 'hendarsyahss@yahoo.co.id', '0852228', '56480258585', 'c64f340ad07ddab0ccdb57ae24553c9c29933c0c', '4c44b61fb', 'a:2:{s:4:"50::";i:1;s:4:"51::";i:1;}', '', 1, 6, 1, '182.253.72.147', 1, 1, '', '2014-05-15 18:33:58'),
(5, 0, 'Hendarsyah', 'SUhendar', 'hendarsyahss@gmail.com', '097868686', '7686868', 'cff0efa3da7657dd5a06088d10909a31985d51ef', '413ce7e54', 'a:1:{s:4:"47::";i:1;}', 'a:0:{}', 1, 7, 1, '202.62.24.116', 1, 1, '', '2014-05-16 16:24:13'),
(6, 0, 'nanang', 'sahudi', 'nanktoy@gmail.com', '08568223277', '', 'c64f340ad07ddab0ccdb57ae24553c9c29933c0c', '4c44b61fb', 'a:0:{}', '', 0, 9, 1, '182.253.48.16', 1, 1, '', '2014-05-24 16:29:52'),
(7, 0, 'widi', 'toro', 'shadow_flame2389@yahoo.co.id', '082131024846', '', 'c64f340ad07ddab0ccdb57ae24553c9c29933c0c', '4c44b61fb', 'a:0:{}', 'a:0:{}', 1, 10, 1, '36.73.231.13', 1, 1, '', '2014-05-28 19:12:25'),
(8, 0, 'Rio', 'Pramono', 'rio.satriapramono@gmail.com', '081222210850', '', 'c64f340ad07ddab0ccdb57ae24553c9c29933c0c', '4c44b61fb', 'a:0:{}', '', 0, 12, 1, '139.228.35.4', 1, 1, '', '2014-05-30 04:33:10'),
(9, 0, 'Moch Rezani', 'Ikhsan', 'rezani99@yahoo.com', '087881157180', '', 'c64f340ad07ddab0ccdb57ae24553c9c29933c0c', '4c44b61fb', 'a:1:{s:4:"50::";i:1;}', '', 0, 13, 1, '106.187.55.25', 1, 1, '', '2014-06-01 16:10:13'),
(10, 0, 'Darsono', 'S. Pd.', 'soni_dno@yahoo.co.id', '081564873666', '', 'c64f340ad07ddab0ccdb57ae24553c9c29933c0c', '4c44b61fb', 'a:0:{}', 'a:0:{}', 0, 14, 1, '180.214.232.76', 1, 1, '', '2014-06-01 23:00:44'),
(11, 0, 'Ramdani', 'Ramdani', 'ramdani.ramdani@gmail.com', '0811964940', '', 'c64f340ad07ddab0ccdb57ae24553c9c29933c0c', '4c44b61fb', 'a:0:{}', '', 0, 15, 1, '180.214.232.83', 1, 1, '', '2014-06-16 10:10:14'),
(12, 0, 'RAHI RAMA', 'DEWA', 'MASIRVAN@YMAIL.COM', '089677573388', '', 'c64f340ad07ddab0ccdb57ae24553c9c29933c0c', '4c44b61fb', 'a:0:{}', '', 0, 16, 1, '36.73.231.79', 1, 1, '', '2014-06-22 05:09:08'),
(13, 0, 'Hedi ', 'Awal', 'hedi.awal@yahoo.com', '08884300458', '', 'c64f340ad07ddab0ccdb57ae24553c9c29933c0c', '4c44b61fb', 'a:3:{s:4:"57::";i:1;s:4:"62::";i:1;s:4:"72::";i:1;}', '', 0, 17, 1, '114.79.29.120', 1, 1, '', '2014-06-25 02:26:16'),
(14, 0, '0', '', '0', '0', '', 'c64f340ad07ddab0ccdb57ae24553c9c29933c0c', '4c44b61fb', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(15, 0, 'Muhammad Charistha', 'Lampung', 'muhammad.charistha@gmail.com', '082312989382', '', 'c64f340ad07ddab0ccdb57ae24553c9c29933c0c', '4c44b61fb', 'a:1:{s:4:"47::";i:1;}', '', 1, 19, 1, '203.99.110.3', 1, 1, '', '2014-06-25 10:39:13'),
(16, 0, 'SUNSHINE TECHNICA INDONES', '', 'ssuhendar@bdo.co.id', '08522054064', '', 'c64f340ad07ddab0ccdb57ae24553c9c29933c0c', '4c44b61fb', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(17, 0, 'je', 'mono', 'monoku_fujimatsu@yahoo.co.id', '6285782300514', '', 'c64f340ad07ddab0ccdb57ae24553c9c29933c0c', '4c44b61fb', 'a:1:{s:4:"73::";i:1;}', 'a:0:{}', 1, 21, 1, '114.124.27.158', 1, 1, '', '2014-06-28 16:18:58'),
(18, 0, 'imre', 'mussuary', 'imre.mussuary@gmail.com', '085289598889', '', 'c64f340ad07ddab0ccdb57ae24553c9c29933c0c', '4c44b61fb', 'a:0:{}', '', 0, 22, 1, '202.62.17.188', 1, 1, '', '2014-06-30 03:46:51'),
(19, 0, 'Yosua', 'Sihombing', 'yosua.andryanto@gmail.com', '082369984500', '', 'c64f340ad07ddab0ccdb57ae24553c9c29933c0c', '4c44b61fb', 'a:1:{s:4:"73::";i:1;}', '', 0, 23, 1, '114.125.42.16', 1, 1, '', '2014-06-30 08:50:22'),
(20, 0, 'arsianto', 'arsianto', 'antoarsianto@gmail.com', '0811880456', '', 'c64f340ad07ddab0ccdb57ae24553c9c29933c0c', '4c44b61fb', 'a:0:{}', '', 0, 24, 1, '103.23.117.4', 1, 1, '', '2014-07-01 06:44:57'),
(21, 0, 'arif', 'yusufiyana', 'arif_yusufiyana@yahoo.co.id', '08999288860', '', 'c64f340ad07ddab0ccdb57ae24553c9c29933c0c', '4c44b61fb', 'a:0:{}', '', 1, 26, 1, '180.214.233.30', 1, 1, '', '2014-07-02 21:46:47'),
(22, 0, 'Hady', 'Surya', 'hady_surya@hotmail.com', '0811827317', '', 'c64f340ad07ddab0ccdb57ae24553c9c29933c0c', '4c44b61fb', 'a:0:{}', '', 0, 27, 1, '180.243.162.48', 1, 1, '', '2014-07-03 07:17:20'),
(23, 0, 'Hendarsyah Suhendar', '', 'hendarsyahss@gmail.com', '08533580000', '', 'cff0efa3da7657dd5a06088d10909a31985d51ef', '413ce7e54', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(24, 0, 'Hendarsyah Suhendar', '', 'hendarsyahss@gmail.com', '08533580000', '', 'cff0efa3da7657dd5a06088d10909a31985d51ef', '413ce7e54', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(25, 0, 'Hendarsyah Suhendar', '', 'hendarsyahss11@gmail.com', '08533580000', '', 'c64f340ad07ddab0ccdb57ae24553c9c29933c0c', '4c44b61fb', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(26, 0, 'Eva Dwiana ', 'Damanik', 'misahe.lie@gmail.com', '08129848591', '0', 'c64f340ad07ddab0ccdb57ae24553c9c29933c0c', '4c44b61fb', NULL, NULL, 0, 28, 1, '118.97.95.19', 1, 1, '', '2014-07-06 08:01:47'),
(27, 0, 'Budy Darma', 'Muljadi', 'budy.darma.muljadi@gmail.com', '5445776', '', '3f2fdcb0a6728d48dad0c50d4952bbbd519db4c2', 'bad4b8e4e', 'a:0:{}', '', 1, 29, 1, '139.195.193.53', 1, 1, '', '2014-07-07 16:27:20'),
(28, 0, 'Suhendar', '', 'hendarsyahss3@gmail.com', '08011988', '', 'ec7ade9b0f7feb9965d3cd386855ca72a631851b', '8dba5c05e', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(29, 0, 'Hendarsyah Suhendar', '', 'hendarsyahss4@gmail.com', '08011988', '', '4cbf73d2707ac94c2144d2ff3f5cb7d2d4b35caa', '83e473d91', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(30, 0, 'Hendarsyah Suhendar', '', 'hendarsyahss4@gmail.com', '08011988', '', '555916c388232ddb965158bdea31596b79dad350', '59ea4ed01', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(31, 0, 'Hendarsyah Suhendar', '', 'hendarsyahss4@gmail.com', '08011988', '', 'ca6292709efa0b4976193c21aa5b2249032a497d', '8422fec96', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(32, 0, 'Hendarsyah Suhendar', '', 'hendarsyahss4@gmail.com', '08011988', '', '5faa9f741390cb96e7daee4ae24ac8092ad30228', 'bbde308be', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(33, 0, 'Hendarsyah Suhendar', '', 'hendarsyahss4@gmail.com', '08011988', '', '6a2d8613656547d0c5d3868c0fd57f43964d292a', 'c8352c4a2', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(34, 0, 'Hendarsyah Suhendar', '', 'hendarsyahss4@gmail.com', '08011988', '', '4c3c1d29080e522dd4321d288db304d11c1e57b2', '7ac1886c1', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(35, 0, 'Hendarsyah Suhendar', '', 'hendarsyahss6@gmail.com', '08533580000', '', 'f189bdc41035b42ac4256f2e27db0a493daef8b9', '82402832b', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(36, 0, 'Hendarsyah Suhendar', '', 'hendarsyahss9@gmail.com', '08533580000', '', '938e365982f8e4a98ef4049a6bff3e03f16a036b', 'd4b862e57', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(37, 0, 'Ades', 'Saputra', 'adezpatra1191@gmail.com', '08562918986', '', '406c8a5f9798e26ce1e1f2098f01fc64cc9f8f1a', '627ec8d4d', 'a:0:{}', '', 0, 30, 1, '202.62.17.57', 1, 1, '', '2014-07-09 10:15:56'),
(38, 0, 'Rizqan', 'Rusli', 'renoveva@yahoo.com', '0217402313', '', 'bf93d8b15ce97f38798766922343457c44b6bd7b', '934042f96', 'a:2:{s:4:"31::";i:4;s:4:"51::";i:1;}', '', 0, 31, 1, '112.215.66.79', 1, 1, '', '2014-07-09 17:46:43'),
(39, 0, 'Fikri Deva Ariesta ', 'Fikri Deva Ariesta ', 'vikri07@gmail.com', '+628567931383', '', 'fb52223c1801b93830f52321300b586875eabcec', '247a9dfce', 'a:0:{}', 'a:2:{i:0;s:2:"72";i:1;s:2:"50";}', 1, 40, 1, '64.233.173.101', 1, 1, '', '2014-07-12 22:18:01'),
(40, 0, 'Abid', 'NasiRO', 'abidfathin@rocketmail.com', '085742392008', '', '8ce976efa6cb008fffbb9dd379c4eba62efebd2a', '02cf219a1', NULL, NULL, 1, 34, 1, '202.67.41.51', 1, 1, '', '2014-07-13 03:26:44'),
(41, 0, 'agung', 'cahyono', 'nutrisby@gmail.com', '085231088238', '', '1af050d07f298a3d6d5e85563059358ee01df8b2', '06a937238', 'a:0:{}', '', 1, 35, 1, '39.208.119.252', 1, 1, '', '2014-07-14 22:08:25'),
(42, 0, 'Wahyu', 'Budhi Trapsilo', 'wahyu.caterpillar@gmail.com', '081351791087', '', '64e02a3af82c1f0f0aece04d90c9592a275362f7', '3c126b40f', 'a:0:{}', '', 0, 36, 1, '64.233.173.26', 1, 1, '', '2014-07-15 10:10:07'),
(43, 0, 'Yohanes Hendro', 'Pranyoto, S.Pd.', 'yohaneshenz@gmail.com', '085777111706', '', 'f0de56784b18a3f75ddac57852c26ec36a7150b7', '4e9d0de16', 'a:2:{s:4:"50::";i:6;s:4:"72::";i:4;}', '', 0, 37, 1, '114.121.130.252', 1, 1, '', '2014-07-16 02:12:08'),
(44, 0, 'Ahmad zaini', ' Praja', 'Alpha_zn@yahoo.com', '081809653045', '', 'f3d54f492127faf2d09775f14f122260b0b78f28', 'f90a7bd9b', 'a:0:{}', 'a:0:{}', 0, 38, 1, '180.214.233.38', 1, 1, '', '2014-07-16 10:10:43'),
(45, 0, 'Firman', 'Akhmadi Handoyo', 'firman.handoyo@gmail.com', '085642579861', '', '92927ed109d483c26cd2d5a7a12e0282672e9315', '8b25ab85b', 'a:0:{}', '', 0, 42, 1, '139.255.35.34', 1, 1, '', '2014-07-22 02:45:03'),
(46, 0, 'm', 'indroharto', 'indroharto2100@gmail.com', '081310705566', '', '6472377a97635f838477e465ea52f986940e2b63', '61570138b', 'a:3:{s:4:"57::";i:1;s:4:"77::";i:1;s:4:"42::";i:1;}', 'a:0:{}', 0, 44, 1, '180.214.232.87', 1, 1, '', '2014-07-23 07:19:03'),
(47, 0, 'philip', 'juned', 'philip.juned@gmail.com', '085641817575', '', '55b1a0a04112935fd254e18df6ea7d71ccc1b145', '5f36ad9a4', 'a:1:{s:4:"50::";i:1;}', '', 0, 45, 1, '118.96.128.122', 1, 1, '', '2014-07-23 08:32:49'),
(48, 0, 'w', 'd', 'si_marlin@yahoo.co.id', '031', '', 'd9b720de4e319db6edbc003dd191a3711af2df8d', '849fdc764', 'a:0:{}', '', 0, 46, 1, '114.79.29.133', 1, 1, '', '2014-07-29 16:18:34'),
(49, 0, 'DANIEL', 'MIDIAN', 'dhanielmdt@gmail.com', '085249082500', '', 'e8fd7064764e8bf34e8d802e9340225e760189d7', '92af94393', 'a:0:{}', '', 0, 47, 1, '112.215.36.145', 1, 1, '', '2014-08-05 11:05:38'),
(50, 0, 'Wengky', 'Indrawan', 'wengky.indrawan@gmail.com', '085286363499', '', '6953fd2bfe514b98a56bb2c322e6734d8e281499', '4cdebb595', 'a:0:{}', '', 1, 48, 1, '103.4.167.70', 1, 1, '', '2014-08-08 02:51:18'),
(51, 0, 'cikay', '', 'andikaascikay@gmail.com', '087890909089', '', 'c6d7a8660462a6285dcd06cf1ebe009a029373c3', 'ea6227c76', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(52, 0, 'yofa6167', '', 'vespacr7mu@yahoo.co.id', '082113062003', '', '2f6cc25540401241754e4e11b53d4746e28072e1', 'c6d026083', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(53, 0, 'Parmin Limiaty ', '', 'antony@gmail.com', '085691255819', '', 'ef0af44e007f2fe6e7a0fe95d1b6123b894c6dec', '3e7bad663', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(54, 0, 'Sensa J', '', 'guest@maholga.com', '085222054064', '', '4a359c23910fc7339d8db81d16ddcc686cfe7fd3', '676f1d584', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(55, 0, 'Adit Citra Garden', '', 'aditsheshosk8@yahoo.co.id', '08998883453', '', 'f6268bcc60e0ec2500efacc6bc28f2f6b0b9916d', '29f088ca6', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(56, 0, 'Teuku zikril Fallach', '', 'Zicrilteuku@yahoo.com', '082220575534', '', 'ca0d420d7cb25b2cb6d5e7c50219682c31596d75', '720171916', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(57, 0, 'Zoel fadhlan', '', 'Zicrilteuku@gmail.com', '082220575534', '', '0e707ad1a4a0178f1b62a6c7ceef7e660a0623b1', '232b16926', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(58, 0, 'Farsi el haq', '', 'elhaqf@gmail.com', '082110196125', '', '6b2811b7ece8b08a191994d036ea5929079905a3', 'dda463365', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(59, 0, 'Coddy Simanjuntak', '', 'codzjuntax89@gmail.com', '085212627771', '', '061b05b7ae3304e6c0c7aac0701569b240290b95', '9d5e91d12', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(60, 0, 'hardi', '', 'chyanhan@gmail.com', '08117103940', '', '8ea738ebc8047e71a8bad2dea7d38bdca79d4f05', 'd11b23acb', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(61, 0, 'Eleonora gandesa', '', 'Eleonoragandesaputri@gmail.com', '085249558558', '', '725f85e5a10e4162219887456c702ed88528728f', '445fce756', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(62, 0, 'Johnny Nahumury', '', 'johnny_nahumury@yahoo.co.id', '081344183595', '', 'b6888dc74b5e6097b891476d6d6ad0f0827a840e', '7730e3183', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(63, 0, 'yudha', '', 'yudhac06@gmail.com', '081908199670', '', '2334eb5e0a49c70716745b25ee507bd3fe7320f9', '12ab289e6', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(64, 0, 'Nur Chaeriyah', '', 'nurchaeriyah18@yahoo.co.id', '085221387888', '', '78b2d24069de9388241789491840c9b3e36b0d66', 'a61745c05', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(65, 0, 'Coddy Simanjuntak', '', 'coddysimanjuntak@windowslive.com', '081932452678', '', '4cd063071ea640333c208fab91d6011ac1522841', '947846e83', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(66, 0, 'Okky Putra', '', 'okkyputraarganata@gmail.com', '085725735620', '', '8930c83e1bc90f5e42468d7c98f22cc8a7a528d3', '03f1543a3', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(67, 0, 'paramita', '', 'nunpiyu@yahoo.com', '085746846540', '', '83da8748e5ba5595832b23d386e88d471ad9fca0', 'd9a8cb2e1', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(68, 0, 'paramita', '', 'nunpiyu@gmail.com', '085746846540', '', 'db6af86b88c4b334227426fc2b0be0f4586cdc6d', '08d05650e', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(69, 0, 'nun', '', 'nunpiyu@gmail.com', '085746846540', '', '9b4d4c5f86fb6cabb911b8b6781223d6d3185140', '93f466762', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(70, 0, 'nun', '', 'nunpiyu@gmail.com', '085746846540', '', 'eb3a7108f4bc880eb19b66cc714ede3f59590997', 'ab37b205b', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(71, 0, 'nun', '', 'nunpiyu@gmail.com', '085746846540', '', '58b3f570aede771f3f7e106b7ca68e57cdbbb447', '368dfaccf', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(72, 0, 'nun', '', 'nunpiyu@gmail.com', '085746846540', '', '5cefdd2b4e5b89c02f5fc835b03ac08eb62a151e', '09cc3526a', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(73, 0, 'nun', '', 'nunpiyu@gmail.com', '085746846540', '', 'cfde4ac46ba7179186261ca06d0cdf5ee9df1233', '8649ce36e', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(74, 0, 'GoZXJvjrhR', '', 'a.f.fini.t.yn.ecp.w@gmail.com\n', '123456', '', 'a2cec92c3f6cd418484a2cb13c05bdec0e9164a7', '5077517b5', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(75, 0, 'AfPSYqlvlU', '', 'a.ffini.t.yn.ec.p.w@gmail.com\n', '123456', '', 'ee3275e5fee60d14e0bc02b0c558236d2784b7c9', 'd0a4a8134', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(76, 0, 'Usep Rusnandar', '', 'usep.rusnandar@gmail.com', '082198888872', '', '18ba6eff02cc468f1e76c5692a79dffefe2fe787', '2a2a17cec', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(77, 0, 'dmahvEqt', '', 'ep.iphyllumas2@gmail.com', '123456', '', '693ce975e237b862d7eb9491e557c8c048269523', 'a2c526073', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(78, 0, 'gddaccvacki', '', 'wkmduh@dvcmsx.com', '31222127683', '', '6eaa4affe78b2cd606737f1d13ce6612713dcaf4', '601ecc058', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(79, 0, 'saiful', '', 'a.saiful.rahman@gmail.com', '085772005895', '', '7d819be944cc4556d0554a5c808d324b051854df', 'e5cf7315f', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(80, 0, 'Iisshop', '', 'Iisshop843@gmail.com', '08972270900', '', '0a06d1a33f188a8aba57db36575e5c7b8f18fe4c', '644f02f0d', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(81, 0, 'Tirta Adi Gunawan', '', 'tirtavium@gmail.com', '082112664634', '', '04a13db1f68c2633330219c824c5cd55c62e57e6', 'c69667c49', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(82, 0, 'reynaldy rizky', '', 'takerouw@yahoo.com', '12310390', '', 'dfdc9e9be54b1d359529248567b0bc9c05efb3ec', '877e4b21d', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(83, 0, 'asd', '', 'asdsad1265as1d@dsf15.gf', '0857741444444', '', '2cffbc095c9ff9a06d43c935c552ae8a91a2c46d', 'b9776696f', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(84, 0, 'mart', '', 'bingmart2614@gmail.com', '081284018460', '', '1340bd9d6fac3adee2f35ae06574f369893fbef6', '32d90571a', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(85, 0, 'wanrcfnyab', '', 'munuxiayo390@126.com', '123456', '', '381918663434c187a74f03164ff0e18d25313c56', '459c4c972', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(86, 0, 'afwpwrhtxy', '', 'thalliumn@hotmail.com', '123456', '', '8bc4d10aa76a81c3dbac34613e53ffed5dfb5745', 'efbdfc92c', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(87, 0, 'mhxruijchal', '', 'abtkxv@hvrzzz.com', 'qpOwUPqiCM', '', '67e0b0e68a4a5aa1718ac02543e4a6564494ccdf', 'b930c619b', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(88, 0, 'snododgissith', '', 'uehd.u.s.kdi.c.sj.d.us.h.ic.v@gmail.com\n', '123456', '', '56207f6dbe7751296fcb511becc2a29a09c5d2dd', '834e59b5b', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(89, 0, 'snododgissith', '', 'ue.h.du.sk.dics.j.d.ush.icv@gmail.com\n', '123456', '', 'd692d46510c5b47fb9ff4393a44526b253f39617', '52dc57942', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(90, 0, 'Deary Zulfickry', '', 'dz.ppi3@gmail.com', '081513752626', '', 'fcf4c7a1231f08f72ff1c84c06baf063418adb80', '8e2483cb9', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(91, 0, 'Titis Imam Prasetyo', '', 'tiztkj2@gmail.com', '089665796669', '', 'cfabe43a7f511acf02964d3b68731f551b30d0b2', 'a64cf9ff9', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(92, 0, 'Titis Imam Prasetyo', '', 'tiztkj2@gmail.com', '089665796669', '', '9a626ec38cc155ca6fa818adebdae286702117fe', 'ddc4039ed', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(93, 0, 'Titis Imam Prasetyo', '', 'tiztkj2@gmail.com', '089665796669', '', 'dc0408f0a8b7584d200913e10fe47533274bfee9', 'faf0b50d6', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(94, 0, 'tri septian rizki aditya', '', 'triseptianrizkiaditya@yahoo.co.id', '081294640916', '', '2f626906714df1bb2f55e344e82cf26fa58c5a39', '7593c379f', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(95, 0, 'tri septian rizki aditya', '', 'triseptianrizkiaditya@yahoo.co.id', '081294640916', '', '2f626906714df1bb2f55e344e82cf26fa58c5a39', '7593c379f', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(96, 0, '0', '', '0', '0', '', 'c3c148457732178889c3bf5262e08455d8197ed6', 'd3073c98e', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(97, 0, 'Yan Rinaldi', '', 'yan.rinaldi@gmail.com', '081281232598', '', '065eb56240cd66e5d6c9829844f10d418eacc46c', '96590a70c', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(98, 0, 'cpohzzeq', '', 'pyjupx@nqymom.com', 'WXAmmVehzEUSXufhF', '', '124fd5a9cda6c5b3bf6bd06cbd64a5c39c640727', 'cc430644b', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(99, 0, '0', '', '0', '0', '', '990fabe75888887028a761cea5e743cac4cacb1c', '46fe2e8f0', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(100, 0, 'cndawppdvp', '', 'sfqgyr@odukkr.com', 'YhRhoOTsHF', '', '8650676d7f29d3f0b2a99bd6c6c4d46e51d03a55', 'b2b428791', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(101, 0, '0', '', '0', '0', '', '6c5f902e16bf40c3f4d041b754a404e8eb3fd924', 'ff13e67b0', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(102, 0, 'zyvobzmgo', '', 'pxyier@xutjhg.com', '46030223410', '', '2109a62befc964f80568abe29f728e160436aa08', '70f663708', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(103, 0, '0', '', '0', '0', '', 'f459818708c37669b94b93d76bf57531fa649ab5', 'cf3d9c9b8', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(104, 0, 'daniel', '', 'corpus_email@yahoo.com', '08121006739', '', '8692b69b5e980fbb918b7398ac1630aa59b4f166', 'c3888da1d', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(105, 0, 'Hepy', '', 'hepyes@yahoo.com', '082123376701', '', 'a7782278ceadb4d154903dfdb08bfead8e368e57', '35663e60f', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(106, 0, 'varlog', '', 'darel233455@gmail.com', '85217872894', '', '20bb5e26790013f275f22fff957b1d16c02d27ba', 'ca64cfb88', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(107, 0, '0', '', '0', '0', '', 'ae689e681eb93034769d1b811cdc28a6b6a27f4e', '273c97f69', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(108, 0, 'Hendra Ariawan', '', 'hendra.ariawan@gmail.com', '085624166660', '', '8dcbf9ef399e87da9c3cf132755f94ca05fce185', 'e86714565', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(109, 0, 'varlog', '', 'darel233455@gmail.com', '96859291401', '', '1926d1f550d02d52e67f11cc2aa1386fdaae6738', '7a9d2357b', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(110, 0, '0', '', '0', '0', '', '0bd054d4777b9784bd6557204dbba2a76adec963', '484e517af', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(111, 0, 'Sulthon', '', 'sulthonkun0@gmail.com', '082140174023', '', '312de9fb600fecc6f65de094d799d1b5a4608211', '8eba7e708', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(112, 0, 'Sulthon', '', 'sulthonkun0@gmail.com', '082140174023', '', 'd4299bd82f18e7b598017ca8bf25800a4f07c9b6', 'e9fca6413', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(113, 0, 'kazfsd', '', 'lyrosc@bfanbz.com', '54795418825', '', 'ae7ed598a63e9f437c431111febc450050111403', '97546d923', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(114, 0, '0', '', '0', '0', '', '34c21aa75d40c925046a6833c8901e37f7e881a6', 'd9fe18670', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(115, 0, 'Robby', '', 'robby_punyanih@yahoo.com', '081295299898', '', '1168dd6f07ae05788bb7d83210671be7a73c48af', '0b3b171b3', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(116, 0, 'Agung Kus Sugiharto', '', 'kussugi@gmail.com', '08129221833', '', 'a73294bf6622c4d234ff19b7e450f27ef919550b', 'bf48ad992', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(117, 0, 'Agung Kus Sugiharto', '', 'kussugi@gmail.com', '08129221833', '', 'bde68b7972f347ca13a3f6d0f87b6e485a1779f9', 'c256833cf', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(118, 0, 'Edward Lie', '', 'edward.lie@gmail.com', '085327770666', '', '46e63545ee4aeeba233445ed05b7bb2c4101b8a3', 'db878a717', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(119, 0, 'Ari hidayat', '', 'squidy_spons@yahoo.com', '081296695693', '', '0374b68da6dd2aca0b99b34ad07c51b7ed7d1438', 'b3ce04c51', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(120, 0, 'Andika Sulis', '', 'andikasulispratama@yahoo.co.id', '089884506943', '', '78ada28e85be066f4a823ab8bd859ea844394dc6', '1f9838984', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(121, 0, 'Prasetio Wibowo', '', 'wibowo.prasetio@gmail.com', '081212822440', '', '54d4bb777772aec53dc14ed343d26f150000272b', 'b0fcaa6d8', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(122, 0, 'Prasetio Wibowo', '', 'wibowo.prasetio@gmail.com', '081212822440', '', '9d1d7c5de2ab143956df1fb04b7826b4cf0c2561', '5c0a3631c', NULL, NULL, 0, 0, 0, '0', 0, 0, '', '0000-00-00 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
