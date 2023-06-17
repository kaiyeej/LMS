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

-- Dumping structure for table lms_db.tbl_branches
CREATE TABLE IF NOT EXISTS `tbl_branches` (
  `branch_id` int(11) NOT NULL AUTO_INCREMENT,
  `branch_name` varchar(50) NOT NULL,
  `remarks` text NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`branch_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table lms_db.tbl_branches: ~2 rows (approximately)
/*!40000 ALTER TABLE `tbl_branches` DISABLE KEYS */;
INSERT INTO `tbl_branches` (`branch_id`, `branch_name`, `remarks`, `date_added`, `date_last_modified`, `user_id`) VALUES
	(1, 'Bacolod', '', '2023-05-31 10:33:44', '2023-06-13 15:34:00', 0),
	(2, 'La Carlota', '', '2023-05-31 10:34:45', '2023-06-13 15:34:06', 0);
/*!40000 ALTER TABLE `tbl_branches` ENABLE KEYS */;

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
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`chart_id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

-- Dumping data for table lms_db.tbl_chart_of_accounts: ~31 rows (approximately)
/*!40000 ALTER TABLE `tbl_chart_of_accounts` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table lms_db.tbl_children: ~2 rows (approximately)
/*!40000 ALTER TABLE `tbl_children` DISABLE KEYS */;
INSERT INTO `tbl_children` (`child_id`, `client_id`, `child_name`, `child_sex`, `child_age`, `child_occupation`, `date_added`, `date_last_modified`) VALUES
	(6, 45, 'q2', 'Male', 2, '2', '2023-05-09 21:01:32', '2023-05-09 21:01:32'),
	(7, 48, '4', 'Female', 3, '43', '2023-05-26 13:55:32', '2023-05-26 13:55:32');
/*!40000 ALTER TABLE `tbl_children` ENABLE KEYS */;

-- Dumping structure for table lms_db.tbl_clients
CREATE TABLE IF NOT EXISTS `tbl_clients` (
  `client_id` int(11) NOT NULL AUTO_INCREMENT,
  `branch_id` int(11) NOT NULL,
  `client_type_id` int(11) NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table lms_db.tbl_clients: ~6 rows (approximately)
/*!40000 ALTER TABLE `tbl_clients` DISABLE KEYS */;
INSERT INTO `tbl_clients` (`client_id`, `branch_id`, `client_type_id`, `client_fname`, `client_mname`, `client_lname`, `client_name_extension`, `client_dob`, `client_contact_no`, `client_civil_status`, `client_address`, `client_address_status`, `client_res_cert_no`, `client_res_cert_issued_at`, `client_res_cert_date`, `client_employer`, `client_employer_address`, `client_employer_contact_no`, `client_emp_position`, `client_emp_income`, `client_emp_status`, `client_emp_length`, `client_prev_emp`, `client_spouse`, `client_spouse_address`, `client_spouse_res_cert_no`, `client_spouse_res_cert_issued_at`, `client_spouse_res_cert_date`, `client_spouse_employer`, `client_spouce_employer_address`, `client_spouse_position`, `client_spouse_income`, `client_spouce_employer_contact_no`, `client_spouse_emp_status`, `client_spouse_leng_emp`, `client_spouse_prev_employment`, `client_no_of_childred`, `client_no_of_child_dependent`, `client_no_of_child_college`, `client_no_of_child_hs`, `client_no_of_child_elem`, `client_soi`, `client_soi_by_whom`, `client_soi_monthly_income`, `client_credit_ref_name1`, `client_credit_ref_address1`, `client_credit_ref_name2`, `client_credit_ref_address2`, `client_credit_ref_name3`, `client_credit_ref_address3`, `client_approx_total_monthly_income`, `client_total_outstanding_obligation`, `client_business_name`, `client_business_address`, `client_business_tel_no`, `client_business_position`, `client_business_kind`, `client_business_length`, `client_business_capital_invested`, `client_business_type`, `insurance_id`, `client_insurance_amount`, `client_insurance_maturity`, `client_bank_transaction`, `client_unpaid_obligation`, `client_salary_withdrawal`, `client_paymaster_name`, `client_paymaster_residence`, `client_paymaster_res_cert_no`, `client_paymaster_res_cert_issued_at`, `client_paymaster_res_cert_date`, `client_paymaster_deduct_salary`, `client_paymaster_client_deduct_salary`, `client_paymaster_conformity`, `date_added`, `date_last_modified`) VALUES
	(45, 1, 0, 'Pepe', '', 'Smith', '', '2023-01-05', '021', 'Married', 'Purok Samuel, Barangay Zone 4, Bago City Negros Occidental', 'Owned', '0', '0', '2023-04-24', '0', '0', '0', '0', -1.000, '0', 0, '0', '0', '0', '0', '0', '2023-04-24', '0', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, '0', '0', 0.000, '0', '0', '0', '0', '0', '0', 0.000, 0.000, '0', '0', '0', '0', '0', 0, 0.000, 'Owner', 1, 4.000, 4, '4', 4.000, 'Weekly', '4', '4', '4', '4', '2023-04-24', 'No', 'Yes', 'Yes', '2023-04-24 15:09:21', '2023-06-03 10:43:41'),
	(48, 1, 0, 'Pepe', 'Smith', 'Aguilar', '', '1996-01-30', '092544234', 'Single', 'Pulupandan', 'Owned', '123123', '13', '2023-05-26', '123', '123', '13', '13', 12000.000, '78', 6, '6', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, '', '', 0.000, '', '', '', '', '', '', 0.000, 0.000, '', '', '', '', '', 0, 0.000, '', 0, 0.000, 0, '', 0.000, '', '', '', '', '', '0000-00-00', '', '', '', '2023-05-26 13:54:25', '2023-06-03 10:43:52'),
	(50, 1, 0, 'James', 'Ong2', 'Lapas', 'III', '2023-05-26', 'we', 'Single', 'e', 'Owned', 'qwe', 'e', '2023-05-26', 'qwe', 'wqe', 'qwe', 'wq', 32.000, 'we', 0, 'qe', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, '', '', 0.000, '', '', '', '', '', '', 0.000, 0.000, '', '', '', '', '', 0, 0.000, '', 0, 0.000, 0, '', 0.000, '', '', '', '', '', '0000-00-00', '', '', '', '2023-05-26 14:03:21', '2023-06-01 15:15:53'),
	(59, 0, 0, 'John', 'Santos', 'Ramos', '', '2023-05-26', '3', 'Single', '3', 'Owned', '3', '3', '2023-05-26', '3', '3', '3', '3', 3.000, '3', 3, '3', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, '3', '3', 3.000, '3', '3', '3', '3', '3', '3', 3.000, 3.000, '3', '3', '3', '3', '3', 3, 3.000, 'Sole', 1, 3.000, 3, '3', 3.000, 'Weekly', '3', '3', '3', '3', '2023-05-26', 'No', 'No', 'No', '2023-05-26 14:40:29', '2023-05-31 16:47:47'),
	(60, 1, 0, 'Rianne', 'Canoy', 'Strella', '2', '2023-05-31', '2', 'Single', '2', 'Owned', '2', '2', '2023-05-31', '3', '23', '2', '2', 3.000, '3', 3, '3', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, '', '', 0.000, '', '', '', '', '', '', 0.000, 0.000, '', '', '', '', '', 0, 0.000, '', 0, 0.000, 0, '', 0.000, '', '', '', '', '', '0000-00-00', '', '', '', '2023-05-31 11:36:12', '2023-05-31 16:48:19'),
	(61, 1, 1, '13', '123', '13', '13', '2023-06-14', '12', 'Married', '123', 'Owned', '213', '123', '2023-06-14', '123', '1', '3', '2', 123.000, '123', 3, '132', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, '', '', 0.000, '', '', '', '', '', '', 0.000, 0.000, '', '', '', '', '', 0, 0.000, '', 0, 0.000, 0, '', 0.000, '', '', '', '', '', '0000-00-00', '', '', '', '2023-06-14 15:17:09', '2023-06-14 15:17:09');
/*!40000 ALTER TABLE `tbl_clients` ENABLE KEYS */;

-- Dumping structure for table lms_db.tbl_client_types
CREATE TABLE IF NOT EXISTS `tbl_client_types` (
  `client_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_type` varchar(50) NOT NULL,
  `remarks` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`client_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table lms_db.tbl_client_types: ~2 rows (approximately)
/*!40000 ALTER TABLE `tbl_client_types` DISABLE KEYS */;
INSERT INTO `tbl_client_types` (`client_type_id`, `client_type`, `remarks`, `user_id`, `date_added`, `date_last_modified`) VALUES
	(1, 'Teachers', '', 1, '2023-06-14 15:11:33', '2023-06-14 15:11:55'),
	(2, 'Pensioners', '', 1, '2023-06-14 15:11:50', '2023-06-14 15:11:50');
/*!40000 ALTER TABLE `tbl_client_types` ENABLE KEYS */;

-- Dumping structure for table lms_db.tbl_collections
CREATE TABLE IF NOT EXISTS `tbl_collections` (
  `collection_id` int(11) NOT NULL AUTO_INCREMENT,
  `reference_number` varchar(30) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `loan_id` int(11) DEFAULT NULL,
  `chart_id` int(11) NOT NULL,
  `penalty_amount` decimal(12,3) NOT NULL,
  `excess_amount` decimal(12,3) NOT NULL,
  `interest` decimal(12,3) NOT NULL,
  `amount` decimal(12,3) DEFAULT NULL,
  `remarks` varchar(250) DEFAULT NULL,
  `collection_date` date NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'F' COMMENT 'P - Pending ; F - Finished',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`collection_id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table lms_db.tbl_collections: ~32 rows (approximately)
/*!40000 ALTER TABLE `tbl_collections` DISABLE KEYS */;
INSERT INTO `tbl_collections` (`collection_id`, `reference_number`, `branch_id`, `client_id`, `loan_id`, `chart_id`, `penalty_amount`, `excess_amount`, `interest`, `amount`, `remarks`, `collection_date`, `status`, `user_id`, `date_added`, `date_last_modified`) VALUES
	(17, 'CL-20230613075640', 1, 45, 7, 4, 230.000, 0.000, 0.000, 213.000, NULL, '2023-06-13', 'F', 1, '2023-06-13 13:56:51', '2023-06-13 13:56:51'),
	(18, 'CL-20230613075911', 1, 45, 7, 4, 0.000, 0.000, 0.000, 46.000, NULL, '2023-06-13', 'F', 1, '2023-06-13 13:59:23', '2023-06-13 13:59:23'),
	(19, 'CL-20230613081931', 1, 45, 7, 4, 0.000, 0.000, 0.000, 120.000, '', '2023-06-13', 'F', 1, '2023-06-13 14:19:44', '2023-06-13 14:19:44'),
	(20, 'CL-20230613082050', 1, 45, 7, 5, 0.000, 0.000, 0.000, 213.000, '', '2023-06-13', 'F', 1, '2023-06-13 14:21:02', '2023-06-13 14:21:02'),
	(21, 'CL-20230613082148', 1, 45, 7, 4, 0.000, 0.000, 0.000, 2000.000, '', '2023-06-13', 'F', 1, '2023-06-13 14:22:00', '2023-06-13 14:22:00'),
	(22, 'CL-20230613084333', 1, 45, 7, 5, 0.000, 0.000, 0.000, 23.000, '', '2023-06-13', 'F', 1, '2023-06-13 14:43:45', '2023-06-13 14:43:45'),
	(23, 'CL-20230613084506', 1, 45, 7, 5, 0.000, 0.000, 0.000, 342.000, '', '2023-06-13', 'F', 1, '2023-06-13 14:45:22', '2023-06-13 14:45:22'),
	(24, 'CL-20230613092619', 1, 45, 7, 5, 0.000, 0.000, 0.000, 5000.000, '', '2023-06-14', 'F', 1, '2023-06-13 15:26:31', '2023-06-13 15:26:31'),
	(25, 'CL-20230613093228', 1, 45, 7, 5, 0.000, 0.000, 0.000, 5000.000, '', '2023-06-13', 'F', 1, '2023-06-13 15:32:57', '2023-06-13 15:32:57'),
	(26, 'CL-20230613093430', 1, 45, 7, 5, 0.000, 0.000, 0.000, 2500.000, '', '2023-06-13', 'F', 1, '2023-06-13 15:34:43', '2023-06-13 15:34:43'),
	(27, 'CL-20230613094850', 1, 45, 7, 4, 0.010, 0.000, 0.000, 3.000, '', '2023-06-13', 'F', 1, '2023-06-13 15:49:00', '2023-06-13 15:49:00'),
	(28, 'CL-20230613094959', 1, 45, 7, 5, 20.000, 0.000, 0.000, 1230.000, '', '2023-06-13', 'F', 1, '2023-06-13 15:50:11', '2023-06-13 15:50:11'),
	(29, 'CL-20230613100345', 1, 45, 7, 5, 0.000, 0.000, 0.000, 1230.000, '', '2023-06-13', 'F', 1, '2023-06-13 16:03:56', '2023-06-13 16:03:56'),
	(30, 'CL-20230613100538', 1, 45, 7, 5, 10.000, 0.000, 0.000, 1200.000, '', '2023-06-13', 'F', 1, '2023-06-13 16:05:50', '2023-06-13 16:05:50'),
	(31, 'CL-20230613102914', 1, 45, 7, 4, 0.000, 0.000, 0.000, 1000.000, '', '2023-06-13', 'F', 1, '2023-06-13 16:29:25', '2023-06-13 16:29:25'),
	(32, 'CL-20230613103444', 1, 45, 7, 4, 0.000, 0.000, 0.000, 2500.000, '', '2023-06-13', 'F', 1, '2023-06-13 16:34:57', '2023-06-13 16:34:57'),
	(33, 'CL-20230613103658', 1, 45, 7, 4, 0.000, 0.000, 0.000, 700.000, '', '2023-06-13', 'F', 1, '2023-06-13 16:37:10', '2023-06-13 16:37:10'),
	(34, 'CL-20230613103739', 1, 45, 7, 5, 0.000, 0.000, 0.000, 123.000, '', '2023-06-13', 'F', 1, '2023-06-13 16:37:48', '2023-06-13 16:37:48'),
	(35, 'CL-20230613103924', 1, 45, 7, 4, 0.000, 0.000, 0.000, 213.000, '', '2023-06-13', 'F', 1, '2023-06-13 16:39:34', '2023-06-13 16:39:34'),
	(36, 'CL-20230613104002', 1, 45, 7, 5, 0.000, 0.000, 0.000, 233.000, '', '2023-06-13', 'F', 1, '2023-06-13 16:40:37', '2023-06-13 16:40:37'),
	(37, 'CL-20230614025214', 1, 45, 7, 4, 0.000, 0.000, 0.000, 233.000, '', '2023-06-14', 'F', 1, '2023-06-14 08:52:25', '2023-06-14 08:52:25'),
	(39, 'CL-20230614045814', 1, 45, 11, 5, 0.000, 0.000, 3750.001, 14166.670, '', '2023-06-14', 'F', 1, '2023-06-14 10:58:38', '2023-06-14 10:58:38'),
	(40, 'CL-20230614045928', 1, 45, 11, 5, 0.000, 0.000, 11250.003, 42500.010, '', '2023-06-14', 'F', 1, '2023-06-14 10:59:42', '2023-06-14 10:59:42'),
	(41, 'CL-20230616074738', 1, 45, 9, 5, 0.000, 0.000, 2288.136, 15000.000, '', '2023-06-16', 'F', 1, '2023-06-16 13:48:23', '2023-06-16 13:48:23'),
	(42, 'CL-20230616083449', 1, 45, 7, 4, 0.000, 0.000, 253.731, 1000.000, '', '2023-06-16', 'F', 1, '2023-06-16 14:35:01', '2023-06-16 14:35:01'),
	(43, 'CL-20230616093011', 1, 45, 9, 4, 0.000, 0.000, 190.678, 1250.000, '', '2023-07-17', 'F', 1, '2023-06-16 15:31:18', '2023-06-16 15:31:18'),
	(44, 'CL-20230616093121', 1, 45, 11, 5, 0.000, 0.000, 992.647, 3750.000, '', '2023-07-16', 'F', 1, '2023-06-16 15:31:53', '2023-06-16 15:31:53'),
	(45, 'CL-20230616093202', 1, 45, 10, 4, 0.000, 0.000, 14.860, 213.000, '', '2023-08-16', 'F', 1, '2023-06-16 15:32:45', '2023-06-16 15:32:45'),
	(46, 'CL-20230617034327', 1, 48, 12, 5, 0.000, 0.000, 381.356, 2500.000, '', '2023-06-17', 'F', 1, '2023-06-17 09:43:48', '2023-06-17 09:43:48'),
	(47, 'CL-20230617035114', 1, 48, 12, 5, 0.000, 0.000, 381.356, 2500.000, '', '2023-06-17', 'F', 1, '2023-06-17 09:51:28', '2023-06-17 09:51:28'),
	(48, 'CL-20230617035145', 1, 48, 12, 4, 0.000, 0.000, 915.254, 6000.000, '', '2023-07-17', 'F', 1, '2023-06-17 09:52:03', '2023-06-17 09:52:03'),
	(49, 'CL-20230617035228', 1, 48, 12, 5, 0.000, 0.000, 122.034, 800.000, '', '2023-09-28', 'F', 1, '2023-06-17 09:52:42', '2023-06-17 09:52:42');
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
  `branch_id` int(11) NOT NULL,
  `remarks` varchar(250) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `journal_id` int(11) NOT NULL,
  `status` varchar(1) NOT NULL,
  `user_id` int(11) NOT NULL,
  `credit_method` int(11) NOT NULL,
  PRIMARY KEY (`expense_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- Dumping data for table lms_db.tbl_expenses: ~5 rows (approximately)
/*!40000 ALTER TABLE `tbl_expenses` DISABLE KEYS */;
INSERT INTO `tbl_expenses` (`expense_id`, `reference_number`, `expense_date`, `branch_id`, `remarks`, `date_added`, `date_last_modified`, `journal_id`, `status`, `user_id`, `credit_method`) VALUES
	(14, 'EXP-20230524091844', '2023-05-24', 0, '', '2023-05-24 15:18:50', '2023-05-24 15:25:39', 3, 'F', 1, 1),
	(15, 'EXP-20230524092549', '2023-05-24', 0, '', '2023-05-24 15:25:54', '2023-05-24 15:26:11', 3, 'F', 1, 1),
	(16, 'EXP-20230607043313', '2023-06-07', 0, '', '2023-06-07 10:33:19', '2023-06-07 10:33:19', 3, '', 1, 1),
	(17, 'EXP-20230609034625', '2023-06-09', 1, '', '2023-06-09 09:47:52', '2023-06-09 09:48:01', 3, 'F', 1, 1),
	(18, 'EXP-20230614053718', '2023-06-14', 1, '', '2023-06-14 11:37:24', '2023-06-14 11:37:24', 3, '', 1, 1);
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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

-- Dumping data for table lms_db.tbl_expense_details: ~20 rows (approximately)
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
	(19, 15, 8, 3, 12.000, ''),
	(20, 17, 1, 0, 23.000, '');
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
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=latin1;

-- Dumping data for table lms_db.tbl_journal_entries: ~59 rows (approximately)
/*!40000 ALTER TABLE `tbl_journal_entries` DISABLE KEYS */;
INSERT INTO `tbl_journal_entries` (`journal_entry_id`, `reference_number`, `cross_reference`, `journal_id`, `remarks`, `journal_date`, `user_id`, `status`, `date_added`, `date_last_modified`, `is_manual`) VALUES
	(51, 'BBJ-20230524092539', 'EXP-20230524091844', 3, '', '2023-05-24', 1, 'F', '2023-05-24 15:25:39', '2023-05-24 15:25:39', 'N'),
	(52, 'BBJ-20230524092611', 'EXP-20230524092549', 3, '', '2023-05-24', 1, 'F', '2023-05-24 15:26:11', '2023-05-24 15:26:11', 'N'),
	(53, 'CDJ-20230526055844', 'CV-20230526055830', 7, 'TO RELEASE LOAN PROCEEDS FOR THE RENEWAL OF SHIELA', '2023-05-26', 1, 'S', '2023-05-26 11:58:44', '2023-06-16 10:11:21', 'N'),
	(54, 'BBJ-20230607103916', 'CV-20230607103901', 3, '34', '2023-06-07', 1, 'S', '2023-06-07 16:39:16', '2023-06-07 16:39:16', 'N'),
	(55, 'BBJ-20230609034801', 'EXP-20230609034625', 3, '', '2023-06-09', 1, 'F', '2023-06-09 09:48:01', '2023-06-09 09:48:01', 'N'),
	(56, 'CDJ-20230613031827', 'CV-20230613031804', 7, '213', '2023-06-13', 1, 'F', '2023-06-13 09:18:27', '2023-06-16 10:22:25', 'N'),
	(57, 'CDJ-20230613032122', 'CV-20230613032047', 7, 'asds', '2023-06-13', 1, 'F', '2023-06-13 09:21:22', '2023-06-16 10:22:23', 'N'),
	(58, '-20230613081944', 'CL-20230613081931', 0, '', '2023-06-13', 1, 'S', '2023-06-13 14:19:44', '2023-06-13 14:19:44', 'N'),
	(59, '-20230613082102', 'CL-20230613082050', 0, '', '2023-06-13', 1, 'S', '2023-06-13 14:21:02', '2023-06-13 14:21:02', 'N'),
	(60, 'CRJ-20230613082200', 'CL-20230613082148', 0, '', '2023-06-13', 1, 'S', '2023-06-13 14:22:00', '2023-06-13 14:22:00', 'N'),
	(61, 'CRJ-20230613082235', 'CL-20230613082148', 4, '', '2023-06-13', 1, 'S', '2023-06-13 14:22:35', '2023-06-13 14:22:35', 'N'),
	(62, 'CRJ-20230613084345', 'CL-20230613084333', 4, '', '2023-06-13', 1, 'S', '2023-06-13 14:43:45', '2023-06-13 14:43:45', 'N'),
	(63, 'CRJ-20230613084522', 'CL-20230613084506', 4, '', '2023-06-13', 1, 'S', '2023-06-13 14:45:22', '2023-06-13 14:45:22', 'N'),
	(64, 'CRJ-20230613092631', 'CL-20230613092619', 4, '', '2023-06-14', 1, 'S', '2023-06-13 15:26:31', '2023-06-13 15:26:31', 'N'),
	(65, 'CRJ-20230613093257', 'CL-20230613093228', 4, '', '2023-06-13', 1, 'S', '2023-06-13 15:32:57', '2023-06-13 15:32:57', 'N'),
	(66, 'CRJ-20230613093443', 'CL-20230613093430', 4, '', '2023-06-13', 1, 'S', '2023-06-13 15:34:43', '2023-06-13 15:34:43', 'N'),
	(67, 'CRJ-20230613094900', 'CL-20230613094850', 4, '', '2023-06-13', 1, 'S', '2023-06-13 15:49:00', '2023-06-13 15:49:00', 'N'),
	(68, 'CRJ-20230613095011', 'CL-20230613094959', 4, '', '2023-06-13', 1, 'S', '2023-06-13 15:50:11', '2023-06-13 15:50:11', 'N'),
	(69, 'CRJ-20230613100356', 'CL-20230613100345', 4, '', '2023-06-13', 1, 'S', '2023-06-13 16:03:56', '2023-06-13 16:03:56', 'N'),
	(70, 'CRJ-20230613100550', 'CL-20230613100538', 4, '', '2023-06-13', 1, 'S', '2023-06-13 16:05:50', '2023-06-13 16:05:50', 'N'),
	(71, 'CRJ-20230613102925', 'CL-20230613102914', 4, '', '2023-06-13', 1, 'S', '2023-06-13 16:29:25', '2023-06-13 16:29:25', 'N'),
	(72, 'CRJ-20230613103457', 'CL-20230613103444', 4, '', '2023-06-13', 1, 'S', '2023-06-13 16:34:57', '2023-06-13 16:34:57', 'N'),
	(73, 'CRJ-20230613103710', 'CL-20230613103658', 4, '', '2023-06-13', 1, 'F', '2023-06-13 16:37:10', '2023-06-13 16:37:10', 'N'),
	(74, 'CRJ-20230613103748', 'CL-20230613103739', 4, '', '2023-06-13', 1, 'F', '2023-06-13 16:37:48', '2023-06-13 16:37:48', 'N'),
	(75, 'CRJ-20230613103934', 'CL-20230613103924', 4, '', '2023-06-13', 1, 'F', '2023-06-13 16:39:34', '2023-06-13 16:39:34', 'N'),
	(76, 'CRJ-20230613104037', 'CL-20230613104002', 4, '', '2023-06-13', 1, 'F', '2023-06-13 16:40:37', '2023-06-13 16:40:37', 'N'),
	(77, 'CRJ-20230614025225', 'CL-20230614025214', 4, '', '2023-06-14', 1, 'F', '2023-06-14 08:52:25', '2023-06-14 08:52:25', 'N'),
	(78, 'CDJ-20230614025653', 'CV-20230614025617', 7, 'sample', '2023-06-14', 1, 'F', '2023-06-14 08:56:53', '2023-06-16 10:22:22', 'N'),
	(79, 'CRJ-20230614025749', 'CL-20230614025737', 4, '', '2023-06-14', 1, 'F', '2023-06-14 08:57:49', '2023-06-14 08:57:49', 'N'),
	(80, 'CRJ-20230614045838', 'CL-20230614045814', 4, '', '2023-06-14', 1, 'F', '2023-06-14 10:58:38', '2023-06-14 10:58:38', 'N'),
	(81, 'CRJ-20230614045942', 'CL-20230614045928', 4, '', '2023-06-14', 1, 'F', '2023-06-14 10:59:42', '2023-06-14 10:59:42', 'N'),
	(82, 'CDJ-20230614053507', 'CV-20230614053454', 7, '4', '2023-06-14', 1, 'S', '2023-06-14 11:35:07', '2023-06-16 10:24:21', 'N'),
	(83, 'BBJ-20230614053850', '234234', 3, '', '2023-06-14', 1, 'S', '2023-06-14 11:38:55', '2023-06-14 11:38:55', 'Y'),
	(84, 'CDJ-20230616033523', 'CV-20230614025617', 7, 'Reverse Entry for Cancelled Voucher (CV-20230614025617).', '2023-06-14', 1, 'F', '2023-06-16 09:35:23', '2023-06-16 10:22:22', 'N'),
	(85, 'CDJ-20230616033539', 'CV-20230614025617', 7, 'Reverse Entry for Cancelled Voucher (CV-20230614025617).', '2023-06-14', 1, 'F', '2023-06-16 09:35:39', '2023-06-16 10:22:22', 'N'),
	(86, 'CDJ-20230616033630', 'CV-20230614025617', 7, 'Reverse Entry for Cancelled Voucher (CV-20230614025617).', '2023-06-14', 1, 'F', '2023-06-16 09:36:30', '2023-06-16 10:22:22', 'N'),
	(87, 'CDJ-20230616033807', 'CV-20230614025617', 7, 'Reverse Entry for Cancelled Voucher (CV-20230614025617).', '2023-06-14', 1, 'F', '2023-06-16 09:38:07', '2023-06-16 10:22:22', 'N'),
	(88, 'CDJ-20230616034349', 'CV-20230614025617', 7, 'Reverse Entry for Cancelled Voucher (CV-20230614025617).', '2023-06-14', 1, 'F', '2023-06-16 09:43:49', '2023-06-16 10:22:22', 'N'),
	(89, 'CDJ-20230616040108', 'CV-20230614025617', 7, 'Reverse Entry for Cancelled Voucher (CV-20230614025617).', '2023-06-14', 1, 'F', '2023-06-16 10:01:08', '2023-06-16 10:22:22', 'N'),
	(90, 'CDJ-20230616040130', 'CV-20230614025617', 7, 'Reverse Entry for Cancelled Voucher (CV-20230614025617).', '2023-06-14', 1, 'F', '2023-06-16 10:01:30', '2023-06-16 10:22:22', 'N'),
	(91, 'CDJ-20230616040154', 'CV-20230614025617', 7, 'Reverse Entry for Cancelled Voucher (CV-20230614025617).', '2023-06-14', 1, 'F', '2023-06-16 10:01:54', '2023-06-16 10:22:22', 'N'),
	(92, 'CDJ-20230616040312', 'CV-20230613032047', 7, 'Reverse Entry for Cancelled Voucher (CV-20230613032047).', '2023-06-13', 1, 'F', '2023-06-16 10:03:12', '2023-06-16 10:22:23', 'N'),
	(93, 'CDJ-20230616040343', 'CV-20230613032047', 7, 'Reverse Entry for Cancelled Voucher (CV-20230613032047).', '2023-06-13', 1, 'F', '2023-06-16 10:03:43', '2023-06-16 10:22:23', 'N'),
	(94, 'CDJ-20230616040433', 'CV-20230613032047', 7, 'Reverse Entry for Cancelled Voucher (CV-20230613032047).', '2023-06-13', 1, 'F', '2023-06-16 10:04:33', '2023-06-16 10:22:23', 'N'),
	(95, 'CDJ-20230616040702', 'CV-20230613032047', 7, 'Reverse Entry for Cancelled Voucher (CV-20230613032047).', '2023-06-13', 1, 'F', '2023-06-16 10:07:02', '2023-06-16 10:22:23', 'N'),
	(96, 'CDJ-20230616041044', 'CV-20230613031804', 7, 'Reverse Entry for Cancelled Voucher (CV-20230613031804).', '2023-06-13', 1, 'F', '2023-06-16 10:10:44', '2023-06-16 10:22:25', 'N'),
	(97, 'CDJ-20230616041121', 'CV-20230526055830', 7, 'Reverse Entry for Cancelled Voucher (CV-20230526055830).', '2023-05-26', 1, 'S', '2023-06-16 10:11:21', '2023-06-16 10:11:21', 'N'),
	(98, 'CDJ-20230616041250', 'CV-20230614025617', 7, 'Reverse Entry for Cancelled Voucher (CV-20230614025617).', '2023-06-14', 1, 'F', '2023-06-16 10:12:50', '2023-06-16 10:22:22', 'N'),
	(99, 'CDJ-20230616041810', 'CV-20230614053454', 7, 'Reverse Entry for Cancelled Voucher (CV-20230614053454).', '2023-06-14', 1, 'S', '2023-06-16 10:18:10', '2023-06-16 10:24:21', 'N'),
	(100, 'CDJ-20230616042421', 'CCV-20230614053454', 7, 'Reverse Entry for Cancelled Voucher (CV-20230614053454).', '2023-06-14', 1, 'F', '2023-06-16 10:24:21', '2023-06-16 10:24:21', 'N'),
	(101, 'CDJ-20230616044935', 'CCV-20230614025617', 7, 'Reverse Entry for Cancelled Voucher (CV-20230614025617).', '2023-06-14', 1, 'F', '2023-06-16 10:49:35', '2023-06-16 10:49:35', 'N'),
	(102, 'CDJ-20230616045009', 'CV-20230616044947', 7, '123', '2023-06-16', 1, 'F', '2023-06-16 10:50:09', '2023-06-16 10:51:00', 'N'),
	(103, 'CDJ-20230616045112', 'CCV-20230616044947', 7, 'Reverse Entry for Cancelled Voucher (CV-20230616044947).', '2023-06-16', 1, 'F', '2023-06-16 10:51:12', '2023-06-16 10:51:12', 'N'),
	(104, 'CRJ-20230616074823', 'CL-20230616074738', 4, '', '2023-06-16', 1, 'F', '2023-06-16 13:48:23', '2023-06-16 13:48:23', 'N'),
	(105, 'CRJ-20230616093153', 'CL-20230616093121', 4, '', '2023-07-16', 1, 'F', '2023-06-16 15:31:53', '2023-06-16 15:31:53', 'N'),
	(106, 'CRJ-20230616093245', 'CL-20230616093202', 4, '', '2023-08-16', 1, 'F', '2023-06-16 15:32:45', '2023-06-16 15:32:45', 'N'),
	(107, 'CDJ-20230617033143', 'CV-20230617033109', 7, 'sa', '2023-06-17', 1, 'F', '2023-06-17 09:31:43', '2023-06-17 09:32:01', 'N'),
	(108, 'CRJ-20230617035128', 'CL-20230617035114', 4, '', '2023-06-17', 1, 'F', '2023-06-17 09:51:28', '2023-06-17 09:51:28', 'N'),
	(109, 'CRJ-20230617035203', 'CL-20230617035145', 4, '', '2023-07-17', 1, 'F', '2023-06-17 09:52:03', '2023-06-17 09:52:03', 'N');
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
) ENGINE=InnoDB AUTO_INCREMENT=193 DEFAULT CHARSET=latin1;

-- Dumping data for table lms_db.tbl_journal_entry_details: ~93 rows (approximately)
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
	(104, 53, 5, '', 0.000, 56253.820),
	(105, 55, 1, '', 23.000, 0.000),
	(106, 55, 1, '', 0.000, 23.000),
	(109, 56, 12, '', 323.000, 0.000),
	(110, 56, 4, '', 0.000, 323.000),
	(111, 57, 1, '', 25000.000, 0.000),
	(112, 57, 5, '', 0.000, 25000.000),
	(113, 62, 5, '', 23.000, 0.000),
	(114, 63, 5, '', 342.000, 0.000),
	(115, 64, 5, '', 5000.000, 0.000),
	(116, 64, 0, '', 0.000, 70.833),
	(117, 65, 5, '', 5000.000, 0.000),
	(118, 65, 0, '', 0.000, 70.833),
	(119, 66, 5, '', 2500.000, 0.000),
	(120, 66, 38, '', 0.000, 35.417),
	(121, 67, 4, '', 3.010, 0.000),
	(122, 67, 38, '', 0.000, 0.043),
	(123, 67, 40, '', 0.000, 0.043),
	(124, 68, 5, '', 1250.000, 0.000),
	(125, 68, 38, '', 0.000, 17.425),
	(126, 68, 40, '', 0.000, 20.000),
	(127, 69, 5, '', 1230.000, 0.000),
	(128, 69, 38, '', 0.000, 17.425),
	(129, 69, 0, '', 0.000, 1212.575),
	(130, 70, 5, '', 1210.000, 0.000),
	(131, 70, 38, '', 0.000, 17.000),
	(132, 70, 40, '', 0.000, 10.000),
	(133, 70, 0, '', 0.000, 1183.000),
	(134, 71, 4, '', 1000.000, 0.000),
	(135, 71, 38, '', 0.000, 14.167),
	(136, 71, 0, '', 0.000, 985.833),
	(137, 72, 4, '', 2500.000, 0.000),
	(138, 72, 38, '', 0.000, 35.417),
	(139, 72, 41, '', 0.000, 2464.583),
	(140, 73, 4, '', 700.000, 0.000),
	(141, 73, 38, '', 0.000, 9.917),
	(142, 73, 41, '', 0.000, 690.083),
	(143, 74, 5, '', 123.000, 0.000),
	(144, 74, 38, '', 0.000, 1.743),
	(145, 74, 41, '', 0.000, 121.258),
	(146, 75, 4, '', 213.000, 0.000),
	(147, 75, 38, '', 0.000, 3.018),
	(148, 75, 41, '', 0.000, 209.983),
	(149, 76, 5, '', 233.000, 0.000),
	(150, 76, 38, '', 0.000, 3.301),
	(151, 76, 41, '', 0.000, 229.699),
	(152, 77, 4, '', 233.000, 0.000),
	(153, 77, 38, '', 0.000, 3.301),
	(154, 77, 41, '', 0.000, 229.699),
	(155, 78, 5, '', 0.000, 250000.000),
	(156, 78, 14, '', 250000.000, 0.000),
	(157, 79, 5, '', 14166.670, 0.000),
	(158, 79, 38, '', 0.000, 212.500),
	(159, 79, 14, '', 0.000, 13954.170),
	(160, 80, 5, '', 14166.670, 0.000),
	(161, 80, 38, '', 0.000, 3750.001),
	(162, 80, 14, '', 0.000, 10416.669),
	(163, 81, 5, '', 42500.010, 0.000),
	(164, 81, 38, '', 0.000, 11250.003),
	(165, 81, 14, '', 0.000, 31250.007),
	(166, 98, 5, ' (Reverse Entry)', 250000.000, 0.000),
	(167, 98, 14, ' (Reverse Entry)', 0.000, 250000.000),
	(168, 101, 5, ' (Reverse Entry)', 250000.000, 0.000),
	(169, 101, 14, ' (Reverse Entry)', 0.000, 250000.000),
	(172, 102, 1, '', 123.000, 0.000),
	(173, 102, 5, '', 0.000, 123.000),
	(174, 103, 1, ' (Reverse Entry)', 0.000, 123.000),
	(175, 103, 5, ' (Reverse Entry)', 123.000, 0.000),
	(176, 104, 5, '', 15000.000, 0.000),
	(177, 104, 38, '', 0.000, 2288.136),
	(178, 104, 14, '', 0.000, 12711.864),
	(179, 105, 5, '', 3750.000, 0.000),
	(180, 105, 38, '', 0.000, 992.647),
	(181, 105, 14, '', 0.000, 2757.353),
	(182, 106, 4, '', 213.000, 0.000),
	(183, 106, 38, '', 0.000, 14.860),
	(184, 106, 14, '', 0.000, 198.140),
	(185, 107, 1, '', 10000.000, 0.000),
	(186, 107, 5, '', 0.000, 10000.000),
	(187, 108, 5, '', 2500.000, 0.000),
	(188, 108, 38, '', 0.000, 381.356),
	(189, 108, 14, '', 0.000, 2118.644),
	(190, 109, 4, '', 6000.000, 0.000),
	(191, 109, 38, '', 0.000, 915.254),
	(192, 109, 14, '', 0.000, 5084.746);
/*!40000 ALTER TABLE `tbl_journal_entry_details` ENABLE KEYS */;

-- Dumping structure for table lms_db.tbl_loans
CREATE TABLE IF NOT EXISTS `tbl_loans` (
  `loan_id` int(11) NOT NULL AUTO_INCREMENT,
  `reference_number` varchar(50) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL DEFAULT '0',
  `loan_type_id` int(11) NOT NULL DEFAULT '0',
  `loan_amount` decimal(12,3) NOT NULL DEFAULT '0.000',
  `service_fee` decimal(12,3) NOT NULL,
  `monthly_payment` decimal(12,3) NOT NULL,
  `loan_period` int(6) NOT NULL DEFAULT '0',
  `loan_interest` decimal(12,3) NOT NULL DEFAULT '0.000',
  `due_date` date NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'A' COMMENT 'P - Pending; A - Approved; R - Released; D - Denied; F- Fully paid',
  `loan_date` date NOT NULL,
  `main_loan_id` int(11) NOT NULL,
  `deduct_to_loan` int(1) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`loan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table lms_db.tbl_loans: ~6 rows (approximately)
/*!40000 ALTER TABLE `tbl_loans` DISABLE KEYS */;
INSERT INTO `tbl_loans` (`loan_id`, `reference_number`, `branch_id`, `client_id`, `loan_type_id`, `loan_amount`, `service_fee`, `monthly_payment`, `loan_period`, `loan_interest`, `due_date`, `status`, `loan_date`, `main_loan_id`, `deduct_to_loan`, `date_added`, `date_last_modified`, `user_id`) VALUES
	(7, 'LN-20230526084500', 1, 45, 4, 20000.000, 0.000, 0.000, 24, 17.000, '0000-00-00', 'F', '2023-05-26', 0, 0, '2023-05-26 14:46:04', '2023-06-16 14:35:01', 0),
	(9, 'LN-20230607033514', 1, 45, 1, 15000.000, 100.000, 1475.000, 12, 18.000, '0000-00-00', 'F', '2023-06-07', 0, 0, '2023-06-07 09:35:45', '2023-06-16 15:31:18', 0),
	(10, 'LN-20230607093348', 1, 45, 1, 25000.000, 5.000, 5375.000, 5, 18.000, '0000-00-00', 'R', '2023-06-07', 0, 0, '2023-06-07 15:34:22', '2023-06-13 09:21:43', 0),
	(11, 'LN-20230614025516', 1, 45, 1, 250000.000, 1000.000, 14166.670, 24, 18.000, '0000-00-00', 'R', '2023-06-14', 0, 0, '2023-06-14 08:55:36', '2023-06-14 08:57:28', 0),
	(12, 'LN-20230617032829', 1, 48, 1, 10000.000, 1000.000, 990.000, 12, 18.000, '0000-00-00', 'F', '2023-05-17', 0, 0, '2023-06-17 09:29:03', '2023-06-17 09:52:42', 0),
	(13, 'LN-20230617035458', 1, 50, 2, 25000.000, 200.000, 5354.170, 5, 17.000, '0000-00-00', 'A', '2023-03-09', 0, 0, '2023-06-17 09:55:29', '2023-06-17 09:55:29', 0);
/*!40000 ALTER TABLE `tbl_loans` ENABLE KEYS */;

-- Dumping structure for table lms_db.tbl_loan_types
CREATE TABLE IF NOT EXISTS `tbl_loan_types` (
  `loan_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `loan_type` varchar(50) DEFAULT NULL,
  `loan_type_interest` decimal(5,2) NOT NULL,
  `penalty_percentage` decimal(5,2) NOT NULL,
  `remarks` varchar(250) DEFAULT NULL,
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`loan_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table lms_db.tbl_loan_types: ~8 rows (approximately)
/*!40000 ALTER TABLE `tbl_loan_types` DISABLE KEYS */;
INSERT INTO `tbl_loan_types` (`loan_type_id`, `loan_type`, `loan_type_interest`, `penalty_percentage`, `remarks`, `date_added`, `date_last_modified`) VALUES
	(1, 'PENSION LOAN', 18.00, 0.00, 'Diminishing', '2023-04-09 22:12:49', '2023-05-07 18:14:05'),
	(2, 'SALARY LOAN', 17.00, 0.00, 'Diminishing', '2023-05-03 15:48:54', '2023-05-07 18:13:54'),
	(3, 'SALARY-PRIVATE LOAN', 18.00, 0.00, 'Diminishing', '2023-05-07 18:14:27', '2023-05-07 18:30:25'),
	(4, 'BONUS LOAN', 17.00, 0.00, 'Diminishing', '2023-05-07 18:30:50', '2023-05-07 18:30:50'),
	(5, 'REAL ESTATE MORTGAGE LOAN', 17.00, 0.00, 'Diminishing', '2023-05-07 18:33:35', '2023-05-07 18:35:01'),
	(6, 'CHATTEL MORTGAGE LOAN', 18.00, 0.00, 'Diminishing', '2023-05-07 18:33:49', '2023-05-07 18:35:06'),
	(7, 'BUSINESS LOAN', 18.00, 0.00, 'Diminishing', '2023-05-07 18:34:08', '2023-05-07 18:35:13'),
	(8, 'EMERGENCY LOAN', 18.00, 0.00, 'Advanced', '2023-05-07 18:34:20', '2023-05-07 18:34:34');
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table lms_db.tbl_suppliers: ~4 rows (approximately)
/*!40000 ALTER TABLE `tbl_suppliers` DISABLE KEYS */;
INSERT INTO `tbl_suppliers` (`supplier_id`, `supplier_name`, `supplier_address`, `supplier_contact_no`, `remarks`, `date_added`, `date_last_modified`) VALUES
	(2, 'Lao Chan Corp.', '', '033222', '', '2023-05-12 13:22:48', '2023-05-12 13:22:48'),
	(3, 'SUPPLIER NAME', 'dad', 'sd', 'asdasd', '2023-06-13 09:09:36', '2023-06-13 09:09:36'),
	(4, 'sad', 'asd', 'asd', 'add', '2023-06-13 09:09:36', '2023-06-13 09:09:36'),
	(5, 'asd', '', 'sad', '', '2023-06-13 09:09:37', '2023-06-13 09:09:37');
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
  `loan_id` int(11) NOT NULL,
  `voucher_no` varchar(50) NOT NULL,
  `description` text NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

-- Dumping data for table lms_db.tbl_vouchers: ~7 rows (approximately)
/*!40000 ALTER TABLE `tbl_vouchers` DISABLE KEYS */;
INSERT INTO `tbl_vouchers` (`voucher_id`, `reference_number`, `account_type`, `account_id`, `loan_id`, `voucher_no`, `description`, `check_number`, `ac_no`, `amount`, `voucher_date`, `status`, `user_id`, `journal_id`, `date_added`, `date_last_modified`) VALUES
	(26, 'CV-20230526055830', 'C', 45, 0, '213', 'TO RELEASE LOAN PROCEEDS FOR THE RENEWAL OF SHIELA', '213', '123', 200000.000, '2023-05-26', 'C', 1, 7, '2023-05-26 11:58:44', '2023-06-16 10:11:21'),
	(27, 'CV-20230613031804', 'C', 45, 9, '23', '213', '123', '12312', 323.000, '2023-06-13', 'F', 1, 7, '2023-06-13 09:18:27', '2023-06-16 10:22:25'),
	(28, 'CV-20230613032047', 'C', 45, 10, '2112', 'asds', '123', '123', 25000.000, '2023-06-13', 'F', 1, 7, '2023-06-13 09:21:22', '2023-06-16 10:22:23'),
	(29, 'CV-20230614025617', 'C', 45, 11, '2', 'sample', '250010', '000', 250000.000, '2023-06-14', 'C', 1, 7, '2023-06-14 08:56:53', '2023-06-16 10:49:35'),
	(30, 'CV-20230614053454', 'S', 2, 0, '324', '4', '34', '234', 3424.000, '2023-06-14', 'C', 1, 7, '2023-06-14 11:35:07', '2023-06-16 10:24:21'),
	(31, 'CV-20230616044947', 'S', 2, 0, '123', '123', '123', '13', 123.000, '2023-06-16', 'C', 1, 7, '2023-06-16 10:50:09', '2023-06-16 10:51:12'),
	(32, 'CV-20230617033109', 'C', 48, 12, '0003', 'sa', '000125', '00002411', 10000.000, '2023-06-17', 'F', 1, 7, '2023-06-17 09:31:43', '2023-06-17 09:32:01');
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
CREATE TRIGGER `finish_voucher` AFTER UPDATE ON `tbl_vouchers` FOR EACH ROW UPDATE tbl_journal_entries SET status = IF (NEW.status = 'F', 'F', 'S') WHERE cross_reference = NEW.reference_number AND OLD.status='S'//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
