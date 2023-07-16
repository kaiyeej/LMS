<?php

class ReceivableLedger extends Connection
{


    public function view()
    {
        $client_id = $this->inputs['client_id'];
        $start_date = $this->inputs['start_date'];
        $end_date = $this->inputs['end_date'];

        if($start_date == 0 OR $end_date == 0){
            $query_collection = "";
            $query_loan = "";
        }else{
            $query_collection = " AND (collection_date >= '$start_date' AND collection_date <= '$end_date')";
            $query_loan = "AND (loan_date >= '$start_date' AND loan_date <= '$end_date')";
        }
        
        $rows = array();
        $result = $this->select("tbl_loans","reference_number, date_added","client_id='$client_id' $query_loan AND (status!='D' OR status!='P') UNION ALL SELECT reference_number, date_added FROM tbl_collections WHERE client_id='$client_id' AND status='F' $query_collection ORDER BY date_added ASC");
        
        $Loans = new Loans;
        $Collections = new Collections;
        $bf = $this->total();
        $balance = (float) $bf[0];
        while ($row = $result->fetch_assoc()) {

            $trans = substr($row['reference_number'], 0, 2);

            if($trans == "CL"){
                $trans = "Collections";
                $id = $Collections->pk_by_name($row['reference_number']);
                $debit = 0;
                $credit = $Collections->total($id);
                $balance -= $credit;
                $date = $Collections->data_row($id, 'collection_date');
                $ref_number = $row['reference_number'];
            }else if($trans == "LN"){
                $trans = "Loans";
                $id = $Loans->pk_by_name($row['reference_number']);
                $debit = $Loans->total($id);
                $credit = 0;
                $balance += $debit;
                $date = $Loans->data_row($id, 'loan_date');
                $ref_number = $row['reference_number'];
            }

            $row['date'] = $date;
            $row['reference_number'] = $ref_number;
            $row['transaction'] = $trans;
            $row['debit'] = number_format($debit,2);
            $row['credit'] = number_format($credit,2);
            $row['balance'] = number_format($balance,2);
            $rows[] = $row;
        }
        return $rows;
    }

    public function total()
    {
        $client_id = $this->inputs['client_id'];
        $start_date = $this->inputs['start_date'];

        $get_loans = $this->select("tbl_loans","sum(loan_amount)","client_id='$client_id' AND loan_date < '$start_date' AND (status!='D' OR status!='P')");
        $total_loan = $get_loans->fetch_array();

        $get_collections = $this->select("tbl_collections","sum(amount)","client_id='$client_id' AND collection_date < '$start_date' AND status='F'");
        $total_collection = $get_collections->fetch_array();


        $bf = $total_loan[0]-$total_collection[0];
        $total = "";
        
        return [$bf,$total];
        
    }
    
}
