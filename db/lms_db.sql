-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.38-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for lms_db
CREATE DATABASE IF NOT EXISTS `lms_db` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `lms_db`;

-- Dumping structure for table lms_db.tbl_chart_classification
CREATE TABLE IF NOT EXISTS `tbl_chart_classification` (
  `chart_class_id` int(11) NOT NULL AUTO_INCREMENT,
  `chart_class_name` varchar(50) NOT NULL,
  `chart_class_code` varchar(10) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`chart_class_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table lms_db.tbl_chart_classification: ~6 rows (approximately)
/*!40000 ALTER TABLE `tbl_chart_classification` DISABLE KEYS */;
INSERT INTO `tbl_chart_classification` (`chart_class_id`, `chart_class_name`, `chart_class_code`, `date_added`, `date_last_modified`, `user_id`) VALUES
	(1, 'Current Asset', 'CA', '2023-05-17 13:41:16', '2023-05-17 13:41:16', 0),
	(2, 'Non Current Asset', 'NCA', '2023-05-17 13:41:25', '2023-05-17 13:41:25', 0),
	(3, 'Current Liabilities', 'CL', '2023-05-17 13:41:39', '2023-05-17 13:41:39', 0),
	(4, 'Equity', 'EQ', '2023-05-17 13:41:56', '2023-05-17 13:41:56', 0),
	(5, 'Revenue', 'REV', '2023-05-17 13:42:10', '2023-05-17 13:42:10', 0),
	(6, 'Cost & Expenses', 'CE', '2023-05-17 13:42:30', '2023-05-17 13:42:30', 0);
/*!40000 ALTER TABLE `tbl_chart_classification` ENABLE KEYS */;

-- Dumping structure for table lms_db.tbl_chart_of_accounts
CREATE TABLE IF NOT EXISTS `tbl_chart_of_accounts` (
  `chart_id` int(11) NOT NULL AUTO_INCREMENT,
  `chart_code` varchar(10) NOT NULL,
  `chart_name` varchar(50) NOT NULL,
  `chart_type` varchar(1) NOT NULL COMMENT 'M - Main; S - Sub',
  `main_chart_id` int(11) DEFAULT NULL,
  `chart_class_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`chart_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

-- Dumping data for table lms_db.tbl_chart_of_accounts: ~26 rows (approximately)
/*!40000 ALTER TABLE `tbl_chart_of_accounts` DISABLE KEYS */;
INSERT INTO `tbl_chart_of_accounts` (`chart_id`, `chart_code`, `chart_name`, `chart_type`, `main_chart_id`, `chart_class_id`, `date_added`, `date_last_modified`) VALUES
	(1, '100100', 'Petty Cash Fund', 'M', 0, 1, '2023-05-05 09:07:51', '2023-05-18 14:46:22'),
	(2, '100200', 'Revolving Fund', 'M', 0, 1, '2023-05-05 09:08:15', '2023-05-18 14:46:40'),
	(4, '200100', 'Cash in Bank', 'M', 0, 1, '2023-05-05 09:12:29', '2023-05-18 14:46:40'),
	(5, '100300', 'Cash in Bank - RBMI-Featherleaf-(51-000120-4)', 'S', 4, 1, '2023-05-05 09:16:07', '2023-05-18 14:46:40'),
	(6, '100400', 'Cash in Bank - RBMI - Featherleaf (101-21-000448-4', 'S', 4, 1, '2023-05-05 09:16:47', '2023-05-18 14:46:40'),
	(7, '100500', 'Cash in Bank - RBMI - Featherleaf (101-21-000739-4', 'S', 4, 1, '2023-05-05 09:17:07', '2023-05-18 14:46:40'),
	(8, '100600', 'Cash in Bank - CHINABANK - Featherleaf (1087000020', 'S', 4, 1, '2023-05-05 10:09:53', '2023-05-18 14:46:40'),
	(9, '100700', 'Cash in Bank - PNB', 'S', 4, 1, '2023-05-05 10:10:08', '2023-05-18 14:46:40'),
	(10, '100800', 'Cash in Bank - LAND BANK', 'S', 4, 1, '2023-05-05 10:10:22', '2023-05-18 14:46:40'),
	(11, '100900', 'Cash in Bank - BDO', 'S', 4, 1, '2023-05-05 10:10:59', '2023-05-18 14:46:40'),
	(12, '101000', 'Prepaid Rent', 'M', 0, 1, '2023-05-05 10:12:00', '2023-05-18 14:46:40'),
	(13, '20020', 'Loans Receivable', 'M', 0, 1, '2023-05-05 10:12:46', '2023-05-18 14:46:40'),
	(14, '101200', 'Loans Receivable - Pension Loan', 'S', 13, 1, '2023-05-05 10:13:17', '2023-05-18 14:46:40'),
	(15, '101201', 'Loans Receivable - Pension Loan -LA CARLOTA', 'S', 13, 1, '2023-05-05 10:18:28', '2023-05-18 14:46:40'),
	(16, '101202', 'Loans Receivable - Pension Loan -TALISAY', 'S', 13, 1, '2023-05-05 10:18:46', '2023-05-18 14:46:40'),
	(17, '101300', 'Loans Receivable - Salary Loan', 'S', 13, 1, '2023-05-05 10:19:53', '2023-05-18 14:46:40'),
	(18, '101301', 'Loans Receivable -  Salary Loan- LA CARLOTA', 'S', 13, 1, '2023-05-05 10:20:06', '2023-05-18 14:46:40'),
	(19, '101302', 'Loans Receivable - Salary Loan- TALISAY', 'S', 13, 1, '2023-05-05 10:20:24', '2023-05-18 14:46:40'),
	(20, 'w', 'Petty Cash Fund - ', 'S', 1, 1, '2023-05-17 13:54:28', '2023-05-18 14:46:40'),
	(28, '21', '32 - 2', 'S', 0, 1, '2023-05-17 14:39:14', '2023-05-18 14:46:40'),
	(31, '21', '2 - 21', 'S', 30, 1, '2023-05-17 14:41:45', '2023-05-18 14:46:40'),
	(32, '12323', 'sample', 'M', 0, 1, '2023-05-17 14:42:09', '2023-05-17 14:42:09'),
	(33, '23', 'sample - 3', 'S', 32, 1, '2023-05-17 14:42:24', '2023-05-17 14:42:24'),
	(34, '3123', '32123', 'M', 0, 1, '2023-05-17 14:44:13', '2023-05-17 14:44:13'),
	(35, '23', '234', 'M', 0, 1, '2023-05-17 14:48:39', '2023-05-17 14:48:39'),
	(36, '234', 'Revolving Fund - 32', 'S', 2, 1, '2023-05-17 14:48:46', '2023-05-18 14:46:40');
/*!40000 ALTER TABLE `tbl_chart_of_accounts` ENABLE KEYS */;

-- Dumping structure for table lms_db.tbl_children
CREATE TABLE IF NOT EXISTS `tbl_children` (
  `child_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `child_name` varchar(150) NOT NULL,
  `child_sex` varchar(10) NOT NULL,
  `child_age` int(11) NOT NULL,
  `child_occupation` varchar(50) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`child_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Dumping data for table lms_db.tbl_children: ~3 rows (approximately)
/*!40000 ALTER TABLE `tbl_children` DISABLE KEYS */;
INSERT INTO `tbl_children` (`child_id`, `client_id`, `child_name`, `child_sex`, `child_age`, `child_occupation`, `date_added`, `date_last_modified`) VALUES
	(5, 47, '3', 'Male', 3, '3', '2023-04-25 09:00:58', '2023-04-25 09:00:58'),
	(6, 45, 'q2', 'Male', 2, '2', '2023-05-09 21:01:32', '2023-05-09 21:01:32'),
	(7, 48, '4', 'Female', 3, '43', '2023-05-26 13:55:32', '2023-05-26 13:55:32');
/*!40000 ALTER TABLE `tbl_children` ENABLE KEYS */;

-- Dumping structure for table lms_db.tbl_clients
CREATE TABLE IF NOT EXISTS `tbl_clients` (
  `client_id` int(11) NOT NULL AUTO_INCREMENT,
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
  `client_emp_income` decimal(12,3) NOT NULL DEFAULT '0.000',
  `client_emp_status` varchar(15) NOT NULL,
  `client_emp_length` int(2) NOT NULL DEFAULT '0',
  `client_prev_emp` varchar(50) NOT NULL,
  `client_spouse` varchar(50) NOT NULL,
  `client_spouse_address` varchar(250) NOT NULL,
  `client_spouse_res_cert_no` varchar(50) NOT NULL,
  `client_spouse_res_cert_issued_at` varchar(50) NOT NULL,
  `client_spouse_res_cert_date` date NOT NULL,
  `client_spouse_employer` varchar(50) NOT NULL DEFAULT '',
  `client_spouce_employer_address` varchar(250) NOT NULL,
  `client_spouse_position` varchar(50) NOT NULL,
  `client_spouse_income` varchar(50) NOT NULL,
  `client_spouce_employer_contact_no` varchar(50) NOT NULL,
  `client_spouse_emp_status` varchar(50) NOT NULL,
  `client_spouse_leng_emp` varchar(50) NOT NULL,
  `client_spouse_prev_employment` varchar(50) NOT NULL,
  `client_no_of_childred` int(3) NOT NULL DEFAULT '0',
  `client_no_of_child_dependent` int(3) NOT NULL DEFAULT '0',
  `client_no_of_child_college` int(3) NOT NULL DEFAULT '0',
  `client_no_of_child_hs` int(3) NOT NULL DEFAULT '0',
  `client_no_of_child_elem` int(3) NOT NULL DEFAULT '0',
  `client_soi` varchar(50) NOT NULL COMMENT 'source of income',
  `client_soi_by_whom` varchar(50) NOT NULL,
  `client_soi_monthly_income` decimal(12,3) NOT NULL DEFAULT '0.000',
  `client_credit_ref_name1` varchar(50) NOT NULL,
  `client_credit_ref_address1` varchar(250) NOT NULL,
  `client_credit_ref_name2` varchar(50) NOT NULL,
  `client_credit_ref_address2` varchar(250) NOT NULL,
  `client_credit_ref_name3` varchar(50) NOT NULL,
  `client_credit_ref_address3` varchar(250) NOT NULL,
  `client_approx_total_monthly_income` decimal(12,3) NOT NULL DEFAULT '0.000',
  `client_total_outstanding_obligation` decimal(12,3) NOT NULL DEFAULT '0.000',
  `client_business_name` varchar(50) NOT NULL,
  `client_business_address` varchar(250) NOT NULL,
  `client_business_tel_no` varchar(15) NOT NULL,
  `client_business_position` varchar(50) NOT NULL,
  `client_business_kind` varchar(50) NOT NULL,
  `client_business_length` int(3) NOT NULL DEFAULT '0',
  `client_business_capital_invested` decimal(12,3) NOT NULL DEFAULT '0.000',
  `client_business_type` varchar(50) NOT NULL COMMENT 'Sole; Owner; Partner',
  `insurance_id` int(11) NOT NULL DEFAULT '0',
  `client_insurance_amount` decimal(12,3) NOT NULL DEFAULT '0.000',
  `client_insurance_maturity` int(11) NOT NULL DEFAULT '0',
  `client_bank_transaction` varchar(50) NOT NULL,
  `client_unpaid_obligation` decimal(12,3) NOT NULL DEFAULT '0.000',
  `client_salary_withdrawal` varchar(20) NOT NULL,
  `client_paymaster_name` varchar(150) NOT NULL,
  `client_paymaster_residence` varchar(250) NOT NULL,
  `client_paymaster_res_cert_no` varchar(50) NOT NULL,
  `client_paymaster_res_cert_issued_at` varchar(50) NOT NULL,
  `client_paymaster_res_cert_date` date NOT NULL,
  `client_paymaster_deduct_salary` varchar(3) NOT NULL COMMENT 'Yes or No',
  `client_paymaster_client_deduct_salary` varchar(3) NOT NULL COMMENT 'Yes or No',
  `client_paymaster_conformity` varchar(3) NOT NULL COMMENT 'Yes or No',
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table lms_db.tbl_clients: ~7 rows (approximately)
/*!40000 ALTER TABLE `tbl_clients` DISABLE KEYS */;
INSERT INTO `tbl_clients` (`client_id`, `client_fname`, `client_mname`, `client_lname`, `client_name_extension`, `client_dob`, `client_contact_no`, `client_civil_status`, `client_address`, `client_address_status`, `client_res_cert_no`, `client_res_cert_issued_at`, `client_res_cert_date`, `client_employer`, `client_employer_address`, `client_employer_contact_no`, `client_emp_position`, `client_emp_income`, `client_emp_status`, `client_emp_length`, `client_prev_emp`, `client_spouse`, `client_spouse_address`, `client_spouse_res_cert_no`, `client_spouse_res_cert_issued_at`, `client_spouse_res_cert_date`, `client_spouse_employer`, `client_spouce_employer_address`, `client_spouse_position`, `client_spouse_income`, `client_spouce_employer_contact_no`, `client_spouse_emp_status`, `client_spouse_leng_emp`, `client_spouse_prev_employment`, `client_no_of_childred`, `client_no_of_child_dependent`, `client_no_of_child_college`, `client_no_of_child_hs`, `client_no_of_child_elem`, `client_soi`, `client_soi_by_whom`, `client_soi_monthly_income`, `client_credit_ref_name1`, `client_credit_ref_address1`, `client_credit_ref_name2`, `client_credit_ref_address2`, `client_credit_ref_name3`, `client_credit_ref_address3`, `client_approx_total_monthly_income`, `client_total_outstanding_obligation`, `client_business_name`, `client_business_address`, `client_business_tel_no`, `client_business_position`, `client_business_kind`, `client_business_length`, `client_business_capital_invested`, `client_business_type`, `insurance_id`, `client_insurance_amount`, `client_insurance_maturity`, `client_bank_transaction`, `client_unpaid_obligation`, `client_salary_withdrawal`, `client_paymaster_name`, `client_paymaster_residence`, `client_paymaster_res_cert_no`, `client_paymaster_res_cert_issued_at`, `client_paymaster_res_cert_date`, `client_paymaster_deduct_salary`, `client_paymaster_client_deduct_salary`, `client_paymaster_conformity`, `date_added`, `date_last_modified`) VALUES
	(45, 'Pepe', '', 'Smith', '', '2023-01-05', '021', 'Married', 'Purok Samuel, Barangay Zone 4, Bago City Negros Occidental', 'Owned', '0', '0', '2023-04-24', '0', '0', '0', '0', -1.000, '0', 0, '0', '0', '0', '0', '0', '2023-04-24', '0', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, '0', '0', 0.000, '0', '0', '0', '0', '0', '0', 0.000, 0.000, '0', '0', '0', '0', '0', 0, 0.000, 'Owner', 1, 4.000, 4, '4', 4.000, 'Weekly', '4', '4', '4', '4', '2023-04-24', 'No', 'Yes', 'Yes', '2023-04-24 15:09:21', '2023-05-05 21:39:46'),
	(47, 'sa', 'a', 'a', '', '2017-01-12', '3', 'Married', 'Purok Samuel, Barangay Zone 4, Bago City Negros Occidental', 'Owned', '3', '3', '2023-04-25', '2', '2', '2', '2', 2.000, '2', 2, '', '2', '3', '3', '3', '2023-04-25', '3', '', '', '', '', '', '', '', 2, 3, 2, 3, 2, '3', '3', 2.000, '3', '3', '3', '3', '3', '3', 3.000, 3.000, '3', '3', '3', '3', '3', 3, 3.000, 'Sole', 1, 3.000, 3, '3', 3.000, 'Weekly', '3', '3', '3', '3', '2023-04-25', 'Yes', 'Yes', 'No', '2023-04-25 08:59:53', '2023-05-05 21:39:57'),
	(48, 'Pepe', 'Smith', 'Aguilar', '', '1996-01-30', '092544234', 'Single', 'Pulupandan', 'Owned', '123123', '13', '2023-05-26', '123', '123', '13', '13', 12000.000, '78', 6, '6', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, '', '', 0.000, '', '', '', '', '', '', 0.000, 0.000, '', '', '', '', '', 0, 0.000, '', 0, 0.000, 0, '', 0.000, '', '', '', '', '', '0000-00-00', '', '', '', '2023-05-26 13:54:25', '2023-05-26 13:54:25'),
	(50, 'qweqwe', 'e', 'e', 'e', '2023-05-26', 'we', 'Single', 'e', 'Owned', 'qwe', 'e', '2023-05-26', 'qwe', 'wqe', 'qwe', 'wq', 32.000, 'we', 0, 'qe', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, '', '', 0.000, '', '', '', '', '', '', 0.000, 0.000, '', '', '', '', '', 0, 0.000, '', 0, 0.000, 0, '', 0.000, '', '', '', '', '', '0000-00-00', '', '', '', '2023-05-26 14:03:21', '2023-05-26 14:03:21'),
	(53, 'renu', 'renu', 'renu', '', '2023-05-27', '2434', 'Single', '2', 'Owned', '234234', '234', '2023-05-26', '3', '3', '3', '3', 3.000, '3', 3, '3', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, '', '', 0.000, '', '', '', '', '', '', 0.000, 0.000, '', '', '', '', '', 0, 0.000, '', 0, 0.000, 0, '', 0.000, '', '', '', '', '', '0000-00-00', '', '', '', '2023-05-26 14:14:55', '2023-05-26 14:14:55'),
	(55, 'rr', '3', '3', '', '2023-05-26', '3', 'Single', '3', 'Owned', '3', '3', '2023-05-26', '3', '3', '3', '3', 3.000, '3', 3, '3', '3', '3', '3', '3', '2023-05-26', '3', '3', '3', '3', '3', '3', '3', '3', 3, 3, 3, 3, 3, '3', '3', 3.000, '3', '3', '3', '3', '3', '3', 3.000, 3.000, '3', '3', '3', '3', '3', 3, 3.000, 'Sole', 1, 3.000, 3, '3', 3.000, 'Weekly', '3', '3', '3', '3', '2023-05-26', 'No', 'No', 'No', '2023-05-26 14:23:41', '2023-05-26 14:24:24'),
	(59, '423 4', ' ', '4', '', '2023-05-26', '3', 'Single', '3', 'Owned', '3', '3', '2023-05-26', '3', '3', '3', '3', 3.000, '3', 3, '3', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, '3', '3', 3.000, '3', '3', '3', '3', '3', '3', 3.000, 3.000, '3', '3', '3', '3', '3', 3, 3.000, 'Sole', 1, 3.000, 3, '3', 3.000, 'Weekly', '3', '3', '3', '3', '2023-05-26', 'No', 'No', 'No', '2023-05-26 14:40:29', '2023-05-26 14:40:56');
/*!40000 ALTER TABLE `tbl_clients` ENABLE KEYS */;

-- Dumping structure for table lms_db.tbl_collections
CREATE TABLE IF NOT EXISTS `tbl_collections` (
  `collection_id` int(11) NOT NULL AUTO_INCREMENT,
  `reference_number` varchar(30) NOT NULL,
  `client_id` int(11) NOT NULL,
  `loan_id` int(11) DEFAULT NULL,
  `amount` decimal(12,3) DEFAULT NULL,
  `remarks` varchar(250) DEFAULT NULL,
  `collection_date` date NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'F' COMMENT 'P - Pending ; F - Finished',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`collection_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table lms_db.tbl_collections: ~3 rows (approximately)
/*!40000 ALTER TABLE `tbl_collections` DISABLE KEYS */;
INSERT INTO `tbl_collections` (`collection_id`, `reference_number`, `client_id`, `loan_id`, `amount`, `remarks`, `collection_date`, `status`, `user_id`, `date_added`, `date_last_modified`) VALUES
	(10, 'CL-20230526085103', 45, 7, 3400.000, '', '2023-06-06', 'F', 1, '2023-05-26 14:51:19', '2023-05-26 15:24:27'),
	(12, 'CL-20230526090516', 45, 7, 34.000, '', '2023-06-30', 'F', 1, '2023-05-26 15:05:26', '2023-05-26 15:05:26'),
	(13, 'CL-20230526090540', 45, 7, 3434.000, '', '2023-08-26', 'F', 1, '2023-05-26 15:05:48', '2023-05-26 15:21:20');
/*!40000 ALTER TABLE `tbl_collections` ENABLE KEYS */;

-- Dumping structure for table lms_db.tbl_comakers
CREATE TABLE IF NOT EXISTS `tbl_comakers` (
  `comaker_id` int(11) NOT NULL AUTO_INCREMENT,
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
  `comaker_employer_spouse` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`comaker_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table lms_db.tbl_comakers: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbl_comakers` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_comakers` ENABLE KEYS */;

-- Dumping structure for table lms_db.tbl_expenses
CREATE TABLE IF NOT EXISTS `tbl_expenses` (
  `expense_id` int(11) NOT NULL AUTO_INCREMENT,
  `reference_number` varchar(50) NOT NULL,
  `expense_date` date NOT NULL,
  `remarks` varchar(250) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `journal_id` int(11) NOT NULL,
  `status` varchar(1) NOT NULL,
  `user_id` int(11) NOT NULL,
  `credit_method` int(11) NOT NULL,
  PRIMARY KEY (`expense_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- Dumping data for table lms_db.tbl_expenses: ~2 rows (approximately)
/*!40000 ALTER TABLE `tbl_expenses` DISABLE KEYS */;
INSERT INTO `tbl_expenses` (`expense_id`, `reference_number`, `expense_date`, `remarks`, `date_added`, `date_last_modified`, `journal_id`, `status`, `user_id`, `credit_method`) VALUES
	(14, 'EXP-20230524091844', '2023-05-24', '', '2023-05-24 15:18:50', '2023-05-24 15:25:39', 3, 'F', 1, 1),
	(15, 'EXP-20230524092549', '2023-05-24', '', '2023-05-24 15:25:54', '2023-05-24 15:26:11', 3, 'F', 1, 1);
/*!40000 ALTER TABLE `tbl_expenses` ENABLE KEYS */;

-- Dumping structure for table lms_db.tbl_expense_category
CREATE TABLE IF NOT EXISTS `tbl_expense_category` (
  `expense_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `expense_category` varchar(50) NOT NULL,
  `remarks` varchar(250) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`expense_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table lms_db.tbl_expense_category: ~2 rows (approximately)
/*!40000 ALTER TABLE `tbl_expense_category` DISABLE KEYS */;
INSERT INTO `tbl_expense_category` (`expense_category_id`, `expense_category`, `remarks`, `date_added`, `date_last_modified`) VALUES
	(2, 'Operating Expenses', '', '2023-05-23 21:45:06', '2023-05-23 21:45:06'),
	(3, 'Non-operating Expenses', '', '2023-05-24 09:45:12', '2023-05-24 09:45:12');
/*!40000 ALTER TABLE `tbl_expense_category` ENABLE KEYS */;

-- Dumping structure for table lms_db.tbl_expense_details
CREATE TABLE IF NOT EXISTS `tbl_expense_details` (
  `expense_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `expense_id` int(11) NOT NULL,
  `chart_id` int(11) NOT NULL,
  `expense_category_id` int(11) NOT NULL,
  `expense_amount` decimal(12,3) NOT NULL,
  `expense_desc` varchar(250) NOT NULL,
  PRIMARY KEY (`expense_detail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

-- Dumping data for table lms_db.tbl_expense_details: ~17 rows (approximately)
/*!40000 ALTER TABLE `tbl_expense_details` DISABLE KEYS */;
INSERT INTO `tbl_expense_details` (`expense_detail_id`, `expense_id`, `chart_id`, `expense_category_id`, `expense_amount`, `expense_desc`) VALUES
	(1, 1, 6, 2, 213.000, ''),
	(2, 1, 2, 2, 500.000, ''),
	(3, 2, 1, 2, 2000.000, ''),
	(4, 2, 4, 3, 12.000, '2'),
	(5, 4, 12, 2, 24.000, ''),
	(6, 4, 10, 2, 324.000, ''),
	(7, 7, 1, 2, 300.000, ''),
	(8, 9, 12, 2, 12000.000, ''),
	(9, 9, 13, 2, 2.000, '12'),
	(10, 10, 12, 2, 5200.000, ''),
	(11, 11, 2, 2, 21.000, ''),
	(12, 11, 5, 2, 13.000, ''),
	(13, 12, 2, 2, 123.000, ''),
	(14, 13, 20, 2, 234.000, ''),
	(15, 13, 1, 2, 2500.000, ''),
	(16, 14, 12, 2, 2500.000, ''),
	(17, 14, 13, 2, 500.000, ''),
	(18, 15, 12, 2, 213.000, ''),
	(19, 15, 8, 3, 12.000, '');
/*!40000 ALTER TABLE `tbl_expense_details` ENABLE KEYS */;

-- Dumping structure for table lms_db.tbl_insurance
CREATE TABLE IF NOT EXISTS `tbl_insurance` (
  `insurance_id` int(11) NOT NULL AUTO_INCREMENT,
  `insurance_name` varchar(50) NOT NULL,
  `insurance_desc` varchar(250) NOT NULL,
  `insurance_amount` decimal(12,3) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`insurance_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table lms_db.tbl_insurance: ~2 rows (approximately)
/*!40000 ALTER TABLE `tbl_insurance` DISABLE KEYS */;
INSERT INTO `tbl_insurance` (`insurance_id`, `insurance_name`, `insurance_desc`, `insurance_amount`, `date_added`, `date_last_modified`) VALUES
	(1, 'Insurance Sample', 'sample only', 1000.000, '2023-04-16 16:48:11', '2023-04-16 16:50:24'),
	(2, 'Insurance 002', 'a', 1202.000, '2023-04-16 16:49:23', '2023-04-16 16:51:03');
/*!40000 ALTER TABLE `tbl_insurance` ENABLE KEYS */;

-- Dumping structure for table lms_db.tbl_journals
CREATE TABLE IF NOT EXISTS `tbl_journals` (
  `journal_id` int(11) NOT NULL AUTO_INCREMENT,
  `journal_name` varchar(50) NOT NULL,
  `journal_code` varchar(10) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`journal_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table lms_db.tbl_journals: ~5 rows (approximately)
/*!40000 ALTER TABLE `tbl_journals` DISABLE KEYS */;
INSERT INTO `tbl_journals` (`journal_id`, `journal_name`, `journal_code`, `date_added`, `date_last_modified`) VALUES
	(3, 'Beginning Balance', 'BBJ', '2023-05-02 13:37:29', '2023-05-12 08:33:00'),
	(4, 'Collection Receipts Journal', 'CRJ', '2023-05-02 13:37:48', '2023-05-02 13:37:48'),
	(5, 'Credit Card Journal', 'CCJ', '2023-05-02 13:38:04', '2023-05-02 13:38:04'),
	(6, 'Deposit Journal', 'DJ', '2023-05-02 13:38:15', '2023-05-02 13:38:15'),
	(7, 'Cash/Check Disbursement Journal', 'CDJ', '2023-05-02 13:38:30', '2023-05-02 13:38:30');
/*!40000 ALTER TABLE `tbl_journals` ENABLE KEYS */;

-- Dumping structure for table lms_db.tbl_journal_entries
CREATE TABLE IF NOT EXISTS `tbl_journal_entries` (
  `journal_entry_id` int(11) NOT NULL AUTO_INCREMENT,
  `reference_number` varchar(50) DEFAULT NULL,
  `cross_reference` varchar(50) DEFAULT NULL,
  `journal_id` int(11) DEFAULT NULL,
  `remarks` varchar(250) DEFAULT NULL,
  `journal_date` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` varchar(1) DEFAULT 'S',
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_manual` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`journal_entry_id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

-- Dumping data for table lms_db.tbl_journal_entries: ~2 rows (approximately)
/*!40000 ALTER TABLE `tbl_journal_entries` DISABLE KEYS */;
INSERT INTO `tbl_journal_entries` (`journal_entry_id`, `reference_number`, `cross_reference`, `journal_id`, `remarks`, `journal_date`, `user_id`, `status`, `date_added`, `date_last_modified`, `is_manual`) VALUES
	(51, 'BBJ-20230524092539', 'EXP-20230524091844', 3, '', '2023-05-24', 1, 'F', '2023-05-24 15:25:39', '2023-05-24 15:25:39', 'N'),
	(52, 'BBJ-20230524092611', 'EXP-20230524092549', 3, '', '2023-05-24', 1, 'F', '2023-05-24 15:26:11', '2023-05-24 15:26:11', 'N'),
	(53, 'CDJ-20230526055844', 'CV-20230526055830', 7, 'TO RELEASE LOAN PROCEEDS FOR THE RENEWAL OF SHIELA', '2023-05-26', 1, 'F', '2023-05-26 11:58:44', '2023-05-26 12:00:48', 'N');
/*!40000 ALTER TABLE `tbl_journal_entries` ENABLE KEYS */;

-- Dumping structure for table lms_db.tbl_journal_entry_details
CREATE TABLE IF NOT EXISTS `tbl_journal_entry_details` (
  `journal_entry_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `journal_entry_id` int(11) NOT NULL DEFAULT '0',
  `chart_id` int(11) NOT NULL DEFAULT '0',
  `description` varchar(250) NOT NULL,
  `debit` decimal(12,3) NOT NULL DEFAULT '0.000',
  `credit` decimal(12,3) NOT NULL DEFAULT '0.000',
  PRIMARY KEY (`journal_entry_detail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=latin1;

-- Dumping data for table lms_db.tbl_journal_entry_details: ~9 rows (approximately)
/*!40000 ALTER TABLE `tbl_journal_entry_details` DISABLE KEYS */;
INSERT INTO `tbl_journal_entry_details` (`journal_entry_detail_id`, `journal_entry_id`, `chart_id`, `description`, `debit`, `credit`) VALUES
	(96, 51, 12, '', 2500.000, 0.000),
	(97, 51, 13, '', 500.000, 0.000),
	(98, 51, 1, '', 0.000, 3000.000),
	(99, 52, 12, '', 213.000, 0.000),
	(100, 52, 8, '', 12.000, 0.000),
	(101, 52, 1, '', 0.000, 225.000),
	(102, 53, 13, '', 200000.000, 0.000),
	(103, 53, 13, '', 0.000, 143746.180),
	(104, 53, 5, '', 0.000, 56253.820);
/*!40000 ALTER TABLE `tbl_journal_entry_details` ENABLE KEYS */;

-- Dumping structure for table lms_db.tbl_loans
CREATE TABLE IF NOT EXISTS `tbl_loans` (
  `loan_id` int(11) NOT NULL AUTO_INCREMENT,
  `reference_number` varchar(50) NOT NULL,
  `client_id` int(11) NOT NULL DEFAULT '0',
  `loan_type_id` int(11) NOT NULL DEFAULT '0',
  `loan_amount` decimal(12,3) NOT NULL DEFAULT '0.000',
  `loan_period` int(6) NOT NULL DEFAULT '0',
  `loan_interest` decimal(12,3) NOT NULL DEFAULT '0.000',
  `due_date` date NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'A' COMMENT 'P - Pending; A - Approved; R - Released; D - Denied; F- Fully paid',
  `loan_date` date NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`loan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table lms_db.tbl_loans: ~1 rows (approximately)
/*!40000 ALTER TABLE `tbl_loans` DISABLE KEYS */;
INSERT INTO `tbl_loans` (`loan_id`, `reference_number`, `client_id`, `loan_type_id`, `loan_amount`, `loan_period`, `loan_interest`, `due_date`, `status`, `loan_date`, `date_added`, `date_last_modified`) VALUES
	(7, 'LN-20230526084500', 45, 4, 20000.000, 24, 17.000, '0000-00-00', 'R', '2023-05-26', '2023-05-26 14:46:04', '2023-05-26 14:48:45');
/*!40000 ALTER TABLE `tbl_loans` ENABLE KEYS */;

-- Dumping structure for table lms_db.tbl_loan_types
CREATE TABLE IF NOT EXISTS `tbl_loan_types` (
  `loan_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `loan_type` varchar(50) DEFAULT NULL,
  `loan_type_interest` decimal(5,2) NOT NULL,
  `remarks` varchar(250) DEFAULT NULL,
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`loan_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table lms_db.tbl_loan_types: ~8 rows (approximately)
/*!40000 ALTER TABLE `tbl_loan_types` DISABLE KEYS */;
INSERT INTO `tbl_loan_types` (`loan_type_id`, `loan_type`, `loan_type_interest`, `remarks`, `date_added`, `date_last_modified`) VALUES
	(1, 'PENSION LOAN', 18.00, 'Diminishing', '2023-04-09 22:12:49', '2023-05-07 18:14:05'),
	(2, 'SALARY LOAN', 17.00, 'Diminishing', '2023-05-03 15:48:54', '2023-05-07 18:13:54'),
	(3, 'SALARY-PRIVATE LOAN', 18.00, 'Diminishing', '2023-05-07 18:14:27', '2023-05-07 18:30:25'),
	(4, 'BONUS LOAN', 17.00, 'Diminishing', '2023-05-07 18:30:50', '2023-05-07 18:30:50'),
	(5, 'REAL ESTATE MORTGAGE LOAN', 17.00, 'Diminishing', '2023-05-07 18:33:35', '2023-05-07 18:35:01'),
	(6, 'CHATTEL MORTGAGE LOAN', 18.00, 'Diminishing', '2023-05-07 18:33:49', '2023-05-07 18:35:06'),
	(7, 'BUSINESS LOAN', 18.00, 'Diminishing', '2023-05-07 18:34:08', '2023-05-07 18:35:13'),
	(8, 'EMERGENCY LOAN', 18.00, 'Advanced', '2023-05-07 18:34:20', '2023-05-07 18:34:34');
/*!40000 ALTER TABLE `tbl_loan_types` ENABLE KEYS */;

-- Dumping structure for table lms_db.tbl_property_owned
CREATE TABLE IF NOT EXISTS `tbl_property_owned` (
  `property_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL DEFAULT '0',
  `property_location` varchar(250) NOT NULL,
  `property_area` varchar(250) NOT NULL,
  `property_acquisition_cost` decimal(12,3) NOT NULL DEFAULT '0.000',
  `property_pres_market_val` decimal(12,3) NOT NULL DEFAULT '0.000',
  `property_improvement` varchar(50) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`property_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

-- Dumping data for table lms_db.tbl_property_owned: ~18 rows (approximately)
/*!40000 ALTER TABLE `tbl_property_owned` DISABLE KEYS */;
INSERT INTO `tbl_property_owned` (`property_id`, `client_id`, `property_location`, `property_area`, `property_acquisition_cost`, `property_pres_market_val`, `property_improvement`, `date_added`, `date_last_modified`) VALUES
	(5, 47, '3', '3', 3.000, 3.000, '3', '2023-04-25 09:00:49', '2023-04-25 09:00:49'),
	(6, 47, '3', '3', 3.000, 3.000, '3', '2023-04-25 09:00:49', '2023-04-25 09:00:49'),
	(7, 48, '8', '8', 78.000, 867876.000, '6', '2023-05-26 13:55:16', '2023-05-26 13:55:16'),
	(8, 49, '332', '3', 3.000, 3.000, '', '2023-05-26 14:00:57', '2023-05-26 14:00:57'),
	(9, 50, '23', '32', 23.000, 23.000, '', '2023-05-26 14:03:57', '2023-05-26 14:03:57'),
	(10, 51, '333', '3', 3.000, 3.000, '', '2023-05-26 14:07:08', '2023-05-26 14:07:08'),
	(11, 51, '342 4', '4', 2.000, 2.000, '', '2023-05-26 14:07:34', '2023-05-26 14:07:34'),
	(12, 52, '334', '3', 3.000, 3.000, '3', '2023-05-26 14:13:08', '2023-05-26 14:13:08'),
	(13, 53, '3 3', '3', 3.000, 3.000, '', '2023-05-26 14:15:32', '2023-05-26 14:15:32'),
	(14, 53, '54 ', '4', 4.000, 4.000, '4', '2023-05-26 14:16:07', '2023-05-26 14:16:07'),
	(15, 53, '5345', '35', 43.000, 34.000, '43', '2023-05-26 14:16:48', '2023-05-26 14:16:48'),
	(16, 54, '2', '2', 2.000, 2.000, '', '2023-05-26 14:22:26', '2023-05-26 14:22:26'),
	(17, 55, '3 3 3', '3', 3.000, 3.000, '3', '2023-05-26 14:24:39', '2023-05-26 14:24:39'),
	(18, 55, '2 2', '2', 2.000, 2.000, '', '2023-05-26 14:27:03', '2023-05-26 14:27:03'),
	(19, 56, '3  3', '3', 3.000, 3.000, '', '2023-05-26 14:32:54', '2023-05-26 14:32:54'),
	(20, 57, '3  3 3', '3', 3.000, 3.000, '', '2023-05-26 14:35:33', '2023-05-26 14:35:33'),
	(21, 58, '3  3r', '3', 3.000, 3.000, '3', '2023-05-26 14:38:13', '2023-05-26 14:38:13'),
	(23, 59, '32', ' 3', 3.000, 3.000, '3', '2023-05-26 14:41:11', '2023-05-26 14:41:11');
/*!40000 ALTER TABLE `tbl_property_owned` ENABLE KEYS */;

-- Dumping structure for table lms_db.tbl_suppliers
CREATE TABLE IF NOT EXISTS `tbl_suppliers` (
  `supplier_id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(50) DEFAULT NULL,
  `supplier_address` varchar(250) DEFAULT NULL,
  `supplier_contact_no` varchar(15) DEFAULT NULL,
  `remarks` varchar(250) DEFAULT NULL,
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`supplier_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table lms_db.tbl_suppliers: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbl_suppliers` DISABLE KEYS */;
INSERT INTO `tbl_suppliers` (`supplier_id`, `supplier_name`, `supplier_address`, `supplier_contact_no`, `remarks`, `date_added`, `date_last_modified`) VALUES
	(2, 'Lao Chan Corp.', '', '033222', '', '2023-05-12 13:22:48', '2023-05-12 13:22:48');
/*!40000 ALTER TABLE `tbl_suppliers` ENABLE KEYS */;

-- Dumping structure for table lms_db.tbl_users
CREATE TABLE IF NOT EXISTS `tbl_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_fname` varchar(50) NOT NULL,
  `user_mname` varchar(50) NOT NULL,
  `user_lname` varchar(50) NOT NULL,
  `user_category_id` int(11) NOT NULL,
  `user_category` varchar(1) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table lms_db.tbl_users: ~3 rows (approximately)
/*!40000 ALTER TABLE `tbl_users` DISABLE KEYS */;
INSERT INTO `tbl_users` (`user_id`, `user_fname`, `user_mname`, `user_lname`, `user_category_id`, `user_category`, `username`, `password`, `date_added`, `date_last_modified`) VALUES
	(1, 'Juan', '', 'Dela Cruz', 1, 'A', 'admin', '0cc175b9c0f1b6a831c399e269772661', '2023-04-09 20:44:25', '2023-05-16 08:25:02'),
	(2, 'd', 'k', 'k', 2, 'S', 's', '03c7c0ace395d80182db07ae2c30f034', '2023-04-10 10:14:42', '2023-05-16 08:25:10'),
	(3, 'kaye', 'kaye', 'kaye', 3, '', 'a', '0cc175b9c0f1b6a831c399e269772661', '2023-05-16 09:00:48', '2023-05-16 09:00:48');
/*!40000 ALTER TABLE `tbl_users` ENABLE KEYS */;

-- Dumping structure for table lms_db.tbl_user_categories
CREATE TABLE IF NOT EXISTS `tbl_user_categories` (
  `user_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_category_name` varchar(50) NOT NULL,
  `remarks` varchar(250) NOT NULL,
  `is_preset` varchar(1) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table lms_db.tbl_user_categories: ~3 rows (approximately)
/*!40000 ALTER TABLE `tbl_user_categories` DISABLE KEYS */;
INSERT INTO `tbl_user_categories` (`user_category_id`, `user_category_name`, `remarks`, `is_preset`, `date_added`, `date_last_modified`) VALUES
	(1, 'Admin', '', 'Y', '2023-05-15 22:08:46', '2023-05-15 22:15:00'),
	(2, 'Accounting Staff', '', '', '2023-05-15 22:01:23', '2023-05-15 22:01:23'),
	(3, 'Encoder', '', '', '2023-05-16 08:50:52', '2023-05-16 08:50:52');
/*!40000 ALTER TABLE `tbl_user_categories` ENABLE KEYS */;

-- Dumping structure for table lms_db.tbl_user_privileges
CREATE TABLE IF NOT EXISTS `tbl_user_privileges` (
  `privilege_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_category_id` int(11) NOT NULL,
  `url` varchar(50) NOT NULL,
  `status` int(1) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`privilege_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- Dumping data for table lms_db.tbl_user_privileges: ~18 rows (approximately)
/*!40000 ALTER TABLE `tbl_user_privileges` DISABLE KEYS */;
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
/*!40000 ALTER TABLE `tbl_user_privileges` ENABLE KEYS */;

-- Dumping structure for table lms_db.tbl_vouchers
CREATE TABLE IF NOT EXISTS `tbl_vouchers` (
  `voucher_id` int(11) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`voucher_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

-- Dumping data for table lms_db.tbl_vouchers: ~1 rows (approximately)
/*!40000 ALTER TABLE `tbl_vouchers` DISABLE KEYS */;
INSERT INTO `tbl_vouchers` (`voucher_id`, `reference_number`, `account_type`, `account_id`, `voucher_no`, `description`, `check_number`, `ac_no`, `amount`, `voucher_date`, `status`, `user_id`, `journal_id`, `date_added`, `date_last_modified`) VALUES
	(26, 'CV-20230526055830', 'C', 45, '213', 'TO RELEASE LOAN PROCEEDS FOR THE RENEWAL OF SHIELA', '213', '123', 200000.000, '2023-05-26', 'F', 1, 7, '2023-05-26 11:58:44', '2023-05-26 12:00:48');
/*!40000 ALTER TABLE `tbl_vouchers` ENABLE KEYS */;

-- Dumping structure for trigger lms_db.delete_client
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `delete_client` AFTER DELETE ON `tbl_clients` FOR EACH ROW BEGIN
DELETE FROM tbl_children WHERE client_id = OLD.client_id;
DELETE FROM tbl_children WHERE client_id = OLD.client_id;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger lms_db.delete_voucher
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `delete_voucher` AFTER DELETE ON `tbl_vouchers` FOR EACH ROW DELETE FROM tbl_journal_entries WHERE cross_reference = OLD.reference_number AND is_manual !='Y'//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger lms_db.finish_voucher
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `finish_voucher` AFTER UPDATE ON `tbl_vouchers` FOR EACH ROW UPDATE tbl_journal_entries SET status = IF (NEW.status = 'F', 'F', 'S') WHERE cross_reference = NEW.reference_number//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
