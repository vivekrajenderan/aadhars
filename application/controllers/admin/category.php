<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

include APPPATH . '/controllers/common.php';

//error_reporting(E_PARSE);
class Category extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('category_model', 'categories');
        $this->load->library('form_validation');
        if ($this->session->userdata('logged_in') == False) {
            redirect(base_url() . 'login/', 'refresh');
        }
    }
    
    
    public function index() {
        $category_lists = $this->categories->category_lists();
        $data = array('category_lists' => $category_lists);
        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar');
        $this->load->view('admin/category/list', $data);
        $this->load->view('admin/includes/footer');
    }

    public function add() {
        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar');
        $this->load->view('admin/category/add');
        $this->load->view('admin/includes/footer');
    }

    //login
    public function ajax_add() {


        if (($this->input->server('REQUEST_METHOD') == 'POST')) {
            $this->form_validation->set_rules('cate_name', 'Category Name', 'trim|required|min_length[3]|max_length[30]|is_unique[category_mst.cate_name]');           
            if ($this->form_validation->run() == FALSE) {

                echo json_encode(array('status' => 0, 'msg' => validation_errors()));
                return false;
            } else {
                $data = array('cate_name' => trim($this->input->post('cate_name'))
                );
                $add_category = $this->categories->save_category($data);
                if ($add_category == 1) {
                    $this->session->set_flashdata('SucMessage', ucfirst($this->input->post('cate_name')) . ' Category Added Successfully');
                    echo json_encode(array('status' => 1));
                } else {
                    echo json_encode(array('status' => 0, 'msg' => 'Category Added Not Successfully'));
                }
            }
        }
    }

    public function edit($pk_cat_id = NULL) {

        if ($pk_cat_id != "") {
            $get_category_list = $this->categories->get_category_list($pk_cat_id);
            if (count($get_category_list) > 0) {

                $data = array('get_category_list' => $get_category_list, 'pk_cat_id' => $pk_cat_id);
                $this->load->view('admin/includes/header');
                $this->load->view('admin/includes/sidebar');
                $this->load->view('admin/category/edit', $data);
                $this->load->view('admin/includes/footer');
            } else {
                redirect(base_url() . 'admin/category/', 'refresh');
            }
        } else {
            redirect(base_url() . 'admin/category/', 'refresh');
        }
    }

    //login
    public function ajax_edit() {


        if (($this->input->server('REQUEST_METHOD') == 'POST')) {
           $this->form_validation->set_rules('cate_name', 'Category Name', 'trim|required|min_length[3]|max_length[30]');            
            if ($this->form_validation->run() == FALSE) {

                echo json_encode(array('status' => 0, 'msg' => validation_errors()));
                return false;
            } else {
                 $data = array('cate_name' => trim($this->input->post('cate_name'))
                 );
                $id = trim($this->input->post('pk_cat_id'));
                $update_category = $this->categories->update_category($data, $id);
                if ($update_category == 1) {
                    $this->session->set_flashdata('SucMessage', ucfirst($this->input->post('cate_name')) . ' Category Updated Successfully');
                    echo json_encode(array('status' => 1));
                } else {
                    echo json_encode(array('status' => 0, 'msg' => 'Category Updated Not Successfully'));
                }
            }
        }
    }

    public function exist_category_check() {
        if (($this->input->server('REQUEST_METHOD') == 'POST')) {

            $check_exist = $this->categories->check_exist_category(trim($this->input->post('cate_name')), trim($this->input->post('pk_cat_id')));
            if (count($check_exist)) {
                echo "1";
            } else {
                echo "0";
            }
        }
    }

    public function delete($pk_cat_id = NULL) {
        if ($pk_cat_id != "") {            
                $deleteCategory = $this->categories->delete_category($pk_cat_id);
                if($deleteCategory=="1")
                {
                $this->session->set_flashdata('SucMessage', 'Category has been deleted successfully!!!');
                }
                else
                {
                  $this->session->set_flashdata('ErrorMessages', 'Category has not been deleted successfully!!!');  
                }
                redirect(base_url() . 'admin/category/', 'refresh');
            }
            else
            {                
                redirect(base_url() . 'admin/category/', 'refresh');
            }
        
    }

    public function subcategory() {        
        $sub_category_lists=$this->categories->sub_category_lists();
        //echo "<pre>";print_r($sub_category_lists);die;
        $data = array('sub_category_lists' => $sub_category_lists);
        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar');
        $this->load->view('admin/subcategory/list', $data);
        $this->load->view('admin/includes/footer');
    }

    public function sub_category_add() {
        $category_lists = $this->categories->category_lists();
        $data = array('category_lists' => $category_lists);
        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar');
        $this->load->view('admin/subcategory/add',$data);
        $this->load->view('admin/includes/footer');
    }

    //login
    public function ajax_add_sub_category() {


        if (($this->input->server('REQUEST_METHOD') == 'POST')) {
            $this->form_validation->set_rules('pk_cat_id', 'Category Name', 'trim|required');           
            $this->form_validation->set_rules('channel_name', 'Channel Name', 'trim|required|min_length[3]|max_length[30]');           
            $this->form_validation->set_rules('channel_no', 'Channel Number', 'trim|required|min_length[3]|max_length[30]');           
            $this->form_validation->set_rules('channel_url', 'Channel URL', 'trim|required|min_length[3]|max_length[150]');           
            if ($this->form_validation->run() == FALSE) {

                echo json_encode(array('status' => 0, 'msg' => validation_errors()));
                return false;
            } else {
                $data = array('fk_cat_id' => trim($this->input->post('pk_cat_id')),
                    'channel_name' => trim($this->input->post('channel_name')),
                    'channel_no' => trim($this->input->post('channel_no')),
                    'channel_url' => trim($this->input->post('channel_url'))
                );
                $add_category = $this->categories->save_sub_category($data);
                if ($add_category == 1) {
                    $this->session->set_flashdata('SucMessage', ucfirst($this->input->post('channel_name')) . ' Sub Category Added Successfully');
                    echo json_encode(array('status' => 1));
                } else {
                    echo json_encode(array('status' => 0, 'msg' => 'Sub Category Added Not Successfully'));
                }
            }
        }
    }

    public function exist_sub_category_check() {
        if (($this->input->server('REQUEST_METHOD') == 'POST')) {

            $check_exist = $this->categories->check_exist_sub_category(trim($this->input->post('cate_name')), trim($this->input->post('pk_cat_id')));
            if (count($check_exist)) {
                echo "1";
            } else {
                echo "0";
            }
        }
    }

    public function sub_category_delete($pk_sub_cat_id = NULL) {
        if ($pk_sub_cat_id != "") {            
                $deleteSubCategory = $this->categories->delete_sub_category($pk_sub_cat_id);
                if($deleteSubCategory=="1")
                {
                $this->session->set_flashdata('SucMessage', 'Sub Category has been deleted successfully!!!');
                }
                else
                {
                  $this->session->set_flashdata('ErrorMessages', 'Sub Category has not been deleted successfully!!!');  
                }
                redirect(base_url() . 'admin/category/subcategory', 'refresh');
            }
            else
            {                
                redirect(base_url() . 'admin/category/subcategory', 'refresh');
            }
        
    }
    

}
