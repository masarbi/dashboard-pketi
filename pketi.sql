-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2017 at 11:32 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pketi`
--

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `name` varchar(200) NOT NULL,
  `location` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`name`, `location`) VALUES
('KCP Citraland', 'Surabaya Barat'),
('KCP Pakuwon Indah', 'Surabaya Barat'),
('KCP Tandes', 'Surabaya Barat'),
('KCP Darmo', 'Surabaya Pusat'),
('KCP Kedungdoro', 'Surabaya Pusat'),
('KCP Kendangsari', 'Surabaya Selatan'),
('KCP Rungkut', 'Surabaya Selatan'),
('KCP Wonocolo', 'Surabaya Selatan'),
('KCP Pakuwon City', 'Surabaya Timur'),
('KCP Sukolilo', 'Surabaya Timur'),
('KCP Ampel', 'Surabaya Utara'),
('KPC Perak', 'Surabaya Utara');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` varchar(50) NOT NULL,
  `branch` varchar(200) NOT NULL,
  `type` enum('Company PC','Company Laptop','Company Website','Company Desktop Application','Personal Laptop','Company Server','Company Printer','Company Hard Disk','Company Flash Disk','Company WiFi','Company Gadget & Accessories','Other') NOT NULL,
  `description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `branch`, `type`, `description`) VALUES
('AM-CPC-001', 'KCP Ampel', 'Company PC', 'PC Mas Santoso (Sales)'),
('AM-CPC-002', 'KCP Ampel', 'Company PC', 'PC Mbak Ella'),
('AM-CPC-003', 'KCP Ampel', 'Company PC', 'PC Mbak Sinta'),
('CI-CPC-001', 'KCP Citraland', 'Company PC', 'PC Mbak Santi (Marketing)'),
('CI-CPC-002', 'KCP Citraland', 'Company PC', 'PC Mbak Feli (Marketing)'),
('CI-CPC-003', 'KCP Citraland', 'Company PC', 'PC Mas Mic (Sales)'),
('DA-CPC-001', 'KCP Darmo', 'Company PC', 'PC Mbak Ina (Marketing)'),
('DA-CPC-002', 'KCP Darmo', 'Company PC', 'PC Mas Lukman (Direktur Cabang)'),
('DA-CWF-01', 'KCP Darmo', 'Company WiFi', 'Router 1'),
('DA-CWF-02', 'KCP Darmo', 'Company WiFi', 'Router 2'),
('KD-CPC-001', 'KCP Kedungdoro', 'Company PC', 'PC Mbak Leo (Direktur Cabang)'),
('KD-CPC-002', 'KCP Kedungdoro', 'Company PC', 'PC Mas Feli (Sales)'),
('KD-CPC-003', 'KCP Kedungdoro', 'Company PC', 'PC Mas John (Sales)'),
('KS-CPC-001', 'KCP Kendangsari', 'Company PC', 'PC Mbak Meli (Direktur Cabang)'),
('KS-CPC-002', 'KCP Kendangsari', 'Company PC', 'PC Mbak Era (Sales)'),
('KS-CPC-003', 'KCP Kendangsari', 'Company PC', 'PC Mas Bhimo (Sales)'),
('PC-CPC-001', 'KCP Pakuwon City', 'Company PC', 'PC Mas Angga (Sales)'),
('PC-CPC-002', 'KCP Pakuwon City', 'Company PC', 'PC Mbak Irene (Sales)'),
('PC-CPC-003', 'KCP Pakuwon City', 'Company PC', 'PC Mas Adrian (Sales)'),
('PE-CFD-001', 'KPC Perak', 'Company Flash Disk', 'FD Mbak Fio (Sales)'),
('PE-CHD-001', 'KPC Perak', 'Company Hard Disk', 'HDD Back Up Sales'),
('PE-CLA-001', 'KPC Perak', 'Company Laptop', 'PC Mas Budi'),
('PE-CPC-001', 'KPC Perak', 'Company PC', 'PC Mbak Fio (Sales)'),
('PE-CPR-001', 'KPC Perak', 'Company Printer', 'Printer Sales'),
('PE-CSE-001', 'KPC Perak', 'Company Server', 'Server DB Cabang Perak'),
('PE-CWE-001', 'KPC Perak', 'Company Website', 'www.companywebsite.com'),
('PE-CWF-001', 'KPC Perak', 'Company WiFi', 'Router 1'),
('PI-CPC-001', 'KCP Pakuwon Indah', 'Company PC', 'PC Mbak Indah (Marketing)'),
('PI-CPC-002', 'KCP Pakuwon Indah', 'Company PC', 'PC Mbak Ratna (Sales)'),
('PI-CPC-003', 'KCP Pakuwon Indah', 'Company PC', 'PC Mas Daniel (Sales)'),
('RU-CPC-001', 'KCP Rungkut', 'Company PC', 'PC Mbak Endang (Direktur Cabang)'),
('RU-CPC-002', 'KCP Rungkut', 'Company PC', 'PC Mbak Cinta (Sales)'),
('RU-CPC-003', 'KCP Rungkut', 'Company PC', 'PC Mas Ajie (Sales)'),
('SU-CHD-001', 'KCP Sukolilo', 'Company Hard Disk', 'HDD Back Up Sales'),
('SU-CPC-001', 'KCP Sukolilo', 'Company PC', 'PC Mas Rio (Sales)'),
('SU-CPC-002', 'KCP Sukolilo', 'Company PC', 'PC Mas Nano (Sales)'),
('SU-CPC-003', 'KCP Sukolilo', 'Company PC', 'PC Mbak Fina (Direktur Cabang)'),
('SU-CPR-001', 'KCP Sukolilo', 'Company Printer', 'Printer Sales'),
('SU-CSV-001', 'KCP Sukolilo', 'Company Server', 'Server pengawasan pak Rully'),
('TA-CPC-001', 'KCP Tandes', 'Company PC', 'PC Mbak Sinta (Marketing)'),
('TA-CPC-002', 'KCP Tandes', 'Company PC', 'PC Mbak Sinta (Sales)'),
('TA-CPC-003', 'KCP Tandes', 'Company PC', 'PC Mas Faris (Sales)'),
('WO-CPC-001', 'KCP Wonocolo', 'Company PC', 'PC Mas Enggar (Direktur Cabang)'),
('WO-CPC-002', 'KCP Wonocolo', 'Company PC', 'PC Mbak EKa (Sales)'),
('WO-CPC-003', 'KCP Wonocolo', 'Company PC', 'PC Mas Eka (Sales)');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `level` int(1) NOT NULL,
  `title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`level`, `title`) VALUES
