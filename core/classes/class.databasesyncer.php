<?php

class DatabaseSyncer extends Connection
{
	public $response;
	public function runner()
	{
		$this->schemas();
		$this->triggers();
		return $this->response;
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
			'MassCollections', 'Vouchers', 'Clients', 'JournalEntry', 'Collections'
		];

		foreach ($modules as $module) {
			$instance = new $module;
			$this->response['triggers'][$module] = $instance->triggers();
		}
	}
}
