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

-- Dumping structure for table lms_db.tbl_chart_of_accounts
CREATE TABLE IF NOT EXISTS `tbl_chart_of_accounts` (
  `chart_id` int(11) NOT NULL AUTO_INCREMENT,
  `chart_code` varchar(10) NOT NULL,
  `chart_name` varchar(30) NOT NULL,
  `journal_id` int(11) NOT NULL,
  `chart_type` varchar(1) NOT NULL COMMENT 'M - Main; S - Sub',
  `main_chart_id` int(11) DEFAULT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`chart_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table lms_db.tbl_chart_of_accounts: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbl_chart_of_accounts` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table lms_db.tbl_children: ~1 rows (approximately)
/*!40000 ALTER TABLE `tbl_children` DISABLE KEYS */;
INSERT INTO `tbl_children` (`child_id`, `client_id`, `child_name`, `child_sex`, `child_age`, `child_occupation`, `date_added`, `date_last_modified`) VALUES
	(5, 47, '3', 'Male', 3, '3', '2023-04-25 09:00:58', '2023-04-25 09:00:58');
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
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table lms_db.tbl_clients: ~2 rows (approximately)
/*!40000 ALTER TABLE `tbl_clients` DISABLE KEYS */;
INSERT INTO `tbl_clients` (`client_id`, `client_fname`, `client_mname`, `client_lname`, `client_name_extension`, `client_dob`, `client_contact_no`, `client_civil_status`, `client_address`, `client_address_status`, `client_res_cert_no`, `client_res_cert_issued_at`, `client_res_cert_date`, `client_employer`, `client_employer_address`, `client_employer_contact_no`, `client_emp_position`, `client_emp_income`, `client_emp_status`, `client_emp_length`, `client_prev_emp`, `client_spouse`, `client_spouse_address`, `client_spouse_res_cert_no`, `client_spouse_res_cert_issued_at`, `client_spouse_res_cert_date`, `client_spouse_employer`, `client_no_of_childred`, `client_no_of_child_dependent`, `client_no_of_child_college`, `client_no_of_child_hs`, `client_no_of_child_elem`, `client_soi`, `client_soi_by_whom`, `client_soi_monthly_income`, `client_credit_ref_name1`, `client_credit_ref_address1`, `client_credit_ref_name2`, `client_credit_ref_address2`, `client_credit_ref_name3`, `client_credit_ref_address3`, `client_approx_total_monthly_income`, `client_total_outstanding_obligation`, `client_business_name`, `client_business_address`, `client_business_tel_no`, `client_business_position`, `client_business_kind`, `client_business_length`, `client_business_capital_invested`, `client_business_type`, `insurance_id`, `client_insurance_amount`, `client_insurance_maturity`, `client_bank_transaction`, `client_unpaid_obligation`, `client_salary_withdrawal`, `client_paymaster_name`, `client_paymaster_residence`, `client_paymaster_res_cert_no`, `client_paymaster_res_cert_issued_at`, `client_paymaster_res_cert_date`, `client_paymaster_deduct_salary`, `client_paymaster_client_deduct_salary`, `client_paymaster_conformity`, `date_added`, `date_last_modified`) VALUES
	(45, 'Pepe', '', 'Smith', '', '2023-01-05', '021', 'Married', '0', 'Owned', '0', '0', '2023-04-24', '0', '0', '0', '0', -1.000, '0', 0, '0', '0', '0', '0', '0', '2023-04-24', '0', 0, 0, 0, 0, 0, '0', '0', 0.000, '0', '0', '0', '0', '0', '0', 0.000, 0.000, '0', '0', '0', '0', '0', 0, 0.000, 'Owner', 1, 4.000, 4, '4', 4.000, 'Weekly', '4', '4', '4', '4', '2023-04-24', 'No', 'Yes', 'Yes', '2023-04-24 15:09:21', '2023-04-24 15:11:24'),
	(46, '2', '2', '2', '2', '2023-04-24', '2', 'Single', '2', 'Owned', '2', '2', '2023-04-24', '2', '2', '2', '2', 2.000, '2', 2, '2', '', '', '', '', '0000-00-00', '', 0, 0, 0, 0, 0, '', '', 0.000, '', '', '', '', '', '', 0.000, 0.000, '', '', '', '', '', 0, 0.000, '', 0, 0.000, 0, '', 0.000, '', '', '', '', '', '0000-00-00', '', '', '', '2023-04-24 15:14:09', '2023-04-24 15:14:09'),
	(47, 'sa', 'a', 'a', '', '2017-01-12', '3', 'Married', '3', 'Owned', '3', '3', '2023-04-25', '2', '2', '2', '2', 2.000, '2', 2, '', '2', '3', '3', '3', '2023-04-25', '3', 2, 3, 2, 3, 2, '3', '3', 2.000, '3', '3', '3', '3', '3', '3', 3.000, 3.000, '3', '3', '3', '3', '3', 3, 3.000, 'Sole', 1, 3.000, 3, '3', 3.000, 'Weekly', '3', '3', '3', '3', '2023-04-25', 'Yes', 'Yes', 'No', '2023-04-25 08:59:53', '2023-04-25 09:00:39');
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table lms_db.tbl_collections: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbl_collections` DISABLE KEYS */;
INSERT INTO `tbl_collections` (`collection_id`, `reference_number`, `client_id`, `loan_id`, `amount`, `remarks`, `collection_date`, `status`, `user_id`, `date_added`, `date_last_modified`) VALUES
	(7, 'CL-20230502051105', 45, 3, 20.000, '', '2023-05-02', 'F', 1, '2023-05-02 11:11:12', '2023-05-02 11:11:12');
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
	(3, 'Beginning Balance', 'BB', '2023-05-02 13:37:29', '2023-05-02 13:37:29'),
	(4, 'Collection Receipts Journal', 'CRJ', '2023-05-02 13:37:48', '2023-05-02 13:37:48'),
	(5, 'Credit Card Journal', 'CCJ', '2023-05-02 13:38:04', '2023-05-02 13:38:04'),
	(6, 'Deposit Journal', 'DJ', '2023-05-02 13:38:15', '2023-05-02 13:38:15'),
	(7, 'Cash/Check Disbursement Journal', 'CDJ', '2023-05-02 13:38:30', '2023-05-02 13:38:30');
/*!40000 ALTER TABLE `tbl_journals` ENABLE KEYS */;

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table lms_db.tbl_loans: ~3 rows (approximately)
/*!40000 ALTER TABLE `tbl_loans` DISABLE KEYS */;
INSERT INTO `tbl_loans` (`loan_id`, `reference_number`, `client_id`, `loan_type_id`, `loan_amount`, `loan_period`, `loan_interest`, `due_date`, `status`, `loan_date`, `date_added`, `date_last_modified`) VALUES
	(3, 'LN-20230502050211', 45, 1, 100000.000, 12, 17.000, '0000-00-00', 'R', '2023-05-02', '2023-05-02 11:02:18', '2023-05-02 16:53:04'),
	(4, 'LN-20230503042518', 45, 1, 4.000, 2, 12.000, '0000-00-00', 'A', '2023-05-03', '2023-05-03 10:25:27', '2023-05-03 10:25:27'),
	(5, 'LN-20230503094828', 45, 2, 2.000, 2, 1.000, '0000-00-00', 'A', '2023-05-03', '2023-05-03 15:48:37', '2023-05-03 15:49:10');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table lms_db.tbl_loan_types: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbl_loan_types` DISABLE KEYS */;
INSERT INTO `tbl_loan_types` (`loan_type_id`, `loan_type`, `loan_type_interest`, `remarks`, `date_added`, `date_last_modified`) VALUES
	(1, 'short term loan', 12.00, '', '2023-04-09 22:12:49', '2023-04-11 10:22:37'),
	(2, 'Long term', 1.00, '', '2023-05-03 15:48:54', '2023-05-03 15:48:54');
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table lms_db.tbl_property_owned: ~1 rows (approximately)
/*!40000 ALTER TABLE `tbl_property_owned` DISABLE KEYS */;
INSERT INTO `tbl_property_owned` (`property_id`, `client_id`, `property_location`, `property_area`, `property_acquisition_cost`, `property_pres_market_val`, `property_improvement`, `date_added`, `date_last_modified`) VALUES
	(5, 47, '3', '3', 3.000, 3.000, '3', '2023-04-25 09:00:49', '2023-04-25 09:00:49');
/*!40000 ALTER TABLE `tbl_property_owned` ENABLE KEYS */;

-- Dumping structure for table lms_db.tbl_users
CREATE TABLE IF NOT EXISTS `tbl_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_fname` varchar(50) NOT NULL,
  `user_mname` varchar(50) NOT NULL,
  `user_lname` varchar(50) NOT NULL,
  `user_category` varchar(1) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table lms_db.tbl_users: ~2 rows (approximately)
/*!40000 ALTER TABLE `tbl_users` DISABLE KEYS */;
INSERT INTO `tbl_users` (`user_id`, `user_fname`, `user_mname`, `user_lname`, `user_category`, `username`, `password`, `date_added`, `date_last_modified`) VALUES
	(1, 'Juan', '', 'Dela Cruz', 'A', 'admin', '0cc175b9c0f1b6a831c399e269772661', '2023-04-09 20:44:25', '2023-04-09 20:45:02'),
	(2, 'd', 'k', 'k', 'A', 's', '03c7c0ace395d80182db07ae2c30f034', '2023-04-10 10:14:42', '2023-04-10 10:14:42');
/*!40000 ALTER TABLE `tbl_users` ENABLE KEYS */;

-- Dumping structure for trigger lms_db.delete_client
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `delete_client` AFTER DELETE ON `tbl_clients` FOR EACH ROW BEGIN
DELETE FROM tbl_children WHERE client_id = OLD.client_id;
DELETE FROM tbl_children WHERE client_id = OLD.client_id;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
