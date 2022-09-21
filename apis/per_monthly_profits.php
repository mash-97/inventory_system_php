<?php
require_once("alpha_load.php");
// given a year it will return profits for the year per month 
// Array(months => {expected: float, actual: float})


if($_SERVER['REQUEST_METHOD']=="GET" && isset($_GET['year'])){
  $year = (int)$_GET['year'];
  $monthly_sales = monthly_sales($year);
  $per_monthly_sales = per_monthly_sales($monthly_sales);
  $per_monthly_profits = per_monthly_profits($per_monthly_sales);

  response($per_monthly_profits, 200, "OK");
}
else{
  response(NULL, 400, "Bad Request");
}

?>