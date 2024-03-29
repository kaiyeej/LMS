<?php
class Connection
{
    public $que;
    private $servername = HOST;
    private $username = USER;
    private $password = PASSWORD;
    private $dbname = DBNAME;
    private $result = array();
    private $mysqli = '';

    public $action_response = "";
    //private $userID = USERID;


    public function __construct()
    {
        $this->mysqli = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        // Check for connection errors
        if ($this->mysqli->connect_error) {
            die("Connection failed: " . $this->mysqli->connect_error);
        }

        // Set the character set
        if (!$this->mysqli->set_charset("utf8")) {
            die("Error loading character set utf8: " . $this->mysqli->error);
        }
    }

    public function checker()
    {
        if ($this->mysqli->connect_errno) {
            throw new Exception('Failed to connect to MySQL: ' . $this->mysqli->connect_error);
        }
    }

    public function begin_transaction()
    {
        $this->mysqli->begin_transaction();
    }

    public function commit()
    {
        $this->mysqli->commit();
    }

    public function rollback()
    {
        $this->mysqli->rollback();
    }

    public function insert($table, $para = array(), $last_id = 'N')
    {
        $table_columns = implode(',', array_keys($para));
        $table_value = implode("','", $para);

        $sql = "INSERT INTO $table($table_columns) VALUES('$table_value')";

        if ($this->mysqli->query($sql) === TRUE)
            return ($last_id == 'Y') ? $this->mysqli->insert_id : 1;
        return $this->mysqli->error;
    }

    public function insert_logs($remarks)
    {
        $form = array(
            'remarks'   => $remarks,
            'user_id'   => $_SESSION['cdms_user_id'],
        );

        $this->insert('tbl_logs', $form);
    }

    public function insert_select($table, $table_select, $para, $where_clause = '')
    {
        $table_columns = array_keys($para);
        $table_value = implode(",", $para);
        $inject = ($where_clause == '') ? "" : "WHERE $where_clause";

        $sql = "INSERT INTO " . $table . " (`" . implode('`,`', $table_columns) . "`) SELECT $table_value FROM $table_select $inject";

        $result = $this->mysqli->query($sql) or die($this->mysqli->error);
        return $result ? 1 : 0;
    }

    public function insertIfNotExist($table, $form, $param = '', $last_id = 'N')
    {
        $name = $this->clean($this->inputs[$this->name]);
        $inject = $param != '' ? $param : "$this->name = '$name'";
        $is_exist = $this->select($table, $this->pk, $inject);
        if ($is_exist->num_rows > 0) {
            $this->action_response = "Data already exist ($name)";
            return $last_id == 'Y' ? -2 : 2;
        } else {
            $response = $this->insert($table, $form, $last_id);
            $this->action_response =  $response > 0 ? "Successfully added data ($name)" : "Error occur while adding data ($name)";
            return $response;
        }
    }

    public function update($table, $para = array(), $id)
    {
        $args = array();

        foreach ($para as $key => $value) {
            $args[] = "$key = '$value'";
        }

        $sql = "UPDATE  $table SET " . implode(',', $args);
        $sql .= " WHERE $id";

        return $this->mysqli->query($sql) === TRUE ? 1 : $this->mysqli->error;
    }

    public function updateIfNotExist($table, $form)
    {
        $primary_id = $this->inputs[$this->pk];
        $name = $this->clean($this->inputs[$this->name]);
        $is_exist = $this->select($table, $this->pk, "$this->name = '$name' AND $this->pk != '$primary_id'");
        if ($is_exist->num_rows > 0) {
            $this->action_response = "Data already exist ($name)";
            return 2;
        }
        $response =  $this->update($table, $form, "$this->pk = '$primary_id'");
        $this->action_response =  $response > 0 ? "Successfully updated data ($name)" : "Error occur while updating data ($name)";
        return $response;
    }

    public function delete($table, $id)
    {
        $sql = "DELETE FROM $table";
        $sql .= " WHERE $id ";
        $sql;
        return $this->mysqli->query($sql) === TRUE ? 1 : $this->mysqli->error;
    }

