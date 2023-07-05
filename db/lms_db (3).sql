-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2023 at 10:51 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

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
-- Table structure for table `tbl_branches`
--

CREATE TABLE `tbl_branches` (
  `branch_id` int(11) NOT NULL,
  `branch_name` varchar(50) NOT NULL,
  `remarks` text NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_branches`
--

INSERT INTO `tbl_branches` (`branch_id`, `branch_name`, `remarks`, `date_added`, `date_last_modified`, `user_id`) VALUES
(1, 'Bacolod', '', '2023-05-31 10:33:44', '2023-06-14 14:10:48', 0),
(2, 'La Carlota', '', '2023-05-31 10:34:45', '2023-06-14 14:10:56', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_chart_classification`
--

CREATE TABLE `tbl_chart_classification` (
  `chart_class_id` int(11) NOT NULL,
  `chart_class_name` varchar(50) NOT NULL,
  `chart_class_code` varchar(10) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_chart_classification`
--

INSERT INTO `tbl_chart_classification` (`chart_class_id`, `chart_class_name`, `chart_class_code`, `date_added`, `date_last_modified`, `user_id`) VALUES
(1, 'Current Asset', 'CA', '2023-05-17 13:41:16', '2023-05-17 13:41:16', 0),
(2, 'Non Current Asset', 'NCA', '2023-05-17 13:41:25', '2023-05-17 13:41:25', 0),
(3, 'Current Liabilities', 'CL', '2023-05-17 13:41:39', '2023-05-17 13:41:39', 0),
(4, 'Equity', 'EQ', '2023-05-17 13:41:56', '2023-05-17 13:41:56', 0),
(5, 'Revenue', 'REV', '2023-05-17 13:42:10', '2023-05-17 13:42:10', 0),
(6, 'Cost & Expenses', 'CE', '2023-05-17 13:42:30', '2023-05-17 13:42:30', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_chart_of_accounts`
--

CREATE TABLE `tbl_chart_of_accounts` (
  `chart_id` int(11) NOT NULL,
  `chart_code` varchar(10) NOT NULL,
  `chart_name` varchar(50) NOT NULL,
  `chart_type` varchar(1) NOT NULL COMMENT 'M - Main; S - Sub',
  `main_chart_id` int(11) DEFAULT NULL,
  `chart_class_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_chart_of_accounts`
--

INSERT INTO `tbl_chart_of_accounts` (`chart_id`, `chart_code`, `chart_name`, `chart_type`, `main_chart_id`, `chart_class_id`, `date_added`, `date_last_modified`, `user_id`) VALUES
(1, '100100', 'Petty Cash Fund', 'M', 0, 1, '2023-05-05 09:07:51', '2023-05-18 14:46:22', 0),
(2, '100200', 'Revolving Fund', 'M', 0, 1, '2023-05-05 09:08:15', '2023-05-18 14:46:40', 0),
(4, '200100', 'Cash in Bank', 'M', 0, 1, '2023-05-05 09:12:29', '2023-05-18 14:46:40', 0),
(5, '100300', 'Cash in Bank - RBMI-Featherleaf-(51-000120-4)', 'S', 4, 1, '2023-05-05 09:16:07', '2023-05-18 14:46:40', 0),
(6, '100400', 'Cash in Bank - RBMI - Featherleaf (101-21-000448-4', 'S', 4, 1, '2023-05-05 09:16:47', '2023-05-18 14:46:40', 0),
(7, '100500', 'Cash in Bank - RBMI - Featherleaf (101-21-000739-4', 'S', 4, 1, '2023-05-05 09:17:07', '2023-05-18 14:46:40', 0),
(8, '100600', 'Cash in Bank - CHINABANK - Featherleaf (1087000020', 'S', 4, 1, '2023-05-05 10:09:53', '2023-05-18 14:46:40', 0),
(9, '100700', 'Cash in Bank - PNB', 'S', 4, 1, '2023-05-05 10:10:08', '2023-05-18 14:46:40', 0),
(10, '100800', 'Cash in Bank - LAND BANK', 'S', 4, 1, '2023-05-05 10:10:22', '2023-05-18 14:46:40', 0),
(11, '100900', 'Cash in Bank - BDO', 'S', 4, 1, '2023-05-05 10:10:59', '2023-05-18 14:46:40', 0),
(12, '101000', 'Prepaid Rent', 'M', 0, 1, '2023-05-05 10:12:00', '2023-05-18 14:46:40', 0),
(13, '20020', 'Loans Receivable', 'M', 0, 1, '2023-05-05 10:12:46', '2023-05-18 14:46:40', 0),
(14, '101200', 'Loans Receivable - Pension Loan - Bacolod', 'S', 13, 1, '2023-05-05 10:13:17', '2023-06-13 16:02:24', 0),
(15, '101201', 'Loans Receivable - Pension Loan -LA CARLOTA', 'S', 13, 1, '2023-05-05 10:18:28', '2023-05-18 14:46:40', 0),
(16, '101202', 'Loans Receivable - Pension Loan -TALISAY', 'S', 13, 1, '2023-05-05 10:18:46', '2023-05-18 14:46:40', 0),
(17, '101300', 'Loans Receivable - Salary Loan - Bacolod', 'S', 13, 1, '2023-05-05 10:19:53', '2023-06-13 16:02:43', 0),
(18, '101301', 'Loans Receivable -  Salary Loan- LA CARLOTA', 'S', 13, 1, '2023-05-05 10:20:06', '2023-05-18 14:46:40', 0),
(19, '101302', 'Loans Receivable - Salary Loan- TALISAY', 'S', 13, 1, '2023-05-05 10:20:24', '2023-05-18 14:46:40', 0),
(20, 'w', 'Petty Cash Fund - ', 'S', 1, 1, '2023-05-17 13:54:28', '2023-05-18 14:46:40', 0),
(28, '21', '32 - 2', 'S', 0, 1, '2023-05-17 14:39:14', '2023-05-18 14:46:40', 0),
(31, '21', '2 - 21', 'S', 30, 1, '2023-05-17 14:41:45', '2023-05-18 14:46:40', 0),
(32, '12323', 'sample', 'M', 0, 1, '2023-05-17 14:42:09', '2023-05-17 14:42:09', 0),
(33, '23', 'sample - 3', 'S', 32, 1, '2023-05-17 14:42:24', '2023-05-17 14:42:24', 0),
(34, '3123', '32123', 'M', 0, 1, '2023-05-17 14:44:13', '2023-05-17 14:44:13', 0),
(35, '23', '234', 'M', 0, 1, '2023-05-17 14:48:39', '2023-05-17 14:48:39', 0),
(36, '234', 'Revolving Fund - 32', 'S', 2, 1, '2023-05-17 14:48:46', '2023-05-18 14:46:40', 0),
(37, '400300', 'Interest Income', 'M', 0, 1, '2023-06-13 15:31:35', '2023-06-13 15:31:35', 0),
(38, '400301', 'Interest Income - Bacolod', 'S', 37, 1, '2023-06-13 15:32:03', '2023-06-13 15:32:03', 0),
(39, '400400', 'Penalty Income', 'M', 0, 1, '2023-06-13 15:46:29', '2023-06-13 15:46:29', 0),
(40, '400401', 'Penalty Income - Bacolod', 'S', 39, 1, '2023-06-13 15:46:57', '2023-06-13 15:46:57', 0),
(41, '101400', 'Loans Receivable - BONUS LOAN - Bacolod', 'S', 13, 1, '2023-06-13 16:03:36', '2023-06-13 16:34:38', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_children`
--

CREATE TABLE `tbl_children` (
  `child_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `child_name` varchar(150) NOT NULL,
  `child_sex` varchar(10) NOT NULL,
  `child_age` int(11) NOT NULL,
  `child_occupation` varchar(50) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_children`
--

INSERT INTO `tbl_children` (`child_id`, `client_id`, `child_name`, `child_sex`, `child_age`, `child_occupation`, `date_added`, `date_last_modified`) VALUES
(1, 2184, 'Cairo', 'Male', 5, 'N/A', '2023-06-07 11:11:28', '2023-06-07 11:11:28'),
(18, 20, 'Hezekiah Cairo F. Carton', 'Male', 4, 'NA', '2023-06-19 11:29:39', '2023-06-19 11:29:39'),
(19, 20, 'Hezekiah Chiara Flores Carton', 'Female', 1, 'NA', '2023-06-19 11:29:39', '2023-06-19 11:29:39');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_clients`
--

CREATE TABLE `tbl_clients` (
  `client_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `client_type_id` int(11) NOT NULL,
  `client_fname` varchar(50) NOT NULL,
  `client_mname` varchar(50) NOT NULL,
  `client_lname` varchar(50) NOT NULL,
  `client_name_extension` varchar(5) NOT NULL,
  `client_dob` date NOT NULL,
  `client_contact_no` varchar(30) NOT NULL,
  `client_civil_status` varchar(10) NOT NULL COMMENT 'Single, Married, Widowed, Seperated',
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_clients`
--

INSERT INTO `tbl_clients` (`client_id`, `branch_id`, `client_type_id`, `client_fname`, `client_mname`, `client_lname`, `client_name_extension`, `client_dob`, `client_contact_no`, `client_civil_status`, `date_added`, `date_last_modified`) VALUES
(20, 1, 0, 'Eduard Rino', 'Questo', 'Carton', '', '1997-09-30', '9096836075', 'Married', '2023-06-19 11:29:39', '2023-06-19 11:29:39'),
(21, 2, 0, 'John Mark', 'G', 'Amar', 'Jr', '1995-06-08', '9999121511', 'Single', '2023-06-19 11:29:39', '2023-06-19 11:29:39'),
(22, 1, 1, '32', '24', '34', '34', '2023-06-19', '324', 'Married', '2023-06-19 13:37:32', '2023-06-19 13:37:32');

--
-- Triggers `tbl_clients`
--
DELIMITER $$
CREATE TRIGGER `delete_client` AFTER DELETE ON `tbl_clients` FOR EACH ROW BEGIN
DELETE FROM tbl_children WHERE client_id = OLD.client_id;
DELETE FROM tbl_client_atm WHERE client_id = OLD.client_id;
DELETE FROM tbl_client_business WHERE client_id = OLD.client_id;
DELETE FROM tbl_client_dependents WHERE client_id = OLD.client_id;
DELETE FROM tbl_client_employment WHERE client_id = OLD.client_id;
DELETE FROM tbl_client_insurance WHERE client_id = OLD.client_id;
DELETE FROM tbl_client_reference WHERE client_id = OLD.client_id;
DELETE FROM tbl_client_residence WHERE client_id = OLD.client_id;
DELETE FROM tbl_client_soi WHERE client_id = OLD.client_id;
DELETE FROM tbl_client_spouse WHERE client_id = OLD.client_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_client_atm`
--

CREATE TABLE `tbl_client_atm` (
  `atm_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL DEFAULT '0',
  `atm_account_no` varchar(50) DEFAULT NULL,
  `atm_bank` varchar(50) DEFAULT NULL,
  `atm_balance` decimal(15,3) NOT NULL DEFAULT '0.000',
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_client_atm`
--

INSERT INTO `tbl_client_atm` (`atm_id`, `client_id`, `atm_account_no`, `atm_bank`, `atm_balance`, `date_added`, `date_last_modified`) VALUES
(1, 9, '01001101', 'BDO', '0.000', '2023-06-16 10:45:17', '2023-06-16 10:45:17'),
(2, 10, '10010121', 'BDO1', '0.000', '2023-06-16 11:11:40', '2023-06-19 09:51:02'),
(12, 20, '', '', '0.000', '2023-06-19 11:29:39', '2023-06-19 11:29:39'),
(13, 21, '', '', '0.000', '2023-06-19 11:29:39', '2023-06-19 11:29:39'),
(14, 22, '', '', '0.000', '2023-06-19 13:37:33', '2023-06-19 13:37:33');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_client_business`
--

CREATE TABLE `tbl_client_business` (
  `business_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL DEFAULT '0',
  `business_name` varchar(150) DEFAULT NULL,
  `business_address` varchar(150) DEFAULT NULL,
  `business_contact` varchar(50) DEFAULT NULL,
  `business_position` varchar(50) DEFAULT NULL,
  `business_kind` varchar(150) DEFAULT NULL,
  `business_length` varchar(50) DEFAULT NULL,
  `business_capital` decimal(15,3) DEFAULT NULL,
  `business_type` varchar(50) DEFAULT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_client_business`
--

INSERT INTO `tbl_client_business` (`business_id`, `client_id`, `business_name`, `business_address`, `business_contact`, `business_position`, `business_kind`, `business_length`, `business_capital`, `business_type`, `date_added`, `date_last_modified`) VALUES
(1, 9, 'asda', 'sdasdas', 'dasd', 'asdasd', 'adasdasd', '5', '1000.000', 'Owner', '2023-06-16 10:50:04', '2023-06-16 10:50:04'),
(2, 10, 'IT Slutiopns1', 'Bacolod1', '09121', 'Owner1', 'IT1', '31', '10001.000', 'Owner', '2023-06-16 11:11:40', '2023-06-19 09:50:32'),
(12, 20, 'Zech Solutions', 'Bacolod', '123456789', 'Owner', 'IT', '2', '10000.000', 'Owner', '2023-06-19 11:29:39', '2023-06-19 11:29:39'),
(13, 21, 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', '0.000', 'NA', '2023-06-19 11:29:39', '2023-06-19 11:29:39'),
(14, 22, '', '', '', '', '', '', '0.000', '', '2023-06-19 13:37:33', '2023-06-19 13:37:33');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_client_dependents`
--

CREATE TABLE `tbl_client_dependents` (
  `dependent_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL DEFAULT '0',
  `no_of_children` int(11) NOT NULL DEFAULT '0',
  `dep_no_of_child` int(11) NOT NULL DEFAULT '0',
  `dep_college` int(11) NOT NULL DEFAULT '0',
  `dep_hs` int(11) NOT NULL DEFAULT '0',
  `dep_elem` int(11) NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_client_dependents`
--

INSERT INTO `tbl_client_dependents` (`dependent_id`, `client_id`, `no_of_children`, `dep_no_of_child`, `dep_college`, `dep_hs`, `dep_elem`, `date_added`, `date_last_modified`) VALUES
(1, 8, 3, 1, 2, 2, 2, '2023-06-16 10:09:21', '2023-06-16 10:09:21'),
(2, 9, 5, 5, 1, 5, 6, '2023-06-16 10:24:13', '2023-06-16 10:24:13'),
(3, 10, 51, 51, 71, 81, 91, '2023-06-16 11:11:40', '2023-06-19 09:42:10'),
(13, 20, 2, 2, 0, 0, 0, '2023-06-19 11:29:39', '2023-06-19 11:29:39'),
(14, 21, 0, 0, 0, 0, 0, '2023-06-19 11:29:39', '2023-06-19 11:29:39'),
(15, 22, 0, 0, 0, 0, 0, '2023-06-19 13:37:33', '2023-06-19 13:37:33');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_client_employment`
--

CREATE TABLE `tbl_client_employment` (
  `employment_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL DEFAULT '0',
  `employer_id` int(11) NOT NULL DEFAULT '0',
  `employer_address` varchar(150) DEFAULT NULL,
  `employer_contact_no` varchar(50) DEFAULT NULL,
  `employment_position` varchar(50) DEFAULT NULL,
  `employment_income` decimal(15,3) NOT NULL DEFAULT '0.000',
  `employment_status` varchar(15) DEFAULT NULL,
  `employment_length` varchar(15) NOT NULL DEFAULT '0',
  `last_employment` varchar(50) DEFAULT NULL,
  `current_status` int(1) NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_client_employment`
--

INSERT INTO `tbl_client_employment` (`employment_id`, `client_id`, `employer_id`, `employer_address`, `employer_contact_no`, `employment_position`, `employment_income`, `employment_status`, `employment_length`, `last_employment`, `current_status`, `date_added`, `date_last_modified`) VALUES
(1, 8, 1, 'Alijis', '09096836075', 'a', '30.000', 'a', 'a', 'a', 0, '2023-06-16 10:09:21', '2023-06-16 10:09:21'),
(2, 9, 1, 'Alijis', '09096836075', 'as', '500.000', 'a', 'a', 'a', 0, '2023-06-16 10:23:48', '2023-06-16 10:23:48'),
(3, 10, 1, 'Bago', '09096836075', 'A', '1000.000', 'Part Time', 'a', 'NA', 1, '2023-06-16 11:10:20', '2023-06-16 11:51:26'),
(4, 10, 3, 'a', '0912', 'Office', '1000.000', 'Part Time', '1', 'NA', 0, '2023-06-16 11:45:24', '2023-06-16 11:51:26'),
(14, 20, 1, 'Bacolod', '123', 'Software Developer', '20000.000', 'Regular', '6', '', 1, '2023-06-19 11:29:39', '2023-06-19 11:29:39'),
(15, 21, 0, 'Bacolod', '456', 'Designer', '25000.000', 'Regular', '5', '', 1, '2023-06-19 11:29:39', '2023-06-19 11:29:39'),
(16, 22, 3, 'a', 'asdas34', '34', '342.000', '432', '4', '4', 1, '2023-06-19 13:37:32', '2023-06-19 13:37:33');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_client_insurance`
--

CREATE TABLE `tbl_client_insurance` (
  `client_insurance_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL DEFAULT '0',
  `insurance_id` int(11) NOT NULL DEFAULT '0',
  `insurance_amount` decimal(15,3) NOT NULL DEFAULT '0.000',
  `insurance_maturity` int(11) NOT NULL DEFAULT '0',
  `insurance_bank_transaction` varchar(50) DEFAULT NULL,
  `insurance_unpaid_obligation` decimal(15,3) DEFAULT NULL,
  `insurance_salary_withdrawal` varchar(50) DEFAULT NULL,
  `paymaster_name` varchar(150) DEFAULT NULL,
  `paymaster_address` varchar(150) DEFAULT NULL,
  `paymaster_res_cert_no` varchar(150) DEFAULT NULL,
  `paymaster_res_cert_issued_at` varchar(150) DEFAULT NULL,
  `paymaster_res_cert_date` date NOT NULL DEFAULT '0000-00-00',
  `paymaster_deduct_salary` varchar(3) DEFAULT NULL COMMENT 'Yes,No',
  `paymaster_client_deduct_salary` varchar(3) DEFAULT NULL COMMENT 'Yes,No',
  `paymaster_conformity` varchar(3) DEFAULT NULL COMMENT 'Yes,No',
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_client_insurance`
--

INSERT INTO `tbl_client_insurance` (`client_insurance_id`, `client_id`, `insurance_id`, `insurance_amount`, `insurance_maturity`, `insurance_bank_transaction`, `insurance_unpaid_obligation`, `insurance_salary_withdrawal`, `paymaster_name`, `paymaster_address`, `paymaster_res_cert_no`, `paymaster_res_cert_issued_at`, `paymaster_res_cert_date`, `paymaster_deduct_salary`, `paymaster_client_deduct_salary`, `paymaster_conformity`, `date_added`, `date_last_modified`) VALUES
(1, 9, 5, '10.000', 20, 'sadas', '10.000', 'Semi-monthly', 'dsfsdfsdf', 'sdfsdf', 'ssdfs', 'dfsdf', '2023-06-16', 'Yes', 'No', 'No', '2023-06-16 10:50:04', '2023-06-16 10:51:39'),
(2, 10, 1, '1001.000', 231, 'Sds1', '101.000', 'Weekly', 'Mery1', 'Bacolod1', 'A1', 'a1', '2023-06-16', 'No', 'Yes', 'Yes', '2023-06-16 11:11:40', '2023-06-19 10:06:11'),
(12, 20, 1, '500.000', 0, '344', '0.000', 'Weekly', '4234', '24', '234', '42', '2023-06-20', 'No', 'No', 'No', '2023-06-19 11:29:39', '2023-06-20 15:30:01'),
(13, 21, 0, '800.000', 0, '', '0.000', '', '', '', '', '', '0000-00-00', 'No', 'No', 'No', '2023-06-19 11:29:39', '2023-06-19 11:29:39'),
(14, 22, 0, '0.000', 0, '', '0.000', '', '', '', '', '', '0000-00-00', 'No', 'No', 'No', '2023-06-19 13:37:33', '2023-06-19 13:37:33');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_client_reference`
--

CREATE TABLE `tbl_client_reference` (
  `reference_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL DEFAULT '0',
  `reference_no` int(11) NOT NULL DEFAULT '0',
  `reference_name` varchar(150) DEFAULT NULL,
  `reference_address` varchar(150) DEFAULT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_client_reference`
--

INSERT INTO `tbl_client_reference` (`reference_id`, `client_id`, `reference_no`, `reference_name`, `reference_address`, `date_added`, `date_last_modified`) VALUES
(1, 9, 1, 'Jude', 'Mansi', '2023-06-16 11:05:15', '2023-06-16 11:05:30'),
(2, 9, 2, 'Rafa', 'East Homes', '2023-06-16 11:05:15', '2023-06-16 11:05:30'),
(3, 9, 3, 'Mark', 'East', '2023-06-16 11:05:15', '2023-06-16 11:05:30'),
(4, 10, 1, 'Ginery1', 'Pulupandan1', '2023-06-16 11:11:40', '2023-06-19 09:50:32'),
(5, 10, 2, 'Mark1', 'Bacolod1', '2023-06-16 11:11:40', '2023-06-19 09:50:32'),
(6, 10, 3, 'Rafa1', 'Sagay1', '2023-06-16 11:11:40', '2023-06-19 09:50:32'),
(34, 20, 1, 'Judywen Guapin', 'Bacolod', '2023-06-19 11:29:39', '2023-06-19 11:29:39'),
(35, 20, 2, 'Ginery Songaling', 'Pulupandan', '2023-06-19 11:29:39', '2023-06-19 11:29:39'),
(36, 20, 3, 'Rafa Claveria', 'Sagay', '2023-06-19 11:29:39', '2023-06-19 11:29:39'),
(37, 21, 1, 'Judywen Guapin', 'Bacolod', '2023-06-19 11:29:39', '2023-06-19 11:29:39'),
(38, 21, 2, 'Ginery Songaling', 'Pulupandan', '2023-06-19 11:29:39', '2023-06-19 11:29:39'),
(39, 21, 3, 'Rafa Claveria', 'Sagay', '2023-06-19 11:29:39', '2023-06-19 11:29:39'),
(40, 22, 1, '', '', '2023-06-19 13:37:33', '2023-06-19 13:37:33'),
(41, 22, 2, '', '', '2023-06-19 13:37:33', '2023-06-19 13:37:33'),
(42, 22, 3, '', '', '2023-06-19 13:37:33', '2023-06-19 13:37:33');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_client_residence`
--

CREATE TABLE `tbl_client_residence` (
  `residence_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `residence` text,
  `residence_status` varchar(15) NOT NULL COMMENT 'Owned,Rented, Free of use',
  `residence_certificate_no` varchar(50) NOT NULL,
  `certificate_issued_at` varchar(150) NOT NULL,
  `certificate_date` date NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_client_residence`
--

INSERT INTO `tbl_client_residence` (`residence_id`, `client_id`, `residence`, `residence_status`, `residence_certificate_no`, `certificate_issued_at`, `certificate_date`, `date_added`, `date_last_modified`) VALUES
(1, 8, 'Asada', 'Owned', '1', 'a', '2023-06-16', '2023-06-16 10:09:21', '2023-06-16 10:09:21'),
(2, 9, 'adsads', 'Owned', 'asd', 'asd', '2023-06-16', '2023-06-16 10:23:47', '2023-06-16 10:23:47'),
(3, 10, 'Tangub1', 'Owned', 'asd1', 'asd1', '2023-01-01', '2023-06-16 11:10:20', '2023-06-16 11:45:24'),
(13, 20, 'Sagay City', 'Owned', '1', 'Sagay', '0000-00-00', '2023-06-19 11:29:39', '2023-06-19 11:29:39'),
(14, 21, 'Cauayan', 'Rented', '2', 'Bacolod', '0000-00-00', '2023-06-19 11:29:39', '2023-06-19 11:29:39'),
(15, 22, '34', 'Owned', '34', '4', '2023-06-19', '2023-06-19 13:37:32', '2023-06-19 13:37:32');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_client_soi`
--

CREATE TABLE `tbl_client_soi` (
  `soi_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL DEFAULT '0',
  `soi_name` varchar(50) DEFAULT NULL,
  `soi_by` varchar(50) DEFAULT NULL,
  `soi_monthly` decimal(12,3) NOT NULL DEFAULT '0.000',
  `soi_total` decimal(12,3) NOT NULL DEFAULT '0.000',
  `soi_obligation` decimal(12,3) NOT NULL DEFAULT '0.000',
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_client_soi`
--

INSERT INTO `tbl_client_soi` (`soi_id`, `client_id`, `soi_name`, `soi_by`, `soi_monthly`, `soi_total`, `soi_obligation`, `date_added`, `date_last_modified`) VALUES
(1, 9, 'asdasda', 'sdadasd', '150.000', '100.000', '200.000', '2023-06-16 10:45:17', '2023-06-16 10:45:17'),
(2, 10, 'EMployment1', 'Jerry Saydoquis1', '30001.000', '50001.000', '10001.000', '2023-06-16 11:11:40', '2023-06-19 09:50:32'),
(12, 20, 'Employment', 'Eduard Rino Carton', '20000.000', '1000.000', '100.000', '2023-06-19 11:29:39', '2023-06-19 11:29:39'),
(13, 21, '', '', '0.000', '1001.000', '101.000', '2023-06-19 11:29:39', '2023-06-19 11:29:39'),
(14, 22, '', '', '0.000', '0.000', '0.000', '2023-06-19 13:37:33', '2023-06-19 13:37:33');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_client_spouse`
--

CREATE TABLE `tbl_client_spouse` (
  `spouse_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL DEFAULT '0',
  `spouse_name` varchar(50) DEFAULT NULL,
  `spouse_residence` varchar(150) DEFAULT NULL,
  `spouse_res_cert_no` varchar(50) DEFAULT NULL,
  `spouse_res_cert_issued_at` varchar(150) DEFAULT NULL,
  `spouse_res_cert_date` date NOT NULL DEFAULT '0000-00-00',
  `spouse_employer` varchar(150) DEFAULT NULL,
  `spouse_employer_address` varchar(150) DEFAULT NULL,
  `spouse_employer_contact` varchar(50) DEFAULT NULL,
  `spouse_employment_status` varchar(10) DEFAULT NULL,
  `spouse_employment_position` varchar(50) DEFAULT NULL,
  `spouse_employment_length` varchar(10) DEFAULT NULL,
  `spouse_employment_income` decimal(15,3) DEFAULT NULL,
  `spouse_last_employment` varchar(50) DEFAULT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_client_spouse`
--

INSERT INTO `tbl_client_spouse` (`spouse_id`, `client_id`, `spouse_name`, `spouse_residence`, `spouse_res_cert_no`, `spouse_res_cert_issued_at`, `spouse_res_cert_date`, `spouse_employer`, `spouse_employer_address`, `spouse_employer_contact`, `spouse_employment_status`, `spouse_employment_position`, `spouse_employment_length`, `spouse_employment_income`, `spouse_last_employment`, `date_added`, `date_last_modified`) VALUES
(1, 8, 'Roel dfgdf', 'asdasd', 'asdas', 'dasdasd', '2023-06-16', 'asdasd', 'asdasd', 'asdasdasd', 'dasdasd', NULL, 'asdasd', '0.000', 'asdasd', '2023-06-16 10:09:21', '2023-06-16 10:09:44'),
(2, 9, 'asdas', 'dasdasd', 'asdasd', 'asdasd', '2023-06-16', 'asdas', 'dasd', 'asdsd', 'asdasd', NULL, 'asdas', '0.000', 'dasd', '2023-06-16 10:24:13', '2023-06-16 10:24:13'),
(3, 10, 'Mary Grace11', 'Saydoquis11', '1231', 'Bacoldo1', '2023-06-16', 'BPFC11', 'Bacolod1', '1231', 'Regular1', '11', '51', '1000.000', 'NA1', '2023-06-16 11:11:40', '2023-06-19 09:42:10'),
(13, 20, 'Meralyn Carton', 'Bago City', '2', 'Bago', '0000-00-00', 'BPFC', 'BC', '123546', 'Regular', 'Office Staff', '4', '10000.000', '', '2023-06-19 11:29:39', '2023-06-19 11:29:39'),
(14, 21, '', '', '', '', '0000-00-00', '', '', '', '', '', '', '0.000', '', '2023-06-19 11:29:39', '2023-06-19 11:29:39'),
(15, 22, '', '', '', '', '0000-00-00', '', '', '', '', '', '', '0.000', '', '2023-06-19 13:37:33', '2023-06-19 13:37:33');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_client_types`
--

CREATE TABLE `tbl_client_types` (
  `client_type_id` int(11) NOT NULL,
  `client_type` varchar(50) NOT NULL,
  `remarks` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_client_types`
--

INSERT INTO `tbl_client_types` (`client_type_id`, `client_type`, `remarks`, `user_id`, `date_added`, `date_last_modified`) VALUES
(1, 'Pension', '', 1, '2023-06-15 09:04:44', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_collections`
--

CREATE TABLE `tbl_collections` (
  `collection_id` int(11) NOT NULL,
  `reference_number` varchar(30) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `loan_id` int(11) DEFAULT NULL,
  `amount` decimal(12,3) DEFAULT NULL,
  `penalty_amount` decimal(12,3) DEFAULT NULL,
  `interest` decimal(12,3) DEFAULT NULL,
  `remarks` varchar(250) DEFAULT NULL,
  `collection_date` date NOT NULL,
  `atm_balance` decimal(12,3) NOT NULL,
  `atm_withdrawal` decimal(12,3) NOT NULL,
  `atm_charge` decimal(12,3) NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'F' COMMENT 'P - Pending ; F - Finished',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `chart_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_collections`
--

INSERT INTO `tbl_collections` (`collection_id`, `reference_number`, `branch_id`, `client_id`, `loan_id`, `amount`, `penalty_amount`, `interest`, `remarks`, `collection_date`, `atm_balance`, `atm_withdrawal`, `atm_charge`, `status`, `user_id`, `chart_id`, `date_added`, `date_last_modified`) VALUES
(13, 'CL-20230704103256', 1, 20, 13, '5000.000', '0.000', '1460.177', '', '2023-03-01', '23.000', '213.000', '213.000', 'F', 1, 4, '2023-07-04 16:33:34', '2023-07-04 16:33:34'),
(14, 'CL-20230704103409', 1, 20, 13, '5000.000', '0.000', '1460.177', '', '2023-04-01', '3213.000', '213.000', '213.000', 'F', 1, 4, '2023-07-04 16:34:40', '2023-07-04 16:34:40'),
(15, 'CL-20230705084408', 1, 20, 13, '5000.000', '0.000', '1460.177', '', '2023-05-04', '213.000', '213.000', '213.000', 'F', 1, 5, '2023-07-05 14:51:44', '2023-07-05 14:51:44'),
(16, 'CL-20230705085156', 1, 20, 13, '5000.000', '0.000', '1460.177', '', '2023-06-01', '213.000', '123.000', '12.000', 'F', 1, 5, '2023-07-05 14:52:20', '2023-07-05 14:52:20'),
(17, 'CL-20230705085223', 1, 20, 13, '5000.000', '0.000', '1460.177', '', '2023-07-05', '123.000', '3123.000', '213.000', 'F', 1, 5, '2023-07-05 14:52:55', '2023-07-05 14:52:55'),
(18, 'CL-20230705085257', 1, 20, 13, '4400.000', '0.000', '1284.956', '', '2023-08-05', '23.000', '23.000', '123.000', 'F', 1, 4, '2023-07-05 14:53:30', '2023-07-05 14:53:30'),
(19, 'CL-20230705085332', 1, 20, 13, '4900.000', '18.000', '1430.973', '234', '2023-09-07', '324.000', '24.000', '234.000', 'F', 1, 5, '2023-07-05 14:57:11', '2023-07-05 14:57:11');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comakers`
--

CREATE TABLE `tbl_comakers` (
  `comaker_id` int(11) NOT NULL,
  `loan_id` int(11) DEFAULT '0',
  `comaker_name` varchar(150) DEFAULT NULL,
  `comaker_res_cert_no` varchar(50) DEFAULT NULL,
  `comaker_res_cert_issued_at` varchar(50) DEFAULT NULL,
  `comaker_res_cert_date` date DEFAULT NULL,
  `comaker_employer` varchar(50) DEFAULT NULL,
  `comaker_employer_address` varchar(250) DEFAULT NULL,
  `comaker_employer_tel_no` varchar(15) DEFAULT NULL,
  `comaker_employer_position` varchar(50) DEFAULT NULL,
  `comaker_employer_salary` decimal(12,3) DEFAULT NULL,
  `comaker_employer_length` int(3) DEFAULT NULL,
  `comaker_employer_spouse` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employers`
--

CREATE TABLE `tbl_employers` (
  `employer_id` int(11) NOT NULL,
  `employer_name` varchar(150) DEFAULT NULL,
  `employer_address` varchar(255) DEFAULT NULL,
  `employer_contact_no` varchar(50) DEFAULT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_employers`
--

INSERT INTO `tbl_employers` (`employer_id`, `employer_name`, `employer_address`, `employer_contact_no`, `date_added`, `date_last_modified`) VALUES
(1, 'CHMSC - Alijis', 'Alijis', '09096836075', '2023-06-15 16:35:11', '2023-06-15 16:41:21'),
(3, 'saasd', 'a', 'asdas', '2023-06-15 16:37:05', '2023-06-15 16:41:12');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_expenses`
--

CREATE TABLE `tbl_expenses` (
  `expense_id` int(11) NOT NULL,
  `reference_number` varchar(50) NOT NULL,
  `expense_date` date NOT NULL,
  `remarks` varchar(250) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `journal_id` int(11) NOT NULL,
  `status` varchar(1) NOT NULL,
  `user_id` int(11) NOT NULL,
  `credit_method` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_expenses`
--

INSERT INTO `tbl_expenses` (`expense_id`, `reference_number`, `expense_date`, `remarks`, `date_added`, `date_last_modified`, `journal_id`, `status`, `user_id`, `credit_method`, `branch_id`) VALUES
(1, 'EXP-20230601000001', '2023-06-01', 'For test purposes only', '2023-06-14 15:45:15', '2023-06-14 15:45:15', 3, 'F', 1, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_expense_category`
--

CREATE TABLE `tbl_expense_category` (
  `expense_category_id` int(11) NOT NULL,
  `expense_category` varchar(50) NOT NULL,
  `remarks` varchar(250) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_expense_category`
--

INSERT INTO `tbl_expense_category` (`expense_category_id`, `expense_category`, `remarks`, `date_added`, `date_last_modified`) VALUES
(2, 'Operating Expenses', '', '2023-05-23 21:45:06', '2023-05-23 21:45:06'),
(3, 'Non-operating Expenses', '', '2023-05-24 09:45:12', '2023-05-24 09:45:12');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_expense_details`
--

CREATE TABLE `tbl_expense_details` (
  `expense_detail_id` int(11) NOT NULL,
  `expense_id` int(11) NOT NULL,
  `chart_id` int(11) NOT NULL,
  `expense_category_id` int(11) NOT NULL,
  `expense_amount` decimal(12,3) NOT NULL,
  `expense_desc` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_expense_details`
--

INSERT INTO `tbl_expense_details` (`expense_detail_id`, `expense_id`, `chart_id`, `expense_category_id`, `expense_amount`, `expense_desc`) VALUES
(1, 1, 12, 0, '1975.750', 'Test Description'),
(2, 1, 12, 0, '1975.750', 'Test Description'),
(3, 1, 12, 0, '1975.750', 'Test Description'),
(4, 1, 12, 0, '1975.750', 'Test Description'),
(5, 1, 12, 0, '1975.750', 'Test Description'),
(6, 1, 12, 0, '1975.750', 'Test Description'),
(7, 1, 12, 0, '1975.750', 'Test Description');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_fixed_loan_interest`
--

CREATE TABLE `tbl_fixed_loan_interest` (
  `loan_interest_id` int(11) NOT NULL,
  `loan_type_id` int(11) NOT NULL,
  `loan_amount` decimal(12,2) NOT NULL,
  `interest_amount` decimal(12,2) NOT NULL,
  `interest_terms` int(4) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_last_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_insurance`
--

CREATE TABLE `tbl_insurance` (
  `insurance_id` int(11) NOT NULL,
  `insurance_name` varchar(50) NOT NULL,
  `insurance_desc` varchar(250) NOT NULL,
  `insurance_amount` decimal(12,3) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_insurance`
--

INSERT INTO `tbl_insurance` (`insurance_id`, `insurance_name`, `insurance_desc`, `insurance_amount`, `date_added`, `date_last_modified`) VALUES
(1, 'Insurance 1', 'ABC', '1000.000', '2023-06-09 14:35:51', '2023-06-09 14:35:51'),
(2, 'Insurance 2', 'CDE', '1010.000', '2023-06-09 14:35:51', '2023-06-09 14:35:51'),
(3, 'Insurance 3', 'ABC', '1020.000', '2023-06-09 14:35:51', '2023-06-09 14:35:51'),
(4, 'Insurance 4', 'CDE', '1030.000', '2023-06-09 14:35:51', '2023-06-09 14:35:51'),
(5, 'Insurance 5', 'ABC', '1040.000', '2023-06-09 14:35:51', '2023-06-09 14:35:51'),
(6, 'Insurance 6', 'CDE', '1050.000', '2023-06-09 14:35:51', '2023-06-09 14:35:51'),
(7, 'Insurance 7', 'ABC', '1060.000', '2023-06-09 14:35:51', '2023-06-09 14:35:51'),
(8, 'Insurance 8', 'CDE', '1070.000', '2023-06-09 14:35:51', '2023-06-09 14:35:51'),
(9, 'Insurance 9', 'ABC', '1080.000', '2023-06-09 14:35:51', '2023-06-09 14:35:51'),
(10, 'Insurance 10', 'CDE', '1090.000', '2023-06-09 14:35:51', '2023-06-09 14:35:51'),
(11, 'Insurance 11', 'ABC', '1100.000', '2023-06-09 14:35:51', '2023-06-09 14:35:51'),
(12, 'Insurance 12', 'CDE', '1110.000', '2023-06-09 14:35:51', '2023-06-09 14:35:51'),
(13, 'Insurance 13', 'ABC', '1120.000', '2023-06-09 14:35:51', '2023-06-09 14:35:51'),
(14, 'Insurance 14', 'CDE', '1130.000', '2023-06-09 14:35:51', '2023-06-09 14:35:51'),
(15, 'Insurance 15', 'ABC', '1140.000', '2023-06-09 14:35:51', '2023-06-09 14:35:51'),
(16, 'Insurance 16', 'CDE', '1150.000', '2023-06-09 14:35:51', '2023-06-09 14:35:51'),
(17, 'Insurance 17', 'ABC', '1160.000', '2023-06-09 14:35:51', '2023-06-09 14:35:51'),
(18, 'Insurance 18', 'CDE', '1170.000', '2023-06-09 14:35:51', '2023-06-09 14:35:51'),
(19, 'Insurance 19', 'ABC', '1180.000', '2023-06-09 14:35:51', '2023-06-09 14:35:51'),
(20, 'Insurance 20', 'CDE', '1190.000', '2023-06-09 14:35:51', '2023-06-09 14:35:51'),
(21, 'Insurance 21', 'ABC', '1200.000', '2023-06-09 14:35:51', '2023-06-09 14:35:51'),
(22, 'Insurance 22', 'CDE', '1210.000', '2023-06-09 14:35:51', '2023-06-09 14:35:51'),
(23, 'Insurance 23', 'ABC', '1220.000', '2023-06-09 14:35:51', '2023-06-09 14:35:51'),
(24, 'Insurance 24', 'CDE', '1230.000', '2023-06-09 14:35:51', '2023-06-09 14:35:51'),
(25, 'Insurance 25', 'ABC', '1240.000', '2023-06-09 14:35:51', '2023-06-09 14:35:51'),
(26, 'Insurance 26', 'CDE', '1250.000', '2023-06-09 14:35:51', '2023-06-09 14:35:51'),
(27, 'Insurance 27', 'ABC', '1260.000', '2023-06-09 14:35:51', '2023-06-09 14:35:51'),
(28, 'Insurance 28', 'CDE', '1270.000', '2023-06-09 14:35:51', '2023-06-09 14:35:51'),
(29, 'Insurance 29', 'ABC', '1280.000', '2023-06-09 14:35:51', '2023-06-09 14:35:51'),
(30, 'Insurance 30', 'CDE', '1290.000', '2023-06-09 14:35:51', '2023-06-09 14:35:51');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_journals`
--

CREATE TABLE `tbl_journals` (
  `journal_id` int(11) NOT NULL,
  `journal_name` varchar(50) NOT NULL,
  `journal_code` varchar(10) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_journals`
--

INSERT INTO `tbl_journals` (`journal_id`, `journal_name`, `journal_code`, `date_added`, `date_last_modified`) VALUES
(3, 'Beginning Balance', 'BBJ', '2023-05-02 13:37:29', '2023-05-12 08:33:00'),
(4, 'Collection Receipts Journal', 'CRJ', '2023-05-02 13:37:48', '2023-05-02 13:37:48'),
(5, 'Credit Card Journal', 'CCJ', '2023-05-02 13:38:04', '2023-05-02 13:38:04'),
(6, 'Deposit Journal', 'DJ', '2023-05-02 13:38:15', '2023-05-02 13:38:15'),
(7, 'Cash/Check Disbursement Journal', 'CDJ', '2023-05-02 13:38:30', '2023-05-02 13:38:30');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_journal_entries`
--

CREATE TABLE `tbl_journal_entries` (
  `journal_entry_id` int(11) NOT NULL,
  `reference_number` varchar(50) DEFAULT NULL,
  `cross_reference` varchar(50) DEFAULT NULL,
  `journal_id` int(11) DEFAULT NULL,
  `remarks` varchar(250) DEFAULT NULL,
  `journal_date` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` varchar(1) DEFAULT 'S',
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_manual` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_journal_entries`
--

INSERT INTO `tbl_journal_entries` (`journal_entry_id`, `reference_number`, `cross_reference`, `journal_id`, `remarks`, `journal_date`, `user_id`, `status`, `date_added`, `date_last_modified`, `is_manual`) VALUES
(1, 'CRJ-20230615040611', 'CL-202306151', 4, '', '2023-06-15', 1, 'F', '2023-06-15 10:06:11', '2023-06-15 10:06:11', 'N'),
(2, 'CRJ-20230619054717', 'CL-202306192', 4, '', '2023-06-19', 1, 'F', '2023-06-19 11:47:17', '2023-06-19 11:47:17', 'N'),
(3, 'CRJ-20230619080642', 'CL-20230619080629', 4, '', '2023-06-19', 1, 'F', '2023-06-19 14:06:42', '2023-06-19 14:06:42', 'N'),
(4, 'CRJ-20230619084432', 'CL-20230619084413', 4, '', '2023-06-19', 1, 'F', '2023-06-19 14:44:32', '2023-06-19 14:44:32', 'N'),
(5, 'CRJ-20230619091340', 'CL-20230619091326', 4, '24', '2023-06-19', 1, 'F', '2023-06-19 15:13:40', '2023-06-19 15:13:40', 'N'),
(7, 'CDJ-20230619093058', 'CCV-20230619093003', 7, 'Reverse Entry for Cancelled Voucher (CV-20230619093003).', '2023-06-19', 1, 'F', '2023-06-19 15:30:58', '2023-06-19 15:30:58', 'N'),
(8, 'DJ-20230626101500', '123', 6, '', '2023-06-26', 1, 'S', '2023-06-26 16:15:08', '2023-06-26 16:15:08', 'Y'),
(9, 'CRJ-20230628083105', 'CL-20230628083043', 4, '', '2023-06-28', 1, 'F', '2023-06-28 14:31:05', '2023-06-28 14:31:05', 'N'),
(10, 'CRJ-20230628092443', 'CL-20230628092443', 4, 'Renew loan (Loan ID: LN-20230628092436', '2023-06-19', 1, 'F', '2023-06-28 15:24:43', '2023-06-28 15:24:43', 'N'),
(12, 'CRJ-20230701091511', 'CL-20230701091511', 4, 'Renew loan (Loan ID: LN-20230701091459', '2023-06-19', 1, 'F', '2023-07-01 15:15:11', '2023-07-01 15:15:11', 'N'),
(14, 'CRJ-20230701095407', 'CL-20230701095407', 4, 'Renew loan (Loan ID: LN-20230701095255', '2023-06-29', 1, 'F', '2023-07-01 15:54:07', '2023-07-01 15:54:07', 'N'),
(15, 'CRJ-20230701095409', 'CL-20230701095409', 4, 'Renew loan (Loan ID: LN-20230701095255', '2023-06-29', 1, 'F', '2023-07-01 15:54:09', '2023-07-01 15:54:09', 'N'),
(17, 'CRJ-20230703055528', 'CL-20230703055528', 4, 'Renew loan (Loan ID: LN-20230703055506', '2023-07-03', 1, 'F', '2023-07-03 11:55:28', '2023-07-03 11:55:28', 'N'),
(19, 'CRJ-20230703080243', 'CL-20230703080243', 4, 'Renew loan (Loan ID: LN-20230703080205', '2023-07-03', 1, 'F', '2023-07-03 14:02:43', '2023-07-03 14:02:43', 'N'),
(20, 'CDJ-20230704033506', 'CV-20230704033449', 7, '123', '2023-07-04', 1, 'F', '2023-07-04 09:35:06', '2023-07-04 09:35:40', 'N'),
(21, 'CDJ-20230704103144', 'CV-20230704103125', 7, 'sadsd', '2023-03-08', 1, 'F', '2023-07-04 16:31:44', '2023-07-04 16:31:59', 'N'),
(22, 'CRJ-20230704103334', 'CL-20230704103256', 4, '', '2023-03-01', 1, 'F', '2023-07-04 16:33:34', '2023-07-04 16:33:34', 'N'),
(23, 'CRJ-20230704103440', 'CL-20230704103409', 4, '', '2023-04-01', 1, 'F', '2023-07-04 16:34:40', '2023-07-04 16:34:40', 'N'),
(24, 'CRJ-20230705085144', 'CL-20230705084408', 4, '', '2023-05-04', 1, 'F', '2023-07-05 14:51:44', '2023-07-05 14:51:44', 'N'),
(25, 'CRJ-20230705085220', 'CL-20230705085156', 4, '', '2023-06-01', 1, 'F', '2023-07-05 14:52:20', '2023-07-05 14:52:20', 'N'),
(26, 'CRJ-20230705085255', 'CL-20230705085223', 4, '', '2023-07-05', 1, 'F', '2023-07-05 14:52:55', '2023-07-05 14:52:55', 'N'),
(27, 'CRJ-20230705085330', 'CL-20230705085257', 4, '', '2023-08-05', 1, 'F', '2023-07-05 14:53:30', '2023-07-05 14:53:30', 'N'),
(28, 'CRJ-20230705085711', 'CL-20230705085332', 4, '234', '2023-09-07', 1, 'F', '2023-07-05 14:57:11', '2023-07-05 14:57:11', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_journal_entry_details`
--

CREATE TABLE `tbl_journal_entry_details` (
  `journal_entry_detail_id` int(11) NOT NULL,
  `journal_entry_id` int(11) NOT NULL DEFAULT '0',
  `chart_id` int(11) NOT NULL DEFAULT '0',
  `description` varchar(250) NOT NULL,
  `debit` decimal(12,3) NOT NULL DEFAULT '0.000',
  `credit` decimal(12,3) NOT NULL DEFAULT '0.000'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_journal_entry_details`
--

INSERT INTO `tbl_journal_entry_details` (`journal_entry_detail_id`, `journal_entry_id`, `chart_id`, `description`, `debit`, `credit`) VALUES
(1, 1, 5, '', '838.000', '0.000'),
(2, 1, 38, '', '0.000', '212.627'),
(3, 1, 17, '', '0.000', '625.373'),
(4, 2, 4, '', '838.000', '0.000'),
(5, 2, 38, '', '0.000', '212.627'),
(6, 2, 17, '', '0.000', '625.373'),
(7, 3, 4, '', '24.000', '0.000'),
(8, 3, 38, '', '0.000', '6.090'),
(9, 3, 17, '', '0.000', '17.910'),
(10, 4, 4, '', '243.000', '0.000'),
(11, 4, 38, '', '0.000', '61.657'),
(12, 4, 17, '', '0.000', '181.343'),
(13, 5, 4, '', '242.000', '0.000'),
(14, 5, 38, '', '0.000', '61.403'),
(15, 5, 17, '', '0.000', '180.597'),
(17, 6, 1, '', '234.000', '0.000'),
(18, 6, 5, '', '0.000', '234.000'),
(19, 7, 1, ' (Reverse Entry)', '0.000', '234.000'),
(20, 7, 5, ' (Reverse Entry)', '234.000', '0.000'),
(21, 8, 7, '', '1000.000', '0.000'),
(22, 9, 5, '', '485.000', '0.000'),
(23, 9, 38, '', '0.000', '123.060'),
(24, 9, 17, '', '0.000', '361.940'),
(25, 10, 5, '', '19130.000', '0.000'),
(26, 10, 38, '', '0.000', '4853.881'),
(27, 10, 17, '', '0.000', '14276.119'),
(28, 11, 1, '', '234.000', '0.000'),
(29, 11, 5, '', '0.000', '234.000'),
(30, 12, 4, '', '20100.000', '0.000'),
(31, 12, 38, '', '0.000', '5100.000'),
(32, 12, 17, '', '0.000', '15000.000'),
(33, 13, 1, '', '324.000', '0.000'),
(34, 13, 5, '', '0.000', '324.000'),
(35, 14, 5, '', '115.000', '0.000'),
(36, 14, 38, '', '0.000', '15.000'),
(37, 14, 14, '', '0.000', '100.000'),
(38, 15, 5, '', '115.000', '0.000'),
(39, 15, 38, '', '0.000', '15.000'),
(40, 15, 14, '', '0.000', '100.000'),
(41, 16, 1, '', '23000.000', '0.000'),
(42, 16, 6, '', '0.000', '23000.000'),
(43, 17, 4, '', '28320.000', '0.000'),
(44, 17, 38, '', '0.000', '4320.000'),
(45, 17, 14, '', '0.000', '24000.000'),
(46, 18, 1, '', '2500.000', '0.000'),
(47, 18, 5, '', '0.000', '2500.000'),
(48, 19, 5, '', '0.000', '0.000'),
(49, 19, 38, '', '0.000', '0.000'),
(50, 19, 14, '', '0.000', '0.000'),
(52, 20, 5, '', '0.000', '213.000'),
(53, 20, 1, '', '213.000', '0.000'),
(54, 21, 1, '', '205000.000', '0.000'),
(55, 21, 5, '', '0.000', '205000.000'),
(56, 22, 4, '', '5000.000', '0.000'),
(57, 22, 38, '', '0.000', '1460.177'),
(58, 22, 17, '', '0.000', '3539.823'),
(59, 23, 4, '', '5000.000', '0.000'),
(60, 23, 38, '', '0.000', '1460.177'),
(61, 23, 17, '', '0.000', '3539.823'),
(62, 24, 5, '', '5000.000', '0.000'),
(63, 24, 38, '', '0.000', '1460.177'),
(64, 24, 17, '', '0.000', '3539.823'),
(65, 25, 5, '', '5000.000', '0.000'),
(66, 25, 38, '', '0.000', '1460.177'),
(67, 25, 17, '', '0.000', '3539.823'),
(68, 26, 5, '', '5000.000', '0.000'),
(69, 26, 38, '', '0.000', '1460.177'),
(70, 26, 17, '', '0.000', '3539.823'),
(71, 27, 4, '', '4400.000', '0.000'),
(72, 27, 38, '', '0.000', '1284.956'),
(73, 27, 17, '', '0.000', '3115.044'),
(74, 28, 5, '', '4918.000', '0.000'),
(75, 28, 38, '', '0.000', '1430.973'),
(76, 28, 40, '', '0.000', '18.000'),
(77, 28, 17, '', '0.000', '3469.027');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_loans`
--

CREATE TABLE `tbl_loans` (
  `loan_id` int(11) NOT NULL,
  `reference_number` varchar(50) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL DEFAULT '0',
  `loan_type_id` int(11) NOT NULL DEFAULT '0',
  `loan_amount` decimal(12,3) NOT NULL DEFAULT '0.000',
  `loan_period` int(6) NOT NULL DEFAULT '0',
  `loan_interest` decimal(12,3) NOT NULL DEFAULT '0.000',
  `penalty_percentage` decimal(4,2) NOT NULL,
  `payment_terms` decimal(4,2) NOT NULL,
  `due_date` date NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'A' COMMENT 'P - Pending; A - Approved; R - Released; D - Denied; F- Fully paid',
  `renewal_status` varchar(1) NOT NULL DEFAULT 'N' COMMENT 'Y - Yes ; N - No',
  `loan_date` date NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `service_fee` decimal(12,3) NOT NULL,
  `monthly_payment` decimal(12,3) NOT NULL,
  `user_id` int(11) NOT NULL,
  `main_loan_id` int(11) NOT NULL,
  `deduct_to_loan` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_loans`
--

INSERT INTO `tbl_loans` (`loan_id`, `reference_number`, `branch_id`, `client_id`, `loan_type_id`, `loan_amount`, `loan_period`, `loan_interest`, `penalty_percentage`, `payment_terms`, `due_date`, `status`, `renewal_status`, `loan_date`, `date_added`, `date_last_modified`, `service_fee`, `monthly_payment`, `user_id`, `main_loan_id`, `deduct_to_loan`) VALUES
(13, 'LN-20230704102556', 1, 20, 2, '205000.000', 33, '15.000', '3.00', '1.00', '0000-00-00', 'R', 'N', '2023-02-01', '2023-07-04 16:27:16', '2023-07-05 14:43:13', '2000.000', '5000.000', 0, 0, 0),
(14, 'LN-20230705083658', 1, 22, 1, '25000.000', 12, '18.000', '3.00', '1.00', '0000-00-00', 'A', 'N', '2023-07-05', '2023-07-05 14:40:52', '2023-07-05 14:40:52', '2000.000', '2292.000', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_loan_types`
--

CREATE TABLE `tbl_loan_types` (
  `loan_type_id` int(11) NOT NULL,
  `loan_type` varchar(50) DEFAULT NULL,
  `loan_type_interest` decimal(5,2) NOT NULL,
  `penalty_percentage` decimal(5,2) NOT NULL,
  `remarks` varchar(250) DEFAULT NULL,
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_loan_types`
--

INSERT INTO `tbl_loan_types` (`loan_type_id`, `loan_type`, `loan_type_interest`, `penalty_percentage`, `remarks`, `date_added`, `date_last_modified`) VALUES
(1, 'PENSION LOAN', '18.00', '3.00', 'Diminishing', '2023-04-09 22:12:49', '2023-07-04 16:43:03'),
(2, 'SALARY LOAN', '17.00', '3.00', 'Diminishing', '2023-05-03 15:48:54', '2023-07-04 16:43:04'),
(3, 'SALARY-PRIVATE LOAN', '18.00', '3.00', 'Diminishing', '2023-05-07 18:14:27', '2023-07-04 16:43:05'),
(4, 'BONUS LOAN', '17.00', '3.00', 'Diminishing', '2023-05-07 18:30:50', '2023-07-04 16:43:06'),
(5, 'REAL ESTATE MORTGAGE LOAN', '17.00', '3.00', 'Diminishing', '2023-05-07 18:33:35', '2023-07-04 16:43:06'),
(6, 'CHATTEL MORTGAGE LOAN', '18.00', '3.00', 'Diminishing', '2023-05-07 18:33:49', '2023-07-04 16:43:07'),
(7, 'BUSINESS LOAN', '18.00', '3.00', 'Diminishing', '2023-05-07 18:34:08', '2023-07-04 16:43:08'),
(8, 'EMERGENCY LOAN', '18.00', '3.00', 'Advanced', '2023-05-07 18:34:20', '2023-07-04 16:43:09');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_property_owned`
--

CREATE TABLE `tbl_property_owned` (
  `property_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL DEFAULT '0',
  `property_location` varchar(250) NOT NULL,
  `property_area` varchar(250) NOT NULL,
  `property_acquisition_cost` decimal(12,3) NOT NULL DEFAULT '0.000',
  `property_pres_market_val` decimal(12,3) NOT NULL DEFAULT '0.000',
  `property_improvement` varchar(50) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_property_owned`
--

INSERT INTO `tbl_property_owned` (`property_id`, `client_id`, `property_location`, `property_area`, `property_acquisition_cost`, `property_pres_market_val`, `property_improvement`, `date_added`, `date_last_modified`) VALUES
(1, 10, 'Easthomes', '60', '610000.000', '1000000.000', '50000', '2023-06-09 10:41:15', '2023-06-09 10:41:15'),
(2, 13, 'Woodside 1', '100', '100.000', '100.000', '100', '2023-06-09 11:38:58', '2023-06-09 11:38:58');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_suppliers`
--

CREATE TABLE `tbl_suppliers` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(50) DEFAULT NULL,
  `supplier_address` varchar(250) DEFAULT NULL,
  `supplier_contact_no` varchar(15) DEFAULT NULL,
  `remarks` varchar(250) DEFAULT NULL,
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_suppliers`
--

INSERT INTO `tbl_suppliers` (`supplier_id`, `supplier_name`, `supplier_address`, `supplier_contact_no`, `remarks`, `date_added`, `date_last_modified`) VALUES
(1, 'Supplier 1', 'Bacolod', '9123400001', 'Regular', '2023-06-09 15:12:49', '2023-06-09 15:12:49'),
(2, 'Supplier 2', 'Sagay', '9123400002', 'Regular', '2023-06-09 15:12:49', '2023-06-09 15:12:49'),
(3, 'Supplier 3', 'Pulupandan', '9123400003', 'Regular', '2023-06-09 15:12:49', '2023-06-09 15:12:49'),
(4, 'Supplier 4', 'Bago', '9123400004', 'Regular', '2023-06-09 15:12:49', '2023-06-09 15:12:49'),
(5, 'Supplier 5', 'Bacolod', '9123400005', 'Regular', '2023-06-09 15:12:49', '2023-06-09 15:12:49'),
(6, 'Supplier 6', 'Sagay', '9123400006', 'Regular', '2023-06-09 15:12:49', '2023-06-09 15:12:49'),
(7, 'Supplier 7', 'Pulupandan', '9123400007', 'Regular', '2023-06-09 15:12:49', '2023-06-09 15:12:49'),
(8, 'Supplier 8', 'Bago', '9123400008', 'Regular', '2023-06-09 15:12:49', '2023-06-09 15:12:49'),
(9, 'Supplier 9', 'Bacolod', '9123400009', 'Regular', '2023-06-09 15:12:49', '2023-06-09 15:12:49'),
(10, 'Supplier 10', 'Sagay', '9123400010', 'Regular', '2023-06-09 15:12:49', '2023-06-09 15:12:49'),
(11, 'Supplier 11', 'Pulupandan', '9123400011', 'Regular', '2023-06-09 15:12:49', '2023-06-09 15:12:49'),
(12, 'Supplier 12', 'Bago', '9123400012', 'Regular', '2023-06-09 15:12:49', '2023-06-09 15:12:49'),
(13, 'Supplier 13', 'Bacolod', '9123400013', 'Regular', '2023-06-09 15:12:49', '2023-06-09 15:12:49'),
(14, 'Supplier 14', 'Sagay', '9123400014', 'Regular', '2023-06-09 15:12:49', '2023-06-09 15:12:49'),
(15, 'Supplier 15', 'Pulupandan', '9123400015', 'Regular', '2023-06-09 15:12:49', '2023-06-09 15:12:49'),
(16, 'Supplier 16', 'Bago', '9123400016', 'Regular', '2023-06-09 15:12:49', '2023-06-09 15:12:49'),
(17, 'Supplier 17', 'Bacolod', '9123400017', 'Regular', '2023-06-09 15:12:49', '2023-06-09 15:12:49'),
(18, 'Supplier 18', 'Sagay', '9123400018', 'Regular', '2023-06-09 15:12:49', '2023-06-09 15:12:49'),
(19, 'Supplier 19', 'Pulupandan', '9123400019', 'Regular', '2023-06-09 15:12:49', '2023-06-09 15:12:49'),
(20, 'Supplier 20', 'Bago', '9123400020', 'Regular', '2023-06-09 15:12:49', '2023-06-09 15:12:49'),
(21, 'Supplier 21', 'Bacolod', '9123400021', 'Regular', '2023-06-09 15:12:49', '2023-06-09 15:12:49'),
(22, 'Supplier 22', 'Sagay', '9123400022', 'Regular', '2023-06-09 15:12:49', '2023-06-09 15:12:49'),
(23, 'Supplier 23', 'Pulupandan', '9123400023', 'Regular', '2023-06-09 15:12:49', '2023-06-09 15:12:49'),
(24, 'Supplier 24', 'Bago', '9123400024', 'Regular', '2023-06-09 15:12:49', '2023-06-09 15:12:49'),
(25, 'Supplier 25', 'Bacolod', '9123400025', 'Regular', '2023-06-09 15:12:49', '2023-06-09 15:12:49'),
(26, 'Supplier 26', 'Sagay', '9123400026', 'Regular', '2023-06-09 15:12:49', '2023-06-09 15:12:49'),
(27, 'Supplier 27', 'Pulupandan', '9123400027', 'Regular', '2023-06-09 15:12:49', '2023-06-09 15:12:49'),
(28, 'Supplier 28', 'Bago', '9123400028', 'Regular', '2023-06-09 15:12:49', '2023-06-09 15:12:49'),
(29, 'Supplier 29', 'Bacolod', '9123400029', 'Regular', '2023-06-09 15:12:49', '2023-06-09 15:12:49'),
(30, 'Supplier 30', 'Sagay', '9123400030', 'Regular', '2023-06-09 15:12:49', '2023-06-09 15:12:49'),
(31, 'Supplier 31', 'Pulupandan', '9123400031', 'Regular', '2023-06-09 15:12:49', '2023-06-09 15:12:49'),
(32, 'Supplier 32', 'Bago', '9123400032', 'Regular', '2023-06-09 15:12:49', '2023-06-09 15:12:49'),
(33, 'Supplier 33', 'Bacolod', '9123400033', 'Regular', '2023-06-09 15:12:49', '2023-06-09 15:12:49'),
(34, 'Supplier 34', 'Sagay', '9123400034', 'Regular', '2023-06-09 15:12:49', '2023-06-09 15:12:49'),
(35, 'Supplier 35', 'Pulupandan', '9123400035', 'Regular', '2023-06-09 15:12:49', '2023-06-09 15:12:49'),
(36, 'Supplier 36', 'Bago', '9123400036', 'Regular', '2023-06-09 15:12:49', '2023-06-09 15:12:49'),
(37, 'Supplier 37', 'Bacolod', '9123400037', 'Regular', '2023-06-09 15:12:49', '2023-06-09 15:12:49'),
(38, 'Supplier 38', 'Sagay', '9123400038', 'Regular', '2023-06-09 15:12:49', '2023-06-09 15:12:49'),
(39, 'Supplier 39', 'Pulupandan', '9123400039', 'Regular', '2023-06-09 15:12:49', '2023-06-09 15:12:49'),
(40, 'Supplier 40', 'Bago', '9123400040', 'Regular', '2023-06-09 15:12:49', '2023-06-09 15:12:49'),
(41, 'Supplier 41', 'Bacolod', '9123400041', 'Regular', '2023-06-09 15:12:49', '2023-06-09 15:12:49'),
(42, 'Supplier 42', 'Sagay', '9123400042', 'Regular', '2023-06-09 15:12:49', '2023-06-09 15:12:49'),
(43, 'Supplier 43', 'Pulupandan', '9123400043', 'Regular', '2023-06-09 15:12:49', '2023-06-09 15:12:49'),
(44, 'Supplier 44', 'Bago', '9123400044', 'Regular', '2023-06-09 15:12:49', '2023-06-09 15:12:49'),
(45, 'Supplier 45', 'Bacolod', '9123400045', 'Regular', '2023-06-09 15:12:50', '2023-06-09 15:12:50'),
(46, 'Supplier 46', 'Sagay', '9123400046', 'Regular', '2023-06-09 15:12:50', '2023-06-09 15:12:50'),
(47, 'Supplier 47', 'Pulupandan', '9123400047', 'Regular', '2023-06-09 15:12:50', '2023-06-09 15:12:50'),
(48, 'Supplier 48', 'Bago', '9123400048', 'Regular', '2023-06-09 15:12:50', '2023-06-09 15:12:50'),
(49, 'Supplier 49', 'Bacolod', '9123400049', 'Regular', '2023-06-09 15:12:50', '2023-06-09 15:12:50'),
(50, 'Supplier 50', 'Sagay', '9123400050', 'Regular', '2023-06-09 15:12:50', '2023-06-09 15:12:50'),
(51, 'Supplier 51', 'Pulupandan', '9123400051', 'Regular', '2023-06-09 15:12:50', '2023-06-09 15:12:50'),
(52, 'Supplier 52', 'Bago', '9123400052', 'Regular', '2023-06-09 15:12:50', '2023-06-09 15:12:50'),
(53, 'Supplier 53', 'Bacolod', '9123400053', 'Regular', '2023-06-09 15:12:50', '2023-06-09 15:12:50'),
(54, 'Supplier 54', 'Sagay', '9123400054', 'Regular', '2023-06-09 15:12:50', '2023-06-09 15:12:50'),
(55, 'Supplier 55', 'Pulupandan', '9123400055', 'Regular', '2023-06-09 15:12:50', '2023-06-09 15:12:50'),
(56, 'Supplier 56', 'Bago', '9123400056', 'Regular', '2023-06-09 15:12:50', '2023-06-09 15:12:50'),
(57, 'Supplier 57', 'Bacolod', '9123400057', 'Regular', '2023-06-09 15:12:50', '2023-06-09 15:12:50'),
(58, 'Supplier 58', 'Sagay', '9123400058', 'Regular', '2023-06-09 15:12:50', '2023-06-09 15:12:50'),
(59, 'Supplier 59', 'Pulupandan', '9123400059', 'Regular', '2023-06-09 15:12:50', '2023-06-09 15:12:50'),
(60, 'Supplier 60', 'Bago', '9123400060', 'Regular', '2023-06-09 15:12:50', '2023-06-09 15:12:50'),
(61, 'Supplier 61', 'Bacolod', '9123400061', 'Regular', '2023-06-09 15:12:50', '2023-06-09 15:12:50'),
(62, 'Supplier 62', 'Sagay', '9123400062', 'Regular', '2023-06-09 15:12:50', '2023-06-09 15:12:50'),
(63, 'Supplier 63', 'Pulupandan', '9123400063', 'Regular', '2023-06-09 15:12:50', '2023-06-09 15:12:50'),
(64, 'Supplier 64', 'Bago', '9123400064', 'Regular', '2023-06-09 15:12:50', '2023-06-09 15:12:50'),
(65, 'Supplier 65', 'Bacolod', '9123400065', 'Regular', '2023-06-09 15:12:50', '2023-06-09 15:12:50'),
(66, 'Supplier 66', 'Sagay', '9123400066', 'Regular', '2023-06-09 15:12:50', '2023-06-09 15:12:50'),
(67, 'Supplier 67', 'Pulupandan', '9123400067', 'Regular', '2023-06-09 15:12:50', '2023-06-09 15:12:50'),
(68, 'Supplier 68', 'Bago', '9123400068', 'Regular', '2023-06-09 15:12:50', '2023-06-09 15:12:50'),
(69, 'Supplier 69', 'Bacolod', '9123400069', 'Regular', '2023-06-09 15:12:50', '2023-06-09 15:12:50'),
(70, 'Supplier 70', 'Sagay', '9123400070', 'Regular', '2023-06-09 15:12:50', '2023-06-09 15:12:50'),
(71, 'Supplier 71', 'Pulupandan', '9123400071', 'Regular', '2023-06-09 15:12:50', '2023-06-09 15:12:50'),
(72, 'Supplier 72', 'Bago', '9123400072', 'Regular', '2023-06-09 15:12:50', '2023-06-09 15:12:50'),
(73, 'Supplier 73', 'Bacolod', '9123400073', 'Regular', '2023-06-09 15:12:50', '2023-06-09 15:12:50'),
(74, 'Supplier 74', 'Sagay', '9123400074', 'Regular', '2023-06-09 15:12:50', '2023-06-09 15:12:50'),
(75, 'Supplier 75', 'Pulupandan', '9123400075', 'Regular', '2023-06-09 15:12:50', '2023-06-09 15:12:50'),
(76, 'Supplier 76', 'Bago', '9123400076', 'Regular', '2023-06-09 15:12:50', '2023-06-09 15:12:50'),
(77, 'Supplier 77', 'Bacolod', '9123400077', 'Regular', '2023-06-09 15:12:50', '2023-06-09 15:12:50'),
(78, 'Supplier 78', 'Sagay', '9123400078', 'Regular', '2023-06-09 15:12:50', '2023-06-09 15:12:50'),
(79, 'Supplier 79', 'Pulupandan', '9123400079', 'Regular', '2023-06-09 15:12:50', '2023-06-09 15:12:50'),
(80, 'Supplier 80', 'Bago', '9123400080', 'Regular', '2023-06-09 15:12:50', '2023-06-09 15:12:50'),
(81, 'Supplier 81', 'Bacolod', '9123400081', 'Regular', '2023-06-09 15:12:50', '2023-06-09 15:12:50'),
(82, 'Supplier 82', 'Sagay', '9123400082', 'Regular', '2023-06-09 15:12:50', '2023-06-09 15:12:50'),
(83, 'Supplier 83', 'Pulupandan', '9123400083', 'Regular', '2023-06-09 15:12:50', '2023-06-09 15:12:50'),
(84, 'Supplier 84', 'Bago', '9123400084', 'Regular', '2023-06-09 15:12:50', '2023-06-09 15:12:50'),
(85, 'Supplier 85', 'Bacolod', '9123400085', 'Regular', '2023-06-09 15:12:50', '2023-06-09 15:12:50'),
(86, 'Supplier 86', 'Sagay', '9123400086', 'Regular', '2023-06-09 15:12:50', '2023-06-09 15:12:50'),
(87, 'Supplier 87', 'Pulupandan', '9123400087', 'Regular', '2023-06-09 15:12:50', '2023-06-09 15:12:50'),
(88, 'Supplier 88', 'Bago', '9123400088', 'Regular', '2023-06-09 15:12:50', '2023-06-09 15:12:50'),
(89, 'Supplier 89', 'Bacolod', '9123400089', 'Regular', '2023-06-09 15:12:50', '2023-06-09 15:12:50'),
(90, 'Supplier 90', 'Sagay', '9123400090', 'Regular', '2023-06-09 15:12:50', '2023-06-09 15:12:50'),
(91, 'Supplier 91', 'Pulupandan', '9123400091', 'Regular', '2023-06-09 15:12:50', '2023-06-09 15:12:50'),
(92, 'Supplier 92', 'Bago', '9123400092', 'Regular', '2023-06-09 15:12:50', '2023-06-09 15:12:50'),
(93, 'Supplier 93', 'Bacolod', '9123400093', 'Regular', '2023-06-09 15:12:50', '2023-06-09 15:12:50'),
(94, 'Supplier 94', 'Sagay', '9123400094', 'Regular', '2023-06-09 15:12:50', '2023-06-09 15:12:50'),
(95, 'Supplier 95', 'Pulupandan', '9123400095', 'Regular', '2023-06-09 15:12:50', '2023-06-09 15:12:50'),
(96, 'Supplier 96', 'Bago', '9123400096', 'Regular', '2023-06-09 15:12:50', '2023-06-09 15:12:50'),
(97, 'Supplier 97', 'Bacolod', '9123400097', 'Regular', '2023-06-09 15:12:50', '2023-06-09 15:12:50'),
(98, 'Supplier 98', 'Sagay', '9123400098', 'Regular', '2023-06-09 15:12:50', '2023-06-09 15:12:50'),
(99, 'Supplier 99', 'Pulupandan', '9123400099', 'Regular', '2023-06-09 15:12:50', '2023-06-09 15:12:50'),
(100, 'Supplier 100', 'Bago', '9123400100', 'Regular', '2023-06-09 15:12:51', '2023-06-09 15:12:51');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL,
  `user_fname` varchar(50) NOT NULL,
  `user_mname` varchar(50) NOT NULL,
  `user_lname` varchar(50) NOT NULL,
  `user_category_id` int(11) NOT NULL,
  `user_category` varchar(1) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `user_fname`, `user_mname`, `user_lname`, `user_category_id`, `user_category`, `username`, `password`, `date_added`, `date_last_modified`) VALUES
(1, 'Juan', '', 'Dela Cruz', 1, 'A', 'admin', '0cc175b9c0f1b6a831c399e269772661', '2023-04-09 20:44:25', '2023-05-16 08:25:02'),
(2, 'd', 'k', 'k', 2, 'S', 's', '03c7c0ace395d80182db07ae2c30f034', '2023-04-10 10:14:42', '2023-05-16 08:25:10'),
(3, 'kaye', 'kaye', 'kaye', 3, '', 'a', '0cc175b9c0f1b6a831c399e269772661', '2023-05-16 09:00:48', '2023-05-16 09:00:48');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_categories`
--

CREATE TABLE `tbl_user_categories` (
  `user_category_id` int(11) NOT NULL,
  `user_category_name` varchar(50) NOT NULL,
  `remarks` varchar(250) NOT NULL,
  `is_preset` varchar(1) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user_categories`
--

INSERT INTO `tbl_user_categories` (`user_category_id`, `user_category_name`, `remarks`, `is_preset`, `date_added`, `date_last_modified`) VALUES
(1, 'Admin', '', 'Y', '2023-05-15 22:08:46', '2023-05-15 22:15:00'),
(2, 'Accounting Staff', '', '', '2023-05-15 22:01:23', '2023-05-15 22:01:23'),
(3, 'Encoder', '', '', '2023-05-16 08:50:52', '2023-05-16 08:50:52'),
(4, '4 3434', '', '', '2023-06-20 10:22:00', '2023-06-20 10:22:13');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_privileges`
--

CREATE TABLE `tbl_user_privileges` (
  `privilege_id` int(11) NOT NULL,
  `user_category_id` int(11) NOT NULL,
  `url` varchar(50) NOT NULL,
  `status` int(1) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user_privileges`
--

INSERT INTO `tbl_user_privileges` (`privilege_id`, `user_category_id`, `url`, `status`, `date_added`, `date_last_modified`) VALUES
(1, 2, 'suppliers', 1, '2023-05-15 20:34:01', '2023-05-16 09:32:20'),
(2, 2, 'vouchers', 1, '2023-05-15 20:34:01', '2023-05-16 09:32:20'),
(3, 2, 'sales-return', 1, '2023-05-15 20:34:01', '2023-05-16 09:32:20'),
(4, 2, 'clients', 1, '2023-05-15 20:55:18', '2023-05-16 09:32:20'),
(5, 2, 'product-price', 1, '2023-05-15 20:55:18', '2023-05-16 09:32:20'),
(6, 3, 'suppliers', 1, '2023-05-16 08:52:09', '2023-05-16 08:52:24'),
(7, 3, 'clients', 1, '2023-05-16 08:52:09', '2023-05-16 08:52:24'),
(8, 3, 'product-price', 1, '2023-05-16 08:52:09', '2023-05-16 08:52:24'),
(9, 3, 'loan-types', 1, '2023-05-16 08:52:09', '2023-05-16 08:52:24'),
(10, 3, 'vouchers', 1, '2023-05-16 08:52:21', '2023-05-16 08:52:24'),
(11, 3, 'sales-return', 1, '2023-05-16 08:52:21', '2023-05-16 08:52:24'),
(12, 3, 'statement-of-accounts', 1, '2023-05-16 08:52:24', '0000-00-00 00:00:00'),
(13, 2, 'loans', 1, '2023-05-16 09:32:20', '0000-00-00 00:00:00'),
(14, 2, 'chart-of-accounts', 1, '2023-05-16 09:32:20', '0000-00-00 00:00:00'),
(15, 2, 'journals', 1, '2023-05-16 09:32:20', '0000-00-00 00:00:00'),
(16, 2, 'journal-entry', 1, '2023-05-16 09:32:20', '0000-00-00 00:00:00'),
(17, 2, 'receivable-ledger', 1, '2023-05-16 09:32:20', '0000-00-00 00:00:00'),
(18, 2, 'loan-status-report', 1, '2023-05-16 09:32:20', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vouchers`
--

CREATE TABLE `tbl_vouchers` (
  `voucher_id` int(11) NOT NULL,
  `reference_number` varchar(50) NOT NULL,
  `account_type` varchar(1) NOT NULL,
  `account_id` int(11) NOT NULL DEFAULT '0',
  `voucher_no` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL,
  `check_number` varchar(30) NOT NULL,
  `ac_no` varchar(30) NOT NULL,
  `amount` decimal(12,3) NOT NULL DEFAULT '0.000',
  `voucher_date` date NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'S',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `journal_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `loan_id` int(11) NOT NULL,
  `approved_by` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_vouchers`
--

INSERT INTO `tbl_vouchers` (`voucher_id`, `reference_number`, `account_type`, `account_id`, `voucher_no`, `description`, `check_number`, `ac_no`, `amount`, `voucher_date`, `status`, `user_id`, `journal_id`, `date_added`, `date_last_modified`, `loan_id`, `approved_by`) VALUES
(6, 'CV-20230704033449', 'S', 1, '21312', '123', '123123', '213', '213.000', '2023-07-04', 'F', 1, 7, '2023-07-04 09:35:06', '2023-07-04 11:43:19', 0, 'sadas  das'),
(7, 'CV-20230704103125', 'C', 20, '0001', 'sadsd', '2423', '234', '205000.000', '2023-03-08', 'F', 1, 7, '2023-07-04 16:31:44', '2023-07-04 16:31:59', 13, '');

--
-- Triggers `tbl_vouchers`
--
DELIMITER $$
CREATE TRIGGER `delete_voucher` AFTER DELETE ON `tbl_vouchers` FOR EACH ROW DELETE FROM tbl_journal_entries WHERE cross_reference = OLD.reference_number AND is_manual !='Y'
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `finish_voucher` AFTER UPDATE ON `tbl_vouchers` FOR EACH ROW UPDATE tbl_journal_entries SET status = IF (NEW.status = 'F', 'F', 'S') WHERE cross_reference = NEW.reference_number AND old.status != 'F'
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_branches`
--
ALTER TABLE `tbl_branches`
  ADD PRIMARY KEY (`branch_id`);

--
-- Indexes for table `tbl_chart_classification`
--
ALTER TABLE `tbl_chart_classification`
  ADD PRIMARY KEY (`chart_class_id`);

--
-- Indexes for table `tbl_chart_of_accounts`
--
ALTER TABLE `tbl_chart_of_accounts`
  ADD PRIMARY KEY (`chart_id`);

--
-- Indexes for table `tbl_children`
--
ALTER TABLE `tbl_children`
  ADD PRIMARY KEY (`child_id`);

--
-- Indexes for table `tbl_clients`
--
ALTER TABLE `tbl_clients`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `tbl_client_atm`
--
ALTER TABLE `tbl_client_atm`
  ADD PRIMARY KEY (`atm_id`);

--
-- Indexes for table `tbl_client_business`
--
ALTER TABLE `tbl_client_business`
  ADD PRIMARY KEY (`business_id`);

--
-- Indexes for table `tbl_client_dependents`
--
ALTER TABLE `tbl_client_dependents`
  ADD PRIMARY KEY (`dependent_id`);

--
-- Indexes for table `tbl_client_employment`
--
ALTER TABLE `tbl_client_employment`
  ADD PRIMARY KEY (`employment_id`);

--
-- Indexes for table `tbl_client_insurance`
--
ALTER TABLE `tbl_client_insurance`
  ADD PRIMARY KEY (`client_insurance_id`);

--
-- Indexes for table `tbl_client_reference`
--
ALTER TABLE `tbl_client_reference`
  ADD PRIMARY KEY (`reference_id`);

--
-- Indexes for table `tbl_client_residence`
--
ALTER TABLE `tbl_client_residence`
  ADD PRIMARY KEY (`residence_id`);

--
-- Indexes for table `tbl_client_soi`
--
ALTER TABLE `tbl_client_soi`
  ADD PRIMARY KEY (`soi_id`);

--
-- Indexes for table `tbl_client_spouse`
--
ALTER TABLE `tbl_client_spouse`
  ADD PRIMARY KEY (`spouse_id`);

--
-- Indexes for table `tbl_client_types`
--
ALTER TABLE `tbl_client_types`
  ADD PRIMARY KEY (`client_type_id`);

--
-- Indexes for table `tbl_collections`
--
ALTER TABLE `tbl_collections`
  ADD PRIMARY KEY (`collection_id`);

--
-- Indexes for table `tbl_comakers`
--
ALTER TABLE `tbl_comakers`
  ADD PRIMARY KEY (`comaker_id`);

--
-- Indexes for table `tbl_employers`
--
ALTER TABLE `tbl_employers`
  ADD PRIMARY KEY (`employer_id`);

--
-- Indexes for table `tbl_expenses`
--
ALTER TABLE `tbl_expenses`
  ADD PRIMARY KEY (`expense_id`);

--
-- Indexes for table `tbl_expense_category`
--
ALTER TABLE `tbl_expense_category`
  ADD PRIMARY KEY (`expense_category_id`);

--
-- Indexes for table `tbl_expense_details`
--
ALTER TABLE `tbl_expense_details`
  ADD PRIMARY KEY (`expense_detail_id`);

--
-- Indexes for table `tbl_fixed_loan_interest`
--
ALTER TABLE `tbl_fixed_loan_interest`
  ADD PRIMARY KEY (`loan_interest_id`);

--
-- Indexes for table `tbl_insurance`
--
ALTER TABLE `tbl_insurance`
  ADD PRIMARY KEY (`insurance_id`);

--
-- Indexes for table `tbl_journals`
--
ALTER TABLE `tbl_journals`
  ADD PRIMARY KEY (`journal_id`);

--
-- Indexes for table `tbl_journal_entries`
--
ALTER TABLE `tbl_journal_entries`
  ADD PRIMARY KEY (`journal_entry_id`);

--
-- Indexes for table `tbl_journal_entry_details`
--
ALTER TABLE `tbl_journal_entry_details`
  ADD PRIMARY KEY (`journal_entry_detail_id`);

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
-- Indexes for table `tbl_property_owned`
--
ALTER TABLE `tbl_property_owned`
  ADD PRIMARY KEY (`property_id`);

--
-- Indexes for table `tbl_suppliers`
--
ALTER TABLE `tbl_suppliers`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_user_categories`
--
ALTER TABLE `tbl_user_categories`
  ADD PRIMARY KEY (`user_category_id`);

--
-- Indexes for table `tbl_user_privileges`
--
ALTER TABLE `tbl_user_privileges`
  ADD PRIMARY KEY (`privilege_id`);

--
-- Indexes for table `tbl_vouchers`
--
ALTER TABLE `tbl_vouchers`
  ADD PRIMARY KEY (`voucher_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_branches`
--
ALTER TABLE `tbl_branches`
  MODIFY `branch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_chart_classification`
--
ALTER TABLE `tbl_chart_classification`
  MODIFY `chart_class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_chart_of_accounts`
--
ALTER TABLE `tbl_chart_of_accounts`
  MODIFY `chart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `tbl_children`
--
ALTER TABLE `tbl_children`
  MODIFY `child_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_clients`
--
ALTER TABLE `tbl_clients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_client_atm`
--
ALTER TABLE `tbl_client_atm`
  MODIFY `atm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_client_business`
--
ALTER TABLE `tbl_client_business`
  MODIFY `business_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_client_dependents`
--
ALTER TABLE `tbl_client_dependents`
  MODIFY `dependent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_client_employment`
--
ALTER TABLE `tbl_client_employment`
  MODIFY `employment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_client_insurance`
--
ALTER TABLE `tbl_client_insurance`
  MODIFY `client_insurance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_client_reference`
--
ALTER TABLE `tbl_client_reference`
  MODIFY `reference_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tbl_client_residence`
--
ALTER TABLE `tbl_client_residence`
  MODIFY `residence_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_client_soi`
--
ALTER TABLE `tbl_client_soi`
  MODIFY `soi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_client_spouse`
--
ALTER TABLE `tbl_client_spouse`
  MODIFY `spouse_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_client_types`
--
ALTER TABLE `tbl_client_types`
  MODIFY `client_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_collections`
--
ALTER TABLE `tbl_collections`
  MODIFY `collection_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_comakers`
--
ALTER TABLE `tbl_comakers`
  MODIFY `comaker_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_employers`
--
ALTER TABLE `tbl_employers`
  MODIFY `employer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_expenses`
--
ALTER TABLE `tbl_expenses`
  MODIFY `expense_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_expense_category`
--
ALTER TABLE `tbl_expense_category`
  MODIFY `expense_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_expense_details`
--
ALTER TABLE `tbl_expense_details`
  MODIFY `expense_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_fixed_loan_interest`
--
ALTER TABLE `tbl_fixed_loan_interest`
  MODIFY `loan_interest_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_insurance`
--
ALTER TABLE `tbl_insurance`
  MODIFY `insurance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tbl_journals`
--
ALTER TABLE `tbl_journals`
  MODIFY `journal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_journal_entries`
--
ALTER TABLE `tbl_journal_entries`
  MODIFY `journal_entry_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tbl_journal_entry_details`
--
ALTER TABLE `tbl_journal_entry_details`
  MODIFY `journal_entry_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `tbl_loans`
--
ALTER TABLE `tbl_loans`
  MODIFY `loan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_loan_types`
--
ALTER TABLE `tbl_loan_types`
  MODIFY `loan_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_property_owned`
--
ALTER TABLE `tbl_property_owned`
  MODIFY `property_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_suppliers`
--
ALTER TABLE `tbl_suppliers`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_user_categories`
--
ALTER TABLE `tbl_user_categories`
  MODIFY `user_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_user_privileges`
--
ALTER TABLE `tbl_user_privileges`
  MODIFY `privilege_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_vouchers`
--
ALTER TABLE `tbl_vouchers`
  MODIFY `voucher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
