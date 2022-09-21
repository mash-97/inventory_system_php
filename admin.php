<?php
  $page_title = 'Admin Home Page';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
   $min_year = (int)find_by_sql("select DATE_FORMAT(MIN(date), '%Y') as min_year from sales;")[0]['min_year'];
   $max_year = (int)find_by_sql("select DATE_FORMAT(MAX(date), '%Y') as min_year from sales;")[0]['min_year'];
?>
<?php
 $c_categorie     = count_by_id('categories');
 $c_product       = count_by_id('products');
 $c_sale          = count_by_id('sales');
 $c_user          = count_by_id('users');
 $products_sold   = find_higest_saleing_product('10');
 $recent_products = find_recent_product_added('5');
 $recent_sales    = find_recent_sale_added('5')
?>
<?php include_once('layouts/header.php'); ?>


<div class="row">
   <div class="col-md-6">
     <?php echo display_msg($msg); ?>
     
   </div>
</div>



  <div class="row">
    <a href="users.php" style="color:black;">
		<div class="col-md-3">
       <div class="panel  clearfix small-cards">
         <div class="panel-icon pull-left ">
          <i class="glyphicon glyphicon-user"></i>
        </div>
        <div class="panel-value pull-right ">
          <p class="text-muted ">Users</p>
          <h3> <?php  echo $c_user['total']; ?> </h3>
        </div>
       </div>
    </div>
	</a>
	
	<a href="categorie.php" style="color:black;">
    <div class="col-md-3">
       <div class="panel  clearfix small-cards">
         <div class="panel-icon pull-left ">
          <i class="glyphicon glyphicon-th-large"></i>
        </div>
        <div class="panel-value pull-right">
          <p class="text-muted margin-top">Categories</p>
          <h3> <?php  echo $c_categorie['total']; ?> </h3>
        </div>
       </div>
    </div>
	</a>
	
	<a href="product.php" style="color:black;">
    <div class="col-md-3">
       <div class="panel  clearfix small-cards">
         <div class="panel-icon pull-left ">
          <i class="glyphicon glyphicon-shopping-cart"></i>
        </div>
        <div class="panel-value pull-right">
          <p class="text-muted margin-top">Products</p>
          <h3 > <?php  echo $c_product['total']; ?> </h3>
        </div>
       </div>
    </div>
	</a>
	
	<a href="sales.php" style="color:black;">
    <div class="col-md-3">
       <div class="panel  clearfix small-cards">
         <div class="panel-icon pull-left ">
          <i class="glyphicon glyphicon-usd"></i>
        </div>
        <div class="panel-value pull-right">
          <p class="text-muted margin-top">Sales</p>
          <h3 > <?php  echo $c_sale['total']; ?></h3>
        </div>
       </div>
    </div>
	</a>
</div>
  
  <div class="row">
   <div class="col-md-4">
     <div class="panel panel-default">
       <div class="panel-heading">
         <strong>
           <span class="glyphicon glyphicon-th"></span>
           <span>Highest Selling Products</span>
         </strong>
       </div>
       <div class="panel-body">
         <table class="table table-striped table-bordered table-condensed">
          <thead>
           <tr>
             <th>Title</th>
             <th>Total Sold</th>
             <th>Total Quantity</th>
           <tr>
          </thead>
          <tbody>
            <?php foreach ($products_sold as  $product_sold): ?>
              <tr>
                <td><?php echo remove_junk(first_character($product_sold['name'])); ?></td>
                <td><?php echo (int)$product_sold['totalSold']; ?></td>
                <td><?php echo (int)$product_sold['totalQty']; ?></td>
              </tr>
            <?php endforeach; ?>
          <tbody>
         </table>
       </div>
     </div>
   </div>
   <div class="col-md-4">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>LATEST SALES</span>
          </strong>
        </div>
        <div class="panel-body">
          <table class="table table-striped table-bordered table-condensed">
       <thead>
         <tr>
           <th class="text-center" style="width: 50px;">#</th>
           <th>Product Name</th>
           <th>Date</th>
           <th>Total Sale</th>
         </tr>
       </thead>
       <tbody>
         <?php foreach ($recent_sales as  $recent_sale): ?>
         <tr>
           <td class="text-center"><?php echo count_id();?></td>
           <td>
            <a href="edit_sale.php?id=<?php echo (int)$recent_sale['id']; ?>">
             <?php echo remove_junk(first_character($recent_sale['name'])); ?>
           </a>
           </td>
           <td><?php echo remove_junk(ucfirst($recent_sale['date'])); ?></td>
           <td>$<?php echo remove_junk(first_character($recent_sale['price'])); ?></td>
        </tr>

       <?php endforeach; ?>
       </tbody>
     </table>
    </div>
   </div>
  </div>
  <div class="col-md-4">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Recently Added Products</span>
        </strong>
      </div>
      <div class="panel-body">

        <div class="list-group">
      <?php foreach ($recent_products as  $recent_product): ?>
            <a class="list-group-item clearfix" href="edit_product.php?id=<?php echo    (int)$recent_product['id'];?>">
                <h4 class="list-group-item-heading">
                 <?php if($recent_product['media_id'] === '0'): ?>
                    <img class="img-avatar img-circle" src="uploads/products/no_image.png" alt="">
                  <?php else: ?>
                  <img class="img-avatar img-circle" src="uploads/products/<?php echo $recent_product['image'];?>" alt="" />
                <?php endif;?>
                <?php echo remove_junk(first_character($recent_product['name']));?>
                  <span class="label label-warning pull-right">
                 $<?php echo (int)$recent_product['sale_price']; ?>
                  </span>
                </h4>
                <span class="list-group-item-text pull-right">
                <?php echo remove_junk(first_character($recent_product['categorie'])); ?>
              </span>
          </a>
      <?php endforeach; ?>
    </div>
  </div>
 </div>