    public $sql;

    public function select($table, $rows = "*", $where = null)
    {
        $sql = "SELECT $rows FROM $table";
        $inject = $where != null ? " WHERE $where" : "";

        $sql .= $inject;

        return $this->mysqli->query($sql);
    }

    public function query($sql)
    {
        return $this->mysqli->query($sql);
    }

    public function encrypt($password, $algo = PASSWORD_DEFAULT)
    {
        return password_hash($password, $algo);
    }

    public function clean($slug)
    {
        if (is_string($slug)) {
            return filter_var($slug, FILTER_SANITIZE_STRING);
        } else {
            return $slug;
        }
    }

    public function getCurrentDate()
    {
        ini_set('date.timezone', 'UTC');
        //error_reporting(E_ALL);
        date_default_timezone_set('UTC');
        $today = date('H:i:s');
        $system_date = date('Y-m-d H:i:s', strtotime($today) + 28800);
        return $system_date;
    }

    public function metadata($name, $type, $length = '', $allow_null = 'NOT NULL', $default = '', $extra = '', $comment = '')
    {
        return array(
            'name'          => $name,
            'type'          => $type,
            'length'        => $length,
            'allow_null'    => $allow_null,
            'default'       => $default,
            'extra'         => $extra,
            'comment'       => $comment,
        );
    }

    public function schemaCreator($tables)
    {
        $create = [];
        foreach ($tables as $table) {
            $name = $table['name'];
            $fields = $table['fields'];
            $is_exists = $this->table_exists($name);

            $field_list = array();
            foreach ($fields as $field) {

                $fld = array();
                $fld[] = "`$field[name]`";
                $fld[] = $field['type'] . ($field['length'] > 0 ? "($field[length])" : "");
                $fld[] = $field['allow_null'];
                $fld[] = $field['default'] != '' ? "DEFAULT $field[default]" : "";
                $fld[] = $field['extra'];
                $fld[] = $field['comment'] != '' ? "COMMENT $field[comment]" : "";

                if ($is_exists == 1) {
                    // $is_column_exists
                    if ($this->column_exists($name, $field['name']) != 1) {
                        array_push($field_list, (" ADD " . implode(" ", $fld)));
                    }
                } else {
                    $metadata = implode(" ", $fld);
                    array_push($field_list, $metadata);
                }
            }
            $is_exists == 1 ? "" : array_push($field_list, "PRIMARY KEY (`{$table['primary']}`)");
            if (count($field_list) > 0) {
                if ($is_exists == 1) {
                    $query = "ALTER TABLE `$name`";
                } else {
                    $query = "CREATE TABLE `$name` (";
                }
                $query .= implode(",", $field_list);
                $query .= $is_exists == 1 ? "" : ') ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;';
                $status = $this->mysqli->query($query);
                $create[] = ['table' => $name, 'status' => $status, 'query' => $query, 'error' => $this->mysqli->error];
            }
        }
        return $create;
    }

    public function triggerCreator($triggers)
    {
        $create = [];
        foreach ($triggers as $trigger) {
            $trigger_name   = $trigger['name'];
            $table          = $trigger['table'];
            $action_time    = $trigger['action_time'];
            $event          = $trigger['event'];
            $statement      = $trigger['statement'];

            $query = "";

            if (is_array($statement) == 1) {
                // $query .= "DELIMITER $$";
                $statements = "\n\t" . implode("\n\t", $statement) . "\n";
                $begin = "BEGIN";
                $end = "END;";
            } else {
                $statements = $statement;
                $begin = "";
                $end = "";
            }

            $query .= "CREATE TRIGGER $trigger_name $action_time $event ON $table FOR EACH ROW $begin $statements $end";
            $status = $this->mysqli->query($query);
            $create[] = ['trigger_name' => $trigger_name, 'status' => $status, 'query' => $query, 'error' => $this->mysqli->error];
        }

        return $create;
    }

