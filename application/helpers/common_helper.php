<?php

    

/* functions for API Request Validation */



function mandatoryArray($requestArray,$mandatoryKeys,$nonMandatoryValueKeys)
{
	
	if(isset($requestArray['sort']) || isset($requestArray['search']))
	{
		unset($requestArray['sort']);
		unset($requestArray['search']);
	}
	
	
      $requestArray=array_map('trim',$requestArray);

	  $error= array();	

	  

	  foreach ($mandatoryKeys as $key => $val){		  

		  if(!array_key_exists($key,$requestArray)) {

			  $error["msg"] = "Request must contain ".$key;

			  $error["statusCode"] = 406; 	

			  break;		    

		  }	 
		  
		  if( (empty($requestArray[$key]))  && (!in_array($key,$nonMandatoryValueKeys)) && ($requestArray[$key]!='0') )
		   {
		  	
			  		$error["msg"] = $val." should not be empty";			  		 
			  		$error["statusCode"] = 422;
				     break;       

		  }  
		  
	  

	  }

	  

	  return $error;

 }


 function send_android_push_notification($registatoin_ids, $message,$fran_id) {
	 	        
        // Set POST variables
        $url = 'https://android.googleapis.com/gcm/send';
 
        $fields = array(
            'registration_ids' => $registatoin_ids,
            'data' => $message,
        );
 
        $headers = array(
            'Authorization: key=' . ANDROID_GOOGLE_API_KEY,
            'Content-Type: application/json'
        );
        // Open connection
        $ch = curl_init();
 
        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
 
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
 
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
 
        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
 
        // Close connection
        curl_close($ch);
        //echo $result;
    }
	
	function send_iphone_push_notification($deviceToken,$message,$fran_id)
    {
        //ssl://gateway.sandbox.push.apple.com:2195 innoppl12,ck.pem
				        
		$passphrase = 'innoppl09';
        $ctx = stream_context_create();
        
		stream_context_set_option($ctx, 'ssl', 'local_cert', '/var/www/html/ck'.$fran_id.'.pem');
        stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
		stream_context_set_option($ctx, 'ssl', 'verify_peer', false);
        stream_context_set_option($ctx, 'ssl', 'allow_self_signed', false);
        $fp = stream_socket_client(
        'ssl://gateway.push.apple.com:2195', $err,
        $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);

        //$message = 'test';
		
		$body['aps'] = array(
            'alert' => $message['message'],
            'sound' => 'TK2.caf',
			'id' =>  $message['id'],
			'eventId' =>  $message['eventId'],
			'content-available' =>  '1'
            
        );
        log_message('error',$message['batchcount']);
        $payload = json_encode($body);

        $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

        $result = fwrite($fp, $msg, strlen($msg));

        fclose($fp);
     }
	 
	 
      
	
