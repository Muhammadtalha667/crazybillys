<?php

class slack {
	public function __construct() {
		
	}
	public function send_slack_msg($text,$url){

		 //$url = 'https://hooks.slack.com/services/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';
		// $url = 'https://hooks.slack.com/services/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';
		 
		 // this is only part of the data you need to sen
		 $data = array( "text"=> $text);
		  //As per your API, the customer data should be structured this way
		 //$data = array("customer" => $customer_data);
		  //And then encoded as a json string
		 $data_string = json_encode($data);
		 
		 $ch=curl_init($url);

		 curl_setopt_array($ch, array(
		     CURLOPT_POST => true,
		     CURLOPT_POSTFIELDS => $data_string,
		     //CURLOPT_HTTPHEADER => array('Content-Type:application/json', 'Content-Length: ' . strlen($data_string)),
			 CURLOPT_RETURNTRANSFER=>true 
		 ));
		   $result = curl_exec($ch);
		 if (curl_errno ( $ch )) {
		     curl_error ( $ch );
		     curl_close ( $ch );
		     //exit ();
		 }
		// die('asdas');
		 curl_close($ch);
	}
}
?>