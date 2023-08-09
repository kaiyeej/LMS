<?php

class Users extends Connection
{
    private $table = 'tbl_users';
    private $pk = 'user_id';
    private $name = 'username';

    public $inputs;

    public function add()
    {
        $username = $this->clean($this->inputs['username']);
        $is_exist = $this->select($this->table, $this->pk, "username = '$username'");
        if ($is_exist->num_rows > 0) {
            return 2;
        } else {
            $pass = $this->inputs['password'];
            $form = array(
                'user_fname' => $this->inputs['user_fname'],
                'user_mname' => $this->inputs['user_mname'],
                'user_lname' => $this->inputs['user_lname'],
                'user_category_id' => $this->inputs['user_category_id'],
                'username' => $this->inputs['username'],
                'password' => md5($pass)
            );
            return $this->insert($this->table, $form);
        }
    }

    public function edit()
    {
        $primary_id = $this->inputs[$this->pk];
        $username = $this->clean($this->inputs['username']);
        $is_exist = $this->select($this->table, $this->pk, "username = '$username' AND  $this->pk != '$primary_id'");
        if ($is_exist->num_rows > 0) {
            return 2;
        } else {
            $form = array(
                'user_fname'            => $this->inputs['user_fname'],
                'user_mname'            => $this->inputs['user_mname'],
                'user_lname'            => $this->inputs['user_lname'],
                'user_category_id'      => $this->inputs['user_category_id'],
                'username'              => $this->inputs['username'],
            );
            return $this->update($this->table, $form, "$this->pk = '$primary_id'");
        }
    }


    public function remove()
    {
        $ids = implode(",", $this->inputs['ids']);
        return $this->delete($this->table, "$this->pk IN($ids)");
    }


    public function delete_entry()
    {
        $id = $this->inputs['id'];

        return $this->delete($this->table, "$this->pk = $id");
    }

    public function show()
    {
        $param = isset($this->inputs['param']) ? $this->inputs['param'] : null;
        $rows = array();
        $UserCategories = new UserCategories;
        $result = $this->select($this->table, '*', $param);
        while ($row = $result->fetch_assoc()) {
            $row['user_fullname'] = $row['user_fname'] . " " . $row['user_mname'] . " " . $row['user_lname'];
            $row['user_category_name'] = ""; //$UserCategories->name($row['user_category_id']);
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

    public static function name($primary_id)
    {
        $self = new self;
        $result = $self->select($self->table, $self->name, "$self->pk  = '$primary_id'");
        $row = $result->fetch_assoc();
        return $row[$self->name];
    }

    public static function fullname($primary_id)
    {
        $self = new self;
        $result = $self->select($self->table, 'user_fname,user_mname,user_lname', "$self->pk  = '$primary_id'");

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['user_fname'] . " " . $row['user_mname'] . " " . $row['user_lname'];
        } else {
            return "---";
        }
    }

    public static function number($primary_id)
    {
        $self = new self;
        $result = $self->select($self->table, 'user_contact_num', "$self->pk  = '$primary_id'");
        if ($result->num_rows > 0) {
            $row = $result->fetch_array();
            return $row[0];
        } else {
            return null;
        }
    }

    public static function dataRow($primary_id, $field = "*")
    {
        $self = new self;
        $result = $self->select($self->table, $field, "$self->pk  = '$primary_id'");
        if ($result->num_rows > 0) {
            $row = $result->fetch_array();
            return $row[$field];
        } else {
            return null;
        }
    }

    public function login()
    {

        $username = $this->inputs['username'];
        $password = $this->inputs['password'];

        $result = $this->select($this->table, "*", "username = '$username' AND password = md5('$password')");
        $row = $result->fetch_assoc();

        if ($row) {
            $_SESSION['lms_user_id'] = $row['user_id'];
            $_SESSION['lms_user_category_id'] = $row['user_category_id'];

            $res = 1;
        } else {
            $res = 0;
        }

        // return $row[$this->name];

        return $res;
    }

    public function logout()
    {
        session_destroy();
        return 1;
    }

    public function schema()
    {
        $default['date_added'] = $this->metadata('date_added', 'datetime', '', 'NOT NULL', 'CURRENT_TIMESTAMP');
        $default['date_last_modified'] = $this->metadata('date_last_modified', 'datetime', '', 'NOT NULL', 'CURRENT_TIMESTAMP', 'ON UPDATE CURRENT_TIMESTAMP');


        // TABLE HEADER
        $tables[] = array(
            'name'      => $this->table,
            'primary'   => $this->pk,
            'fields' => array(
                $this->metadata($this->pk, 'int', 11, 'NOT NULL', '', 'AUTO_INCREMENT'),
                $this->metadata($this->name, 'varchar', 50),
                $this->metadata('user_fname', 'varchar', 50),
                $this->metadata('user_mname', 'varchar', 50),
                $this->metadata('user_lname', 'varchar', 50),
                $this->metadata('user_category_id', 'int', 11),
                $this->metadata('user_category', 'varchar', 1),
                $this->metadata('password', 'text'),
                $default['date_added'],
                $default['date_last_modified']
            )
        );

        return $this->schemaCreator($tables);
    }
}
