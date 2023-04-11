<?php

class Clients extends Connection
{
    private $table = 'tbl_clients';
    public $pk = 'client_id';
    public $name = 'client_fname';

    public function add()
    {
        $client_fname = $this->clean($this->inputs['client_fname']);
        $client_mname = $this->clean($this->inputs['client_mname']);
        $client_lname = $this->clean($this->inputs['client_lname']);
        $client_name_extension = $this->clean($this->inputs['client_name_extension']);
        $is_exist = $this->select($this->table, $this->pk, "client_fname = '$client_fname' AND client_mname = '$client_mname' AND client_lname='$client_lname' AND client_name_extension='$client_name_extension'");
        if ($is_exist->num_rows > 0) {
            return -2;
        } else {
            $form = array(
                'client_fname'             => $client_fname,
                'client_mname'             => $client_mname,
                'client_lname'             => $client_lname,
                'client_name_extension'    => $client_name_extension,
                'client_address'           => $this->clean($this->inputs['client_address']),
                'client_dob'               => $this->clean($this->inputs['client_dob']),
                'client_contact_no'        => $this->clean($this->inputs['client_contact_no']),    
            );
            return $this->insert($this->table, $form);
        }
    }

    public function edit()
    {
        $primary_id = $this->inputs[$this->pk];
        $client_fname = $this->clean($this->inputs['client_fname']);
        $client_mname = $this->clean($this->inputs['client_mname']);
        $client_lname = $this->clean($this->inputs['client_lname']);
        $client_name_extension = $this->clean($this->inputs['client_name_extension']);
        $is_exist = $this->select($this->table, $this->pk, "client_fname = '$client_fname' AND client_mname = '$client_mname' AND client_lname='$client_lname' AND client_name_extension='$client_name_extension' AND $this->pk != '$primary_id'");
        if ($is_exist->num_rows > 0) {
            return 2;
        } else {
            $form = array(
                'client_fname'             => $client_fname,
                'client_mname'             => $client_mname,
                'client_lname'             => $client_lname,
                'client_name_extension'    => $client_name_extension,
                'client_address'           => $this->clean($this->inputs['client_address']),
                'client_dob'               => $this->clean($this->inputs['client_dob']),
                'client_contact_no'        => $this->clean($this->inputs['client_contact_no']),    
            );
            return $this->update($this->table, $form, "$this->pk = '$primary_id'");
        }
    }

    public function show()
    {
        $rows = array();
        $param = isset($this->inputs['param']) ? $this->inputs['param'] : null;
        $rows = array();
        $result = $this->select($this->table, '*', $param);
        while ($row = $result->fetch_assoc()) {
            $row['client_fullname'] = $row['client_fname']." ".$row['client_mname']." ".$row['client_lname']." ".$row['client_name_extension'];
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
        $result = $this->select($this->table, 'client_fname,client_mname,client_lname,client_name_extension', "$this->pk = '$primary_id'");
        $row = $result->fetch_assoc();
        return $row['client_fname']." ".$row['client_mname']." ".$row['client_lname']." ".$row['client_name_extension'];;
    }

    public function delete_entry()
    {
        $id = $this->inputs['id'];

        return $this->delete($this->table, "$this->pk = $id");
    }

}
