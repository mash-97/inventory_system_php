<?php
require_once("alpha_load.php");

response($session, 200, "OK");
response($_SERVER, 200, "OK");

response(array_keys(array("1"=>"2", "2"=>"3")), 200, "OK");
response(find_by_sql("select DATE_FORMAT(MIN(date), '%Y') as min_year from sales"), 200, "OK");
if($_SERVER["REQUEST_METHOD"]=="GET"){
  response("This is get method", 200, "OK");
}
else if($_SERVER["REQUEST_METHOD"]=="POST"){
  response("This is post method", 200, "OK");
}
else{
  response("Somewhere between known and unknown", 200, "OK");
}

?>