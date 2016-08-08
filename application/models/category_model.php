<?php

class Category_model extends CI_Model {

    function __construct() {
        parent::__construct();
        date_default_timezone_set('America/New_York');
        $this->load->helper('url');
        $this->load->library('table', 'session');
        $this->load->database();
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
    
    public function get_category_list($pk_cat_id) {

        $this->db->select('*');
        $this->db->from('category_mst');
        $this->db->where('md5(pk_cat_id)',$pk_cat_id);        
        $query = $this->db->get();
        
        if ($query->num_rows()>0) {
            return $query->result_array();
            return array();
        } else {
            return array();
        }
    }
    
    public function save_category($set_data)
    {
       $this->db->insert('category_mst',$set_data);
       return ($this->db->affected_rows() > 0);
    }
    
    public function update_category($set_data,$pk_cat_id)
    {
        $this->db->where('md5(pk_cat_id)',$pk_cat_id);
        $this->db->update("category_mst",$set_data);
        return ($this->db->affected_rows() > 0);
    }

    public function check_exist_category($cate_name,$pk_cat_id=NULL)
    {
        $this->db->select('*');
        $this->db->from('category_mst');
        $this->db->where('cate_name',$cate_name);  
        if($pk_cat_id!="")
        {
        $this->db->where('md5(pk_cat_id) !=',$pk_cat_id);        
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
    
    public function delete_category($pk_cat_id)
    {
        $this->db->where('md5(pk_cat_id)',$pk_cat_id);
        $this->db->delete("category_mst");
        return ($this->db->affected_rows() > 0);
    }
    
    public function delete_sub_category_list($fk_cat_id)
    {
        $this->db->where('md5(fk_cat_id)',$fk_cat_id);
        $this->db->delete("sub_category_mst");
        return ($this->db->affected_rows() > 0);
    }
    
    // Sub Category Functions
    
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
    
    public function check_exist_sub_category($channel_name,$fk_cat_id,$pk_sub_cat_id=NULL)
    {
        $this->db->select('*');
        $this->db->from('sub_category_mst');
        $this->db->where('channel_name',$channel_name);  
        $this->db->where('fk_cat_id',$fk_cat_id);
        if($pk_sub_cat_id!="")
        {
        $this->db->where('md5(pk_sub_cat_id) !=',$pk_sub_cat_id);        
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
    
    public function save_sub_category($set_data)
    {
       $this->db->insert('sub_category_mst',$set_data);
       return ($this->db->affected_rows() > 0);
    }
    
    public function delete_sub_category($pk_sub_cat_id)
    {
        $this->db->where('md5(pk_sub_cat_id)',$pk_sub_cat_id);
        $this->db->delete("sub_category_mst");
        return ($this->db->affected_rows() > 0);
    }
    
    public function get_sub_category_list($pk_sub_cat_id) {
        $this->db->select('sc.*,c.cate_name');
        $this->db->from('sub_category_mst as sc');
        $this->db->join('category_mst as c','sc.fk_cat_id=c.pk_cat_id');
        $this->db->where('md5(sc.pk_sub_cat_id)',$pk_sub_cat_id);
        $query = $this->db->get();        
        if ($query->num_rows()>0) {
            return $query->result_array();
            return array();
        } else {
            return array();
        }
    }
    
    public function update_sub_category($set_data,$pk_sub_cat_id)
    {
        $this->db->where('md5(pk_sub_cat_id)',$pk_sub_cat_id);
        $this->db->update("sub_category_mst",$set_data);
        return ($this->db->affected_rows() > 0);
    }
    
    public function get_sub_category($fk_cat_id) {
        $this->db->select('*');
        $this->db->from('sub_category_mst');        
        $this->db->where('md5(fk_cat_id)',$fk_cat_id);
        $query = $this->db->get();        
        if ($query->num_rows()>0) {
            return $query->result_array();
            return array();
        } else {
            return array();
        }
    }
}
