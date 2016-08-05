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
        $this->db->from('user_mst');
        $this->db->where('fk_role_id !=','1');
        $query = $this->db->get();
        
        if ($query->num_rows()>0) {
            return $query->result_array();
            return array();
        } else {
            return array();
        }
    }
    
    function get_user_list($pk_uid) {

        $this->db->select('*');
        $this->db->from('user_mst');
        $this->db->where('md5(pk_uid)',$pk_uid);        
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
       $this->db->insert('user_mst',$set_data);
       return ($this->db->affected_rows() > 0);
    }
    
    public function update_users($set_data,$pk_uid)
    {
        $this->db->where('md5(pk_uid)',$pk_uid);
        $this->db->update("user_mst",$set_data);
        return ($this->db->affected_rows() > 0);
    }

    public function check_exist_email($emailid,$pk_uid=NULL)
    {
        $this->db->select('*');
        $this->db->from('user_mst');
        $this->db->where('emailid',$emailid);  
        if($pk_uid!="")
        {
        $this->db->where('md5(pk_uid) !=',$pk_uid);        
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
    
    public function check_exist_vcnumber($vc_number,$pk_uid=NULL)
    {
        $this->db->select('*');
        $this->db->from('user_mst');
        $this->db->where('vc_number',$vc_number);  
        if($pk_uid!="")
        {
        $this->db->where('md5(pk_uid) !=',$pk_uid);        
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
    
    public function delete_user($pk_uid)
    {
        $this->db->where('md5(pk_uid)',$pk_uid);
        $this->db->delete("user_mst");
         return ($this->db->affected_rows() > 0);
    }
    
}
