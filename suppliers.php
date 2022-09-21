<?php
  $page_title = 'All Suppliers';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
  $suppliers = get_all_suppliers();
?>
<?php include_once('layouts/header.php'); ?>
  <div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Manage Suppliers</span>
       </strong>
         <div class="pull-right">
           <a href="add_supplier.php" class="btn btn-danger">Add New</a>
         </div>
        </div>
        <div class="panel-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th> Supplier Name </th>
                <th class="text-center" style="width: 30%;"> Address </th>
                <th class="text-center" style="width: 30%;"> Phone </th>
                <th class="text-center" style="width: 100px;"> Actions </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($suppliers as $supplier):?>
              <tr>
                <td class="text-center"><?php echo count_id();?></td>
                <td> <?php echo remove_junk($supplier['full_name']); ?></td>
                <td class="text-center"> <?php echo remove_junk($supplier['address']); ?></td>
                <td class="text-center"> <?php echo remove_junk($supplier['phone']); ?></td>
                <td class="text-center">
                  <div class="btn-group">
                    <a href="edit_supplier.php?id=<?php echo (int)$supplier['id'];?>" class="btn btn-warning btn-sm"  title="Edit" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>
                    <a href="delete_supplier.php?id=<?php echo (int)$supplier['id'];?>" class="btn btn-danger btn-sm"  title="Delete" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-trash"></span>
                    </a>
                  </div>
                </td>
              </tr>
             <?php endforeach; ?>
            </tbody>
          </tabel>
        </div>
      </div>
    </div>
  </div>
  <?php include_once('layouts/footer.php'); ?>
