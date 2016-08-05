<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Webservice_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function check_login_verify($vc_number, $mobileno) {
        $row=array();
        $this->db->select('pk_uid,fname,lname,emailid,mobileno,vc_number');
        $this->db->from('user_mst');
        $this->db->where('vc_number', $vc_number);
        $this->db->where('mobileno', $mobileno);
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
        $this->db->select('sc.*,c.cate_name');
        $this->db->from('sub_category_mst as sc');
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
