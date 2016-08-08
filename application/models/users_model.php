<?php

class Users_model extends CI_Model {

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
    
    function get_user_list($pk_cust_id) {

        $this->db->select('*');
        $this->db->from('cust_mst');
        $this->db->where('md5(pk_cust_id)',$pk_cust_id);        
        $query = $this->db->get();
        
        if ($query->num_rows()>0) {
            return $query->result_array();
            return array();
        } else {
            return array();
        }
    }
    
    public function save_users($set_data)
    {
       $this->db->insert('cust_mst',$set_data);
       return ($this->db->affected_rows() > 0);
    }
    
    public function update_users($set_data,$pk_cust_id)
    {
        $this->db->where('md5(pk_cust_id)',$pk_cust_id);
        $this->db->update("cust_mst",$set_data);
        return ($this->db->affected_rows() > 0);
    }

    public function check_exist_email($emailid,$pk_cust_id=NULL)
    {
        $this->db->select('*');
        $this->db->from('cust_mst');
        $this->db->where('emailid',$emailid);  
        if($pk_cust_id!="")
        {
        $this->db->where('md5(pk_cust_id) !=',$pk_cust_id);        
        }
        $query = $this->db->get();
        //echo $this->db->last_query();
        if ($query->num_rows()>0) {
            return $query->result_array();
            return array();
        } else {
            return array();
        }
    }
    
    public function check_exist_vcnumber($vc_number,$pk_cust_id=NULL)
    {
        $this->db->select('*');
        $this->db->from('cust_mst');
        $this->db->where('vc_number',$vc_number);  
        if($pk_cust_id!="")
        {
        $this->db->where('md5(pk_cust_id) !=',$pk_cust_id);        
        }
        $query = $this->db->get();
        //echo $this->db->last_query();
        if ($query->num_rows()>0) {
            return $query->result_array();
            return array();
        } else {
            return array();
        }
    }
    
    public function delete_user($pk_cust_id)
    {
        $this->db->where('md5(pk_cust_id)',$pk_cust_id);
        $this->db->delete("cust_mst");
         return ($this->db->affected_rows() > 0);
    }
    
}
