<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    function __construct() {

        parent::__construct();
        $this->output->set_header("Expires: Tue, 01 Jan 2020 00:00:00 GMT");
        $this->output->set_header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        $this->output->set_header("Cache-Control: post-check=0, pre-check=0", false);
        $this->output->set_header("Pragma: no-cache");
        $this->load->model('common_model', 'common');
        if ($this->session->userdata('logged_in') == False) {
            redirect(base_url() . 'admin/login/', 'refresh');
        }
    }

    public function index() {
        $user_list = $this->common->user_lists();
        $category_lists = $this->common->category_lists();
        $channel_lists = $this->common->channel_lists(); 
        $data=array('user_list'=>$user_list,'category_lists'=>$category_lists,'channel_lists'=>$channel_lists);
        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar');
        $this->load->view('admin/dashboard',$data);
        $this->load->view('admin/includes/footer');
    }
    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
