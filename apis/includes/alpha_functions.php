<?php

function per_month_sales($monthly_sales){
  $months = explode(" ", "January February March April May June July August September October November December");
  $per_month_sales = array();
  for($i=1; $i<=12; $i++)
    $per_month_sales[$months[$i-1]] = array();
  foreach($monthly_sales as $monthly_sale){
    $tmp_month = $months[(int)explode("-", $monthly_sale['sold_date'])[1]-1];
    $tmp_ms = array(
      'sale_id' => $monthly_sale['sale_id'],
      'product_id' => $monthly_sale['product_id']
    );
    array_push($per_month_sales[$tmp_month], $monthly_sale);
  }
  return $per_month_sales;
}

function per_month_total_solds($per_month_sales){
  $per_month_total_solds = array();
  foreach($per_month_sales as $pmsk => $pmsv){
    $per_month_total_solds[$pmsk] = count($pmsv);
  }
  return $per_month_total_solds;
};
?>