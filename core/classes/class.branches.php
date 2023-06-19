<?php

class Branches extends Connection
{
    private $table = 'tbl_branches';
    public $pk = 'branch_id';
    public $name = 'branch_name';


    public function add()
    {
        $form = array(
            $this->name     => $this->clean($this->inputs[$this->name]),
            'remarks'       => $this->clean($this->inputs['remarks']),
        );

        return $this->insertIfNotExist($this->table, $form, "$this->name = '" . $this->inputs[$this->name] . "'");
    }

    public function edit()
    {
        $primary_id = $this->inputs[$this->pk];
        $form = array(
            $this->name     => $this->clean($this->inputs[$this->name]),
            'remarks'       => $this->clean($this->inputs['remarks']),
        );

        return $this->updateIfNotExist($this->table, $form, "$this->pk = '$primary_id'");
    }

    public function show()
    {
        $param = isset($this->inputs['param']) ? $this->inputs['param'] : null;
        $rows = array();
        $result = $this->select($this->table, '*', $param);
        while ($row = $result->fetch_assoc()) {
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
        $result = $this->select($this->table, 'branch_name', "$this->pk = '$primary_id'");
        $row = $result->fetch_assoc();
        return $row['branch_name'];
    }


    public function penalty_percentage($primary_id)
    {
        $result = $this->select($this->table, 'penalty_percentage', "$this->pk = '$primary_id'");
        $row = $result->fetch_assoc();
        return $row['penalty_percentage'];
    }

    public function total_per_month($primary_id, $month, $year)
    {

        $result = $this->select("tbl_loans", "sum(loan_amount) as total", "MONTH(loan_date) = '$month' AND YEAR(loan_date) = '$year' AND (status = 'R' OR status='F') AND $this->pk = '$primary_id'");
        $row = $result->fetch_assoc();
        return $row['total'];
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
                    $this->metadata($this->name, 'varchar', 75),
                    $this->metadata('remarks', 'text'),
                    $default['user_id'],
                    $default['date_added'],
                    $default['date_last_modified']
                )
            );

            return $this->schemaCreator($tables);
        }
    }
}

// CREATE TABLE `tbl_branches` (
//     `branch_id` INT(11) NOT NULL AUTO_INCREMENT,
//     `branch_name` VARCHAR(50) NOT NULL COLLATE 'latin1_swedish_ci',
//     `remarks` TEXT NOT NULL COLLATE 'latin1_swedish_ci',
//     `date_added` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
//     `date_last_modified` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
//     `user_id` INT(11) NOT NULL,
//     PRIMARY KEY (`branch_id`) USING BTREE
// )
// COLLATE='latin1_swedish_ci'
// ENGINE=InnoDB
// AUTO_INCREMENT=3
// ;
