<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

include APPPATH . '/controllers/common.php';

//error_reporting(E_PARSE);
class Login extends CI_Controller {

    public function __construct() {

        parent::__construct();
        // Loading report_model 
        $this->load->model('login_model', 'login');
        // Loading form_validation library files
        $this->load->library('form_validation');
        if ($this->session->userdata('logged_in') == TRUE) {
            redirect(base_url() . 'admin/dashboard', 'refresh');
        }
    }

    public function index() {
        $this->load->view('admin/login');
    }

    //login
    public function ajax_check() {


        if (($this->input->server('REQUEST_METHOD') == 'POST')) {

            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');

            if ($this->form_validation->run() == FALSE) {

                echo json_encode(array('status' => 0, 'msg' => validation_errors()));
                return false;
            } else {
                $row = $this->login->login_verify(trim($this->input->post('email')), trim($this->input->post('password')));
                if (count($row) == 1) {
                    $session_data = array(
                        'pk_uid' => $row[0]['pk_uid'],
                        'emailid' => $row[0]['emailid'],
                        'fk_role_id' => $row[0]['fk_role_id'],
                        'fname' => $row[0]['fname'],
                        'lname' => $row[0]['lname'],
                        'mobileno' => $row[0]['mobileno'],
                        'vc_number' => $row[0]['vc_number'],
                        'logged_in' => TRUE
                    );
                    $this->session->set_userdata($session_data);
                    echo json_encode(array('status' => 1, 'msg' => 'Loggin Successfully'));
                } else {
                    echo json_encode(array('status' => 0, 'msg' => 'Invalid Credential'));
                }
            }
        }
    }


}
