<?php

class DatabaseSyncer extends Connection
{
	public $response;
	public function runner()
	{
		$this->schemas();
		return $this->response;
	}

	public function schemas()
	{
		$modules = [
			'Branches', 'ChartClassification', 'ChartOfAccounts', 'ClientAtm', 'ClientBusiness', 'ClientDependent', 'ClientEmployment', 'ClientInsurance', 'ClientReference', 'ClientResidence', 'ClientSoi', 'ClientSpouse', 'ClientTypes', 'Collections', 'Employers', 'ExpenseCategory', 'Expenses', 'FixedInterest', 'Insurance', 'JournalEntry', 'Journals', 'Loans'
		];

		foreach ($modules as $module) {
			$instance = new $module;
			$this->response[] = $instance->schema();
		}
	}
}
