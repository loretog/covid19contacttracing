-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2020 at 04:33 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `covid19contacttracing`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` char(32) NOT NULL,
  `usertype` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `usertype`) VALUES
(1, 'lors', 'a722c63db8ec8625af6cf71cb8c2d939', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `barangays`
--

CREATE TABLE `barangays` (
  `id` bigint(11) NOT NULL,
  `municipality_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barangays`
--

INSERT INTO `barangays` (`id`, `municipality_id`, `district_id`, `name`) VALUES
(1, 1, 1, 'san isidro'),
(2, 1, 1, 'Ticud');

-- --------------------------------------------------------

--
-- Table structure for table `contact_traces`
--

CREATE TABLE `contact_traces` (
  `id` bigint(20) NOT NULL,
  `person_id` bigint(20) NOT NULL,
  `contacted_person_id` bigint(20) NOT NULL,
  `date_of_contact` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_traces`
--

INSERT INTO `contact_traces` (`id`, `person_id`, `contacted_person_id`, `date_of_contact`) VALUES
(1, 1, 12, '2020-04-02 09:02:26'),
(2, 8, 12, '2020-04-02 09:06:19'),
(3, 23, 12, '0000-00-00 00:00:00'),
(4, 27, 2, '0000-00-00 00:00:00'),
(5, 28, 1, '0000-00-00 00:00:00'),
(6, 29, 21, '0000-00-00 00:00:00'),
(7, 30, 21, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `hospitals`
--

CREATE TABLE `hospitals` (
  `id` bigint(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `short_name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hospitals`
--

INSERT INTO `hospitals` (`id`, `name`, `short_name`) VALUES
(1, 'Western Visayas Medical Center', 'WVMC'),
(2, 'Doctors Hospital Iloilo', 'DHI'),
(3, 'Mission Hostpital Iloilo', 'MHI');

-- --------------------------------------------------------

--
-- Table structure for table `persons`
--

CREATE TABLE `persons` (
  `id` bigint(20) NOT NULL,
  `brgy_id` bigint(20) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `middlename` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `extension` varchar(5) NOT NULL,
  `status` varchar(15) NOT NULL,
  `hospital_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `persons`
--

INSERT INTO `persons` (`id`, `brgy_id`, `firstname`, `middlename`, `lastname`, `extension`, `status`, `hospital_id`) VALUES
(1, 2, 'loreto', 'g', 'gabawa', 'jr', 'pum', 2),
(2, 1, 'brandon', 'G', 'Lee', '', 'pui', 2),
(3, 1, 'loreto', '22', 'Gab', '', 'pum', 3),
(4, 0, 'loreto', 'gabitanan', 'gabawa', '', 'pui', NULL),
(5, 0, 'loreto', 'gabitanan', 'gabawa', '', 'pum', NULL),
(6, 0, 'loreto', 'gabitanan', 'gabawa', '', 'pum', NULL),
(7, 0, 'loreto', 'gabitanan', 'gabawa', '', 'pum', NULL),
(8, 0, 'asdasd', 'adss', 'asd', 'pum', 'pum', NULL),
(9, 0, 'xxx', 'xxx', 'xxyyy', 'pui', 'pum', NULL),
(10, 0, 'asdads', 'asd', 'asd', 'pui', 'pum', NULL),
(11, 0, 'asdasd', 'asd', 'asd', 'd', 'pui', NULL),
(12, 0, 'loreto', 'gabitanan', 'gabawa', 'jr', 'rcvrd', NULL),
(13, 0, 'asdasda', 'asd', 'asd', 'asd', 'rcvrd', NULL),
(14, 0, 'Michelle', 'P', 'Ezcriba', '', 'pui', NULL),
(15, 0, 'miriam', 'D', 'defensor', '', 'pui', NULL),
(16, 0, 'lors', 'g', 'gab', 'jr', 'pum', NULL),
(17, 0, 'jose', 'p', 'rizal', '', 'pui', NULL),
(18, 0, 'magdaleno', 'p', 'aurecencio', '', 'pum', NULL),
(19, 0, 'x', 'x', 'x', 'x', 'pum', NULL),
(20, 0, 'w', 'w', 'w', 'w', 'pum', NULL),
(21, 0, 'q', 'q', 'q', 'q', 'pum', NULL),
(22, 0, 'y', 'y', 'y', 'y', 'pum', NULL),
(23, 0, 'ddd', 'ddd', 'dd', 'ddd', 'pum', NULL),
(24, 0, 'v', 'v', 'v', 'v', 'pum', NULL),
(25, 0, 'h', 'h', 'h', 'hh', 'pum', NULL),
(26, 0, 'p', 'p', 'p', 'p', 'pum', NULL),
(27, 0, 'popo', 'popo', 'popo', '', 'pum', NULL),
(28, 0, 'n', 'n', 'n', 'n', 'pum', NULL),
(29, 0, 'cindy', 'm', 'guevarra', '', 'pum', NULL),
(30, 0, 'berky', 'm', 'ado', '', 'pum', NULL),
(31, 0, 'test', 'test', 'test', '', 'pum', NULL),
(32, 2, 'lee', 'lee', 'lee', '', 'pui', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barangays`
--
ALTER TABLE `barangays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_traces`
--
ALTER TABLE `contact_traces`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hospitals`
--
ALTER TABLE `hospitals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `persons`
--
ALTER TABLE `persons`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `barangays`
--
ALTER TABLE `barangays`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact_traces`
--
ALTER TABLE `contact_traces`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `hospitals`
--
ALTER TABLE `hospitals`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `persons`
--
ALTER TABLE `persons`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
