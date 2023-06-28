<?php

class StatementOfAccounts extends Connection
{
    private $table = 'tbl_loans';
    public $pk = 'loan_id';
    public $name = 'reference_number';

    public function report()
    {
        $param = isset($this->inputs['param']) ? $this->inputs['param']." AND main_loan_id = 0" : null;
        $data = "";
        $LoanTypes = new LoanTypes;
        $ClientInsurance = new ClientInsurance;
        $Insurance = new Insurance;
        $result = $this->select($this->table, '*', "$param");
        while ($row = $result->fetch_assoc()) {
            $fetchMain = $this->select($this->table, '*', "main_loan_id = '".$row['loan_id']."'");
            if($fetchMain->num_rows == 0){

                $loan_interest = $row['loan_interest'];
                $loan_period = $row['loan_period'];
                $loan_amount = $row['loan_amount'];
                $loan_date = $row['loan_date'];
            
            }else{
                $loan_interest = $row['loan_interest'];
                $loan_period = $row['loan_period'];
                $loan_amount = $row['loan_amount'];
                $loan_date = $row['loan_date'];
            }


            $data .= '<div class="col-md-12 table-responsive" style="padding-top: 25px">
                        <strong> Loan Amount : ' . number_format($row['loan_amount'], 2) . '</strong><br>
                        <strong> Date #: ' . date('M d, Y', strtotime($row['loan_date'])) . '</strong><br>
                        <strong> Term #: ' . $row['loan_period'] . '</strong><br>
                        <strong> Insurance: ' . $Insurance->name($ClientInsurance->clientInsuranceID($row['client_id'])) . '</strong><br>
                        <strong> Reference #: ' . $row['reference_number'] . '</strong><br><br><br>
                        <table class="table table-bordered" id="dt_entries" width="100%" cellspacing="0">
                            <thead style="background: #1f384b;">
                                <tr>
                                    <th style="color:#fff;">PAYMENT DATE</th>
                                    <th style="color:#fff;">PAYMENT</th>
                                    <th style="color:#fff;">INTEREST AMOUNT</th>
                                    <th style="color:#fff;">PENALTY</th>
                                    <th style="color:#fff;">APPLICABLE TO PRINCIPAL</th>
                                    <th style="color:#fff;">BALANCE OUTSTANDING</th>
                                </tr>
                            </thead>
                        <tbody>
                            <tr style="background: #E0E0E0;">
                                <td style="font-weight:bold;">Monthly Installment:</td>
                                <td colspan="5" style="font-weight:bold;">' . number_format($row['monthly_payment'], 2) . '</td>
                            </tr>
                            <tr style="background: #E0E0E0;">
                                <td colspan="5" style="text-align:right;font-weight:bold;">Loan Amount:</td>
                                <td style="text-align:right;font-weight:bold;">' . number_format($loan_amount, 2) . '</td>
                            </tr>
                        ';

            $monthly_interest_rate = ($loan_interest / 100) / 12;
            $total_amount_with_interest = ($loan_amount * $monthly_interest_rate * $loan_period) + $loan_amount;

            if($row['main_loan_id'] != 0){
                $fetchMain = $this->select($this->table, '*', "main_loan_id = '".$row['loan_id']."'");
                $main_row = $fetchMain->fetch_assoc();
                $loan_period = $loan_period+$main_row['loan_period'];
            }

            $count = 1;
            $balance = $loan_amount;
            $Collection = new Collections;
            $total_payment = 0;
            $total_interest = 0;
            $total_penalty = 0;
            if ($balance > 0) {

                while ($count <= $loan_period) {

                    $loan_date = date('Y-m-d', strtotime('+1 month', strtotime($loan_date)));
                    $payment = $count == 1 ? $Collection->collected_per_month($loan_date, $row['loan_id']) + $Collection->advance_collection($row['loan_id']) : $Collection->collected_per_month($loan_date, $row['loan_id']);
                    $monthly_interest = $balance * $monthly_interest_rate;
                    $principal_amount = $payment - $monthly_interest;
                    $penalty = $Collection->penalty_per_month($loan_date, $row['loan_id']);
                    $balance -= $principal_amount;
                    $total_payment += $payment;
                    $total_interest += $monthly_interest;
                    $total_penalty += $penalty;

                    $principal_ = $principal_amount <= 0 ? "0.00" : number_format($principal_amount, 2);

                    $data .= "<tr>";
                    $data .= "<td>" . date('F Y', strtotime($loan_date)) . "</td>";
                    $data .= "<td style='text-align: right;'>" . number_format($payment, 2) . "</td>";
                    $data .= "<td style='text-align: right;'>" . number_format($monthly_interest, 2) . "</td>";
                    $data .= "<td style='text-align: right;'>" . number_format($penalty, 2) . "</td>";
                    $data .= "<td style='text-align: right;'>" . $principal_ . "</td>";
                    $data .= "<td style='text-align: right;'>" . number_format($balance, 2) . "</td>";
                    $data .= "</tr>";

                    $count++;
                }
            }
            $data .= "</tbody><tfoot><tr style='text-align: right;font-weight:bold;'><td>Total</td><td>" . number_format($total_payment, 2) . "</td><td>" . number_format($total_interest, 2) . "</td><td>" . number_format($total_penalty, 2) . "</td><td colspan='2'></td></tr></tfoot></table></div>";
        }

        if ($data == "") {
            echo '<div class="col-md-12 table-responsive" style="padding-top: 25px">
                        <table class="table table-bordered" id="dt_entries" width="100%" cellspacing="0">
                            <thead style="background: #1f384b;">
                                <tr>
                                    <th style="color:#fff;">PAYMENT DATE</th>
                                    <th style="color:#fff;">PAYMENT</th>
                                    <th style="color:#fff;">INTEREST AMOUNT</th>
                                    <th style="color:#fff;">PENALTY</th>
                                    <th style="color:#fff;">APPLICABLE TO PRINCIPAL</th>
                                    <th style="color:#fff;">BALANCE OUTSTANDING</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="6"><center><h5>No details found!</h5></center></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>';
        } else {
            echo $data;
        }
    }
}
