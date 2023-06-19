<?php

class LoanReport extends Connection
{


    public function view()
    {
        
        $start_date = $this->inputs['start_date'];
        $end_date = $this->inputs['end_date'];
        $date_range = $this->inputs['date_range'];
        

        if ($this->inputs['report_type'] == "type") {
            $query = $this->inputs['loan_type_id'] == -1 ? "loan_id > 0" : 'loan_type_id= "' . $this->inputs['loan_type_id'] . '"';
        } else {
            $query = $this->inputs['loan_status'] == -1 ? "loan_id > 0" : 'status= "' . $this->inputs['loan_status'] . '"';
        }

        $rows = array();
        if($date_range == 1){
            $result = $this->select("tbl_loans", "*", "$query");
        }else{
            $result = $this->select("tbl_loans", "*", "(loan_date >= '$start_date' AND loan_date <= '$end_date') AND $query");

        }
        

        $Clients = new Clients;
        $LoanTypes = new LoanTypes;
        while ($row = $result->fetch_assoc()) {

            $row['client'] = $Clients->name($row['client_id']);
            $row['amount'] = number_format($row['loan_amount'], 2);
            $row['loan_type'] = $LoanTypes->name($row['loan_type_id']);
            $rows[] = $row;
        }
        return $rows;
    }

    public function summary_loan_type()
    {
        $year = date('Y');
        $fetch_loans = $this->select('tbl_loans', 'sum(loan_amount) as total', "(status != 'D' OR status !='P') AND YEAR(loan_date) = '$year'");
        $total_loans = $fetch_loans->fetch_assoc();

        $data = "";
        $result = $this->select("tbl_loan_types", '*');
        while ($row = $result->fetch_assoc()) {
            $loans = $this->select('tbl_loans', 'sum(loan_amount) as total', "loan_type_id = '$row[loan_type_id]' AND (status != 'D' OR status !='P')  AND YEAR(loan_date) = '$year'");
            $loan_row = $loans->fetch_assoc();


            $count1 = $total_loans['total'] > 0 ? $loan_row['total'] / $total_loans['total'] : 0;
            $count2 = $count1 * 100;

            $data .= '<div class="mb-4">
                        <div class="text-small float-right font-weight-bold text-muted">' . number_format($loan_row['total'], 2) . '</div>
                        <div class="font-weight-bold mb-1">' . $row['loan_type'] . '</div>
                        <div class="progress" data-height="3" style="height: 3px;">
                            <div class="progress-bar" title="' . $count2 . '%" role="progressbar" data-width="' . $count2 . '%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: ' . $count2 . '%;"></div>
                        </div>
                    </div>';
        }

        echo $data;
    }

    public function pending_loans()
    {
        // $year = date('Y');
        $Clients = new Clients;
        $data = "";
        $result = $this->select("tbl_loans", '*', "status='A'");
        if($result->num_rows <= 0){
            $data = "<center><h5>!No details found.</h5></center>";
        }else{
            while ($row = $result->fetch_assoc()) {
                $data .= ' <li class="media">
                            <div class="media-body">
                                <div class="media-right">&#8369; '.number_format($row['loan_amount'],2).'</div>
                                <div class="media-title"><a href="#">'.$row['reference_number'].'</a></div>
                                <div class="text-muted text-small"> <a href="#">'.$Clients->name($row['client_id']).'</a>  ('.$row['loan_date'].')
                                </div>
                            </div>
                        </li>';
            }
        }

        echo $data;
    }
}
