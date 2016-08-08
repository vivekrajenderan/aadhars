<?php

class Common_model extends CI_Model {

    function __construct() {
        parent::__construct();
        date_default_timezone_set('America/New_York');
        $this->load->helper('url');
        $this->load->library('table', 'session');
        $this->load->database();
    }

    function user_lists() {

        $this->db->select('*');
        $this->db->from('cust_mst');        
        $query = $this->db->get();
        
        if ($query->num_rows()>0) {
            return $query->result_array();
            return array();
        } else {
            return array();
        }
    }
    
    public function category_lists() {

        $this->db->select('*');
        $this->db->from('category_mst');
        $this->db->where('standing','1');
        $query = $this->db->get();
        
        if ($query->num_rows()>0) {
            return $query->result_array();
            return array();
        } else {
            return array();
        }
    }
    
     public function channel_lists() {
        $this->db->select('sc.*,c.cate_name');
        $this->db->from('channel_mst as sc');
        $this->db->join('category_mst as c','sc.fk_cat_id=c.pk_cat_id');        
        $query = $this->db->get();        
        if ($query->num_rows()>0) {
            return $query->result_array();
            return array();
        } else {
            return array();
        }
    }
    
}
