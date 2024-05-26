<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Relationtype_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * This funtion takes id as a parameter and will fetch the record.
     * If id is not provided, then it will fetch all the records form the table.
     * @param int $id
     * @return mixed
     */
    public function get($id = null) {
        $this->db->select()->from('relation_types');

        // where condition if id is present
        if ($id != null) {
            $this->db->where('id', $id);
        } else {
            $this->db->order_by('id');
        }

        $query = $this->db->get();

        if ($id != null) {
            return $query->row_array(); // single row
        } else {
            return $query->result_array(); // array of result
        }
    }

    

   
    
    /**
     * This function will delete the record based on the id
     * @param $id
     */
    public function remove($id) {
        $this->db->where('id', $id);
        $this->db->delete('relation_types');
    }

    /**
     * This function will take the post data passed from the controller
     * If id is present, then it will do an update
     * else an insert. One function doing both add and edit.
     * @param $data
     */
    public function merge($data) {

        // comma must be the first and last character of String if it is not empty.
        
        $newId = "";
        $this->db->trans_start();

        if (isset($data['id']) && !empty($data['id'])) {

            $this->db->where('id', $data['id']);
            $this->db->update('relation_types', $data); // update the record
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                return get_app_message ( "response.failed" );
            } else {
                return get_app_message ( "response.success" );
            }
        } else {

            $this->db->insert('relation_types', $data); // insert new record
            $newId = $this->db->insert_id();
            $this->db->trans_complete();
            return $newId;
        }
    }

    

}
