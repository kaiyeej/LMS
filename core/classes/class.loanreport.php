<?php

class LoanReport extends Connection
{


    public function view()
    {
        
        $start_date = $this->inputs['start_date'];
        $end_date = $this->inputs['end_date'];

        if($this->inputs['report_type'] == "type"){
            $query = $this->inputs['loan_type_id'] == -1 ? "" : 'AND loan_type_id= "'.$this->inputs['loan_type_id'].'"';
        }else{
            $query = $this->inputs['loan_status'] == -1 ? "" : 'AND status= "'.$this->inputs['loan_status'].'"';
        }

        $rows = array();
        $result = $this->select("tbl_loans","*","(loan_date >= '$start_date' AND loan_date <= '$end_date') $query");

        $Clients = new Clients;
        $LoanTypes = new LoanTypes;
        while ($row = $result->fetch_assoc()) {

            $row['client'] = $Clients->name($row['client_id']);
            $row['amount'] = number_format($row['loan_amount'],2);
            $row['loan_type'] = $LoanTypes->name($row['loan_type_id']);
            $rows[] = $row;
        }
        return $rows;
    }



}
