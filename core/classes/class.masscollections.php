<?php

class MassCollections extends Connection
{
    private $table = 'tbl_mass_collections';
    public $pk = 'mass_collection_id';
    public $name = 'reference_number';

    private $table_detail = 'tbl_mass_collection_details';
    public $pk2 = 'mass_collection_detail_id';

    private $table_collections = 'tbl_collections';

    public $inputs;

    public function add()
    {
        $form = array(
            $this->name         => $this->clean($this->inputs[$this->name]),
            'branch_id'         => $this->clean($this->inputs['branch_id']),
            'loan_type_id'      => $this->clean($this->inputs['loan_type_id']),
            'chart_id'          => $this->clean($this->inputs['chart_id']),
            'collection_date'   => $this->clean($this->inputs['collection_date']),
            'employer_id'       => $this->clean($this->inputs['employer_id']),
            'atm_charge'        => $this->clean($this->inputs['atm_charge']),
            'status'            => $this->clean($this->inputs['status']),
            'prepared_by'       => $this->clean($_SESSION['lms_user_id']),
            'finished_by'       => $this->clean($this->inputs['status']) == 'F' ? $this->clean($_SESSION['lms_user_id']) : 0,
        );

        return $this->insert($this->table, $form, 'Y');
    }

    public function show()
    {
        $Branches = new Branches;
        $LoanTypes = new LoanTypes;
        $ChartOfAccounts = new ChartOfAccounts;
        $Employers = new Employers;
        $Users = new Users;

        $param = isset($this->inputs['param']) ? $this->inputs['param'] : null;
        $rows = array();
        $result = $this->select($this->table, '*', $param);
        while ($row = $result->fetch_assoc()) {
            $row['branch'] = $Branches->name($row['branch_id']);
            $row['loan_type'] = $LoanTypes->name($row['loan_type_id']);
            $row['bank'] = $ChartOfAccounts->name($row['chart_id']);
            $row['employer'] = $Employers->name($row['employer_id']);
            $row['prepared'] = $Users->name($row['prepared_by']);
            $rows[] = $row;
        }
        return $rows;
    }

    public function initialize()
    {
        $Clients = new Clients;
        $ChartOfAccounts = new ChartOfAccounts;
        $Branches = new Branches;
        $Employers = new Employers;
        $ClientAtm = new ClientAtm;

        $loan_type_id = $this->inputs['loan_type_id'];
        $collection_date = $this->inputs['collection_date'];
        $employer_id = $this->inputs['employer_id'];
        $chart_id = $this->inputs['chart_id'];
        $branch_id = $this->inputs['branch_id'];
        $atm_charge = (float) $this->inputs['atm_charge'];

        $rows = array();
        $result = $this->select("tbl_clients AS c, tbl_client_employment AS e,tbl_loans AS l", 'l.*', "c.client_id = e.client_id AND c.client_id = l.client_id AND c.branch_id = '$branch_id' AND e.employer_id = '$employer_id' AND l.loan_type_id = '$loan_type_id' AND l.status = 'R'");
        while ($row = $result->fetch_assoc()) {

            $row['client_name'] = $Clients->initial_name($row['client_id']);
            $row['receipt_number'] = "";
            $row['old_atm_balance'] = 0;
            $row['atm_withdrawal'] = 0;
            $row['deduction'] = $row['monthly_payment'];
            $row['emergency_loan'] = 0;
            $row['atm_charge'] = $atm_charge;
            $row['atm_balance'] = 0;
            $row['excess'] = 0;
            $row['atm_account_no'] = $ClientAtm->name($row['client_id']);
            $row['is_included'] = 1;
            $row['mass_collection_detail_id'] = 0;

            $rows[] = $row;
        }
        $response['clients'] = $rows;

        $LoanTypes = new LoanTypes;
        $response['headers'] = [
            "loan_type_id" => $loan_type_id,
            "loan_name" => $LoanTypes->name($loan_type_id),
            "collection_date" => date("Y-m-d", strtotime($collection_date)),
            "collection_date_label" => date("F d, Y", strtotime($collection_date)),
            "employer_id" => $employer_id,
            "employer_name" => $Employers->name($employer_id),
            "prepared_by_name" => Users::fullname($_SESSION['lms_user_id']),
            "finished_by_name" => Users::fullname($_SESSION['lms_user_id']),
            "chart_id" => $chart_id,
            "chart_name" => $ChartOfAccounts->name($chart_id),
            "branch_id" => $branch_id,
            "branch_name" => $Branches->name($branch_id),
            "atm_charge" => $atm_charge,
            "status" => "S",
            "mass_collection_id" => 0,
        ];
        return $response;
    }

