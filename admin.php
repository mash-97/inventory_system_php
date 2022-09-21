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
            <span>Recently Added Products</span>
          </strong>
        </div>
        <div class="panel-body">
          <h3>HEllo</h3>
          <canvas id="myChart" width="400px" height="400px"></canvas>
          <script>
          const ctx = document.getElementById('myChart').getContext('2d');
          const myChart = new Chart(ctx, {
              type: 'bar',
              data: {
                  labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                  datasets: [{
                      label: '# of Votes',
                      data: [12, 19, 3, 5, 2, 3],
                      backgroundColor: [
                          'rgba(255, 99, 132, 0.2)',
                          'rgba(54, 162, 235, 0.2)',
                          'rgba(255, 206, 86, 0.2)',
                          'rgba(75, 192, 192, 0.2)',
                          'rgba(153, 102, 255, 0.2)',
                          'rgba(255, 159, 64, 0.2)'
                      ],
                      borderColor: [
                          'rgba(255, 99, 132, 1)',
                          'rgba(54, 162, 235, 1)',
                          'rgba(255, 206, 86, 1)',
                          'rgba(75, 192, 192, 1)',
                          'rgba(153, 102, 255, 1)',
                          'rgba(255, 159, 64, 1)'
                      ],
                      borderWidth: 1
                  }]
              },
              options: {
                  scales: {
                      y: {
                          beginAtZero: true
                      }
                  }
              }
          });
          </script>
          
        </div>
        </div>
    </div>
    <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Per Monthly Sales</span>
            <span style="float: right">
              <select id="per_monthly_sold_year_select" class="form-select" aria-label="Default select example">
                <option selected>Select Year : <?php echo $min_year; ?></option>
                <?php for($i=$min_year; $i<=$max_year; $i++): ?>
                  <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php endfor; ?>
              </select>
            </span>
          </strong>
        </div>
        <div class="panel-body">
          <canvas id="per_monthly_total_solds_chart" width="400px" height="400px"></canvas>
          
          
        </div>
        </div>
    </div>
  </div>



<?php include_once('layouts/footer.php'); ?>
<script type="text/javascript">

  // This JavaScript function always returns a random number between min and max (both included):
  function random_int(min, max) {
    return Math.floor(Math.random() * (max - min + 1) ) + min;
  }

  function updatePerMonthlyTotalSoldsChart(year, per_monthly_total_solds){
    let per_monthly_total_solds_chart_ctx = document.getElementById('per_monthly_total_solds_chart').getContext('2d');
  
  
    // let xValues = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    let x_values = Object.keys(per_monthly_total_solds);
    // let yValues = [55, 49, 44, 24, 15, 55, 22, 11, 22, 33, 11, 55];
    let y_values = Object.values(per_monthly_total_solds);
    
    let bar_colors = [];

    for(let x=0; x<12; x++){
      bar_colors.push(["red", "green","blue","orange","brown"][random_int(0, 4)]);
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
    updatePMTSCByAjaxYear('<?php echo $max_year; ?>')
    console.log("document ready");
  });
  let pmsys = document.getElementById("per_monthly_sold_year_select")
  pmsys.onchange = ()=>{
    console.log("e.value: ", pmsys.value);
    updatePMTSCByAjaxYear(parseInt(pmsys.value));
  }

</script>