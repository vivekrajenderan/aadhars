<?php

class Login_model extends CI_Model {

    function __construct() {
        parent::__construct();
        date_default_timezone_set('America/New_York');
        $this->load->helper('url');
        $this->load->library('table', 'session');
        $this->load->database();
    }

    function login_verify($UserName, $password) {

        $this->db->select('*');
        $this->db->from('user_mst');
        $this->db->where(array('emailid' => $UserName, 'secret_pass' => AES_Encode(trim($password)), 'standing' => '1'));
        $query = $this->db->get();
        $row_count = $query->num_rows();
        if ($row_count == 0) {
            $this->session->set_userdata(array('logged_in' => FALSE));
            return array();
        } else {
            $row = $query->result_array();
            return $row;
        }
    }

}