    public function save_collections()
    {
        try {
            $this->checker();
            $this->begin_transaction();

            if ($this->inputs['mass_collection_id'] > 0) {
                $mass_collection_id = $this->inputs['mass_collection_id'];
            } else {
                $this->inputs['reference_number'] = $this->generate();
                $mass_collection_id = $this->add();
                if ($mass_collection_id < 1)
                    throw new Exception($mass_collection_id);
            }

            $details = $this->inputs['details'];

            foreach ($details as $row) {
                $form_detail = [
                    'mass_collection_id'    => $mass_collection_id,
                    'client_id'             => $row['client_id'],
                    'loan_id'               => $row['loan_id'],
                    'receipt_number'        => $row['receipt_number'],
                    'old_atm_balance'       => $row['old_atm_balance'],
                    'atm_withdrawal'        => $row['atm_withdrawal'],
                    'deduction'             => $row['deduction'],
                    'emergency_loan'        => $row['emergency_loan'],
                    'atm_charge'            => $row['atm_charge'],
                    'atm_balance'           => $row['atm_balance'],
                    'excess'                => $row['excess'],
                    'atm_account_no'        => $row['atm_account_no'],
                    'is_included'           => $row['is_included']
                ];

                $is_inserted = $row['mass_collection_detail_id'] > 0 ? $this->update($this->table_detail, $form_detail, "mass_collection_detail_id = '" . $row['mass_collection_detail_id'] . "'") : $this->insert($this->table_detail, $form_detail);
                if ($is_inserted != 1)
                    throw new Exception($is_inserted);
            }
            $this->commit();
            return [
                'status' => 'success',
                'data' => $mass_collection_id
            ];
        } catch (Exception $e) {
            $this->rollback();
            Logs::error("MassCollections->save_collections", "Mass Collection", $e->getMessage());
            return [
                'status' => 'failed',
                'error' => $e->getMessage()
            ];
        }
    }

    public function finish_collections()
    {
        try {
            $this->checker();
            $this->begin_transaction();

            if ($this->inputs['mass_collection_id'] > 0) {
                $mass_collection_id = $this->inputs['mass_collection_id'];
            } else {
                $this->inputs['reference_number'] = $this->generate();
                $mass_collection_id = $this->add();
                if ($mass_collection_id < 1)
                    throw new Exception($mass_collection_id);
            }

            $details = $this->inputs['details'];

            foreach ($details as $row) {
                $form_detail = [
                    'mass_collection_id'    => $mass_collection_id,
                    'client_id'             => $row['client_id'],
                    'loan_id'               => $row['loan_id'],
                    'receipt_number'        => $row['receipt_number'],
                    'old_atm_balance'       => $row['old_atm_balance'],
                    'atm_withdrawal'        => $row['atm_withdrawal'],
                    'deduction'             => $row['deduction'],
                    'emergency_loan'        => $row['emergency_loan'],
                    'atm_charge'            => $row['atm_charge'],
                    'atm_balance'           => $row['atm_balance'],
                    'excess'                => $row['excess'],
                    'atm_account_no'        => $row['atm_account_no'],
                    'is_included'           => $row['is_included']
                ];

                $is_inserted = $row['mass_collection_detail_id'] > 0 ? $this->update($this->table_detail, $form_detail, "mass_collection_detail_id = '" . $row['mass_collection_detail_id'] . "'") : $this->insert($this->table_detail, $form_detail);
                if ($is_inserted != 1)
                    throw new Exception($is_inserted);

                if ($row['is_included'] == 1) {
                    $form_collection = [
                        'branch_id'         => $this->clean($this->inputs['branch_id']),
                        'reference_number'  => "CL-" . $row['client_id'] . "-" . $row['loan_id'] . "-" . date("YmdHis"),
                        'chart_id'          => $this->clean($this->inputs['chart_id']),
                        'collection_date'   => $this->clean($this->inputs['collection_date']),
                        'penalty_amount'    => 0,
                        'remarks'           => "",
                        'loan_id'           => $row['loan_id'],
                        'client_id'         => $row['client_id'],
                        'amount'            => $row['deduction'],
                        'atm_balance'       => $row['atm_balance'],
                        'atm_withdrawal'    => $row['atm_withdrawal'],
                        'atm_charge'        => $row['atm_charge'],
                        'receipt_number'    => $row['receipt_number'],
                    ];

                    $Collections = new Collections;
                    $Collections->inputs = $form_collection;
                    $cl_id = $Collections->add();
                    if ($cl_id < 1)
                        throw new Exception($cl_id);
                }
            }
            $this->update($this->table, ['status' => 'F'], "mass_collection_id = '$mass_collection_id'");
            $this->commit();
            return [
                'status' => 'success',
                'data' => $mass_collection_id
            ];
        } catch (Exception $e) {
            $this->rollback();
            Logs::error("MassCollections->finish_collections", "Mass Collection", $e->getMessage());
            return [
                'status' => 'failed',
                'error' => $e->getMessage()
            ];
        }
    }

