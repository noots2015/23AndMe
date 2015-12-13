<?php

/**
 * @author James Whitehead
 */
class Authenticator 
{
	const CLIENT_ID = 'c313b632af1087c2d4570ccf664dd0ec';
	const CLIENT_SECRET = '098df23a85272d5163a7799b6c349bd7';
	 
	/**
	 * @param integer $authCode
	 */
	public function getToken($authCode) {
		$request_string = '';
	 	
	 	$url = 'https://api.23andme.com/token/';
	 	
	 	$data = array (
	 			'client_id'			=> self::CLIENT_ID,
	 			'client_secret'	=> self::CLIENT_SECRET,
	 			'grant_type'		=> 'authorization_code',
	 			'code'					=> $authCode,
	 			'redirect_uri'	=> "http://localhost:80/Noots/",
	 			'scope'					=> 'basic'
	 	);
	 	
	 	foreach ($data as $key => $value) { 
	 		$request_string .= $key.'='.$value.'&'; 
	 	}
	 	
	 	rtrim($request_string,'&');
	 	
	 	//open connection
	 	$curl = curl_init();
	 	
	 	//set cURL options
	 	curl_setopt($curl, CURLOPT_URL, $url);
	 	curl_setopt($curl, CURLOPT_POST, count($data));
	 	curl_setopt($curl, CURLOPT_POSTFIELDS, $request_string);
	 	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // ignores SSL verification
	 	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	 	
	 	$result = curl_exec($curl);
	 	
	 	curl_close($curl);
	 	
	 	return $result;
	}
	 
}
