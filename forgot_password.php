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
       <h4>Give your valid username for changing password.</h4>
       
     </div>
     <?php echo display_msg($msg); ?>
      <form id="forgot_form" method="post"  class="clearfix">
        <div  id="username_div" class="form-group">
              <label for="username" class="control-label">Username</label>
              <input id="username" type="name" class="form-control" name="username" placeholder="Username">
        </div>
        <div id="new_password_div" class="form-group" hidden>
              <label for="new_password" class="control-label">New Password</label>
              <input id="new_password" type="password" class="form-control" name="new_password" placeholder="New Password">
        </div>
        <div id="confirm_password_div" class="form-group" hidden>
              <label for="confirm_password" class="control-label">Confirm Password</label>
              <input id="confirm_password" type="password" class="form-control" name="confirm_password" placeholder="Confirm Password">
              <label id="confirm_label"></label>
        </div>
        
        <div class="form-group">
                <button id="check_button" type="submit" class="btn btn-danger" style="border-radius:0%" >Check</button>
                
                <button id="cancel_button" type="button" class="btn btn-cancel" style="border-radius:0%">Cancel</button>
        </div>
        <input name="uid" value="" hidden></input>
        
    </form>
</div>
</div>
</div>
<?php include_once('layouts/footer.php'); ?>
<script type="text/javascript">
  $("#cancel_button").hide();
  let username = document.getElementById("username");
  let check_button = document.getElementById("check_button");
  let new_password_div = document.getElementById("new_password_div");
  let confirm_password_div = document.getElementById("confirm_password_div");
  let new_password = document.getElementById("new_password");
  let confirm_password = document.getElementById("confirm_password");
  let username_div = document.getElementById("username_div");
  // let cancel_div = document.getElementById("cancel_div");
  let cancel_button = document.getElementById("cancel_button");
  let confirm_label = document.getElementById("confirm_label");
  let forgot_form = document.getElementById("forgot_form");

  cancel_button.onclick = (e)=>{
    new_password_div.hidden = true;
    new_password.value = "";
    confirm_password.value = "";
    confirm_password_div.hidden = true;
    username.disabled = false;
    $("#cancel_button").hide();
    check_button.textContent = "Check";
    forgot_form.onsubmit = forgotPassword;
  }
  function forgotPassword(e){
    e.preventDefault();
    console.log(username.value);
    $.ajax({
               type        : 'POST',
               url         : 'apis/is_valid_username.php',
               data        : {username: username.value},
               dataType    : 'json',
               encode      : true
           }).done((response)=>{ 
            console.log(response); 
            if(response.status_code==200){
              new_password_div.hidden = false;
              confirm_password_div.hidden = false;
              username.disabled = true;
              $("#cancel_button").show();
              check_button.textContent = "Change Password";
              forgot_form.onsubmit = (e)=>{
                if(new_password.value =="" || new_password.value!=confirm_password.value){
                  e.preventDefault();
                }
                else{
                  $.ajax({
                    type: "POST",
                    url: "apis/change_forgot_password.php",
                    data: {username: username.value, uid: response.data, new_password: new_password.value},
                    dataType: 'json',
                    encode: true
                  }).done((response)=>{
                    console.log(response);
                    if(response.status_code==201){
                      console.log("password changed");
                      alert("Password Changed");
                      document.location.replace("index.php");

                    } 
                    else{
                      alert("Bad Response from the server!");
                      e.preventDefault();
                    }
                  });
                }
                e.preventDefault();
              };
            }
          });
  }
  
  forgot_form.onsubmit = forgotPassword;
  confirm_password.oninput = () =>{
    if(confirm_password.value == new_password.value || confirm_password.value == ""){
      confirm_label.textContent = "";
    }
    else{
      confirm_label.textContent = "doesn't match!";
    }
  };

</script>

