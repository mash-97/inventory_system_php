<?php

$sql = "SELECT s.id as sale_id, p.id as product_id, p.name as product_name, ";
$sql .= "p.buy_price as product_buy_price, p.sale_price as product_sale_price, s.qty as sold_quantity, ";
$sql .= "s.price as sold_price, s.date as sold_date ";
$sql .= "FROM sales as s, products as p ";
$sql .= "WHERE (s.product_id = p.id) AND ( s.date >= '{$first_date}' and s.date <= '{$last_date}' );";


function per_month_sales($monthly_sales){
  $months = explode(" ", "January February March April May June July August September October November December");
  $per_month_sales = array();
  for($i=1; $i<=12; $i++)
    $per_month_sales[$months[$i-1]] = array();
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
    array_push($per_month_sales[$tmp_month], $monthly_sale);
  }
  return $per_month_sales;
}


// expected_profit = (sold_quantity * product_sale_price) - (sold_quantity * product_buy_price)
// actual_profit = (sold_price) - (sold_quantity * product_buy_price)

function per_month_expected_profits($monthly_sales){
  $months = explode(" ", "January February March April May June July August September October November December");
  $per_month_expected_profits = array("expected_profit" => 0.0, "actual_profit" => 0.0);
  for($i=1; $i<=12; $i++)
    $per_month_expected_profits[$months[$i-1]] = array();
  
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
    array_push($per_month_sales[$tmp_month], $monthly_sale);
  }
}

function per_month_total_solds($per_month_sales){
  $per_month_total_solds = array();
  foreach($per_month_sales as $pmsk => $pmsv){
    $per_month_total_solds[$pmsk] = count($pmsv);
  }
  return $per_month_total_solds;
};
?>