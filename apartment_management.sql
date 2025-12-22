-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2025 at 05:25 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apartment_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`, `email`, `phone_number`) VALUES
(1, 'aseem', '$2y$10$x/mLTcWRNTNDv83sSmQtFes5YiLtqz/lIG8brQ2fJZfkKHnmGDQY2', 'aseemadkary.official@gmail.com', '9861296569');

-- --------------------------------------------------------

--
-- Table structure for table `apartment`
--

CREATE TABLE `apartment` (
  `apartment_id` int(11) NOT NULL,
  `building_name` varchar(255) NOT NULL,
  `unit_number` varchar(10) NOT NULL,
  `owner_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apartment`
--

INSERT INTO `apartment` (`apartment_id`, `building_name`, `unit_number`, `owner_id`) VALUES
(1, 'Prestige Shantiniketan', 'A1', 1),
(2, 'Salarpuria Sattva Greenage', 'B2', 2),
(3, 'Sobha Silicon Oasis', 'C3', 3),
(4, 'Brigade Millennium', 'D4', 4),
(5, 'Purva Riviera', 'E5', 5);

-- --------------------------------------------------------

--
-- Table structure for table `complaint`
--

CREATE TABLE `complaint` (
  `complaint_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `tenant_id` int(11) DEFAULT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `complaint_id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `complaint_text` text DEFAULT NULL,
  `complaint_date` date DEFAULT NULL,
  `tenant_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `first_name`, `last_name`, `email`, `phone_number`, `admin_id`, `owner_id`, `username`, `password`, `name`) VALUES
(28, 'Ram', 'Shrestha', 'shrestha@gmail.com', '9845452132', 1, NULL, 'ram', 'ram', ''),
(29, 'Ashim', 'Adhikari', 'adkaryaseem.official@gmail.com', '9861296569', 1, NULL, 'ashim', 'ashim', ''),
(27, 'Ashim', 'Adhikari', 'adkaryaseem.official@gmail.com', '9861296569', 1, NULL, 'ashim', 'ashim', '');

-- --------------------------------------------------------

--
-- Table structure for table `enquiries`
--

