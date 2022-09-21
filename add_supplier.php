<?php
  $page_title = 'Add Supplier';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>
<?php
  if(isset($_POST['add_supplier'])){

   $req_fields = array('full_name','address','phone');
   validate_fields($req_fields);

   if(empty($errors)){
      $full_name   = remove_junk($db->escape($_POST['full_name']));
      $address   = remove_junk($db->escape($_POST['address']));
      $phone   = remove_junk($db->escape($_POST['phone']));

      $query = "INSERT INTO suppliers(full_name, address, phone) VALUES ('{$full_name}', '{$address}', '{$phone}')";
      if($db->query($query)){
        //sucess
        $session->msg('s',"Supplier has been saved! ");
        redirect('add_supplier.php', false);
      } else {
        //failed
        $session->msg('d',' Sorry failed to create supplier!');
        redirect('add_supplier.php', false);
      }
   } else {
     $session->msg("d", $errors);
      redirect('add_supplier.php',false);
   }
 }
?>
<?php include_once('layouts/header.php'); ?>
  <?php echo display_msg($msg); ?>
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Add New Supplier</span>
       </strong>
      </div>
      <div class="panel-body">
        <div class="col-md-6">
          <form method="post" action="add_supplier.php">
            <div class="form-group">
                <label for="full_name">Full Name</label>
                <input type="text" class="form-control" name="full_name" placeholder="Full Name">
            </div>
            <div class="form-group">
                <label for="address">address</label>
                <input type="text" class="form-control" name="address" placeholder="address">
            </div>
            <div class="form-group">
                <label for="phone">phone</label>
                <input type="phone" class="form-control" name ="phone"  placeholder="phone">
            </div>
            <div class="form-group clearfix">
              <button type="submit" name="add_supplier" class="btn btn-danger">Add Supplier</button>
            </div>
        </form>
        </div>

      </div>

    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
