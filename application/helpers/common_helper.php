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
