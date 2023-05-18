<?php

class FinancialStatements extends Connection
{
    private $table = 'tbl_chart_classification';
    public $pk = 'chart_class_id';
    public $name = 'chart_class_name';


    public function show()
    {
        $start_date = $this->inputs['start_date'];
        $end_date = $this->inputs['end_date'];
        $years_ = ($end_date - $start_date) + 1;

        $i = 0;
        $th = "";
        $th_year = $start_date;
        $cl_span = 1;
        while ($i < $years_) {
            $th .= "<th style='color:#fff;text-align:right;'>" . $th_year . "</th>";
            $i++;
            $th_year++;
            $cl_span++;
        }
        $data = '<table class="table table-bordered" id="dt_entries" width="100%" cellspacing="0">
                    <thead style="background: #1f384b;">
                        <tr>
                            <th style="color:#fff;">CHART</th>' . $th . '
                        </tr>
                    </thead>
                    <tbody>';
        $JL = new JournalEntry;
        $result = $this->select($this->table);
        while ($row = $result->fetch_assoc()) {
            $data .= '<tr>
                        <td colspan="' . $cl_span . '">' . $row['chart_class_name'] . '</td>
                    </tr>';
            $result_chart = $this->select('tbl_chart_of_accounts', '*', "chart_class_id='$row[chart_class_id]'");
            while ($chartRow = $result_chart->fetch_assoc()) {
                $y = 0;
                $td = "";
                $td_year = $start_date;
                while ($y < $years_) {
                    $td .= "<td style='text-align:right;'>" . number_format($JL->chart_per_year($td_year,$chartRow['chart_id']),2) . "</td>";
                    $y++;
                    $td_year++;
                }
                $data .= '<tr>
                            <td>&emsp;&emsp;&emsp; ' . $chartRow['chart_name'] . '</td>
                            '.$td.'
                        </tr>';
            }
        }

        $data .= "</tbody></table>";

        echo $data;
    }
}
