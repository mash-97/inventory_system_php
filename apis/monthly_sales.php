<?php
require_once("alpha_load.php");
// Given a year it will query all the sales of the year
// `both` = true |(default: false) will return both all sales as
// well as per month basis.
// `per_monthly_sales` = true |(default: false) will only return 
// sales per month basis.


if($_SERVER['REQUEST_METHOD']=="GET" && isset($_GET['year'])){
  $year = (int)$_GET['year'];
  $monthly_sales = monthly_sales($year);
  $status_code = 200;
  $status_text = "OK";

  if(isset($_GET['per_monthly_sales']) && $_GET['per_monthly_sales']=="true"){
    $pms = per_monthly_sales($monthly_sales);
    response($pms, $status_code, $status_text);
  }
  else if(isset($_GET['both']) && $_GET['both']=="true"){
    $pms = per_monthly_sales($monthly_sales);
    response(array("monthly_sales"=> $monthly_sales, "per_monthly_sales"=> $pms), $status_code, $status_text);
  }
  else{
    response($monthly_sales, $status_code, $status_text);
  }
  
}
else{
  response(NULL, 400, "Bad Requeset");
}