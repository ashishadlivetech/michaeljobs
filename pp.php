<?php 

header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

$auth_data = array('grant_type' => 'refresh_token',
        'client_id' => 'ue57olruqpyebjru5l47vv42zy',
        'client_secret' => 'eszan6swbrnuvlpnp743ncn2sesy6mgudxk6zu7olkca7oozde6y',
        'refresh_token' => '4910786e66ab18e43c1538bdf679a870');

$auth_curl = curl_init();
curl_setopt_array($auth_curl, array(
  CURLOPT_URL => "https://id.jobadder.com/connect/token",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    'Content-type: x-www-form-urlencoded'
  ),
  CURLOPT_POSTFIELDS => http_build_query($auth_data)
));

$auth_response = curl_exec($auth_curl);
curl_close($auth_curl);

$auth_val = json_decode($auth_response, true);
$new_token = $auth_val['access_token'];
$api = $auth_val['api'];

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $api."jobs/",
  CURLOPT_RETURNTRANSFER => true,  
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "Authorization: Bearer ". $new_token,
    "cache-control: no-cache"
  ),
));

$response = curl_exec($curl);

$err = curl_error($curl);
curl_close($curl);
http_response_code(200);
echo $result = $response;
?>