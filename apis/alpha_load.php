<?php
header("Content-Type:application/json");
// define('__ROOT__', dirname(dirname(__FILE__)));

require_once("includes/load.php");
function response($data, $status_code, $status_text){
  // $response = array();
  $response['data'] = $data;
  $response['status_code'] = $status_code;
  $response['status_text'] = $status_text;
  $json_response = json_encode($response);
  echo($json_response);
}
?>