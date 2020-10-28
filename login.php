<?php
session_start();
if ($_SESSION['firstname']){
  header('Location: home.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="static/css/login.css">
</head>

<body>

<?php if ($_SESSION['warning']){
   echo '  <div class="text-center alert alert-danger alert-dismissible fade show">
   <button type="button" class="close" data-dismiss="alert">&times;</button>
   <strong>You</strong> have to log in first!
 </div>';
   unset($_SESSION['warning']);}?>

<div class=" mx-auto" style="width: 350px;" >
<?php if ($_SESSION['wrong']){
   echo '  <div class="alert alert-danger alert-dismissible fade show">
   <button type="button" class="close" data-dismiss="alert">&times;</button>
   <strong>Wrong</strong> username or password!
 </div>';
   unset($_SESSION['wrong']);}?>
<form id="loginform" method='post' action="router.php" class="needs-validation">
  <div class="form-group mt-3">
    <label class="sr-only" for="email">Email address:</label>
    <input type="email" name='email' class="form-control" placeholder="Enter email" id="email" required/>
  </div>
  <div class="form-group">
    <label class="sr-only" for="pwd">Password:</label>
    <input type="password" name='password' class="form-control" placeholder="Enter password" id="pwd2" required/>
    <input type="text" class="d-none form-control" name='section' value='login' required/>
  </div>
  <button type="submit" class="btn btn-primary btn-block ">Login</button>
</form> 
<p>
  		Not yet a member? <a href="register.php">Sign up</a>
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