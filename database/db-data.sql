-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2015 at 11:32 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `vileostore`
--

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE IF NOT EXISTS `banner` (
`id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `slide` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `link_url` varchar(255) DEFAULT NULL,
  `description` text,
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id`, `name`, `status`, `position`, `slide`, `image`, `width`, `height`, `link_url`, `description`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 'MAC', 1, 'home', 'slideshow', '01.jpg', NULL, NULL, 'http://apple.co.id', 'Our payment platform', 1, '2015-02-09 16:47:25', NULL, NULL),
(2, 'HP', 1, 'home', 'slideshow', '2.jpg', NULL, NULL, NULL, 'management tools for both ', 1, '2015-02-09 16:47:25', NULL, NULL),
(3, 'MAC OS', 1, 'home', 'slideshow', '3.jpg', NULL, NULL, NULL, 'Our payment platform provides you ', 1, '2015-02-09 16:47:25', NULL, NULL),
(5, 'Samsung', 1, 'home', 'static', '1.jpg', 470, 146, NULL, 'with easy-to-use managemen', NULL, NULL, NULL, NULL),
(6, 'Watch', 1, 'home', 'static', '2.jpg', 470, 146, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE IF NOT EXISTS `brand` (
`id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `name`, `logo`, `status`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 'Nokia', 'brand1.png', 1, 1, '2015-02-09 10:03:51', NULL, NULL),
(2, 'Canon', 'brand2.png', 1, 1, '2015-02-09 10:03:51', NULL, NULL),
(3, 'Samsung', 'brand3.png', 1, 1, '2015-02-09 10:03:51', NULL, NULL),
(4, 'Apple', 'brand4.png', 1, 1, '2015-02-09 10:03:51', NULL, NULL),
(5, 'HTC', 'brand5.png', 1, 1, '2015-02-09 10:03:51', NULL, NULL),
(6, 'LG', 'brand6.png', 1, 1, '2015-02-09 10:03:51', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
`id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1' COMMENT '1=active ,2 = deactive',
  `parent_id` int(11) DEFAULT '0',
  `order` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `slug`, `icon`, `status`, `parent_id`, `order`) VALUES
(1, 'Perdana & Voucher', 'perdana-iternet', 'dribble', 1, 0, NULL),
(2, 'Perdana Internet Bolt', 'perdana-internet-bolt', NULL, 1, 1, NULL),
(3, 'Perdana Internet Telkomsel', 'perdana-internet-telkomsel', NULL, 1, 1, NULL),
(4, 'Perdana Internet Indosat', 'perdana-internet-indosat', NULL, 1, 1, NULL),
(5, 'Perdana Internet XL & AXIS', 'perdana-internet-xl', NULL, 1, 1, NULL),
(6, 'Perdana Internet Three', 'perdana-internet-three', NULL, 1, 1, NULL),
(7, 'Handphone & Part', 'handphone', 'phone', 1, 0, NULL),
(8, 'Keitai Jepang', 'keitai-jepang', NULL, 1, 7, NULL),
(9, 'Game Controller', 'game-controller', NULL, 1, 7, NULL),
(10, 'Baterai Handphone', 'baterai', NULL, 1, 7, NULL),
(11, 'Power Bank', 'powerbank', NULL, 1, 7, NULL),
(12, 'Sim Adapter', 'sim-adapter', NULL, 1, 7, NULL),
(13, 'Networking & Part', 'networking', NULL, 1, 0, NULL),
(14, 'Modem MIFI GSM', 'modem-mifi-4g', NULL, 1, 13, NULL),
(15, 'Modem Dongle USB GSM', 'modem-usb-gsm', NULL, 1, 13, NULL),
(16, 'Modem Dongle USB CDMA', 'modem-dongle-cdma', NULL, 1, 13, NULL),
(17, 'Pigtail Modem', 'pigtail-modem', NULL, 1, 13, NULL),
(18, 'Antena Modem', 'antena-modem', NULL, 1, 13, NULL),
(19, 'Baterai Modem MIFI', 'baterai-modem-mifi', NULL, 1, 13, NULL),
(20, 'Memory & Storage', 'memory-storage', NULL, 1, 0, NULL),
(21, 'Microsd', 'micro-sd', NULL, 1, 20, NULL),
(22, 'Flashdisk', 'flashdisk', NULL, 1, 20, NULL),
(23, 'Card Reader', 'card-reader', NULL, 1, 20, NULL),
(24, 'Card Reader', 'card-reader', NULL, 1, 20, NULL),
(25, 'Peripheral & Aksesoris', 'peripheral-aksesoris', NULL, 1, 0, NULL),
(26, 'Mouse', 'mouse', NULL, 1, 25, NULL),
(27, 'Keyboard', 'keyboard', NULL, 1, 25, NULL),
(28, 'Mouse Pad', 'mouse-pad', NULL, 1, 25, NULL),
(29, 'Game Controller', 'game-controller', NULL, 1, 25, NULL),
(30, 'Kabel VGA', 'kabel-vga', NULL, 1, 25, NULL),
(31, 'Vaporizer', 'vaporizer', NULL, 1, 0, NULL),
(32, 'Rokok Elekrik', 'ecigarete-device', NULL, 1, 31, NULL),
(33, 'Isi Ulang Rokok Elekrik', 'refill-cigarete', NULL, 1, 31, NULL),
(34, 'Isi Ulang Rokok Elekrik', 'refill-cigarete', NULL, 1, 31, NULL),
(35, 'Promo & Deal', 'promo & deal', NULL, 1, 0, NULL),
(36, 'Limited Deal', 'limited-deal', NULL, 1, 35, NULL),
(37, 'Promo Mingguan', 'weekend promo', NULL, 1, 35, NULL),
(38, 'Promo Akhir Bulan', 'promo-akhir bulan', NULL, 1, 35, NULL),
(39, 'Special Offer', 'special-offer', NULL, 1, 35, NULL),
(40, 'Hot Deal', 'hot-deal', NULL, 1, 35, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `discusion`
--

CREATE TABLE IF NOT EXISTS `discusion` (
`id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `description` text,
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `discusion`
--

INSERT INTO `discusion` (`id`, `product_id`, `user_id`, `description`, `created_by`, `created_date`) VALUES
(1, 2, 2, 'West Ham United memutuskan kontrak Ravel Morrison, mantan gelandang didikan akademi Manchester United yang juga pemain tim nasional Inggris U-21, demikian diumumkan oleh klub pada Minggu (8/2).', NULL, '2015-02-08 22:33:50'),
(2, 2, 1, 'Pemain berusia 22 tahun tersebut memulai kariernya bersama Man United sebelum bergabung dengan West Ham pada 2012. Namun ia gagal untuk mendapatkan tempat di Upton Park.', NULL, '2015-02-08 22:33:50'),
(3, 2, 2, NULL, 2, '2015-02-08 23:21:12'),
(12, 2, 2, 'sadsadasdad', 2, '2015-02-08 23:45:56'),
(13, 2, 2, 'sadasdasd', 2, '2015-02-08 23:45:59'),
(14, 2, 2, 'mantap gan', 2, '2015-02-08 23:46:04'),
(15, 1, 2, 'Free internet 1 tahun, fair quota 10GB. Setelah Kuota habis hanya bisa akses ke 11 situs populer tertentu selama setahun dari pertama kali kartu di aktifkan. Kartu ini sudah aktif dari Januari 2015 sampai dengan Januari 2016. Kartu yang sudah di gunakan t ', 2, '2015-02-09 09:54:32');

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

CREATE TABLE IF NOT EXISTS `newsletter` (
`id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `newsletter`
--

INSERT INTO `newsletter` (`id`, `email`, `created_date`) VALUES
(1, 'hendarsyahss@gmail.com', '2015-02-09 00:00:00'),
(2, 'hendarsyahss2@gmail.com', '2015-02-09 00:00:00'),
(3, 'hendarsyahss3@gmail.com', '2015-02-09 00:00:00'),
(4, 'hendarsyahss4@gmail.com', '2015-02-09 00:00:00'),
(5, 'hendarsyahss5@gmail.com', '2015-02-09 00:00:00'),
(6, 'hendarsyahss10@gmail.com', '2015-02-09 14:51:54'),
(7, 'hendarsyahss9@gmail.com', '2015-02-09 14:52:43'),
(8, 'hendarsyahss11@gmail.com', '2015-02-09 14:53:06'),
(9, 'hendarsyahss13@gmail.com', '2015-02-09 14:53:18');

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE IF NOT EXISTS `page` (
`id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `content` longtext,
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
`id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `price` double DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `short_description` tinytext,
  `long_description` longtext,
  `online` tinyint(1) DEFAULT '1',
  `cod` tinyint(1) DEFAULT '0',
  `dropshier` tinyint(1) DEFAULT '1',
  `stock` int(11) DEFAULT NULL,
  `review` int(11) DEFAULT NULL,
  `counter` int(11) DEFAULT '0',
  `best_seller` int(11) DEFAULT '0',
  `total_sell` int(11) DEFAULT '0',
  `created_by` int(11) DEFAULT '1',
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `slug`, `brand_id`, `status`, `price`, `image`, `short_description`, `long_description`, `online`, `cod`, `dropshier`, `stock`, `review`, `counter`, `best_seller`, `total_sell`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 'THREE - Always On AON 12 Bulan 10GB', 'three-always-on-aon-12-bulan-kuota-10gb', 1, 1, 89000, 'c1.jpg', 'Free internet 1 tahun, fair quota 10GB. Setelah Kuota habis hanya bisa akses ke 11 situs populer tertentu selama setahun dari pertama kali kartu di aktifkan. Kartu ini sudah aktif dari Januari 2015 sampai dengan Januari 2016. Kartu yang sudah di gunakan t', 'Kapan terakhir kali kamu mencicipi kebebasan berinternet tanpa banyak syarat? Mulai dari adanya batasan waktu, masa pakai yang singkat, hingga kuota yang selalu hangus jika tidak digunakan ketika masa pakai telah berakhir.\r\nPada akhirnya, kebebasan menjadi batasan yang membuat kamu menjadi lebih boros. Apalagi dengan adanya ketentuan "pemakaian wajar" yang membuat kecepatan internetmu berkurang, atau bahkan bisa terjebak membayar lebih mahal setelah kuota yang ditentukan habis.\r\nJika kamu merasa kebebasan itu omong kosong.', 1, 0, 1, 11, 0, 1, 1, NULL, 1, NULL, NULL, NULL),
(2, 'THREE - Internet Sepuasnya 3 Bulan (1GB)', 'three-always-on-aon-12-bulan-kuota-1gb', 2, 1, 23000, 'three1.gif', 'Kartu Perdana THREE 3 UNLIMITED GRATIS 3 BULAN. Bisa dipakai di seluruh indonesia selama masih ada sinyal Three 3 dengan koneksi super ngebut tanpa putus. Speed Up to 3.6 Mbps Quota 1 GB per bulan. Setelah 3 Bulan, per bulannya Rp. 35.000,- (Belum termasu', 'Perdana Three unlimited , free 3 bulan internet, iuran bulanan selanjutnya (bulan ke-4 dst) @Rp 35.000,- (BELUM TERMASUK PPN)\r\n\r\nPenjelasan :\r\nTri, operator jaringan GSM milik PT Hutchison CP Telecommunication kini ambil bagian dalam meningkatkan penggunaan internet masyarakat Indonesia. Mereka menghadirkan layanan mobile broadband berbasis HSPA (High Speed Packet Access). Yang dilengkapi dgn paket berlangganan data & modem mulai 18 Februari 2010.\r\n\r\nSetelah 3 bulan, pelanggan dikenakan tarif akses Rp 35.000/bulan (belum termasuk PPN). Pelanggan bisa mengisi ulang pulsa internet ini dgn pulsa regular Tri.\r\n\r\nLayanan ini didukung oleh teknologi HSPA Tri yng menawarkan kecepatan sampai dgn 1,8 Mbps utk HSDPA (High Speed Downlink Packet Access) & 1,4 Mbps utk HSUPA (High Speed Uplink Packet Access).', 1, 0, 1, 11, 0, 1, 1, NULL, 1, NULL, NULL, NULL),
(3, 'THREE - Internet Sepuasnya 3 Bulan (1GB)', 'three-always-on-aon-12-bulan-kuota-1gb', 3, 1, 23000, 'three1.gif', 'Kartu Perdana THREE 3 UNLIMITED GRATIS 3 BULAN. Bisa dipakai di seluruh indonesia selama masih ada sinyal Three 3 dengan koneksi super ngebut tanpa putus. Speed Up to 3.6 Mbps Quota 1 GB per bulan. Setelah 3 Bulan, per bulannya Rp. 35.000,- (Belum termasu', 'Perdana Three unlimited , free 3 bulan internet, iuran bulanan selanjutnya (bulan ke-4 dst) @Rp 35.000,- (BELUM TERMASUK PPN)\r\n\r\nPenjelasan :\r\nTri, operator jaringan GSM milik PT Hutchison CP Telecommunication kini ambil bagian dalam meningkatkan penggunaan internet masyarakat Indonesia. Mereka menghadirkan layanan mobile broadband berbasis HSPA (High Speed Packet Access). Yang dilengkapi dgn paket berlangganan data & modem mulai 18 Februari 2010.\r\n\r\nSetelah 3 bulan, pelanggan dikenakan tarif akses Rp 35.000/bulan (belum termasuk PPN). Pelanggan bisa mengisi ulang pulsa internet ini dgn pulsa regular Tri.\r\n\r\nLayanan ini didukung oleh teknologi HSPA Tri yng menawarkan kecepatan sampai dgn 1,8 Mbps utk HSDPA (High Speed Downlink Packet Access) & 1,4 Mbps utk HSUPA (High Speed Uplink Packet Access).', 1, 0, 1, 11, 0, 1, 1, NULL, 1, NULL, NULL, NULL),
(4, 'THREE - Internet Sepuasnya 3 Bulan (1GB)', 'three-always-on-aon-12-bulan-kuota-1gb', 4, 1, 23000, 'three1.gif', 'Kartu Perdana THREE 3 UNLIMITED GRATIS 3 BULAN. Bisa dipakai di seluruh indonesia selama masih ada sinyal Three 3 dengan koneksi super ngebut tanpa putus. Speed Up to 3.6 Mbps Quota 1 GB per bulan. Setelah 3 Bulan, per bulannya Rp. 35.000,- (Belum termasu', 'Perdana Three unlimited , free 3 bulan internet, iuran bulanan selanjutnya (bulan ke-4 dst) @Rp 35.000,- (BELUM TERMASUK PPN)\r\n\r\nPenjelasan :\r\nTri, operator jaringan GSM milik PT Hutchison CP Telecommunication kini ambil bagian dalam meningkatkan penggunaan internet masyarakat Indonesia. Mereka menghadirkan layanan mobile broadband berbasis HSPA (High Speed Packet Access). Yang dilengkapi dgn paket berlangganan data & modem mulai 18 Februari 2010.\r\n\r\nSetelah 3 bulan, pelanggan dikenakan tarif akses Rp 35.000/bulan (belum termasuk PPN). Pelanggan bisa mengisi ulang pulsa internet ini dgn pulsa regular Tri.\r\n\r\nLayanan ini didukung oleh teknologi HSPA Tri yng menawarkan kecepatan sampai dgn 1,8 Mbps utk HSDPA (High Speed Downlink Packet Access) & 1,4 Mbps utk HSUPA (High Speed Uplink Packet Access).', 1, 0, 1, 11, 0, 1, 1, NULL, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE IF NOT EXISTS `product_category` (
`id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`id`, `product_id`, `category_id`, `created_by`, `created_date`) VALUES
(1, 1, 6, NULL, NULL),
(2, 2, 6, NULL, NULL),
(3, 1, 39, NULL, NULL),
(4, 2, 39, NULL, NULL),
(5, 1, 40, NULL, NULL),
(6, 2, 40, NULL, NULL),
(7, 1, 36, NULL, NULL),
(8, 2, 36, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

CREATE TABLE IF NOT EXISTS `product_image` (
`id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `product_image`
--

INSERT INTO `product_image` (`id`, `product_id`, `name`, `created_by`, `created_date`) VALUES
(1, 1, 'c1.jpg', NULL, NULL),
(2, 1, 'c2.jpg', NULL, NULL),
(3, 1, 'c3.jpg', NULL, NULL),
(4, 2, 'three1.gif', NULL, NULL),
(5, 2, 'three2.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE IF NOT EXISTS `setting` (
`id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `content` longtext,
  `updated_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `name`, `content`, `updated_by`, `updated_date`) VALUES
(1, 'Store Name', 'Vileo.co.id', 1, '2015-02-10 10:01:46'),
(2, 'Hunting Phone', '0857-2053-1358', 1, '2015-02-10 10:01:46'),
(3, 'Email', 'sales@vileo.co.id', 1, '2015-02-10 10:01:46');

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
`id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`id`, `name`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 'Phone', 1, '2015-02-09 12:09:58', NULL, NULL),
(2, 'Bolt', 1, '2015-02-09 12:09:58', NULL, NULL),
(3, 'Smartphone', 1, '2015-02-09 12:09:58', NULL, NULL),
(4, 'Xiaomi', 1, '2015-02-09 12:09:58', NULL, NULL),
(5, 'Three', 1, '2015-02-09 12:09:58', NULL, NULL),
(6, 'Asus', 1, '2015-02-09 12:09:58', NULL, NULL),
(7, 'Zenfone', 1, '2015-02-09 12:09:58', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `status` tinyint(1) DEFAULT '1',
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `auth_key` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `middle_name`, `last_name`, `status`, `email`, `password`, `auth_key`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 'Suhendar', '', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'Naomi', '', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'Suhendar', '', '', 1, 'hendarsyahss@gmail.com', '$2y$13$oWrszpO.9mJdYWFuxwq4s.lHLmMBYPOZJ1LpdzrAhJxA4OXFmtGQW', NULL, NULL, '2015-02-09 16:19:17', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
 ADD PRIMARY KEY (`id`), ADD KEY `id` (`id`);

--
-- Indexes for table `discusion`
--
ALTER TABLE `discusion`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletter`
--
ALTER TABLE `newsletter`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_image`
--
ALTER TABLE `product_image`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
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
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `discusion`
--
ALTER TABLE `discusion`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `newsletter`
--
ALTER TABLE `newsletter`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `product_image`
--
ALTER TABLE `product_image`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
