<?php

class CashPositioning extends Connection
{
    private $table = 'tbl_chart_of_accounts';
    public $pk = 'chart_id';
    public $name = 'chart_name';

    public $inputs;

    public function show()
    {
        $start_date = $this->inputs['start_date'];
        $end_date = $this->inputs['end_date'];

        $th_jl = "";
        $th_dc_jl = "";

        $td_jl = "";

        $JournalEntry = new JournalEntry;

        $fetchJournals = $this->select('tbl_journals', '*');
        while ($jlRow = $fetchJournals->fetch_assoc()) {
            if ($jlRow['journal_name'] == "Beginning Balance") {
                $th_jl .= "<th style='color:#fff;'>" . $jlRow['journal_name'] . "</th>";
                $th_dc_jl .= '<th></th>';
            } else {
                $th_jl .= "<th colspan='2' style='color:#fff;border: 1px solid;'>" . $jlRow['journal_name'] . "</th>";
                $th_dc_jl .= '<th style="text-align:right;color:#fff;">DEBIT</th><th style="text-align:right;color:#fff;">CREDIT</th>';
            }
        }

        $data = '<table id="dt_entries" class="div1" width="100%" cellspacing="0">
                    <thead style="background: #1f384b;">
                        <tr style="text-align:center;">
                            <td style="background: #1f384b;color:#fff;border: 0px;border-right: 1px solid #bbbbbb;">CHART OF ACCOUNTS</td>' . $th_jl . '
                            <td colspan="2"></td>
                        </tr>
                        <tr style="background: #607d8b;">
                            <td style="background: #1f384b;border: 0px;border-right: 1px solid #bbbbbb;"></td>' . $th_dc_jl . '
                            <td style="text-align:right;color:#fff;background: #1f384b;">Net Movement</td><td style="text-align:right;color:#fff;background: #1f384b;">Unadjusted Balance</td>
                        </tr>
                    </thead>
                    <tbody>' . $td_jl;

        $tfoot = "<td></td>";
        $result = $this->select($this->table, '*');
        while ($row = $result->fetch_assoc()) {

            $sub = $row['chart_type'] == "S" ? "&emsp; <i class='fas fa-arrow-right'></i> " : "";
            $chart_name = $sub . $row['chart_name'];
            $td_ = "<tr><td style=''>" . $chart_name . "</td>";
            $fetchJournals = $this->select('tbl_journals', '*');
            $total_debit = 0;
            $total_credit = 0;
            $total_bb = 0;
            while ($jlRow = $fetchJournals->fetch_assoc()) {
                $JL = $JournalEntry->total_per_chart($start_date, $end_date, $row['chart_id'], $jlRow['journal_id']);
                $debit = $JL['total_debit'] > 0 ? number_format($JL['total_debit'], 2) : "";
                $credit = $JL['total_credit'] > 0 ? number_format($JL['total_credit'], 2) : "";

                if ($jlRow['journal_name'] == "Beginning Balance") {
                    $bb_total = $JL['total_debit'] - $JL['total_credit'];
                    $total_bb = $bb_total;

                    $td_ .= "<td style='text-align:right;'>" . number_format($bb_total, 2) . "</td>";
                } else {
                    $td_ .= "<td style='text-align:right;'>" . $debit . "</td><td style='text-align:right;'>" . $credit . "</td>";
                }

                $total_debit += $JL['total_debit'];
                $total_credit += $JL['total_credit'];
            }
            $net_movement = $total_debit - $total_credit;
            $unadjusted_movement = $total_bb - $net_movement;
            $td_ .= "<td style='text-align:right;'>" . $net_movement . "</td><td style='text-align:right;'>" . $unadjusted_movement . "</td></tr>";
            $data .= $td_;
        }



        $data .= "</tbody><tfoot style='text-align:right;background: #1f384b;color:#fff;'></tfoot></table>";
        echo $data;
    }

}
