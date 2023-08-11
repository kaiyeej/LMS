<?php

class DatabaseSyncer extends Connection
{
	public $response;
	public function sync()
	{
		$this->schemas();
		$this->triggers();
		return $this->response;
	}

	public function fresh()
	{
		$this->schemas();
		$this->drop_table_deleted();
		$this->clone_table_deleted();
		$this->triggers();
		return $this->response;
	}

	public function truncate_transactions()
	{
		// DELETE TRANSACTIONS DATA

		// LOANS
		// VOUCHERS
		// COLLECTIONS
		// MASS COLLECTIONS
		// JOURNAL ENTRY
	}

	public function drop_table_deleted()
	{
		$this->response['drop_deleted'] = [];
		$loop_tables = $this->select("information_schema.tables", "table_name", "table_schema = '" . DBNAME . "' AND `table_name` LIKE '%_deleted'");
		foreach ($loop_tables as $row) {
			$drop_statement = "DROP TABLE " . $row['table_name'];
			$this->response['drop_deleted'][$row['table_name']] = $this->query($drop_statement);
		}
	}

	public function clone_table_deleted()
	{
		$this->response['clone_deleted'] = [];
		$loop_tables = $this->select("information_schema.tables", "CONCAT('CREATE TABLE ', table_name, '_deleted AS SELECT * FROM ', table_name, ' WHERE 1=0;') AS create_statement,table_name", "table_schema = '" . DBNAME . "'");
		foreach ($loop_tables as $row) {
			$create_statement = $row['create_statement'];
			$this->response['clone_deleted'][$row['table_name']] = $this->query($create_statement);
		}
	}

	public function schemas()
	{
		$modules = [
			'Branches', 'ChartClassification', 'ChartOfAccounts', 'ClientAtm', 'ClientBusiness', 'ClientDependent', 'ClientEmployment', 'ClientInsurance', 'ClientReference', 'ClientResidence', 'Clients', 'ClientSoi', 'ClientSpouse', 'ClientTypes', 'ClientChildren', 'ClientProperty', 'Collections', 'Employers', 'ExpenseCategory', 'Expenses', 'FixedInterest', 'Insurance', 'JournalEntry', 'Journals', 'Loans', 'LoanTypes', 'MassCollections', 'Suppliers', 'UserCategories', 'UserPrivileges', 'Users', 'Vouchers'
		];

		foreach ($modules as $module) {
			$instance = new $module;
			$this->response['schemas'][$module] = $instance->schema();
		}
	}

	public function triggers()
	{
		$modules = [
			'Branches', 'ChartClassification', 'ChartOfAccounts',
			'ClientAtm', 'ClientBusiness', 'ClientDependent',
			'ClientEmployment', 'ClientInsurance', 'ClientReference',
			'ClientResidence', 'Clients', 'ClientSoi',
			'ClientSpouse', 'ClientTypes', 'ClientChildren',
			'ClientProperty',
			'MassCollections', 'Vouchers', 'Clients', 'JournalEntry', 'Collections'
		];

		foreach ($modules as $module) {
			$instance = new $module;
			$this->response['triggers'][$module] = $instance->triggers();
		}
	}
}
