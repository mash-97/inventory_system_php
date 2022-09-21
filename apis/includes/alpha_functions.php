<?php

function per_monthly_sales($monthly_sales){
  $months = explode(" ", "January February March April May June July August September October November December");
  $per_monthly_sales = array();
  for($i=1; $i<=12; $i++)
    $per_monthly_sales[$months[$i-1]] = array();
  foreach($monthly_sales as $monthly_sale){
    $tmp_month = $months[(int)explode("-", $monthly_sale['sold_date'])[1]-1];
    $tmp_ms = array(
      'sale_id' => $monthly_sale['sale_id'],
      'product_id' => $monthly_sale['product_id'],
      'product_name' => $monthly_sale['product_name'],
      'product_buy_price' => $monthly_sale['product_buy_price'],
      'product_sale_price' => $monthly_sale['product_sale_price'],
      'sold_quantity' => $monthly_sale['sold_quantity'],
      'sold_price' => $monthly_sale['sold_price'],
      'sold_date' => $monthly_sale['sold_date']
    );
    array_push($per_monthly_sales[$tmp_month], $monthly_sale);
  }
  return $per_monthly_sales;
}

// expected_profit = (sold_quantity * product_sale_price) - (sold_quantity * product_buy_price)
// actual_profit = (sold_price) - (sold_quantity * product_buy_price)

function calculate_expected_profit($sales){
  $expected_profit = 0.0;
  foreach($sales as $sale){
    $expected_profit += ($sale['product_sale_price']*$sale['sold_quantity']) - ($sale['product_buy_price']*$sale['sold_quantity']);
  }
  return $expected_profit;
}
function calculate_actual_profit($sales){
  $actual_profit = 0.0;
  foreach($sales as $sale){
    $actual_profit += ($sale['sold_price']) - ($sale['product_buy_price']*$sale['sold_quantity']);
  }
  return $actual_profit;
}

# caculate both expected and actual profit from the 
# sales per month
function per_monthly_profits($per_monthly_sales){
  $per_monthly_profits = array();

  foreach($per_monthly_sales as $pms_k => $pms_v){
    $per_monthly_profits[$pms_k]['expected_profit'] = calculate_expected_profit($pms_v);
    $per_monthly_profits[$pms_k]['actual_profit'] = calculate_actual_profit($pms_v);
  }
  return $per_monthly_profits;
}

# total solds per month of the year (from sales per month)
function per_monthly_total_solds($per_monthly_sales){
  $per_monthly_total_solds = array();
  foreach($per_monthly_sales as $pmsk => $pmsv){
    $per_monthly_total_solds[$pmsk] = count($pmsv);
  }
  return $per_monthly_total_solds;
};
?>