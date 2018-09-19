<?php

class Csv_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
        
    }
    

    function insert_csv($data) {
        $this->db->insert('disbvalues', $data);
    }
    public function get_all_header() {
        $query = $this->db
                ->select('COLUMN_NAME')
                ->from('INFORMATION_SCHEMA.COLUMNS')
                ->where('table_name', 'disbvalues')
                ->get();
        return $query->result();
    }
}
/*END OF FILE*/
