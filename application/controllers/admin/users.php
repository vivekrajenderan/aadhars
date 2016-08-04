<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

include APPPATH . '/controllers/common.php';

//error_reporting(E_PARSE);
class Users extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('users_model', 'users');
        $this->load->library('form_validation');
        if ($this->session->userdata('logged_in') == False) {
            redirect(base_url() . 'login/', 'refresh');
        }
    }

    public function index() {
        $user_list = $this->users->user_lists();
        $data = array('user_list' => $user_list);
        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar');
        $this->load->view('admin/users/list', $data);
        $this->load->view('admin/includes/footer');
    }

    public function add() {
        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar');
        $this->load->view('admin/users/add');
        $this->load->view('admin/includes/footer');
    }

    //login
    public function ajax_add() {


        if (($this->input->server('REQUEST_METHOD') == 'POST')) {
            $this->form_validation->set_rules('fname', 'First Name', 'trim|required|min_length[3]|max_length[30]');
            $this->form_validation->set_rules('lname', 'Last Name', 'trim|required|min_length[3]|max_length[20]');
            $this->form_validation->set_rules('emailid', 'Email', 'trim|required|valid_email|is_unique[user_mst.emailid]');
            $this->form_validation->set_rules('mobileno', 'Mobile Number', 'trim|required|min_length[10]|max_length[10]');
            $this->form_validation->set_rules('vc_number', 'VC Number', 'trim|required|min_length[3]|max_length[10]');
            if ($this->form_validation->run() == FALSE) {

                echo json_encode(array('status' => 0, 'msg' => validation_errors()));
                return false;
            } else {
                $data = array('fname' => trim($this->input->post('fname')),
                    'lname' => trim($this->input->post('lname')),
                    'emailid' => trim($this->input->post('emailid')),
                    'mobileno' => trim($this->input->post('mobileno')),
                    'vc_number' => trim($this->input->post('vc_number')),
                    'fk_role_id' => 2
                );
                $add_users = $this->users->save_users($data);
                if ($add_users == 1) {
                    $this->session->set_flashdata('SucMessage', ucfirst($this->input->post('fname')) . ' User Added Successfully');
                    echo json_encode(array('status' => 1));
                } else {
                    echo json_encode(array('status' => 0, 'msg' => 'User Added Not Successfully'));
                }
            }
        }
    }

    public function edit($pk_uid = NULL) {

        if ($pk_uid != "") {
            $get_user_list = $this->users->get_user_list($pk_uid);
            if (count($get_user_list) > 0) {

                $data = array('get_user_list' => $get_user_list, 'pk_uid' => $pk_uid);
                $this->load->view('admin/includes/header');
                $this->load->view('admin/includes/sidebar');
                $this->load->view('admin/users/edit', $data);
                $this->load->view('admin/includes/footer');
            } else {
                redirect(base_url() . 'admin/users/', 'refresh');
            }
        } else {
            redirect(base_url() . 'admin/users/', 'refresh');
        }
    }

    //login
    public function ajax_edit() {


        if (($this->input->server('REQUEST_METHOD') == 'POST')) {
            $this->form_validation->set_rules('fname', 'First Name', 'trim|required|min_length[3]|max_length[30]');
            $this->form_validation->set_rules('lname', 'Last Name', 'trim|required|min_length[3]|max_length[20]');
            $this->form_validation->set_rules('emailid', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('mobileno', 'Mobile Number', 'trim|required|min_length[10]|max_length[10]');
            $this->form_validation->set_rules('vc_number', 'VC Number', 'trim|required|min_length[3]|max_length[10]');
            if ($this->form_validation->run() == FALSE) {

                echo json_encode(array('status' => 0, 'msg' => validation_errors()));
                return false;
            } else {
                $data = array('fname' => trim($this->input->post('fname')),
                    'lname' => trim($this->input->post('lname')),
                    'emailid' => trim($this->input->post('emailid')),
                    'mobileno' => trim($this->input->post('mobileno')),
                    'vc_number' => trim($this->input->post('vc_number'))
                );
                $id = trim($this->input->post('pk_uid'));
                $update_users = $this->users->update_users($data, $id);
                if ($update_users == 1) {
                    $this->session->set_flashdata('SucMessage', ucfirst($this->input->post('fname')) . ' User Updated Successfully');
                    echo json_encode(array('status' => 1));
                } else {
                    echo json_encode(array('status' => 0, 'msg' => 'User Updated Not Successfully'));
                }
            }
        }
    }

    public function exist_email_check() {
        if (($this->input->server('REQUEST_METHOD') == 'POST')) {

            $check_exist = $this->users->check_exist_email(trim($this->input->post('email')), trim($this->input->post('pk_uid')));
            if (count($check_exist)) {
                echo "1";
            } else {
                echo "0";
            }
        }
    }

    public function delete($pk_uid = NULL) {
        if ($pk_uid != "") {            
                $deleteUsers = $this->users->delete_user($pk_uid);
                if($deleteUsers=="1")
                {
                $this->session->set_flashdata('SucMessage', 'User has been deleted successfully!!!');
                }
                else
                {
                 $this->session->set_flashdata('ErrorMessages', 'User has not been deleted successfully!!!');   
                }
                redirect(base_url() . 'admin/users/', 'refresh');
            }
            else
            {
                
                redirect(base_url() . 'admin/users/', 'refresh');
            }
        
    }

}
