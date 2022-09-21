<?php
require_once("alpha_load.php");
// given a year return all the total solds per month
// Array(month=> total_solds)
function total_solds_compare($a, $b){
  return $a>=$b ? 1:-1;
}
if($_SERVER['REQUEST_METHOD']=="GET" && isset($_GET['year'])){
  $year = (int)$_GET['year'];
  $monthly_sales = monthly_sales($year);
  $per_monthly_sales = per_monthly_sales($monthly_sales);
  $per_monthly_total_solds = per_monthly_total_solds($per_monthly_sales);
  // uasort($per_monthly_total_solds, "total_solds_compare");

  response($per_monthly_total_solds, 200, "OK");
}
else{
  response(NULL, 400, "Bad Request");
}

?>