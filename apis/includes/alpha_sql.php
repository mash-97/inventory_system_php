<?php
require_once('includes/load.php');
/*--------------------------------------------------------------*/
/*  Function for Find id from table by username
/*--------------------------------------------------------------*/
function find_user_id_by_username($table, $username)
{
  global $db;
  if(tableExists($table)){
        $sql = $db->query("SELECT id FROM {$db->escape($table)} WHERE username='{$db->escape($username)}' LIMIT 1");
        if($result = $db->fetch_assoc($sql))
          return $result['id'];
        else
          return null;
    }
}

function  monthly_sales($year){
  $first_date = "{$year}-01-01";
  $last_date = "{$year}-12-31";

  $sql = "SELECT s.id as sale_id, p.id as product_id, p.name as product_name, ";
  $sql .= "p.buy_price as product_buy_price, p.sale_price as product_sale_price, s.qty as sold_quantity, ";
  $sql .= "s.price as sold_price, s.date as sold_date ";
  $sql .= "FROM sales as s, products as p ";
  $sql .= "WHERE (s.product_id = p.id) AND ( s.date >= '{$first_date}' and s.date <= '{$last_date}' );";
  // return $sql;
  return find_by_sql($sql);
}
?>