(0, 'outsource'),
(1, 'helpdesk'),
(2, 'specialist'),
(3, 'structural'),
(4, 'management');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`name`) VALUES
('Surabaya Barat'),
('Surabaya Pusat'),
('Surabaya Selatan'),
('Surabaya Timur'),
('Surabaya Utara');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `item` varchar(50) NOT NULL,
  `escalate` int(1) NOT NULL DEFAULT '1',
  `servicer` varchar(50) DEFAULT NULL,
  `status` enum('Requested','Planned','Ongoing','Completed','Rejected','Escalated') NOT NULL DEFAULT 'Requested',
  `problem` varchar(500) NOT NULL COMMENT 'Problem stated by incident applicant.',
  `priority` enum('Unassigned','Low','Medium','High','Critical') NOT NULL DEFAULT 'Unassigned',
  `target` date DEFAULT NULL,
  `note` varchar(500) DEFAULT NULL COMMENT 'A note from servicer.'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `item`, `escalate`, `servicer`, `status`, `problem`, `priority`, `target`, `note`) VALUES
(1, 'CI-CPC-001', 1, 'HLP-DA-01', 'Completed', 'Hiks', 'High', '2017-11-09', NULL),
(2, 'PE-CFD-001', 1, 'HLP-DA-01', 'Completed', 'Meh', 'Low', '2017-11-09', 'Lol'),
(3, 'PC-CPC-002', 1, 'HLP-DA-02', 'Ongoing', 'Hehe', 'Medium', '2017-11-08', 'Haha'),
(4, 'AM-CPC-002', 1, NULL, 'Planned', 'Mama', 'Medium', '2017-11-09', 'y'),
(5, 'CI-CPC-003', 1, NULL, 'Requested', 'ABC', 'Unassigned', NULL, NULL),
(6, 'SU-CPC-002', 1, 'HLP-DA-02', 'Completed', 'What', 'Critical', '2017-11-09', 'Y'),
(7, 'KD-CPC-003', 1, 'HLP-DA-02', 'Completed', 'Kok bisa', 'Critical', '2017-11-09', 'Y'),
(8, 'TA-CPC-003', 1, NULL, 'Planned', 'Eta', 'High', '2017-11-09', 'Y'),
(9, 'AM-CPC-001', 1, NULL, 'Requested', 'Terangkanlah', 'Unassigned', NULL, NULL),
(10, 'WO-CPC-002', 1, 'HLP-DA-01', 'Completed', 'Help', 'Critical', '2017-11-09', 'y'),
(11, 'CI-CPC-003', 1, NULL, 'Planned', 'Help', 'Critical', '2017-11-09', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `servicer`
--

CREATE TABLE `servicer` (
  `id` varchar(50) NOT NULL,
  `level` int(1) NOT NULL,
  `name` varchar(200) NOT NULL,
  `branch` varchar(200) DEFAULT NULL,
  `available` enum('Yes','No') NOT NULL DEFAULT 'Yes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `servicer`
--

INSERT INTO `servicer` (`id`, `level`, `name`, `branch`, `available`) VALUES
('HLP-DA-01', 1, 'Cindy', 'KCP Darmo', 'Yes'),
('HLP-DA-02', 1, 'Arbintoro', 'KCP Darmo', 'No'),
('HLP-PE-01', 1, 'Gabrielle', 'KPC Perak', 'Yes'),
('HLP-PI-01', 1, 'Reginia', 'KCP Pakuwon Indah', 'Yes'),
('HLP-PI-02', 1, 'Lumahu', 'KCP Pakuwon Indah', 'Yes'),
('HLP-RU-01', 1, 'Kusuma', 'KCP Rungkut', 'Yes'),
('HLP-SU-01', 1, 'Mas', 'KCP Sukolilo', 'Yes'),
('HLP-SU-02', 1, 'Andre', 'KCP Sukolilo', 'Yes'),
('MGT-DA-01', 4, 'Bu Hanim', 'KCP Darmo', 'Yes'),
('OUT-01', 0, 'PKETI', NULL, 'Yes'),
('SPC-DA-01', 2, 'Ardo', 'KCP Darmo', 'Yes'),
('SPC-PE-01', 2, 'Fachrizal', 'KPC Perak', 'Yes'),
('SPC-PI-01', 2, 'Ilmy', 'KCP Pakuwon Indah', 'Yes'),
('SPC-RU-01', 2, 'Ahsanul', 'KCP Rungkut', 'Yes'),
('SPC-SU-01', 2, 'Marom', 'KCP Sukolilo', 'Yes'),
('STR-DA-01', 3, 'Bagus', 'KCP Darmo', 'Yes'),
('STR-RU-01', 3, 'Pambudi', 'KCP Rungkut', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `service_log`
--

CREATE TABLE `service_log` (
  `service` int(11) NOT NULL,
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('Request','Plan','Ongoing','Complete','Reject','Escalate Lv. 0','Escalate Lv. 1','Escalate Lv. 2','Escalate Lv. 3','Escalate Lv. 4') NOT NULL DEFAULT 'Request',
  `note` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service_log`
--

INSERT INTO `service_log` (`service`, `time`, `status`, `note`) VALUES
(1, '2017-11-09 00:04:42', 'Request', NULL),
(1, '2017-11-09 02:10:47', 'Plan', NULL),
(2, '2017-11-09 03:42:02', 'Request', NULL),
(2, '2017-11-09 03:43:07', 'Plan', NULL),
(3, '2017-11-09 03:46:33', 'Request', NULL),
(3, '2017-11-09 03:46:42', 'Plan', NULL),
(4, '2017-12-09 03:54:11', 'Request', NULL),
(5, '2017-10-19 00:00:00', 'Request', NULL),
(2, '2017-11-09 04:23:58', 'Ongoing', NULL),
(2, '2017-11-09 04:24:05', 'Complete', NULL),
(1, '2017-11-09 04:24:07', 'Ongoing', NULL),
(6, '2017-11-09 00:00:00', 'Request', NULL),
(7, '2017-11-07 00:00:00', 'Request', NULL),
(8, '2017-11-03 00:00:00', 'Request', NULL),
(9, '2017-11-22 00:00:00', 'Request', NULL),
(7, '2017-11-09 04:26:54', 'Plan', NULL),
(8, '2017-11-09 04:27:03', 'Plan', NULL),
(6, '2017-11-09 04:27:25', 'Plan', NULL),
(6, '2017-11-09 04:27:31', 'Ongoing', NULL),
(6, '2017-11-09 04:27:35', 'Complete', NULL),
(7, '2017-11-09 04:27:50', 'Ongoing', NULL),
(7, '2017-11-09 04:27:53', 'Complete', NULL),
(4, '2017-11-09 04:28:14', 'Plan', NULL),
(3, '2017-11-09 04:28:18', 'Ongoing', NULL),
(1, '2017-11-09 04:28:21', 'Complete', NULL),
(10, '2017-11-14 00:00:00', 'Request', NULL),
(10, '2017-11-09 04:36:05', 'Plan', NULL),
(10, '2017-11-09 04:36:11', 'Ongoing', NULL),
(10, '2017-11-09 04:36:15', 'Complete', NULL),
(11, '2017-11-14 00:00:00', 'Request', NULL),
(11, '2017-11-09 04:36:36', 'Plan', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`name`),
  ADD KEY `location` (`location`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `branch` (`branch`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`level`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item` (`item`),
  ADD KEY `branch` (`servicer`),
  ADD KEY `escalate` (`escalate`);

--
-- Indexes for table `servicer`
--
ALTER TABLE `servicer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `branch` (`branch`),
  ADD KEY `level` (`level`);

--
-- Indexes for table `service_log`
--
ALTER TABLE `service_log`
  ADD KEY `service` (`service`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `branch`
--
ALTER TABLE `branch`
  ADD CONSTRAINT `branch_ibfk_1` FOREIGN KEY (`location`) REFERENCES `location` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`branch`) REFERENCES `branch` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `service_ibfk_1` FOREIGN KEY (`item`) REFERENCES `item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `service_ibfk_2` FOREIGN KEY (`servicer`) REFERENCES `servicer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `service_ibfk_3` FOREIGN KEY (`escalate`) REFERENCES `level` (`level`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `servicer`
--
ALTER TABLE `servicer`
  ADD CONSTRAINT `servicer_ibfk_1` FOREIGN KEY (`branch`) REFERENCES `branch` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `servicer_ibfk_2` FOREIGN KEY (`level`) REFERENCES `level` (`level`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `service_log`
--
ALTER TABLE `service_log`
  ADD CONSTRAINT `service_log_ibfk_1` FOREIGN KEY (`service`) REFERENCES `service` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
