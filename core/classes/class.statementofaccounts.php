<?php

class StatementOfAccounts extends Connection
{
    private $table = 'tbl_loans';
    public $pk = 'loan_id';
    public $name = 'reference_number';

    public function report()
    {
        $param = isset($this->inputs['param']) ? $this->inputs['param'] : null;
        $data = " ";
        $LoanTypes = new LoanTypes;
        $result = $this->select($this->table, '*', "$param");
        while($row = $result->fetch_assoc()) {

            $loan_interest = $row['loan_interest'];
            $loan_period = $row['loan_period'];
            $loan_amount = $row['loan_amount'];
            $loan_date = $row['loan_date'];

            $data .= '<div class="col-md-12 table-responsive" style="padding-top: 25px">
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
            $balance = $loan_amount;
            $Collection = new Collections;
            $total_payment = 0;
            $total_interest = 0;
            while ($count <= $loan_period) {

                $loan_date = date('Y-m-d', strtotime('+1 month', strtotime($loan_date)));

                $monthly_interest_rate = ($loan_interest / 100) / 12;
                $total_amount_with_interest = ($loan_amount * $monthly_interest_rate * $loan_period) + $loan_amount;
                $suggested_payment = $loan_period > 0 ? $total_amount_with_interest / $loan_period : "";
                $monthly_interest = $loan_amount * $monthly_interest_rate;
                $principal_amount = $loan_amount / $loan_period;
                $penalty = 0;
                $payment = $Collection->collected_per_month($loan_date,$row['loan_id']);
                
                $total_payment += $payment;
                $total_interest += $monthly_interest;
                $balance -= ($payment);


                $data .= "<tr>";
                $data .= "<td>" . date('F Y', strtotime($loan_date)). "</td>";
                $data .= "<td>" . number_format($payment, 2) . "</td>";
                $data .= "<td style='text-align: right;'>" . number_format($monthly_interest, 2) . "</td>";
                $data .= "<td style='text-align: right;'>" . number_format($penalty, 2) . "</td>";
                $data .= "<td style='text-align: right;'>" . number_format($principal_amount, 2) . "</td>";
                $data .= "<td style='text-align: right;'>" . number_format($balance, 2) . "</td>";
                $data .= "</tr>";

                $count++;
            }
            $data .= "</tbody><tfoot><tr style='text-align: right;font-weight:bold;'><td>Total</td><td>".number_format($total_payment,2)."</td><td>".number_format($total_interest,2)."</td><td colspan='3'></td></tr></tfoot></table></div>";
        }

        echo $data;
    }

}
