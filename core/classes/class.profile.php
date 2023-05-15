<?php

class Profile extends Connection
{
    private $table = 'tbl_users';
    private $pk = 'user_id';
    private $name = 'username';


    public function edit()
    {
        $primary_id = $_SESSION['lms_user_id'];
        $username = $this->clean($this->inputs['username']);
        $is_exist = $this->select($this->table, $this->pk, "username = '$username' AND  $this->pk != '$primary_id'");
        if ($is_exist->num_rows > 0) {
            return 2;
        } else {
            $form = array(
                'user_fname' => $this->inputs['user_fname'],
                'user_mname' => $this->inputs['user_mname'],
                'user_lname' => $this->inputs['user_lname'],
                'username' => $this->inputs['username'],
            );
            return $this->update($this->table, $form, "$this->pk = '$primary_id'");
        }
    }


    public function update_password()
    {
        $primary_id = $_SESSION['lms_user_id'];
        $old_password = $this->inputs['old_password'];
        $is_exist = $this->select($this->table, $this->pk, "password = md5('$old_password') AND $this->pk = '$primary_id'");
        if ($is_exist->num_rows <= 0) {
            return 2;
        } else {
            $pass = $this->clean($this->inputs['new_password']);
            $form = array(
                'password' => md5($pass)
            );
            return $this->update($this->table, $form, "$this->pk = '$primary_id'");
        }
    }

    public function show()
    {
        $rows = array();
        $result = $this->select($this->table);
        while ($row = $result->fetch_assoc()) {
            $row['category'] = $row['user_category'] == "A" ? "Admin" :  "Instructor";
            $rows[] = $row;
        }
        return $rows;
    }

    public function view()
    {
        $primary_id = $_SESSION['lms_user_id'];
        $result = $this->select($this->table, "*", "$this->pk = '$primary_id'");
        $row = $result->fetch_assoc();
        $row['category'] = $row['user_category'] == "A" ? "Admin" : "Staff";
        return $row;
    }

    public static function name($primary_id)
    {
        $self = new self;
        $result = $self->select($self->table, $self->name, "$self->pk  = '$primary_id'");
        $row = $result->fetch_assoc();
        return $row[$self->name];
    }
}
