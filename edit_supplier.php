<?php
  $page_title = 'Edit product';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
?>
<?php
$supplier = find_by_id('suppliers',(int)$_GET['id']);

if(!$supplier){
  $session->msg("d","Missing supplier id.");
  redirect('suppliers.php');
}
?>
<?php
 if(isset($_POST['update_supplier'])){
    $req_fields = array('full_name', 'address','phone');
    validate_fields($req_fields);

   if(empty($errors)){
       $full_name  = remove_junk($db->escape($_POST['full_name']));
       $address   = remove_junk($db->escape($_POST['address']));
       $phone   = remove_junk($db->escape($_POST['phone']));

       $query   = "UPDATE suppliers SET";
       $query  .=" full_name ='{$full_name}', address ='{$address}',";
       $query  .=" phone ='{$phone}'";
       $query  .=" WHERE id ='{$supplier['id']}'";
       $result = $db->query($query);
               if($result && $db->affected_rows() === 1){
                 $session->msg('s',"Supplier updated ");
                 redirect('suppliers.php', false);
               } else {
                 $session->msg('d',' Sorry failed to updated!');
                 redirect('edit_supplier.php?id='.$supplier['id'], false);
               }

   } else{
       $session->msg("d", $errors);
       redirect('edit_supplier.php?id='.$supplier['id'], false);
   }

 }

?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>
  <div class="row">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Edit Supplier</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-7">
           <form method="post" action="edit_supplier.php?id=<?php echo (int)$supplier['id'] ?>">
            <div class="form-group">
                  <label for="full_name">Full Name</label>
                  <input type="text" class="form-control" name="full_name" placeholder="Full Name" value="<?php echo $supplier['full_name'] ?>">
              </div>
              <div class="form-group">
                  <label for="address">address</label>
                  <input type="text" class="form-control" name="address" placeholder="address" value="<?php echo $supplier['address'] ?>">
              </div>
              <div class="form-group">
                  <label for="phone">phone</label>
                  <input type="phone" class="form-control" name ="phone"  placeholder="phone" value="<?php echo $supplier['phone'] ?>">
              </div>
              <div class="form-group clearfix">
                <button type="submit" name="update_supplier" class="btn btn-danger">Update Supplier</button>
              </div>
          </form>
         </div>
        </div>
      </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
