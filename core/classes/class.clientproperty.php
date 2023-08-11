<?php

class ClientProperty extends Connection
{
    private $table = 'tbl_client_property';
    public $pk = 'property_id';
    public $fk = 'client_id';

    public $inputs;

    public function add()
    {
        $property_location = $this->clean($this->inputs['property_location']);
        $form = array(
            $this->fk                   => $this->inputs[$this->fk],
            'property_location'         => $property_location,
            'property_area'             => $this->clean($this->inputs['property_area']),
            'property_acquisition_cost' => $this->clean($this->inputs['property_acquisition_cost']),
            'property_pres_market_val'  => $this->clean($this->inputs['property_pres_market_val']),
            'property_improvement'      => $this->clean($this->inputs['property_improvement']),

        );
        return $this->insertIfNotExist($this->table, $form, "property_location = '" . $property_location . "' AND $this->fk='" . $this->inputs[$this->fk] . "'");
    }

    public function show()
    {
        $rows = array();
        $param = isset($this->inputs['param']) ? $this->inputs['param'] : null;
        $rows = array();
        $result = $this->select($this->table, '*', $param);
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function get_property()
    {
        $param = isset($this->inputs['param']) ? $this->inputs['param'] : null;
        $rows = "";
        $result = $this->select($this->table, '*', $param);
        while ($row = $result->fetch_assoc()) {

            $rows .=    '<div class="col-md-3"><h6>' . $row['property_location'] . '</h6></div>' .
                '<div class="col-md-2"><h6>' . $row['property_area'] . '</h6></div>' .
                '<div class="col-md-2"><h6>' . $row['property_acquisition_cost'] . '</h6></div>' .
                '<div class="col-md-2"><h6>' . $row['property_pres_market_val'] . '</h6></div>' .
                '<div class="col-md-3"><h6>' . $row['property_improvement'] . '</h6></div>';
        }
        return $rows;
    }

    public function remove()
    {
        $id = $this->inputs['id'];

        return $this->delete($this->table, "property_id = $id");
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
                $this->metadata('client_id', 'int', 11),
                $this->metadata('property_location', 'varchar', 250),
                $this->metadata('property_area', 'varchar', 250),
                $this->metadata('property_acquisition_cost', 'decimal', '12,3'),
                $this->metadata('property_pres_market_val', 'decimal', '12,3'),
                $this->metadata('property_improvement', 'varchar', 50),
                $default['date_added'],
                $default['date_last_modified']
            )
        );

        return $this->schemaCreator($tables);
    }

    public function triggers()
    {
        // HEADER
        $triggers[] = array(
            'table' => $this->table,
            'name' => 'delete_' . $this->table,
            'action_time' => 'BEFORE', // ['AFTER','BEFORE']
            'event' => "DELETE", // ['INSERT','UPDATE', 'DELETE']
            "statement" => "INSERT INTO " . $this->table . "_deleted SELECT * FROM $this->table WHERE $this->pk = OLD.$this->pk"
        );
        return $this->triggerCreator($triggers);
    }
}
