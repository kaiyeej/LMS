<?php

class StatementOfAccounts extends Connection
{
    private $table = 'tbl_loans';
    public $pk = 'loan_id';
    public $name = 'reference_number';

    public function report()
    {
        $param = isset($this->inputs['param']) ? $this->inputs['param'] : null;
        $data = "";
        $LoanTypes = new LoanTypes;
        $result = $this->select($this->table, '*', "$param");
        while($row = $result->fetch_assoc()) {

            $loan_interest = $row['loan_interest'];
            $loan_period = $row['loan_period'];
            $loan_amount = $row['loan_amount'];
            $loan_date = $row['loan_date'];

            $data = '<div class="col-md-12 table-responsive" style="padding-top: 25px">
                        <h4><center>' . $LoanTypes->name($row['loan_type_id']) . '</center></h4>
                        <table class="table table-bordered" id="dt_entries" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>PAYMENT DATE</th>
                                    <th>PAYMENT</th>
                                    <th>INTEREST AMOUNT</th>
                                    <th>PENALTY</th><th>APPLICABLE TO PRINCIPAL</th>
                                    <th>BALANCE OUTSTANDING</th>
                                </tr>
                            </thead>
                        <tbody>';

            $count = 1;
            $Collection = new Collections;
            while ($count <= $loan_period) {

                $loan_date = date('M d, Y', strtotime('+1 month', strtotime($loan_date)));

                $monthly_interest_rate = ($loan_interest / 100) / 12;
                $total_amount_with_interest = ($loan_amount * $monthly_interest_rate * $loan_period) + $loan_amount;
                $suggested_payment = $loan_period > 0 ? $total_amount_with_interest / $loan_period : "";
                $monthly_interest = $loan_amount * $monthly_interest_rate;
                $principal_amount = $loan_amount / $loan_period;


                $data .= "<tr>";
                $data .= "<td>" . date('M Y', strtotime($loan_date)) . "</td>";
                $data .= "<td>" . number_format($Collection->collected_per_month($loan_date), 2) . "</td>";
                $data .= "<td style='text-align: right;'>" . number_format($monthly_interest, 2) . "</td>";
                $data .= "<td style='text-align: right;'>" . number_format(0, 2) . "</td>";
                $data .= "<td style='text-align: right;'>" . number_format($principal_amount, 2) . "</td>";
                $data .= "</tr>";

                $count++;
            }
            $data .= "</tbody></table></div>";
        }

        echo $data;
    }

    public function statement_of_accounts()
    {
        $param = isset($this->inputs['param']) ? $this->inputs['param'] : null;
        $result = $this->select($this->table, '*', "$param");
        $row = $result->fetch_assoc();

        $loan_interest = $row['loan_interest'];
        $loan_period = $row['loan_period'];
        $loan_amount = $row['loan_amount'];
        $loan_date = $row['loan_date'];

        $count = 1;
        $rows = array();
        $Collection = new Collections;
        while ($count <= $loan_period) {

            $loan_date = date('M d, Y', strtotime('+1 month', strtotime($loan_date)));

            $monthly_interest_rate = ($loan_interest / 100) / 12;
            $total_amount_with_interest = ($loan_amount * $monthly_interest_rate * $loan_period) + $loan_amount;
            $suggested_payment = $loan_period > 0 ? $total_amount_with_interest / $loan_period : "";
            $monthly_interest = $loan_amount * $monthly_interest_rate;
            $principal_amount = $loan_amount / $loan_period;



            $row['date'] = $loan_date;
            $row['payment'] = number_format($Collection->collected_per_month($loan_date), 2);
            $row['interest'] = number_format($monthly_interest, 2);
            $row['penalty'] = number_format(0, 2);
            $row['applicable_principal'] =  number_format($principal_amount, 2);
            $rows[] = $row;

            $count++;
        }

        return $rows;
    }
}
