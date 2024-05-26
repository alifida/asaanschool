<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Configuration_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get($key = null) {
        $this->db->select()->from('configurations');
        // where condition if key is present
        if($key == null){
        	return "";
        }
        $this->db->where('key', $key);
        $query = $this->db->get();
        return $query->row_array(); // single row
        
    }
    public function getId($id = null) {
        $this->db->select()->from('configurations');

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


     public function getValue($key = null) {
        $this->db->select()->from('configurations');
        if($key == null){
        	return "???";
        }
        $this->db->where('key', $key);
        $query = $this->db->get();
        $rs = $query->row_array(); // single row
        
     	if(!empty($rs) && isset($rs["key"])){
    		return $rs["value"];
    	}else{
    		return "???".$key."???";
    	}
        
    }
    
    
    public function remove($key) {
        $this->db->where('key', $key);
        $this->db->delete('configurations');
    }

    public function merge($data) {

        $newkey = "";
        $this->db->trans_start();

        if (isset($data['key']) && !empty($data['key'])) {

            $this->db->where('key', $data['key']);
            $this->db->update('configurations', $data); // update the record
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                return get_app_message ( "response.failed" );
            } else {
                return get_app_message ( "response.success" );
            }
        } else {

            $this->db->insert('configurations', $data); // insert new record
            $this->db->insert_key();
            $this->db->trans_complete();
            return "saved";
        }
    }

	public function update($data) {

        $newkey = "";
        $this->db->trans_start();

        if (isset($data['id']) && !empty($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('configurations', $data); // update the record
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                return get_app_message ( "response.failed" );
            } else {
                return get_app_message ( "response.success" );
            }
        }
    }
   
   
}
