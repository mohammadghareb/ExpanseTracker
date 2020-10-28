<?php
session_start();
if ($_SESSION['firstname']){
  header('Location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="static/css/register.css">
</head>

<body >
  
<div class=" mx-auto" style="width: 350px;" >
<form id='registerform' action="router.php" method='post' class="needs-validation" >

  <div class="row mb-3">
  <?php if ($_SESSION['didRegister']=='success'){
   echo '  <div class="alert alert-success alert-dismissible">
   <button type="button" class="close" data-dismiss="alert">&times;</button>
   <strong>Success!</strong> Registration successful, now you can login!
 </div>';
   unset($_SESSION['didRegister']);
 }
 elseif($_SESSION['didRegister']=='failed'){
  echo '<div class="alert alert-danger alert-dismissible fade show">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Passwords</strong> Something did not work, try again!
</div>';
  unset($_SESSION['didRegister']);
 } ?>
  <div class="col-6">
    <label class="sr-only" for="firstname">First name:</label>
    <input type="text" class="form-control" name='firstname' placeholder="Enter firstname" id="firstname" required/>
    <input type="text" class="d-none form-control" name='section' value='register' required/>
</div>
<div class="col-6">
    <label class="sr-only"  for="lastname">Last name:</label>
    <input type="text" class="form-control" name='lastname' placeholder="Enter lastname" id="lastname" required/>
</div>
    </div>


  <div class="form-group">
    <label class="sr-only" for="email">Email address:</label>
    <input type="email" name='email' class="form-control" placeholder="Enter email" id="email" required>
  </div>

  <?php if ($_SESSION['didRegister']=='exists'){
  echo '<div class="alert alert-danger alert-dismissible fade show">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Email</strong> exists, choose another one!
</div>';
   unset($_SESSION['didRegister']);
 }?>
  <div class="row">
    <div class="col">
  <div class="form-group">
    <label class="sr-only"  for="pwd">Password:</label>
    <input type="password" class="form-control" name='password' placeholder="Enter password" id="pwd"  required>
  </div>

  <div class="form-group">
    <label class="sr-only"  for="pwd">Password:</label>
    <input type="password" class=" mb-3 form-control" name='password1' placeholder="Enter the same password" id="pwd1" required>
  
  </div>

</div>
</div>
  <button id='nons' type="submit" class="btn btn-block btn-primary">Register</button>
</form> 
<p>
  		Already a member? <a href="login.php">Sign in</a>
  	</p>
</div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>
</html>