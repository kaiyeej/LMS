-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.11-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table lms_db.tbl_chart_classification
CREATE TABLE IF NOT EXISTS `tbl_chart_classification` (
  `chart_class_id` int(11) NOT NULL AUTO_INCREMENT,
  `chart_class_name` varchar(50) NOT NULL,
  `chart_class_code` varchar(10) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_last_modified` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
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
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_last_modified` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`chart_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

-- Dumping data for table lms_db.tbl_chart_of_accounts: ~26 rows (approximately)
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

-- Dumping structure for table lms_db.tbl_children
CREATE TABLE IF NOT EXISTS `tbl_children` (
  `child_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `child_name` varchar(150) NOT NULL,
  `child_sex` varchar(10) NOT NULL,
  `child_age` int(11) NOT NULL,
  `child_occupation` varchar(50) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_last_modified` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`child_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table lms_db.tbl_children: ~2 rows (approximately)
INSERT INTO `tbl_children` (`child_id`, `client_id`, `child_name`, `child_sex`, `child_age`, `child_occupation`, `date_added`, `date_last_modified`) VALUES
	(5, 47, '3', 'Male', 3, '3', '2023-04-25 09:00:58', '2023-04-25 09:00:58'),
	(6, 45, 'q2', 'Male', 2, '2', '2023-05-09 21:01:32', '2023-05-09 21:01:32');

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
  `client_emp_income` decimal(12,3) NOT NULL DEFAULT 0.000,
  `client_emp_status` varchar(15) NOT NULL,
  `client_emp_length` int(2) NOT NULL DEFAULT 0,
  `client_prev_emp` varchar(50) NOT NULL,
  `client_spouse` varchar(50) NOT NULL,
  `client_spouse_address` varchar(250) NOT NULL,
  `client_spouse_res_cert_no` varchar(50) NOT NULL,
  `client_spouse_res_cert_issued_at` varchar(50) NOT NULL,
  `client_spouse_res_cert_date` date NOT NULL,
  `client_spouse_employer` varchar(50) NOT NULL DEFAULT '',
  `client_no_of_childred` int(3) NOT NULL DEFAULT 0,
  `client_no_of_child_dependent` int(3) NOT NULL DEFAULT 0,
  `client_no_of_child_college` int(3) NOT NULL DEFAULT 0,
  `client_no_of_child_hs` int(3) NOT NULL DEFAULT 0,
  `client_no_of_child_elem` int(3) NOT NULL DEFAULT 0,
  `client_soi` varchar(50) NOT NULL COMMENT 'source of income',
  `client_soi_by_whom` varchar(50) NOT NULL,
  `client_soi_monthly_income` decimal(12,3) NOT NULL DEFAULT 0.000,
  `client_credit_ref_name1` varchar(50) NOT NULL,
  `client_credit_ref_address1` varchar(250) NOT NULL,
  `client_credit_ref_name2` varchar(50) NOT NULL,
  `client_credit_ref_address2` varchar(250) NOT NULL,
  `client_credit_ref_name3` varchar(50) NOT NULL,
  `client_credit_ref_address3` varchar(250) NOT NULL,
  `client_approx_total_monthly_income` decimal(12,3) NOT NULL DEFAULT 0.000,
  `client_total_outstanding_obligation` decimal(12,3) NOT NULL DEFAULT 0.000,
  `client_business_name` varchar(50) NOT NULL,
  `client_business_address` varchar(250) NOT NULL,
  `client_business_tel_no` varchar(15) NOT NULL,
  `client_business_position` varchar(50) NOT NULL,
  `client_business_kind` varchar(50) NOT NULL,
  `client_business_length` int(3) NOT NULL DEFAULT 0,
  `client_business_capital_invested` decimal(12,3) NOT NULL DEFAULT 0.000,
  `client_business_type` varchar(50) NOT NULL COMMENT 'Sole; Owner; Partner',
  `insurance_id` int(11) NOT NULL DEFAULT 0,
  `client_insurance_amount` decimal(12,3) NOT NULL DEFAULT 0.000,
  `client_insurance_maturity` int(11) NOT NULL DEFAULT 0,
  `client_bank_transaction` varchar(50) NOT NULL,
  `client_unpaid_obligation` decimal(12,3) NOT NULL DEFAULT 0.000,
  `client_salary_withdrawal` varchar(20) NOT NULL,
  `client_paymaster_name` varchar(150) NOT NULL,
  `client_paymaster_residence` varchar(250) NOT NULL,
  `client_paymaster_res_cert_no` varchar(50) NOT NULL,
  `client_paymaster_res_cert_issued_at` varchar(50) NOT NULL,
  `client_paymaster_res_cert_date` date NOT NULL,
  `client_paymaster_deduct_salary` varchar(3) NOT NULL COMMENT 'Yes or No',
  `client_paymaster_client_deduct_salary` varchar(3) NOT NULL COMMENT 'Yes or No',
  `client_paymaster_conformity` varchar(3) NOT NULL COMMENT 'Yes or No',
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_last_modified` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table lms_db.tbl_clients: ~3 rows (approximately)
INSERT INTO `tbl_clients` (`client_id`, `client_fname`, `client_mname`, `client_lname`, `client_name_extension`, `client_dob`, `client_contact_no`, `client_civil_status`, `client_address`, `client_address_status`, `client_res_cert_no`, `client_res_cert_issued_at`, `client_res_cert_date`, `client_employer`, `client_employer_address`, `client_employer_contact_no`, `client_emp_position`, `client_emp_income`, `client_emp_status`, `client_emp_length`, `client_prev_emp`, `client_spouse`, `client_spouse_address`, `client_spouse_res_cert_no`, `client_spouse_res_cert_issued_at`, `client_spouse_res_cert_date`, `client_spouse_employer`, `client_no_of_childred`, `client_no_of_child_dependent`, `client_no_of_child_college`, `client_no_of_child_hs`, `client_no_of_child_elem`, `client_soi`, `client_soi_by_whom`, `client_soi_monthly_income`, `client_credit_ref_name1`, `client_credit_ref_address1`, `client_credit_ref_name2`, `client_credit_ref_address2`, `client_credit_ref_name3`, `client_credit_ref_address3`, `client_approx_total_monthly_income`, `client_total_outstanding_obligation`, `client_business_name`, `client_business_address`, `client_business_tel_no`, `client_business_position`, `client_business_kind`, `client_business_length`, `client_business_capital_invested`, `client_business_type`, `insurance_id`, `client_insurance_amount`, `client_insurance_maturity`, `client_bank_transaction`, `client_unpaid_obligation`, `client_salary_withdrawal`, `client_paymaster_name`, `client_paymaster_residence`, `client_paymaster_res_cert_no`, `client_paymaster_res_cert_issued_at`, `client_paymaster_res_cert_date`, `client_paymaster_deduct_salary`, `client_paymaster_client_deduct_salary`, `client_paymaster_conformity`, `date_added`, `date_last_modified`) VALUES
	(45, 'Pepe', '', 'Smith', '', '2023-01-05', '021', 'Married', 'Purok Samuel, Barangay Zone 4, Bago City Negros Occidental', 'Owned', '0', '0', '2023-04-24', '0', '0', '0', '0', -1.000, '0', 0, '0', '0', '0', '0', '0', '2023-04-24', '0', 0, 0, 0, 0, 0, '0', '0', 0.000, '0', '0', '0', '0', '0', '0', 0.000, 0.000, '0', '0', '0', '0', '0', 0, 0.000, 'Owner', 1, 4.000, 4, '4', 4.000, 'Weekly', '4', '4', '4', '4', '2023-04-24', 'No', 'Yes', 'Yes', '2023-04-24 15:09:21', '2023-05-05 21:39:46'),
	(46, '2', '2', '2', '2', '2023-04-24', '2', 'Single', 'Purok Samuel, Barangay Zone 4, Bago City Negros Occidental', 'Owned', '2', '2', '2023-04-24', '2', '2', '2', '2', 2.000, '2', 2, '2', '', '', '', '', '0000-00-00', '', 0, 0, 0, 0, 0, '', '', 0.000, '', '', '', '', '', '', 0.000, 0.000, '', '', '', '', '', 0, 0.000, '', 0, 0.000, 0, '', 0.000, '', '', '', '', '', '0000-00-00', '', '', '', '2023-04-24 15:14:09', '2023-05-05 21:39:51'),
	(47, 'sa', 'a', 'a', '', '2017-01-12', '3', 'Married', 'Purok Samuel, Barangay Zone 4, Bago City Negros Occidental', 'Owned', '3', '3', '2023-04-25', '2', '2', '2', '2', 2.000, '2', 2, '', '2', '3', '3', '3', '2023-04-25', '3', 2, 3, 2, 3, 2, '3', '3', 2.000, '3', '3', '3', '3', '3', '3', 3.000, 3.000, '3', '3', '3', '3', '3', 3, 3.000, 'Sole', 1, 3.000, 3, '3', 3.000, 'Weekly', '3', '3', '3', '3', '2023-04-25', 'Yes', 'Yes', 'No', '2023-04-25 08:59:53', '2023-05-05 21:39:57');

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
  `user_id` int(11) NOT NULL DEFAULT 0,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_last_modified` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`collection_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table lms_db.tbl_collections: ~3 rows (approximately)
INSERT INTO `tbl_collections` (`collection_id`, `reference_number`, `client_id`, `loan_id`, `amount`, `remarks`, `collection_date`, `status`, `user_id`, `date_added`, `date_last_modified`) VALUES
	(7, 'CL-20230502051105', 45, 3, 20.000, '', '2023-06-01', 'F', 1, '2023-05-02 11:11:12', '2023-05-11 18:57:16'),
	(8, 'CL-20230505044052', 45, 3, 23.000, '', '2023-06-01', 'F', 1, '2023-05-05 10:40:58', '2023-05-11 18:57:23'),
	(9, 'CL-20230511130337', 45, 3, 1000.000, '', '2023-07-11', 'F', 1, '2023-05-11 19:03:52', '2023-05-11 19:03:52');

-- Dumping structure for table lms_db.tbl_comakers
CREATE TABLE IF NOT EXISTS `tbl_comakers` (
  `comaker_id` int(11) NOT NULL AUTO_INCREMENT,
  `loan_id` int(11) DEFAULT 0,
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

-- Dumping structure for table lms_db.tbl_expenses
CREATE TABLE IF NOT EXISTS `tbl_expenses` (
  `expense_id` int(11) NOT NULL AUTO_INCREMENT,
  `reference_number` varchar(50) NOT NULL,
  `expense_date` date NOT NULL,
  `remarks` varchar(250) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_last_modified` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `journal_id` int(11) NOT NULL,
  `status` varchar(1) NOT NULL,
  `user_id` int(11) NOT NULL,
  `credit_method` int(11) NOT NULL,
  PRIMARY KEY (`expense_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table lms_db.tbl_expenses: ~0 rows (approximately)

-- Dumping structure for table lms_db.tbl_expense_category
CREATE TABLE IF NOT EXISTS `tbl_expense_category` (
  `expense_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `expense_category` varchar(50) NOT NULL,
  `remarks` varchar(250) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_last_modified` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`expense_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table lms_db.tbl_expense_category: ~1 rows (approximately)
INSERT INTO `tbl_expense_category` (`expense_category_id`, `expense_category`, `remarks`, `date_added`, `date_last_modified`) VALUES
	(2, 'Rentals', '', '2023-05-23 21:45:06', '2023-05-23 21:45:06');

-- Dumping structure for table lms_db.tbl_expense_details
CREATE TABLE IF NOT EXISTS `tbl_expense_details` (
  `expense_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `expense_id` int(11) NOT NULL,
  `chart_id` int(11) NOT NULL,
  `expense_amount` decimal(12,3) NOT NULL,
  `expense_desc` varchar(250) NOT NULL,
  PRIMARY KEY (`expense_detail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table lms_db.tbl_expense_details: ~0 rows (approximately)

-- Dumping structure for table lms_db.tbl_insurance
CREATE TABLE IF NOT EXISTS `tbl_insurance` (
  `insurance_id` int(11) NOT NULL AUTO_INCREMENT,
  `insurance_name` varchar(50) NOT NULL,
  `insurance_desc` varchar(250) NOT NULL,
  `insurance_amount` decimal(12,3) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_last_modified` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`insurance_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table lms_db.tbl_insurance: ~2 rows (approximately)
INSERT INTO `tbl_insurance` (`insurance_id`, `insurance_name`, `insurance_desc`, `insurance_amount`, `date_added`, `date_last_modified`) VALUES
	(1, 'Insurance Sample', 'sample only', 1000.000, '2023-04-16 16:48:11', '2023-04-16 16:50:24'),
	(2, 'Insurance 002', 'a', 1202.000, '2023-04-16 16:49:23', '2023-04-16 16:51:03');

-- Dumping structure for table lms_db.tbl_journals
CREATE TABLE IF NOT EXISTS `tbl_journals` (
  `journal_id` int(11) NOT NULL AUTO_INCREMENT,
  `journal_name` varchar(50) NOT NULL,
  `journal_code` varchar(10) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_last_modified` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
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
  `date_added` datetime DEFAULT current_timestamp(),
  `date_last_modified` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_manual` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`journal_entry_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

-- Dumping data for table lms_db.tbl_journal_entries: ~3 rows (approximately)
INSERT INTO `tbl_journal_entries` (`journal_entry_id`, `reference_number`, `cross_reference`, `journal_id`, `remarks`, `journal_date`, `user_id`, `status`, `date_added`, `date_last_modified`, `is_manual`) VALUES
	(30, 'BBJ-20230516084133', '20000dsad', 3, '', '2023-05-16', 1, 'F', '2023-05-16 14:41:42', '2023-05-16 14:42:15', 'Y'),
	(31, 'CDJ-20230516084245', 'CV-20230516084230', 7, '324', '2023-05-09', 1, 'F', '2023-05-16 14:42:45', '2023-05-16 14:43:18', 'N'),
	(32, 'BBJ-20230518103549', '23434', 3, 'Purchase Qwerty', '2023-05-18', 1, 'S', '2023-05-18 16:35:57', '2023-05-18 16:47:49', 'Y');

-- Dumping structure for table lms_db.tbl_journal_entry_details
CREATE TABLE IF NOT EXISTS `tbl_journal_entry_details` (
  `journal_entry_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `journal_entry_id` int(11) NOT NULL DEFAULT 0,
  `chart_id` int(11) NOT NULL DEFAULT 0,
  `description` varchar(250) NOT NULL,
  `debit` decimal(12,3) NOT NULL DEFAULT 0.000,
  `credit` decimal(12,3) NOT NULL DEFAULT 0.000,
  PRIMARY KEY (`journal_entry_detail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

-- Dumping data for table lms_db.tbl_journal_entry_details: ~33 rows (approximately)
INSERT INTO `tbl_journal_entry_details` (`journal_entry_detail_id`, `journal_entry_id`, `chart_id`, `description`, `debit`, `credit`) VALUES
	(10, 6, 1, '', 3.000, 0.000),
	(15, 4, 1, '', 2.000, 0.000),
	(16, 4, 4, '', 0.000, 2.000),
	(17, 4, 4, '', 2.000, 0.000),
	(18, 16, 1, '2', 2.000, 0.000),
	(19, 16, 4, '2', 2.000, 0.000),
	(20, 16, 5, '2', 2.000, 0.000),
	(21, 21, 1, '', 3.000, 0.000),
	(22, 22, 5, '2', 2.000, 0.000),
	(23, 22, 1, '', 0.000, 2.000),
	(24, 23, 1, '3', 3.000, 0.000),
	(25, 23, 4, '', 0.000, 3.000),
	(26, 24, 5, '', 500.000, 0.000),
	(27, 24, 2, '', 0.000, 500.000),
	(28, 25, 2, '', 3.000, 0.000),
	(29, 25, 5, '', 3.000, 0.000),
	(30, 26, 1, '', 3.000, 0.000),
	(31, 27, 1, '', 3.000, 0.000),
	(32, 27, 5, '', 0.000, 34.000),
	(33, 28, 1, '', 0.000, 3.000),
	(34, 28, 5, '', 3.000, 0.000),
	(35, 29, 1, '', 4.000, 0.000),
	(36, 30, 1, '', 500.000, 0.000),
	(37, 30, 10, '', 0.000, 360.000),
	(38, 30, 4, '', 0.000, 140.000),
	(39, 31, 5, '', 0.000, 3000.000),
	(40, 31, 12, '', 1500.000, 0.000),
	(41, 31, 13, '', 1500.000, 0.000),
	(42, 32, 2, '', 23.000, 0.000),
	(43, 32, 5, '', 0.000, 23.000),
	(44, 32, 2, '', 324.000, 0.000),
	(45, 32, 4, '', 0.000, 50.000),
	(46, 32, 17, '', 27.000, 0.000);

-- Dumping structure for table lms_db.tbl_loans
CREATE TABLE IF NOT EXISTS `tbl_loans` (
  `loan_id` int(11) NOT NULL AUTO_INCREMENT,
  `reference_number` varchar(50) NOT NULL,
  `client_id` int(11) NOT NULL DEFAULT 0,
  `loan_type_id` int(11) NOT NULL DEFAULT 0,
  `loan_amount` decimal(12,3) NOT NULL DEFAULT 0.000,
  `loan_period` int(6) NOT NULL DEFAULT 0,
  `loan_interest` decimal(12,3) NOT NULL DEFAULT 0.000,
  `due_date` date NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'A' COMMENT 'P - Pending; A - Approved; R - Released; D - Denied; F- Fully paid',
  `loan_date` date NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_last_modified` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`loan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table lms_db.tbl_loans: ~4 rows (approximately)
INSERT INTO `tbl_loans` (`loan_id`, `reference_number`, `client_id`, `loan_type_id`, `loan_amount`, `loan_period`, `loan_interest`, `due_date`, `status`, `loan_date`, `date_added`, `date_last_modified`) VALUES
	(3, 'LN-20230502050211', 45, 1, 100000.000, 12, 17.000, '0000-00-00', 'R', '2023-05-02', '2023-05-02 11:02:18', '2023-05-02 16:53:04'),
	(4, 'LN-20230503042518', 45, 1, 4.000, 2, 12.000, '0000-00-00', 'R', '2023-05-03', '2023-05-03 10:25:27', '2023-05-11 17:21:30'),
	(5, 'LN-20230503094828', 45, 2, 2.000, 2, 1.000, '0000-00-00', 'A', '2023-05-03', '2023-05-03 15:48:37', '2023-05-03 15:49:10'),
	(6, 'LN-20230519092753', 45, 1, 10000.000, 10, 18.000, '0000-00-00', 'R', '2023-05-19', '2023-05-19 15:28:58', '2023-05-23 14:37:54');

-- Dumping structure for table lms_db.tbl_loan_types
CREATE TABLE IF NOT EXISTS `tbl_loan_types` (
  `loan_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `loan_type` varchar(50) DEFAULT NULL,
  `loan_type_interest` decimal(5,2) NOT NULL,
  `remarks` varchar(250) DEFAULT NULL,
  `date_added` datetime DEFAULT current_timestamp(),
  `date_last_modified` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`loan_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table lms_db.tbl_loan_types: ~8 rows (approximately)
INSERT INTO `tbl_loan_types` (`loan_type_id`, `loan_type`, `loan_type_interest`, `remarks`, `date_added`, `date_last_modified`) VALUES
	(1, 'PENSION LOAN', 18.00, 'Diminishing', '2023-04-09 22:12:49', '2023-05-07 18:14:05'),
	(2, 'SALARY LOAN', 17.00, 'Diminishing', '2023-05-03 15:48:54', '2023-05-07 18:13:54'),
	(3, 'SALARY-PRIVATE LOAN', 18.00, 'Diminishing', '2023-05-07 18:14:27', '2023-05-07 18:30:25'),
	(4, 'BONUS LOAN', 17.00, 'Diminishing', '2023-05-07 18:30:50', '2023-05-07 18:30:50'),
	(5, 'REAL ESTATE MORTGAGE LOAN', 17.00, 'Diminishing', '2023-05-07 18:33:35', '2023-05-07 18:35:01'),
	(6, 'CHATTEL MORTGAGE LOAN', 18.00, 'Diminishing', '2023-05-07 18:33:49', '2023-05-07 18:35:06'),
	(7, 'BUSINESS LOAN', 18.00, 'Diminishing', '2023-05-07 18:34:08', '2023-05-07 18:35:13'),
	(8, 'EMERGENCY LOAN', 18.00, 'Advanced', '2023-05-07 18:34:20', '2023-05-07 18:34:34');

-- Dumping structure for table lms_db.tbl_property_owned
CREATE TABLE IF NOT EXISTS `tbl_property_owned` (
  `property_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL DEFAULT 0,
  `property_location` varchar(250) NOT NULL,
  `property_area` varchar(250) NOT NULL,
  `property_acquisition_cost` decimal(12,3) NOT NULL DEFAULT 0.000,
  `property_pres_market_val` decimal(12,3) NOT NULL DEFAULT 0.000,
  `property_improvement` varchar(50) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_last_modified` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`property_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table lms_db.tbl_property_owned: ~2 rows (approximately)
INSERT INTO `tbl_property_owned` (`property_id`, `client_id`, `property_location`, `property_area`, `property_acquisition_cost`, `property_pres_market_val`, `property_improvement`, `date_added`, `date_last_modified`) VALUES
	(5, 47, '3', '3', 3.000, 3.000, '3', '2023-04-25 09:00:49', '2023-04-25 09:00:49'),
	(6, 47, '3', '3', 3.000, 3.000, '3', '2023-04-25 09:00:49', '2023-04-25 09:00:49');

-- Dumping structure for table lms_db.tbl_suppliers
CREATE TABLE IF NOT EXISTS `tbl_suppliers` (
  `supplier_id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(50) DEFAULT NULL,
  `supplier_address` varchar(250) DEFAULT NULL,
  `supplier_contact_no` varchar(15) DEFAULT NULL,
  `remarks` varchar(250) DEFAULT NULL,
  `date_added` datetime DEFAULT current_timestamp(),
  `date_last_modified` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`supplier_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table lms_db.tbl_suppliers: ~1 rows (approximately)
INSERT INTO `tbl_suppliers` (`supplier_id`, `supplier_name`, `supplier_address`, `supplier_contact_no`, `remarks`, `date_added`, `date_last_modified`) VALUES
	(2, 'Lao Chan Corp.', '', '033222', '', '2023-05-12 13:22:48', '2023-05-12 13:22:48');

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
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_last_modified` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
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
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_last_modified` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
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
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_last_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
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
  `account_id` int(11) NOT NULL DEFAULT 0,
  `voucher_no` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL,
  `check_number` varchar(30) NOT NULL,
  `ac_no` varchar(30) NOT NULL,
  `amount` decimal(12,3) NOT NULL DEFAULT 0.000,
  `voucher_date` date NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'S',
  `user_id` int(11) NOT NULL DEFAULT 0,
  `journal_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_last_modified` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`voucher_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

-- Dumping data for table lms_db.tbl_vouchers: ~3 rows (approximately)
INSERT INTO `tbl_vouchers` (`voucher_id`, `reference_number`, `account_type`, `account_id`, `voucher_no`, `description`, `check_number`, `ac_no`, `amount`, `voucher_date`, `status`, `user_id`, `journal_id`, `date_added`, `date_last_modified`) VALUES
	(23, 'CV-20230513100242', 'C', 45, '4234', '34', '342', '234', 234.000, '2023-05-13', 'F', 1, 7, '2023-05-13 16:02:54', '2023-05-13 16:03:09'),
	(24, 'CV-20230513100719', 'S', 2, '324', '3', '342', '234', 34.000, '2023-05-13', 'F', 1, 7, '2023-05-13 16:07:29', '2023-05-13 16:07:44'),
	(25, 'CV-20230516084230', 'C', 45, '3424', '324', '3424', '324', 32434.000, '2023-05-09', 'F', 1, 7, '2023-05-16 14:42:45', '2023-05-16 14:43:18');

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
