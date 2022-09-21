<?php
require_once("alpha_load.php");

if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['username']) && isset($_POST['new_password']) && isset($_POST['uid'])){
  $username = remove_junk($_POST['username']);
  $new_password = $_POST['new_password'];
  $uid = (int)$_POST['uid'];

  $new_password = remove_junk($db->escape(sha1($new_password)));
  $sql = "UPDATE users SET password ='{$new_password}' WHERE id='{$db->escape($uid)}'";
  $result = $db->query($sql);
  if($result && $db->affected_rows() === 1){
    $status_code = 201;
    $status_text = "Password Changed";
  }
  else{
    $status_code = 400;
    $status_text = "Password Unchanged";
  }
  response(NULL, $status_code, $status_text);
}
else{
  response(NULL, 400, "Bad Requeset");
}