CREATE TABLE `enquiries` (
  `enquiry_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `enquiry_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enquiries`
--

INSERT INTO `enquiries` (`enquiry_id`, `name`, `email`, `contact`, `enquiry_date`) VALUES
(1, 'Ashim Adhikari', 'adkaryaseem.official@gmail.com', '9861296569', '2025-12-22 16:05:18');

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

CREATE TABLE `hotel` (
  `building_id` int(11) NOT NULL,
  `building_name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `maintenance_payment`
--

CREATE TABLE `maintenance_payment` (
  `payment_id` int(11) NOT NULL,
  `tenant_id` int(11) DEFAULT NULL,
  `amount_paid` decimal(10,2) DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `service_name` varchar(255) NOT NULL,
  `fee_amount` decimal(10,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `maintenance_payment`
--

INSERT INTO `maintenance_payment` (`payment_id`, `tenant_id`, `amount_paid`, `payment_date`, `service_id`, `service_name`, `fee_amount`) VALUES
(1, 1, 0.01, '2024-02-18', NULL, '', 0.00),
(2, 1, 0.02, '2024-02-18', NULL, '', 0.00),
(3, 12, 50.00, '2024-02-22', 1, '', 0.00),
(4, 14, 70.00, '2024-02-23', 3, '', 0.00),
(5, 12, 60.00, '2024-02-23', 2, '', 0.00),
(6, 12, 40.00, '2024-02-23', 4, '', 0.00),
(7, NULL, 100.00, '2024-02-23', 2, '', 0.00),
(8, 12, 50.00, '2024-02-23', 1, '', 0.00),
(9, 14, 80.00, '2024-02-26', 5, '', 0.00),
(10, 15, 50.00, '2024-02-26', 1, '', 0.00),
(11, 1, 100.00, '2024-02-27', 1, '0', 50.00),
(12, 15, 60.00, '2024-03-17', 2, '', 0.00),
(13, 16, 40.00, '2024-03-17', 4, '', 0.00),
(14, 17, 70.00, '2024-03-18', 3, '', 0.00),
(15, 17, 1.00, '2024-03-18', 1, '', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

CREATE TABLE `owner` (
  `owner_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `owner`
--

INSERT INTO `owner` (`owner_id`, `first_name`, `last_name`, `email`, `phone_number`, `username`, `password`) VALUES
(6, 'Sandhya', 'Prithvi', 'sandhyaprithvi@gmail.com', '9739550101', 'sandhya', '12345'),
(8, 'zz', 'aaaaabhyu', 'abhyu@gmail.com', '87878787', 'abhyu', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `parking`
--

CREATE TABLE `parking` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `parking_slot` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `parking_slot`
--

CREATE TABLE `parking_slot` (
  `parking_slot_id` int(11) NOT NULL,
  `slot_number` int(11) NOT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parking_slot`
--

INSERT INTO `parking_slot` (`parking_slot_id`, `slot_number`, `owner_id`, `employee_id`) VALUES
(1, 1, 6, NULL),
(2, 2, 6, NULL),
(3, 3, 6, NULL),
(4, 5, 6, NULL),
(5, 11, 7, NULL),
(6, 10, 6, 5);

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_id` int(11) NOT NULL,
  `building_name` varchar(255) NOT NULL,
  `unit_number` int(11) NOT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `total_flats` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `building_name`, `unit_number`, `owner_id`, `total_flats`) VALUES
(1, 'RV', 1, 1, 70),
(2, 'Mantri Pinacle', 100, 6, 70),
(3, 'Brigade Millenium', 101, 7, 70);

-- --------------------------------------------------------

--
-- Table structure for table `salary_requests`
--

CREATE TABLE `salary_requests` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `current_salary` decimal(10,2) DEFAULT NULL,
  `requested_increment` decimal(10,2) DEFAULT NULL,
  `reason` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salary_requests`
--

INSERT INTO `salary_requests` (`id`, `employee_id`, `current_salary`, `requested_increment`, `reason`) VALUES
(1, NULL, NULL, NULL, NULL),
(2, NULL, NULL, NULL, NULL),
(3, NULL, NULL, NULL, NULL),
(4, NULL, NULL, NULL, NULL),
(5, NULL, NULL, NULL, NULL),
(6, NULL, NULL, NULL, NULL),
(7, NULL, NULL, NULL, NULL),
(8, NULL, NULL, NULL, NULL),
(9, NULL, NULL, NULL, NULL),
(10, NULL, NULL, NULL, NULL),
(11, NULL, NULL, NULL, NULL),
(12, NULL, NULL, NULL, NULL),
(13, NULL, NULL, NULL, NULL),
(14, NULL, NULL, NULL, NULL),
(15, NULL, NULL, NULL, NULL),
(16, NULL, NULL, NULL, NULL),
(17, NULL, NULL, NULL, NULL),
(18, NULL, NULL, NULL, NULL),
(19, NULL, NULL, NULL, NULL),
(20, NULL, NULL, NULL, NULL),
(21, NULL, NULL, NULL, NULL),
(22, NULL, NULL, NULL, NULL),
(23, NULL, NULL, NULL, NULL),
(24, NULL, NULL, NULL, NULL),
(25, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` int(11) NOT NULL,
  `service_name` varchar(255) NOT NULL,
  `fee_amount` decimal(10,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `service_name`, `fee_amount`) VALUES
(1, 'Plumbing Repair', 50.00),
(2, 'Electrical Maintenance', 60.00),
(3, 'HVAC Service', 70.00),
(4, 'Pest Control', 40.00),
(5, 'Appliance Repair', 80.00);

-- --------------------------------------------------------

--
-- Table structure for table `service_requests`
--

CREATE TABLE `service_requests` (
  `request_id` int(11) NOT NULL,
  `tenant_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `requested_time` datetime DEFAULT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_requests`
--

INSERT INTO `service_requests` (`request_id`, `tenant_id`, `service_id`, `requested_time`, `status`) VALUES
(9, 15, 1, '0000-00-00 00:00:00', 'Approved'),
(10, 16, 4, '0000-00-00 00:00:00', 'Approved'),
(11, 16, 2, '0000-00-00 00:00:00', 'Approved'),
(12, 15, 5, '0000-00-00 00:00:00', ''),
(13, 17, 1, '0000-00-00 00:00:00', 'Approved'),
(14, 17, 1, '0000-00-00 00:00:00', ''),
(15, 21, 1, '0000-00-00 00:00:00', ''),
(16, 15, 2, '0000-00-00 00:00:00', ''),
(17, 16, 2, '0000-00-00 00:00:00', 'Approved'),
(18, 17, 4, '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `tenant`
--

CREATE TABLE `tenant` (
  `tenant_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `age` int(11) NOT NULL,
  `dob` date NOT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tenant`
--

INSERT INTO `tenant` (`tenant_id`, `first_name`, `last_name`, `email`, `phone_number`, `age`, `dob`, `owner_id`, `username`, `password`) VALUES
(17, 'Ankit', 'Raj', 'rajankit1364@gmail.com', '3787583754', 20, '2003-11-29', 5, '', ''),
(15, 'Vijay', 'Kumar', 'lucky123@gmail.com', '9873632347', 10, '2014-07-16', 5, '', ''),
(16, 'Murali', 'Bharadhwaj', 'sandhyaprithvi@gmail.com', '9972611000', 47, '1975-10-29', 10, '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `apartment`
--
ALTER TABLE `apartment`
  ADD PRIMARY KEY (`apartment_id`),
  ADD KEY `owner_id` (`owner_id`);

--
-- Indexes for table `complaint`
--
ALTER TABLE `complaint`
  ADD PRIMARY KEY (`complaint_id`),
  ADD KEY `tenant_id` (`tenant_id`),
  ADD KEY `owner_id` (`owner_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`complaint_id`),
  ADD KEY `tenant_id` (`tenant_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `owner_id` (`owner_id`);

--
-- Indexes for table `enquiries`
--
ALTER TABLE `enquiries`
  ADD PRIMARY KEY (`enquiry_id`);

--
-- Indexes for table `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`building_id`);

--
-- Indexes for table `maintenance_payment`
--
ALTER TABLE `maintenance_payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `tenant_id` (`tenant_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `owner`
--
ALTER TABLE `owner`
  ADD PRIMARY KEY (`owner_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `parking`
--
ALTER TABLE `parking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parking_slot`
--
ALTER TABLE `parking_slot`
  ADD PRIMARY KEY (`parking_slot_id`),
  ADD KEY `owner_id` (`owner_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`),
  ADD KEY `owner_id` (`owner_id`);

--
-- Indexes for table `salary_requests`
--
ALTER TABLE `salary_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `service_requests`
--
ALTER TABLE `service_requests`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `tenant_id` (`tenant_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `tenant`
--
ALTER TABLE `tenant`
  ADD PRIMARY KEY (`tenant_id`),
  ADD KEY `owner_id` (`owner_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `apartment`
--
ALTER TABLE `apartment`
  MODIFY `apartment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `complaint`
--
ALTER TABLE `complaint`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `enquiries`
--
ALTER TABLE `enquiries`
  MODIFY `enquiry_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hotel`
--
ALTER TABLE `hotel`
  MODIFY `building_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `maintenance_payment`
--
ALTER TABLE `maintenance_payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `owner`
--
ALTER TABLE `owner`
  MODIFY `owner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `parking`
--
ALTER TABLE `parking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `parking_slot`
--
ALTER TABLE `parking_slot`
  MODIFY `parking_slot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `salary_requests`
--
ALTER TABLE `salary_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `service_requests`
--
ALTER TABLE `service_requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tenant`
--
ALTER TABLE `tenant`
  MODIFY `tenant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
