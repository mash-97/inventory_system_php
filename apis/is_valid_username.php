<?php
require_once("alpha_load.php");

if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['username'])){
  $username = $_POST['username'];
  $username = remove_junk($username);
  $userid = find_user_id_by_username("users", $username);
  $status_code = $userid != null ? 200 : 400;
  $status_text = $userid != null ? "User Found" : "User Not Found";
  response($userid, $status_code, $status_text);
}
else{
  response(NULL, 400, "Bad Request");
}