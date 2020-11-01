<?php
session_start();
if (!$_SESSION['firstname']) {
  $_SESSION['warning']="You have to log in first!";
  header('Location: login.php');}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="static/css/home.css">
</head>
<body>

<nav class="navbar navbar-expand-sm bg-primary navbar-dark fixed-top">
  <a class="navbar-brand" ><?php echo $_SESSION['firstname'] . ' ' . $_SESSION['lastname']?></a>
  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
    <form action='router.php' method='post'>
      <input type='text' class='d-none' name='section' value='logout'>
      <button type = 'submit' id='logout' class="text-light nav-link" href="">Logout</button>
      </form>
    </li>
  </ul>
</nav>

<div class="modal fade" id="categoryform" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Category Form</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
      <div class="md-form mb-3">
          <form id="addCategoryForm" class='form-inline'>
          <input style='width:80%;' type="text" placeholder="Enter the category name" style="width:60%;" id="addCategoryInput" class="mr-3 form-control validate" required />
          <button type=submit id='addCategory' class="ml-3 btn d-inline btn-primary">Add</button>
          </form>
        </div>

      </div>
    </div>
  </div>
</div>






<form id='expensefor'>
<div class="modal fade" id="expenseform" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Expense Form</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
        <div class="md-form mb-5">
          <i class="fas fa-shopping-cart"></i>
          <select id="category" class="form-control validate" required></select>
          <label data-error="wrong" data-success="right" for="orangeForm-name">Category</label>
        </div>
        <div class="md-form mb-5">
          <i class="fas fa-money-check-alt"></i>
          <input onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" type="number" id="amount" class="form-control validate" required />
          <label data-error="wrong" data-success="right" for="orangeForm-email">Amount</label>
        </div>

        <div class="md-form mb-4">
          <i class="far fa-calendar-alt"></i>
          <input id="buyingDate"  type="date" class="form-control validate" required>
          <label data-error="wrong" data-success="right" for="orangeForm-pass">Buying Date</label>
        </div>

      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button type='submit' id='expenseAdd' class="btn btn-primary">Add an Expense</button>
      </div></form>
    </div>
  </div>
</div>


<div class='container mb-3' style="margin-top:60px;">
<div class="d-inline text">
  <a href="" class="btn mt-3 btn-primary btn-rounded mb-4" data-toggle="modal" data-target="#expenseform">Add an Expense</a>
</div>
<div class="d-inline text">
  <a href="" class="btn ml-5 mt-3 btn-primary btn-rounded mb-4" data-toggle="modal" data-target="#categoryform">Category Board</a>
</div>
<div class='row'>
<div class='mt-3 col-8'>
<table class="table">
    <thead>
        <tr>
            <th>Expense ID</th>
            <th>Category</th>
            <th>Amount</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody id="expenseTable">

    </tbody>
</table>
</div>
<div class='mt-3 col-4'>
<canvas id="myChart"  height="300" ></canvas>
</div>
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script src='static/js/app.js'></script>
</body>
</html>