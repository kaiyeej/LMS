<?php

class ChartOfAccounts extends Connection
{
    private $table = 'tbl_chart_of_accounts';
    public $pk = 'chart_id';
    public $name = 'chart_name';


    public function add()
    {

        $main_chart_id = (!isset($this->inputs['main_chart_id']) && $this->inputs['chart_type'] == "M" ? "" : $this->clean($this->inputs['main_chart_id']));
        $chart_type = $this->clean($this->inputs['chart_type']);
        if ($chart_type == "S") {
            $chart_class_id = $this->main_chart_class($main_chart_id);
        } else {
            $chart_class_id = $this->clean($this->inputs['chart_class_id']);
        }
        $form = array(
            $this->name         => $this->clean($this->inputs[$this->name]),
            'chart_code'        => $this->clean($this->inputs['chart_code']),
            'chart_type'        => $chart_type,
            'main_chart_id'     => $main_chart_id,
            'chart_class_id'    => $chart_class_id,
        );

        return $this->insertIfNotExist($this->table, $form, "$this->name = '" . $this->inputs[$this->name] . "'");
    }

    public function edit()
    {
        $primary_id = $this->inputs[$this->pk];
        $main_chart_id = (!isset($this->inputs['main_chart_id']) && $this->inputs['chart_type'] == "M" ? "" : $this->clean($this->inputs['main_chart_id']));
        $form = array(
            $this->name     => $this->clean($this->inputs[$this->name]),
            'chart_code'        => $this->clean($this->inputs['chart_code']),
            'chart_type'        => $this->clean($this->inputs['chart_type']),
            'main_chart_id'     => $main_chart_id,
        );

        return $this->updateIfNotExist($this->table, $form, "$this->pk = '$primary_id'");
    }

    public function show()
    {
        $param = isset($this->inputs['param']) ? $this->inputs['param'] : null;
        $rows = array();
        $ChartClassification = new ChartClassification;
        $result = $this->select($this->table, '*', $param);
        while ($row = $result->fetch_assoc()) {
            $row['type'] = $row['chart_type'] == "M" ? "Main" : "Sub";
            $row['main_chart'] = $this->name($row['main_chart_id']);
            $row['main_chart_id'] = $row['chart_id'];
            $row['credit_method'] = $row['chart_id'];
            $row['chart_class'] = $ChartClassification->name($row['chart_class_id']);
            $rows[] = $row;
        }
        return $rows;
    }

    public function view()
    {
        $primary_id = $this->inputs['id'];
        $result = $this->select($this->table, "*", "$this->pk = '$primary_id'");
        return $result->fetch_assoc();
    }

    public function remove()
    {
        $ids = implode(",", $this->inputs['ids']);

        return $this->delete($this->table, "$this->pk IN($ids)");
    }

    public function name($primary_id)
    {
        $result = $this->select($this->table, 'chart_name', "$this->pk = '$primary_id'");
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['chart_name'];
        } else {
            return '---';
        }
    }

    // public function trial_balance()
    // {
    //     $start_date = $this->inputs['start_date'];
    //     $end_date = $this->inputs['end_date'];
    //     $JournalEntry = new JournalEntry;
    //     $rows = array();
    //     $result = $this->select($this->table, '*');
    //     while ($row = $result->fetch_assoc()) {
    //         $JL = $JournalEntry->total_per_chart($start_date,$end_date,$row['chart_id']);
    //         $sub = $row['chart_type'] == "S" ? "&emsp;&emsp;&emsp; ↪ " : "";
    //         $row['chart_name'] = $sub.$row['chart_name'];
    //         $row['debit'] = number_format($JL['total_debit'],2);//$JL['total_debit'] > 0 ? number_format($JL['total_debit'],2) : "";
    //         $row['credit'] = number_format($JL['total_credit'],2);//$JL['total_credit'] > 0 ? number_format($JL['total_credit'],2) : "";
    //         $rows[] = $row;
    //     }
    //     return $rows;
    // }

    public function trial_balance()
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

        $data = '<table class="div1" width="100%" cellspacing="0">
                    <thead style="background: #1f384b;">
                        <tr style="text-align:center;">
                            <td style="background: #1f384b;color:#fff;border: 0px;border-right: 1px solid #bbbbbb;">CHART OF ACCOUNTS</td>' .$th_jl. '
                            <td colspan="2"></td>
                        </tr>
                        <tr style="background: #607d8b;">
                            <td style="background: #1f384b;border: 0px;border-right: 1px solid #bbbbbb;"></td>' .$th_dc_jl . '
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
                    $bb_total = $JL['total_debit']-$JL['total_credit'];
                    $total_bb = $bb_total;
                
                    $td_ .= "<td style='text-align:right;'>" . number_format($bb_total,2) . "</td>";
                } else {
                    $td_ .= "<td style='text-align:right;'>" . $debit . "</td><td style='text-align:right;'>" . $credit . "</td>";
                }
                
                $total_debit += $JL['total_debit'];
                $total_credit += $JL['total_credit'];
            }
            $net_movement = $total_debit-$total_credit;
            $unadjusted_movement = $total_bb-$net_movement;
            $td_ .= "<td style='text-align:right;'>".$net_movement."</td><td style='text-align:right;'>".$unadjusted_movement."</td></tr>";
            $data .= $td_;
        }



        $data .= "</tbody><tfoot style='text-align:right;background: #1f384b;color:#fff;'></tfoot></table>";
        echo $data;
    }

    public function main_chart_class($primary_id)
    {
        $result = $this->select($this->table, "chart_class_id", "$this->pk = '$primary_id'");
        $row = $result->fetch_assoc();
        return $row['chart_class_id'];
    }

    public function chart_data($code)
    {
        $result = $this->select($this->table, '*', "chart_name like '%$code%'");
        return $result->fetch_assoc();
    }


    public function schema()
    {
        if (DEVELOPMENT) {
            $default['date_added'] = $this->metadata('date_added', 'datetime', '', 'NOT NULL', 'CURRENT_TIMESTAMP');
            $default['date_last_modified'] = $this->metadata('date_last_modified', 'datetime', '', 'NOT NULL', '', 'ON UPDATE CURRENT_TIMESTAMP');
            $default['user_id'] = $this->metadata('user_id', 'int', 11);


            // TABLE HEADER
            $tables[] = array(
                'name'      => $this->table,
                'primary'   => $this->pk,
                'fields' => array(
                    $this->metadata($this->pk, 'int', 11, 'NOT NULL', '', 'AUTO_INCREMENT'),
                    $this->metadata($this->name, 'varchar', 50),
                    $this->metadata('chart_code', 'varchar', 10),
                    $this->metadata('chart_type', 'varchar', 1),
                    $this->metadata('main_chart_id', 'int', 11),
                    $this->metadata('chart_class_id', 'int', 11),
                    $default['user_id'],
                    $default['date_added'],
                    $default['date_last_modified']
                )
            );

            return $this->schemaCreator($tables);
        }
    }
}