    public function add_mass_collection()
    {
        $loan_type_id = $this->inputs['loan_type_id'];
        $collection_date = $this->inputs['collection_date'];
        $employer_id = $this->inputs['employer_id'];
        $chart_id = $this->inputs['chart_id'];
        $branch_id = $this->inputs['branch_id'];
        $details = $this->inputs['details'];

        foreach ($details as $row) {
            $reference_number = "CL-" . date("Ymd") . $row['loan_id'];
            $form = [
                'branch_id' => $branch_id,
                'reference_number' => $reference_number,
                'chart_id' => $chart_id,
                'collection_date' => $collection_date,
                'loan_id' => $row['loan_id'],
                'client_id' => $row['client_id'],
                'amount' => $row['deduction'],
                'penalty_amount' => 0,
                'remarks' => "",
                'atm_balance' => $row['atm_balance'],
                'atm_withdrawal' => $row['atm_withdrawal'],
                'atm_charge' => $row['atm_charge'],
                'receipt_number' => $row['receipt_number']
            ];

            $Collections = new Collections;
            $Collections->inputs = $form;
            $Collections->add();
        }
    }

    public function view_saved()
    {
        $mass_collection_id = $this->inputs['id'];

        $Clients = new Clients;

        $rows = array();
        $result = $this->select($this->table_detail, "*", "mass_collection_id = '$mass_collection_id'");
        while ($row = $result->fetch_assoc()) {
            $row['client_name'] = $Clients->initial_name($row['client_id']);
            $rows[] = $row;
        }
        $response['clients'] = $rows;

        $response['headers'] = $this->view();
        $response['headers']["prepared_by_name"] = Users::fullname($response['headers']['prepared_by']);
        $response['headers']["finished_by_name"] = Users::fullname($_SESSION['lms_user_id']);
        return $response;
    }

    public function view()
    {
        $primary_id = $this->inputs['id'];
        $result = $this->select($this->table, "*", "$this->pk = '$primary_id'");
        return $result->fetch_assoc();
    }

    public function generate()
    {
        return 'MCL-' . date('YmdHis');
    }

    public function schema()
    {
        if (DEVELOPMENT) {
            $default['date_added'] = $this->metadata('date_added', 'datetime', '', 'NOT NULL', 'CURRENT_TIMESTAMP');
            $default['date_last_modified'] = $this->metadata('date_last_modified', 'datetime', '', 'NOT NULL', 'CURRENT_TIMESTAMP', 'ON UPDATE CURRENT_TIMESTAMP');
            $default['user_id'] = $this->metadata('user_id', 'int', 11);


            // TABLE HEADER
            $tables[] = array(
                'name'      => $this->table,
                'primary'   => $this->pk,
                'fields' => array(
                    $this->metadata($this->pk, 'int', 11, 'NOT NULL', '', 'AUTO_INCREMENT'),
                    $this->metadata($this->name, 'varchar', 75),
                    $this->metadata('branch_id', 'int', 11),
                    $this->metadata('loan_type_id', 'int', 11),
                    $this->metadata('chart_id', 'int', 11),
                    $this->metadata('collection_date', 'date'),
                    $this->metadata('employer_id', 'int', 11),
                    $this->metadata('atm_charge', 'decimal', '12,2'),
                    $this->metadata('status', 'varchar', 1, 'NOT NULL', "'S'", '', "'S:Saved;F:Finished'"),
                    $this->metadata('prepared_by', 'int', 11),
                    $this->metadata('finished_by', 'int', 11),
                    $default['date_added'],
                    $default['date_last_modified']
                )
            );

            // TABLE DETAILS
            $tables[] = array(
                'name'      => $this->table_detail,
                'primary'   => $this->pk2,
                'fields' => array(
                    $this->metadata($this->pk2, 'int', 11, 'NOT NULL', '', 'AUTO_INCREMENT'),
                    $this->metadata('mass_collection_id', 'int', 11),
                    $this->metadata('client_id', 'int', 11),
                    $this->metadata('loan_id', 'int', 11),
                    $this->metadata('receipt_number', 'varchar', 5),
                    $this->metadata('old_atm_balance', 'decimal', '12,4'),
                    $this->metadata('atm_withdrawal', 'decimal', '12,4'),
                    $this->metadata('deduction', 'decimal', '12,4'),
                    $this->metadata('emergency_loan', 'decimal', '12,4'),
                    $this->metadata('atm_charge', 'decimal', '12,4'),
                    $this->metadata('atm_balance', 'decimal', '12,4'),
                    $this->metadata('excess', 'decimal', '12,4'),
                    $this->metadata('atm_account_no', 'varchar', 50),
                    $this->metadata('is_included', 'int', 1),
                    $default['date_added'],
                    $default['date_last_modified']
                )
            );

            return $this->schemaCreator($tables);
        }
    }
}
