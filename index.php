<?php
  ob_start();
  require_once('includes/load.php');
  if($session->isUserLoggedIn(true)) { redirect('home.php', false);}
?>
<?php include_once('layouts/header.php'); ?>

<div class='login-fullpage'>

<div class='login-img'>
<img src="./uploads/secure_login.png" alt="..." srcset="">

</div>

<div>
<strong>

<h2 class='text-center p-2 inventory-heading'> <i class="glyphicon glyphicon-list-alt "></i> Inventory Management</h2>
</strong>
<div class="login-page">
    <div class="text-center">
    <h3>Welcome</h3>
       <h4>Sign in to start your session</h4>
       
     </div>
     <?php echo display_msg($msg); ?>
      <form method="post" action="auth.php" class="clearfix">
        <div class="form-group">
              <label for="username" class="control-label">Username</label>
              <input type="name" class="form-control" name="username" placeholder="Username">
        </div>
        <div class="form-group">
            <label for="Password" class="control-label">Password</label>
            <input type="password" name= "password" class="form-control" placeholder="Password">
        </div>
        <div class="form-group">
                <button type="submit" class="btn btn-danger" style="border-radius:0%">Login</button>
        </div>
    </form>
    <h5><a href="forgot_password.php">Forgot your password?</a></h5>
</div>
</div>
</div>
<?php include_once('layouts/footer.php'); ?>