</div>
 </div>
  <div class="row">
    <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Monthly Profits</span>
          </strong>
        </div>
        <div class="panel-body">
          <canvas id="monthly_profit_chart" style="width:100%;max-width:800px"></canvas>
                    
        </div>
        </div>
    </div>
    <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Monthly Sales</span>
            <span style="float: right">
              <select id="per_monthly_sold_year_select" class="form-select" aria-label="Default select example">
                <option selected>Select Year : <?php echo $max_year; ?></option>
                <?php for($i=$min_year; $i<=$max_year; $i++): ?>
                  <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php endfor; ?>
              </select>
            </span>
          </strong>
        </div>
        <div class="panel-body">
          <canvas id="per_monthly_total_solds_chart" width="400px"></canvas>
          
          
        </div>
        </div>
    </div>
  </div>



<?php include_once('layouts/footer.php'); ?>
<script type="text/javascript">




  function updatePerMonthlyTotalSoldsChart(year, per_monthly_total_solds){
    let per_monthly_total_solds_chart_ctx = document.getElementById('per_monthly_total_solds_chart').getContext('2d');
  
  
    // let xValues = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    let x_values = Object.keys(per_monthly_total_solds);
    // let yValues = [55, 49, 44, 24, 15, 55, 22, 11, 22, 33, 11, 55];
    let y_values = Object.values(per_monthly_total_solds);
    
    let bar_colors = [];

    for(let x=0; x<12; x++){
      bar_colors.push(transparent_color(["red", "green","blue","orange","brown"][random_int(0, 4)], 1));
    }

    let ct = new Chart(per_monthly_total_solds_chart_ctx, {
      type: "bar",
      data: {
        labels: x_values,
        datasets: [{
          backgroundColor: bar_colors,
          data: y_values
        }]
      },
      options: {
        legend: {display: false},
        title: {
          display: true,
          text: "Monthly Sales For "+year
        }
      }
    });
  }
  
  function updatePMTSCByAjaxYear(year){
    $.ajax({
      type: "GET",
      url: "apis/per_monthly_total_solds.php",
      data: {year: year },
      dataType: 'json',
      encode: true
    }).done((response)=>{
      console.log(response);
      if(response.status_code==200){
        console.log(response.data);
        updatePerMonthlyTotalSoldsChart(year, response.data);
      } 
      else{
        console.log("Bad Response from the server!"+response.status_code);
      }
    });
  }
  $(document).ready(()=>{
    updatePMTSCByAjaxYear('<?php echo $max_year; ?>');
    console.log("document ready");
    updateMPCByAjaxYear('<?php echo $max_year; ?>');
  });

  let pmsys = document.getElementById("per_monthly_sold_year_select")
  pmsys.onchange = ()=>{
    console.log("e.value: ", pmsys.value);
    updatePMTSCByAjaxYear(parseInt(pmsys.value));
    updateMPCByAjaxYear(parseInt(pmsys.value));
  }


  function updateMonthlyProfitChart(year, per_monthly_profits){
    console.log(transparent_color("blue", 0.9));
    let expected_profits = [];
    let actual_profits = [];
    for(key in per_monthly_profits){
      expected_profits.push(per_monthly_profits[key]['expected_profit']);
      actual_profits.push(per_monthly_profits[key]['actual_profit']);
    }
    let data = {
      labels: Object.keys(per_monthly_profits),
      datasets: [
        {
          label: 'Expected Profits',
          data: expected_profits,
          borderColor: CHART_COLORS.red,
          backgroundColor: transparent_color("blue", 0.9), //'rgba(255, 99, 132, 0.5)',
        },
        {
          label: 'Actual Profits',
          data: actual_profits,
          borderColor: CHART_COLORS.blue,
          backgroundColor: transparent_color("red", 0.9),
        }
      ]
    };
    let config = {
        type: 'bar',
        data: data,
        options: {
          responsive: true,
          plugins: {
            legend: {
              position: 'top',
            },
            title: {
              display: true,
              text: 'Chart.js Bar Chart'
            }
          },
          title: {
            display: true,
            text: 'Profits Per Month For '+year
          }
        },
      };
    new Chart("monthly_profit_chart", config);
  }

  function updateMPCByAjaxYear(year){
    $.ajax({
      type: "GET",
      url: "apis/per_monthly_profits.php",
      data: {year: year},
      dataType: 'json',
      encode: true
    }).done((response)=>{
      console.log(response);
      if(response.status_code==200){
        console.log(response.data);
        updateMonthlyProfitChart(year, response.data);
      } 
      else{
        console.log("Bad Response from the server!"+response.status_code);
      }
    });
  }

</script>