<?php
  $page_title = 'Home Page';
  require_once('includes/load.php');
  if (!$session->isUserLoggedIn(true)) { redirect('index.php', false);}
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">

  <div id="message_toast" autohide=true class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-animation="true" data-autohide="true" data-delay="1000">
    <div class="toast-body">
        <?php echo display_msg($msg); ?>
    </div>
  </div>
  
 <div class="col-md-12">
    <div class="panel">
      <div class="jumbotron text-center">
         <h1>Welcome User <hr> Inventory Management System</h1>
         <p>Browse around to find out the pages that you can access!</p>
      </div>
    </div>
 </div>
</div>
<?php include_once('layouts/footer.php'); ?>
<script type="text/javascript">
setTimeout(() => {
  $("#message_toast").hide();
}, 1500);
</script>