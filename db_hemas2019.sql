-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2021 at 02:18 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_hemas2019`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ad_booking`
--

CREATE TABLE `tbl_ad_booking` (
  `ad_book_id` int(11) NOT NULL,
  `cus_id` int(11) NOT NULL,
  `newsp_id` char(8) NOT NULL,
  `newsad_mode_id` int(10) NOT NULL,
  `newsad_mode` varchar(30) NOT NULL,
  `adcolour_name` varchar(20) NOT NULL,
  `newsp_name` varchar(30) NOT NULL,
  `newsac_category` varchar(20) NOT NULL,
  `adcattype_desc` varchar(50) NOT NULL,
  `admode_details_size` varchar(20) NOT NULL,
  `crnt_date` date NOT NULL,
  `adpub_date` date NOT NULL,
  `ad_description` varchar(5000) NOT NULL,
  `ad_wc` int(11) NOT NULL,
  `ad_tot_price` float(15,2) NOT NULL,
  `ad_img` varchar(1000) NOT NULL,
  `ad_img_nic` varchar(1000) NOT NULL,
  `ad_img_br` varchar(1000) NOT NULL,
  `ad_img_slip` varchar(1000) NOT NULL,
  `ad_pay_status` tinyint(11) NOT NULL DEFAULT '0',
  `ad_book_status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_ad_booking`
--

INSERT INTO `tbl_ad_booking` (`ad_book_id`, `cus_id`, `newsp_id`, `newsad_mode_id`, `newsad_mode`, `adcolour_name`, `newsp_name`, `newsac_category`, `adcattype_desc`, `admode_details_size`, `crnt_date`, `adpub_date`, `ad_description`, `ad_wc`, `ad_tot_price`, `ad_img`, `ad_img_nic`, `ad_img_br`, `ad_img_slip`, `ad_pay_status`, `ad_book_status`) VALUES
(1, 1, '', 0, '0', 'Black & White', 'Sunday T', 'Automobile', 'For Sale', '4cmx1cm', '2021-04-20', '2021-04-30', 'Car for sale', 3, 1500.00, '', '', '', '', 1, 1),
(2, 1, '', 0, '0', 'Black & White', 'Sunday T', 'Automobile', 'For Sale', '4cmx1cm', '2021-04-20', '2021-04-30', 'go go go', 3, 1500.00, '', '', '', '', 1, 0),
(3, 3, '', 0, '0', 'Black & White', 'Sunday T', 'Automobile', 'For Sale', '4cmx1cm', '2021-04-20', '2021-04-23', 'go go go', 3, 1500.00, '', '', '', '', 1, 0),
(4, 12, '', 0, '4', 'CL002', 'NEWP0001', 'ACAT0004', 'ADCT0166', '3', '2021-04-20', '2021-06-17', 'Height 5\'8\", Age 28, Working as a government officer with a good salary. Call 0334567891 in afternoon.', 18, 1992.38, '', 'images/upload_image/nic_image/ACAT0004_2021-06-171618939245.jpg', '', '4.jpg', 0, 1),
(5, 12, '', 0, '5', 'CL001', 'NEWP0001', 'ACAT0005', 'ADCT0169', '3', '2021-04-21', '2021-06-27', '', 0, 0.00, 'images/upload_image/add_book_image/ACAT0005_2021-06-271618954872.png', 'images/upload_image/nic_image/ACAT0005_2021-06-271618954872.jpg', 'images/upload_image/brc_image/ACAT0005_2021-06-271618954872.jpg', '', 0, 1),
(6, 12, '', 0, '5', 'CL001', 'NEWP0001', 'ACAT0005', 'ADCT0169', '3', '2021-04-21', '2021-06-27', '', 0, 0.00, 'images/upload_image/add_book_image/ACAT0005_2021-06-271618954882.png', 'images/upload_image/nic_image/ACAT0005_2021-06-271618954882.jpg', 'images/upload_image/brc_image/ACAT0005_2021-06-271618954882.jpg', '', 0, 1),
(7, 12, '', 0, '5', 'CL001', 'NEWP0001', 'ACAT0005', 'ADCT0169', '3', '2021-04-21', '2021-06-27', '', 0, 0.00, 'images/upload_image/add_book_image/ACAT0005_2021-06-271618954890.png', 'images/upload_image/nic_image/ACAT0005_2021-06-271618954890.jpg', 'images/upload_image/brc_image/ACAT0005_2021-06-271618954890.jpg', '', 0, 1),
(8, 12, '', 0, '4', 'CL001', 'NEWP0001', 'ACAT0004', 'ADCT0166', '1', '2021-04-21', '2021-06-20', 'Height 5\'8\", Age 28, Working as a government officer with a good salary. Call 0334567891 in afternoon.', 18, 1811.25, '', 'images/upload_image/nic_image/ACAT0004_2021-06-201618964920.jpg', '', '', 1, 1),
(9, 12, '', 0, '1', 'CL001', 'NEWP0002', 'ACAT0004', 'ADCT0166', '1', '2021-04-21', '2021-06-20', 'Height 5\'8\", Age 28, Working as a government officer with a good salary. Call 0334567891 in afternoon.', 18, 1811.25, '', 'images/upload_image/nic_image/ACAT0004_2021-06-201618965276.jpg', '', '', 0, 1),
(10, 12, '', 0, '1', 'CL001', 'NEWP0001', 'ACAT0004', 'ADCT0166', '1', '2021-04-21', '2021-06-27', 'Height 5\'8\", Age 28, Working as a government officer with a good salary. Call 0334567891 in afternoon.', 18, 1811.25, '', 'images/upload_image/nic_image/ACAT0004_2021-06-271618965696.jpg', '', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ad_colour`
--

CREATE TABLE `tbl_ad_colour` (
  `adcolour_id` char(8) NOT NULL,
  `adcolour_name` varchar(20) NOT NULL,
  `adcolour_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_ad_colour`
--

INSERT INTO `tbl_ad_colour` (`adcolour_id`, `adcolour_name`, `adcolour_status`) VALUES
('CL001', 'Black & White', 1),
('CL002', 'Black & One Colour', 1),
('CL003', 'Colour', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ad_modes_details`
--

CREATE TABLE `tbl_ad_modes_details` (
  `admode_details_id` int(11) NOT NULL,
  `newsad_mode_id` int(11) NOT NULL,
  `adcolour_id` char(8) NOT NULL,
  `admode_details_size` varchar(20) NOT NULL,
  `admode_details_status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_ad_modes_details`
--

INSERT INTO `tbl_ad_modes_details` (`admode_details_id`, `newsad_mode_id`, `adcolour_id`, `admode_details_size`, `admode_details_status`) VALUES
(1, 1, 'CL001', '4cmx1cm', 1),
(2, 2, 'CL002', '8cmx6cm', 1),
(3, 2, 'CL003', 'Full page', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ad_order`
--

CREATE TABLE `tbl_ad_order` (
  `adorder_id` int(11) NOT NULL,
  `cus_id` int(11) NOT NULL,
  `ad_book_id` int(11) NOT NULL,
  `newsad_mode` varchar(30) NOT NULL,
  `adorder_date` date NOT NULL,
  `publish_date` date NOT NULL,
  `adorder_price` varchar(10) NOT NULL,
  `adorder_status` tinyint(11) NOT NULL,
  `email_status` tinyint(4) NOT NULL DEFAULT '0',
  `sms_status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_ad_order`
--

INSERT INTO `tbl_ad_order` (`adorder_id`, `cus_id`, `ad_book_id`, `newsad_mode`, `adorder_date`, `publish_date`, `adorder_price`, `adorder_status`, `email_status`, `sms_status`) VALUES
(1, 12, 4, '4', '2021-04-20', '2021-06-17', '1992.38', 1, 0, 0),
(2, 1, 1, 'Box Advertisement', '2021-04-20', '2021-04-30', '1500.00', 1, 0, 0),
(3, 12, 5, '5', '2021-04-21', '2021-06-27', '0', 0, 0, 0),
(4, 12, 6, '5', '2021-04-21', '2021-06-27', '0', 1, 0, 0),
(5, 12, 7, '5', '2021-04-21', '2021-06-27', '0', 1, 0, 0),
(6, 12, 9, '1', '2021-04-21', '2021-06-20', '1811.25', 1, 0, 0),
(7, 12, 4, '4', '2021-04-20', '2021-06-17', '1992.38', 1, 0, 0),
(8, 12, 4, '4', '2021-04-20', '2021-06-17', '1992.38', 1, 0, 0),
(9, 1, 1, '0', '2021-04-20', '2021-04-30', '1500', 1, 0, 0),
(10, 12, 8, '4', '2021-04-21', '2021-06-20', '1811.25', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_batch`
--

CREATE TABLE `tbl_batch` (
  `bat_id` varchar(10) NOT NULL,
  `grn_id` int(10) NOT NULL,
  `newsp_id` char(8) NOT NULL,
  `bat_qty` int(11) NOT NULL,
  `bat_cprice` float(15,2) NOT NULL,
  `bat_sprice` float(15,2) NOT NULL,
  `bat_rem` int(11) NOT NULL,
  `bat_rdate` date NOT NULL,
  `total_price` float(15,2) NOT NULL,
  `bat_status` tinyint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_batch`
--

INSERT INTO `tbl_batch` (`bat_id`, `grn_id`, `newsp_id`, `bat_qty`, `bat_cprice`, `bat_sprice`, `bat_rem`, `bat_rdate`, `total_price`, `bat_status`) VALUES
('BAT00001', 1, 'NEWP0001', 100, 70.00, 80.00, 0, '2019-01-04', 7000.00, 1),
('BAT00002', 2, 'NEWP0002', 50, 70.00, 80.00, 0, '2019-01-04', 3500.00, 1),
('BAT00003', 3, 'NEWP0003', 50, 50.00, 60.00, 0, '2019-01-11', 2500.00, 1),
('BAT00004', 4, 'NEWP0001', 250, 70.00, 80.00, 0, '2019-01-11', 17500.00, 1),
('BAT00005', 5, 'NEWP0013', 50, 30.00, 40.00, 0, '2019-01-13', 1500.00, 1),
('BAT00006', 6, 'NEWP0018', 100, 20.00, 30.00, 0, '2019-01-13', 2000.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_booking_pay`
--

CREATE TABLE `tbl_booking_pay` (
  `bookpay_id` int(11) NOT NULL,
  `inv_id` varchar(25) NOT NULL,
  `pay_amount` float(15,2) NOT NULL,
  `pay_date` decimal(10,0) NOT NULL,
  `pay_time` time NOT NULL,
  `pay_type` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_deliveryman`
--

CREATE TABLE `tbl_deliveryman` (
  `delm_id` char(8) NOT NULL,
  `delm_title` int(11) NOT NULL,
  `delm_name` varchar(50) NOT NULL,
  `delm_dob` date NOT NULL,
  `delm_gender` int(11) NOT NULL,
  `delm_address` varchar(100) NOT NULL,
  `delm_mobile` char(12) NOT NULL,
  `delm_email` varchar(50) NOT NULL,
  `delm_nic` varchar(12) NOT NULL,
  `delm_doj` date NOT NULL,
  `delm_status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_deliveryman`
--

INSERT INTO `tbl_deliveryman` (`delm_id`, `delm_title`, `delm_name`, `delm_dob`, `delm_gender`, `delm_address`, `delm_mobile`, `delm_email`, `delm_nic`, `delm_doj`, `delm_status`) VALUES
('DELM0001', 1, 'Saman Sugathapala', '1981-07-07', 1, 'No 98,Siyane Road,Gampaha', '0771203569', 'saman@gmail.com', '814566320V', '2017-04-03', 1),
('DELM0002', 1, 'Kithsiri Gamage', '1973-11-28', 1, '34,Bemmulla Road,Udugampola', '0776531204', 'kithsiri@gmail.com', '738845012V', '2018-06-04', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_delivery_details`
--

CREATE TABLE `tbl_delivery_details` (
  `deld_id` char(8) NOT NULL,
  `deld_date` date NOT NULL,
  `deld_time` datetime NOT NULL,
  `deld_area` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_email`
--

CREATE TABLE `tbl_email` (
  `email_id` int(11) NOT NULL,
  `cus_id` int(11) NOT NULL,
  `adorder_id` int(11) NOT NULL,
  `email_msg` varchar(1000) NOT NULL,
  `email_title` varchar(100) NOT NULL,
  `email_date` date NOT NULL,
  `email_time` time NOT NULL,
  `email_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee`
--

CREATE TABLE `tbl_employee` (
  `emp_id` char(8) NOT NULL,
  `emp_title` int(11) NOT NULL,
  `emp_name` varchar(50) NOT NULL,
  `emp_dob` date NOT NULL,
  `emp_gender` int(11) NOT NULL,
  `emp_address` varchar(100) NOT NULL,
  `emp_mobile` char(12) NOT NULL,
  `emp_email` varchar(50) NOT NULL,
  `emp_nic` varchar(12) NOT NULL,
  `emp_doj` date NOT NULL,
  `emp_status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_employee`
--

INSERT INTO `tbl_employee` (`emp_id`, `emp_title`, `emp_name`, `emp_dob`, `emp_gender`, `emp_address`, `emp_mobile`, `emp_email`, `emp_nic`, `emp_doj`, `emp_status`) VALUES
('EMP00001', 2, 'Sachini Ranathunge', '1996-05-19', 0, '65,Asgiriya,Gampaha', '0715642310', 'sachi@gmail.com', '962013545V', '2017-01-09', 1),
('EMP00002', 1, 'Daanith Rathwatthe', '1992-03-18', 1, 'No 52,Queen\'s Road,Kandy', '0772304569', 'daanith@gmail.com', '923560386V', '2017-04-10', 0),
('EMP00003', 2, 'Eshadi Ranaweera ', '1996-08-13', 0, 'No 50,Suhada Road,Ja-ela', '0775623018', 'eshadi@gmail.com', '961208531V', '2018-01-08', 1),
('EMP00004', 1, 'Niyomal Gunathilake', '1985-11-20', 1, '188,Makwatta Road,Gampaha', '0785209641', 'niyomal@gmail.com', '85103796551V', '2016-08-15', 1),
('EMP00005', 2, 'Nishanthi Munasinghe', '1980-11-18', 0, 'No32/1,Lumbini Road,Gampaha', '0775623894', 'nishanthi@gmail.com', '805541236V', '2018-06-04', 1),
('EMP00006', 1, 'Prasanna Disanayake', '1989-07-12', 1, 'No.75/4,Colomo Road,Gampaha', '0774521043', 'prasanna@gmail.com', '895644107V', '2018-03-05', 1),
('EMP00007', 1, 'kumaj', '1999-02-03', 1, 'No 45,Siyana Road,Gampaha', '1234567898', 'kumaj@gmail.com', '991234567V', '2021-01-05', 0),
('EMP00008', 2, 'Asitha Fernando', '1993-03-15', 1, 'No55,Wilabad Mawatha,Gampaha', '0778542136', 'asitha@gmail.com', '935411200V', '2019-06-03', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_grn`
--

CREATE TABLE `tbl_grn` (
  `grn_id` int(10) NOT NULL,
  `pub_id` char(8) NOT NULL,
  `grn_rdate` date NOT NULL,
  `grn_total` float(15,2) NOT NULL,
  `total_qty` int(11) NOT NULL,
  `grn_discount` float(15,2) NOT NULL,
  `grn_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_grn`
--

INSERT INTO `tbl_grn` (`grn_id`, `pub_id`, `grn_rdate`, `grn_total`, `total_qty`, `grn_discount`, `grn_status`) VALUES
(1, 'PUBC0001', '2019-01-04', 7000.00, 100, 0.00, 1),
(2, 'PUBC0002', '2019-01-04', 3500.00, 50, 0.00, 1),
(3, 'PUBC0006', '2019-01-11', 2500.00, 50, 0.00, 1),
(4, 'PUBC0001', '2019-01-11', 17500.00, 250, 0.00, 1),
(5, 'PUBC0002', '2019-01-13', 1500.00, 50, 0.00, 1),
(6, 'PUBC0001', '2019-01-13', 2000.00, 100, 0.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoice`
--

CREATE TABLE `tbl_invoice` (
  `inv_id` varchar(25) NOT NULL,
  `cus_id` int(11) NOT NULL,
  `inv_date` date NOT NULL,
  `inv_qty` int(10) NOT NULL,
  `inv_discount` float(15,2) NOT NULL,
  `inv_total` float(15,2) NOT NULL,
  `inv_paid` float(15,2) NOT NULL,
  `pay_id` int(11) NOT NULL,
  `inv_user` varchar(10) NOT NULL,
  `inv_type` varchar(15) NOT NULL,
  `inv_status` tinyint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_invoice`
--

INSERT INTO `tbl_invoice` (`inv_id`, `cus_id`, `inv_date`, `inv_qty`, `inv_discount`, `inv_total`, `inv_paid`, `pay_id`, `inv_user`, `inv_type`, `inv_status`) VALUES
('', 0, '0000-00-00', 0, 0.00, 0.00, 0.00, 0, '', 'offline', 1),
('INV20200112_0001', 1, '2020-01-12', 1, 0.00, 80.00, 80.00, 1, '', 'online', 2),
('INV20210412_0001', 1, '2021-04-12', 1, 0.00, 80.00, 80.00, 1, '', 'online', 2),
('INV20210412_0002', 1, '2021-04-12', 1, 0.00, 80.00, 80.00, 1, '', 'online', 2),
('INV20210413_0001', 1, '2021-04-13', 1, 0.00, 80.00, 80.00, 1, '', 'online', 2),
('INV20210413_0002', 3, '2021-04-13', 1, 0.00, 80.00, 80.00, 1, '', 'online', 2),
('INV20210420_0001', 3, '2021-04-20', 16, 0.00, 1280.00, 1280.00, 0, '', 'offline', 1),
('INV20210421_0001', 12, '2021-04-21', 25, 0.00, 2100.00, 0.00, 0, '', 'online', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inv_details`
--

CREATE TABLE `tbl_inv_details` (
  `id` int(1) NOT NULL,
  `inv_id` varchar(25) NOT NULL,
  `newsp_id` char(8) NOT NULL,
  `newsp_cprice` float(15,2) NOT NULL,
  `newsp_qty` int(11) NOT NULL,
  `newsp_sprice` float(15,2) NOT NULL,
  `inv_det_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_newspaper`
--

CREATE TABLE `tbl_newspaper` (
  `newsp_id` char(8) NOT NULL,
  `pub_id` char(8) NOT NULL,
  `npcat_id` char(8) NOT NULL,
  `np_det_id` int(10) NOT NULL,
  `newsp_name` varchar(30) NOT NULL,
  `newsp_price` float(15,2) NOT NULL,
  `newsp_qty` int(11) NOT NULL,
  `newsp_rlevel` int(11) NOT NULL,
  `newsp_status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_newspaper`
--

INSERT INTO `tbl_newspaper` (`newsp_id`, `pub_id`, `npcat_id`, `np_det_id`, `newsp_name`, `newsp_price`, `newsp_qty`, `newsp_rlevel`, `newsp_status`) VALUES
('NEWP0001', 'PUBC0001', 'NCAT0001', 1, 'Lanakadeepa', 80.00, 350, 50, 1),
('NEWP0002', 'PUBC0002', 'NCAT0001', 1, 'Silumina', 80.00, 200, 30, 1),
('NEWP0003', 'PUBC0006', 'NCAT0001', 1, 'Lakbima', 60.00, 100, 30, 1),
('NEWP0004', 'PUBC0006', 'NCAT0001', 1, 'Divaina', 100.00, 100, 20, 1),
('NEWP0005', 'PUBC0002', 'NCAT0001', 2, 'Sunday Observer', 100.00, 350, 50, 1),
('NEWP0006', 'PUBC0001', 'NCAT0001', 2, 'Sunday Times', 60.00, 250, 20, 1),
('NEWP0007', 'PUBC0001', 'NCAT0002', 1, 'Daily Lankadeepa', 30.00, 300, 30, 1),
('NEWP0008', 'PUBC0002', 'NCAT0002', 1, 'Dinamina', 30.00, 150, 20, 1),
('NEWP0009', 'PUBC0002', 'NCAT0002', 2, 'Daily News', 50.00, 50, 10, 1),
('NEWP0010', 'PUBC0005', 'NCAT0002', 2, 'Daily Island', 30.00, 50, 10, 1),
('NEWP0011', 'PUBC0004', 'NCAT0002', 2, 'Daily Today', 30.00, 75, 20, 1),
('NEWP0012', 'PUBC0001', 'NCAT0003', 1, 'Sirikatha', 40.00, 100, 25, 1),
('NEWP0013', 'PUBC0002', 'NCAT0003', 1, 'Tharuni', 40.00, 250, 50, 1),
('NEWP0014', 'PUBC0005', 'NCAT0003', 1, 'Diyaniya', 30.00, 75, 10, 1),
('NEWP0015', 'PUBC0001', 'NCAT0003', 1, 'Birinda', 40.00, 50, 10, 1),
('NEWP0016', 'PUBC0006', 'NCAT0003', 1, 'Nawaliya', 40.00, 75, 20, 1),
('NEWP0017', 'PUBC0002', 'NCAT0004', 1, 'Mihira', 30.00, 250, 40, 1),
('NEWP0018', 'PUBC0001', 'NCAT0004', 1, 'Vijaya', 30.00, 250, 40, 1),
('NEWP0019', 'PUBC0001', 'NCAT0004', 1, 'Widusara', 30.00, 100, 20, 1),
('NEWP0020', 'PUBC0006', 'NCAT0004', 1, 'Sujaya', 50.00, 50, 10, 1),
('NEWP0021', 'PUBC0003', 'NCAT0003', 1, 'Dharani', 25.00, 100, 25, 1),
('NEWP0022', 'PUBC0003', 'NCAT0001', 2, 'Aruna', 62.00, 250, 75, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_newspaper_ad`
--

CREATE TABLE `tbl_newspaper_ad` (
  `newsa_id` char(8) NOT NULL,
  `pub_id` char(8) NOT NULL,
  `npcat_id` char(8) NOT NULL,
  `newsp_id` char(8) NOT NULL,
  `newsad_mode_id` int(10) NOT NULL,
  `adcolour_id` char(8) NOT NULL,
  `newsa_fwc` int(11) NOT NULL,
  `newsa_fwcprice` float NOT NULL,
  `newsa_mwcprice` float NOT NULL,
  `newsa_status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_newspaper_ad`
--

INSERT INTO `tbl_newspaper_ad` (`newsa_id`, `pub_id`, `npcat_id`, `newsp_id`, `newsad_mode_id`, `adcolour_id`, `newsa_fwc`, `newsa_fwcprice`, `newsa_mwcprice`, `newsa_status`) VALUES
('NEAD0001', 'PUBC0001', 'NCAT0001', 'NEWP0001', 1, 'CL001', 15, 1100, 25, 1),
('NEAD0002', 'PUBC0002', 'NCAT0001', 'NEWP0002', 1, 'CL001', 15, 500, 15, 1),
('NEAD0003', 'PUBC0001', 'NCAT0001', 'NEWP0012', 1, 'CL001', 15, 500, 25, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_newspaper_booking`
--

CREATE TABLE `tbl_newspaper_booking` (
  `np_book_id` int(11) NOT NULL,
  `cus_id` int(11) NOT NULL,
  `npbook_details_id` int(11) NOT NULL,
  `newsp_id` char(8) NOT NULL,
  `np_book_qty` int(11) NOT NULL,
  `np_order_time` varchar(10) NOT NULL,
  `crnt_date` date NOT NULL,
  `order_date` date NOT NULL,
  `np_tot_price` float(15,2) NOT NULL,
  `np_slip_img` text NOT NULL,
  `np_pay_status` int(11) NOT NULL DEFAULT '0',
  `np_book_status` tinyint(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_newspaper_booking`
--

INSERT INTO `tbl_newspaper_booking` (`np_book_id`, `cus_id`, `npbook_details_id`, `newsp_id`, `np_book_qty`, `np_order_time`, `crnt_date`, `order_date`, `np_tot_price`, `np_slip_img`, `np_pay_status`, `np_book_status`) VALUES
(1, 1, 0, 'NEWP0001', 1, '09:00:00', '2019-01-03', '2019-01-05', 80.00, '', 0, 0),
(2, 1, 0, 'NEWP0002', 1, '09:02:00', '2019-01-03', '2019-01-05', 80.00, '', 0, 0),
(3, 1, 0, 'NEWP0005', 1, '09:05:00', '2019-01-03', '2019-01-05', 100.00, '', 0, 0),
(4, 12, 1, 'NEWP0001', 10, '03:04:45', '2021-04-21', '2021-05-09', 800.00, '', 0, 0),
(5, 12, 1, 'NEWP0005', 5, '03:04:45', '2021-04-21', '2021-05-09', 500.00, '', 0, 0),
(6, 12, 1, 'NEWP0002', 10, '03:04:45', '2021-04-21', '2021-05-09', 800.00, '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_newspaper_booking_details`
--

CREATE TABLE `tbl_newspaper_booking_details` (
  `npbook_details_id` int(11) NOT NULL,
  `cus_id` int(11) NOT NULL,
  `crnt_date` date NOT NULL,
  `total_qty` int(11) NOT NULL,
  `total_price` float(15,2) NOT NULL,
  `npbook_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_newspaper_booking_details`
--

INSERT INTO `tbl_newspaper_booking_details` (`npbook_details_id`, `cus_id`, `crnt_date`, `total_qty`, `total_price`, `npbook_status`) VALUES
(1, 12, '2021-04-21', 25, 2100.00, 1),
(2, 12, '2021-04-21', 20, 1600.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_newspaper_category`
--

CREATE TABLE `tbl_newspaper_category` (
  `npcat_id` char(8) NOT NULL,
  `npcat_category` varchar(50) NOT NULL,
  `npcat_desc` varchar(100) NOT NULL,
  `npcat_status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_newspaper_category`
--

INSERT INTO `tbl_newspaper_category` (`npcat_id`, `npcat_category`, `npcat_desc`, `npcat_status`) VALUES
('NCAT0001', 'Sunday Newspapers', 'Publish on Sunday', 1),
('NCAT0002', 'Daily Newspapers', 'Publish On every weekdays', 1),
('NCAT0003', 'Women\'s magazine', 'For specially women', 1),
('NCAT0004', 'Children\'s magazine', 'For specially children', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_newspaper_details`
--

CREATE TABLE `tbl_newspaper_details` (
  `np_det_id` int(10) NOT NULL,
  `np_medium` varchar(20) NOT NULL,
  `np_det_status` tinyint(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_newspaper_details`
--

INSERT INTO `tbl_newspaper_details` (`np_det_id`, `np_medium`, `np_det_status`) VALUES
(1, 'Sinhala', 1),
(2, 'English', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_newspaper_order`
--

CREATE TABLE `tbl_newspaper_order` (
  `order_id` char(6) NOT NULL,
  `cus_id` int(11) NOT NULL,
  `np_book_id` int(11) NOT NULL,
  `newsp_id` char(8) NOT NULL,
  `order_qty` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `order_comp_date` date NOT NULL,
  `order_price` float(15,2) NOT NULL,
  `order_status` tinyint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_newspaper_order`
--

INSERT INTO `tbl_newspaper_order` (`order_id`, `cus_id`, `np_book_id`, `newsp_id`, `order_qty`, `order_date`, `order_comp_date`, `order_price`, `order_status`) VALUES
('1', 1, 1, 'NEWP0001', 1, '2019-01-05', '2019-01-06', 420.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_news_adcat_type`
--

CREATE TABLE `tbl_news_adcat_type` (
  `adcattype_id` char(8) NOT NULL,
  `newsac_id` char(8) NOT NULL,
  `adcattype_desc` varchar(50) NOT NULL,
  `adcattype_status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_news_adcat_type`
--

INSERT INTO `tbl_news_adcat_type` (`adcattype_id`, `newsac_id`, `adcattype_desc`, `adcattype_status`) VALUES
('ADCT0150', 'ACAT0001', 'For Sale', 1),
('ADCT0151', 'ACAT0001', 'Wanted', 1),
('ADCT0152', 'ACAT0001', 'For Hire', 1),
('ADCT0153', 'ACAT0001', 'Driver Learners', 1),
('ADCT0154', 'ACAT0001', 'Vehicle Maintenance', 1),
('ADCT0155', 'ACAT0001', 'Unregistered Vehicles', 1),
('ADCT0156', 'ACAT0002', 'Secretarial Positions vacant', 1),
('ADCT0157', 'ACAT0002', 'Drivers-Positions Vacant', 1),
('ADCT0158', 'ACAT0002', 'Bakery -Positions Vacant', 1),
('ADCT0159', 'ACAT0002', 'Computer-Positions Vacant', 1),
('ADCT0160', 'ACAT0002', 'general-Position Vacant', 1),
('ADCT0161', 'ACAT0002', 'Professional', 1),
('ADCT0162', 'ACAT0003', 'House & Property for Sale', 1),
('ADCT0163', 'ACAT0003', 'Business premise for Sale', 1),
('ADCT0164', 'ACAT0003', 'Business Premises for Rent', 1),
('ADCT0165', 'ACAT0003', 'House Property Services', 1),
('ADCT0166', 'ACAT0004', 'For Grooms', 1),
('ADCT0167', 'ACAT0004', 'For Brides', 1),
('ADCT0169', 'ACAT0005', 'For publish financial statement', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_news_ad_category`
--

CREATE TABLE `tbl_news_ad_category` (
  `newsac_id` char(8) NOT NULL,
  `newsac_category` varchar(20) NOT NULL,
  `newsac_status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_news_ad_category`
--

INSERT INTO `tbl_news_ad_category` (`newsac_id`, `newsac_category`, `newsac_status`) VALUES
('ACAT0001', 'Automobile', 1),
('ACAT0002', 'Employment', 1),
('ACAT0003', 'Realestate', 1),
('ACAT0004', 'Marriage Proposals', 1),
('ACAT0005', 'Financial Statements', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_news_ad_mode`
--

CREATE TABLE `tbl_news_ad_mode` (
  `newsad_mode_id` int(10) NOT NULL,
  `newsad_mode` varchar(30) NOT NULL,
  `newsad_mode_status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_news_ad_mode`
--

INSERT INTO `tbl_news_ad_mode` (`newsad_mode_id`, `newsad_mode`, `newsad_mode_status`) VALUES
(1, 'Sketch  Advertisement', 1),
(2, 'Box Advertisement ', 1),
(3, 'Photo Classified', 1),
(4, 'Marriage Proposal Advertisment', 1),
(5, 'Full Page Advertisement', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_np_booking_pay`
--

CREATE TABLE `tbl_np_booking_pay` (
  `npbookpay_id` int(11) NOT NULL,
  `inv_id` varchar(25) NOT NULL,
  `pay_amount` float(15,2) NOT NULL,
  `pay_date` date NOT NULL,
  `pay_time` time NOT NULL,
  `pay_type` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orders`
--

CREATE TABLE `tbl_orders` (
  `order_id` char(6) NOT NULL,
  `cus_id` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `order_comp_date` date NOT NULL,
  `order_price` varchar(10) NOT NULL,
  `order_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_orders`
--

INSERT INTO `tbl_orders` (`order_id`, `cus_id`, `order_date`, `order_comp_date`, `order_price`, `order_status`) VALUES
('1', 1, '2021-01-04', '2021-01-07', '420.00', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pub_company`
--

CREATE TABLE `tbl_pub_company` (
  `pub_id` char(8) NOT NULL,
  `pub_name` varchar(50) NOT NULL,
  `pub_address` varchar(100) NOT NULL,
  `pub_mobile` char(12) NOT NULL,
  `pub_email` varchar(50) NOT NULL,
  `pub_status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pub_company`
--

INSERT INTO `tbl_pub_company` (`pub_id`, `pub_name`, `pub_address`, `pub_mobile`, `pub_email`, `pub_status`) VALUES
('PUBC0001', 'Wijeya Newspapers', '08, Hunupitiya Cross Road, Colombo 02', ' 0112479479', 'vijaya@gmail.com', 1),
('PUBC0002', 'Lake House', 'No 35,\r\nD. R. Wijewardena Mawatha,\r\nColombo 10', '0112429429', 'lakehouse@gmail.com', 1),
('PUBC0003', 'Aruna Newspaper Publishes', '91 Wijerama Mawatha, Colombo 07', '0115 200 900', 'arunapublishes@gmail.com', 1),
('PUBC0004', 'Ceylon Today', '101 Rosmead Pl, Colombo 07', '0117 566 566', 'ceylontoday@gmail.com', 1),
('PUBC0005', 'Lankadeepa Publications', 'Hunupitiya Cross Rd, Colombo 07', '0112448321', 'lankadeepa@gmail.com', 1),
('PUBC0006', 'Upali Newspapers Limited.', 'Avissawella Rd, Homagama', '0112 855 137', 'upalinewspapers@gmail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pwd_reset`
--

CREATE TABLE `tbl_pwd_reset` (
  `pwdreset_id` int(11) NOT NULL,
  `pwdreset_email` text NOT NULL,
  `pwdreset_selector` text NOT NULL,
  `pwdreset_token` longtext NOT NULL,
  `pwdreset_expires` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_regc_images`
--

CREATE TABLE `tbl_regc_images` (
  `img_id` char(10) NOT NULL,
  `cus_id` char(10) NOT NULL,
  `nic_copy` varchar(50) NOT NULL,
  `br_copy` varchar(50) NOT NULL,
  `img_status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reg_customer`
--

CREATE TABLE `tbl_reg_customer` (
  `cus_id` int(11) NOT NULL,
  `cus_name` varchar(50) NOT NULL,
  `cus_dob` date NOT NULL,
  `cus_gender` int(11) NOT NULL,
  `cus_address` varchar(50) NOT NULL,
  `cus_mobile` char(12) NOT NULL,
  `cus_email` varchar(50) NOT NULL,
  `cus_nic` varchar(12) NOT NULL,
  `cus_pass` varchar(255) NOT NULL,
  `cus_status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_reg_customer`
--

INSERT INTO `tbl_reg_customer` (`cus_id`, `cus_name`, `cus_dob`, `cus_gender`, `cus_address`, `cus_mobile`, `cus_email`, `cus_nic`, `cus_pass`, `cus_status`) VALUES
(1, 'Lilan Perera', '1997-10-23', 1, 'No45,Colombo rd,Gampaha', '0778512663', 'lilan@gmail.com', '976458126V', '25f9e794323b453885f5181f1b624d0b', 1),
(2, 'Poorni Chandimali', '1992-10-25', 0, 'No 200,Siyana Road,Gampaha', '0712365542', 'poorni@gmail.com', '921546330V', '25f9e794323b453885f5181f1b624d0b', 1),
(3, 'Rasindu Gunasena', '1992-05-31', 1, 'No 43/1,Bazar Road,Gampaha', '0712365203', 'rasindu@gmail.com', '923652104V', '25f9e794323b453885f5181f1b624d0b', 1),
(4, 'Nikila Vibodha', '1991-04-02', 1, 'N306,Yakkala Road,Gampaha', '0785463120', 'nikila@gmail.com', '912044567V', '25f9e794323b453885f5181f1b624d0b', 1),
(5, 'Pawara Matheesha', '1993-11-16', 1, 'No76/1,Kandy Road,Gampaha', '0701549986', 'pawara@gmail.com', '931200458V', '25f9e794323b453885f5181f1b624d0b', 1),
(7, 'Amanthe Dissa', '1993-07-07', 0, 'No56,Imbulgoda Road,Gampaha', '0771234569', 'amanthe@gmail.com', '931254698V', '123456789', 1),
(8, 'Nishani Kumari', '1993-06-07', 0, '1234,Colombo Roiad,Gampaha', '0715623561', 'nishani@gmail.com', '935642136V', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(12, 'lakshita', '1994-05-03', 1, '1234,Colombo Rd,Gampaha', '0717228827', 'lak@gmail.com', '941234567V', '25f9e794323b453885f5181f1b624d0b', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reg_users`
--

CREATE TABLE `tbl_reg_users` (
  `rusr_id` char(8) NOT NULL,
  `rusr_uname` varchar(20) NOT NULL,
  `rusr_email` varchar(50) NOT NULL,
  `rusr_pass` varchar(50) NOT NULL,
  `rusr_passrepeat` tinyint(4) NOT NULL,
  `rusr_type` tinyint(4) NOT NULL,
  `rusr_status` tinyint(4) NOT NULL DEFAULT '1',
  `rupwd_reset` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sample_data`
--

CREATE TABLE `tbl_sample_data` (
  `sample_id` int(11) NOT NULL,
  `newsp_id` char(8) NOT NULL,
  `np_book_qty` int(11) NOT NULL,
  `np_order_time` varchar(10) NOT NULL,
  `sample_status` tinyint(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_seller`
--

CREATE TABLE `tbl_seller` (
  `sell_id` char(8) NOT NULL,
  `sell_title` int(11) NOT NULL,
  `sell_name` varchar(50) NOT NULL,
  `sell_address` varchar(100) NOT NULL,
  `sell_mobile` char(12) NOT NULL,
  `sell_email` varchar(50) NOT NULL,
  `sell_nic` varchar(12) NOT NULL,
  `sell_doj` date NOT NULL,
  `sell_status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_seller`
--

INSERT INTO `tbl_seller` (`sell_id`, `sell_title`, `sell_name`, `sell_address`, `sell_mobile`, `sell_email`, `sell_nic`, `sell_doj`, `sell_status`) VALUES
('SELL0001', 1, 'Samitha Ranasinghe', 'Samitha Bookshop,No76,Colombo Road,Gamapha', '0774502316', 'samitha@gmail.com', '591206534V', '2018-05-07', 1),
('SELL0002', 1, 'Gamini Jayasinghe', 'Gamini Shop,No 45,Main Street,Gampaha', '0118546221', 'gamini@gmail.com', '673498011V', '2018-08-06', 1),
('SELL0003', 1, 'Saman Herath', 'Saman Stores,No21,Main Street,Gampaha', '0716532210', 'saman@gmail.com', '845673222V', '2017-09-12', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sms`
--

CREATE TABLE `tbl_sms` (
  `sms_id` int(11) NOT NULL,
  `cus_id` int(11) NOT NULL,
  `adorder_id` int(11) NOT NULL,
  `sms_msg` varchar(1000) NOT NULL,
  `sms_date` date NOT NULL,
  `sms_time` time NOT NULL,
  `sms_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `usr_name` varchar(25) NOT NULL,
  `usr_pass` varchar(50) NOT NULL,
  `usr_type` tinyint(4) NOT NULL,
  `usr_status` tinyint(4) NOT NULL DEFAULT '1',
  `pwd_reset` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`usr_name`, `usr_pass`, `usr_type`, `usr_status`, `pwd_reset`) VALUES
('daanith@gmail.com', '1bbd7f50b7abf3c929eeb195f2a4a100', 2, 0, 1),
('eshadi@gmail.com', 'ebb3568cc3257be7bc2ac835dc76b208', 3, 0, 1),
('niyomal@gmail.com', 'd3835a509829130a0e70b4e85cde05d9', 3, 1, 1),
('prasanna@gmail.com', 'dd8f339035ad353e126a8db03727857a', 3, 1, 1),
('rjk@gmail.com', '202cb962ac59075b964b07152d234b70', 1, 1, 0),
('sachi@gmail.com', '4fe693b846579f5afa0bb6aaf83f5eab', 2, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_ad_booking`
--
ALTER TABLE `tbl_ad_booking`
  ADD PRIMARY KEY (`ad_book_id`);

--
-- Indexes for table `tbl_ad_colour`
--
ALTER TABLE `tbl_ad_colour`
  ADD PRIMARY KEY (`adcolour_id`);

--
-- Indexes for table `tbl_ad_modes_details`
--
ALTER TABLE `tbl_ad_modes_details`
  ADD PRIMARY KEY (`admode_details_id`);

--
-- Indexes for table `tbl_ad_order`
--
ALTER TABLE `tbl_ad_order`
  ADD PRIMARY KEY (`adorder_id`);

--
-- Indexes for table `tbl_batch`
--
ALTER TABLE `tbl_batch`
  ADD PRIMARY KEY (`bat_id`),
  ADD KEY `fk_grn` (`grn_id`),
  ADD KEY `newsp_id` (`newsp_id`);

--
-- Indexes for table `tbl_booking_pay`
--
ALTER TABLE `tbl_booking_pay`
  ADD PRIMARY KEY (`bookpay_id`);

--
-- Indexes for table `tbl_deliveryman`
--
ALTER TABLE `tbl_deliveryman`
  ADD PRIMARY KEY (`delm_id`);

--
-- Indexes for table `tbl_delivery_details`
--
ALTER TABLE `tbl_delivery_details`
  ADD PRIMARY KEY (`deld_id`);

--
-- Indexes for table `tbl_email`
--
ALTER TABLE `tbl_email`
  ADD PRIMARY KEY (`email_id`);

--
-- Indexes for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `tbl_grn`
--
ALTER TABLE `tbl_grn`
  ADD PRIMARY KEY (`grn_id`),
  ADD KEY `pub_id` (`pub_id`);

--
-- Indexes for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  ADD PRIMARY KEY (`inv_id`);

--
-- Indexes for table `tbl_inv_details`
--
ALTER TABLE `tbl_inv_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_newspaper`
--
ALTER TABLE `tbl_newspaper`
  ADD PRIMARY KEY (`newsp_id`),
  ADD KEY `fk_npcat` (`npcat_id`),
  ADD KEY `pub_id` (`pub_id`);

--
-- Indexes for table `tbl_newspaper_ad`
--
ALTER TABLE `tbl_newspaper_ad`
  ADD PRIMARY KEY (`newsa_id`),
  ADD KEY `pub_id` (`pub_id`),
  ADD KEY `npcat_id` (`npcat_id`),
  ADD KEY `newsp_id` (`newsp_id`),
  ADD KEY `newsad_mode_id` (`newsad_mode_id`),
  ADD KEY `adcolour_id` (`adcolour_id`);

--
-- Indexes for table `tbl_newspaper_booking`
--
ALTER TABLE `tbl_newspaper_booking`
  ADD PRIMARY KEY (`np_book_id`),
  ADD KEY `newsp_id` (`newsp_id`);

--
-- Indexes for table `tbl_newspaper_booking_details`
--
ALTER TABLE `tbl_newspaper_booking_details`
  ADD PRIMARY KEY (`npbook_details_id`);

--
-- Indexes for table `tbl_newspaper_category`
--
ALTER TABLE `tbl_newspaper_category`
  ADD PRIMARY KEY (`npcat_id`);

--
-- Indexes for table `tbl_newspaper_details`
--
ALTER TABLE `tbl_newspaper_details`
  ADD PRIMARY KEY (`np_det_id`);

--
-- Indexes for table `tbl_newspaper_order`
--
ALTER TABLE `tbl_newspaper_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `tbl_news_adcat_type`
--
ALTER TABLE `tbl_news_adcat_type`
  ADD PRIMARY KEY (`adcattype_id`),
  ADD KEY `fk_newaac` (`newsac_id`) USING BTREE;

--
-- Indexes for table `tbl_news_ad_category`
--
ALTER TABLE `tbl_news_ad_category`
  ADD PRIMARY KEY (`newsac_id`);

--
-- Indexes for table `tbl_news_ad_mode`
--
ALTER TABLE `tbl_news_ad_mode`
  ADD PRIMARY KEY (`newsad_mode_id`);

--
-- Indexes for table `tbl_np_booking_pay`
--
ALTER TABLE `tbl_np_booking_pay`
  ADD PRIMARY KEY (`npbookpay_id`);

--
-- Indexes for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `tbl_pub_company`
--
ALTER TABLE `tbl_pub_company`
  ADD PRIMARY KEY (`pub_id`);

--
-- Indexes for table `tbl_pwd_reset`
--
ALTER TABLE `tbl_pwd_reset`
  ADD PRIMARY KEY (`pwdreset_id`);

--
-- Indexes for table `tbl_reg_customer`
--
ALTER TABLE `tbl_reg_customer`
  ADD PRIMARY KEY (`cus_id`);

--
-- Indexes for table `tbl_reg_users`
--
ALTER TABLE `tbl_reg_users`
  ADD PRIMARY KEY (`rusr_id`);

--
-- Indexes for table `tbl_sample_data`
--
ALTER TABLE `tbl_sample_data`
  ADD PRIMARY KEY (`sample_id`),
  ADD KEY `newsp_id` (`newsp_id`);

--
-- Indexes for table `tbl_seller`
--
ALTER TABLE `tbl_seller`
  ADD PRIMARY KEY (`sell_id`);

--
-- Indexes for table `tbl_sms`
--
ALTER TABLE `tbl_sms`
  ADD PRIMARY KEY (`sms_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`usr_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_ad_booking`
--
ALTER TABLE `tbl_ad_booking`
  MODIFY `ad_book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_ad_modes_details`
--
ALTER TABLE `tbl_ad_modes_details`
  MODIFY `admode_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_ad_order`
--
ALTER TABLE `tbl_ad_order`
  MODIFY `adorder_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_newspaper_booking`
--
ALTER TABLE `tbl_newspaper_booking`
  MODIFY `np_book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_newspaper_booking_details`
--
ALTER TABLE `tbl_newspaper_booking_details`
  MODIFY `npbook_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_news_ad_mode`
--
ALTER TABLE `tbl_news_ad_mode`
  MODIFY `newsad_mode_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_pwd_reset`
--
ALTER TABLE `tbl_pwd_reset`
  MODIFY `pwdreset_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_reg_customer`
--
ALTER TABLE `tbl_reg_customer`
  MODIFY `cus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_sample_data`
--
ALTER TABLE `tbl_sample_data`
  MODIFY `sample_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_batch`
--
ALTER TABLE `tbl_batch`
  ADD CONSTRAINT `fk_grn` FOREIGN KEY (`grn_id`) REFERENCES `tbl_grn` (`grn_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_batch_ibfk_1` FOREIGN KEY (`newsp_id`) REFERENCES `tbl_newspaper` (`newsp_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_delivery_details`
--
ALTER TABLE `tbl_delivery_details`
  ADD CONSTRAINT `tbl_delivery_details_ibfk_1` FOREIGN KEY (`deld_id`) REFERENCES `tbl_deliveryman` (`delm_id`);

--
-- Constraints for table `tbl_grn`
--
ALTER TABLE `tbl_grn`
  ADD CONSTRAINT `tbl_grn_ibfk_1` FOREIGN KEY (`pub_id`) REFERENCES `tbl_pub_company` (`pub_id`);

--
-- Constraints for table `tbl_newspaper`
--
ALTER TABLE `tbl_newspaper`
  ADD CONSTRAINT `fk_npcat` FOREIGN KEY (`npcat_id`) REFERENCES `tbl_newspaper_category` (`npcat_id`);

--
-- Constraints for table `tbl_newspaper_ad`
--
ALTER TABLE `tbl_newspaper_ad`
  ADD CONSTRAINT `tbl_newspaper_ad_ibfk_1` FOREIGN KEY (`pub_id`) REFERENCES `tbl_pub_company` (`pub_id`),
  ADD CONSTRAINT `tbl_newspaper_ad_ibfk_2` FOREIGN KEY (`npcat_id`) REFERENCES `tbl_newspaper_category` (`npcat_id`),
  ADD CONSTRAINT `tbl_newspaper_ad_ibfk_3` FOREIGN KEY (`newsp_id`) REFERENCES `tbl_newspaper` (`newsp_id`),
  ADD CONSTRAINT `tbl_newspaper_ad_ibfk_4` FOREIGN KEY (`newsad_mode_id`) REFERENCES `tbl_news_ad_mode` (`newsad_mode_id`),
  ADD CONSTRAINT `tbl_newspaper_ad_ibfk_5` FOREIGN KEY (`adcolour_id`) REFERENCES `tbl_ad_colour` (`adcolour_id`);

--
-- Constraints for table `tbl_newspaper_booking`
--
ALTER TABLE `tbl_newspaper_booking`
  ADD CONSTRAINT `tbl_newspaper_booking_ibfk_1` FOREIGN KEY (`newsp_id`) REFERENCES `tbl_newspaper` (`newsp_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_sample_data`
--
ALTER TABLE `tbl_sample_data`
  ADD CONSTRAINT `tbl_sample_data_ibfk_1` FOREIGN KEY (`newsp_id`) REFERENCES `tbl_newspaper` (`newsp_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
