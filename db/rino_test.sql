-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.21-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             12.4.0.6659
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for lms_db
CREATE DATABASE IF NOT EXISTS `lms_db` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `lms_db`;

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
INSERT INTO `tbl_branches` (`branch_id`, `branch_name`, `remarks`, `date_added`, `date_last_modified`, `user_id`) VALUES
	(1, 'Bacolod', '', '2023-05-31 10:33:44', '2023-06-14 14:10:48', 0),
	(2, 'La Carlota', '', '2023-05-31 10:34:45', '2023-06-14 14:10:56', 0);

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
INSERT INTO `tbl_chart_classification` (`chart_class_id`, `chart_class_name`, `chart_class_code`, `date_added`, `date_last_modified`, `user_id`) VALUES
	(1, 'Current Asset', 'CA', '2023-05-17 13:41:16', '2023-05-17 13:41:16', 0),
	(2, 'Non Current Asset', 'NCA', '2023-05-17 13:41:25', '2023-05-17 13:41:25', 0),
	(3, 'Current Liabilities', 'CL', '2023-05-17 13:41:39', '2023-05-17 13:41:39', 0),
	(4, 'Equity', 'EQ', '2023-05-17 13:41:56', '2023-05-17 13:41:56', 0),
	(5, 'Revenue', 'REV', '2023-05-17 13:42:10', '2023-05-17 13:42:10', 0),
	(6, 'Cost & Expenses', 'CE', '2023-05-17 13:42:30', '2023-05-17 13:42:30', 0);

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
INSERT INTO `tbl_children` (`child_id`, `client_id`, `child_name`, `child_sex`, `child_age`, `child_occupation`, `date_added`, `date_last_modified`) VALUES
	(1, 2184, 'Cairo', 'Male', 5, 'N/A', '2023-06-07 11:11:28', '2023-06-07 11:11:28'),
	(8, 1, 'Hezekiah Cairo F. Carton', 'Male', 4, 'NA', '2023-06-09 11:53:01', '2023-06-09 11:53:01'),
	(9, 1, 'Hezekiah Chiara Flores Carton', 'Female', 1, 'NA', '2023-06-09 11:53:01', '2023-06-09 11:53:01');

