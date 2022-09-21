<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
?>
<?php
  $supplier = find_by_id('suppliers',(int)$_GET['id']);
  if(!$supplier){
    $session->msg("d","Missing Supplier id.");
    redirect('suppliers.php');
  }
?>
<?php
  $delete_id = delete_by_id('suppliers',(int)$supplier['id']);
  if($delete_id){
      $session->msg("s","Supplier deleted.");
      redirect('suppliers.php');
  } else {
      $session->msg("d","Supplier deletion failed.");
      redirect('suppliers.php');
  }
?>
