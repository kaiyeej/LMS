-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2023 at 05:04 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_clients`
--

CREATE TABLE `tbl_clients` (
  `client_id` int(11) NOT NULL,
  `client_fname` varchar(50) NOT NULL,
  `client_mname` varchar(50) NOT NULL,
  `client_lname` varchar(50) NOT NULL,
  `client_name_extension` varchar(5) NOT NULL,
  `client_dob` date NOT NULL,
  `client_contact_no` varchar(30) NOT NULL,
  `client_civil_status` varchar(10) NOT NULL COMMENT 'Single, Married, Widowed, Seperated',
  `client_address` varchar(250) NOT NULL,
  `client_address_status` varchar(10) NOT NULL COMMENT 'Owned, Rented, Free use',
  `client_res_cert_no` varchar(30) NOT NULL,
  `client_res_cert_issued_at` varchar(30) NOT NULL,
  `client_res_cert_date` date NOT NULL,
  `client_employer` varchar(50) NOT NULL,
  `client_employer_address` varchar(250) NOT NULL,
  `client_employer_contact_no` varchar(15) NOT NULL,
  `client_emp_position` varchar(30) NOT NULL,
  `Column 18` varchar(30) NOT NULL,
  `client_emp_income` decimal(12,3) NOT NULL DEFAULT 0.000,
  `client_emp_status` varchar(15) NOT NULL,
  `client_emp_length` int(2) NOT NULL DEFAULT 0,
  `client_prev_emp` varchar(50) NOT NULL,
  `client_spouse` varchar(50) NOT NULL,
  `client_spouse_address` varchar(250) NOT NULL,
  `client_spouse_res_cert_no` varchar(50) NOT NULL,
  `client_spouse_res_cert_issued_at` varchar(50) NOT NULL,
  `client_no_of_child` int(3) NOT NULL DEFAULT 0,
  `client_no_of_child_elem` int(3) NOT NULL DEFAULT 0,
  `client_no_of_child_hs` int(3) NOT NULL DEFAULT 0,
  `client_no_of_child_college` int(3) NOT NULL DEFAULT 0,
  `client_spouse_res_cert_date` date NOT NULL,
  `client_spouse_employer` varchar(50) NOT NULL DEFAULT '',
  `client_no_of_childred` int(3) NOT NULL DEFAULT 0,
  `client_no_of_child_dependent` int(3) NOT NULL DEFAULT 0,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_last_modified` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_clients`
--

INSERT INTO `tbl_clients` (`client_id`, `client_fname`, `client_mname`, `client_lname`, `client_name_extension`, `client_dob`, `client_contact_no`, `client_civil_status`, `client_address`, `client_address_status`, `client_res_cert_no`, `client_res_cert_issued_at`, `client_res_cert_date`, `client_employer`, `client_employer_address`, `client_employer_contact_no`, `client_emp_position`, `Column 18`, `client_emp_income`, `client_emp_status`, `client_emp_length`, `client_prev_emp`, `client_spouse`, `client_spouse_address`, `client_spouse_res_cert_no`, `client_spouse_res_cert_issued_at`, `client_no_of_child`, `client_no_of_child_elem`, `client_no_of_child_hs`, `client_no_of_child_college`, `client_spouse_res_cert_date`, `client_spouse_employer`, `client_no_of_childred`, `client_no_of_child_dependent`, `date_added`, `date_last_modified`) VALUES
(1, 'Sample', 'Mi', 'S', 'Jr.', '2008-12-29', '2313123', '', 'sdsa', '', '', '', '0000-00-00', '', '', '', '', '', '0.000', '', 0, '', '', '', '', '', 0, 0, 0, 0, '0000-00-00', '', 0, 0, '2023-04-09 21:09:35', '2023-04-09 21:31:43');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_collections`
--

CREATE TABLE `tbl_collections` (
  `collection_id` int(11) NOT NULL,
  `loan_id` int(11) DEFAULT NULL,
  `amount` decimal(12,3) DEFAULT NULL,
  `remarks` varchar(250) DEFAULT NULL,
  `status` varchar(1) NOT NULL COMMENT 'P - Pending ; F - Finished',
  `user_id` int(11) NOT NULL DEFAULT 0,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_last_modified` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_loans`
--

CREATE TABLE `tbl_loans` (
  `loan_id` int(11) NOT NULL,
  `reference_number` varchar(50) NOT NULL,
  `client_id` int(11) NOT NULL DEFAULT 0,
  `loan_type_id` int(11) NOT NULL DEFAULT 0,
  `loan_amount` decimal(12,3) NOT NULL DEFAULT 0.000,
  `loan_period` int(6) NOT NULL DEFAULT 0,
  `loan_interest` decimal(12,3) NOT NULL DEFAULT 0.000,
  `due_date` date NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'P' COMMENT 'P - Pending; A - Approved; R - Released; D - Denied',
  `loan_date` date NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_last_modified` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_loans`
--

INSERT INTO `tbl_loans` (`loan_id`, `reference_number`, `client_id`, `loan_type_id`, `loan_amount`, `loan_period`, `loan_interest`, `due_date`, `status`, `loan_date`, `date_added`, `date_last_modified`) VALUES
(1, 'LN-20230410152538', 1, 1, '1000.000', 4, '3.000', '0000-00-00', 'C', '2023-04-10', '2023-04-10 22:06:05', '2023-04-10 22:21:13');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_loan_types`
--

CREATE TABLE `tbl_loan_types` (
  `loan_type_id` int(11) NOT NULL,
  `loan_type` varchar(50) DEFAULT NULL,
  `loan_type_interest` decimal(5,2) NOT NULL,
  `remarks` varchar(250) DEFAULT NULL,
  `date_added` datetime DEFAULT current_timestamp(),
  `date_last_modified` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_loan_types`
--

INSERT INTO `tbl_loan_types` (`loan_type_id`, `loan_type`, `loan_type_interest`, `remarks`, `date_added`, `date_last_modified`) VALUES
(1, 'short term loan', '12.00', '', '2023-04-09 22:12:49', '2023-04-11 10:22:37');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL,
  `user_fname` varchar(50) NOT NULL,
  `user_mname` varchar(50) NOT NULL,
  `user_lname` varchar(50) NOT NULL,
  `user_category` varchar(1) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_last_modified` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `user_fname`, `user_mname`, `user_lname`, `user_category`, `username`, `password`, `date_added`, `date_last_modified`) VALUES
(1, 'Juan', '', 'Dela Cruz', 'A', 'admin', '0cc175b9c0f1b6a831c399e269772661', '2023-04-09 20:44:25', '2023-04-09 20:45:02'),
(2, 'd', 'k', 'k', 'A', 's', '03c7c0ace395d80182db07ae2c30f034', '2023-04-10 10:14:42', '2023-04-10 10:14:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_clients`
--
ALTER TABLE `tbl_clients`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `tbl_collections`
--
ALTER TABLE `tbl_collections`
  ADD PRIMARY KEY (`collection_id`);

--
-- Indexes for table `tbl_loans`
--
ALTER TABLE `tbl_loans`
  ADD PRIMARY KEY (`loan_id`);

--
-- Indexes for table `tbl_loan_types`
--
ALTER TABLE `tbl_loan_types`
  ADD PRIMARY KEY (`loan_type_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_clients`
--
ALTER TABLE `tbl_clients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_collections`
--
ALTER TABLE `tbl_collections`
  MODIFY `collection_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_loans`
--
ALTER TABLE `tbl_loans`
  MODIFY `loan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_loan_types`
--
ALTER TABLE `tbl_loan_types`
  MODIFY `loan_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
