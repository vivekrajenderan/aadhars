<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Webservice_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function check_login_verify($vc_number, $mobileno) {
        $row=array();
        $this->db->select('pk_cust_id,fname,lname,emailid,mobileno,vc_number');
        $this->db->from('cust_mst');
        $this->db->where('vc_number', $vc_number);
        $this->db->where('mobileno', $mobileno);
        $this->db->where('standing', '1');
        $query = $this->db->get();       
        if ($query->num_rows() > 0) {
            $row = $query->row_array();
            return $row;
        } else {
            return $row;
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
     public function sub_category_lists() {
        $this->db->select('cm.*,c.cate_name');
        $this->db->from('channel_mst as cm');
        $this->db->join('category_mst as c','cm.fk_cat_id=c.pk_cat_id');        
        $query = $this->db->get();        
        if ($query->num_rows()>0) {
            return $query->result_array();
            return array();
        } else {
            return array();
        }
    }
    
    public function get_channel_list($fk_cat_id) {
        $this->db->select("cm.pk_ch_id,cm.fk_cat_id,cm.channel_name,cm.channel_url,c.cate_name");
        $this->db->select("CONCAT('http://128.199.145.47/aadhar/upload/channel/',cm.channel_logo) as channel_logo",false);
        $this->db->from('channel_mst as cm');  
        $this->db->join('category_mst as c','cm.fk_cat_id=c.pk_cat_id');
        $this->db->where('cm.fk_cat_id',$fk_cat_id);
        $query = $this->db->get();           
        if ($query->num_rows()>0) {
            return $query->result_array();
            return array();
        } else {
            return array();
        }
    }

}
