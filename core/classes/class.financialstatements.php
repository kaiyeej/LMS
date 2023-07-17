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
        
        $JL = new JournalEntry;

        $i = 0;
        $th = "";
        $th_year = $start_date;
        $cl_span = 1;
        $ft_td = "";
        while ($i < $years_) {
            $y_total = $JL->total_year($th_year);
            
            $th .= "<th style='color:#fff;text-align:right;'>" . $th_year . "</th>";
            $ft_td .= "<td style='text-align:right;'>" . number_format($y_total,2) . "</td>";
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
        $result = $this->select($this->table);
        $total_td = "";
        $counter = 0;
        while ($row = $result->fetch_assoc()) {
            $data .= '<tr>
                        <td colspan="' . $cl_span . '"><strong>' . $row['chart_class_name'] . '</strong></td>
                    </tr>';
            $result_chart = $this->select('tbl_chart_of_accounts', '*', "chart_class_id='$row[chart_class_id]'");
            
            $tf_total = 0;
            while ($chartRow = $result_chart->fetch_assoc()) {
                $y = 0;
                $td = "";
                $td_year = $start_date;
                $tfsum = 0;
                while ($y < $years_) {
                    $y_total = $JL->chart_per_year($td_year,$chartRow['chart_id']);
                    $td .= "<td style='text-align:right;'>" . number_format($y_total,2) . "</td>";
                    $y++;
                    $td_year++;
                }
                $data .= '<tr>
                            <td>&emsp;&emsp;&emsp; ' . $chartRow['chart_name'] . '</td>
                            '.$td.'
                        </tr>';
                $tf_total += $tfsum;
            }

            
            if($counter > 0){
                $total_td .= "<td>".number_format($tf_total,2)."</td>";
            }

            $counter++;

            
        }



        $data .= "</tbody>
                    <tfoot>
                        <tr style='text-align:right;font-weight: bold;'>
                            <td>Total:</td>
                            ".$ft_td."
                        </tr>
                    </tfoot>
                </table>";

        echo $data;
    }
}
