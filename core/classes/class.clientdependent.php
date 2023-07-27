<?php

class ClientDependent extends Connection
{
    private $table = 'tbl_client_dependents';
    public $pk = 'dependent_id';
    public $fk = 'client_id';

    public $inputs;

    public function addOrUpdate()
    {
        $fk = $this->clean($this->inputs[$this->fk]);
        $no_of_children = $this->clean($this->inputs['no_of_children']);
        $dep_no_of_child = $this->clean($this->inputs['dep_no_of_child']);
        $dep_college = $this->clean($this->inputs['dep_college']);
        $dep_hs = $this->clean($this->inputs['dep_hs']);
        $dep_elem = $this->clean($this->inputs['dep_elem']);
        $is_exist = $this->select($this->table, $this->pk, "client_id = '$fk'");

        $form = array(
            'client_id'         => $fk,
            'no_of_children'    => $no_of_children,
            'dep_no_of_child'   => $dep_no_of_child,
            'dep_college'       => $dep_college,
            'dep_hs'            => $dep_hs,
            'dep_elem'          => $dep_elem,
        );

        return $is_exist->num_rows > 0 ? $this->update($this->table, $form, "client_id = '$fk'") : $this->insert($this->table, $form);
    }

    public function view()
    {
        $client_id = $this->inputs['client_id'];
        $result = $this->select($this->table, "*", "client_id = '$client_id'");
        if ($result->num_rows < 1)
            return array(
                'no_of_children'    => 0,
                'dep_no_of_child'   => 0,
                'dep_college'       => 0,
                'dep_hs'            => 0,
                'dep_elem'          => 0,
            );

        $row = $result->fetch_assoc();
        return $row;
    }

    public function schema()
    {
        if (DEVELOPMENT) {
            $default['date_added'] = $this->metadata('date_added', 'datetime', '', 'NOT NULL', 'CURRENT_TIMESTAMP');
            $default['date_last_modified'] = $this->metadata('date_last_modified', 'datetime', '', 'NOT NULL', 'CURRENT_TIMESTAMP', 'ON UPDATE CURRENT_TIMESTAMP');


            // TABLE HEADER
            $tables[] = array(
                'name'      => $this->table,
                'primary'   => $this->pk,
                'fields' => array(
                    $this->metadata($this->pk, 'int', 11, 'NOT NULL', '', 'AUTO_INCREMENT'),
                    $this->metadata('client_id', 'int', 11),
                    $this->metadata('no_of_children', 'int', 11),
                    $this->metadata('dep_no_of_child', 'int', 11),
                    $this->metadata('dep_college', 'int', 11),
                    $this->metadata('dep_hs', 'int', 11),
                    $this->metadata('dep_elem', 'int', 11),
                    $default['date_added'],
                    $default['date_last_modified']
                )
            );

            return $this->schemaCreator($tables);
        }
    }
}

// CREATE TABLE `tbl_client_dependents` (
//     `dependent_id` INT(11) NOT NULL AUTO_INCREMENT,
//     `client_id` INT(11) NOT NULL DEFAULT '0',
//     `no_of_children` INT(11) NOT NULL DEFAULT '0',
//     `dep_no_of_child` INT(11) NOT NULL DEFAULT '0',
//     `dep_college` INT(11) NOT NULL DEFAULT '0',
//     `dep_hs` INT(11) NOT NULL DEFAULT '0',
//     `dep_elem` INT(11) NOT NULL DEFAULT '0',
//     `date_added` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
//     `date_last_modified` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
//     PRIMARY KEY (`dependent_id`) USING BTREE
// )
// COLLATE='latin1_swedish_ci'
// ENGINE=InnoDB
// ;
