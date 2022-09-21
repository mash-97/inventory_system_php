<?php
require_once("alpha_load.php");



if($_SERVER['REQUEST_METHOD']=="GET" && isset($_GET['year'])){
  $year = (int)$_GET['year'];
  $monthly_sales = monthly_sales($year);

  if(isset($_GET['per_month_sales']) && $_GET['per_month_sales']=="true"){
    $pms = per_month_sales($monthly_sales);
    response($pms, $status_code, $status_text);
  }
  else if(isset($_GET['both']) && $_GET['both']=="true"){
    $pms = per_month_sales($monthly_sales);
    response(array("monthly_sales"=> $monthly_sales, "per_month_sales"=> $pms), $status_code, $status_text);
  }
  else{
    response($monthly_sales, $status_code, $status_text);
  }
  
}
else{
  response(NULL, 400, "Bad Requeset");
}