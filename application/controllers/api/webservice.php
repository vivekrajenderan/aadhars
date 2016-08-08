<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

error_reporting(0);
require APPPATH . '/libraries/REST_Controller.php';

class Webservice extends REST_Controller {

    public function __construct() {

        parent::__construct();
        // Loading report_model 
        $this->load->model('api/webservice_model');
        // Loading form_validation library files
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', '');
        $this->load->library('user_agent');
        $reqHeaders = $this->input->request_headers();
        //$auth_token = $reqHeaders['Auth-Token'];
        if (!isset($reqHeaders['Auth-Token'])) {
            $this->response(array('result' => json_encode(array('msg' => AUTH_TOKEN_INVALID_REQUEST))), 406);
        }
        if (empty($reqHeaders['Auth-Token'])) {
            // Return Error Result
            $this->response(array('result' => json_encode(array('msg' => AUTH_TOKEN_NOT_EMPTY))), 406);
        }
        if ($reqHeaders['Auth-Token'] != AUTH_TOKEN) {
            // Return Error Result
            $this->response(array('result' => json_encode(array('msg' => AUTH_TOKEN_INVALID))), 401);
        }
    }

    public function login_post() {

        $post_request = file_get_contents('php://input');
        $request = json_decode($post_request, true);
        // Mandatory Fields validation
        $mandatoryKeys = array('vc_number' => 'VC Number', 'mobileno' => 'Mobile Number');
        $nonMandatoryValueKeys = array('');
        $check_request = mandatoryArray($request, $mandatoryKeys, $nonMandatoryValueKeys);
        if (!empty($check_request)) {
            // Return Error Result
            $this->response(array('result' => json_encode(array("msg" => $check_request["msg"]))), $check_request["statusCode"]);
        } else {
            $_POST['vc_number'] = trim($request['vc_number']);
            $_POST['mobileno'] = trim($request['mobileno']);
            $this->form_validation->set_rules('vc_number', 'VC Number', 'trim|required');
            $this->form_validation->set_rules('mobileno', 'Mobile Number', 'trim|required|numeric|min_length[10]|max_length[10]');
            if ($this->form_validation->run() == FALSE) {
                // Return Error Result
                $this->response(array('result' => json_encode(array('msg' => validation_errors()))), 422);
            } else {
                $get_user_list = $this->webservice_model->check_login_verify(trim($request['vc_number']), trim($request['mobileno']));
                if (count($get_user_list) > 0) {
                    $msg = array('status' => true, "user_list" => $get_user_list);
                    $this->response(array('result' => json_encode($msg)), 200);
                } else {
                    $msg = array('status' => false, "msg" => "VC Number not valid check with your operator");
                    $this->response(array('result' => json_encode($msg)), 422);
                }
            }
        }
    }

    public function categories_list_post() {
        $category_lists = $this->webservice_model->category_lists();
        if (count($category_lists) > 0) {
            $msg = array('status' => true, "category_lists" => $category_lists);            
            $this->response(array('result' => json_encode($msg)), 200);
        } else {
            $msg = array('status' => false, "msg" => "No Record");
            $this->response(array('result' => json_encode($msg)), 422);
        }
    }

    public function search_channel_list_post() {
        $post_request = file_get_contents('php://input');
        $request = json_decode($post_request, true);
        // Mandatory Fields validation
        $mandatoryKeys = array('fk_cat_id' => 'Category ID');
        $nonMandatoryValueKeys = array('');
        $check_request = mandatoryArray($request, $mandatoryKeys, $nonMandatoryValueKeys);
        if (!empty($check_request)) {
            // Return Error Result
            $this->response(array('result' => json_encode(array("msg" => $check_request["msg"]))), $check_request["statusCode"]);
        } else {
            $channel_lists = $this->webservice_model->get_channel_list($request['fk_cat_id']);            
        if (count($channel_lists) > 0) {            
            $msg = array('status' => true, "channel_lists" => $channel_lists,'total_count'=>count($channel_lists));
            $this->response(array('result' => json_encode($msg)), 200);
        } else {
            $msg = array('status' => false, "msg" => "No Record");
            $this->response(array('result' => json_encode($msg)), 422);
        }
        }
    }

}
