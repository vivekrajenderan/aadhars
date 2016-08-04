<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * This is projects detail of Aadhar
 *
 * @package	CodeIgniter
 * @category	Report
 * @author	Vivek R
 * @link	http://www.mookambikainfo.com/
 *
 */


error_reporting(0);
require APPPATH.'/libraries/REST_Controller.php';
class Webservice extends REST_Controller {	
	
    public function __construct()
	{	
		
			parent::__construct();			
			// Loading report_model 
			$this->load->model('api/webservice_model');			
			// Loading form_validation library files
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('', '');
                        $this->load->library('user_agent');
			$reqHeaders = $this->input->request_headers();   			
   			$auth_token=$reqHeaders['Auth-Token'];
                        if(!isset($reqHeaders['Auth-Token']))
			{
			 $this->response(array('result' =>json_encode(array('msg' => "Invalid Request"))), 406);
				
			}  	
   	 		if(empty($auth_token))
			{
				// Return Error Result
				$this->response(array('result' =>json_encode(array('msg' => AUTH_TOKEN_NOT_EMPTY))), 406);
				
			}
			if($auth_token!=AUTH_TOKEN)
			{
				// Return Error Result
				$this->response(array('result' =>json_encode(array('msg' => AUTH_TOKEN_INVALID))), 401);
			}
	    
	}
	

  

   public function login_post()
	{
	
		$post_request= file_get_contents('php://input');
		
		$request=json_decode($post_request,true);	
			
		// Mandatory Fields validation
		$mandatoryKeys = array('vc_number'=>'VC Number','mobile_no'=>'Mobile Number');
		$nonMandatoryValueKeys = array('');
		$check_request= mandatoryArray($request,$mandatoryKeys,$nonMandatoryValueKeys);
	
		if(!empty($check_request))
		{
			// Return Error Result
			$this->response(array('result' =>json_encode(array("msg"=>$check_request["msg"]))),$check_request["statusCode"]);
		}
		else
		{
			
		}
			
	}
	
	
}
