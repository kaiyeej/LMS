<?php

class IncomeStatement extends Connection
{
    public function view()
    {
        $month = $this->inputs['report_month'];
        $year = $this->inputs['report_year'];

        $Collections = new Collections;

        $collected = $Collections->monthly_collection($month,$year);
        $loan_types = $this->loan_types($month,$year);
        $expenses = $this->expenses($month,$year);

        $gross_income = 0;


        $rows = array();
        $row['collected_total'] = number_format($collected,2);
        $row['loan_releases_list'] = $loan_types[0];
        $row['expenses_list'] = $expenses[0];
        $row['expenses_total'] = $expenses[1];
        $row['income_total'] = $gross_income-$expenses[1];
        $rows = $row;
        return $rows;
    }

    
    public function loan_types($month,$year){

        $result = $this->select("tbl_loan_types", "*");
        $list = "";
        $total = 0;
        $LoanTypes = new LoanTypes;
        while($row = $result->fetch_array()){
            $sum = $LoanTypes->total_per_month($row['loan_type_id'],$month,$year);
            // if($sum > 0){
                $list .= "<tr><td style='padding-left: 100px;'>".$row['loan_type']."</td><td style='text-align:right;'>".number_format($sum,2)."</td></tr>";
            // }
            $total += $sum;
        }

        return [$list,$total];
    }

    public function expenses($month,$year){

        // $result = $this->select("tbl_expense_details as d, tbl_expenses as h", "d.expense_detail_id, d.expense_id, d.chart_id, d.expense_amount", "h.expense_id=d.expense_id AND MONTH(h.expense_date) = '$month' AND YEAR(h.expense_date) = '$year' AND h.status='F'");
        $result = $this->select("tbl_chart_of_accounts", "*");
        $list = "";
        $total = 0;
        while($row = $result->fetch_array()){
            $fetch_sum = $this->select("tbl_expense_details as d, tbl_expenses as h", "sum(d.expense_amount)", "h.expense_id=d.expense_id AND MONTH(h.expense_date) = '$month' AND YEAR(h.expense_date) = '$year' AND h.status='F' AND d.chart_id='$row[chart_id]'");
            $sum = $fetch_sum->fetch_array();
            if($sum[0] > 0){
                $list .= "<tr><td style='padding-left: 100px;'>".$row['chart_name']."</td><td style='text-align:right;'>".number_format($sum[0],2)."</td></tr>";
            }
            $total += $sum[0];
        }

        return [$list,$total];
    }

}