-- Dumping structure for table lms_db.tbl_clients
CREATE TABLE IF NOT EXISTS `tbl_clients` (
  `client_id` int(11) NOT NULL AUTO_INCREMENT,
  `branch_id` int(11) NOT NULL,
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
  `client_no_of_children` int(3) NOT NULL DEFAULT '0',
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table lms_db.tbl_clients: ~2 rows (approximately)
INSERT INTO `tbl_clients` (`client_id`, `branch_id`, `client_fname`, `client_mname`, `client_lname`, `client_name_extension`, `client_dob`, `client_contact_no`, `client_civil_status`, `client_address`, `client_address_status`, `client_res_cert_no`, `client_res_cert_issued_at`, `client_res_cert_date`, `client_employer`, `client_employer_address`, `client_employer_contact_no`, `client_emp_position`, `client_emp_income`, `client_emp_status`, `client_emp_length`, `client_prev_emp`, `client_spouse`, `client_spouse_address`, `client_spouse_res_cert_no`, `client_spouse_res_cert_issued_at`, `client_spouse_res_cert_date`, `client_spouse_employer`, `client_spouce_employer_address`, `client_spouse_position`, `client_spouse_income`, `client_spouce_employer_contact_no`, `client_spouse_emp_status`, `client_spouse_leng_emp`, `client_spouse_prev_employment`, `client_no_of_children`, `client_no_of_child_dependent`, `client_no_of_child_college`, `client_no_of_child_hs`, `client_no_of_child_elem`, `client_soi`, `client_soi_by_whom`, `client_soi_monthly_income`, `client_credit_ref_name1`, `client_credit_ref_address1`, `client_credit_ref_name2`, `client_credit_ref_address2`, `client_credit_ref_name3`, `client_credit_ref_address3`, `client_approx_total_monthly_income`, `client_total_outstanding_obligation`, `client_business_name`, `client_business_address`, `client_business_tel_no`, `client_business_position`, `client_business_kind`, `client_business_length`, `client_business_capital_invested`, `client_business_type`, `insurance_id`, `client_insurance_amount`, `client_insurance_maturity`, `client_bank_transaction`, `client_unpaid_obligation`, `client_salary_withdrawal`, `client_paymaster_name`, `client_paymaster_residence`, `client_paymaster_res_cert_no`, `client_paymaster_res_cert_issued_at`, `client_paymaster_res_cert_date`, `client_paymaster_deduct_salary`, `client_paymaster_client_deduct_salary`, `client_paymaster_conformity`, `date_added`, `date_last_modified`) VALUES
	(1, 1, 'Eduard Rino', 'Questo', 'Carton', '', '1997-09-30', '9096836075', 'Married', 'Sagay City', 'Owned', '1', 'Sagay', '0000-00-00', 'JCIS', 'Bacolod', '123', 'Software Developer', 20000.000, 'Regular', 6, '', 'Meralyn Carton', 'Bago City', '2', 'Bago', '0000-00-00', 'BPFC', 'BC', 'Office Staff', '10000', '123546', 'Regular', '4', '', 2, 2, 0, 0, 0, 'Employment', 'Eduard Rino Carton', 20000.000, 'Judywen Guapin', 'Bacolod', 'Ginery Songaling', 'Pulupandan', 'Rafa Claveria', 'Sagay', 1000.000, 100.000, 'Zech Solutions', 'Bacolod', '123456789', 'Owner', 'IT', 2, 10000.000, 'Owner', 0, 500.000, 0, '', 0.000, '', '', '', '', '', '0000-00-00', 'No', 'No', 'No', '2023-06-09 15:33:26', '2023-06-09 15:33:26'),
	(2, 2, 'John Mark', 'G', 'Amar', 'Jr', '1995-06-08', '9999121511', 'Single', 'Cauayan', 'Rented', '2', 'Bacolod', '0000-00-00', 'BPFC', 'Bacolod', '456', 'Designer', 25000.000, 'Regular', 5, '', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, '', '', 0.000, 'Judywen Guapin', 'Bacolod', 'Ginery Songaling', 'Pulupandan', 'Rafa Claveria', 'Sagay', 1001.000, 101.000, 'NA', 'NA', 'NA', 'NA', 'NA', 0, 0.000, 'NA', 0, 800.000, 0, '', 0.000, '', '', '', '', '', '0000-00-00', 'Yes', 'Yes', 'Yes', '2023-06-09 15:33:26', '2023-06-13 09:25:28');

-- Dumping structure for table lms_db.tbl_client_atm
CREATE TABLE IF NOT EXISTS `tbl_client_atm` (
  `atm_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL DEFAULT '0',
  `atm_account_no` varchar(50) DEFAULT NULL,
  `atm_bank` varchar(50) DEFAULT NULL,
  `atm_balance` decimal(15,3) NOT NULL DEFAULT '0.000',
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`atm_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table lms_db.tbl_client_atm: ~0 rows (approximately)

-- Dumping structure for table lms_db.tbl_client_business
CREATE TABLE IF NOT EXISTS `tbl_client_business` (
  `business_id` int(11) NOT NULL AUTO_INCREMENT,
  `business_name` varchar(150) DEFAULT NULL,
  `business_address` varchar(150) DEFAULT NULL,
  `business_contact` varchar(50) DEFAULT NULL,
  `business_position` varchar(50) DEFAULT NULL,
  `business_kind` varchar(150) DEFAULT NULL,
  `business_length` varchar(50) DEFAULT NULL,
  `business_capital` decimal(15,3) DEFAULT NULL,
  `business_type` varchar(50) DEFAULT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`business_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table lms_db.tbl_client_business: ~0 rows (approximately)

-- Dumping structure for table lms_db.tbl_client_employment
CREATE TABLE IF NOT EXISTS `tbl_client_employment` (
  `employment_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL DEFAULT '0',
  `employer_id` int(11) NOT NULL DEFAULT '0',
  `employment_position` varchar(50) DEFAULT NULL,
  `employment_income` decimal(15,3) NOT NULL DEFAULT '0.000',
  `employment_status` varchar(15) DEFAULT NULL,
  `employment_length` varchar(15) NOT NULL DEFAULT '0',
  `last_employment` varchar(50) DEFAULT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`employment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table lms_db.tbl_client_employment: ~0 rows (approximately)

-- Dumping structure for table lms_db.tbl_client_insurance
CREATE TABLE IF NOT EXISTS `tbl_client_insurance` (
  `client_insurance_id` int(11) NOT NULL AUTO_INCREMENT,
  `insurance_id` int(11) NOT NULL DEFAULT '0',
  `insurance_amount` decimal(15,3) NOT NULL DEFAULT '0.000',
  `insurance_maturity` int(11) NOT NULL DEFAULT '0',
  `insurance_bank_transaction` varchar(50) DEFAULT NULL,
  `insurance_unpaid_obligation` decimal(15,3) DEFAULT NULL,
  `insurance_salary_withdrawal` varchar(50) DEFAULT NULL,
  `paymaster_name` varchar(150) DEFAULT NULL,
  `paymaster_address` varchar(150) DEFAULT NULL,
  `certificate_no` varchar(150) DEFAULT NULL,
  `certificate_issued_at` varchar(150) DEFAULT NULL,
  `certificate_date` date NOT NULL DEFAULT '0000-00-00',
  `paymaster_deduct_salary` varchar(3) DEFAULT NULL COMMENT 'Yes,No',
  `paymaster_client_deduct_salary` varchar(3) DEFAULT NULL COMMENT 'Yes,No',
  `paymaster_conformity` varchar(3) DEFAULT NULL COMMENT 'Yes,No',
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`client_insurance_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table lms_db.tbl_client_insurance: ~0 rows (approximately)

-- Dumping structure for table lms_db.tbl_client_reference
CREATE TABLE IF NOT EXISTS `tbl_client_reference` (
  `reference_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL DEFAULT '0',
  `reference_name` varchar(150) DEFAULT NULL,
  `reference_address` varchar(150) DEFAULT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`reference_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table lms_db.tbl_client_reference: ~0 rows (approximately)

-- Dumping structure for table lms_db.tbl_client_residence
CREATE TABLE IF NOT EXISTS `tbl_client_residence` (
  `residence_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `residence` text,
  `residence_status` varchar(15) NOT NULL COMMENT 'Owned,Rented, Free of use',
  `residence_certificate_no` varchar(50) NOT NULL,
  `certificate_issued_at` varchar(150) NOT NULL,
  `certificate_date` date NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`residence_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table lms_db.tbl_client_residence: ~0 rows (approximately)

-- Dumping structure for table lms_db.tbl_client_spouse
CREATE TABLE IF NOT EXISTS `tbl_client_spouse` (
  `spouse_id` int(11) NOT NULL AUTO_INCREMENT,
  `spouse_name` varchar(50) DEFAULT NULL,
  `spouse_residence` varchar(150) DEFAULT NULL,
  `certificate_no` varchar(50) DEFAULT NULL,
  `certificate_issued_at` varchar(150) DEFAULT NULL,
  `certificate_date` date NOT NULL DEFAULT '0000-00-00',
  `spouse_employer` varchar(150) DEFAULT NULL,
  `spouse_employer_address` varchar(150) DEFAULT NULL,
  `spouse_employer_contact` varchar(50) DEFAULT NULL,
  `spouse_employment_status` varchar(10) DEFAULT NULL,
  `spouse_employment_length` varchar(10) DEFAULT NULL,
  `spouse_employment_income` decimal(15,3) DEFAULT NULL,
  `spouse_last_employment` varchar(50) DEFAULT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`spouse_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table lms_db.tbl_client_spouse: ~0 rows (approximately)

-- Dumping structure for table lms_db.tbl_client_types
CREATE TABLE IF NOT EXISTS `tbl_client_types` (
  `client_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_type` varchar(50) NOT NULL,
  `remarks` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`client_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table lms_db.tbl_client_types: ~1 rows (approximately)
INSERT INTO `tbl_client_types` (`client_type_id`, `client_type`, `remarks`, `user_id`, `date_added`, `date_last_modified`) VALUES
	(1, 'Pension', '', 1, '2023-06-15 09:04:44', '0000-00-00 00:00:00');

-- Dumping structure for table lms_db.tbl_collections
CREATE TABLE IF NOT EXISTS `tbl_collections` (
  `collection_id` int(11) NOT NULL AUTO_INCREMENT,
  `reference_number` varchar(30) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `loan_id` int(11) DEFAULT NULL,
  `amount` decimal(12,3) DEFAULT NULL,
  `penalty_amount` decimal(12,3) DEFAULT NULL,
  `interest` decimal(12,3) DEFAULT NULL,
  `remarks` varchar(250) DEFAULT NULL,
  `collection_date` date NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'F' COMMENT 'P - Pending ; F - Finished',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `chart_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`collection_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table lms_db.tbl_collections: ~1 rows (approximately)
INSERT INTO `tbl_collections` (`collection_id`, `reference_number`, `branch_id`, `client_id`, `loan_id`, `amount`, `penalty_amount`, `interest`, `remarks`, `collection_date`, `status`, `user_id`, `chart_id`, `date_added`, `date_last_modified`) VALUES
	(1, 'CL-202306151', 1, 1, 1, 838.000, 0.000, 212.627, '', '2023-06-15', 'F', 1, 5, '2023-06-15 10:06:11', '2023-06-15 10:06:11');

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

-- Dumping structure for table lms_db.tbl_employers
CREATE TABLE IF NOT EXISTS `tbl_employers` (
  `employer_id` int(11) NOT NULL AUTO_INCREMENT,
  `employer_name` varchar(150) DEFAULT NULL,
  `employer_address` varchar(255) DEFAULT NULL,
  `employer_contact_no` varchar(50) DEFAULT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`employer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table lms_db.tbl_employers: ~0 rows (approximately)
INSERT INTO `tbl_employers` (`employer_id`, `employer_name`, `employer_address`, `employer_contact_no`, `date_added`, `date_last_modified`) VALUES
	(1, 'CHMSC - Alijis', 'Alijis', '09096836075', '2023-06-15 16:35:11', '2023-06-15 16:41:21'),
	(3, 'saasd', 'a', 'asdas', '2023-06-15 16:37:05', '2023-06-15 16:41:12');

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
  `branch_id` int(11) NOT NULL,
  PRIMARY KEY (`expense_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table lms_db.tbl_expenses: ~0 rows (approximately)
INSERT INTO `tbl_expenses` (`expense_id`, `reference_number`, `expense_date`, `remarks`, `date_added`, `date_last_modified`, `journal_id`, `status`, `user_id`, `credit_method`, `branch_id`) VALUES
	(1, 'EXP-20230601000001', '2023-06-01', 'For test purposes only', '2023-06-14 15:45:15', '2023-06-14 15:45:15', 3, 'F', 1, 4, 1);

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
INSERT INTO `tbl_expense_category` (`expense_category_id`, `expense_category`, `remarks`, `date_added`, `date_last_modified`) VALUES
	(2, 'Operating Expenses', '', '2023-05-23 21:45:06', '2023-05-23 21:45:06'),
	(3, 'Non-operating Expenses', '', '2023-05-24 09:45:12', '2023-05-24 09:45:12');

-- Dumping structure for table lms_db.tbl_expense_details
CREATE TABLE IF NOT EXISTS `tbl_expense_details` (
  `expense_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `expense_id` int(11) NOT NULL,
  `chart_id` int(11) NOT NULL,
  `expense_category_id` int(11) NOT NULL,
  `expense_amount` decimal(12,3) NOT NULL,
  `expense_desc` varchar(250) NOT NULL,
  PRIMARY KEY (`expense_detail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table lms_db.tbl_expense_details: ~7 rows (approximately)
INSERT INTO `tbl_expense_details` (`expense_detail_id`, `expense_id`, `chart_id`, `expense_category_id`, `expense_amount`, `expense_desc`) VALUES
	(1, 1, 12, 0, 1975.750, 'Test Description'),
	(2, 1, 12, 0, 1975.750, 'Test Description'),
	(3, 1, 12, 0, 1975.750, 'Test Description'),
	(4, 1, 12, 0, 1975.750, 'Test Description'),
	(5, 1, 12, 0, 1975.750, 'Test Description'),
	(6, 1, 12, 0, 1975.750, 'Test Description'),
	(7, 1, 12, 0, 1975.750, 'Test Description');

-- Dumping structure for table lms_db.tbl_insurance
CREATE TABLE IF NOT EXISTS `tbl_insurance` (
  `insurance_id` int(11) NOT NULL AUTO_INCREMENT,
  `insurance_name` varchar(50) NOT NULL,
  `insurance_desc` varchar(250) NOT NULL,
  `insurance_amount` decimal(12,3) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_last_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`insurance_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

-- Dumping data for table lms_db.tbl_insurance: ~30 rows (approximately)
INSERT INTO `tbl_insurance` (`insurance_id`, `insurance_name`, `insurance_desc`, `insurance_amount`, `date_added`, `date_last_modified`) VALUES
	(1, 'Insurance 1', 'ABC', 1000.000, '2023-06-09 14:35:51', '2023-06-09 14:35:51'),
	(2, 'Insurance 2', 'CDE', 1010.000, '2023-06-09 14:35:51', '2023-06-09 14:35:51'),
	(3, 'Insurance 3', 'ABC', 1020.000, '2023-06-09 14:35:51', '2023-06-09 14:35:51'),
	(4, 'Insurance 4', 'CDE', 1030.000, '2023-06-09 14:35:51', '2023-06-09 14:35:51'),
	(5, 'Insurance 5', 'ABC', 1040.000, '2023-06-09 14:35:51', '2023-06-09 14:35:51'),
	(6, 'Insurance 6', 'CDE', 1050.000, '2023-06-09 14:35:51', '2023-06-09 14:35:51'),
	(7, 'Insurance 7', 'ABC', 1060.000, '2023-06-09 14:35:51', '2023-06-09 14:35:51'),
	(8, 'Insurance 8', 'CDE', 1070.000, '2023-06-09 14:35:51', '2023-06-09 14:35:51'),
	(9, 'Insurance 9', 'ABC', 1080.000, '2023-06-09 14:35:51', '2023-06-09 14:35:51'),
	(10, 'Insurance 10', 'CDE', 1090.000, '2023-06-09 14:35:51', '2023-06-09 14:35:51'),
	(11, 'Insurance 11', 'ABC', 1100.000, '2023-06-09 14:35:51', '2023-06-09 14:35:51'),
	(12, 'Insurance 12', 'CDE', 1110.000, '2023-06-09 14:35:51', '2023-06-09 14:35:51'),
	(13, 'Insurance 13', 'ABC', 1120.000, '2023-06-09 14:35:51', '2023-06-09 14:35:51'),
	(14, 'Insurance 14', 'CDE', 1130.000, '2023-06-09 14:35:51', '2023-06-09 14:35:51'),
	(15, 'Insurance 15', 'ABC', 1140.000, '2023-06-09 14:35:51', '2023-06-09 14:35:51'),
	(16, 'Insurance 16', 'CDE', 1150.000, '2023-06-09 14:35:51', '2023-06-09 14:35:51'),
	(17, 'Insurance 17', 'ABC', 1160.000, '2023-06-09 14:35:51', '2023-06-09 14:35:51'),
	(18, 'Insurance 18', 'CDE', 1170.000, '2023-06-09 14:35:51', '2023-06-09 14:35:51'),
	(19, 'Insurance 19', 'ABC', 1180.000, '2023-06-09 14:35:51', '2023-06-09 14:35:51'),
	(20, 'Insurance 20', 'CDE', 1190.000, '2023-06-09 14:35:51', '2023-06-09 14:35:51'),
	(21, 'Insurance 21', 'ABC', 1200.000, '2023-06-09 14:35:51', '2023-06-09 14:35:51'),
	(22, 'Insurance 22', 'CDE', 1210.000, '2023-06-09 14:35:51', '2023-06-09 14:35:51'),
	(23, 'Insurance 23', 'ABC', 1220.000, '2023-06-09 14:35:51', '2023-06-09 14:35:51'),
	(24, 'Insurance 24', 'CDE', 1230.000, '2023-06-09 14:35:51', '2023-06-09 14:35:51'),
	(25, 'Insurance 25', 'ABC', 1240.000, '2023-06-09 14:35:51', '2023-06-09 14:35:51'),
	(26, 'Insurance 26', 'CDE', 1250.000, '2023-06-09 14:35:51', '2023-06-09 14:35:51'),
	(27, 'Insurance 27', 'ABC', 1260.000, '2023-06-09 14:35:51', '2023-06-09 14:35:51'),
	(28, 'Insurance 28', 'CDE', 1270.000, '2023-06-09 14:35:51', '2023-06-09 14:35:51'),
	(29, 'Insurance 29', 'ABC', 1280.000, '2023-06-09 14:35:51', '2023-06-09 14:35:51'),
	(30, 'Insurance 30', 'CDE', 1290.000, '2023-06-09 14:35:51', '2023-06-09 14:35:51');

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
INSERT INTO `tbl_journals` (`journal_id`, `journal_name`, `journal_code`, `date_added`, `date_last_modified`) VALUES
	(3, 'Beginning Balance', 'BBJ', '2023-05-02 13:37:29', '2023-05-12 08:33:00'),
	(4, 'Collection Receipts Journal', 'CRJ', '2023-05-02 13:37:48', '2023-05-02 13:37:48'),
	(5, 'Credit Card Journal', 'CCJ', '2023-05-02 13:38:04', '2023-05-02 13:38:04'),
	(6, 'Deposit Journal', 'DJ', '2023-05-02 13:38:15', '2023-05-02 13:38:15'),
	(7, 'Cash/Check Disbursement Journal', 'CDJ', '2023-05-02 13:38:30', '2023-05-02 13:38:30');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table lms_db.tbl_journal_entries: ~1 rows (approximately)
INSERT INTO `tbl_journal_entries` (`journal_entry_id`, `reference_number`, `cross_reference`, `journal_id`, `remarks`, `journal_date`, `user_id`, `status`, `date_added`, `date_last_modified`, `is_manual`) VALUES
	(1, 'CRJ-20230615040611', 'CL-202306151', 4, '', '2023-06-15', 1, 'F', '2023-06-15 10:06:11', '2023-06-15 10:06:11', 'N');

-- Dumping structure for table lms_db.tbl_journal_entry_details
CREATE TABLE IF NOT EXISTS `tbl_journal_entry_details` (
  `journal_entry_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `journal_entry_id` int(11) NOT NULL DEFAULT '0',
  `chart_id` int(11) NOT NULL DEFAULT '0',
  `description` varchar(250) NOT NULL,
  `debit` decimal(12,3) NOT NULL DEFAULT '0.000',
  `credit` decimal(12,3) NOT NULL DEFAULT '0.000',
  PRIMARY KEY (`journal_entry_detail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table lms_db.tbl_journal_entry_details: ~3 rows (approximately)
INSERT INTO `tbl_journal_entry_details` (`journal_entry_detail_id`, `journal_entry_id`, `chart_id`, `description`, `debit`, `credit`) VALUES
	(1, 1, 5, '', 838.000, 0.000),
	(2, 1, 38, '', 0.000, 212.627),
	(3, 1, 17, '', 0.000, 625.373);

-- Dumping structure for table lms_db.tbl_loans
CREATE TABLE IF NOT EXISTS `tbl_loans` (
  `loan_id` int(11) NOT NULL AUTO_INCREMENT,
  `reference_number` varchar(50) NOT NULL,
  `branch_id` int(11) NOT NULL,
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
  `service_fee` decimal(12,3) NOT NULL,
  `monthly_payment` decimal(12,3) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`loan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table lms_db.tbl_loans: ~0 rows (approximately)
INSERT INTO `tbl_loans` (`loan_id`, `reference_number`, `branch_id`, `client_id`, `loan_type_id`, `loan_amount`, `loan_period`, `loan_interest`, `due_date`, `status`, `loan_date`, `date_added`, `date_last_modified`, `service_fee`, `monthly_payment`, `user_id`) VALUES
	(1, 'LN-20230613102357', 1, 1, 2, 15000.000, 24, 17.000, '0000-00-00', 'R', '2023-06-13', '2023-06-13 16:24:20', '2023-06-14 13:50:09', 10.000, 838.000, 0);

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
INSERT INTO `tbl_loan_types` (`loan_type_id`, `loan_type`, `loan_type_interest`, `penalty_percentage`, `remarks`, `date_added`, `date_last_modified`) VALUES
	(1, 'PENSION LOAN', 18.00, 0.00, 'Diminishing', '2023-04-09 22:12:49', '2023-05-07 18:14:05'),
	(2, 'SALARY LOAN', 17.00, 0.00, 'Diminishing', '2023-05-03 15:48:54', '2023-05-07 18:13:54'),
	(3, 'SALARY-PRIVATE LOAN', 18.00, 0.00, 'Diminishing', '2023-05-07 18:14:27', '2023-05-07 18:30:25'),
	(4, 'BONUS LOAN', 17.00, 0.00, 'Diminishing', '2023-05-07 18:30:50', '2023-05-07 18:30:50'),
	(5, 'REAL ESTATE MORTGAGE LOAN', 17.00, 0.00, 'Diminishing', '2023-05-07 18:33:35', '2023-05-07 18:35:01'),
	(6, 'CHATTEL MORTGAGE LOAN', 18.00, 0.00, 'Diminishing', '2023-05-07 18:33:49', '2023-05-07 18:35:06'),
	(7, 'BUSINESS LOAN', 18.00, 0.00, 'Diminishing', '2023-05-07 18:34:08', '2023-05-07 18:35:13'),
	(8, 'EMERGENCY LOAN', 18.00, 0.00, 'Advanced', '2023-05-07 18:34:20', '2023-05-07 18:34:34');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table lms_db.tbl_property_owned: ~2 rows (approximately)
INSERT INTO `tbl_property_owned` (`property_id`, `client_id`, `property_location`, `property_area`, `property_acquisition_cost`, `property_pres_market_val`, `property_improvement`, `date_added`, `date_last_modified`) VALUES
	(1, 10, 'Easthomes', '60', 610000.000, 1000000.000, '50000', '2023-06-09 10:41:15', '2023-06-09 10:41:15'),
	(2, 13, 'Woodside 1', '100', 100.000, 100.000, '100', '2023-06-09 11:38:58', '2023-06-09 11:38:58');

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
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=latin1;

-- Dumping data for table lms_db.tbl_suppliers: ~100 rows (approximately)
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
INSERT INTO `tbl_users` (`user_id`, `user_fname`, `user_mname`, `user_lname`, `user_category_id`, `user_category`, `username`, `password`, `date_added`, `date_last_modified`) VALUES
	(1, 'Juan', '', 'Dela Cruz', 1, 'A', 'admin', '0cc175b9c0f1b6a831c399e269772661', '2023-04-09 20:44:25', '2023-05-16 08:25:02'),
	(2, 'd', 'k', 'k', 2, 'S', 's', '03c7c0ace395d80182db07ae2c30f034', '2023-04-10 10:14:42', '2023-05-16 08:25:10'),
	(3, 'kaye', 'kaye', 'kaye', 3, '', 'a', '0cc175b9c0f1b6a831c399e269772661', '2023-05-16 09:00:48', '2023-05-16 09:00:48');

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
INSERT INTO `tbl_user_categories` (`user_category_id`, `user_category_name`, `remarks`, `is_preset`, `date_added`, `date_last_modified`) VALUES
	(1, 'Admin', '', 'Y', '2023-05-15 22:08:46', '2023-05-15 22:15:00'),
	(2, 'Accounting Staff', '', '', '2023-05-15 22:01:23', '2023-05-15 22:01:23'),
	(3, 'Encoder', '', '', '2023-05-16 08:50:52', '2023-05-16 08:50:52');

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
  `loan_id` int(11) NOT NULL,
  PRIMARY KEY (`voucher_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table lms_db.tbl_vouchers: ~0 rows (approximately)

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

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