    function table_exists($table)
    {
        $result = $this->mysqli->query("SHOW TABLES LIKE '{$table}'");
        if ($result->num_rows == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
        $result->free();
    }

    function column_exists($table_name, $column_name)
    {
        $db_name = DBNAME;
        $result = $this->mysqli->query("SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '$db_name' AND TABLE_NAME = '$table_name' AND COLUMN_NAME = '$column_name'");
        if ($result->num_rows == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
        $result->free();
    }

    public $join = array();
    public $tablename = '';
    public $select2 = array();
    public $where = array();
    public $groupBy = '';

    public function table($table)
    {
        $this->tablename = $table;
        return $this;
    }

    public function selectRaw(...$select2)
    {
        foreach ($select2 as $query) {
            $this->select2[] = $query;
        }
        return $this;
    }

    public function join($table, $from, $identifier, $to)
    {
        $this->join[] = "INNER JOIN $table ON $from $identifier $to";
        return $this;
    }

    public function where($column, $equal, $to = '')
    {
        $where = ($to != '') ? "$equal '$to'" : "= '$equal'";
        $this->where[] = "$column $where";
        return $this;
    }

    public function groupBy($column)
    {
        $this->groupBy = "GROUP BY $column";
        return $this;
    }

    public function get()
    {
        $where = count($this->where) > 0 ? "WHERE " . implode(' AND ', $this->where) : '';
        $sql = "SELECT " . (count($this->select2) > 0 ? implode(",", $this->select2) : '*') . " FROM $this->tablename " . implode(' ', $this->join) . " $where $this->groupBy";

        return $this->mysqli->query($sql);
    }

    public function __destruct()
    {
        $this->mysqli->close();
    }

    public function get_user_data($uid = null)
    {
        return $uid == null ?: $_SESSION['cdms_user_id'];
    }

    public function sendSms($number, $message)
    {
        $apicode = "TR-KAYEJ506368_04FA2";
        $passwd = 'kayeGwapa';
        $url = 'https://www.itexmo.com/php_api/api.php';
        $itexmo = array('1' => $number, '2' => $message, '3' => $apicode, 'passwd' => $passwd);
        $param = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($itexmo),
            ),
        );
        $context  = stream_context_create($param);
        return file_get_contents($url, false, $context);
    }


    public function convertNumberToWord($num = false)
    {
        $num = str_replace(array(',', ' '), '', trim($num));
        if (!$num) {
            return false;
        }
        $num = (int) $num;
        $words = array();
        $list1 = array(
            '', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven',
            'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'
        );
        $list2 = array('', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety', 'hundred');
        $list3 = array(
            '', 'thousand', 'million', 'billion', 'trillion', 'quadrillion', 'quintillion', 'sextillion', 'septillion',
            'octillion', 'nonillion', 'decillion', 'undecillion', 'duodecillion', 'tredecillion', 'quattuordecillion',
            'quindecillion', 'sexdecillion', 'septendecillion', 'octodecillion', 'novemdecillion', 'vigintillion'
        );
        $num_length = strlen($num);
        $levels = (int) (($num_length + 2) / 3);
        $max_length = $levels * 3;
        $num = substr('00' . $num, -$max_length);
        $num_levels = str_split($num, 3);
        for ($i = 0; $i < count($num_levels); $i++) {
            $levels--;
            $hundreds = (int) ($num_levels[$i] / 100);
            $hundreds = ($hundreds ? ' ' . $list1[$hundreds] . ' hundred' . ' ' : '');
            $tens = (int) ($num_levels[$i] % 100);
            $singles = '';
            if ($tens < 20) {
                $tens = ($tens ? ' ' . $list1[$tens] . ' ' : '');
            } else {
                $tens = (int)($tens / 10);
                $tens = ' ' . $list2[$tens] . ' ';
                $singles = (int) ($num_levels[$i] % 10);
                $singles = ' ' . $list1[$singles] . ' ';
            }
            $words[] = $hundreds . $tens . $singles . (($levels && (int) ($num_levels[$i])) ? ' ' . $list3[$levels] . ' ' : '');
        } //end for loop
        $commas = count($words);
        if ($commas > 1) {
            $commas = $commas - 1;
        }
        return implode(' ', $words);
    }
}
